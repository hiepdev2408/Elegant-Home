<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactFormController;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard']);
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

        Route::prefix('blogs')
            ->name('blogs.')
            ->group(function () {
                Route::get('/', [BlogController::class, 'index'])
                    ->name('index');
                Route::get('/delete', [BlogController::class, 'delete'])
                    ->name('delete');
                Route::get('/create', [BlogController::class, 'create'])
                    ->name('create');
                Route::post('/store', [BlogController::class, 'store'])
                    ->name('store');
                Route::get('/show/{blog}', [BlogController::class, 'show'])
                    ->name('show');
                Route::get('/edit/{blog}', [BlogController::class, 'edit'])
                    ->name('edit');
                Route::put('/update/{blog}', [BlogController::class, 'update'])
                    ->name('update');

                Route::post('/delete/{blog}', [BlogController::class, 'restore'])
                    ->name('restore');
                Route::delete('/forceDelete/{blog}', [BlogController::class, 'forceDelete'])
                    ->name('forceDelete');
                Route::delete('/delete/{blog}', [BlogController::class, 'destroy'])
                    ->name('destroy');
            });
        Route::prefix('attributes')
            ->as('attributes.')
            ->group(function () {
                Route::get('/', [AttributeController::class, 'index'])->name('index');
                Route::get('create', [AttributeController::class, 'create'])->name('create');
                Route::post('store', [AttributeController::class, 'store'])->name('store');
                Route::get('edit/{id}', [AttributeController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [AttributeController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [AttributeController::class, 'destroy'])->name('destroy');

                Route::get('listDestroy', [AttributeController::class, 'delete'])->name('delete');
                // Hiển thị danh sách xóa

                Route::post('restore/{id}', [AttributeController::class, 'restore'])->name('restore');
                Route::delete('forceDelete/{id}', [AttributeController::class, 'forceDelete'])->name('forceDelete');
            });

        // Contact
        Route::prefix('contact')
            ->as('contact.')
            ->group(function () {
            Route::get('/', [ContactFormController::class, 'index'])->name('index');
            Route::delete('destroy/{id}', [ContactFormController::class, 'destroy'])->name('destroy');
        });

        Route::get('index', function () {
            return view('admin.products.index');
        })->name('product.index');
        Route::get('/chat', function () {
            return view('admin.chat.index');
        })->name('chat');
    });
