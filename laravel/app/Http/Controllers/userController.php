<?php namespace tutostube\Http\Controllers;

use tutostube\Http\Requests;
use Illuminate\Support\Facades\DB;
use tutostube\Http\Controllers\Controller;

use Illuminate\Http\Request;

class userController extends Controller {

	public function index()
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($_SESSION['user_session']['type'] == 1)
			{
				return redirect('admin');
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

				return view('profile', compact('user', 'videotypes', 'sharedvideos', 'favvideos', 'usersfavvideos', 'channels'));
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function login(Request $request)
	{
		if($request->ajax())
		{
			$user = \tutostube\user::where('email', $request['email'])->first();
			if($user != null)
			{
				if($user->active == 1)
				{
					if(password_verify($request['password'], $user['password']))
					{
						session_start();
						$_SESSION['user_session'] = $user;
						return response()->json(['success' => true,'found' => true, 'user_type' => $user['type'], 'active' => true]);
					}
					else
					{
						return response()->json(['success' => false,'found' => true, 'active' => true]);
					}
				}
				else
				{
					return response()->json(['success' => false,'found' => true, 'active' => false]);
				}
			}
			else
			{
				return response()->json(['success' => false,'found' => false]);
			}
		}
	}

	public function logout()
	{
		session_start();
		session_destroy();
		return redirect('/');
	}

	public function register(Request $request)
	{
		if($request->ajax())
		{
			$info = DB::table('user')->where('email', $request['email'])->get();
			if($info != null)
			{
				return response()->json(['success' => false,'found' => $request['email']]);
			}
			else
			{
				$password = password_hash($request['password'], PASSWORD_DEFAULT,  array('cost'=>10));
				$birth_date = date_create($request['year'].'/'.$request['month'].'/'.$request['day']);
				$photo_profile = null;
				$photo_background = null;
				if($_FILES['photo_profile']['size'] != 0)
				{
					$photo_profile = file_get_contents($_FILES['photo_profile']['tmp_name']);
				}
				if($_FILES['photo_background']['size'] != 0)
				{
					$photo_background = file_get_contents($_FILES['photo_background']['tmp_name']);
				}
				\tutostube\user::create([
					'name' => $request['name'], 
					'last_name' => $request['last_name'], 
					'email' => $request['email'], 
					'password' => $password, 
					'birth_date' => $birth_date,
					'photo_profile' => $photo_profile,
					'photo_background' => $photo_background,
					'type' => 0,
					'active' => 1
				]);
				$session = \tutostube\user::where('email', $request['email'])->first();
				session_start();
				$_SESSION['user_session'] = $session;

				return response()->json(['success' => true,'found' => false]);
			}
		}
	}

	public function change_profile(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				if($_FILES['photo']['size'] != 0)
				{
					$user = \tutostube\user::where('id', $request['user_id'])->first();
					$user->photo_profile = file_get_contents($_FILES['photo']['tmp_name']);
					$user->save();
					return response()->json(['success' => true, 'image' => base64_encode($user->photo_profile)]);
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function change_background(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				if($_FILES['photo']['size'] != 0)
				{
					$user = \tutostube\user::where('id', $request['user_id'])->first();
					$user->photo_background = file_get_contents($_FILES['photo']['tmp_name']);
					$user->save();
					return response()->json(['success' => true, 'image' => base64_encode($user->photo_background)]);
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function  follow(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				//////////FOLLOW
				if($request['method'] == 0)
				{
					\tutostube\follow::create([
						'id_follower' => $request['follower'],
						'id_followed' => $request['followed'],
					]);
					return response()->json(['success' => true, 'method' => 1]);
				}
				//////////DISFOLLOW
				else
				{
					\tutostube\follow::where('id_follower', $request['follower'])->where('id_followed', $request['followed'])->delete();
					return response()->json(['success' => true, 'method' => 0]);
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}
}
