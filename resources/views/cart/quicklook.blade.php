<table class="table table-hovered">
    <thead>
        <tr>
            <th class="col-md-2">Services Name</th>
            <th class="col-md-2">Qty</th>
            <th class="col-md-2">Price</th>
            <th class="col-md-3">Total</th>
            <th class="col-md-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cart as $item)
        <tr id="updateCart-{{ $item->id }}">
            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="form_type" value="stc">
                <td id="wahana">{{ $item->getWahana->nama_wahana }}</td>
                <td><input type="number" class="form-control" name="qty" value="{{ $item->qty }}"></td>
                <td>@money($item->getWahana->biaya_wahana, 'IDR')</td>
                <td>@money($item->qty * $item->getWahana->biaya_wahana, 'IDR')</td>
                <td>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary btn-block" onclick="updateItem_cart({{ $item->id }})"><i class="fa fa-save"></i></button>
                        </div>                                    
                        <div class="col-6">
                            <button type="button" class="btn btn-danger btn-block"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                </td>
                @php($itemCount['qty'] = $itemCount['qty'] + $item->qty)
                @php($itemCount['total'] = $itemCount['total'] + ($item->qty * $item->getWahana->biaya_wahana))
            </form>
        </tr>
        @endforeach
    </tbody>
</table>