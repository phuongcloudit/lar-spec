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

Auth::routes();


// admin route
Route::name('admin.')->prefix('admin')->namespace("Admin")->group(function () {
    Route::group(['middleware' => ['auth', 'admin']], function(){
        Route::get('/','DashboardController@index')->name('dashboard');
        
        Route::resource('categories', 'CategoryController');
        Route::get('posts/donate/{post}', 'PostController@donate')->name("posts.donate");

        Route::post('posts/donate/{post}/store', 'PostController@storeDonate')->name("posts.donate.store");
        Route::put('posts/donate/cancel/{donate}', 'PostController@cancel')->name("posts.donate.cancel");
        Route::put('posts/donate/confirm/{donate}', 'PostController@confirm')->name("posts.donate.confirm");
        Route::resource('posts', 'PostController');
        Route::resource('news', 'NewsController');
        Route::resource('users', 'UserController')->only(['index', 'edit', 'update']);
    
    });
});

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
// public route
Route::group(['middleware' => ['web']], function(){
    Route::get('/', 'HomeController@index')->name("home");
    Route::get('/{slug}', 'PostController@getSingle')->where('slug', '[\w\d\-\_]+')->name("post.detail");
    Route::get('category/{slug}', ['as' => 'category.single', 'uses' => 'CategoryController@getSingle'])
    ->where('slug', '[\w\d\-\_]+');
    // Route::resource('category', 'CategoryController')->only('show');
    // Route::resource('post', 'PostController')->only('show');
});

