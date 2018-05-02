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
		<title>Pagina pricipal</title>
	</head>
	<body>

		<div id='log' class='popup' data-state='0'>
			<form id='login-form' class='popup-content'>
				<div class='log-container'><img src='images/log-v8.png'></div>
				<div class='inputs-container'>
					<div class='form-group'>
						<label for='mail'>Correo</label>
						<input type='email' class='form-control' id='mail' name='mailUser' placeholder='Correo...' required>
					</div>
					<br>
					<div class='form-group'>
						<label for='pass'>Contraseña</label>
						<input type='password' class='form-control' id='pass' name='passUser' placeholder='Contraseña...' required>
					</div>
					<br>
					<button type='submit' class='btn btn-primary'>Iniciar sesión</button>
					<hr>
					<p>Aun no tiene una cuenta? <a class='popup-trigger' data-target='#reg'>Registrarse</a></p>
				</div>
			</form>
		</div>
		<div id='reg' class='popup' data-state='0'>
			<form id='register-form' class='popup-content' enctype='multipart/form-data'>
				<div class='log-container'><img src='images/log-v8.png'></div>
				<div class='inputs-container'>
					<div class='form-group'>
						<label for='name'>Nombre</label>
						<input id='name' name='name' type='text' class='form-control' placeholder='Nombre...' required>
					</div>
					<div class='form-group'>
						<label for='last_name'>Apellido</label>
						<input id='last_name' name='last_name' type='text' class='form-control' placeholder='Apellido...' required>
					</div>
					<div class='form-group'>
						<label for='email'>Correo</label>
						<input id='email' name='email' type='email' class='form-control' placeholder='Correo...' required>
					</div>
					<div class='form-group'>
						<label for='password'>Contraseña</label>
						<input id='password' name='password' type='password' class='form-control' placeholder='Contraseña...' required>
					</div>
					<div class='form-group'>
						<label for='day'>Fecha de nacimiento</label>
						<div class='date-container'>
							<select id='day' name='day' class='form-control day' required>
									<option value=''>Dia</option>
							</select>
							<select id='month' name='month' class='form-control month' required>
									<option value=''>Mes</option>
							</select>
							<select id='year' name='year' class='form-control year' required>
									<option value=''>Año</option>
							</select>
						</div>
					</div>
					<div class='form-group'>
						<label for='photo_profile'>Foto de perfil</label>
						<div class='file-container'>
							<input type='text' class='form-control' placeholder='Foto de perfil...' readonly>
							<input id='photo_profile' name='photo_profile' type='file' accept='image/x-png,image/gif,image/jpeg'>
						</div>
					</div>
					<div class='form-group'>
						<label for='photo_background'>Foto de portada</label>
						<div class='file-container'>
							<input type='text' class='form-control' placeholder='Foto de portada...' readonly>
							<input id='photo_background' name='photo_background' type='file' accept='image/x-png,image/gif,image/jpeg'>
						</div>
					</div>
					<input class='btn btn-primary' type='submit' value='Registrarse'>
					<hr>
					<p>Ya tiene una cuenta? <a class='popup-trigger' data-target='#log'>Iniciar sesión</a></p>
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
						<li><a class='popup-trigger' data-target='#reg'><span class='icon-user'></span> Registrarse</a></li>
						<li><a class='popup-trigger' data-target='#log'><span class='icon-login'></span> Iniciar sesión</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div id='transition-container' class='container-fluid'>
			<div id='transition-bck' class='transition-diapositives'></div>
			<div id='transition-fnt' class='transition-diapositives'></div>
			<div class='logo-container'><img src='images/log-v7.png'></div>
		</div>

		<div class='wrapper b-c002'>
			<div class='container'>
				<h1>Aprende</h1>
				<h3>Expande tu conocimiento con las experiencias de los demas alrededor del mundo</h3>
			</div>
		</div>
		<div class='wrapper b-c001'>
			<div class='container'>
				<h1>Comparte</h1>
				<h3>Inspira y ayuda a otros</h3>
			</div>
		</div>

		<footer class='footer b-c002'>
			<div class='container'>
				<div class='row'>
					<div class='col-xs-12 col-sm-6 col-md-3'>
						<hr>
						<a href=''>Pagina principal</a><br>
					</div>
					<div class='col-xs-12 col-sm-6 col-md-3'>
						<hr>
						<p>Categorias</p>
						<a>Cartón</a><br>
						<a>Tela</a><br>
						<a>Madera</a><br>
						<a>Plástico</a><br>
						<a>Metal</a><br>
						<a>Cosplay</a><br>
						<a>Programación</a><br>
					</div>
					<div class='col-xs-12 col-sm-6 col-md-3'>
						<hr>
						<p>Contactos</p>
						<p>8119985596</p>
						<p>8180164736</p>
					</div>
					<div class='col-xs-12 col-sm-6 col-md-3'>
						<hr>
						<a href=''>FAQ</a><br>
						<a href=''>Problemas</a><br>
						<a href=''>Prensa</a><br>
					</div>
				</div>
				<hr>
				<div class='links'>
					<a href=''><span class='icon-facebook'></span></a>
					<a href=''><span class='icon-twitter'></span></a>
					<a href=''><span class='icon-vimeo'></span></a>
					<a href=''><span class='icon-youtube'></span></a>
					<a href=''><span class='icon-linkedin'></span></a>
					<a href=''><span class='icon-pinterest'></span></a>
					<a href=''><span class='icon-google'></span></a>
					<a href=''><span class='icon-github'></span></a>
				</div>
			</div>
		</footer>
	</body>
	<script type='text/javascript' src='js/jquery.js'></script>
	<script type='text/javascript' src='js/bootstrap.min.js'></script>
	<script type='text/javascript' src='js/main.js'></script>
</html>