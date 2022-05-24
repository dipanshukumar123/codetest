<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('app:prepare', function () {
    exec('(cd public/themes/AdminLTE && npm i)');
    exec('php artisan migrate:fresh --seed');
    exec('php artisan config:clear');
    exec('php artisan permission:cache-reset');
    exec('php artisan key:generate');
    exec('php artisan storage:link');
    exec('php artisan passport:install');
    exec('php artisan passport:keys');
})->describe('Prepare the app to run');

Artisan::command('db:fresh', function () {
    exec('php artisan migrate:fresh --seed');
    exec('php artisan passport:install');
})->describe('Make fresh database');
