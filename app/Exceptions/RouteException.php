<?php

namespace Exceptions;

use Exception;
use Throwable;

class RouteException extends Exception
{
    /**
     * Me ramène à une exception d'une route
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code = 404, Throwable|null $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}