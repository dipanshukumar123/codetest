<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coupon;
use Faker\Generator as Faker;

$factory->state(Coupon::class, 'm1-package', [
    'module' => 1,
    'type' => 1
]);

$factory->state(Coupon::class, 'm2-package', [
    'module' => 2,
    'type' => 1
]);

$factory->state(Coupon::class, 'm3-package', [
    'module' => 3,
    'type' => 1
]);

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'name' => '25% Off',
        'code' => '25OFF',
        'discount_type' => 2,
        'discount' => 25,
        'start_date' => now(),
        'end_date' => now()->addDays(30),
        'total_usage' => 2,
        'usage_per_user' => 1,
        'status' => 1
    ];
});
