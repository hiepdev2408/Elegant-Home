<?php

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
    });
Route::get('/', function () {
    return view('client.home');
});

