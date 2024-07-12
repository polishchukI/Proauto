{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!--login.logout.registration.forgotpassword-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		@include('shop.block.favicon')

		<title>{{ config('app.name', 'proauto-service') }}</title>
		<script src="{{ asset('js/admin-app.js') }}" defer></script>
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		<link href="{{ asset('css/admin-app.css') }}" rel="stylesheet">
	</head>
	<body class="bg-gradient-primary">
		<div class="container">
		@yield('content')
		</div>
	</body>
</html>--}}