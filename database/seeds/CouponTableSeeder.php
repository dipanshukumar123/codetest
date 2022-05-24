<?php

use Illuminate\Database\Seeder;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Coupon::class)->state('m1-package')->create();
        factory(App\Coupon::class)->state('m2-package')->create();
        factory(App\Coupon::class)->state('m3-package')->create();
    }
}
