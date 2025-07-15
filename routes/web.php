<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/blog', function () {
    return view('blog');
})->name('blog');