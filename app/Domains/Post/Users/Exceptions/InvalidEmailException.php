<?php


namespace App\Domains\Post\Users\Exceptions;


class InvalidEmailException extends \Exception
{
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: 'Invalid email', $code, $previous);
    }
}
