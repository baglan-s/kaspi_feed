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
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('/authenticated', 'AuthController@authenticated');

        $router->group(['prefix' => 'organizations'], function ($router) {
            $router->get('/', 'OrganizationController@index');
            $router->get('/show/{id}', 'OrganizationController@show');
            $router->post('/create', 'OrganizationController@create');
            $router->put('/update/{id}', 'OrganizationController@update');
            $router->delete('/delete/{id}', 'OrganizationController@destroy');
        });

        $router->group(['prefix' => 'users'], function ($router) {
            $router->get('/', 'UserController@index');
            $router->get('/show/{id}', 'UserController@show');
            $router->post('/create', 'UserController@create');
            $router->put('/update/{id}', 'UserController@update');
            $router->delete('/delete/{id}', 'UserController@destroy');
        });
        
        $router->post('/logout', 'AuthController@logout');
    });
});

$router->group(['middleware' => 'auth'], function ($router) {
    $router->post('/feed/import/{code}', 'FeedController@import');
});

$router->get('/feed/export/{code}', 'FeedController@export');

$router->get('/{any:.*}', function () {
    return view('app');
});

