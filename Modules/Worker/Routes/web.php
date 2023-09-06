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

Route::prefix('panel/worker')->controller('Dashboard\WorkerDashboardController')->middleware('auth:worker')->group(function () {

    Route::get('/', 'index')->name('show.worker.panel');
    Route::post('log-out', 'logout')->name('worker.logout');
});

//Route::prefix('panel/worker/my-profile')->middleware('auth:worker')->group(function() {
//
//    Route::get('/', 'Worker\WorkerProfileController@showMyProfile')->name('worker.show.my.profile');
//    Route::get('edit-my-profile','Worker\WorkerProfileController@showUpdateMyProfileForm')->name('worker.show.edit.my.profile.form');
//    Route::post('update-my-profile', 'Worker\WorkerProfileController@updateMyProfile')->name('worker.update.my.profile');
//
//});
