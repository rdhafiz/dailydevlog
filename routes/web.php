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
Route::get('/blogs/{id}', [UserPanelController::class, 'managePost'])->name('user.panel.manage.post');
Route::get('/categories', [UserPanelController::class, 'categories'])->name('user.panel.categories');
Route::get('/categories/{id}', [UserPanelController::class, 'manageCategory'])->name('user.panel.manage.category');
Route::get('/blogs', [UserPanelController::class, 'post'])->name('user.panel.post');

Route::group(
    ['middleware' => 'LoginCheck'],
    function () {

        Route::get('/login', [UserPanelController::class, 'login'])->name('user.panel.login');
        Route::get('/forget-password', [UserPanelController::class, 'forgetPassword'])->name('user.panel.forget.password');

        Route::get('/profile', [UserPanelController::class, 'profile'])->name('user.panel.profile');
        Route::get('/my-blogs', [UserPanelController::class, 'my_post'])->name('user.panel.my.post');

    }
);
