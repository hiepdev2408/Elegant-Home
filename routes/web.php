<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('client.home');
});
Route::group(['prefix'=>'account'],function(){
    Route::get('/login',[AccountController::class,'login'])->name('login');
    Route::post('/login_check',[AccountController::class,'check_login'])->name('login.submit');

    Route::get('/register',[AccountController::class,'register'])->name('register');
    Route::post('/register_check',[AccountController::class,'check_register'])->name('register.submit');

    Route::get('/veryfy_account/{email}',[AccountController::class,'veryfy'])->name('veryfy');


});

Route::get('admin', function () {
    return view('admin.dashboard');
});
