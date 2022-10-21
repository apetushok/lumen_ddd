<?php

namespace Tests;

use App\Domains\Post\Posts\Repositories\Factories\PostFactory;
use App\Domains\Post\Posts\Repositories\PostRepository;
use App\Models\Post;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    private $postRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->postRepository = $this->app->make(PostRepository::class);
    }

    public function test_that_base_endpoint_returns_a_successful_response()
    {
        $this->get('/');

        $this->assertEquals(200, $this->response->status());
        $this->assertEquals(
            '<h3>Test Api</h3><br/>'.$this->app->version(), $this->response->getContent()
        );
    }

    public function test_get_posts()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $posts = array_map(function ($post) use ($user){
            return $post->getAPIData();
        }, $this->postRepository->getAll());

        $this->get(route('posts'))
            ->seeJsonEquals($posts);
    }

    public function test_get_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $post = $this->createPost($user);
        $postApiData = $post->getAPIData();

        $this->get(route('post',['id' => $postApiData['id']]))
            ->seeJsonEquals($postApiData);
    }

    public function test_create_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->post(route('store'), [
                'title' => $post->title,
                'description' => $post->description,
                'content' => $post->content,
                'user_id' => $user->id
            ])
            ->seeJsonEquals([
                'created' => true,
            ]);
    }

    public function test_create_validation_false()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->post(route('store'), [
                'title' => 'title',
                'description' => 'description',
                'content' => 'content',
                'user_id' => $user->id
            ])
            ->assertResponseStatus(422);
    }

    private function createPost($user): \App\Domains\Post\Posts\Entities\Post
    {
        $post = (object)Post::factory()
            ->create(['user_id' => $user->id])
            ->toArray();
        $post->user = (object)$user->toArray();

        return PostFactory::create($post);
    }
}
