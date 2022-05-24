<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingsTableSeeder::class,
            MasterCmsTableSeeder::class,
            UsersTableSeeder::class,
            RolesAndPermissionsTableSeeder::class,
            PackagesTableSeeder::class,
            CouponTableSeeder::class,
            ClassTableSeeder::class,
            PaymentModeTableSeeder::class,
            GovernorateSeeder::class,
            AreaSeeder::class
        ]);
    }
}
