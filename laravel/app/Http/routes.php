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

Route::get('/principal', 'mainController@index');

Route::get('/perfil', 'userController@index');

Route::get('/canal', 'channelController@index');

Route::get('/view', 'viewController@index');

Route::get('/admin', 'adminController@index');

// Route::get('/GetTransitionImgs', 'landingController@getImages');

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