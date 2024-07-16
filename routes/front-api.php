<?php

use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [UserAuthController::class, 'Login'])->name('API.USER.LOGIN');
    Route::post('forgot', [UserAuthController::class, 'Forgot'])->name('API.USER.FORGOT');
    Route::post('reset', [UserAuthController::class, 'Reset'])->name('API.USER.RESET');
});

Route::group(['prefix' => 'user'], function () {
    Route::post('logout', [UserAuthController::class, 'Logout'])->name('API.USER.LOGOUT');
});




