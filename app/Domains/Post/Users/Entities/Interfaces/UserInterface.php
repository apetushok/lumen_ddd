<?php


namespace App\Domains\Post\Users\Entities\Interfaces;


interface UserInterface
{
    public function getName():string;
    public function getEmail():string;
}
