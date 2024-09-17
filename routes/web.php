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

// Home page
Route::get('', [UserPanelController::class, 'index'])->name('user.panel.home');

// Log details page
Route::get('/blog-details/{id}', [UserPanelController::class, 'blogDetails'])->name('user.panel.blog.details');

// Search log page
Route::get('/search-blogs', [UserPanelController::class, 'search_post'])->name('user.panel.search.post');

// Featured log page
Route::get('/featured-blogs', [UserPanelController::class, 'feature_post'])->name('user.panel.feature.post');

// Latest log page
Route::get('/latest-blogs', [UserPanelController::class, 'latest_post'])->name('user.panel.latest.post');

// Most viewed log page
Route::get('/most-viewed-blogs', [UserPanelController::class, 'most_viewed_post'])->name('user.panel.most.viewed.post');

// User log page where use can see his or her every content non filtered post
Route::get('/blogs', [UserPanelController::class, 'post'])->name('user.panel.post');

// Login check that analysis user checked or not checked
Route::group(
    ['middleware' => 'LoginCheck'],
    function () {

        // Authentication pages
        Route::get('login', [UserPanelController::class, 'login'])->name('user.panel.login');
        Route::get('/forgot-password', [UserPanelController::class, 'forgotPassword'])->name('user.panel.forgot.password');
        Route::get('/reset-password', [UserPanelController::class, 'resetPassword'])->name('user.panel.reset.password');

        // User pages
        Route::get('/create-log', [UserPanelController::class, 'createPost'])->name('user.panel.create.post');
        Route::get('/edit-logs/{id}', [UserPanelController::class, 'editPost'])->name('user.panel.edit.post');
        Route::get('/profile', [UserPanelController::class, 'profile'])->name('user.panel.profile');
        Route::get('/my-blogs', [UserPanelController::class, 'my_post'])->name('user.panel.my.post');

    }
);
