<?php

namespace App\Domains\Post\Users\ValueObjects;


use App\Domains\Post\Users\Entities\Interfaces\UserInterface;
use App\Domains\Post\Users\Exceptions\InvalidEmailException;

class User implements UserInterface
{
    private $name;
    private $email;

    public function __construct(string $name, string $email)
    {
        $this->setName($name);
        $this->setEmail($email);
    }

    private function setName(string $name):void
    {
        if (mb_strlen($name) > 255) {
            throw new InvalidEmailException();
        }

        $this->name = $name;
    }

    private function setEmail(string $email):void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }

        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
