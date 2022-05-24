<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Package::class)->state('spinning-cycle')->create();
        factory(App\Package::class)->state('personal-training')->create();
        factory(App\Package::class)->state('group-class')->create();
    }
}
