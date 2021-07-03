<?php

// Article Categories Management
Route::group(['namespace' => 'ArticleCategories', 'prefix' => 'articles'], function () {
    Route::resource('article-categories', 'ArticleCategoriesController', ['except' => ['show']]);

    //For DataTables
    Route::post('articleCategories/get', 'ArticleCategoriesTableController')
        ->name('articleCategories.get');
});
