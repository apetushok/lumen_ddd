<?php


namespace App\Domains\Post\Posts\Services\Interfaces;


use App\Domains\Post\Posts\DTOs\PostDTO;
use App\Domains\Post\Posts\Entities\Post;

interface PostServiceInterface
{
    public function getPosts(): array ;
    public function getPost(int $id): Post;
    public function addPost(PostDTO $data): bool;
}
