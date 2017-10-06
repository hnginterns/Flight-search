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

$router->get('appKey', function () use ($router) {
    return str_random('32');
});

$router->group(['prefix' => 'api/v1'], function () use ($router)  {
    $router->get('user',                    'Api\v1\UserController@index');
    $router->post('users',                  'Api\v1\UserController@store');
    $router->get('/users/{user_id}',        'Api\v1\UserController@show');
    $router->put('/users/{user_id}',        'Api\v1\UserController@update');
    $router->delete('/users/{user_id}',     'Api\v1\UserController@destroy');

    $router->post('/tokens',              'Api\v1\TokenController@index');

    $router->post('/cities',              'Api\v1\IATAController@index');
    $router->post('/cities{cityCode}',     'Api\v1\IATAController@showCity');
    
  });


  
  $router->group(['prefix' => 'api/v1/flight'], function () use ($router)  {
    $router->get('test',                    'Api\v1\FlightSearchController@test');
    
  });


  $router->group(['prefix' => 'api/v1/flight'], function () use ($router)  {
    $router->get('test',                    'Api\v1\FlightSearchController@test');
    
  });

