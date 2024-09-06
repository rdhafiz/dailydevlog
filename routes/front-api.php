<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Media\MediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Repository\UserAuthRepository;

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
    Route::post('get-profile', [UserAuthController::class, 'GetProfile'])->name('API.USER.GET.PROFILE');
    Route::post('update-profile', [UserAuthController::class, 'UpdateProfile'])->name('API.USER.UPDATE.PROFILE');
    Route::post('change-password', [UserAuthController::class, 'ChangePassword'])->name('API.USER.CHANGE.PASSWORD');
    Route::post('update-avatar', [UserAuthController::class, 'UpdateAvatar'])->name('API.USER.UPDATE.AVATAR');
    Route::get('logout', [UserAuthController::class, 'Logout'])->name('API.USER.LOGOUT');
});

/*Post API*/
Route::apiResource('posts', PostController::class );


/*Category API*/
Route::apiResource('categories', CategoryController::class );

/*Tags API*/
Route::apiResource('tags', TagController::class );


/*media api*/
Route::prefix('media')->group(function () {
    Route::post('/', [MediaController::class, 'store']); // Upload a new media file
    Route::get('{id}', [MediaController::class, 'show']); // View a media file
    Route::delete('{id}', [MediaController::class, 'destroy']); // Delete a media file
});
