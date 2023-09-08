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

Route::prefix('panel/worker/my-profile')->middleware('auth:worker')->group(function() {
//
    Route::get('/', 'Worker\WorkerProfileController@showMyProfile')->name('worker.show.my.profile');
    Route::get('edit-my-profile','Worker\WorkerProfileController@showUpdateMyProfileForm')->name('worker.show.edit.my.profile.form');
//    Route::post('update-my-profile', 'Worker\WorkerProfileController@updateMyProfile')->name('worker.update.my.profile');
//
});
Route::prefix('panel/worker/management-affairs/switchAccount')->controller('Worker\SwitchingAccountController')->middleware(['auth:worker','workerProfileCompleted','enabledWorker','IsWorkerVerifyEmail'])->group(function() {
    Route::post('/', 'switchToEmployer')->name('worker.switch.account.to.employer');
//    Route::get('history','history')->name('worker.show.switching.account.history');
//    Route::get('worker-to-employer-with-transfer-wallet-balance','showSwitchToEmployerAndTransferWalletBalanceForm')->name('worker.show.switch.account.to.employer.with.transfer.wallet.balance.form');
//    Route::post('switch-to-employer-and-transfer-balance','switchToEmployerAndTransferWalletBalance')->name('worker.switch.account.to.employer.with.transfer.wallet.balance');

});
