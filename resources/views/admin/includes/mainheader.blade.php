<div class="mainheader-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{!! route('admin.dashboard') !!}" class="text-logo">{{ config('app.name') }}</a>
                </div>
            </div>
            <!-- profile info & task notification -->
            <div class="col-md-9 clearfix text-right">
                <div class="d-md-inline-block d-block mr-md-4">
                    <ul class="notification-area">
                        <li id="button-li" data-url="{!! route('front.dashboard') !!}"><i class="ti-home"></i></li>
                        <li id="full-view"><i class="ti-fullscreen"></i></li>
                        <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                    </ul>
                </div>
                <div class="clearfix d-md-inline-block d-block">
                    <div class="user-profile m-0">
                        <img class="avatar user-thumb" src="{{ asset('admin/images/author/avatar.png') }}" alt="avatar">
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{!! Auth::user()->name !!} <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">Pengaturan</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							    {{ __('Logout') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>