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
    Route::get('/users/{id}',             'Api\v1\UserController@show');
    Route::get('email/users',       'Api\v1\UserController@findUserByEmail');
    Route::delete('/users/{user_id}',     'Api\v1\UserController@destroy');
    
  });


Route::get('/autocomplete', function () {
 return app('App\Http\Controllers\IataCodeAutoCompleteController')->getCityDetails('CBQ');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('user/gettoken/{id}/{remember_token}', 'UsersController@gettoken');



Route::group(['prefix' => 'api/v1'], function () use ($router)  {
    Route::post('/tokens',                   'Api\v1\TokenController@index');

    Route::post('/cities',                   'Api\v1\IATAAutoCompleteController@index');
    
  });

<<<<<<< HEAD
Route::group(['prefix' => 'api/v1', 'namespace' => 'App\Http\Controllers'], function() use ($router)
  {
    Route::get('flight',                   'FlightController@index');
    Route::get('flight/{flightId}',         'FlightController@show');
  });
  
  
  
=======
/*
 \-----------------------------------------------------------------------------------------------\
 \ Routes for Trips Controller                                                                   \
 \------------------------------------------------------------------------------------------------\
 */
Route::group(['prefix' => 'trips/api/v1', 'namespace' => 'Api\V1'], function () {
  Route::post('/one-way', 'TripsController@singleTrip');
});
 

 
 
>>>>>>> 4bed3f959c8521e3ef4a88d92e87712e46f018db
