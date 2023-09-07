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

Route::controller('GoogleController')->group(function() {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.using.google');
    Route::get('authorized/google/callback', 'handleGoogleCallback')->name('handle.authentication.using.google');
    Route::post('set/auth/type/{authType}/{tempGoogleAccountID}', 'setAuthType')->name('set.auth.google.type');
});
