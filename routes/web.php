<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ContactFormController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ShopController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', function (){
//     return view('client.layouts.master');
// });

Route::group(['prefix' => 'account'], function () {

    Route::get('/login', [AccountController::class, 'login'])->name('login');
    Route::post('/login_check', [AccountController::class, 'check_login'])->name('login.submit');

    Route::get('/register', [AccountController::class, 'register'])->name('register');
    Route::post('/register_check', [AccountController::class, 'check_register'])->name('register.submit');

    //Logout
    Route::get('/logout', [AccountController::class, 'logout'])->name('logout');


    Route::get('/veryfy_account/{email}', [AccountController::class, 'veryfy'])->name('veryfy');

    Route::get('password/reset', [AccountController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('password/email', [AccountController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AccountController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AccountController::class, 'reset'])->name('password.update');
    Route::get('/profile', [ProfileController::class, 'profile'])
        // ->middleware('auth')
        ->name('profile.user');

    Route::get('/profile/show/{id}', [ProfileController::class, 'show'])
        // ->middleware('auth')
        ->name('profile.show');

    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

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
});

Route::group(['prefix' => 'contact'], function () {
    Route::get('/', [ContactFormController::class, 'contact'])->name('contact');
    Route::post('/', [ContactFormController::class, 'submit'])->name('contact.submit');
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
    Route::put('cart/update', [CartController::class, 'updateCartQuantity'])->name( 'updateCartQuantity');
    Route::get('order', [OrderController::class, 'index' ])->name('index.Order');
    Route::post('order/apply-voucher', [OrderController::class, 'applyVoucher'])->name('order.applyVoucher');
    Route::post('payment', [OrderController::class, 'checkout'])->name('checkout');
});

// Search sản phẩm cùng danh mục
Route::get('search/{id}', [HomeController::class, 'search'])->name('search');

