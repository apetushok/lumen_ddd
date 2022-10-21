<?php

namespace App\Domains\Post\Comments\Repositories;


use App\Domains\Post\Comments\Repositories\Factories\CommentCollectionFactory;
use App\Domains\Post\Comments\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function getComments(int $postId):array
    {
        $comments = app('db')
            ->table('comments')
            ->selectRaw(
                "JSON_OBJECT(
                  'id', comments.id,
                  'text', comments.text,
                  'user', JSON_OBJECT(
                    'id', users.id,
                    'name', users.name
                  )
                ) as json"
            )
            ->leftJoin('users', 'users.id', '=', 'comments.user_id')
            ->leftJoin('posts', 'posts.id', '=', 'comments.post_id')
            ->where('posts.id', $postId)
            ->get();

        return CommentCollectionFactory::create($comments);
    }
}
