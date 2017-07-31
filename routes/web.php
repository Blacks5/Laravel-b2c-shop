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
Route::get('register','AuthController@showRegister');
Route::post('register','AuthController@register');

Route::get('/show','AuthController@show');



/* 用户激活 */
Route::group(['middleware'=>'auth'],function(){
    Route::get('user/activated','AuthController@showActivated');
    Route::get('activated/{id}/{token}','AuthController@activated');
    Route::post('user/resend','AuthController@reSend');
});


Route::group(['middleware'=>'user'],function(){
    Route::post('/cart/create','CartController@create');
    Route::get('/cart','CartController@index');
    Route::post('/cart/update/{id}','CartController@update');
    Route::post('/cart/destroy/{id}','CartController@destroy');

    Route::post('/pay/create','PayController@create');
    Route::get('/pay/{id}','PayController@index');


    Route::get('user','User\UserController@index');
    Route::get('user/info','User\UserController@info');
    Route::post('user/info/update','User\UserController@infoUpdate');
    Route::get('user/safety','User\UserController@safety');
    Route::get('user/password','User\UserController@password');
    Route::post('user/password','User\UserController@password');
    Route::get('user/address','User\UserController@address');

    Route::get('user/order','User\OrderController@index');
    Route::get('user/orderinfo/{oid}','User\OrderController@orderInfo');
    Route::get('user/order/repay/{oid}','PayController@repay');
    Route::get('user/order/refund/{id}','User\OrderController@refund');
    Route::get('user/order/express/{oid}','User\OrderController@getExpress');
    Route::post('user/order/remind','User\OrderController@remind');
    Route::post('user/order/refund','User\OrderController@refundAjax');
    Route::get('user/order/change','User\OrderController@change');
    Route::get('user/order/change/record/{id}','User\OrderController@record');
    Route::post('user/order/confirm','User\OrderController@confirm');
    Route::get('user/order/comment/{oid}','User\OrderController@commentList');
    Route::post('user/order/comment','User\OrderController@commentAdd');
    Route::get('user/order/commentlist','User\OrderController@comment');


    /* user address */
    Route::get('/user/address/create','User\AddressController@create');
    Route::post('/user/address/create','User\AddressController@create');
    Route::get('/user/address/update/{id}','User\AddressController@update');
    Route::post('/user/address/edit','User\AddressController@edit');
    Route::post('/user/address/delete/{id}','User\AddressController@delete');
    Route::post('/user/address/default/{id}','User\AddressController@defaultAdr');

    Route::get('/pay/{id}','PayController@index');
    Route::get('/pay/{pay}/{address}/{goods}','PayController@pay');
    Route::post('/pay/add','PayController@payAdd');
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

    Route::get('/ad/position','Admin\PositionController@position');
    Route::get('/ad/position/create','Admin\PositionController@create');
    Route::post('/ad/position/create','Admin\PositionController@create');
    Route::get('/ad/position/edit/{id}','Admin\PositionController@edit');
    Route::post('/ad/position/update','Admin\PositionController@update');
    Route::post('/ad/position/destroy/{id}','Admin\PositionController@destroy');

    Route::resource('/ad','Admin\AdController');

    Route::get('/goods/add','Admin\GoodsController@create');
    Route::post('/goods/create','Admin\GoodsController@store');
    Route::get('goods/','Admin\GoodsController@index');
    Route::post('goods/update/{id}','Admin\GoodsController@update');
    Route::post('goods/destroy/{id}','Admin\GoodsController@destroy');

    /*  Article */
    Route::resource('/article','Admin\ArticleController');
    /*  Article Type    */
    Route::resource('/articleType','Admin\ArticleTypeController');
});
