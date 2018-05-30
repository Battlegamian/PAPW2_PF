<?php namespace tutostube\Http\Controllers;

use tutostube\Http\Requests;
use Illuminate\Support\Facades\DB;
use tutostube\Http\Controllers\Controller;

use Illuminate\Http\Request;

class mainController extends Controller {

	public function index_get()
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			$search = 'Principal';
			$search_type = 'content';
			//////////CUREENT USER LOGED
			$activeuser = \tutostube\user::where('id', $_SESSION['user_session']['id'])->first();
			//////////GET VIDEOS
			$videos = DB::table('video')
			->select('video.id as videoid', 'video.photo as videophoto', 'video.name as videoname', 'user.name as username', 'user.last_name as userlastname', 'video.views as videoviews', DB::raw('COUNT(comments.id_video) as countcomments'))
			->leftJoin('comments', 'video.id', '=', 'comments.id_video')
			->join('user', 'user.id', '=', 'video.id_user')
			->where('video.active', 1)
			->where('user.active', 1)
			->groupBy('video.id')->paginate(8);

			return view('main', compact('search', 'search_type', 'activeuser', 'videos', 'channels'));
		}
		else
		{
			return redirect('/');
		}
	}

	public function index_post(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			$search = $request['search'];
			$search_type = $request['search_type'];
			//////////CUREENT USER LOGED
			$activeuser = \tutostube\user::where('id', $_SESSION['user_session']['id'])->first();
			//////////GET VIDEOS
			if($search_type == 'content')
			{
				if($request['start_day'] == null)
				{
					$videos = DB::table('video')
					->select('video.id as videoid', 'video.photo as videophoto', 'video.name as videoname', 'user.name as username', 'user.last_name as userlastname', 'video.views as videoviews', DB::raw('COUNT(comments.id_video) as countcomments'))
					->leftJoin('comments', 'video.id', '=', 'comments.id_video')
					->join('user', 'user.id', '=', 'video.id_user')
					->where('video.active', 1)
					->where('user.active', 1)
					->where(function($query) use($search){
						$query->where('video.name', 'like', '%'.$search.'%')
						->orWhere('user.name', 'like', '%'.$search.'%')
						->orWhere('user.last_name', 'like', '%'.$search.'%');
					})
					->groupBy('video.id')->paginate(8);
				}
				else
				{
					$start_date = date_create($request['start_year'].'/'.$request['start_month'].'/'.$request['start_day']);
					$end_date = date_create($request['end_year'].'/'.$request['end_month'].'/'.$request['end_day']);

					$videos = DB::table('video')
					->select('video.id as videoid', 'video.photo as videophoto', 'video.name as videoname', 'user.name as username', 'user.last_name as userlastname', 'video.views as videoviews', DB::raw('COUNT(comments.id_video) as countcomments'))
					->leftJoin('comments', 'video.id', '=', 'comments.id_video')
					->join('user', 'user.id', '=', 'video.id_user')
					->where('video.active', 1)
					->where('user.active', 1)
					->whereBetween('video.date', [$start_date->format('y-m-d'), $end_date->format('y-m-d')])
					->where(function($query) use($search){
						$query->where('video.name', 'like', '%'.$search.'%')
						->orWhere('user.name', 'like', '%'.$search.'%')
						->orWhere('user.last_name', 'like', '%'.$search.'%');
					})
					->groupBy('video.id')->paginate(8);
				}
			}
			else
			{
				$channels = \tutostube\user::where('name', 'like', '%'.$search.'%')->where('active', 1)->paginate(8);
			}
			
			return view('main', compact('search', 'search_type', 'activeuser', 'videos', 'channels'));
		}
		else
		{
			return redirect('/');
		}
	}
}
