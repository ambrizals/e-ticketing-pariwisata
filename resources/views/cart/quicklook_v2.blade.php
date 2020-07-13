@if ($cart->count() == 0)
<div class="text-center p-3">
	<i class="fa fa-shopping-cart"></i>
	<p class="lead">Cart is empty</p>
</div>
@else
<div class="row">
	@foreach($cart as $item)
	<div class="col-12 border-bottom py-3" id="updateCart-{{ $item->id }}">
		<form action="{{ route('cart.update', $item->id) }}" method="POST">
			<input type="hidden" name="_token" id="cartToken" value="{!! csrf_token() !!}">
			{{ method_field('PUT') }}
			<input type="hidden" name="form_type" value="dyn">
			<div class="row">
				<div class="col-4 text-center">
                    @if ($item->getWahana->getGambar->count() > 0)
                        @foreach($item->getGambar as $item_g)
                            @if ($loop->first)
                            <img class="img-fluid" src="{!! asset('uploads/thumbs/wahana/'.$item_g->wahanagambar_filename) !!}" alt="Third slide">
                            @endif
                        @endforeach
                    @else
                        <img class="d-block w-100" src="{!! asset('img/no-cover.jpg') !!}" alt="Third slide">
                    @endif
                    <p class="lead">{{ $item->getWahana->nama_wahana }}</p>
				</div>
				<div class="col-8">
					<div class="form-group">
						<div class="row">
							<div class="col-4">
								<label for="qty">Price</label>
							</div>
							<div class="col-8">
								<input type="text" class="form-control" name="biaya_wahana" value="@money($item->getWahana->biaya_wahana, 'IDR')" readonly="readonly">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-4">
								<label for="qty">Qty</label>
							</div>
							<div class="col-8">
								<input type="number" class="form-control" name="qty" value="{{ $item->qty }}">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<button type="button" class="btn btn-primary btn-block" onclick="updateItem_cart({{ $item->id }})"><i class="fa fa-save"></i> Update Qty</button>
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-danger btn-block" onclick="destroyItem_cart('{{ route('cart.destroy', $item->id) }}','dyn')"><i class="fa fa-remove"></i> Remove Item</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	@endforeach
</div>
@endif