<?php


namespace App\Domains\Post\Posts\Repositories\Factories;


use App\Domains\Post\Posts\Entities\Post;
use App\Domains\Post\Users\Repositories\Factories\UserFactory;

class PostFactory extends Factory
{
    public static function create(\stdClass $post): Post
    {
        $post = self::validateData($post);

        return new Post(
            $post->id,
            $post->title,
            $post->description,
            $post->content,
            UserFactory::create($post->user)
        );
    }
}
