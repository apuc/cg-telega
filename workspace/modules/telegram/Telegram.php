<?php


namespace workspace\modules\telegram;


use core\App;

class Telegram
{

    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Телеграмм',
                'url' => '/admin/telegram',
                'icon' => '<i class="nav-icon fa fa-users"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}