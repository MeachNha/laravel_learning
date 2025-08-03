<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
Route::get('/login',[AuthController::class, 'create'])->name('login');
Route::post('/pagelogin',[AuthController::class, 'login'])->name('admin.login');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
Route::get('/create',[AuthController::class, 'createuser'])->name('frm.create');
Route::post('/store',[AuthController::class, 'store'])->name('frm.store');
Route::get('/', function () {
    return view('index');
});
Route::get('blog', function () {
    return view('blog');
})->name('blog');
Route::prefix('admin')
    ->middleware('auth') // <- add your middleware here
    ->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category/store', 'store')->name('category.store');
        Route::get('category/{id}', 'edit')->name('category.edit');
        Route::patch('category/{id}', 'update')->name('category.update');
        Route::delete('category/{id}', 'destroy')->name('category.destroy');
    });

    Route::controller(TagController::class)->group(function () {
        Route::get('tag', 'index')->name('tag.index');
        Route::get('tag/create', 'create')->name('tag.create');
        Route::post('tag/store', 'store')->name('tag.store');
        Route::get('tag/{id}', 'edit')->name('tag.edit');
        Route::patch('tag/{id}', 'update')->name('tag.update');
        Route::delete('tag/{id}', 'destroy')->name('tag.destroy');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('post', 'index')->name('post.index');
        Route::get('post/create', 'create')->name('post.create');
        Route::post('post/store', 'store')->name('post.store');
        Route::get('post/{id}', 'edit')->name('post.edit');
        Route::patch('post/{id}', 'update')->name('post.update');
        Route::delete('post/{id}', 'destroy')->name('post.destroy');
    });

});



