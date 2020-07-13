<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Selamat Datang - {{ config('app.name') }}</title>

		<!-- Bootstrap CSS -->
		@include('includes.header_link')
	</head>
	<body>	
		@include('includes.header')		
		@yield('content')
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		@include('includes.footer_link')
	</body>
</html>