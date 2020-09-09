<?php

namespace workspace\controllers;

use core\App;
use core\component_manager\lib\Mod;
use core\Controller;
use workspace\modules\bot\models\Bot;
use workspace\modules\botsite\models\BotSite;
use workspace\modules\users\models\User;
use workspace\requests\LoginRequest;
use workspace\requests\RegistrationRequest;
use workspace\widgets\Language;


class MainController extends Controller
{
    public function actionIndex()
    {
        $mod = new Mod();
        $this->view->setTitle('CG Framework');

        $buttons[0] = '<a href="/codegen" class="btn btn-dark">CodeGen</a>';
        $buttons[1] = '<a href="/modules" class="btn btn-dark">Модули</a>';
        if ($mod->getModInfo('adminlte')['status'] == 'active')
            $buttons[2] = '<a href="/admin/adminlte" class="btn btn-dark">AdminLTE</a>';

        return $this->render('main/index.tpl', ['h1' => App::$config['app_name'], 'buttons' => $buttons]);
    }

    public function actionTelegram($bot_username)
    {
        $site = 'test';
        $bot = BotSite::with(['site' => function ($query) use ($site) {
            $query->where(['site_name' => $site]);
        }, 'bot'])->get();

        $bot = 'craft_group_bot';
        if ($bot != null) {
            $webhook_url = $bot->webhook_url;
            if ($webhook_url[strlen($webhook_url) - 1] !== '/') {
                $webhook_url .= "/$bot_username";
            }
            $config = [
                'api_token' => $bot->api_token,
                'bot_username' => $bot->bot_username,
                'webhook_url' => "$webhook_url"
            ];

            $config_db = [];

            $telegram = new \workspace\modules\telegram\models\Telegram($config);
        } else {
            echo 'There is no such bot...';
        }
    }

    public function actionLanguage()
    {
        Language::widget()->run();
    }

    public function actionSignUp()
    {
        $this->view->setTitle('Sign Up');
        
        $request = new RegistrationRequest();
        
        if ($request->isPost() && $request->validate()) {
            $model = new User();
            $model->_save($request);

            $_SESSION['role'] = $model->role;
            $_SESSION['username'] = $model->username;

            $this->redirect('');
        }
        return $this->render('main/sign-up.tpl', ['errors' => $request->getMessagesArray()]);
    }

    public function actionSignIn()
    {
        $this->view->setTitle('Sign In');

        $mod = new Mod();
        if ($mod->getModInfo('users')['status'] != 'active') {
            $message = 'Чтобы сделать доступной регистрацию и авторизацию установите и активируйте модуль пользователей.';

            return $this->render('main/info.tpl', ['message' => $message]);
        } else {
            $request = new LoginRequest();
            if ($request->isPost() && $request->validate()) {
                $model = User::where('username', $request->username)->first();

                if (password_verify($request->password, $model->password_hash)) {
                    $_SESSION['role'] = $model->role;
                    $_SESSION['username'] = $model->username;

                    $this->redirect('');
                }
            }

            return $this->render('main/sign-in.tpl', ['errors' => $request->getMessagesArray()]);
        }
    }

    public function actionLogout()
    {
        session_destroy();
        $this->redirect('');
    }
}