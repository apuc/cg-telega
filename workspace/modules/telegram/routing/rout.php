<?php

use core\App;

App::$collector->group(['before' => 'auth'], function ($router){
    App::$collector->group(['prefix' => 'admin'], function ($router) {
        App::$collector->gridView('telegram', ['workspace\modules\telegram\controllers\TelegramController']);
    });
});

//App::$collector->get('telegram/{webhook_url}', ['workspace\modules\telegram\controllers\TelegramController', 'actionTelegram']);