<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCommentsController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/news', [NewsController::class, 'get'])->name('news.get');
Route::post('/news', [NewsController::class, 'create'])->name('news.create');
Route::get('/news/{id}', [NewsController::class, 'find'])->name('news.find');

Route::post('/news/{id}', [NewsCommentsController::class, 'create'])->name('comments.news.create');
Route::put('/news/{id}/{commentId}', [NewsCommentsController::class, 'update'])->name('comments.news.update');
Route::delete('/news/{id}/{commentId}', [NewsCommentsController::class, 'delete'])->name('comments.news.delete');

Route::get('/posts', [PostsController::class, 'get'])->name('posts.get');
Route::post('/posts', [PostsController::class, 'create'])->name('posts.create');
Route::get('/posts/{id}', [PostsController::class, 'find'])->name('posts.find');

Route::post('/posts/{id}', [PostCommentsController::class, 'create'])->name('comments.post.create');
Route::put('/posts/{id}/{commentId}', [PostCommentsController::class, 'update'])->name('comments.post.update');
Route::delete('/posts/{id}/{commentId}', [PostCommentsController::class, 'delete'])->name('comments.post.delete');
