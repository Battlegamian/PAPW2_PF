<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta name='csrf-token' content='{{ csrf_token() }}' />
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>    
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<link rel='icon' href='images/icon.ico' type='image/x-icon' />
		<link rel='stylesheet' type='text/css' href="{{ URL::asset('css/bootstrap.min.css') }}">
		<link rel='stylesheet' type='text/css' href="{{ URL::asset('icomoon/style.css') }}">
		<link rel='stylesheet' type='text/css' href="{{ URL::asset('css/main.css') }}">
		
		@yield('title')

	</head>
	<body>

		@yield('search')

		@yield('menu')

		<div class='content'>
			<div class='container'>
				
				@yield('content')

				@yield('pagination')
				
			</div>
		</div>
		
	</body>
	<script type='text/javascript' src="{{ URL::asset('js/jquery.js') }}"></script>
	<script type='text/javascript' src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script type='text/javascript' src="{{ URL::asset('js/main.js') }}"></script>
</html>