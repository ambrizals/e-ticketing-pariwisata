<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title') - {{ config('app.name') }}</title>

		<!-- Bootstrap CSS -->
		@include('includes.header_link')
	</head>
	<body>	
		@include('includes.header')
        <div class="cover-pages">
				<img class="d-block w-100 cover" src="{!! asset('img/IMG_1380_exposure.JPG') !!}">
				<div class="content">
					<div class="title">
						<h1>@yield('title')</h1>
					</div>
				</div>	
			</div>
		<div class="container-fluid">
			@if (session('messages'))
				<div class="alert alert-success" role="alert">{{ session('messages') }}</div>
			@endif  
			@yield('content')
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		@include('includes.footer_link')
	</body>
</html>