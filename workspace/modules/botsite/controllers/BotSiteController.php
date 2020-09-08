<?php


namespace workspace\modules\botsite\controllers;


use core\App;
use core\Controller;
use workspace\modules\bot\models\Bot;
use workspace\modules\botsite\models\BotSite;
use workspace\modules\botsite\requests\BotSiteSearchRequest;
use workspace\modules\site\models\Site;

class BotSiteController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/botsite/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'BotSite', 'url' => 'admin/bot-site']);
    }

    public function actionIndex()
    {
        $request = new BotSiteSearchRequest();
        $model = BotSite::search($request);

        $options = $this->setOptions($model);

        return $this->render('botsite/index.tpl', ['h1' => 'BotSite', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = BotSite::where('id', $id)->first();

        $options = $this->setOptions();

        return $this->render('botsite/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if($this->validation()) {
            $model = new BotSite();
            $model->_save();

            $this->redirect('admin/bot-site');
        } else {
            $bots = Bot::all();
            $sites = Site::all();

            return $this->render('botsite/store.tpl', ['h1' => 'Добавить', 'bots' => $bots, 'sites' => $sites]);
        }
    }

    public function actionEdit($id)
    {
        $model = BotSite::where('id', $id)->first();

        if($this->validation()) {
            $model->_save();

            $this->redirect('admin/bot-site');
        } else
            return $this->render('botsite/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        BotSite::where('id', $_POST['id'])->delete();
    }

    public function setOptions($data)
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'id' => 'Id',
                '_site' => [
                    'label' => 'Site',
                    'value' => function($model) {
                        return $model->site->site_name;
                    }
                ],
                '_bot' => [
                    'label' => 'Bot',
                    'value' => function($model) {
                        return $model->bot->bot_username;
                    }
                ],
                'created_at' => 'Created_at',
                'updated_at' => 'Updated_at',
            ],
            'baseUri' => 'bot-site'
        ];
   }

   public function validation()
   {
       return (isset($_POST["site_id"]) && isset($_POST["bot_id"])) ? true : false;
   }
}