<?php


namespace workspace\modules\botdb\requests;


use core\RequestSearch;

/**
 * Class BotDbSearchRequest
 * @package workspace\modules\botdb\requests
 *
 * @property int(10) unsigned id
 * @property text host
 * @property text user
 * @property text password
 * @property text database
 * @property timestamp created_at
 * @property timestamp updated_at
 */

class BotDbSearchRequest extends RequestSearch
{
    public $id;
    public $host;
    public $user;
    public $password;
    public $database;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [];
    }
}