<?php

namespace app\Controllers;

use app\Helpers\Http;


class Controller
{
    public function __construct()
    {
        echo $this->processRequest();
    }

    public function processRequest()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $response = $this->requestGET();
                break;
            case 'POST':
                $response = $this->requestPOST();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['code']);
        if ($response['body'])
            die(strval($response['body']));
    }

    public function requestGET()
    {
        Http::header_not_found();
    }
    
    public function requestPOST()
    {
        Http::header_not_found();
    }
    
    public function notFoundResponse()
    {
        Http::header_not_found();
    }
}
