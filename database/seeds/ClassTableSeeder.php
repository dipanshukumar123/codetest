<?php

use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Classes::class)->state('spinning-cycle')->create([
            'name' => 'Sweat Cycle',
            'seat_price' => 10.000,
            'floor_price' => 260.0000,
            'duration' => 60,
            'duration_label' => 'One Hour'
        ])->classCycles()->createMany(factory(App\ClassCycle::class, 26)->make()->each(function ($items, $key) {
            $items->name = 'Cycle' . ($key + 1);
            $items->position = $key + 1;
        })->toArray());

        factory(App\Classes::class)->state('spinning-cycle')->create([
            'name' => 'Spin Cycle',
            'seat_price' => 5.000,
            'floor_price' => 130.0000,
            'duration' => 60,
            'duration_label' => 'One Hour'
        ])->classCycles()->createMany(factory(App\ClassCycle::class, 26)->make()->each(function ($items, $key) {
            $items->name = 'Cycle ' . ($key + 1);
            $items->position = $key + 1;
        })->toArray());

        factory(App\Classes::class)->state('personal-training')->create([
            'name' => 'Personal Training',
            'duration' => 60,
            'duration_label' => 'One Hour'
        ]);

        factory(App\Classes::class)->state('group-class')->create([
            'name' => 'Zumba',
            'seat_price' => 10.000,
            'floor_price' => 80.0000,
            'duration' => 60,
            'duration_label' => 'One Hour'
        ]);

        factory(App\Classes::class)->state('group-class')->create([
            'name' => 'Power Yoga',
            'seat_price' => 10.000,
            'floor_price' => 80.0000,
            'duration' => 60,
            'duration_label' => 'One Hour'
        ]);
    }
}
