<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>    
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<link rel='icon' href='images/icon.ico' type='image/x-icon' />
		<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='icomoon/style.css'>
		<link rel='stylesheet' type='text/css' href='css/main.css'>
		<title>Nombre del video</title>
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
							<a class='dropdown-toggle user-profile' data-toggle='dropdown' href='#' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
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
						<video class='video-display'></video>
					</div>
					<div class='col-xs-12 col-sm-12 col-md-12'>
						<div class='video-display-info'>
							<h4 class='video-display-title'>Titulo del video</h4>
							<a class='user-photo' href='' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
							<div class='video-display-content'>
								<p>Samuel Sosa Jaramillo</p>
								<small>2018/05/01</small>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								<div class='video-display-actions'>
									<span class='icon-eye'></span><p> 10</p>
									<span id='like' class='icon-thumbs-up'></span><p> 10</p>
									<span id='fav' class='icon-heart'></span>
								</div>
							</div>
							<div class='do-comment'>
								<form id='comment-form'>
									<div class='inputs-container'>
										<input type='text' name='id_video' hidden>
										<input type='text' name='id_user' hidden>
										<input type='date' name='date' hidden>
										<div class='form-group'>
											<label for='comment'>Comentar</label>
											<textarea class='form-control' rows='3' id='comment' name='comment' placeholder='Comentar...' maxlength='500' required></textarea>
										</div>
										<input class='btn btn-primary' type='submit' value='Publicar'>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class='col-xs-12 col-sm-12 col-md-12 comments-container'>
						<div class='comment'>
							<a class='comment-user-photo' href='' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
							<div class='comment-content'>
								<p>Samuel Sosa Jaramillo</p>
								<small>2018/05/01</small>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
						</div>
						<div class='comment'>
							<a class='comment-user-photo' href='' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
							<div class='comment-content'>
								<p>Samuel Sosa Jaramillo</p>
								<small>2018/05/01</small>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
						</div>
						<div class='comment'>
							<a class='comment-user-photo' href='' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
							<div class='comment-content'>
								<p>Samuel Sosa Jaramillo</p>
								<small>2018/05/01</small>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
						</div>
						<div class='comment'>
							<a class='comment-user-photo' href='' style="background-image: url('images/default/img(0)-min.jpeg');"></a>
							<div class='comment-content'>
								<p>Samuel Sosa Jaramillo</p>
								<small>2018/05/01</small>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</body>
	<script type='text/javascript' src='js/jquery.js'></script>
	<script type='text/javascript' src='js/bootstrap.min.js'></script>
	<script type='text/javascript' src='js/main.js'></script>
</html>