@extends('layouts.layout-main')

@section('title')
	<title>{{ $search }}</title>
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

@section('content')
<div class='row'>
	@if($search_type == 'content')
		@if(count($videos) != 0)
			@foreach($videos as $video)
				<div class='col-xs-12 col-sm-4 col-md-3'>
					<div class='video'>
						<a class='video-img' href='/view/{{ $video->videoid }}/0' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($video->videophoto) }}');">
							<span class='icon-controller-play'></span>
						</a>
						<div class='video-info'>
							<p class='video-title'>{{ $video->videoname }}</p>
							<p class='video-user'>Por: {{ $video->username.' '.$video->userlastname }}</p>
							<p class='video-video-info'><span class='icon-eye'></span> {{ $video->videoviews }} <span class='icon-message'></span> {{ $video->countcomments }}</p>
						</div>
					</div>
				</div>
			@endforeach
		@else
		<div class='col-xs-12 col-sm-4 col-md-3'>
			<div class='video'>
				<div class='video-info'>
					<h4>Sin resultados :(</h4>
				</div>
			</div>
		</div>
		@endif
	@else
		@if(count($channels) != 0)
			@foreach($channels as $channel)
				<div class='col-xs-12 col-sm-4 col-md-3'>
					<div class='channel'>
						<a class='channel-img' href='/canal/{{ $channel->id }}' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($channel->photo_profile) }}');"></a>
						<p class='channel-name'>{{ $channel->name.' '.$channel->last_name }}</p>
					</div>
				</div>
			@endforeach
		@else
		<div class='col-xs-12 col-sm-4 col-md-3'>
			<div class='video'>
				<div class='video-info'>
					<h4>Sin resultados :(</h4>
				</div>
			</div>
		</div>
		@endif
	@endif
</div>
@stop

@section('pagination')
<div class='row'>
	<div class='col-xs-12 col-sm-12 col-md-12'>
		<br><br>
		@if($search_type == 'content')
			{!!$videos->render()!!}
		@else
			{!!$channels->render()!!}
		@endif
		<br><br><br><br>
	</div>
</div>
@stop