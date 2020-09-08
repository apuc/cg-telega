<?php

namespace workspace\modules\bot;


use core\App;

class Bot
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Bot',
                'url' => '/admin/Bot',
                'icon' => '<i class="nav-icon fa fa-file"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}