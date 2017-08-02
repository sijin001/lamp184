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

//影票后台路由群组
Route::group(['prefix' => 'admin','middleware' => 'login'],function(){
	//后台首页显示
	Route::get('/film', 'admin\user\ShowController@index');
	Route::get('/film/set/{id}','admin\user\ShowController@show');
	Route::post('/film/update/{id}','admin\user\ShowController@updato');
	Route::get('/film/get','admin\user\ShowController@showgl');

	//user用户资源路由
	Route::resource('/user', 'admin\user\MoControllers');
						//删除列表路由，ajax方式传输
	Route::get('/delete','admin\user\MoControllers@delo');


    
    // 商品
    Route::resource('/goods', 'admin\goods\GoodsController');
                                    // 商品状态：是否新品、是否热卖
    Route::get('/goods/set/{id}', 'admin\goods\GoodsController@doGnew');
    Route::get('/goods/sethot/{id}', 'admin\goods\GoodsController@doGhot');
	                               // 分类
    Route::resource('/type', 'admin\type\TypeController');

                                     // 购物车
    Route::get('/shop', 'admin\goods\ShopController@index');

                                    // 订单
    Route::get('/order', 'admin\goods\ShopController@order');

    // 站点配置
    Route::get('/config', 'admin\config\ConfigController@index');
    Route::post('/config/{id}', 'admin\config\ConfigController@doConfig');

    // 轮播图
    Route::resource('/lunbo', 'admin\slides\SlidesController');

    //电影
    Route::resource('/movie', 'admin\movie\MovieController');
	Route::post('/movieajax','admin\movie\MovieController@doChange');
	Route::post('/movieroomajax','admin\movie\MovieRoomController@doChange');
	Route::post('/movieshowajax','admin\movie\MovieShowController@doChange');
	Route::resource('/movieroom', 'admin\movie\MovieRoomController');
	Route::resource('/movieshow', 'admin\movie\MovieShowController');
	Route::resource('/moviecomment', 'admin\movie\MovieCommentController');

    //友情链接资源路由
	Route::resource('/link', 'admin\link\MoControllers');
						//删除友情链接路由，ajax方式传输
	Route::get('/deletetwo','admin\link\MoControllers@delo');


	//广告版块资源路由
	Route::resource('/ads','admin\ads\MoControllers');
						//删除友情链接路由，ajax方式传输
	Route::get('/deletethree','admin\ads\MoControllers@delo');



	//退出
	Route::get('/over','admin\user\LoginController@out');
});

//中间件————登录控制
//后台登录验证页面
Route::get('admin/login', 'admin\user\LoginController@index');
//后台引入验证码图片
Route::get('admin/capth/{tmp}','admin\user\LoginController@capth');
//后台用户密码验证码判断
Route::post('admin/login','admin\user\LoginController@doLogin');






//前台路由群组

Route::group(['prefix' => 'home','middleware' => 'logins'],function(){
	//我的资料
	Route::resource('/user', 'home\user\UserController');
	//我的订单
	Route::resource('/order', 'home\user\OrderController');
	//我的积分
	Route::resource('/score', 'home\user\ScoreController');
    //我的购物车
    Route::resource('/gouwu','home\user\GouwuController');

    //电影
    Route::resource('/movieorder','home\movie\MovieOrderController');
    Route::resource('/movieajax','home\movie\MovieAjaxController');
    Route::resource('/movie/seat','home\movie\MovieSeatController');
    Route::get('/movie/seat/capth/{tmp}','home\movie\MovieSeatController@capth');
    Route::resource('/moviecapth','home\movie\MovieCapthController');


	//前台订单
	Route::resource('/goodsorder', 'home\goods\OrderController');
	Route::resource('/confirmorder', 'home\goods\ConfirmController');
    Route::get('/ordersuccess/{tmp}', 'home\goods\ConfirmController@doSuccess');

	
	
	

	//前台退出
	Route::get('/over','home\user\LoginController@out');
});
// ajax请求城市地址
Route::get('/goodsorder/get', 'home\goods\OrderController@doGet');
Route::post('/goodsorder/post', 'home\goods\OrderController@doPost');

//前台登录

//前台登录login页面和判断
Route::resource('/login','home\user\LoginController');
//前台引入验证码图片
Route::get('/capth/{tmp}','home\user\LoginController@capth');

//前台商品
Route::resource('/goods', 'home\goods\GoodsController');
// 商品列表
Route::resource('/list', 'home\goods\ListController');
Route::get('/list/{id}', 'home\goods\ListController@show');

//电影
Route::resource('/home/movie/description','home\movie\MovieDesController');
Route::resource('/home/movie/get','home\movie\MovieGetController');
Route::resource('/home/movieplace','home\movie\MoviePlaceController');


//前台首页
Route::get('/','home\HomeController@index');
//前台注册
Route::resource('/regist','home\user\RegistController');
Route::get('/smsphone','home\user\RegistController@smsphone');
