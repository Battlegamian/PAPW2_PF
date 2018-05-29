<?php namespace tutostube\Http\Controllers;

use tutostube\Http\Requests;
use tutostube\Http\Controllers\Controller;

use Illuminate\Http\Request;

class channelController extends Controller {

	public function index($id)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			//////////USER CHANNEL
			$userinfo = \tutostube\user::where('id', $id)->where('active', 1)->first();
			if($userinfo != null)
			{
				//////////CUREENT USER LOGED
				$activeuser = \tutostube\user::where('id', $_SESSION['user_session']['id'])->first();
				//////////DATE
				$datejoin = $userinfo->created_at->year.'/'.$userinfo->created_at->month.'/'.$userinfo->created_at->day;
				//////////VIDEOS SHARED
				$sharedvideos = \tutostube\video::where('id_user', $userinfo->id)->get();
				//////////FAVORITE VIDEOS
				$favinfovs = \tutostube\favorite::where('id_user', $userinfo->id)->get();
				$favvideos = array();
				$usersfavvideos = array();
				foreach ($favinfovs as $favinfov) 
				{
					$favvideo = \tutostube\video::where('id', $favinfov->id_video)->first();
					$userfavvideo = \tutostube\user::where('id', $favvideo->id_user)->first();
					$favvideos[] = $favvideo;
					$usersfavvideos[] = $userfavvideo;
				}
				//////////DID I GIVE FOLLOW
				$foll = \tutostube\follow::where('id_follower', $activeuser->id)
										  ->where('id_followed', $userinfo->id)->first();
				//////////CHANNELS
				$chaninfos = \tutostube\follow::where('id_follower', $userinfo->id)->get();
				$channels = array();
				foreach ($chaninfos as $chaninfo) 
				{
					$channel = \tutostube\user::where('id', $chaninfo->id_followed)->first();
					$channels[] = $channel;
				}
				$banreasons = \tutostube\userBanReason::all();

				return view('channel', compact('activeuser', 'userinfo', 'datejoin', 'sharedvideos', 'favvideos', 'usersfavvideos', 'foll', 'channels', 'banreasons'));
			}
			else
			{
				return redirect('principal');
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function banuser(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			\tutostube\userBan::create([
				'id_user' => $request['user_id'],
				'id_reason' => $request['reason']
			]);

			$user = \tutostube\user::where('id', $request['user_id'])->first();
			$user->active = 0;
			$user->save();

			return redirect('admin');
		}
		else
		{
			return redirect('/');
		}
	}

	public function removebanuser(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				$user = \tutostube\user::where('id', $request['idvideo'])->first();
				$user->active = 1;
				$user->save();
				\tutostube\userBan::where('id_user', $user->id)->delete();

				return redirect('admin/?page='.$request['bannedupage'].'&method=1');
			}
		}
		else
		{
			return redirect('/');
		}
	}
}
