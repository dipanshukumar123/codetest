<?php

use Illuminate\Database\Seeder;

class MasterCmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MasterCms::class)->state('about')->create();
        factory(App\MasterCms::class)->state('privacy-policy')->create();
        factory(App\MasterCms::class)->state('terms-conditions')->create();
    }
}
