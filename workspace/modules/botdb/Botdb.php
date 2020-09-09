<?php

namespace workspace\modules\botdb;


use core\App;

class Botdb
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'BotDb',
                'url' => '/admin/bot-db',
                'icon' => '<i class="nav-icon fa fa-file"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}