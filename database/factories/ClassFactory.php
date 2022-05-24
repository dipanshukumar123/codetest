<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classes;
use Faker\Generator as Faker;

$factory->state(Classes::class, 'spinning-cycle', [
    'module' => 1,
    'num_seats' => 26
]);

$factory->state(Classes::class, 'personal-training', [
    'module' => 2,
    'num_seats' => 2
]);

$factory->state(Classes::class, 'group-class', [
    'module' => 3,
    'num_seats' => 8
]);

$factory->define(Classes::class, function (Faker $faker) {
    return [
        'app_visibility' => 1,
        'status' => 1
    ];
});
