<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => '/manage'], function () use ($router)  {
    Route::get('user',                    'Api\v1\UserController@index');
    Route::post('users',                  'Api\v1\UserController@store');
    Route::get('/users/{userEmail}',      'Api\v1\UserController@findUserByEmail');
    Route::put('/users/{user_id}',        'Api\v1\UserController@update');
    Route::delete('/users/{user_id}',     'Api\v1\UserController@destroy');
    
  });
