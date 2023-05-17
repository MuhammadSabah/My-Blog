<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [\App\Http\Controllers\AuthController::class, 'showLoginForm']);

// Blog
Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);

Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);

Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']);

Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']);

Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']);

Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']);

Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy']);

// Comment
Route::post('/blog/{blogPost}', [\App\Http\Controllers\CommentController::class, 'store']);

// User
Route::get('/profile/{user}', [\App\Http\Controllers\UserController::class, 'index']);

Route::put('/profile/{user}', [\App\Http\Controllers\UserController::class, 'update']);

// Auth
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm']);

Route::get('/signup', [\App\Http\Controllers\AuthController::class, 'showSignupForm']);

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Auth::routes();

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::delete('/home', [\App\Http\Controllers\UserController::class, 'destroy']);
