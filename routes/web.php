<?php

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
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->post('/logout/{id}', 'AuthController@logout');

$router->group(['prefix' => 'dish/'], function() use ($router) {
	$router->get('/', 'DishController@show');
	$router->get('/food', 'DishController@getFood');
	$router->get('/drink', 'DishController@getDrink');
	$router->get('/{id}', 'DishController@detail');
	$router->post('/', 'DishController@add');
	$router->post('/{id}', 'DishController@edit');
	$router->delete('/{id}', 'DishController@delete');
});

$router->group(['prefix' => 'order/'], function() use ($router) {
	$router->get('/', 'OrderController@show');
	$router->get('/{id}', 'OrderController@detail');
	$router->post('/', 'OrderController@add');
	$router->post('/{id}', 'OrderController@edit');
	$router->delete('/{id}', 'OrderController@delete');
});

$router->group(['prefix' => 'transaction/'], function() use ($router) {
	$router->get('/', 'TransController@show');
	$router->get('/{id}', 'TransController@detail');
	$router->post('/', 'TransController@add');
	$router->delete('/{id}', 'TransController@delete');
});