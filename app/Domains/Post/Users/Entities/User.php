<?php

namespace App\Domains\Post\Users\Entities;


use App\Domains\Post\Users\ValueObjects\User as UserValuesObject;

class User extends UserValuesObject
{
    private $id;

    public function __construct($id, string $name, string $email)
    {
        $this->id = $id;
        parent::__construct($name, $email);
    }
}
