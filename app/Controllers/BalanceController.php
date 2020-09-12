<?php

namespace app\Controllers;

use app\Helpers\Http;
use app\Helpers\Json;


class BalanceController extends Controller
{
    public $json_path = __DIR__ . '/../../database/account.json';

    public function requestGET()
    {
        $response = [
            'code' => Http::CODE_404,
            'body'=> '0'
        ];

        $json = Json::read($this->json_path);
        $account_id = $_GET['account_id'];

        if($json && $account_id && isset($json[$account_id]))
        {
            $response = [
                'code' => Http::CODE_200,
                'body'=> $json[$account_id]
            ];
        }

        return $response;
    }
}
