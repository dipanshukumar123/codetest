<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    static $governorate_id = 1;
    return [
        'governorate_id' => $governorate_id++,
        'title' => $faker->title,
        'status' => 1
    ];
});
