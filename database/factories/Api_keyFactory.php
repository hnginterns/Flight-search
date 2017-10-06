<?php

use Faker\Generator as Faker;

$factory->define(App\Api_key::class, function (Faker $faker) {
    return [
        'api_key'=>bcrypt(rand(0, 1000))
    ];
});
