<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('test', function () {
    return view('admin.user.edit');
});
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'cate'], function () {
        // Route CATEGORY
        Route::get('list', ['as' => 'admin.cate.getList', 'uses' => 'CateController@getList']);

        Route::get('add', ['as' => 'admin.cate.getAdd', 'uses' => 'CateController@getAdd']);
        Route::post('add', ['as' => 'admin.cate.postAdd', 'uses' => 'CateController@postAdd']);

        Route::get('delete/{id}', ['as' => 'admin.cate.getDelete', 'uses' => 'CateController@getDelete']);

        Route::get('edit/{id}', ['as' => 'admin.cate.getEdit', 'uses' => 'CateController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.cate.postEdit', 'uses' => 'CateController@postEdit']);
    });
    Route::group(['prefix' => 'product'], function () {
        // Route PRODUCT
        Route::get('list', ['as' => 'admin.product.getList', 'uses' => 'ProductController@getList']);

        Route::get('add', ['as' => 'admin.product.getAdd', 'uses' => 'ProductController@getAdd']);
        Route::post('add', ['as' => 'admin.product.postAdd', 'uses' => 'ProductController@postAdd']);

//            Route::get('delete/{id}', ['as' => 'admin.cate.getDelete', 'uses' => 'CateController@getDelete']);
//
//            Route::get('edit/{id}', ['as' => 'admin.cate.getEdit', 'uses' => 'CateController@getEdit']);
//            Route::post('edit/{id}', ['as' => 'admin.cate.postEdit', 'uses' => 'CateController@postEdit']);
    });
});