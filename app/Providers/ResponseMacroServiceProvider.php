<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($message, $data = null, $status = 200) {
            return Response::json([
                'status' => 'ok',
                'message' => $message,
                'data' => $data,
            ], $status);
        });

        Response::macro('error', function ($errors, $status = 400) {
            return Response::json([
                'status' => 'error',
                'errors' => $errors
            ], $status);
        });
    }
}
