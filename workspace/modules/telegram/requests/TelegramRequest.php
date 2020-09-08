<?php


namespace workspace\modules\telegram\requests;


use core\Request;

/**
 * Class TelegramRequest
 * @package workspace\modules\telegram\requests
 */
class TelegramRequest extends Request
{
    public $bot_id;
    public $text;


    public function rules()
    {
        return [
            'bot_id' => 'required',
            'text' => 'required',
        ];
    }
}