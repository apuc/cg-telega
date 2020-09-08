<?php

namespace workspace\modules\site;


use core\App;

class Site
{
    public static function run()
    {
        $config['adminLeftMenu'] = [
            [
                'title' => 'Site',
                'url' => '/admin/site',
                'icon' => '<i class="nav-icon fa fa-file"></i>',
            ],
        ];

        App::mergeConfig($config);
    }
}