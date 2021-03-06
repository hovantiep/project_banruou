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

Route::auth();
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);



// Định tuyến cho phần backend
//Route::get('admin', ['as' => 'Admin', 'uses'=>''])
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
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

        Route::get('delete/{id}', ['as' => 'admin.product.getDelete', 'uses' => 'ProductController@getDelete']);

        Route::get('edit/{id}', ['as' => 'admin.product.getEdit', 'uses' => 'ProductController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.product.postEdit', 'uses' => 'ProductController@postEdit']);

        // Delete image in Product Image
        Route::get('delImg/{id}', ['as' => 'admin.product.getDelImg', 'uses' => 'ProductController@getDelImg']);
    });

    Route::group(['prefix' => 'user'], function () {
        // Route USER
        Route::get('list', ['as' => 'admin.user.getList', 'uses' => 'UserController@getList']);

        Route::get('add', ['as' => 'admin.user.getAdd', 'uses' => 'UserController@getAdd']);
        Route::post('add', ['as' => 'admin.user.postAdd', 'uses' => 'UserController@postAdd']);

        Route::get('delete/{id}', ['as' => 'admin.user.getDelete', 'uses' => 'UserController@getDelete']);

        Route::get('edit/{id}', ['as' => 'admin.user.getEdit', 'uses' => 'UserController@getEdit']);
        Route::post('edit/{id}', ['as' => 'admin.user.postEdit', 'uses' => 'UserController@postEdit']);

    });
});



// Định tuyến cho phần frontend

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');//->middleware("verify");
Route::post('/home', 'HomeController@index');

Route::get('loai-san-pham/{id}/{alias}', ['as' => 'loaiSanPham', 'uses' => 'HomeController@loaiSanPham']);

Route::get('chi-tiet-san-pham/{id}/{alias}', ['as' => 'chiTietSanPham', 'uses' => 'HomeController@chiTietSanPham']);

Route::get('lien-he', ['as' => 'getLienHe', 'uses' => 'HomeController@getLienHe']);
Route::post('lien-he', ['as' => 'postLienHe', 'uses' => 'HomeController@postLienHe']);

Route::get('mua-hang/{id}/{alias}', ['as' => 'muaHang', 'uses' => 'HomeController@muaHang']);

Route::get('gio-hang', ['as' => 'gioHang', 'uses' => 'HomeController@gioHang']);

Route::get('xoa-hang-mua/{rowid}', ['as' => 'xoaHangMua', 'uses' => 'HomeController@xoaHangMua']);

Route::post('cap-nhat-hang/{rowid}/{qty}', ['as' => 'capNhatHang', 'uses' => 'HomeController@capNhatHang']);

