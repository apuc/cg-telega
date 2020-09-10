<?php


namespace workspace\modules\botdb\controllers;


use core\App;
use core\Controller;
use Longman\TelegramBot\Telegram;
use workspace\modules\botdb\models\BotDb;
use workspace\modules\botdb\requests\BotDbSearchRequest;

class BotDbController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/botdb/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'BotDb', 'url' => 'admin/bot-db']);
    }

    public function actionIndex()
    {
        $request = new BotDbSearchRequest();
        $model = BotDb::search($request);
        new Telegram();
        $options = $this->setOptions($model);

        return $this->render('botdb/index.tpl', ['h1' => 'BotDb', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = BotDb::where('id', $id)->first();

        $options = $this->setOptions($model);

        return $this->render('botdb/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if($this->validation()) {
            $model = new BotDb();
            $model->_save();

            $this->redirect('admin/bot-db');
        } else
            return $this->render('botdb/store.tpl', ['h1' => 'Добавить']);
    }

    public function actionEdit($id)
    {
        $model = BotDb::where('id', $id)->first();

        if($this->validation()) {
            $model->_save();

            $this->redirect('admin/bot-db');
        } else
            return $this->render('botdb/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        BotDb::where('id', $_POST['id'])->delete();
    }

    public function setOptions($data)
    {
        return [
            'serial' => '#',
            'fields' => [
                'id' => 'Id',
                'host' => 'Host',
                'user' => 'User',
                'password' => 'Password',
                'database' => 'Database',
            ],
            'baseUri' => 'bot-db',
            'data' => $data
        ];
   }

   public function validation()
   {
       return (isset($_POST["host"]) && isset($_POST["user"]) && isset($_POST["password"]) && isset($_POST["database"])) ? true : false;
   }
}