<?php


namespace App\Domains\Post\Posts\Repositories\Interfaces;


use App\Domains\Post\Posts\DTOs\PostDTO;
use App\Domains\Post\Posts\Entities\Post;

interface PostRepositoryInterface
{
    public function findById(int $id): Post;
    public function getAll(): array;
    public function create(PostDTO $data): bool;
}
