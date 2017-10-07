<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
   $hasher = app()->make('hash');
    $apikey = (str_random(48));
    $token = (str_random(64));
    
    
    
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'username' => $faker->username,
        'password' => $hasher->make("secret"),
        'api_key' => $apikey,
        'remember_token' => $token
        
    ];
});
