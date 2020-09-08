<?php


namespace workspace\modules\botsite\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\botsite\requests\BotSiteSearchRequest;

class BotSite extends Model
{
    protected $table = "bot_site";

    public $fillable = ['site_id', 'bot_id', 'created_at', 'updated_at'];

    public function _save()
    {
            $this->site_id = $_POST["site_id"];
            $this->bot_id = $_POST["bot_id"];

        $this->save();
    }

    public function site()
    {
        return $this->belongsTo('workspace\modules\site\models\Site');
    }

    public function bot()
    {
        return $this->belongsTo('workspace\modules\bot\models\Bot');
    }

    /**
     * @param BotSiteSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(BotSiteSearchRequest $request)
    {
        $query = self::query();

        if($request->id)
            $query->where('id', 'LIKE', "%$request->id%");

        if($request->site_id)
            $query->where('site_id', 'LIKE', "%$request->site_id%");

        if($request->bot_id)
            $query->where('bot_id', 'LIKE', "%$request->bot_id%");

        if($request->created_at)
            $query->where('created_at', 'LIKE', "%$request->created_at%");

        if($request->updated_at)
            $query->where('updated_at', 'LIKE', "%$request->updated_at%");


        return $query->get();
    }
}