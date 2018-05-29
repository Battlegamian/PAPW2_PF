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
					$sharedvideos = \tutostube\video::where('id_user', $_SESSION['user_session']['id'])->where('active', 1)->get();

					$favinfovs = \tutostube\favorite::where('id_user', $_SESSION['user_session']['id'])->get();
					$favvideos = array();
					$usersfavvideos = array();
					foreach ($favinfovs as $favinfov) 
					{
						$favvideo = \tutostube\video::where('id', $favinfov->id_video)->where('active', 1)->first();
						if($favvideo != null)
						{
							$userfavvideo = \tutostube\user::where('id', $favvideo->id_user)->first();
							$favvideos[] = $favvideo;
							$usersfavvideos[] = $userfavvideo;
						}
					}

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

					return view('admin', compact('user', 'videotypes', 'sharedvideos', 'favvideos', 'usersfavvideos', 'channels', 'bannedvideos', 'bannedusers'));
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}
}
