@extends('layouts.layout-view')

@section('title')
<title>{{ $videoinfo->name }}</title>
@stop

@section('search')
<div id='search' class='popup' data-state='0'>
	<form id='search-form' class='popup-content' action='/busqueda' method='POST' accept-charset='UTF-8'>
		<div class='inputs-container'>
			<br>
			<div class='form-group'>
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for='search-inpt'>Buscar</label>
				<input type='text' class='form-control' id='search-inpt' name='search' placeholder='Buscar...' required>
			</div>
			<hr>
			<div class='form-group'>
				<label>Filtro</label><br>
				<input type='radio' name='search_type' value='content' checked> Contenido<br>
				<input type='radio' name='search_type' value='user'> Usuario<br>
			</div>
			<div class='form-group'>
				<label for='start_day'>Fecha de inicio</label>
				<div class='date-container'>
					<select id='start_day' name='start_day' class='form-control day date-search'>
							<option value=''>Dia</option>
					</select>
					<select id='start_month' name='start_month' class='form-control month date-search'>
							<option value=''>Mes</option>
					</select>
					<select id='start_year' name='start_year' class='form-control year date-search'>
							<option value=''>Año</option>
					</select>
				</div>
			</div>
			<div class='form-group'>
				<label for='end_day'>Fecha de final</label>
				<div class='date-container'>
					<select id='end_day' name='end_day' class='form-control day date-search'>
							<option value=''>Dia</option>
					</select>
					<select id='end_month' name='end_month' class='form-control month date-search'>
							<option value=''>Mes</option>
					</select>
					<select id='end_year' name='end_year' class='form-control year date-search'>
							<option value=''>Año</option>
					</select>
				</div>
			</div>
			<br>
			<button type='submit' class='btn btn-primary'>Buscar</button>
		</div>
	</form>
</div>
@if($activeuser->type == 1)
<div id='ban' class='popup' data-state='0'>
	<form id='ban-form' class='popup-content' action='/banvideo' method='POST' accept-charset='UTF-8'>
		<div class='inputs-container'>
			<br>
			<div class='form-group'>
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<input type='text' name='id_video' value='{{ $videoinfo->id }}' hidden>
				<label for='search-inpt'>Razón</label>
				<select name='reason' class='form-control' required>
					<option value=''>Razón de la prohibición</option>
					@foreach($banreasons as $banreason)
					<option value='{{ $banreason->id }}'>{{ $banreason->reason }}</option>
					@endforeach
				</select>
			</div>
			<hr>
			<button type='submit' class='btn btn-danger'>Prohibir</button>
		</div>
	</form>
</div>
@endif
@stop

@section('menu')
<nav class='navbar menu-style navbar-fixed-top'>
	<div class='container'>
		<div class='navbar-header'>
			<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#menu-NavBar'>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span> 
			</button>
			<a class='navbar-brand logo' href='/principal'><img src="{{ URL::asset('images/log-v8.png') }}"></a>
		</div>
		<div class='collapse navbar-collapse' id='menu-NavBar'>
			<ul class='nav navbar-nav navbar-right'>
				<li><a class='popup-trigger' data-target='#search'><span class='icon-magnifying-glass'></span> Buscar</a></li>
				<li class='dropdown'>
					<a class='dropdown-toggle user-profile' data-toggle='dropdown' href='#' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($activeuser->photo_profile) }}');"></a>
					<ul class='dropdown-menu profile-options'>
						@if($activeuser->type == 1)
							<li><a href="{{ url('admin') }}"><span class='icon-user'></span> Ver perfil</a></li>
						@else
							<li><a href="{{ url('perfil') }}"><span class='icon-user'></span> Ver perfil</a></li>
						@endif
						<li><a href="{{ url('logout') }}"><span class='icon-log-out'></span> Cerrar sesión</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
@stop

@section('videoresource')
<div class='col-xs-12 col-sm-12 col-md-12'>
	<video class='video-display' controls>
		<source src='/uploads/{{ $videoinfo->id }}.mp4' type='video/mp4'>
	</video>
</div>
@stop

@section('videoinfo')
<div class='col-xs-12 col-sm-12 col-md-12'>
	<div class='video-display-info'>
		<h4 class='video-display-title'>{{ $videoinfo->name }}</h4>
		<a class='user-photo' href='/canal/{{ $userinfo->id }}' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($userinfo->photo_profile) }}');"></a>
		<div class='video-display-content'>
			<p>{{ $userinfo->name.' '.$userinfo->last_name }}</p>
			<small>{{ $videoinfo->date }}</small>
			@if($videoinfo->description == null)
			<p>Sin descripción...</p>
			@else
			<p>{{ $videoinfo->description }}</p>
			@endif
			<div class='video-display-actions'>
				<span class='icon-eye'></span><p> {{ $videoinfo->views }}</p>
				<form id='like-form' action='#' data-state='0'>
					<input type='hidden' name='_token' value='{{ csrf_token() }}'>
					<input type='text' name='id_video' value='{{ $videoinfo->id }}' hidden>
					<input type='text' name='id_user' value='{{ $activeuser->id }}' hidden>
					@if($drop == null)
						<input class='method' type='text' name='method' value='0' hidden>
						<button type='submit'>
							<span id='like' class='icon-thumbs-up'></span><p> {{ $likescount }}</p>
						</button>
					@else
						<input class='method' type='text' name='method' value='1' hidden>
						<button type='submit'>
							<span id='like' class='icon-thumbs-up' style='color: #4285f4;'></span><p> {{ $likescount }}</p>
						</button>
					@endif
				</form>
				<form id='fav-form' action='#' data-state='0'>
					<input type='hidden' name='_token' value='{{ csrf_token() }}'>
					<input type='text' name='id_video' value='{{ $videoinfo->id }}' hidden>
					<input type='text' name='id_user' value='{{ $activeuser->id }}' hidden>
					@if($fav == null)
						<input class='method' type='text' name='method' value='0' hidden>
						<button type='submit'>
							<span id='fav' class='icon-heart'></span>
						</button>
					@else
						<input class='method' type='text' name='method' value='1' hidden>
						<button type='submit'>
							<span id='fav' class='icon-heart' style='color: #fa8072;'></span>
						</button>
					@endif
				</form>
			</div>
		</div>
		<div class='do-comment'>
			<form id='comment-form' action='#' data-state='0'>
				<div class='inputs-container'>
					<input type='hidden' name='_token' value='{{ csrf_token() }}'>
					<input type='text' name='id_video' value='{{ $videoinfo->id }}' hidden>
					<input type='text' name='id_user' value='{{ $activeuser->id }}' hidden>
					<input class='latest_page' type='text' name='latest_page' hidden>
					<input class='comments-order' type='text' name='order' hidden>
					<input class='comment-date' type='date' name='date' hidden>
					<div class='form-group'>
						<label for='comment'>Comentar</label>
						<textarea class='form-control' rows='3' id='comment' name='comment' placeholder='Comentar...' maxlength='500' required></textarea>
					</div>
					<input class='btn btn-primary' type='submit' value='Publicar'>
				</div>
			</form>
			<button class='btn-cmt-order btn btn-success' data-state='0'>mas recientes a mas viejos</button>
			@if($activeuser->type == 1)
			<button class='btn-ban btn btn-danger popup-trigger' data-target='#ban'>prohibir contenido</button>
			@endif
		</div>
	</div>
</div>
@stop

@section('comments')
<div class='comments-section'>
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
</div>
@stop

