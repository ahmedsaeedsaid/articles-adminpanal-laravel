<?php

// Articles Management
Route::group(['namespace' => 'Articles'], function () {
    Route::resource('articles', 'ArticlesController', ['except' => ['show']]);

    //For DataTables
    Route::post('articles/get', 'ArticlesTableController')
        ->name('articles.get');
});
