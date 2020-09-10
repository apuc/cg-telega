<?php


namespace workspace\modules\telegram\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\bot\models\Bot;
use workspace\modules\botsite\models\BotSite;

class Telegram extends Model
{
    public $telegram_bots;


    public function __construct($site_name)
    {
        $bots = BotSite::select('bot_site.*', 'bot.*', 'site.*')
            ->join('bot', 'bot.id', '=' ,'bot_site.bot_id')
            ->join('site', 'site.id', '=', 'bot_site.site_id')
            //->join('bot_db', 'bot.db_id', '=', 'bot_db.id')
            ->where(['bot.is_available' => Bot::BOT_IS_ACTIVE])
            ->where(['site.site_name' => $site_name])
            ->get();

//        $bots = BotSite::find()->with(['site' => function ($query) use ($site_name) {
//            $query->where(['site_name' => $site_name]);
//        }, 'bot'])->get();

        //echo '<pre>';var_dump($bots[0]->bot); exit();
        foreach ($bots as $bot) {
            $this->telegram_bots[] = new TelegramBot($bot->bot);
        }
    }
}