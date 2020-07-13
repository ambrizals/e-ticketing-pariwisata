@extends('layouts.layout_user')
@section('title','Transaction #'.$transaksi->id.' Detail')
@section('content')
    <section class="block-product">
        <div class="pages-subtitles">
            <p>Transaction <span>Detail</span></p>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <p class="m-0"><i class="fa fa-tag"></i> Transaction ID : {{ $transaksi->id }}</p>
                <p class="m-0"><i class="fa fa-calendar"></i>  Date : {{ $transaksi->created_at->format('d M Y') }}</p>
                <p class="m-0"><i class="fa fa-money"></i> Total Transaction : @money($transaksi->total_bayar,'IDR')</p>
                <p class="m-0"><i class="fa fa-info"></i> Payment Method : {{ $trx['payment'] }}</p>
            </div>
            <div class="col-6">
                <div class="col-6">
                    <p class="m-0"><i class="fa fa-info"></i> Transaction Status : {{ $trx['status'] }}</p>
                    <p class="m-0"><i class="fa fa-user"></i> Visitor Name : {{ $transaksi->getPengunjung->nama_pengunjung }}</p>
                    <p class="m-0"><i class="fa fa-calendar"></i>  Booking Date : {{ $transaksi->tanggal_booking }}</p>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>Services Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </thead>
            @foreach($transaksi->getTicket as $item)
                <tr>
                    <td><a href="{{ route('front.wahana.detail', $item->getWahana->urlslug) }}">{{ $item->getWahana->nama_wahana }}</a></td>
                    <td>{{ $item->qty }}</td>
                    <td>@money($item->harga,'IDR')</td>
                    <td>@money($item->total,'IDR')</td>
                </tr>
            @endforeach
        </table>
    </section>
    @if($transaksi->jenis_pembayaran == 2)
    <section class="block-product">
        <div class="pages-subtitles">
            <p>Bank <span>Transfer</span></p>
        </div>
        @if($transaksi->getTransaksipaytransfer->status == 1)
        <p class="lead">Transaction You have not made a payment confirmation, please fill in the form below if you want to confirm payment on this transaction.</p>
        <form action="{{ route('front.transaction.confirm.store', $transaksi->id) }}" method="POST" id="formconfirmTransfer">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div class="modal-body">
                <div class="form-group">
                    <label for="total_bayar">Total Payment :</label>
                    <input type="text" class="form-control" id="total_bayar" name="total_bayar" value="{{ $transaksi->total_bayar }}" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="bank">Bank :</label>
                    <input type="text" class="form-control" id="bank" name="bank" value="{{ $transaksi->getTransaksipaytransfer->getBank->nama_bank }} - {{ $transaksi->getTransaksipaytransfer->getBank->nama_rekening }} / {{ $transaksi->getTransaksipaytransfer->getBank->nomor_rekening }}" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="jumlah_transfer">Transfer Amount:</label>
                    <input type="text" class="form-control" id="jumlah_transfer" name="jumlah_transfer" value="">
                </div>
                <div class="form-group">
                    <label for="tanggal_transfer">Transfer Date :</label>
                    <input type="date" class="form-control" id="tanggal_transfer" name="tanggal_transfer" value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        @elseif($transaksi->getTransaksipaytransfer->status == 2)
            <p class="lead">Your transaction {{ $transaksi->id }} is waiting for a bank transfer confirmation by the counter.</p>
        @elseif($transaksi->getTransaksipaytransfer->status == 3)
            <p class="lead">Your transaction is paid by counter.</p>
        @endif
    </section>
@endif
@endsection