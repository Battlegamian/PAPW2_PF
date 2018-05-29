<div class='col-xs-12 col-sm-12 col-md-12 comments-container'>
	@foreach($comments as $comment)
	<div class='comment'>
		<a class='comment-user-photo' href='/canal/{{ $comment->userid }}' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($comment->userphoto) }}');"></a>
		<div class='comment-content'>
			<p>{{ $comment->username.' '.$comment->userlastname}}</p>
			<small>{{ $comment->date }}</small>
			<p>{{ $comment->comment }}</p>
		</div>
	</div>
	@endforeach
</div>
<div class='col-xs-12 col-sm-12 col-md-12 comments-container'>
	{!! $comments->render() !!}
</div>