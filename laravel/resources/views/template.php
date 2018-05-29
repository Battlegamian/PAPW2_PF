@extends('layouts.layout-profile')

@section('menu')
<nav class='navbar menu-style navbar-fixed-top'>
	<div class='container'>
		<div class='navbar-header'>
			<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#menu-NavBar'>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span> 
			</button>
			<a class='navbar-brand logo' href='#'><img src='images/log-v8.png'></a>
		</div>
		<div class='collapse navbar-collapse' id='menu-NavBar'>
			<ul class='nav navbar-nav navbar-right'>
				<li><a class='popup-trigger' data-target='#search'><span class='icon-magnifying-glass'></span> Buscar</a></li>
				<li class='dropdown'>
					<!-- <a class='dropdown-toggle user-profile' data-toggle='dropdown' href='#' style="background-image: url('images/nullProfile.png');"></a> -->
					<a class='dropdown-toggle user-profile' data-toggle='dropdown' href='#' style="background-image: url('data:image/jpeg;base64,{{base64_encode($name)}}');"></a>
					<ul class='dropdown-menu profile-options'>
						<li><a href='#'><span class='icon-user'></span> Ver perfil</a></li>
						<li><a href='logout'><span class='icon-log-out'></span> Cerrar sesión</a></li>
						<img src="data:image/jpeg;base64,{{base64_encode($name)}}"/>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
@stop