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

Route::middleware(['role:Admin','auth'])->group(function () {

    Route::post('/user/profile/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
    Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::post('/user/delete/{user}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.profile.delete');

    Route::get('/roles/index', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');    
    Route::get('/permissions/index', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');  
    
    Route::post('/roles/{role}/delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('role.delete');    
    Route::post('/permissions/{permission}/delete', [App\Http\Controllers\PermissionController::class, 'delete'])->name('permission.delete');    

    Route::post('/roles/add', [App\Http\Controllers\RoleController::class, 'store'])->name('role.add');    
    Route::post('/permissions/add', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.add'); 

    Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'show'])->name('role.edit');    
    Route::get('/permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'show'])->name('permission.edit'); 

    Route::post('/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');    
    Route::post('/permissions/{permission}/update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');

    Route::post('/roles/{role}/permission/attach', [App\Http\Controllers\RoleController::class, 'attach'])->name('role.permission.attach');
    Route::post('/roles/{role}/permission/detach', [App\Http\Controllers\RoleController::class, 'detach'])->name('role.permission.detach');
   
});

Route::middleware(['auth','can:view,user'])->group(function () {

    Route::get('/user/profile/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
   
});

Route::post('/user/{user}/role/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
Route::post('/user/{user}/role/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');