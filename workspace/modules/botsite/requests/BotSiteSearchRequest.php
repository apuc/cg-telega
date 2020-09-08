<?php


namespace workspace\modules\botsite\requests;


use core\RequestSearch;

/**
 * Class BotSiteSearchRequest
 * @package workspace\modules\botsite\requests
 *
 * @property int unsigned id
 * @property int unsigned site_id
 * @property int unsigned bot_id
 * @property timestamp created_at
 * @property timestamp updated_at
 */

class BotSiteSearchRequest extends RequestSearch
{
    public $id;
    public $site_id;
    public $bot_id;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [];
    }
}