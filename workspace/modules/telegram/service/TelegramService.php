<?php


namespace workspace\modules\telegram\service;


use core\App;
use workspace\modules\bot\models\Bot;
use workspace\modules\botdb\models\BotDb;

class TelegramService
{
    public function connectDB(Bot $bot)
    {
        $bot_db = Bot::find()->with('botdb')->one();
        var_dump($bot_db); exit();
    }
}