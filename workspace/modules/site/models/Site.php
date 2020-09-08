<?php


namespace workspace\modules\site\models;


use Illuminate\Database\Eloquent\Model;
use workspace\modules\site\requests\SiteSearchRequest;

class Site extends Model
{
    protected $table = "site";

    public $fillable = ['site_name', 'url', 'created_at', 'updated_at'];

    public function _save()
    {
            $this->site_name = $_POST["site_name"];
            $this->url = $_POST["url"];

        $this->save();
    }

    /**
     * @param SiteSearchRequest $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function search(SiteSearchRequest $request)
    {
        $query = self::query();

        if($request->id)
            $query->where('id', 'LIKE', "%$request->id%");

        if($request->site_name)
            $query->where('site_name', 'LIKE', "%$request->site_name%");

        if($request->url)
            $query->where('url', 'LIKE', "%$request->url%");

        if($request->created_at)
            $query->where('created_at', 'LIKE', "%$request->created_at%");

        if($request->updated_at)
            $query->where('updated_at', 'LIKE', "%$request->updated_at%");


        return $query->get();
    }
}