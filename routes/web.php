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
        Route::post('projects/{project}/featured', 'ProjectController@switchFeaured')->name("projects.featured");

        Route::get('projects/donate/{project}', 'ProjectController@donate')->name("projects.donate");
        Route::post('projects/donate/{project}/store', 'ProjectController@storeDonate')->name("projects.donate.store");
        Route::put('projects/donate/cancel/{donate}', 'ProjectController@cancel')->name("projects.donate.cancel");
        Route::put('projects/donate/confirm/{donate}', 'ProjectController@confirm')->name("projects.donate.confirm");
        
        Route::resource('project-categories', 'ProjectCategoryController');
        Route::resource('projects', 'ProjectController');

        Route::resource('categories', 'CategoryController');
        Route::resource('posts', 'PostController');

        Route::resource('report-types', 'ReportTypeController');
        Route::resource('reports', 'ReportController');
        Route::post('reports/{report}/featured', 'ReportController@switchFeaured')->name("reports.featured");

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

// sub page

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/terms-of-services', function () {
    return view('pages.terms-of-services');
});

Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy');
});
Route::get('/specific-trade-law', function () {
    return view('pages.specific-trade-law');
});
// public route
Route::group(['middleware' => ['web']], function(){
    Route::get('/', 'HomeController@index')->name("home");
    Route::get('/projects', 'ProjectController@index')->where('slug', '[\w\d\-\_]+')->name("projects.index");
    Route::get('/{slug}/projects', 'ProjectController@getByCategory')->where('slug', '[\w\d\-\_]+')->name("projects.category");

    Route::get('/news/{slug}', 'PostController@getSingle')->where('slug', '[\w\d\-\_]+')->name("post.detail");
    Route::get('category/{slug}', ['as' => 'category.single', 'uses' => 'CategoryController@getSingle'])
    ->where('slug', '[\w\d\-\_]+');

    Route::get('/reports', 'ReportController@index')->where('slug', '[\w\d\-\_]+')->name("reports.index");
    Route::get('/reports/search', 'ReportController@search')->where('slug', '[\w\d\-\_]+')->name("reports.search");
    Route::get('/report/{slug}', 'ReportController@detail')->where('slug', '[\w\d\-\_]+')->name("reports.detail");
    Route::get('/reports/{slug}/types/', 'ReportController@getByType')->where('slug', '[\w\d\-\_]+')->name("reports.type");
    Route::get('/reports/{slug}/projects/', 'ReportController@getByProjectCategory')->where('slug', '[\w\d\-\_]+')->name("reports.project");
    
    Route::get('/{slug}', 'ProjectController@detail')->where('slug', '[\w\d\-\_]+')->name("project.detail");

});

Route::group(['middleware' => 'filter'], function() {
    Route::resource('Reposts', 'RepostController');
});