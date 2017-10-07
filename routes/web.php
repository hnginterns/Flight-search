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

    Route::get('user',                    'Api\v1\UserController@index');
    Route::post('users',                  'Api\v1\UserController@store');
    Route::get('/users/{id}',             'Api\v1\UserController@show');
    Route::get('email/users',       'Api\v1\UserController@findUserByEmail');
    Route::delete('/users/{user_id}',     'Api\v1\UserController@destroy');
    
  });


Route::get('/autocomplete', function () {

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('user/gettoken/{id}/{remember_token}', 'UsersController@gettoken');
