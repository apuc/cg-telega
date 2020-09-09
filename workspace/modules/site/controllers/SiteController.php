<?php


namespace workspace\modules\site\controllers;


use core\App;
use core\Controller;
use workspace\modules\site\models\Site;
use workspace\modules\site\requests\SiteSearchRequest;

class SiteController extends Controller
{
    protected function init()
    {
        $this->viewPath = '/modules/site/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Site', 'url' => 'admin/site']);
    }

    public function actionIndex()
    {
        $request = new SiteSearchRequest();
        $model = Site::search($request);

        $options = $this->setOptions($model);

        return $this->render('site/index.tpl', ['h1' => 'Сайт', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Site::where('id', $id)->first();

        $options = $this->setOptions($model);

        return $this->render('site/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if($this->validation()) {
            $model = new Site();
            $model->_save();

            $this->redirect('admin/site');
        } else
            return $this->render('site/store.tpl', ['h1' => 'Добавить']);
    }

    public function actionEdit($id)
    {
        $model = Site::where('id', $id)->first();

        if($this->validation()) {
            $model->_save();

            $this->redirect('admin/site');
        } else
            return $this->render('site/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Site::where('id', $_POST['id'])->delete();
    }

    public function setOptions($data)
    {
        return [
            'data' => $data,
            'serial' => '#',
            'fields' => [
                'id' => 'Id',
                'site_name' => 'Название сайта',
                'url' => 'Url'
            ],
            'baseUri' => 'site'
        ];
   }

   public function validation()
   {
       return (isset($_POST["site_name"]) && isset($_POST["url"])) ? true : false;
   }
}