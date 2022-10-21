<?php


namespace App\Domains\Post\Users\Repositories\Factories;



class Factory
{
    public static function validateData(\stdClass $data): \stdClass
    {
        if(!empty($data->json)){
            $data = json_decode($data->json);
        }

        return $data;
    }
}
