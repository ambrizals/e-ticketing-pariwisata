@extends('layouts.layout_pages')
@section('title','My Cart')

@section('content')
<div class="container-fluid mt-2">
    <div class="row my-5 justify-content-center">
        <div class="col-md-12">
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#" type="button" class="btn btn-primary btn-circle" disabled="disabled">1</a>
                        <p>Select a services</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#" type="button" class="btn btn-primary btn-circle" disabled="disabled">2</a>
                        <p>Checkout</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#" type="button" class="btn btn-default btn-circle btn-unfinish" disabled="disabled">4</a>
                        <p>Payment Confirmation</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#" type="button" class="btn btn-default btn-circle btn-unfinish" disabled="disabled">5</a>
                        <p>Finish</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <section class="block-product">
                        <div class="pages-subtitles">
                            <p>Cart <span>List</span></p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-md-2">Services Name</th>
                                        <th class="col-md-2">Qty</th>
                                        <th class="col-md-2">Price</th>
                                        <th class="col-md-2">Total</th>
                                        <th class="col-md-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $item)
                                    <div id="updateCart-{{ $item->id }}">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            <input type="hidden" name="_token" id="cartToken" value="{!! csrf_token() !!}">
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="form_type" value="stc">
                                            <tr>
                                                <td id="wahana">{{ $item->getWahana->nama_wahana }}</td>
                                                <td><input type="number" class="form-control" name="qty" value="{{ $item->qty }}"></td>
                                                <td>@money($item->getWahana->biaya_wahana, 'IDR')</td>
                                                <td>@money($item->qty * $item->getWahana->biaya_wahana, 'IDR')</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <button type="button" class="btn btn-primary btn-block" onclick="updateItem_cart({{ $item->id }})"><i class="fa fa-save"></i> Update Qty</button>
                                                        </div>                                    
                                                        <div class="col-6">
                                                            <button type="button" class="btn btn-danger btn-block" onclick="destroyItem_cart('{{ route('cart.destroy', $item->id) }}','stc')"><i class="fa fa-remove"></i> Delete Item</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                @php($itemCount['qty'] = $itemCount['qty'] + $item->qty)
                                                @php($itemCount['total'] = $itemCount['total'] + ($item->qty * $item->getWahana->biaya_wahana))
                                            </tr>
                                        </form>
                                    </div>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="2">Total</td>
                                    <td>{{ $itemCount['qty'] }}</td>
                                    <td>@money($itemCount['total'] ,'IDR')</td>
                                    <td></td>
                                </tfoot>
                            </table>
                        </div>
                    </section>
                </div>
                <div class="col-md-5">
                    <section class="block-product">
                        <div class="pages-subtitles">
                            <p>Checkout <span>Form</span></p>
                        </div>
                        <form action="{{ route('front.transaction.store') }}" method="POST">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <div class="form-group" id="cart_paymethod">
                                <label for="paymethod">Payment Method :</label>
                                <input id="upfront" type="radio" name="jenis_pembayaran" value="1" checked="checked"> Upfront Payment
                                <input id="bank" type="radio" name="jenis_pembayaran" value="2"> Bank Transfer
                            </div>
                            <div class="form-group">
                                <label for="bank">Bank Transfer Objectives</label>
                                <select id="cart_bankmethod" name="bank" class="form-control" disabled="disabled">
                                    @foreach($bank as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->nama_bank }} - {{ $bank->nama_rekening }} / {{ $bank->nomor_rekening }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_booking">Booking Date</label>
                                <input type="date" name="tanggal_booking" class="form-control" required="required" value="{{ date('Y-m-d') }}">
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Continue</button>
                        </form>
                    </section>
                </div>                    
            </div>            
        </div>
    </div>
</div>
@endsection
