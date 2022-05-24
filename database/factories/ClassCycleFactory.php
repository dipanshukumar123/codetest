<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ClassCycle;
use Faker\Generator as Faker;

$factory->define(ClassCycle::class, function (Faker $faker) {
    return [
        'status' => 1
    ];
});
