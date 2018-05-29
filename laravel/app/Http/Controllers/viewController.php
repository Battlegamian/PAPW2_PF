<?php namespace tutostube\Http\Controllers;

use tutostube\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use tutostube\Http\Controllers\Controller;

use Illuminate\Http\Request;

class viewController extends Controller {

	public function index($id, $order, Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				if($order == 0)
				{
					$comments = DB::table('user')->select('user.id as userid', 'user.name as username', 'user.last_name as userlastname', 'user.photo_profile as userphoto', 'comments.comment as comment', 'comments.created_at as date')
					->join('comments', 'comments.id_user', '=', 'user.id')
					->where('comments.id_video', $id)
					->where('user.active', 1)
					->orderBy('comments.id', 'ASC')->paginate(5);
				}
				else
				{
					$comments = DB::table('user')->select('user.id as userid', 'user.name as username', 'user.last_name as userlastname', 'user.photo_profile as userphoto', 'comments.comment as comment', 'comments.created_at as date')
					->join('comments', 'comments.id_user', '=', 'user.id')
					->where('comments.id_video', $id)
					->where('user.active', 1)
					->orderBy('comments.id', 'DESC')->paginate(5);
				}
				return response()->json(view('comments', compact('comments'))->render());
			}
			else
			{
				//////////VIDEO INFORMATION
				$videoinfo = \tutostube\video::where('id', $id)->where('active', 1)->first();
				if($videoinfo != null)
				{
					$videoinfo->views = $videoinfo->views + 1;
					$videoinfo->save();
					//////////CUREENT USER LOGED
					$activeuser = \tutostube\user::where('id', $_SESSION['user_session']['id'])->first();
					//////////LIKES
					$likes = \tutostube\like::where('id_video', $videoinfo->id)->get();
					$likescount = $likes->count();
					//////////DID I DROP A LIKE?
					$drop = null;
					foreach ($likes as $like) {
						if($like->id_user == $activeuser->id)
						{
							$drop = 1;
							break;
						}
					}
					//////////DID I GIVE FAV?
					$fav = \tutostube\favorite::where('id_user', $activeuser->id)
											  ->where('id_video', $videoinfo->id)->first();
					//////////USER WHO UPLOADED THE VIDEO
					$userinfo = \tutostube\user::where('id', $videoinfo->id_user)->first();
					//////////COMMENTS
					$comments = DB::table('user')->select('user.id as userid', 'user.name as username', 'user.last_name as userlastname', 'user.photo_profile as userphoto', 'comments.comment as comment', 'comments.created_at as date')
					->join('comments', 'comments.id_user', '=', 'user.id')
					->where('comments.id_video', $videoinfo->id)
					->where('user.active', 1)->paginate(5);
					//////////BAN REASONS
					$banreasons = \tutostube\videoBanReason::all();

					return view('view', compact('activeuser', 'videoinfo', 'likescount', 'drop', 'fav', 'userinfo', 'comments', 'banreasons'));
				}
				else
				{
					return redirect('principal');
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function uploadvideo(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				if($_FILES['video']['size'] != 0)
				{
					$thumbnail = null;
					if($_FILES['photo']['size'] != 0)
					{
						$thumbnail = file_get_contents($_FILES['photo']['tmp_name']);
					}
					$videosaved = \tutostube\video::create([
						'id_user' => $request['user_id'],
						'id_type' => $request['type'],
						'name' => $request['name'],
						'description' => $request['desc'],
						'url' => 'tmp',
						'views' => 0,
						'photo' => $thumbnail,
						'date' => $request['date'],
						'active' => 1
					]);
					$user_up = \tutostube\user::where('id', $request['user_id'])->first();

					$extension = $request->file('video')->getClientOriginalExtension();
					$request->file('video')->move(public_path('/uploads'), $videosaved->id.'.'.$extension);
					$thumbnail = base64_encode($videosaved->photo);
					return response()->json(['success' => true, 
						'id' => $videosaved->id,
						'title' => $videosaved->name,
						'image' => $thumbnail,
						'views' => $videosaved->views,
						'user_name' => $user_up->name.' '.$user_up->last_name
					]);
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function like(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				//////////LIKE
				if($request['method'] == 0)
				{
					\tutostube\like::create([
						'id_video' => $request['id_video'],
						'id_user' => $request['id_user'],
					]);
					$likes = \tutostube\like::where('id_video', $request['id_video'])->get();
					$likescount = $likes->count();
					return response()->json(['success' => true, 'method' => 1, 'likes' => $likescount]);
				}
				//////////DISLIKE
				else
				{
					\tutostube\like::where('id_video', $request['id_video'])->where('id_user', $request['id_user'])->delete();
					$likes = \tutostube\like::where('id_video', $request['id_video'])->get();
					$likescount = $likes->count();
					return response()->json(['success' => true, 'method' => 0, 'likes' => $likescount]);
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function fav(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				//////////FAV
				if($request['method'] == 0)
				{
					\tutostube\favorite::create([
						'id_video' => $request['id_video'],
						'id_user' => $request['id_user'],
					]);
					return response()->json(['success' => true, 'method' => 1]);
				}
				//////////DISFAV
				else
				{
					\tutostube\favorite::where('id_video', $request['id_video'])->where('id_user', $request['id_user'])->delete();
					return response()->json(['success' => true, 'method' => 0]);
				}
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function comment(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				\tutostube\comment::create([
					'id_user' => $request['id_user'],
					'id_video' => $request['id_video'],
					'comment' => $request['comment'],
					'date' => $request['date']
				]);
				return redirect('view/'.$request['id_video'].'/'.$request['order'].'?page='.$request['latest_page']);
			}
		}
		else
		{
			return redirect('/');
		}
	}

	public function banvideo(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			\tutostube\videoBan::create([
				'id_video' => $request['id_video'],
				'id_reason' => $request['reason']
			]);

			$video = \tutostube\video::where('id', $request['id_video'])->first();
			$video->active = 0;
			$video->save();

			return redirect('admin');
		}
		else
		{
			return redirect('/');
		}
	}

	public function removebanvideo(Request $request)
	{
		session_start();
		if(isset($_SESSION['user_session']))
		{
			if($request->ajax())
			{
				$video = \tutostube\video::where('id', $request['idvideo'])->first();
				$video->active = 1;
				$video->save();
				\tutostube\videoBan::where('id_video', $video->id)->delete();

				return redirect('admin/?page='.$request['bannedvpage'].'&method=0');
			}
		}
		else
		{
			return redirect('/');
		}
	}
}
