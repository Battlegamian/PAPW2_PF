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

Route::get('/', 'landingController@index');

Route::get('/principal', 'mainController@index_get');

Route::resource('/busqueda', 'mainController@index_post');

Route::get('/perfil', 'userController@index');

Route::get('/canal/{id}', 'channelController@index')->where('id', '[0-9]+');

Route::get('/view/{id}/{order}', 'viewController@index')->where(['id' => '[0-9]+', 'order' => '[0-1]']);

Route::get('/admin', 'adminController@index');

Route::get('/GetTransitionImgs', function(){
	if(Request::ajax())
	{
		$directory = $_GET['dir'];
		$open_directory = opendir($directory);
		$imgs = array();
		while(($img = readdir($open_directory)))
		{
			$imgs[] = $img;
		}
		unset($imgs[0]);
		unset($imgs[1]);
		echo json_encode($imgs);
	}
});

Route::resource('/login', 'userController@login');

Route::resource('/logout', 'userController@logout');

Route::resource('/register', 'userController@register');

Route::resource('/change_profile', 'userController@change_profile');

Route::resource('/change_background', 'userController@change_background');

Route::resource('/upload_video', 'viewController@uploadvideo');

Route::resource('/like', 'viewController@like');

Route::resource('/fav', 'viewController@fav');

Route::resource('/follow', 'userController@follow');

Route::resource('/comment', 'viewController@comment');

Route::resource('/banvideo', 'viewController@banvideo');

Route::resource('/removebanvideo', 'viewController@removebanvideo');

Route::resource('/banuser', 'channelController@banuser');

Route::resource('/removebanuser', 'channelController@removebanuser');


