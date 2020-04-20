<!DOCTYPE html>
	<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title> @yield('title',"Admin")</title>
		<link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/admin/libs/alertify/css/alertify.min.css') }}">
		@stack('stylesheets')
	</head>
	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				@include('admin.includes.header')
			</nav>
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				@include('admin.includes.sidebar')
			</aside>
			<div class="content-wrapper">
				@yield('content')
			</div>
			<footer class="main-footer">
				@include('admin.includes.footer')
			</footer>
		</div>
		<script src="{{ asset('assets/admin/js/app.js') }}"></script>
		<script src="{{ asset('assets/admin/libs/alertify/alertify.min.js') }}"></script>
		@stack('scripts')
	</body>
</html>