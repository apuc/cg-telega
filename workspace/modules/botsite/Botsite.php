<?php

namespace workspace\modules\botsite;


use core\App;

class Botsite
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'BotSite',
                'url' => '/admin/bot-site',
                'icon' => '<i class="nav-icon fa fa-file"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}