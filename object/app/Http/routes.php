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
