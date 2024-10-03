<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    // ->as('admin.')
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
                Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])
                    ->name('destroy');
            });
        Route::get('index', function (){
            return view('admin.products.index');
        })->name('product.index');
    });
Route::get('/', function () {
    return view('client.home');
});
Route::get('/login', function () {
    return view('client.auth.login');
})->name('login');



