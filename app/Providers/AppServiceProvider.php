<?php

namespace App\Providers;

use App\Domains\Post\Comments\Repositories\CommentRepository;
use App\Domains\Post\Posts\Repositories\PostRepository;
use App\Domains\Post\Posts\Services\Interfaces\PostServiceInterface;
use App\Domains\Post\Posts\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostServiceInterface::class, function ($app){
            return new PostService(
                $app->make(PostRepository::class),
                $app->make(CommentRepository::class)
            );
        });
    }
}
