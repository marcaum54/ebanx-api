<?php

namespace app\Helpers;

class Http
{
    const CODE_404 = "HTTP/1.1 404 Not Found";
    const CODE_200 = "HTTP/1.1 200 OK";

    static function header_not_found()
    {
        header(self::CODE_404);
        die();
    }
}
