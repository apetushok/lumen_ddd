<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/', function () use ($router) {
    return '<h3>Test Api</h3><br/>'.$router->app->version();
});

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/posts',['as' => 'posts', 'uses' => 'PostController@index']);
    $router->get('/post/{id}',['as' => 'post', 'uses' => 'PostController@post']);
    $router->post('/post',['as' => 'store', 'uses' => 'PostController@store']);
});




