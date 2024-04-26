<?php

use App\Http\Controllers\ajax\ajaxServiceController;
use App\Http\Controllers\ajax\ajaxTranslateController;
use App\Http\Controllers\user\orderUserController;
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

Route::get('/get-service-type', [ajaxServiceController::class, 'getServiceTypeAjax']);

Route::post('/translate', [ajaxTranslateController::class, 'translateLang']);
Route::get('/translate', [ajaxTranslateController::class, 'translateLang']);
