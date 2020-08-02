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

Middleware::create(['middleware' => [Session::class]], function () {
    Route::get('/dashboard', 'UserController@dashboard');
});

Middleware::create(['prefix' => '/products'], function () { // TODO: require auth
    Route::get('', 'ProductsController@index');
    Route::post('', 'ProductsController@create', JSON::class);
    Route::put('/{id}', 'ProductsController@update', JSON::class);
    Route::delete('/{id}', 'ProductsController@delete');
});
