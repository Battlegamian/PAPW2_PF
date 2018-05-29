<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta name='csrf-token' content='{{ csrf_token() }}' />
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>    
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<link rel='icon' href='images/icon.ico' type='image/x-icon' />
		<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='icomoon/style.css'>
		<link rel='stylesheet' type='text/css' href='css/main.css'>
		<title>Administrador</title>
	</head>
	<body>

		@yield('search')
		
		<div id='video-upd-status' class='popup' data-state='0'>
			<div id='video-sts'>
				<h4>Video subido con éxito!</h4>				
			</div>
		</div>

		@yield('menu')
		
		<div class='content'>
			<div class='container'>
				<div class='row'>

					@yield('info')

					<div class='col-xs-12 col-sm-12 col-md-12'>
						<div role='tabpanel'>
							<ul class='nav nav-tabs' role='tablist'>
								<li role='presentation' class='active'><a href='#shared' aria-controls='shared' data-toggle='tab' role='tab'>Compartido</a></li>
								<li role='presentation'><a href='#favorites' aria-controls='favorites' data-toggle='tab' role='tab'>Favoritos</a></li>
								<li role='presentation'><a href='#channels' aria-controls='channels' data-toggle='tab' role='tab'>Canales</a></li>
								<li role='presentation'><a href='#upload' aria-controls='upload' data-toggle='tab' role='tab'>Subir video</a></li>
								<li role='presentation'><a href='#banned-users' aria-controls='banned-users' data-toggle='tab' role='tab'>Usuarios baneados</a></li>
								<li role='presentation'><a href='#banned-videos' aria-controls='banned-videos' data-toggle='tab' role='tab'>Videos baneados</a></li>
							</ul>
							<div class='tab-content'>
								
								@yield('shared')

								@yield('favorites')

								@yield('channels')
								
								@yield('upload_video')

								@yield('bannedusers')
								
								@yield('bannedvideos')

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