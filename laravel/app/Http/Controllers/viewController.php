<?php namespace tutostube\Http\Controllers;

use tutostube\Http\Requests;
use tutostube\Http\Controllers\Controller;

use Illuminate\Http\Request;

class viewController extends Controller {

	public function index()
	{
		return view('view');
	}
}
