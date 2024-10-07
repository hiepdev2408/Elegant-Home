<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->group(function () {
        Route::get('/', function () {
            return view(view: 'admin.dashboard');
        });
        Route::resource('users', UserController::class);

        Route::prefix('categories')
            ->name('categories.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])
                    ->name('index');
                Route::get('/delete', [CategoryController::class, 'delete'])
                    ->name('delete');
                Route::get('/create', [CategoryController::class, 'create'])
                    ->name('create');
                Route::post('/store', [CategoryController::class, 'store'])
                    ->name('store');
                Route::get('/show/{category}', [CategoryController::class, 'show'])
                    ->name('show');
                Route::get('/edit/{category}', [CategoryController::class, 'edit'])
                    ->name('edit');
                Route::put('/update/{category}', [CategoryController::class, 'update'])
                    ->name('update');

                Route::post('/delete/{category}', [CategoryController::class, 'restore'])
                    ->name('restore');
                Route::delete('/forceDelete/{category}', [CategoryController::class, 'forceDelete'])
                    ->name('forceDelete');
                Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])
                    ->name('destroy');
            });
        Route::get('index', function () {
            return view('admin.products.index');
        })->name('product.index');
    });
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
