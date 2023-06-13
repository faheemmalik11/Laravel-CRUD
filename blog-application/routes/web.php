<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'show'])->name('home');
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'showBlogPost'])->name('post');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class,'create'])->name('admin.posts.create');
    Route::post('/admin/posts/store', [App\Http\Controllers\PostController::class,'store'])->name('admin.posts.store');
    Route::get('/admin/posts', [App\Http\Controllers\PostController::class,'index'])->name('admin.posts.index');
    Route::post('/admin/posts/delete/{id}', [App\Http\Controllers\PostController::class,'delete'])->name('admin.posts.delete');
    Route::get('/admin/posts/show/{id}', [App\Http\Controllers\PostController::class,'show'])->name('admin.posts.edit');
    Route::post('/admin/posts/update/{id}', [App\Http\Controllers\PostController::class,'update'])->name('admin.posts.update');
});