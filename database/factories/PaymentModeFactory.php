<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PaymentMode;
use Faker\Generator as Faker;

$factory->state(PaymentMode::class, 'cash', [
    'name' => 'Cash'
]);

$factory->state(PaymentMode::class, 'knet', [
    'name' => 'Knet'
]);

$factory->state(PaymentMode::class, 'subscription', [
    'name' => 'Subscription'
]);

$factory->define(PaymentMode::class, function (Faker $faker) {
    return [
        //
    ];
});
