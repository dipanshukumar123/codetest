<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MasterCms;
use Faker\Generator as Faker;

$factory->state(MasterCms::class, 'about', [
    'name' => 'About',
]);

$factory->state(MasterCms::class, 'privacy-policy', [
    'name' => 'Privacy Policy',
]);

$factory->state(MasterCms::class, 'terms-conditions', [
    'name' => 'Terms & Conditions',
]);

$factory->define(MasterCms::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraphs(5,true)
    ];
});
