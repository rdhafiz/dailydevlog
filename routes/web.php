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
Route::get('/blog-details', [UserPanelController::class, 'blogDetails'])->name('user.panel.blog.details');
Route::get('/login', [UserPanelController::class, 'login'])->name('user.panel.login');
Route::get('/forget-password', [UserPanelController::class, 'forgetPassword'])->name('user.panel.forget.password');
Route::get('/profile', [UserPanelController::class, 'profile'])->name('user.panel.profile');
Route::get('/articles', [UserPanelController::class, 'articles'])->name('user.panel.articles');
