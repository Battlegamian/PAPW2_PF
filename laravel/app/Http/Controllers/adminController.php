<?php namespace tutostube\Http\Controllers;

use tutostube\Http\Requests;
use Illuminate\Support\Facades\DB;
use tutostube\Http\Controllers\Controller;

use Illuminate\Http\Request;

class adminController extends Controller {

	public function index(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($_SESSION['user_session']['type'] == 0)
			{
				return redirect('perfil');
			}
			else
			{
				if($request->ajax())
				{
					if($request['method'] == 0)
					{
						$bannedvideos = DB::table('video')->select('video.id as videoid', 'video.name as name', 'user.name as username', 'user.email as useremail', 'video_ban_reason.reason as reason', 'video_ban.created_at as date')
						->join('video_ban', 'video_ban.id_video', '=', 'video.id')
						->join('video_ban_reason', 'video_ban_reason.id', '=', 'video_ban.id_reason')
						->join('user', 'user.id', '=', 'video.id_user')->paginate(2);

						return response()->json(view('bannedvideos', compact('bannedvideos'))->render());
					}
					else
					{
						$bannedusers = DB::table('user')->select('user.id as userid', 'user.name as username', 'user.last_name as userlastname', 'user.email as email', 'user_ban_reason.reason as reason', 'user_ban.created_at as date')
						->join('user_ban', 'user_ban.id_user', '=', 'user.id')
						->join('user_ban_reason', 'user_ban_reason.id', '=', 'user_ban.id_reason')->paginate(2);
					
						return response()->json(view('bannedusers', compact('bannedusers'))->render());
					}
				}
				else
				{
					$user = \tutostube\user::where('id', $_SESSION['user_session']['id'])->first();
					$videotypes = \tutostube\videoType::all();

					$sharedvideos = DB::table('video')
					->select('video.id as videoid', 'video.photo as videophoto', 'video.name as videoname', 'video.views as videoviews', DB::raw('COUNT(comments.id_video) as countcomments'))
					->leftJoin('comments', 'video.id', '=', 'comments.id_video')
					->where('video.active', 1)
					->where('video.id_user', $_SESSION['user_session']['id'])
					->groupBy('video.id')->get();

					$favoritevideos = DB::table('video')
					->join('favorite', 'favorite.id_video', '=', 'video.id')
					->select('video.id as videoid', 'video.photo as videophoto', 'video.name as videoname', 'user.name as username', 'user.last_name as userlastname', 'video.views as videoviews', DB::raw('COUNT(comments.id_video) as countcomments'))
					->leftJoin('comments', 'video.id', '=', 'comments.id_video')
					->join('user', 'user.id', '=', 'video.id_user')
					->where('video.active', 1)
					->where('favorite.id_user', $_SESSION['user_session']['id'])
					->where('user.active', 1)
					->groupBy('video.id')->get();

					$chaninfos = \tutostube\follow::where('id_follower', $user->id)->get();
					$channels = array();
					foreach ($chaninfos as $chaninfo) 
					{
						$channel = \tutostube\user::where('id', $chaninfo->id_followed)->where('active', 1)->first();
						if($channel != null)
						{
							$channels[] = $channel;
						}
					}

					$bannedvideos = DB::table('video')->select('video.id as videoid', 'video.name as name', 'user.name as username', 'user.email as useremail', 'video_ban_reason.reason as reason', 'video_ban.created_at as date')
					->join('video_ban', 'video_ban.id_video', '=', 'video.id')
					->join('video_ban_reason', 'video_ban_reason.id', '=', 'video_ban.id_reason')
					->join('user', 'user.id', '=', 'video.id_user')->paginate(2);

					$bannedusers = DB::table('user')->select('user.id as userid', 'user.name as username', 'user.last_name as userlastname', 'user.email as email', 'user_ban_reason.reason as reason', 'user_ban.created_at as date')
					->join('user_ban', 'user_ban.id_user', '=', 'user.id')
					->join('user_ban_reason', 'user_ban_reason.id', '=', 'user_ban.id_reason')->paginate(2);

					return view('admin', compact('user', 'videotypes', 'sharedvideos', 'favoritevideos', 'channels', 'bannedvideos', 'bannedusers'));
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}
}
