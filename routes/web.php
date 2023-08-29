<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard::layouts.employer.master');
});
Route::get('login', function () {
    return view('dashboard::layouts.auth.login');
});
Route::get('signup', function () {
    return view('dashboard::layouts.auth.signup');
});
Route::get('home', function () {
    return view('home::layouts.homeContent');
});
Route::get('connect', function () {
    return view('home::layouts.ConnectWithUs');
});
Route::get('Marketing', function () {
    return view('home::layouts.AffiliateMarketing');
});

Route::get('blog', function () {
    return view('home::layouts.blog');
});
Route::get('workInInternet', function () {
    return view('home::layouts.workInInternet');
});
Route::get('faq', function () {
    return view('home::layouts.faq');
});

Route::get('whoAreWe', function () {
    return view('home::layouts.whoAreWe');
});

