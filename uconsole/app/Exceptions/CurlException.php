<?php

namespace App\Exceptions;

class CurlException extends \Exception
{

    public static function requestGoneWrong()
    {
        return new static("Cant do request");
    }
    public static function missingToken()
    {
        return new static("Token not found");
    }
}
