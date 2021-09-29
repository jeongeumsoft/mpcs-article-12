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
    $router->resource('categories', 'CategoryController')->names('categories')->except(['create', 'destroy']);
    $router->resource('articles', 'ArticleController')->names('articles');
});


// Blade Route
Route::group([
    'as'          => Core::getConfigString('ui_route_name_prefix'),
    'prefix'        => Core::getConfig('ui_url_prefix'),
    'namespace'     => 'Exit11\Article\Http\Controllers\Blade',
    'middleware'    => config('mpcs.route.middleware'),
], function (Router $router) {
    $router->get('categories/list', 'CategoryController@list')->name('categories.list');
    $router->get('categories/list_categories', 'CategoryController@listCategories')->name('categories.list_categories');
    $router->resource('categories', 'CategoryController')->except(['create', 'destroy']);
    $router->get('articles/list', 'ArticleController@list')->name('articles.list');
    $router->resource('articles', 'ArticleController');
});

// Non Auth
Route::group([
    'as'          => Core::getConfigString('ui_route_name_prefix'),
    'prefix'        => Core::getConfig('ui_url_prefix'),
    'namespace'     => 'Exit11\Article\Http\Controllers',
    'middleware'    => ['web'],
], function (Router $router) {
});
