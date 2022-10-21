<?php


namespace App\Domains\Post\Posts\Repositories\Factories;


use Illuminate\Support\Collection;

class PostCollectionFactory
{
    public static function create(Collection $posts): array
    {
        $result = [];
        foreach ($posts as $post){
            $result[] = PostFactory::create($post);
        }
        return $result;
    }
}
