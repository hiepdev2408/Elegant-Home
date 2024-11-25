<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ContactFormController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ShopController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('account')
    ->controller(AccountController::class)
    ->group(function () {
        // Authentication Routes
        Route::get('/login', 'login')->name('login');
        Route::post('/login_check', 'check_login')->name('login.submit');
        Route::get('/register', 'register')->name('register');
        Route::post('/register_check', 'check_register')->name('register.submit');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/veryfy_account/{email}', 'veryfy')->name('veryfy');

        // Password Reset Routes
        Route::prefix('password')->group(function () {
            Route::get('/reset', 'showForgotPasswordForm')->name('password.request');
            Route::post('/email', 'sendResetLinkEmail')->name('password.email');
            Route::get('/reset/{token}', 'showResetForm')->name('password.reset');
            Route::post('/reset', 'reset')->name('password.update');
        });

        // Favorite Routes
        Route::prefix('favorite')->group(function () {
            Route::get('/', 'showFavorite')->name('show.favorite');
            Route::get('/count', 'favouriteCount')->name('favouriteCount');
            Route::delete('/delete/{id}', 'deleteFavorite')->name('deleteFavorite');
        });
    });

Route::prefix('smember')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('/', 'profile')->name('profile.user');
        Route::get('/order', 'order')->name('profile.order');
        Route::get('/endow', 'endow')->name('profile.endow');
        Route::get('/info', 'info')->name('profile.info');
        Route::post('/update/{id}', 'update')->name('profile.update');
    });

Route::prefix('contact')
    ->controller(ContactFormController::class)
    ->group(function () {
        Route::get('/', 'contact')->name('contact');
        Route::post('/', 'submit')->name('contact.submit');
    });

Route::get('/veryfy_account/{email}', [AccountController::class, 'veryfy'])->name('veryfy');

Route::get('password/reset', [AccountController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('password/email', [AccountController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AccountController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AccountController::class, 'reset'])->name('password.update');

// Profile
Route::prefix('profile')
    ->as('profile.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('user');
        Route::get('/show/{id}', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProfileController::class, 'update'])->name('update');
        Route::get('/order', [ProfileController::class, 'order'])->name('order');
        Route::post('/order/cancel/{id}', [ProfileController::class, 'cancel'])->name('order.cancel');
        Route::get('/order/show/{id}', [ProfileController::class, 'showDetailOrder'])->name('order.showDetailOrder');
    });

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users', [UserController::class, 'show'])
    // ->middleware('users')
    ->name('users.show');

Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('/password/reset/{token}', [AccountController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AccountController::class, 'reset'])->name('password.update');
//favorite
Route::get('/favorite', [AccountController::class, 'showFavorite'])->name('show.favorite');
Route::get('/favourite/count', [AccountController::class, 'favouriteCount'])->name('favouriteCount');
Route::delete('/deleteFavorite/{id}', [AccountController::class, 'deleteFavorite'])->name('deleteFavorite');

Route::get('categories/{category_id}/product/{id}/{slug}', [HomeController::class, 'detail'])->name('productDetail');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/gird', [ShopController::class, 'gird'])->name('gird');

Route::get('/search', [ShopController::class, 'shopFilter'])->name('shop.search');
Route::get('/categories/{category_id}', [ShopController::class, 'shopFilter'])->name('shop.categoryProduct');
Route::get('/filter', [ShopController::class, 'shopFilter'])->name('shop.filter');


Route::get('productDetail/{slug}', [HomeController::class, 'detail'])->name('productDetail');
Route::post('/comments', [HomeController::class, 'store'])->name('comments');

Route::get('favourite/{id}', [HomeController::class, 'favourite'])->name('favourite');

//cart
Route::group([
    'middleware' => 'auth',
], function () {
    Route::post('addToCart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('listCart', [CartController::class, 'listCart'])->name('listCart');
    Route::put('cart/update', [CartController::class, 'updateCartQuantity'])->name('updateCartQuantity');
    Route::post('cart/apply-voucher', [CartController::class, 'applyVoucher'])->name('cart.applyVoucher');
    Route::put('cart/update', [CartController::class, 'updateCartQuantity'])->name('updateCartQuantity');
    Route::get('order', [OrderController::class, 'index'])->name('index.Order');
    Route::post('order/apply-voucher', [OrderController::class, 'applyVoucher'])->name('order.applyVoucher');
    // Web routes
    Route::get('/districts/{provinceCode}', [OrderController::class, 'getDistrictsByProvince']);
    Route::get('/wards/{districtCode}', [OrderController::class, 'getWardsByDistrict']);

    // Checkout
    Route::post('payment', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('defaultView', [CheckoutController::class, 'defaultView'])->name('defaultView');
});

// Search sản phẩm cùng danh mục
Route::get('search/{id}', [HomeController::class, 'search'])->name('search');
