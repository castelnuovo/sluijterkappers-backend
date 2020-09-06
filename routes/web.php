<?php

use CQ\Middleware\JSON;
use CQ\Middleware\Session;
use CQ\Routing\Middleware;
use CQ\Routing\Route;

Route::$router = $router->get();
Middleware::$router = $router->get();

Route::get('/', 'GeneralController@index');
Route::get('/error/{code}', 'GeneralController@error');

Middleware::create(['prefix' => '/auth'], function () {
    Route::get('/request', 'AuthController@request');
    Route::get('/callback', 'AuthController@callback');
    Route::get('/logout', 'AuthController@logout');
});

Route::get('/products', 'ProductsController@index');
Route::get('/reviews', 'ReviewsController@index');

Middleware::create(['middleware' => [Session::class]], function () {
    Route::get('/dashboard', 'UserController@dashboard');
    Route::get('/dashboard/reviews', 'UserController@reviews');
});

Middleware::create(['prefix' => '/products', 'middleware' => [Session::class]], function () {
    Route::post('', 'ProductsController@create', JSON::class);
    Route::put('/{id}', 'ProductsController@update', JSON::class);
    Route::delete('/{id}', 'ProductsController@delete');
});

Middleware::create(['prefix' => '/reviews', 'middleware' => [Session::class]], function () {
    Route::post('', 'ReviewsController@create', JSON::class);
    Route::put('/{id}', 'ReviewsController@update', JSON::class);
    Route::delete('/{id}', 'ReviewsController@delete');
});
