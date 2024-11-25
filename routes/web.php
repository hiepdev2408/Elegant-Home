<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ContactFormController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\MessageController;
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
    ->as('profile.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'profile')->name('user');
        Route::get('/order', 'order')->name('order');
        Route::get('/endow', 'endow')->name('endow');
        Route::get('/info', 'info')->name('info');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/order/cancel/{id}', 'cancel')->name('order.cancel');
        Route::get('/order/show/{id}', 'showDetailOrder')->name('order.showDetailOrder');
    });

Route::prefix('contact')
    ->controller(ContactFormController::class)
    ->group(function () {
        Route::get('/', 'contact')->name('contact');
        Route::post('/', 'submit')->name('contact.submit');
    });

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

Route::group([
    'middleware' => 'auth',
], function () {
    Route::prefix('chat')
        ->group(function () {
            Route::post('/create/{receiverId}', [ChatController::class, 'createOrRedirect'])
                ->name('chat.create');
            Route::get('/{roomId}/{receiverId}', [ChatController::class, 'showChatRoom'])
                ->name('chat.room');
        });

    Route::post('/messages/send', [ChatController::class, 'sendMessage'])
        ->name('messages.send');
});



Route::get('search/{id}', [HomeController::class, 'search'])->name('search');
