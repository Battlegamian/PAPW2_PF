<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>    
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<link rel='icon' href='images/icon.ico' type='image/x-icon' />
		<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='icomoon/style.css'>
		<link rel='stylesheet' type='text/css' href='css/main.css?a=3'>
		<title>Nombre del canal</title>
	</head>
	<body>

		<div id='search' class='popup' data-state='0'>
			<form id='login-form' class='popup-content'>
				<div class='inputs-container'>
					<br>
					<div class='form-group'>
						<label for='search-inpt'>Buscar</label>
						<input type='text' class='form-control' id='search-inpt' name='mailUser' placeholder='Buscar...' required>
					</div>
					<hr>
					<div class='form-group'>
						<label>Filtro</label><br>
						<input type='radio' name='search-type' value='content' checked> Contenido<br>
						<input type='radio' name='search-type' value='user'> Usuario<br>
					</div>
					<div class='form-group'>
						<label for='start_day'>Fecha de inicio</label>
						<div class='date-container'>
							<select id='start_day' name='start_day' class='form-control day'>
									<option value=''>Dia</option>
							</select>
							<select id='start_month' name='start_month' class='form-control month'>
									<option value=''>Mes</option>
							</select>
							<select id='start_year' name='start_year' class='form-control year'>
									<option value=''>Año</option>
							</select>
						</div>
					</div>
					<div class='form-group'>
						<label for='end_day'>Fecha de final</label>
						<div class='date-container'>
							<select id='end_day' name='end_day' class='form-control day'>
									<option value=''>Dia</option>
							</select>
							<select id='end_month' name='end_month' class='form-control month'>
									<option value=''>Mes</option>
							</select>
							<select id='end_year' name='end_year' class='form-control year'>
									<option value=''>Año</option>
							</select>
						</div>
					</div>
					<br>
					<button type='submit' class='btn btn-primary'>Buscar</button>
				</div>
			</form>
		</div>

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
							<a class='dropdown-toggle user-profile' data-toggle='dropdown' href='#' style="background-image: url('images/nullProfile.png');"></a>
							<ul class='dropdown-menu profile-options'>
								<li><a href='#'><span class='icon-user'></span> Ver perfil</a></li>
								<li><a href='#'><span class='icon-log-out'></span> Cerrar sesión</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class='content'>
			<div class='container'>
				<div class='row'>
					<div class='col-xs-12 col-sm-12 col-md-12'>
						<div class='background-user' style="background-image: url('images/transition/img(0)-min.jpeg');">
							<div class='profile-user' style="background-image: url('images/nullProfile.png');"></div>
						</div>
					</div>
					<div class='col-xs-12 col-sm-12 col-md-12'>
						<div class='info-user'>
							<p>Samuel Sosa Jaramillo</p>
							<small>zamuelzoza@hotmail.com</small><br>
							<small>Se unio el 2018/05/01</small>
						</div>
					</div>
					<div class='col-xs-12 col-sm-12 col-md-12'>
						<div role='tabpanel'>
							<ul class='nav nav-tabs' role='tablist'>
								<li role='presentation' class='active'><a href='#shared' aria-controls='shared' data-toggle='tab' role='tab'>Compartido</a></li>
								<li role='presentation'><a href='#favorites' aria-controls='favorites' data-toggle='tab' role='tab'>Favoritos</a></li>
								<li role='presentation'><a href='#channels' aria-controls='channels' data-toggle='tab' role='tab'>Canales</a></li>
							</ul>
							<div class='tab-content'>
								<div role='tabpanel' id='shared' class='tab-pane active'>
									<h3 class='divisor'>Compartido</h3>
									<div class='row'>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='video'>
												<a class='video-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');">
													<span class='icon-controller-play'></span>
												</a>
												<div class='video-info'>
													<p class='video-title'>Titulo del video mas largo del mundo mundial</p>
													<p class='video-user'>Por: Samuel Sosa Jaramillo</p>
													<p class='video-video-info'><span class='icon-eye'></span> 10 <span class='icon-message'></span> 10</p>
												</div>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='video'>
												<a class='video-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');">
													<span class='icon-controller-play'></span>
												</a>
												<div class='video-info'>
													<p class='video-title'>Titulo del video mas largo del mundo mundial</p>
													<p class='video-user'>Por: Samuel Sosa Jaramillo</p>
													<p class='video-video-info'><span class='icon-eye'></span> 10 <span class='icon-message'></span> 10</p>
												</div>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='video'>
												<a class='video-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');">
													<span class='icon-controller-play'></span>
												</a>
												<div class='video-info'>
													<p class='video-title'>Titulo del video mas largo del mundo mundial</p>
													<p class='video-user'>Por: Samuel Sosa Jaramillo</p>
													<p class='video-video-info'><span class='icon-eye'></span> 10 <span class='icon-message'></span> 10</p>
												</div>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='video'>
												<a class='video-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');">
													<span class='icon-controller-play'></span>
												</a>
												<div class='video-info'>
													<p class='video-title'>Titulo del video mas largo del mundo mundial</p>
													<p class='video-user'>Por: Samuel Sosa Jaramillo</p>
													<p class='video-video-info'><span class='icon-eye'></span> 10 <span class='icon-message'></span> 10</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div role='tabpanel' id='favorites' class='tab-pane'>
									<h3 class='divisor'>Favoritos</h3>
									<div class='row'>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='video'>
												<a class='video-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');">
													<span class='icon-controller-play'></span>
												</a>
												<div class='video-info'>
													<p class='video-title'>Titulo del video mas largo del mundo mundial</p>
													<p class='video-user'>Por: Samuel Sosa Jaramillo</p>
													<p class='video-video-info'><span class='icon-eye'></span> 10 <span class='icon-message'></span> 10</p>
												</div>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='video'>
												<a class='video-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');">
													<span class='icon-controller-play'></span>
												</a>
												<div class='video-info'>
													<p class='video-title'>Titulo del video mas largo del mundo mundial</p>
													<p class='video-user'>Por: Samuel Sosa Jaramillo</p>
													<p class='video-video-info'><span class='icon-eye'></span> 10 <span class='icon-message'></span> 10</p>
												</div>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='video'>
												<a class='video-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');">
													<span class='icon-controller-play'></span>
												</a>
												<div class='video-info'>
													<p class='video-title'>Titulo del video mas largo del mundo mundial</p>
													<p class='video-user'>Por: Samuel Sosa Jaramillo</p>
													<p class='video-video-info'><span class='icon-eye'></span> 10 <span class='icon-message'></span> 10</p>
												</div>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='video'>
												<a class='video-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');">
													<span class='icon-controller-play'></span>
												</a>
												<div class='video-info'>
													<p class='video-title'>Titulo del video mas largo del mundo mundial</p>
													<p class='video-user'>Por: Samuel Sosa Jaramillo</p>
													<p class='video-video-info'><span class='icon-eye'></span> 10 <span class='icon-message'></span> 10</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div role='tabpanel' id='channels' class='tab-pane'>
									<h3 class='divisor'>Canales seguidos</h3>
									<div class='row'>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='channel'>
												<a class='channel-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
												<p class='channel-name'>Nombre del canal super largo del mundo</p>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='channel'>
												<a class='channel-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
												<p class='channel-name'>Nombre del canal super largo del mundo</p>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='channel'>
												<a class='channel-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
												<p class='channel-name'>Nombre del canal super largo del mundo</p>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='channel'>
												<a class='channel-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
												<p class='channel-name'>Nombre del canal super largo del mundo</p>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='channel'>
												<a class='channel-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
												<p class='channel-name'>Nombre del canal super largo del mundo</p>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='channel'>
												<a class='channel-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
												<p class='channel-name'>Nombre del canal super largo del mundo</p>
											</div>
										</div>
										<div class='col-xs-12 col-sm-4 col-md-3'>
											<div class='channel'>
												<a class='channel-img' href='#' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
												<p class='channel-name'>Nombre del canal super largo del mundo</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
	<script type='text/javascript' src='js/jquery.js'></script>
	<script type='text/javascript' src='js/bootstrap.min.js'></script>
	<script type='text/javascript' src='js/main.js?a=1'></script>
</html>