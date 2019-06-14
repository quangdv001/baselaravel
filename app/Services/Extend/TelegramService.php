<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/25/18
 * Time: 4:57 PM
 */

namespace App\Service\Extend;

use GuzzleHttp\Client;
use Config;

class TelegramService
{
    private static $_url = 'https://api.telegram.org/bot';
    private static $_token = '834593188:AAGB7XcTFuoiLhxpgezomHclmCV4TCkxd8c';
    private static $_chat_id = '-322736613';

    public function __construct()
    {

    }

    public static function sendMessage($text)
    {
        $_chat_id = self::$_chat_id;
        $uri = self::$_url . self::$_token . '/sendMessage?parse_mode=html';
        $params = [
            'chat_id' => $_chat_id,
            'text' => $text,
        ];
        $option['verify'] = false;
        $option['form_params'] = $params;
        $option['http_errors'] = false;
        $client = new Client();
        $response = $client->request("POST", $uri, $option);
        return json_decode($response->getBody(), true);
    }
}