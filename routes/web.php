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



Route::get('/','HomeController@index');
Route::get('/list/{id}','HomeController@goodsList');
Route::get('/goods/{id}','HomeController@goods');


Route::get('/login','AuthController@login');
Route::post('/checkLogin','AuthController@checkLogin');

Route::group(['middleware'=>'auth'],function(){
    Route::post('/cart/create','CartController@create');
    Route::get('/cart','CartController@index');
    Route::post('/cart/update/{id}','CartController@update');
    Route::post('/cart/destroy/{id}','CartController@destroy');

    Route::post('/pay/create','PayController@create');
    Route::get('/pay/{id}','PayController@index');

    Route::get('/user/address/create','User\AddressController@create');
    Route::post('/user/address/create','User\AddressController@create');

    Route::get('/pay/{id}','PayController@index');
    Route::get('/pay/{pay}/{address}/{goods}','PayController@pay');
    Route::post('/pay/return','PayController@webReturn');
});

//Auth::routes();

/* file upload Route */
Route::post('file/upload','FileController@upload');
Route::get('file','fileController@index');
Route::post('file/delete','FileController@delete');

/* Admin login Route */
Route::get('admin/login','Admin\AuthController@login');
Route::post('admin/checkLogin','Admin\AuthController@checkLogin');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::get('/','Admin\IndexController@index');
    Route::get('/loginOut','Admin\AuthController@loginOut');

    Route::get('/role','Admin\RoleController@show');
    Route::any('/role/add','Admin\RoleController@addRole');
    Route::any('/role/edit/{id}','Admin\RoleController@updateRole');
    Route::any('/role/delete/{id}','Admin\RoleController@deleteRole');

    Route::get('/goods/type','Admin\GoodsTypeController@index');
    Route::get('/goods/type/create/{pid?}','Admin\GoodsTypeController@create');
    Route::post('goods/type/create','Admin\GoodsTypeController@store');
    Route::post('goods/type/edit/{id}','Admin\GoodsTypeController@edit');
    ROute::post('goods/type/destroy/{id}','Admin\GoodsTypeController@destroy');
    //Route::get('/goods/type/add','Admin\GoodsTypeController@add');

    Route::get('/goods/add','Admin\GoodsController@create');
    Route::post('/goods/create','Admin\GoodsController@store');
    Route::get('goods/','Admin\GoodsController@index');
    Route::post('goods/update/{id}','Admin\GoodsController@update');
    Route::post('goods/destroy/{id}','Admin\GoodsController@destroy');
});
