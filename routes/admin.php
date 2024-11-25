<?php

use App\Http\Controllers\Admin\AttributeController;

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportWarehouseController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VouchersController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Client\ContactFormController;
use App\Helpers\Mail\ContactFormMail;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\ExportWarehousesController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', function () {
            return view(view: 'admin.dashboard');
        })->name('admin');

        // Đọc tất cả thông báo
        Route::prefix('notifications')
            ->group(function () {
            Route::post('/mark-read', [NotificationController::class, 'markRead'])->name('mark-read');
        });

        // Account
        Route::prefix('account')
            ->as('account.')
            ->group(function () {
            Route::get('listAdmin', [UserController::class, 'listAdmin'])->name('listAdmin');
            Route::get('listStaff', [UserController::class, 'listStaff'])->name('listStaff');
            Route::get('listCustomer', [UserController::class, 'listCustomer'])->name('listCustomer');
        });

        // Permission
        Route::prefix('permissions')
            ->as('permissions.')
            ->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('create', [PermissionController::class, 'create'])->name('create');
            Route::get('access/{id}', [PermissionController::class, 'access'])->name('access');
            Route::post('updateGant', [PermissionController::class, 'updateGant'])->name('updateGant');
            Route::post('store', [PermissionController::class, 'store'])->name('store');
            Route::get('show/{id}', [PermissionController::class, 'show'])->name('show');
            Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [PermissionController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy');
        });

        // Role
        Route::prefix('roles')
            ->as('roles.')
            ->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('create', [RoleController::class, 'create'])->name('create');
            Route::post('store', [RoleController::class, 'store'])->name('store');
            Route::get('show/{id}', [RoleController::class, 'show'])->name('show');
            Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [RoleController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
        });

        // Products
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
            Route::get('/warehouse', [ProductController::class, 'warehouse'])->name('warehouse');
            Route::put('updateStock/{variant}', [ProductController::class, 'updateStock'])->name('updateStock');
        });

        // Category
        Route::prefix('categories')
            ->name('categories.')
            ->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/delete', [CategoryController::class, 'delete'])->name('delete');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->middleware(['category.validation'])->name('store');
            Route::get('/show/{category}', [CategoryController::class, 'show'])->name('show');
            Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{category}', [CategoryController::class, 'update'])->middleware(['category.validation'])->name('update');

            Route::post('/delete/{category}', [CategoryController::class, 'restore'])->name('restore');
            Route::delete('/forceDelete/{category}', [CategoryController::class, 'forceDelete'])->name('forceDelete');
            Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        // Blogs
        Route::prefix('blogs')
            ->name('blogs.')
            ->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/delete', [BlogController::class, 'delete'])->name('delete');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/store', [BlogController::class, 'store'])->name('store');
            Route::get('/show/{blog}', [BlogController::class, 'show'])->name('show');
            Route::get('/edit/{blog}', [BlogController::class, 'edit'])->name('edit');
            Route::put('/update/{blog}', [BlogController::class, 'update'])->name('update');

            Route::post('/delete/{blog}', [BlogController::class, 'restore'])->name('restore');
            Route::delete('/forceDelete/{blog}', [BlogController::class, 'forceDelete'])->name('forceDelete');
            Route::delete('/delete/{blog}', [BlogController::class, 'destroy'])->name('destroy');
        });

        // Attribute
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

        // Attribute values
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

        // Vouchers
        Route::prefix('vouchers')
            ->as('vouchers.')
            ->group(function () {
            Route::get('/', [VouchersController::class, 'index'])->name('index');
            Route::get('create', [VouchersController::class, 'create'])->name('create');
            Route::post('store', [VouchersController::class, 'store'])->name('store');
            Route::get('edit/{id}', [VouchersController::class, 'edit'])->name('edit');
            Route::get('show/{id}', [VouchersController::class, 'show'])->name('show');
            Route::put('update/{id}', [VouchersController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [VouchersController::class, 'destroy'])->name('destroy');

        });

        // Contact
        Route::prefix('contact')
            ->as('contact.')
            ->group(function () {
            Route::get('/', [ContactFormController::class, 'index'])->name('index');
            Route::delete('destroy/{id}', [ContactFormController::class, 'destroy'])->name('destroy');
        });

        // Chatrealtime
        Route::get('/chat', function () {
            return view('admin.chat.index');
        })->name('chat');


        //warehouses
        Route::prefix('warehouses')
            ->as('warehouses.')
            ->group(function () {
            Route::get('/', [WarehouseController::class, 'index'])->name('index');
            Route::get('create', [WarehouseController::class, 'create'])->name('create');
            Route::post('store', [WarehouseController::class, 'store'])->name('store');
            Route::get('show/{id}', [WarehouseController::class, 'show'])->name('show');
        });
        //export warehouse
        Route::prefix('exportwarehouses')
            ->as('exportwarehouses.')
            ->group(function () {
            Route::get('/', [ExportWarehouseController::class, 'index'])->name('index');
            Route::get('create', [ExportWarehouseController::class, 'create'])->name('create');
            Route::post('store', [ExportWarehouseController::class, 'store'])->name('store');
            Route::get('show/{id}', [ExportWarehouseController::class, 'show'])->name('show');
        });

    });
