<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$factory->define(App\User::class, function (Faker\Generator $faker) {
    $hasher = app()->make('hash');
    $apikey = (str_random(32));
    $token = (str_random(64));
    
    
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'username' => $faker->username,
        'password' => $hasher->make("secret"),
        'token' => $hasher->make($token),
        'api_key' => $apikey
        
    ];
});
