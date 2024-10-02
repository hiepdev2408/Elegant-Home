<?php

use App\Http\Controllers\UserController;
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
Route::prefix('admin')->as('admin.')->group(function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::resource('users', UserController::class);
});
Route::get('admin', function () {
    return view('admin.dashboard');
});
