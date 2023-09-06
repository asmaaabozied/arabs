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

Route::prefix('panel/employer')->controller('Dashboard\EmployerDashboardController')->middleware('auth:employer')->group(function () {

    Route::get('/', 'index')->name('show.employer.panel');
    Route::post('log-out', 'logout')->name('employer.logout');
});
//Route::prefix('panel/employer/my-profile')->middleware('auth:employer')->group(function() {
//
//    Route::get('/', 'Employer\EmployerProfileController@showMyProfile')->name('employer.show.my.profile');
//    Route::get('edit-my-profile','Employer\EmployerProfileController@showUpdateMyProfileForm')->name('employer.show.edit.my.profile.form');
//    Route::post('update-my-profile', 'Employer\EmployerProfileController@updateMyProfile')->name('employer.update.my.profile');
//
//});
