<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Spatie\Activitylog\Models\Activity;

Route::redirect('/', 'admin/login');

// Language
Route::get('lang/{lang}', 'LanguageController@update')->name('lang.update');

// Auth
Route::match(['get', 'head'], 'login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::match(['get', 'head'], 'register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::match(['get', 'head'], 'password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::match(['get', 'head'], 'password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::match(['get', 'head'], 'password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

Route::match(['get', 'head'], 'email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::match(['get', 'head'], 'email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Basic
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/my-profile/{user}/edit', 'MyProfileController@edit')->name('my-profile.edit')->middleware('verified:admin.verification.notice');
    Route::match(['put', 'patch', 'post'], '/my-profile/{user}', 'MyProfileController@update')->name('my-profile.update');
    Route::delete('/my-profile/{user}/avatar', 'MyProfileController@destroyAvatar')->name('my-profile.avatar.delete');

    Route::resource('/change-password', 'ChangePasswordController')->only(['edit', 'update'])->parameters(['change-password' => 'user']);

    Route::resource('/cms', 'CmsController')->only(['edit', 'update'])->parameters(['cms' => 'masterCms']);

    Route::resource('/settings', 'SettingController')->only(['edit', 'update'])->middleware(['password.confirm:admin.password.confirm']);
});

//Master
Route::middleware(['auth'])->group(function () {
    Route::resource('governorates', 'Master\GovernorateController');
    Route::resource('areas', 'Master\AreaController');
});

// Security
Route::middleware(['auth'])->prefix('security')->name('security.')->group(function () {
    Route::resource('/permissions', 'Security\PermissionController')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('/roles', 'Security\RoleController')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

// Users
Route::middleware(['auth'])->prefix('users')->name('users.')->group(function () {
    Route::match(['put', 'patch', 'post'], '/admins/{user}', 'Admin\AdminController@update')->name('admins.update');
    Route::match(['put', 'patch'], '/admins/{user}/restore', 'Admin\AdminController@restore')->name('admins.restore');
    Route::delete('/admins/{user}/avatar', 'Admin\AdminController@destroyAvatar')->name('admins.avatar.delete');
    Route::resource('/admins', 'Admin\AdminController')->only(['index', 'create', 'store', 'edit', 'destroy'])->parameters(['admins' => 'user']);
});

// M1
Route::middleware(['auth'])->prefix('m1')->name('m1.')->group(function () {
    Route::resource('/configurations', 'M1\ConfigurationController')->only(['edit', 'update'])->parameters(['configurations' => 'setting']);

    Route::match(['put', 'patch', 'post'], '/packages/{package}', 'M1\PackageController@update')->name('packages.update');
    Route::match(['put', 'patch'], '/packages/{package}/restore', 'M1\PackageController@restore')->name('packages.restore');
    Route::delete('/packages/{package}/image', 'M1\PackageController@destroyImage')->name('packages.image.delete');
    Route::resource('/packages', 'M1\PackageController')->only(['index', 'create', 'store', 'edit', 'destroy']);

    Route::match(['put', 'patch'], '/coupons/{coupon}/restore', 'M1\CouponController@restore')->name('coupons.restore');
    Route::resource('/coupons', 'M1\CouponController')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::match(['get', 'head'], '/calendar', 'M1\CalendarController@index')->name('calendar.index');

    Route::match(['put', 'patch'], '/classes/{class}/restore', 'M1\ClassController@restore')->name('classes.restore');
    Route::resource('/classes', 'M1\ClassController')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('classes.cycles', 'M1\ClassCycleController')->only(['index', 'update']);

    Route::resource('classes.schedule', 'M1\ScheduleController')->only(['index', 'store', 'edit', 'update', 'destroy']);
});

// Mail
Route::middleware(['auth'])->group(function () {
    Route::get('/mail/render', function () {
        return (new \App\Mail\Welcome(auth()->user()))->render();
    });

    Route::get('/mail/mailable', function () {
        return new App\Mail\Welcome(auth()->user());
    });

    Route::get('/mail/send', function () {
        Mail::to(auth()->user())->send(new \App\Mail\Welcome(auth()->user()));

        return 'Ok';
    });
});

// DB Notification
Route::middleware(['auth'])->group(function () {
    Route::get('/notification/db', function () {
        auth()->user()->notify(new \App\Notifications\SimpleDBNotification());

        return 'Ok';
    });

    Route::get('/notification/db/list', function () {
        return auth()->user()->notifications;
    });

    Route::get('/notification/db/unread', function () {
        return auth()->user()->unreadNotifications;
    });
});

// OneSignal Notification
Route::middleware(['auth'])->group(function () {
    Route::get('/notification/onesignal', function () {
        auth()->user()->notify(new \App\Notifications\SimpleOneSignalNotification());

        return 'Ok';
    });
});

// FutureClub SMS Notification
Route::middleware(['auth'])->group(function () {
    Route::get('/sms/send', function () {
        auth()->user()->notify(new \App\Notifications\PhoneVerificationOTP());

        return 'Ok';
    });
});

// Activity Log
Route::middleware(['auth'])->group(function () {
    Route::get('/activity/log', function () {
        activity()
            ->inLog('default')
            ->on(\App\Classes::find(2))
            ->by(\App\User::find(1))
            ->withProperties([
                'key' => 'value'
            ])
            ->tap(function (Activity $activity) {
                $activity->description_ar = 'description ar';
            })
            ->log('Look mum, I logged something');

//        $lastActivity = Activity::all()->last();
//        $lastActivity->subject
//        $lastActivity->causer
//        $lastActivity->description;

        print_r(Activity::where('log_name', 'default')->where('properties->key', 'value')->get()->toJson(JSON_PRETTY_PRINT));
    });
});
