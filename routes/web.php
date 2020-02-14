<?php

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


// admin route

Route::name('admin.')->prefix('admin')->group(function () {
    // Dashboard
    Route::get('dashboard', [
        'uses' => 'DashboardController@index'
    ])->name('dashboard');
    Route::resource('users', 'Admin\UserController')->only(['index', 'edit', 'update']);
   
   // Category
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('post', 'Admin\PostController');
});


// public route

Route::get('/', function () {
    return view('pages.top');
});
Route::get('/category', function () {
    return view('category.index');
});

Route::get('/detail', function () {
    return view('detail.index');
});


// Route::resource('category', 'CategoryController')->only('show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('post', 'PostController')->only('show');


Route::get('photo', 'Admin\ImageController@index');
Route::post('save-photo', 'Admin\ImageController@save');


