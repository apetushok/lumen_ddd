<?php


namespace App\Domains\Post\Posts\Repositories;


use App\Domains\Post\Posts\DTOs\PostDTO;
use App\Domains\Post\Posts\Entities\Post;
use App\Domains\Post\Posts\Repositories\Factories\CommentCollectionFactory;
use App\Domains\Post\Posts\Repositories\Factories\PostCollectionFactory;
use App\Domains\Post\Posts\Repositories\Factories\PostFactory;
use App\Domains\Post\Posts\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function findById(int $id):Post
    {
        $post = app('db')
            ->table('posts')
            ->selectRaw(
                "JSON_OBJECT(
                  'id', posts.id,
                  'title', posts.title,
                  'description', posts.description,
                  'content', posts.content,
                  'user', JSON_OBJECT(
                    'id', users.id,
                    'name', users.name
                  )
                ) as json"
            )
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.id', $id)
            ->first();

        return PostFactory::create($post);
    }

    public function getAll():array
    {
        $posts = app('db')
            ->table('posts')
            ->selectRaw(
                "JSON_OBJECT(
                  'id', posts.id,
                  'title', posts.title,
                  'description', posts.description,
                  'content', posts.content,
                  'user', JSON_OBJECT(
                    'id', users.id,
                    'name', users.name
                  )
                ) as json"
            )
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->get();


        return PostCollectionFactory::create($posts);
    }

    public function create(PostDTO $data): bool
    {
        return app('db')->table('posts')->insert([
            'title' => $data->title,
            'description' => $data->description,
            'content' => $data->content,
            'user_id' => $data->userId
        ]);
    }
}
