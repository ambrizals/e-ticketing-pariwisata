@extends('layouts.layout_home')
@section('content')
<div class="cover-beranda">
	<img class="d-block w-100 cover" src="{!! asset('img/IMG_1380_exposure.JPG') !!}">
	<div class="content">
		<div class="title">
			<h1>Welcome To {{ config('app.name') }}</h1>
		</div>
	</div>	
</div>
<section class="block-index block-services text-center">
	<h3>Our Services</h3>
	<div class="text-center mb-3">
		<p class="lead">This is available services in wibisana marine adventures.</p>
	</div>
	<div class="row mb-3">
		@foreach($wahana as $item)
		<div class="col-md-3">
			<div class="card">
               @if ($item->getGambar->count() > 0)
                    @foreach($item->getGambar as $item_g)
                        @if ($loop->first)
                        <img class="d-block w-100" src="{!! asset('uploads/wahana/'.$item_g->wahanagambar_filename) !!}" alt="Third slide">
                        @endif
                    @endforeach
                @else
	                <img class="d-block w-100 card-img-top" src="{!! asset('img/no-cover-thumbs.jpg') !!}" alt="Third slide">
                @endif
				<div class="card-body">
					<p class="card-text"><a href="{!! route('front.wahana.detail',$item->urlslug) !!}">{!! $item->nama_wahana !!}</a></p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<a href="{!! route('front.wahana.katalog') !!}" class="btn btn-secondary btn-block">Show More Services</a>
</section>
@endsection