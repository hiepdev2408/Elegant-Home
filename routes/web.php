<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('client.home');
});

Route::group(['prefix' => 'account'], function () {
    Route::get('/login', [AccountController::class, 'login'])->name('login');
    Route::post('/login_check', [AccountController::class, 'check_login'])->name('login.submit');

    Route::get('/register', [AccountController::class, 'register'])->name('register');
    Route::post('/register_check', [AccountController::class, 'check_register'])->name('register.submit');

    Route::get('/veryfy_account/{email}', [AccountController::class, 'veryfy'])->name('veryfy');

    Route::get('/password/forgot', [AccountController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/password/email', [AccountController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('/password/reset/{token}', [AccountController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AccountController::class, 'reset'])->name('password.update');
});

Route::get('admin', function () {
    return view('admin.dashboard');
});
