<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Support\Facades\Route;

//default route

Route::get('/', [HomeController::class, 'index'])->name('blogs.home');

//blog routes
Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs.blog');
Route::get('/blogs/yourposts', [App\Http\Controllers\BlogController::class, 'userindex']);

Route::get('/blogs/create',[BlogController::class,'create'])->name('blogs.create');
Route::post('/blogs',[BlogController::class,'store']);

Route::get('/blogs/{blog}/edit',[BlogController::class,'edit'])->name('blogs.create');
Route::patch('/blogs/{blog}',[BlogController::class,'update']);
Route::delete('/blogs/{blog}',[BlogController::class,'destroy']);

Route::get('/blogs/{blog}',[BlogController::class,'show']);

//comment
Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

// Update a comment
Route::put('/comments/{comment}', [CommentController::class, 'update'])
    ->middleware('auth')
    ->name('comments.update');

// Delete a comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware('auth')
    ->name('comments.destroy');

//Auth
Route::get('/signup',[UserController::class,'index']);
Route::get('/login',[SessionController::class,'index']);

Route::post('/signup',[UserController::class,'store']);
Route::post('/login',[SessionController::class,'store']);
Route::post('/logout',[SessionController::class,'destroy']);

//admin
route::get('/admin',[AdminController::class,'index']);
route::post('/admin',[AdminController::class,'createtags']);
Route::put('/admin/{tag}', [AdminController::class, 'update']);
Route::delete('/admin/{tag}',[adminController::class,'destroy']);
Route::delete('/admin/users/{user}',[adminController::class,'userdelete']);
