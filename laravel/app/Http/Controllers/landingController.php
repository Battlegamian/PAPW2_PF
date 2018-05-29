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
		// return view('index');
		session_start();
		if(isset($_SESSION['user_session']))
		{
			$user_type = $_SESSION['user_session']['type'];
			if($user_type = 1)
			{
				return redirect('admin');
			}
			else
			{
				return redirect('user');
			}
		}
		else
		{
			return view('index');
		}
	}
}
