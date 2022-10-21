<?php


namespace App\Domains\Post\Posts\Services;


use App\Domains\Post\Comments\Repositories\Interfaces\CommentRepositoryInterface;
use App\Domains\Post\Posts\DTOs\PostDTO;
use App\Domains\Post\Posts\Entities\Post;
use App\Domains\Post\Posts\Repositories\Interfaces\PostRepositoryInterface;
use App\Domains\Post\Posts\Services\Interfaces\PostServiceInterface;

class PostService implements PostServiceInterface
{
    private $postRepository;
    private $commentRepository;

    public function __construct(PostRepositoryInterface $postRepository, CommentRepositoryInterface $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    public function getPost(int $id): Post
    {
        $post = $this->postRepository->findById($id);
        $post->setComments($this->commentRepository->getComments($id));

        return $post;
    }

    public function getPosts(): array
    {
        return $this->postRepository->getAll();
    }

    public function addPost(PostDTO $data): bool
    {
        return $this->postRepository->create($data);
    }
}
