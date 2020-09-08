<?php


namespace workspace\modules\bot\controllers;


use core\App;
use core\Controller;
use workspace\modules\bot\models\Bot;
use workspace\modules\bot\requests\BotSearchRequest;

class BotController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/bot/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Bot', 'url' => 'admin/bot']);
    }

    public function actionIndex()
    {
        $request = new BotSearchRequest();
        $model = Bot::search($request);

        $options = $this->setOptions($model);

        return $this->render('bot/index.tpl', ['h1' => 'Bot', 'model' => $model, 'options' => $options]);
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

            $this->redirect('admin/Bot');
        } else
            return $this->render('bot/store.tpl', ['h1' => 'Добавить']);
    }

    public function actionEdit($id)
    {
        $model = Bot::where('id', $id)->first();

        if($this->validation()) {
            $model->_save();

            $this->redirect('admin/Bot');
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
                'bot_username' => 'Bot_username',
                'api_token' => 'Api_token',
                'webhook_url' => 'Webhook_url',
                'is_available' => 'Is_available',
                'created_at' => 'Created_at',
                'updated_at' => 'Updated_at',
            ],
            'baseUri' => 'Bot'
        ];
   }

   public function validation()
   {
       return (isset($_POST["bot_username"]) && isset($_POST["api_token"]) && isset($_POST["webhook_url"]) && isset($_POST["is_available"])) ? true : false;
   }
}