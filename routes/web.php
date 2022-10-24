<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Mpcs\Core\Facades\Core;

// Api Route
Route::group([
    'as'            => Core::getRouteNamePrefix('api'),
    'prefix'        => Core::getUrlPrefix('api'),
    'namespace'     => 'Mpcs\Article\Http\Controllers\Api',
    'middleware'    => Core::getConfig('route.middleware'),
], function (Router $router) {
    $router->resource('article_categories', 'ArticleCategoryController')->names('article_categories')->except(['destroy']);
    $router->resource('articles', 'ArticleController')->names('articles');
    $router->resource('article_files', 'ArticleFileController')->names('article_files')->only(['store', 'destroy']);
    $router->get('article_files/{article_file}/download', 'ArticleFileController@download')->name('article_files.download');
});


// Blade Route
Route::group([
    'as'            => Core::getRouteNamePrefix('ui'),
    'prefix'        => Core::getUrlPrefix('ui'),
    'namespace'     => 'Mpcs\Article\Http\Controllers\Blade',
    'middleware'    => Core::getConfig('route.middleware'),
], function (Router $router) {
    $router->patch('article_categories/save_order', 'ArticleCategoryController@saveOrder')->name('article_categories.save_order');
    $router->get('article_categories/list', 'ArticleCategoryController@list')->name('article_categories.list');
    $router->resource('article_categories', 'ArticleCategoryController')->except(['destroy']);
    $router->get('articles/list', 'ArticleController@list')->name('articles.list');
    $router->resource('articles', 'ArticleController');
});

// Open API
Route::group([
    'as'            => Core::getRouteNamePrefix('open_api'),
    'prefix'        => Core::getUrlPrefix('open_api'),
    'namespace'     => 'Mpcs\Article\Http\Controllers\OpenApi',
    'middleware'    => Core::getConfig('route.open_api.middleware'),
], function (Router $router) {
    if (Core::getConfig('enable_open_api', 'mpcsarticle')) {
        $router->resource('articles', 'ArticleController')->names('articles')->only(['index', 'show']);
    }
});
