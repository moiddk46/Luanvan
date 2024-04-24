<?php

use App\Http\Controllers\admin\customerAdminController;
use App\Http\Controllers\admin\homeAdminController;
use App\Http\Controllers\admin\orderAdminController;
use App\Http\Controllers\admin\priceRequestAdminController;
use App\Http\Controllers\admin\serviceAdminController;
use App\Http\Controllers\admin\staffAdminController;
use App\Http\Controllers\core\login;
use App\Http\Controllers\core\register;
use App\Http\Controllers\pay\paymentController;
use App\Http\Controllers\staff\calenderStaffController;
use App\Http\Controllers\staff\homeStaffController;
use App\Http\Controllers\staff\taskStaffController;
use App\Http\Controllers\user\homeUserController;
use App\Http\Controllers\user\orderUserController;
use App\Http\Controllers\user\priceRequestController;
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
    Route::prefix('order')->group(function () {
        Route::get('/initOrder', [orderAdminController::class, 'order'])->name('orderAdmin');
        Route::post('/updateStatusOrder', [orderAdminController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/detailOrder/{data}', [orderAdminController::class, 'detailOrder'])->name('detailOrder');
        Route::post('/updateDetailOrder', [orderAdminController::class, 'updateDetailOrder'])->name('updateDetailOrder');
        Route::get('/download/{data}', [orderAdminController::class, 'getDownload'])->name('downloadOrder');
    });
    Route::prefix('priceRequest')->group(function () {
        Route::get('/priceRequest', [priceRequestAdminController::class, 'priceRequest'])->name('priceRequestAdmin');
        Route::get('/detailPriceRequest/{data}', [priceRequestAdminController::class, 'detailPriceRequest'])->name('detailPriceRequest');
        Route::get('/download/{data}', [priceRequestAdminController::class, 'getDownload'])->name('download');
        Route::post('/updateDetailRequest', [priceRequestAdminController::class, 'updateDetailRequest'])->name('updateDetailRequest');
    });

    Route::prefix('service')->group(function () {
        Route::get('/allService', [serviceAdminController::class, 'getAllService'])->name('allService');
        Route::get('/detailService/{data}', [serviceAdminController::class, 'getDetailService'])->name('detailServiceAdmin');
        Route::post('/updateDetailService', [serviceAdminController::class, 'updateDetailService'])->name('updateDetailServiceAdmin');
        Route::get('/addService', [serviceAdminController::class, 'addService'])->name('addServiceAdmin');
        Route::post('/insertService', [serviceAdminController::class, 'insertService'])->name('insertService');
    });
    Route::prefix('customers')->group(function () {
        Route::get('/allCustomer', [customerAdminController::class, 'getAllCustomer'])->name('allCustomer');
    });
    Route::prefix('staff')->group(function () {
        Route::get('/allStaff', [staffAdminController::class, 'getAllStaff'])->name('allStaff');
    });
});

Route::prefix('user')->group(function () {
    Route::get('/service/{data}', [serviceUserController::class, 'initService'])->name('service');
    Route::get('/service/detail/{data}', [serviceUserController::class, 'detailService'])->name('detailService');
    Route::prefix('auth')->middleware('is_customers')->group(function () {
        Route::post('/order', [orderUserController::class, 'initOrder'])->name('order');
        Route::get('/priceRequest', [priceRequestController::class, 'listPriceRequest'])->name('priceRequestUser');
        Route::get('/cart', [orderUserController::class, 'listOrder'])->name('cart');
        Route::post('/priceRequest', [priceRequestController::class, 'initPriceRequest'])->name('priceRequest');
        Route::get('/detailPriceRequest/{data}', [priceRequestController::class, 'detailPriceRequest'])->name('detailPriceRequestUser');
        Route::get('/detailCart/{data}', [orderUserController::class, 'detailOrder'])->name('detailCart');
        Route::post('/payment', [paymentController::class, 'payment'])->name('payment');
        Route::get('/statusPayment', [paymentController::class, 'statusPayment'])->name('statusPayment');
        Route::get('/giveOrder/{data}', [orderUserController::class, 'giveOrder'])->name('giveOrder');
    });
});

Route::prefix('staff')->middleware('is_staff')->group(function () {
    Route::get('/home', [homeStaffController::class, 'home'])->name('indexStaff');
    Route::get('/task', [taskStaffController::class, 'index'])->name('task');
    Route::get('/doNotTask', [taskStaffController::class, 'doNotTask'])->name('taskDoNot');
    Route::get('/doneTask', [taskStaffController::class, 'doneTask'])->name('taskDone');
    Route::get('/allTask', [taskStaffController::class, 'allTask'])->name('allTask');
    Route::get('/detailTask/{data}', [taskStaffController::class, 'detailTask'])->name('detailTask');
    Route::post('/updateTask', [taskStaffController::class, 'updateTask'])->name('updateTask');
    Route::get('/download/{data}', [taskStaffController::class, 'getDownload'])->name('downloadTask');
    Route::get('/calendar', [calenderStaffController::class, 'home'])->name('calenderStaff');
});
