<?php

namespace App\Http\Controllers;

use App\Domains\Post\Posts\DTOs\PostDTO;
use App\Domains\Post\Posts\Entities\Post;
use App\Domains\Post\Posts\Services\Interfaces\PostServiceInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getPosts();
        return response(array_map(function (Post $post) {
            return $post->getAPIData();
        }, $posts), 200);
    }

    public function post($id)
    {
        return response($this->postService->getPost($id)->getAPIData(), 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'content' => 'required|min:20'
        ]);

        return response([
            'created' => $this->postService->addPost(PostDTO::fromArray($request->all()))
        ], 201);
    }
}
