<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->states('super-admin')->create();
        factory(App\User::class)->states('admin')->create();
        factory(App\User::class)->states('coach')->create();
        factory(App\User::class)->states('member')->create();
        factory(App\User::class)->states('guest')->create();
    }
}
