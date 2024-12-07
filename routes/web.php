<?php

use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ContactFormController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');


// ACCOUNT
Route::prefix('auth')
    ->controller(AccountController::class)
    ->group(function () {
        // Authentication Routes
        Route::get('/login', 'showFormLogin')->name('auth.login');
        Route::post('/login', 'login')->name('login');
        Route::get('/register', 'showFormRegister')->name('auth.register');
        Route::post('/register', 'register')->name('register');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/veryfy_account/{email}', 'veryfy')->name('veryfy');

        // Password Reset Routes
        Route::prefix('password')
            ->as('password.')
            ->group(function () {
            Route::get('/reset', 'showFormForgotPassword')->name('request');
            Route::post('/email', 'sendResetLinkEmail')->name('email');
            Route::get('/reset/{token}', 'showFormReset')->name('reset');
            Route::post('/reset', 'reset')->name('update');
        });

        // Favorite Routes
        Route::prefix('favorite')->group(function () {
            Route::get('/', 'showFavorite')->name('show.favorite');
            Route::get('/count', 'favouriteCount')->name('favouriteCount');
            Route::delete('/delete/{id}', 'deleteFavorite')->name('deleteFavorite');
        });
    });

// SMEMBER
Route::prefix('smember')
    ->controller(ProfileController::class)
    ->as('profile.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'profile')->name('user');
        Route::get('/order', 'order')->name('order');
        Route::get('/endow', 'endow')->name('endow');
        Route::get('/info', 'info')->name('info');
        Route::get('info/show/{id}', 'showProfile')->name('info.showProfile');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/order/cancel/{id}', 'cancel')->name('order.cancel');
        Route::post('/order/completed/{id}', 'completed')->name('order.completed');
        Route::post('/order/return_request/{id}', 'return_request')->name('order.return_request');
        Route::get('/order/show/{id}', 'showDetailOrder')->name('order.showDetailOrder');
        Route::get('/districts/{provinceCode}', [OrderController::class, 'getDistrictsByProvince']);
        Route::get('/wards/{districtCode}', [OrderController::class, 'getWardsByDistrict']);
    });

// POLICY
Route::get('policy', [ProfileController::class, 'policy'])->name('policy');

// CONTACT
Route::prefix('contact')
    ->controller(ContactFormController::class)
    ->group(function () {
        Route::get('/', 'contact')->name('contact');
        Route::post('/', 'submit')->name('contact.submit');
    });

Route::prefix('products')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('/', 'shop')->name('shop');
        Route::get('/gird', 'gird')->name('gird');
        Route::get('/search', 'shopFilter')->name('shop.search');
        Route::get('/categories/{category_id}', 'shopFilter')->name('shop.categoryProduct');
        Route::get('/filter', 'shopFilter')->name('shop.filter');
    });

Route::get('product/{slug}', [HomeController::class, 'detail'])->name('productDetail');
Route::post('/comments', [HomeController::class, 'store'])->name('comments');

Route::get('favourite/{id}', [HomeController::class, 'favourite'])->name('favourite');

//CART
Route::prefix('cart')
    ->middleware('auth')
    ->controller(CartController::class)
    ->group(function () {
        Route::post('addToCart', 'addToCart')->name('addToCart');
        Route::get('/', 'cart')->name('cart');
        Route::put('update/{id}', 'update')->name('cart.update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

//ORDER
Route::prefix('order')
    ->middleware('auth')
    ->controller(OrderController::class)
    ->group(function () {
        Route::get('/info', 'index')->name('order');
        Route::post('order/apply-voucher', 'applyVoucher')->name('order.applyVoucher');

        Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
        Route::get('/thank', [PaymentController::class, 'thank'])->name('thank');

        // Checkout
        Route::post('vnpay_payment', [PaymentController::class, 'vnpay'])->name('vnpay');
        Route::get('vnpayReturn', [PaymentController::class, 'vnpayReturn'])->name('vnpayReturn');
        Route::post('momo_payment', [PaymentController::class, 'momo'])->name('momo_payment');
        Route::post('cod', [PaymentController::class, 'cod'])->name('cod');
        Route::post('payment', [CheckoutController::class, 'checkout'])->name('checkout');
        Route::get('/checkout/thank', [PaymentController::class, 'thank'])->name('thank');
        Route::get('/checkout/error', [PaymentController::class, 'error'])->name('error');
        Route::post('/notify', [PaymentController::class, 'notify'])->name('notify');
    });

Route::group([
    'middleware' => 'auth',
], function () {
    // Web routes
    Route::get('/districts/{provinceCode}', [OrderController::class, 'getDistrictsByProvince']);
    Route::get('/wards/{districtCode}', [OrderController::class, 'getWardsByDistrict']);
});

//chat realtime
Route::group([
    'middleware' => 'auth',
], function () {
    Route::prefix('chat')
        ->group(function () {
            Route::post('/create/{receiverId}', [ChatController::class, 'createOrRedirect'])
                ->name('chat.create');
            Route::get('/{roomId}/{receiverId}', [ChatController::class, 'showChatRoom'])
                ->name('chat.room');
            Route::post('/outChat/{roomid}', [ChatController::class, 'outChat'])
                ->name('outChat');
        });

    Route::post('/messages/send', [ChatController::class, 'sendMessage'])
        ->name('messages.send');
});

Route::get('search/{id}', [HomeController::class, 'search'])->name('search');

