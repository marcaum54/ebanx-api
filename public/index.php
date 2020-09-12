<?php

require_once '../vendor/autoload.php';

use app\Helpers\Http;
use app\Helpers\Router;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if( !Router::controller_exists() )
    Http::header_not_found();

Router::response();
