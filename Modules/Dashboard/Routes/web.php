<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
\Illuminate\Support\Facades\Session::put('applocale','en');

Route::prefix('panel')->controller('AuthController')->group(function() {
    Route::get('sign-in', 'showLoginForm')->name('show.login.form');
    Route::post('authentication', 'authentication')->name('signing.in.to.panel');
    Route::get('refresh-captcha', 'refreshCaptcha')->name('refreshCaptcha');

    Route::get('sign-up', 'showSignUpForm')->name('show.sign.up.form');
    Route::post('signing-up', 'signingUp')->name('signing.to.arab.workers');
    Route::post('fetch-cities', 'fetchCity')->name('fetch.cities.when.sign.up');
});
