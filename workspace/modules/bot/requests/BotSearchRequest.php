<?php


namespace workspace\modules\bot\requests;


use core\RequestSearch;

/**
 * Class BotSearchRequest
 * @package workspace\modules\bot\requests
 *
 * @property int unsigned id
 * @property text bot_username
 * @property text api_token
 * @property text webhook_url
 * @property tinyint(1) is_available
 * @property timestamp created_at
 * @property timestamp updated_at
 */

class BotSearchRequest extends RequestSearch
{
    public $id;
    public $bot_username;
    public $api_token;
    public $webhook_url;
    public $is_available;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [];
    }
}