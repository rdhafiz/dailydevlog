<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostNewController;
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

    Route::post('login-new', [UserAuthController::class, 'LoginNew'])->name('API.USER.LOGIN.NEW');
    Route::post('forgot-new', [UserAuthController::class, 'ForgotNew'])->name('API.USER.FORGOT.NEW');
    Route::post('reset-new', [UserAuthController::class, 'ResetNew'])->name('API.USER.RESET.NEW');
    Route::post('refresh', [UserAuthController::class, 'refresh'])->name('API.USER.REFRESH.TOKEN');
});

Route::group(['prefix' => 'user'], function () {
    Route::post('me', [UserAuthController::class, 'me'])->name('API.USER.ME');
    Route::post('get-profile', [UserAuthController::class, 'GetProfile'])->name('API.USER.GET.PROFILE');
    Route::post('update-profile', [UserAuthController::class, 'UpdateProfile'])->name('API.USER.UPDATE.PROFILE');
    Route::post('update-profile-new', [UserAuthController::class, 'UpdateProfileNew'])->name('API.USER.UPDATE.PROFILE.NEW');
    Route::post('change-password', [UserAuthController::class, 'ChangePassword'])->name('API.USER.CHANGE.PASSWORD');
    Route::post('change-password-new', [UserAuthController::class, 'ChangePasswordNew'])->name('API.USER.CHANGE.PASSWORD.New');
    Route::post('update-avatar', [UserAuthController::class, 'UpdateAvatar'])->name('API.USER.UPDATE.AVATAR');
    Route::post('update-avatar-new', [UserAuthController::class, 'UpdateAvatarNew'])->name('API.USER.UPDATE.AVATAR.NEW');
    Route::get('logout', [UserAuthController::class, 'Logout'])->name('API.USER.LOGOUT');
    Route::post('logout-new', [UserAuthController::class, 'LogoutNew'])->name('API.USER.LOGOUT.NEW');
});

/*Post API*/
Route::apiResource('posts', PostController::class );
Route::apiResource('posts-new', PostNewController::class );
Route::post('posts/store', [PostController::class, 'store'] )->name('posts.store');
Route::post('posts/update/{id}', [PostController::class, 'update'] )->name('posts.update');

/*Tags API*/
Route::apiResource('tags', TagController::class );
Route::get('increment-views/{id}', [PostController::class, 'views_increment'])->name('post.single.increment.views');

/*media api*/
Route::prefix('media')->group(function () {
    Route::post('/', [MediaController::class, 'store']); // Upload a new media file
    Route::get('{id}', [MediaController::class, 'show']); // View a media file
    Route::delete('{id}', [MediaController::class, 'destroy']); // Delete a media file
});
