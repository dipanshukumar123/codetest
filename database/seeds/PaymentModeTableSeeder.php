<?php

use Illuminate\Database\Seeder;

class PaymentModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PaymentMode::class)->state('cash')->create();
        factory(App\PaymentMode::class)->state('knet')->create();
        factory(App\PaymentMode::class)->state('subscription')->create();
    }
}
