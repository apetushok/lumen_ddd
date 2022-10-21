<?php


namespace App\Domains\Post\Users\Repositories\Factories;



use App\Domains\Post\Users\Entities\User;

class UserFactory extends Factory
{
    public static function create(\stdClass $user): User
    {
        $user = self::validateData($user);

        return new User(
            $user->id,
            $user->name,
            'test@email.com'
        );
    }
}
