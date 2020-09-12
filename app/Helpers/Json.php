<?php

namespace app\Helpers;

class Json
{
    static function clear($path)
    {
        file_put_contents($path, '');
    }

    static function read($path)
    {
        return json_decode(file_get_contents($path), true);
    }

    static function write($path, $params)
    {
        file_put_contents($path, json_decode($params), true);
        return self::read($path);
    }
}
