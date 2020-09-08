<?php


namespace workspace\modules\site\requests;


use core\RequestSearch;

/**
 * Class SiteSearchRequest
 * @package workspace\modules\site\requests
 *
 * @property int unsigned id
 * @property text site_name
 * @property text url
 * @property timestamp created_at
 * @property timestamp updated_at
 */

class SiteSearchRequest extends RequestSearch
{
    public $id;
    public $site_name;
    public $url;
    public $created_at;
    public $updated_at;


    public function rules()
    {
        return [];
    }
}