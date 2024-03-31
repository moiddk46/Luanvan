<?php

use App\Http\Controllers\admin\homeAdminController;
use App\Http\Controllers\admin\orderAdminController;
use App\Http\Controllers\admin\assignmentAdminController;
use App\Http\Controllers\core\login;
use App\Http\Controllers\core\register;
use App\Http\Controllers\user\homeUserController;
use App\Http\Controllers\user\orderUserController;
use App\Http\Controllers\user\serviceUserController;
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

Route::get('/', [homeUserController::class, 'home'])->name('index');

Route::prefix('core')->group(function () {
    Route::get('/login', [login::class, 'login'])->name('login');
    Route::get('/register', [register::class, 'register'])->name('register');
    Route::post('/register', [register::class, 'registerCreate'])->name('registerCreate');
    Route::post('/login', [login::class, 'checkLogin'])->name('checklogin');
    Route::get('/logout', [login::class, 'logout'])->name('logout');
});

Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('/home', [homeAdminController::class, 'home'])->name('indexAdmin');
    Route::get('/assignment', [assignmentAdminController::class, 'initAssignment'])->name('assignment');
    Route::prefix('order')->group(function () {
        Route::get('/initOrder', [orderAdminController::class, 'order'])->name('orderAdmin');
        Route::post('/updateStatusOrder', [orderAdminController::class, 'updateStatus'])->name('updateStatus');
    });
});

Route::prefix('user')->group(function () {
    Route::get('/service/{data}', [serviceUserController::class, 'initService'])->name('service');
    Route::get('/service/detail/{data}', [serviceUserController::class, 'detailService'])->name('detailService');
    Route::prefix('auth')->middleware('is_customers')->group(function () {
        Route::post('/order', [orderUserController::class, 'initOrder'])->name('order');
        Route::get('/cart', [orderUserController::class, 'listOrder'])->name('cart');
    });
});
