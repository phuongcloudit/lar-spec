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
Route::prefix("donate")->group(function($route){
    Route::post("/{id}/store/","DonateController@store")->name("donate.store");
    Route::get("/confirm/","DonateController@confirm")->name("donate.confirm");
    Route::get("/cancel/","DonateController@cancel")->name("donate.cancel");
    Route::get("/error/","DonateController@error")->name("donate.error");
    Route::get("/thanks/{trans_code}/{user_id}/","DonateController@thanks")->name("donate.thanks");

});

Route::get('order', function(){
    return view("epsilons.order");
});
Route::get('confirm', function(){
    return view("epsilons.confirm");
});

Route::name('admin.')->prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth', 'admin']], function(){
        Route::get('dashboard', [
            'uses' => 'DashboardController@index'
        ])->name('dashboard');
        Route::resource('users', 'Admin\UserController')->only(['index', 'edit', 'update']);
        Route::resource('category', 'Admin\CategoryController');
        Route::resource('post', 'Admin\PostController');
        Route::resource('news', 'Admin\NewsController');
    
    });
});

// public route
Route::group(['middleware' => ['web']], function(){
    Route::get('post/{slug}', ['as' => 'post.single', 'uses' => 'PostController@getSingle'])
    ->where('slug', '[\w\d\-\_]+');
    Route::get('/', 'HomeController@index');
    Route::get('category/{slug}', ['as' => 'category.single', 'uses' => 'CategoryController@getSingle'])
    ->where('slug', '[\w\d\-\_]+');
    // Route::resource('category', 'CategoryController')->only('show');
    // Route::resource('post', 'PostController')->only('show');
});

Auth::routes();
