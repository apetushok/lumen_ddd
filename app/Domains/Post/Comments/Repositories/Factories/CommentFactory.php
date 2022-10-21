<?php


namespace App\Domains\Post\Comments\Repositories\Factories;


use App\Domains\Post\Comments\Entities\Comment;
use App\Domains\Post\Users\Repositories\Factories\UserFactory;

class CommentFactory extends Factory
{
    public static function create(\stdClass $comment): Comment
    {
        $comment = self::validateData($comment);

        return new Comment(
            $comment->id,
            $comment->text,
            UserFactory::create($comment->user)
        );
    }
}
