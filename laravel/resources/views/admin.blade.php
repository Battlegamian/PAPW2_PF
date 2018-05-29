@extends('layouts.layout-admin')

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
			<a class='navbar-brand logo' href='/principal'><img src='images/log-v8.png'></a>
		</div>
		<div class='collapse navbar-collapse' id='menu-NavBar'>
			<ul class='nav navbar-nav navbar-right'>
				<li><a class='popup-trigger' data-target='#search'><span class='icon-magnifying-glass'></span> Buscar</a></li>
				<li class='dropdown'>
					<a class='dropdown-toggle user-profile' data-toggle='dropdown' href='#' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($user->photo_profile) }}');"></a>
					<ul class='dropdown-menu profile-options'>
						<li><a href='admin'><span class='icon-user'></span> Ver perfil</a></li>
						<li><a href='logout'><span class='icon-log-out'></span> Cerrar sesión</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
@stop

@section('info')
<div class='col-xs-12 col-sm-12 col-md-12'>
	<div class='background-user' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($user->photo_background) }}');">
		<div class='profile-user' style="background-image: url('data:image/jpeg;base64,{{ base64_encode($user->photo_profile) }}');">
			<form id='photo-profile-change' class='btn-input-file-container btn-input-file-center' enctype='multipart/form-data'>
				<input type='hidden' name='_token' value='{{ csrf_token() }}'>
				<input type='text' name='user_id' value='{{ $user->id }}' hidden>
				<input type='file' accept='image/x-png,image/gif,image/jpeg' name='photo' hidden>
				<button type='button'><span class='icon-edit'></span></button>
			</form>
		</div>
		<form id='photo-background-change' class='btn-input-file-container btn-input-file-right' enctype='multipart/form-data'>
			<input type='hidden' name='_token' value='{{ csrf_token() }}'>
			<input type='text' name='user_id' value='{{ $user->id }}' hidden>
			<input type='file' accept='image/x-png,image/gif,image/jpeg' name='photo' hidden>
			<button type='button'><span class='icon-edit'></span></button>
		</form>
	</div>
</div>
<div class='col-xs-12 col-sm-12 col-md-12'>
	<div class='info-user'>
		<p>{{ $user->name.' '.$user->last_name }}</p>
		<small>{{ $user->email }}</small><br>
	</div>
</div>
@stop

@section('upload_video')
<div role='tabpanel' id='upload' class='tab-pane'>
	<h3 class='divisor'>Subir video</h3>
	<form id='upload-form' enctype='multipart/form-data' action='#' data-state='0'>
		<div class='inputs-container'>
			<input type='hidden' name='_token' value='{{ csrf_token() }}'>
			<input type='text' name='user_id' value='{{ $user->id }}' hidden>
			<input class='date-ipt' type='date' name='date' hidden>
			<div class='form-group'>
				<label for='name'>Nombre</label>
				<input id='name' name='name' type='text' class='form-control' placeholder='Nombre...' required>
			</div>
			<div class='form-group'>
				<label for='desc'>Descripción</label>
				<textarea class='form-control' rows='3' id='desc' name='desc' placeholder='Descripción...' maxlength='500'></textarea>
			</div>
			<div class='form-group'>
				<label for='type'>Tipo</label>
				<select id='type' name='type' class='form-control' required>
					<option value=''>Tipo</option>
					@foreach($videotypes as $videotype)
					<option value='{{ $videotype->id }}'>{{ $videotype->type }}</option>
					@endforeach
				</select>
			</div>
			<div class='form-group'>
				<label for='photo'>Miniatura</label>
				<div class='file-container'>
					<input type='text' class='form-control' placeholder='Miniatura...'>
					<input id='photo' name='photo' type='file' accept='image/x-png,image/gif,image/jpeg'>
				</div>
			</div>
			<div class='form-group'>
				<label for='video'>Video</label>
				<div class='file-container'>
					<input type='text' class='form-control' placeholder='Archivo de video...' required>
					<input id='video' name='video' type='file' accept='video/mp4,video/x-m4v,video/*'>
				</div>
			</div>
			<input class='btn btn-primary' type='submit' value='Subir video'>
		</div>
	</form>
</div>
@stop

@section('shared')
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
@stop

@section('favorites')
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

@section('bannedusers')
<div role='tabpanel' id='banned-users' class='tab-pane'>
	<h3 class='divisor'>Usuarios baneados</h3>
	<div class='table-responsive bannedusers'>
		<table class='table table-hover'>
			<thead>
				<tr>
					<th>id</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Correo</th>
					<th>Ban</th>
					<th>Fecha de ban</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($bannedusers as $banneduser)
				<tr>
					<td>{{ $banneduser->userid }}</td>
					<td>{{ $banneduser->username }}</td>
					<td>{{ $banneduser->userlastname }}</td>
					<td>{{ $banneduser->email }}</td>
					<td>{{ $banneduser->reason }}</td>
					<td>{{ $banneduser->date }}</td>
					<td><input class='btn btn-primary remove-user-ban' type='button' data-value='{{ $banneduser->userid }}' value='Quitar ban'></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{!! $bannedusers->render() !!}
	</div>
</div>
@stop

@section('bannedvideos')
<div role='tabpanel' id='banned-videos' class='tab-pane'>
	<h3 class='divisor'>Videos baneados</h3>
	<div class='table-responsive bannedvideos'>
		<table class='table table-hover'>
			<thead>
				<tr>
					<th>id</th>
					<th>Nombre</th>
					<th>Usuario</th>
					<th>Correo</th>
					<th>Ban</th>
					<th>Fecha de ban</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($bannedvideos as $bannedvideo)
				<tr>
					<td>{{ $bannedvideo->videoid }}</td>
					<td>{{ $bannedvideo->name }}</td>
					<td>{{ $bannedvideo->username }}</td>
					<td>{{ $bannedvideo->useremail }}</td>
					<td>{{ $bannedvideo->reason }}</td>
					<td>{{ $bannedvideo->date }}</td>
					<td><input class='btn btn-primary remove-ban' type='button' data-value='{{ $bannedvideo->videoid }}' value='Quitar ban'></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{!! $bannedvideos->render() !!}
	</div>
</div>
@stop