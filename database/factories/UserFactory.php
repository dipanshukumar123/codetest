<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->state(User::class, 'super-admin', [
    'type' => 1,
    'first_name' => 'Super',
    'last_name' => 'Admin',
    'mobile' => '11111111',
    'email' => 'superadmin@domain.com'
]);

$factory->state(User::class, 'admin', [
    'type' => 1,
    'first_name' => 'Test',
    'last_name' => 'Admin',
    'mobile' => '22222222',
    'email' => 'admin@domain.com'
]);

$factory->state(User::class, 'coach', [
    'type' => 2,
    'coach_type' => 1,
    'first_name' => 'Test',
    'last_name' => 'Coach',
    'mobile' => '33333333',
    'email' => 'coach@domain.com'
]);

$factory->state(User::class, 'member', [
    'type' => 3,
    'first_name' => 'Test',
    'last_name' => 'Member',
    'mobile' => '44444444',
    'email' => 'member@domain.com'
]);

$factory->state(User::class, 'guest', [
    'type' => 4,
    'first_name' => 'Test',
    'last_name' => 'Guest',
    'mobile' => '55555555',
    'email' => 'guest@domain.com'
]);

$factory->define(User::class, function (Faker $faker) {
    return [
        'civil_id_number' => $faker->uuid,
        'gender' => 1,
        'status' => 1,
        'email_verified_at' => now(),
        'password' => Hash::make('12345678'), // password
        'remember_token' => Str::random(10),
    ];
});
