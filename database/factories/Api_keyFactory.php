<?php

use Faker\Generator as Faker;

$factory->define(App\Api_key::class, function (Faker $faker) {
    return [
        'api_key'=>md5(rand(0, 1000)).md5(rand(0, 1000))
    ];
});
