<?php


namespace workspace\modules\telegram\controllers;


use core\App;
use core\Controller;
use core\Debug;
use workspace\modules\bot\models\Bot;
use workspace\modules\telegram\models\Telegram;
use workspace\modules\telegram\requests\TelegramRequest;

class TelegramController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/telegram/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Telegram', 'url' => 'telegram']);
    }

    public function actionIndex()
    {
        $bc_options = [
            'class' => '',
            'separator' => ' > ',
            'items' => [
                [
                    'text' => 'Telegram',
                ],
            ],
        ];

        return $this->render('telegram/index.tpl', ['h1' => 'telegram', 'bc_options' => $bc_options]);
    }

    public function actionStore()
    {
        $request = new TelegramRequest();
//        var_dump($request); exit();
        if ($request->isPost() AND $request->validate()) {
            $bot = Bot::where('id', $request->bot_id)->first();
            $config = [
                'api_token' => $bot->api_token,
                'bot_username' => $bot->bot_username,
                'webhook_url' => $bot->webhook_url
            ];
//            $config = [
//                'api_token' => '1155500941:AAHlnRX1RgcUOaOsSP88apqqdhTZt2qSMh8',
//                'bot_username' => 'craft_group_bot',
//                'hook_host' => 'https://telega.craft-group.xyz/'
//            ];
            $telegram = new Telegram($config);
            //var_dump($telegram); exit();
            $telegram->sendAll($request->text);

            $this->redirect('admin/telegram');
        } else {
            return $this->render('telegram/store.tpl', ['h1' => 'Добавить', 'bots' => Bot::all()]);
        }
    }
}