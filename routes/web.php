<?php

use App\Http\Controllers\AuthController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;


// Route::get('/', function () {
//     return view('index');
// })->name('index');
// Route::get('blog', function () {
//     return view('blog');
// })->name('blog');


Route::get('/',[PostController::class,'showdata'])->name('index');
Route::get('blog/{id}', [PostController::class, 'showveiwdetail'])->name('blog');



// Route::get('category', function () {
//     return view('admin/category/index');
// })->name('category');


// Route::get('create_edit', function () {
//     return view('admin/category/create_edit');
// })->name('create_edit');


// Route::get('post', function () {
//     return view('admin/post/index');
// })->name('post');

// Route::get('create_edit_post', function () {
//     return view('admin/post/create_edit');
// })->name('create_edit_post');

// Route::get('tag', function () {
//     return view('admin/tag/index');
// })->name('tag');

// Route::get('create_edit_tag', function () {
//     return view('admin/tag/create_edit');
// })->name('create_edit_tag');


// Route::post('create_edit',[CategoryController::class,'store'])->name('category');


//  before group middleware

// Route::controller(CategoryController::class)->group(function () {
//     Route::get('admin/category','index')->name('category.index');
//     Route::get('admin/category/create','create')->name('create_edit.create');
//     Route::post('admin/category/store','store')->name('category.store');
//     Route::get('admin/category/{id}','edit')->name('category.edit');
//     Route::patch('admin/category/{id}','update')->name('category_update.update');
//     Route::delete('admin/category/{id}','destroy')->name('category.destroy');

// });

// this is route dak muy muy 
// Route::middleware('auth')->group(function () {
//     Route::get('admin/category', [CategoryController::class, 'index'])->name('category.index');
// });







Route::get('/login',[AuthController::class,'showform'])->name('login');

Route::post('/loginForm', [AuthController::class,'login'])->name('login.submit');

Route::get('/register',[AuthController::class,'showregister'])->name('register');
Route::post('/register/store',[AuthController::class,'store'])->name('register.store');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::prefix('admin')->middleware('auth')->group(function(){
    
  Route::controller(CategoryController::class)->group(function () {
   Route::get('category','index')->name('category.index');
    Route::get('category/create','create')->name('create_edit.create');

    Route::post('category/store','store')->name('category.store');
    Route::get('category/{id}','edit')->name('category.edit');
    Route::patch('category/{id}','update')->name('category_update.update');
    Route::delete('category/{id}','destroy')->name('category.destroy');

  });

  Route::controller(TagController::class)->group(function () {
    
      Route::get('tag','index')->name('tag.index');
      Route::get('tag/create','create')->name('tag.create');

      Route::post('tag/store','store')->name('tag.store');
      
      Route::get('tag/{id}','edit')->name('tag.edit');
      Route::patch('tag/{id}','update')->name('tag.update');

      Route::delete('tag/{id}','destroy')->name('tag.destroy');

    });



    Route::controller(PostController::class)->group(function(){
      Route::get('post','index')->name('post.index');
      Route::get('post/create','create')->name('post.create');
      
      Route::post('post/store','store')->name('post.store');

      Route::get('post/{id}','edit')->name('post.edit');
      Route::patch('post/{id}','update')->name('post.update');
        Route::delete('post/{id}','destroy')->name('post.destroy');

  });

});










