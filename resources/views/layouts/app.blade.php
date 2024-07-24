<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>@yield('title') - Starter Template</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


	<!-- CSS Libraries -->

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

	@stack('css')
</head>

<body>
	<div id="app">
		<div class="main-wrapper">
		<div class="navbar-bg"></div>

		<nav class="navbar navbar-expand-lg main-navbar">
			@include('layouts._navbar')
		</nav>

		<div class="main-sidebar sidebar-style-2">
			@include('layouts._sidebar')
		</div>

		<!-- Main Content -->
		<div class="main-content">
			@yield('content')
		</div>
		<footer class="main-footer">
			@include('layouts._footer ')
		</footer>
		</div>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}" ></script>
	<script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/stisla.js') }}"></script>

	<!-- JS Libraies -->

	<!-- Template JS File -->
	<script src="{{ asset('assets/js/scripts.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

	<!-- Page Specific JS File -->
	@stack('js')
</body>
</html>
