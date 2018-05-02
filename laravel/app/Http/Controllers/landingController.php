<?php namespace tutostube\Http\Controllers;

use tutostube\Http\Requests;
use tutostube\Http\Controllers\Controller;

use Illuminate\Http\Request;

class landingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('index');
	}

	public function getImages()
	{
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
	}

}
