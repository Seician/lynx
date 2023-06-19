<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\User;
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

Route::get('/', [PostController::class, 'index'])->name('home');

//Route::get('/comments', [CommentController::class, 'index']);

Route::get('/comments', [CommentController::class, 'index']);

Route::get('/comments/{id}', [CommentController::class, 'show']);

Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories/{category:slug}', function (Category $category) {

    return view('posts', [
        'posts' => $category->posts,
    ]);
});

Route::get('/authors/{author:username}', function (User $author) {

    return view('posts', [
        'posts' => $author->posts,
    ]);
});
