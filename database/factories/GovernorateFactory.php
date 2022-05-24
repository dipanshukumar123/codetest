<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Governorate;
use Faker\Generator as Faker;

$factory->define(Governorate::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'status' => 1
    ];
});
