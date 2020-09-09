<?php


namespace workspace\modules\botdb\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\botdb\requests\BotDbSearchRequest;

class BotDb extends Model
{
    protected $table = "bot_db";

    public $fillable = ['host', 'user', 'password', 'database', 'created_at', 'updated_at'];

    public function _save()
    {
            $this->host = $_POST["host"];
            $this->user = $_POST["user"];
            $this->password = $_POST["password"];
            $this->database = $_POST["database"];

        $this->save();
    }

    public function botdb()
    {
        return $this->belongsTo('workspace\modules\botdb\models\BotDb');
    }

    /**
     * @param BotDbSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(BotDbSearchRequest $request)
    {
        $query = self::query();

        if($request->id)
            $query->where('id', 'LIKE', "%$request->id%");

        if($request->host)
            $query->where('host', 'LIKE', "%$request->host%");

        if($request->user)
            $query->where('user', 'LIKE', "%$request->user%");

        if($request->password)
            $query->where('password', 'LIKE', "%$request->password%");

        if($request->database)
            $query->where('database', 'LIKE', "%$request->database%");

        if($request->created_at)
            $query->where('created_at', 'LIKE', "%$request->created_at%");

        if($request->updated_at)
            $query->where('updated_at', 'LIKE', "%$request->updated_at%");


        return $query->get();
    }
}