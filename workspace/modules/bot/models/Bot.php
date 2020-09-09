<?php


namespace workspace\modules\bot\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\bot\requests\BotSearchRequest;

/**
 * Class Bot
 * @package workspace\modules\bot\models
 * @property string bot_username
 * @property string api_token
 * @property string webhook_url
 * @property boolean is_available
 * @property integer db_id
 */
class Bot extends Model
{
    protected $table = "bot";

    public $fillable = ['bot_username', 'api_token', 'webhook_url', 'is_available', 'created_at', 'updated_at', 'db_id'];

    public function _save()
    {
        $this->bot_username = $_POST["bot_username"];
        $this->api_token = $_POST["api_token"];
        $this->webhook_url = $_POST["webhook_url"];
        $this->is_available = $_POST["is_available"];
        $this->db_id = $_POST["db_id"];

        $this->save();
    }

    public function sites()
    {
        return $this->hasMany('workspace\modules\site\models\Site');
    }

    /**
     * @param BotSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(BotSearchRequest $request)
    {
        $query = self::query();

        if($request->id)
            $query->where('id', 'LIKE', "%$request->id%");

        if($request->bot_username)
            $query->where('bot_username', 'LIKE', "%$request->bot_username%");

        if($request->api_token)
            $query->where('api_token', 'LIKE', "%$request->api_token%");

        if($request->webhook_url)
            $query->where('webhook_url', 'LIKE', "%$request->webhook_url%");

        if($request->is_available)
            $query->where('is_available', 'LIKE', "%$request->is_available%");

        if($request->created_at)
            $query->where('created_at', 'LIKE', "%$request->created_at%");

        if($request->updated_at)
            $query->where('updated_at', 'LIKE', "%$request->updated_at%");


        return $query->get();
    }
}