<?php


namespace workspace\modules\telegram\models;


use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use workspace\modules\bot\models\Bot;

class TelegramBot
{
    public $telegram_bot;


    public function __construct(Bot $bot)
    {
        $this->connectWebHook($bot);
        $this->connectDB($bot);
    }

    public function connectWebHook(Bot $bot)
    {
        try {
            $this->telegram_bot = new \Longman\TelegramBot\Telegram($bot->api_token, $bot->bot_username);
            $result = $this->telegram_bot->setWebhook("$bot->webhook_url/$bot->bot_username");
            var_dump($result->isOk());
            if ($result->isOk()) {
                $commands_paths = [
                    WORKSPACE_DIR . '/telegram/commands',
                ];

                $this->telegram_bot->addCommandsPaths($commands_paths);
                var_dump($this->telegram_bot->getCustomInput());
                Request::sendMessage(['chat_id' => 572814395, 'text' => $this->telegram_bot->getCustomInput()]);

                $this->telegram_bot->handle();
                $this->telegram_bot->handleGetUpdates();
                Request::sendMessage(['chat_id' => 572814395, 'text' => $bot->bot_username]);
            }
        } catch (\Longman\TelegramBot\Exception\TelegramException $e) {
            //Request::sendMessage(['chat_id' => 572814395, 'text' => $e->getMessage()]);
        }
    }

    public function connectDB(Bot $bot)
    {
        $bot_db = $bot->select('bot_db.*')->join('bot_db', 'bot.db_id', '=', 'bot_db.id')->get();
        //echo '<pre>';var_dump($bot_db[0]);  exit();

        try {
            $mysql_credentials = [
                'host' => $bot_db[0]->host,
                'user' => $bot_db[0]->user,
                'password' => $bot_db[0]->password,
                'database' => $bot_db[0]->database,
            ];
            $this->telegram_bot->enableMySql($mysql_credentials);
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function sendAll($text)
    {
        try {
            $users = CGDB::getUsers();
            foreach ($users as $user) {
                $this->send($user['id'], $text);
            }
        } catch (TelegramException $e) {

        }
    }

    public function send($chat_id, $text)
    {//572814395
        try {
            Request::sendMessage(['chat_id' => $chat_id, 'text' => $text]);
        } catch (TelegramException $e) {

        }
    }

    public function addUser()
    {
        try {
            self::select(file_get_contents('../vendor/longman/telegram-bot/structure.sql'));
        } catch (\Exception $ex) {

        }
    }
}