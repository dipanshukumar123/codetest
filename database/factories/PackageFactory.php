<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Package;
use Faker\Generator as Faker;

$factory->state(Package::class, 'spinning-cycle', [
    'module' => 1,
    'name' => '12 Spinning Classes'
]);

$factory->state(Package::class, 'personal-training', [
    'module' => 2,
    'name' => '12 Personal Training Classes'
]);

$factory->state(Package::class, 'group-class', [
    'module' => 3,
    'name' => '12 Group Classes'
]);

$factory->define(Package::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraphs(2, true),
        'num_classes' => 12,
        'price' => 120,
        'validity' => 30,
        'validity_label' => '1 Month',
        'app_visibility' => 1,
        'status' => 1
    ];
});
