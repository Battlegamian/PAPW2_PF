<div role='tabpanel' id='shared' class='tab-pane active'>
	<h3 class='divisor'>Compartido</h3>
	<div class='row'>
		@foreach($sharedvideos as $sharedvideo)
		<div class='col-xs-12 col-sm-4 col-md-3'>
			<div class='video'>
				<a class='video-img' href='/view/{{ $sharedvideo->videoid }}/0' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($sharedvideo->videophoto) }}');">
					<span class='icon-controller-play'></span>
				</a>
				<div class='video-info'>
					<p class='video-title'>{{ $sharedvideo->videoname }}</p>
					<p class='video-user'>Por: {{ $user->name.' '.$user->last_name }}</p>
					<p class='video-video-info'><span class='icon-eye'></span> {{ $sharedvideo->videoviews }} <span class='icon-message'></span> {{ $sharedvideo->countcomments }}</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

$sharedvideos = DB::table('video')->select(array('video.id as videoid', 'video.photo as videophoto', 'video.name as videoname', 'video.views as videoviews', DB::raw('COUNT(comments.id) as countcomments')))
					->join('comments', 'comments.id_video', '=', 'video.id')
					->where('video.active', 1)
					->where('video.id_user', $_SESSION['user_session']['id'])->get();




<div role='tabpanel' id='shared' class='tab-pane active'>
	<h3 class='divisor'>Compartido</h3>
	<div class='row'>
		@foreach($sharedvideos as $sharedvideo)
		<div class='col-xs-12 col-sm-4 col-md-3'>
			<div class='video'>
				<a class='video-img' href='/view/{{ $sharedvideo->id }}/0' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($sharedvideo->photo) }}');">
					<span class='icon-controller-play'></span>
				</a>
				<div class='video-info'>
					<p class='video-title'>{{ $sharedvideo->name }}</p>
					<p class='video-user'>Por: {{ $user->name }}</p>
					<p class='video-video-info'><span class='icon-eye'></span> {{ $sharedvideo->views }}</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>



<div role='tabpanel' id='favorites' class='tab-pane'>
	<h3 class='divisor'>Favoritos</h3>
	<div class='row'>
		@foreach($favoritevideos as $favoritevideo)
		<div class='col-xs-12 col-sm-4 col-md-3'>
			<div class='video'>
				<a class='video-img' href='/view/{{ $favoritevideo->videoid }}/0' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($favoritevideo->videophoto) }}');">
					<span class='icon-controller-play'></span>
				</a>
				<div class='video-info'>
					<p class='video-title'>{{ $favoritevideo->videoname }}</p>
					<p class='video-user'>Por: {{ $favoritevideo->username.' '.$favoritevideo->userlastname }}</p>
					<p class='video-video-info'><span class='icon-eye'></span> {{ $favoritevideo->videoviews }} <span class='icon-message'></span> {{ $favoritevideo->countcomments }}</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>


<div role='tabpanel' id='favorites' class='tab-pane'>
	<h3 class='divisor'>Favoritos</h3>
	<div class='row'>
		@foreach($favvideos as $index => $favvideo)
		<div class='col-xs-12 col-sm-4 col-md-3'>
			<div class='video'>
				<a class='video-img' href='/view/{{ $favvideo->id }}/0' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($favvideo->photo) }}');">
					<span class='icon-controller-play'></span>
				</a>
				<div class='video-info'>
					<p class='video-title'>{{ $favvideo->name }}</p>
					<p class='video-user'>Por: {{ $usersfavvideos[$index]->name }}</p>
					<p class='video-video-info'><span class='icon-eye'></span> {{ $favvideo->views }}</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>