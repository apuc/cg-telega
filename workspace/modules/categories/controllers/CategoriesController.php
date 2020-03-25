<?php

namespace workspace\modules\categories\controllers;

use core\App;
use core\Controller;
use workspace\models\Category;

class CategoriesController extends Controller
{
    public $viewPath = '/modules/categories/views/';

    protected function init()
    {
        $this->viewPath = '/modules/categories/views/';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Categories', 'url' => 'categories']);
    }

    public function actionIndex()
    {
        $model = Category::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'action' => [
                    'label' => 'Действие',
                    'value' => function($model) {

                       return '<a class="custom-link" id="'. $model->id .'" href="categories/'. $model->id .'" data-id="'.$model->id.'" data-url="categories"><i class="nav-icon fas fa-eye"></i></a> '
                           . '<a class="custom-link" id="'. $model->id .'" href="categories/update/'. $model->id .'" data-id="'.$model->id.'" data-url="categories"><i class="nav-icon fas fa-edit"></i></a> '
                           . '<a class="custom-link" id="'. $model->id .'" href="categories/delete/'. $model->id .'" data-id="'.$model->id.'" data-url="categories"><i class="nav-icon fas fa-trash"></i></a>';
                    }
                ],
               'category' => 'Категория'
            ],
            'baseUri' => 'categories'
        ];

        return $this->render('categories/index.tpl', ['h1' => 'Категории', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Category::where('id', $id)->first();

        $options = [
            'fields' => [
                'category' => 'Категория'
            ],
        ];

        return $this->render('categories/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['category'])) {
            $model = new Category();
            $model->category = $_POST['category'];
            $model->save();

            $this->redirect('categories');
        } else
            return $this->render('categories/store.tpl', ['h1' => 'Добавить категорию']);
    }

    public function actionEdit($id)
    {
        $model = Category::where('id', $id)->first();

        if(isset($_POST['category'])) {
            $model->category = $_POST['category'];
            $model->save();

            $this->redirect('categories');
        } else
            return $this->render('categories/edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Category::where('id', $_POST['id'])->delete();
    }
}