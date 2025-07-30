<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('index');
});

Route::get('blog', function () {
    return view('blog');
})->name('blog');

// Route::get('category', function () {
//     return view('admin/category/index');
// })->name('category');


// Route::get('create_edit', function () {
//     return view('admin/category/create_edit');
// })->name('create_edit');


Route::get('post', function () {
    return view('admin/post/index');
})->name('post');

Route::get('create_edit_post', function () {
    return view('admin/post/create_edit');
})->name('create_edit_post');

// Route::get('tag', function () {
//     return view('admin/tag/index');
// })->name('tag');

// Route::get('create_edit_tag', function () {
//     return view('admin/tag/create_edit');
// })->name('create_edit_tag');


// Route::post('create_edit',[CategoryController::class,'store'])->name('category');

Route::controller(CategoryController::class)->group(function () {
    Route::get('admin/category','index')->name('category.index');
    Route::get('admin/category/create','create')->name('create_edit.create');

    Route::post('admin/category/store','store')->name('category.store');
    Route::get('admin/category/{id}','edit')->name('category.edit');
    Route::patch('admin/category/{id}','update')->name('category_update.update');
    Route::delete('admin/category/{id}','destroy')->name('category.destroy');

});

Route::controller(TagController::class)->group(function () {
    Route::get('admin/tag','index')->name('tag.index');
    Route::get('admin/tag/create','create')->name('tag.create');

    Route::post('admin/tag/store','store')->name('tag.store');
    
    Route::get('admin/tag/{id}','edit')->name('tag.edit');
    Route::patch('admin/tag/{id}','update')->name('tag.update');

    Route::delete('admin/tag/{id}','destroy')->name('tag.destroy');
});
Route::controller(PostController::class)->group(function () {
    Route::get('admin/post','index')->name('post.index');
    Route::get('admin/post/create','create')->name('post.create');
    Route::post('admin/post/store','store')->name('post.store');
    Route::get('admin/post/{id}','edit')->name('post.edit');
    Route::patch('admin/post/{id}','update')->name('post.update');
    Route::delete('admin/post/{id}','destroy')->name('post.destroy');
});



