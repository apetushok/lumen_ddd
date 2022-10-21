<?php


namespace App\Domains\Post\Comments\Repositories\Interfaces;


interface CommentRepositoryInterface
{
    public function getComments(int $postId): array;
}
