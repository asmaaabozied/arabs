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
Route::prefix('panel/employer/my-profile')->middleware('auth:employer')->group(function() {
//
    Route::get('/', 'Employer\EmployerProfileController@showMyProfile')->name('employer.show.my.profile');
    Route::get('edit-my-profile','Employer\EmployerProfileController@showUpdateMyProfileForm')->name('employer.show.edit.my.profile.form');
//    Route::post('update-my-profile', 'Employer\EmployerProfileController@updateMyProfile')->name('employer.update.my.profile');
//
});


Route::prefix('panel/employer/management-affairs/switch-account')->controller('Employer\SwitchingAccountController')->middleware(['auth:employer','employerProfileCompleted','enabledEmployer','IsEmployerVerifyEmail'])->group(function() {
    Route::post('/', 'switchToWorker')->name('employer.switch.account.to.worker');
//    Route::get('history','history')->name('employer.show.switching.account.history');
//    Route::get('employer-to-worker-with-transfer-wallet-balance','showSwitchToWorkerAndTransferWalletBalanceForm')->name('employer.show.switch.account.to.worker.with.transfer.wallet.balance.form');
//    Route::post('switch-to-worker-and-transfer-balance','switchToWorkerAndTransferWalletBalance')->name('employer.switch.account.to.worker.with.transfer.wallet.balance');

});

