<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactFormController;
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

    Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/password/reset/{token}', [AccountController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [AccountController::class, 'reset'])->name('password.update');
});

Route::group(['prefix' => 'contact'], function () {
    Route::get('/contact', [ContactFormController::class, 'contact'])->name('contact');
    Route::post('/contact', [ContactFormController::class, 'submit'])->name('contact.submit');

});

Route::get('admin', function () {
    return view('admin.dashboard');
});
