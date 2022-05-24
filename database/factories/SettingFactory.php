<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        'name' => 'X Studio',
        'short_name' => 'XS',
        'working_days' => [0, 1, 2, 3, 4, 5, 6],
        'start_time' => '09:00:00',
        'end_time' => '21:00:00',
        'phone' => '94030546',
        'email' => 'info@domain.com',
        'address' => 'Kuwait',
        'version' => 'V1.0',
        'min_slot_duration' => 30,
        'm1_num_seats' => 26,
        'm1_seat_price' => 10.000,
        'm1_floor_price' => 250.000,
        'm1_commission' => 5.000,
        'm1_booking_offset' => 30,
        'm1_cancellation_offset' => 30,
        'm1_reminder_notification_offset' => 30,
        'm2_individual_price' => 5.000,
        'm2_couple_price' => 10.000,
        'm2_coach_individual_price' => 10.000,
        'm2_coach_couple_price' => 20.000,
        'm2_num_classes_per_slot' => 4,
        'm2_booking_offset' => 30,
        'm2_cancellation_offset' => 30,
        'm2_reminder_notification_offset' => 30,
        'm3_seat_price' => 30,
        'm3_floor_price' => 100.000,
        'm3_commission' => 5.000,
        'm3_booking_offset' => 30,
        'm3_cancellation_offset' => 30,
        'm3_reminder_notification_offset' => 30
    ];
});
