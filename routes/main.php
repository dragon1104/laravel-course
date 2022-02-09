<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home.index')->name('home');

Route::redirect('/home', '/')->name('home.redirect');

// Route::get('/test', TestController::class)->name('test')->middleware('token:secret');
Route::get('/test', TestController::class)->name('test');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::controller(BlogController::class)->group(function () {
    Route::get('blog', 'index')->name('blog');
    Route::get('blog/{post}', 'show')->name('blog.show');
    Route::post('blog/{post}/like', 'like')->name('blog.like');
});

Route::resource('posts/{post}/comments', CommentController::class)->only([
    'index', 'show',
]);

// Route::fallback(function () {
//     return 'Fallback';
// });
