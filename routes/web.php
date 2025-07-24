<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('blog', function () {
    return view('blog');
})->name('blog');

Route::get('category', function () {
    return view('admin/category/index');
})->name('category');


Route::get('create_edit', function () {
    return view('admin/category/create_edit');
})->name('create_edit');


Route::get('post', function () {
    return view('admin/post/index');
})->name('post');

Route::get('create_edit_post', function () {
    return view('admin/post/create_edit');
})->name('create_edit_post');

Route::get('tag', function () {
    return view('admin/tag/index');
})->name('tag');

Route::get('create_edit_tag', function () {
    return view('admin/tag/create_edit');
})->name('create_edit_tag');

