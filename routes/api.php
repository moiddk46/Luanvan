<?php

use App\Http\Controllers\admin\homeAdminController;
use App\Http\Controllers\admin\orderAdminController;
use App\Http\Controllers\admin\priceRequestAdminController;
use App\Http\Controllers\ajax\ajaxServiceController;
use App\Http\Controllers\ajax\ajaxTranslateController;
use App\Http\Controllers\staff\taskStaffController;
use App\Http\Controllers\user\orderUserController;
use App\Http\Controllers\user\serviceUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getPrice', [ajaxServiceController::class, 'getPriceService']);

Route::get('/getSumYear', [ajaxServiceController::class, 'getSumYear']);

Route::get('/static', [homeAdminController::class, 'static']);

Route::get('/searchService', [serviceUserController::class, 'searchService']);

Route::get('/searchOrder', [orderAdminController::class, 'orderSearch']);

Route::get('/searchPriceRequest', [priceRequestAdminController::class, 'priceRequestSearch']);

Route::get('/searchTask', [taskStaffController::class, 'searchTask']);

Route::get('/countTask', [taskStaffController::class, 'countTaskStaff']);
