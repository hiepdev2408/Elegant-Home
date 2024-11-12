<?php

use App\Http\Controllers\Admin\AttributeController;

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\ContactFormController;
use App\Helpers\Mail\ContactFormMail;
use App\Http\Controllers\Admin\AttributeValueController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', function () {
            return view(view: 'admin.dashboard');
        })->name('admin');

        Route::resource('users', UserController::class);

        Route::prefix('products')
            ->as('products.')
            ->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('create', [ProductController::class, 'create'])->name('create');
                Route::post('store', [ProductController::class, 'store'])->name('store');
                Route::get('show/{id}', [ProductController::class, 'show'])->name('show');
                Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [ProductController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
            });

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
                    ->middleware(['category.validation'])
                    ->name('store');
                Route::get('/show/{category}', [CategoryController::class, 'show'])
                    ->name('show');
                Route::get('/edit/{category}', [CategoryController::class, 'edit'])
                    ->name('edit');
                Route::put('/update/{category}', [CategoryController::class, 'update'])
                    ->middleware(['category.validation'])
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
            Route::prefix('attribute_values')
            ->as('attribute_values.')
            ->group(function () {
                Route::get('/', [AttributeValueController::class, 'index'])->name('index');
                Route::get('create', [AttributeValueController::class, 'create'])->name('create');
                Route::post('store', [AttributeValueController::class, 'store'])->name('store');
                Route::get('edit/{id}', [AttributeValueController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [AttributeValueController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [AttributeValueController::class, 'destroy'])->name('destroy');
            });

        // Contact
        Route::prefix('contact')
            ->as('contact.')
            ->group(function () {
            Route::get('/', [ContactFormController::class, 'index'])->name('index');
            Route::delete('destroy/{id}', [ContactFormController::class, 'destroy'])->name('destroy');
        });

        Route::get('/chat', function () {
            return view('admin.chat.index');
        })->name('chat');
    });
