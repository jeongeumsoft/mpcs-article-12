<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Mpcs\Core\Facades\Core;

// Api Route
Route::group([
    'as'          => Core::getConfigString('route_name_prefix'),
    'prefix'        => Core::getConfig('url_prefix'),
    'namespace'     => 'Exit11\Article\Http\Controllers\Api',
    'middleware'    => Core::getConfig('route.middleware'),
], function (Router $router) {
    $router->resource('article_categories', 'ArticleCategoryController')->names('article_categories')->except(['create', 'destroy']);
    $router->resource('articles', 'ArticleController')->names('articles');
    $router->resource('article_files', 'ArticleFileController')->names('article_files')->only(['store', 'destroy']);
    $router->get('article_files/{article_file}/download', 'ArticleFileController@download')->name('article_files.download');

    $router->resource('popups', 'PopupController')->names('popups');
});


// Blade Route
Route::group([
    'as'          => Core::getConfigString('ui_route_name_prefix'),
    'prefix'        => Core::getConfig('ui_url_prefix'),
    'namespace'     => 'Exit11\Article\Http\Controllers\Blade',
    'middleware'    => config('mpcs.route.middleware'),
], function (Router $router) {
    $router->get('article_categories/list', 'ArticleCategoryController@list')->name('article_categories.list');
    $router->resource('article_categories', 'ArticleCategoryController')->except(['create', 'destroy']);
    $router->get('articles/list', 'ArticleController@list')->name('articles.list');
    $router->resource('articles', 'ArticleController');

    $router->patch('popups/{popup}/orderable', 'PopupController@orderable')->name('popups.orderable');
    $router->get('popups/list', 'PopupController@list')->name('popups.list');
    $router->resource('popups', 'PopupController')->names('popups');
});

// Non Auth
Route::group([
    'as'          => Core::getConfigString('ui_route_name_prefix'),
    'prefix'        => Core::getConfig('ui_url_prefix'),
    'namespace'     => 'Exit11\Article\Http\Controllers',
    'middleware'    => ['web'],
], function (Router $router) {
    // 
});
