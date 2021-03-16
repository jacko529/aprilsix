<?php

namespace App\Exceptions;

use Exception;

class InvalidParameterException extends Exception
{
    /**
     * @param $message
     * @return static
     */
    public static function invalid($message)
    {

        return new static($message);

    }
}
