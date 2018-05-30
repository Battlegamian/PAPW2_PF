@extends('layouts.layout-channel')

@section('title')
<title>{{ $userinfo->name.' '.$userinfo->last_name }}</title>
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
	<form id='ban-form' class='popup-content' action='/banuser' method='POST' accept-charset='UTF-8'>
		<div class='inputs-container'>
			<br>
			<div class='form-group'>
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<input type='text' name='user_id' value='{{ $userinfo->id }}' hidden>
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

@section('infouser')
<div class='col-xs-12 col-sm-12 col-md-12'>
	<div class='background-user' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($userinfo->photo_background) }}');">
		<div class='profile-user' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($userinfo->photo_profile) }}');"></div>
	</div>
</div>
<div class='col-xs-12 col-sm-12 col-md-12'>
	<div class='info-user'>
		<p>{{ $userinfo->name.' '.$userinfo->last_name }}</p>
		<small>{{ $userinfo->email }}</small><br>
		<small>Se unio el {{ $datejoin }}</small>
		<form id='follow-form' action='#' data-state='0'>
			<input type='hidden' name='_token' value='{{ csrf_token() }}'>
			<input type='text' name='followed' value='{{ $userinfo->id }}' hidden>
			<input type='text' name='follower' value='{{ $activeuser->id }}' hidden>
			@if($foll == null)
				<input class='method' type='text' name='method' value='0' hidden>
				<button type='submit'><span id='foll' class='icon-add-user'></span></button>
			@else
				<input class='method' type='text' name='method' value='1' hidden>
				<button type='submit'><span id='foll' class='icon-add-user' style='color: #4285f4;'></span></button>
			@endif
		</form>
		@if($activeuser->type == 1)
		<button class='btn-ban btn btn-danger popup-trigger' data-target='#ban'>prohibir cuenta</button>
		@endif
	</div>
</div>
@stop

@section('shared')
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
					<p class='video-user'>Por: {{ $userinfo->name.' '.$userinfo->last_name }}</p>
					<p class='video-video-info'><span class='icon-eye'></span> {{ $sharedvideo->videoviews }} <span class='icon-message'></span> {{ $sharedvideo->countcomments }}</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@stop

@section('favorites')
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
@stop

@section('channels')
<div role='tabpanel' id='channels' class='tab-pane'>
	<h3 class='divisor'>Canales seguidos</h3>
	<div class='row'>
		@foreach($channels as $channel)
		<div class='col-xs-12 col-sm-4 col-md-3'>
			<div class='channel'>
				<a class='channel-img' href='/canal/{{ $channel->id }}' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($channel->photo_profile) }}');"></a>
				<p class='channel-name'>{{ $channel->name.' '.$channel->last_name }}</p>
			</div>
		</div>
		@endforeach
	</div>
</div>
@stop