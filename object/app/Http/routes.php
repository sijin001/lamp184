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

Route::resource('/','home\movie\MovieController');


Route::resource('/movie', 'admin\movie\MovieController');
Route::post('/movieajax','admin\movie\MovieController@doChange');
Route::post('/movieroomajax','admin\movie\MovieRoomController@doChange');
Route::post('/movieshowajax','admin\movie\MovieShowController@doChange');
Route::resource('/movieroom', 'admin\movie\MovieRoomController');
Route::resource('/movieshow', 'admin\movie\MovieShowController');
Route::resource('/moviecomment', 'admin\movie\MovieCommentController');

Route::resource('/home/movie/description','home\movie\MovieDesController');
Route::resource('/home/movie/get','home\movie\MovieGetController');
Route::resource('/home/movie/seat','home\movie\MovieSeatController');
Route::get('/home/movie/seat/capth/{tmp}','home\movie\MovieSeatController@capth');
Route::resource('/home/movieorder','home\movie\MovieOrderController');
Route::resource('/home/movieajax','home\movie\MovieAjaxController');
Route::resource('/home/moviecapth','home\movie\MovieCapthController');
Route::resource('/home/movieplace','home\movie\MoviePlaceController');

//前台商品
Route::resource('/goods', 'home\goods\GoodsController');
// 商品列表
Route::resource('/list', 'home\goods\ListController');
Route::get('/list/{id}', 'home\goods\ListController@show');


// 前台订单
Route::resource('/home/goodsorder', 'home\goods\OrderController');
Route::resource('/home/confirmorder', 'home\goods\ConfirmController');
// ajax请求城市地址
Route::get('/goodsorder/get', 'home\goods\OrderController@doGet');
Route::post('/goodsorder/post', 'home\goods\OrderController@doPost');


// 后台群组
Route::group(['prefix' => 'admin'], function () {
    // 分类
    Route::resource('/type', 'admin\type\TypeController');
    Route::get('/subType/{id}', 'admin\TypeController@subCreate');
    Route::post('/subType', 'admin\TypeController@subStore');
    // 商品
    Route::resource('/goods', 'admin\goods\GoodsController');
    // 商品状态：是否新品、是否热卖
    Route::get('/goods/set/{id}', 'admin\goods\GoodsController@doGnew');
    Route::get('/goods/sethot/{id}', 'admin\goods\GoodsController@doGhot');

    // 购物车
    Route::get('/shop', 'admin\goods\ShopController@index');

    // 订单
    Route::get('/order', 'admin\goods\ShopController@order');

    // 站点配置
    Route::get('/config', 'admin\config\ConfigController@index');
    Route::post('/config/{id}', 'admin\config\ConfigController@doConfig');

    // 轮播图
    Route::resource('/lunbo', 'admin\slides\SlidesController');
});