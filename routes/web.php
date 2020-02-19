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
    Route::group(['middleware' => ['auth', 'admin']], function(){
        // Route::get('/dashboard', function(){
        //     return view('admin.dashboard.index');
        // });
        Route::get('dashboard', [
            'uses' => 'DashboardController@index'
        ])->name('dashboard');
        Route::resource('users', 'Admin\UserController')->only(['index', 'edit', 'update']);
        Route::resource('category', 'Admin\CategoryController');
        Route::resource('post', 'Admin\PostController');
    
    });
});

// public route
Route::group(['middleware' => ['web']], function(){
    Route::get('post/{slug}', ['as' => 'post.single', 'uses' => 'PostController@getSingle'])
    ->where('slug', '[\w\d\-\_]+');
    Route::get('/', 'HomeController@index');
    Route::get('category/{slug}', ['as' => 'category.single', 'uses' => 'CategoryController@getSingle'])
    ->where('slug', '[\w\d\-\_]+');
Route::resource('category', 'CategoryController')->only('show');
    
});

Auth::routes();
