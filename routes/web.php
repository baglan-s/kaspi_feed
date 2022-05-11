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
$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'organizations'], function ($router) {
        $router->get('/', 'OrganizationController@index');
        $router->get('/show/{id}', 'OrganizationController@show');
        $router->post('/create', 'OrganizationController@create');
        $router->put('/update/{id}', 'OrganizationController@update');
        $router->delete('/delete/{id}', 'OrganizationController@destroy');
    });

    $router->post('/feed/import/{hash}', 'FeedController@import');
    
    $router->post('/logout', 'AuthController@logout');
});

$router->post('/feed/export/{hash}', 'FeedController@export');

