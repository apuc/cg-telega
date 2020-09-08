<?php


namespace workspace\modules\telegram\models;


use Illuminate\Database\Eloquent\Model;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class Telegram extends Model
{
    private $telegram;
    private $api_key;
    private $bot_username;
    private $webhook_url;


    public function __construct(array $config)
    {
        $this->api_key = $config['api_token'];
        $this->bot_username = $config['bot_username'];
        $this->webhook_url = $config['webhook_url'];
        $this->connectWebHook();

        $this->connectDB();
    }

    public function connectWebHook()
    {
        try {
            $this->telegram = new \Longman\TelegramBot\Telegram($this->api_key, $this->bot_username);
            var_dump($this->webhook_url);
            $result = $this->telegram->setWebhook($this->webhook_url);
            if ($result->isOk()) {
                echo $result->getDescription();
                $commands_paths = [
                    __DIR__ . '/commands',
                ];

                $this->telegram->addCommandsPaths($commands_paths);
                $this->telegram->handle();
                $this->telegram->handleGetUpdates();
            }
        } catch (\Longman\TelegramBot\Exception\TelegramException $e) {
            //Request::sendMessage(['chat_id' => 572814395, 'text' => $e->getMessage()]);
        }
    }

    public function connectDB()
    {
        try {
            $mysql_credentials = [
                'host' => 'localhost',
                'user' => 'root',
                'password' => '123edsaqw',
                'database' => 'craft_group_bot',
            ];
            $this->telegram->enableMySql($mysql_credentials);
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }


    public function send($chat_id, $text)
    {//572814395
        try {
            Request::sendMessage(['chat_id' => $chat_id, 'text' => $text]);
        } catch (TelegramException $e) {

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

    public function addUser()
    {
        try {
            self::select(file_get_contents('../vendor/longman/telegram-bot/structure.sql'));
        } catch (\Exception $ex) {

        }
    }



}