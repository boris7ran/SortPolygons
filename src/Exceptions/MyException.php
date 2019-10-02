<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class MyException extends Exception
{
    public function __construct($message = "Default error message", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}