<?php

use App\Http\Controllers\user\homePage;
use App\Http\Controllers\user\servicePage;
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

Route::get('/', [homePage::class, 'header'])->name('index');
Route::prefix('user')->group(function () {
    Route::get('/service', [servicePage::class, 'initService'])->name('service');
});
