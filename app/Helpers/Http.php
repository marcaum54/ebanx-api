<?php

namespace app\Helpers;

class Http
{
    const CODE_404 = "HTTP/1.1 404 Not Found";
    const CODE_200 = "HTTP/1.1 200 OK";
    const CODE_201 = "HTTP/1.1 201 Created";

    static function header_not_found()
    {
        header(self::CODE_404);
        die('0');
    }
}
