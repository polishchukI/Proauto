<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" xml:lang="{{ config('app.locale') }}" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		@include('shop.layouts.styles')
	</head>
	<body>
		<button onclick="topFunction()" id="totopbutton" title="Go to top"><i class="fas fa-arrow-circle-up"></i></button>
		<div class="site">
			@include('shop.layouts.mobile_header')
			@include('shop.layouts.header')
			@yield('content')
			<div class="block-space block-space--layout--before-footer"></div>
		</div>
		@include('shop.layouts.footer')
		@include('shop.layouts.scripts')
	</body>
</html>