<?php
Route::group([
    'prefix'     => 'media-manager',
    'namespace'  => '\MrTaiw\MediaManager\controllers',
    'middleware' => \Config::get('twmm.middlewares'),
], function () {
    Route::get('/list', 'MediaManagerController@getList');
    Route::post('/upload', 'MediaManagerController@postUpload');
    Route::post('/delete', 'MediaManagerController@delete');
    Route::post('/folder', 'MediaManagerController@makeFolder');
});
