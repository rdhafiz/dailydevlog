<?php

use App\Http\Controllers\UserPanelController;
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

Route::get('', [UserPanelController::class, 'index'])->name('user.panel.home');
Route::get('/blog-details/{id}', [UserPanelController::class, 'blogDetails'])->name('user.panel.blog.details');
Route::get('/search-blogs', [UserPanelController::class, 'search_post'])->name('user.panel.search.post');
Route::get('/featured-blogs', [UserPanelController::class, 'feature_post'])->name('user.panel.feature.post');
Route::get('/latest-blogs', [UserPanelController::class, 'latest_post'])->name('user.panel.latest.post');
Route::get('/most-viewed-blogs', [UserPanelController::class, 'most_viewed_post'])->name('user.panel.most.viewed.post');
Route::get('/categories', [UserPanelController::class, 'categories'])->name('user.panel.categories');
Route::get('/categories/{id}', [UserPanelController::class, 'manageCategory'])->name('user.panel.manage.category');
Route::get('/blogs', [UserPanelController::class, 'post'])->name('user.panel.post');

Route::group(
    ['middleware' => 'LoginCheck'],
    function () {
        Route::get('login', [UserPanelController::class, 'login'])->name('user.panel.login');
        Route::get('/forgot-password', [UserPanelController::class, 'forgotPassword'])->name('user.panel.forgot.password');
        Route::get('/reset-password', [UserPanelController::class, 'resetPassword'])->name('user.panel.reset.password');
        Route::get('/create-log', [UserPanelController::class, 'createPost'])->name('user.panel.create.post');
        Route::get('/edit-logs/{id}', [UserPanelController::class, 'editPost'])->name('user.panel.edit.post');
        Route::get('/profile', [UserPanelController::class, 'profile'])->name('user.panel.profile');
        Route::get('/my-blogs', [UserPanelController::class, 'my_post'])->name('user.panel.my.post');
    }
);
