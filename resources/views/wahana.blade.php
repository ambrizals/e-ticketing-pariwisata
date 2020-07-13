@extends('layouts.layout_wahana')
@section('title', $wahana->nama_wahana)
@section('content')
<div class="row">
	<div class="cover-wahana">
		@if ($wahana->getGambar->count() == 1)
			@foreach($wahana->getGambar as $item)
				<img class="d-block w-100" src="{{ asset('uploads/wahana/'.$item->wahanagambar_filename) }}">
			@endforeach
		@else
			<img class="d-block w-100" src="{!! asset('img/no-cover.jpg') !!}">
		@endif
		<div class="title">
			<h3>{!! $wahana->nama_wahana !!}</h3>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<section class="block-product">
			<div class="pages-subtitles">
				<p>Product <span>Detail</span></p>
			</div>
			{!! $wahana->deskripsi_wahana !!}
		</section>
		<section class="block-product">
			<div class="pages-subtitles">
				<p>Have a <span>question?</span></p>
			</div>
			<div id="disqus_thread"></div>
			<script>
			
			/**
			*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
			*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
			/*
			var disqus_config = function () {
			this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
			this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
			};
			*/
			(function() { // DON'T EDIT BELOW THIS LINE
			var d = document, s = d.createElement('script');
			s.src = 'https://ambrizalproject.disqus.com/embed.js';
			s.setAttribute('data-timestamp', +new Date());
			(d.head || d.body).appendChild(s);
			})();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		</section>
	</div>
	<div class="col-md-4">
		<section class="block-product" id="addCart">
			<div class="pages-subtitles">
				<p>Pricing <span>Info</span></p>
			</div>
			<form action="{{ route('cart.store') }}" method="POST">
				{!! csrf_field() !!}
				<input type="hidden" name="wahana" value="{{ $wahana->id }}">
				<div class="form-group">
					<label for="passanger">Price (IDR)</label>
					<input type="text" value="@money($wahana->biaya_wahana, 'IDR')" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="passanger">Passenger</label>
					<input type="number" value="0" class="form-control" name="qty">
				</div>
				<button type="submit" class="btn btn-info">Book Now</button>
			</form>
		</section>
		<section class="block-product">
			<div class="pages-subtitles">
				<p>{!! $wahana->nama_wahana !!} <span>Gallery</span></p>
			</div>
		
			<div id="wahanaGallery" class="row">
				@foreach($gambar as $item)
					<a href="{!! asset('/uploads/wahana/').'/'.$item->wahanagambar_filename !!}" class="col-md-3">
						<img src="{!! asset('/uploads/thumbs/wahana/').'/'.$item->wahanagambar_filename !!}" class="img-fluid" />
					</a>
				@endforeach
			</div>
		</section>
	</div>
</div>
@endsection