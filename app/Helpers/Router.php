<?php

namespace app\Helpers;

class Router
{
    static function get_controller_name()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $controller_name = ucfirst(explode('/', $uri)[1]);

        return "{$controller_name}Controller";
    }

    static function get_controller_path()
    {
        $controller_name = self::get_controller_name();
        return __DIR__ ."/../Controllers/{$controller_name}.php";
    }

    static function controller_exists()
    {
        $controller_path = self::get_controller_path();
        return file_exists($controller_path);
    }
    
    static function response()
    {
        $controller_name = "app\\Controllers\\". self::get_controller_name();
        new $controller_name;
    }
}
