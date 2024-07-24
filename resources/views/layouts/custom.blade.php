<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>@yield('title') - Starter Template</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}" >

	<!-- CSS Libraries -->

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				@yield('content')
			</div>
		</section>
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
</body>
</html>
