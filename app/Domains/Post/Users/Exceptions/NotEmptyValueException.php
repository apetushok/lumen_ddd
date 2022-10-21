<?php


namespace App\Domains\Post\Users\Exceptions;


class NotEmptyValueException extends \Exception
{
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: 'The returned value cannot be empty', $code, $previous);
    }
}
