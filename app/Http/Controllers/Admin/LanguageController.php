<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function update($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('locale', $lang);
        }

        return Redirect::back();
    }
}
