<?php


namespace workspace\modules\bot\controllers;


use core\App;
use core\Controller;
use workspace\modules\bot\models\Bot;
use workspace\modules\bot\requests\BotSearchRequest;
use workspace\modules\botdb\models\BotDb;

class BotController extends Controller
{
    private $available_statuses;

    protected function init()
    {
        $this->viewPath = '/modules/bot/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Bot', 'url' => 'admin/bot']);
        $this->available_statuses = [
            'AVAILABLE' => 1,
            'NOT_AVAILABLE' => 0
        ];
    }

    public function actionIndex()
    {
        $request = new BotSearchRequest();
        $model = Bot::search($request);

        $options = $this->setOptions($model);

        return $this->render('bot/index.tpl', ['h1' => 'БОТ', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Bot::where('id', $id)->first();

        $options = $this->setOptions($model);

        return $this->render('bot/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if($this->validation()) {
            $model = new Bot();
            $model->_save();

            $this->redirect('admin/bot');
        } else
            return $this->render('bot/store.tpl', ['h1' => 'Добавить',
                'available_statuses' => $this->available_statuses,
                'dbs' => BotDb::all()
                ]);
    }

    public function actionEdit($id)
    {
        $model = Bot::where('id', $id)->first();

        if($this->validation()) {
            $model->_save();

            $this->redirect('admin/bot');
        } else
            return $this->render('bot/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Bot::where('id', $_POST['id'])->delete();
    }

    public function setOptions($data)
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'id' => 'Id',
                'bot_username' => 'Название бота',
                'api_token' => 'Api токен',
                'webhook_url' => 'Адрес Webhook',
                'is_available' => 'Статус',
                '_db_id' => [
                    'label' => 'База данных',
                    'value' => function($model) {
                        return $model->site->site_name;
                    }
                ],
            ],
            'baseUri' => 'bot'
        ];
   }

   public function validation()
   {
       return (isset($_POST["bot_username"]) && isset($_POST["api_token"]) && isset($_POST["webhook_url"]) && isset($_POST["is_available"]) && isset($_POST["db_id"])) ? true : false;
   }
}