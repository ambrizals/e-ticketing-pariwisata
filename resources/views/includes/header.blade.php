<header class="bg-info">
	<nav class="navbar navbar-expand-lg navbar-dark">
		<div class="container-fluid">
		<a class="navbar-brand" href="{!! route('front.dashboard') !!}">{{ config('app.name') }}</a>
		

		<div class="collapse navbar-collapse" id="header_utama">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="{!! route('front.dashboard') !!}">{!! trans('front.home_menus') !!} <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{!! route('front.wahana.katalog') !!}">{!! trans('front.catalog_menus') !!}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" onclick="warningAlert('Halaman ini belum tersedia!')">{!! trans('front.about_menus') !!}</a>
				</li>
				<li class="nav-item dropdown">
					@guest
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{!! trans('front.panel_logsign') !!}
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-cogs"></i> {!! trans('front.panel_login_link') !!}</a>
						<a class="dropdown-item" href="{{ route('register') }}"><i class="fa fa-exchange"></i> {!! trans('front.panel_signup_link') !!}</a>
					</div>
					@else
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Hi, {!! Auth::user()->name !!}
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						@if (Auth::user()->is_management == true)
						<a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa fa-cogs"></i> {!! trans('front.panel_management_link') !!}</a>
						@else
						<a class="dropdown-item" href="{!! route('front.profile.panel') !!}"><i class="fa fa-cogs"></i> {!! trans('front.panel_config_link') !!}</a>
						<a class="dropdown-item" href="{{ route('front.transaction.list') }}"><i class="fa fa-exchange"></i> {!! trans('front.panel_transaction_link') !!}</a>
						@endif
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
							{!! trans('front.panel_logout_link') !!}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>

					</div>					
					@endguest
				</li>
			</ul>
		</div>
		<form class="form-inline my-2 my-lg-0">
			@auth
			<button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#cartModal" data-url="{{ route('cart.index') }}/?quicklook"><i class="fa fa-shopping-cart"></i> My Cart <span class="badge badge-primary" data-url="{{ route('cart.index') }}/?count" id="cartCount"></span></button>
			@endauth
			<div class="input-group navbar-search">
				<input type="text" class="form-control">
				<div class="input-group-prepend">
					<div class="input-group">
						<button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">{!! trans('front.search_button') !!}</button>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header_utama" aria-controls="header_utama" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</div>
				</div>
			</div>
		</form>
		</div>
	</nav>
</header>