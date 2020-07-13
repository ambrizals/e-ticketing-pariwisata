@extends('admin.layouts.layout_admin')
@section('title','Transaksi #'.$transaksi->id)
@section('content')
	<div class="card mb-3">
       <div class="card-body">
            <section id="page-title" class="border-bottom">
                <h4 class="header-title">Transaksi #{{ $transaksi->id }}</h4>
            </section>
            <section id="transaksi_body">
            	<div class="row">
            		<div class="col-md-6">
		                <p class="m-0"><i class="fa fa-tag"></i> Transaction ID : {{ $transaksi->id }}</p>
		                <p class="m-0"><i class="fa fa-calendar"></i>  Date : {{ $transaksi->created_at->format('d M Y') }}</p>
		                <p class="m-0"><i class="fa fa-money"></i> Total Transaction : @money($transaksi->total_bayar,'IDR')</p>
		                <p class="m-0"><i class="fa fa-info"></i> Payment Method : {{ $trx['payment'] }}</p>
            		</div>
            		<div class="col-md-6">
	                    <p class="m-0"><i class="fa fa-info"></i> Transaction Status : {{ $trx['status'] }}</p>
	                    <p class="m-0"><i class="fa fa-user"></i> Visitor Name : {{ $transaksi->getPengunjung->nama_pengunjung }}</p>
	                    <p class="m-0"><i class="fa fa-calendar"></i>  Booking Date : {{ $transaksi->tanggal_booking }}</p>
            		</div>
            	</div>
            </section>
       	</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<section class="border-bottom">
						<h4 class="header-title">Ticket List</h4>
					</section>
					<section id="ticket_body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="col-4">Wahana</th>
									<th class="col-2">Qty</th>
									<th class="col-3">Harga</th>
									<th class="col-3">Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach($transaksi->getTicket as $tiket)
								<tr>
									<td>{{ $tiket->getWahana->nama_wahana }}</td>
									<td>{{ $tiket->qty }}</td>
									<td>@money($tiket->harga, 'IDR')</td>
									<td>@money($tiket->total, 'IDR')</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</section>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<section class="border-bottom">
						<h4 class="header-title">Pembayaran</h4>
					</section>
					<section id="pembayaran_body">
						@if($transaksi->jenis_pembayaran == 1)
							<form action="{{ route('transaksi.paycod', $transaksi->id) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('POST') }}
								<div class="form-group">
									<label for="total_bayar">Total Payment :</label>
									<input type="text" class="form-control" id="total_bayar" name="total_bayar" value="{{ $transaksi->total_bayar }}" readonly="readonly">
								</div>
								@if($transaksi->status == 1)
								<div class="form-group">
									<label for="jumlah_bayar">Jumlah Bayar:</label>	
									<input type="number" name="jumlah_bayar" value="" class="form-control">
								</div>
								<button type="submit" class="btn btn-primary btn-block">
									Bayar Sekarang
								</button>
								@elseif ($transaksi->status == 2)
								<div class="form-group">
									<label for="jumlah_bayar">Jumlah Bayar:</label>	
									<input type="text" name="jumlah_bayar" value="@money($transaksi->jumlah_bayar, 'IDR')" class="form-control" disabled="disabled">
								</div>
								<div class="form-group">
									<label for="kembalian">Kembalian:</label>	
									<input type="text" name="kembalian" value="@money($transaksi->kembalian, 'IDR')" class="form-control" disabled="disabled">
								</div>								
								<button type="button" class="btn btn-primary btn-block" disabled>
									Transaksi Selesai
								</button>
								@else

								@endif
							</form> 
						@elseif ($transaksi->jenis_pembayaran == 2)
							<form action="{{ route('transaksi.paycash', $transaksi->id) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('POST') }}
								<div class="form-group">
									<label for="total_bayar">Total Payment :</label>
									<input type="text" class="form-control" id="total_bayar" name="total_bayar" value="@money($transaksi->total_bayar,'IDR')" readonly="readonly">
								</div>
								<div class="form-group">
									<label for="bank">Bank :</label>
									<input type="text" class="form-control" id="bank" name="bank" value="{{ $transaksi->getTransaksipaytransfer->getBank->nama_bank }} - {{ $transaksi->getTransaksipaytransfer->getBank->nama_rekening }} / {{ $transaksi->getTransaksipaytransfer->getBank->nomor_rekening }}" readonly="readonly">
								</div>
								@if(($transaksi->getTransaksipaytransfer->status == 3) or ($transaksi->getTransaksipaytransfer->status == 2))
								<div class="form-group">
									<label for="jumlah_transfer">Transfer Amount:</label>
									<input type="text" class="form-control" id="jumlah_transfer" name="jumlah_transfer" value="@money($transaksi->getTransaksipaytransfer->jumlah_transfer,'IDR')" readonly>
								</div>
								<div class="form-group">
									<label for="tanggal_transfer">Transfer Date :</label>
									<input type="date" class="form-control" id="tanggal_transfer" name="tanggal_transfer" value="{{ $transaksi->getTransaksipaytransfer->tanggal_transfer }}" readonly>
								</div>
								@endif
							@if($transaksi->getTransaksipaytransfer->status == 3)
								<button type="button" class="btn btn-primary btn-block" disabled>Transaction Finish</button>
							@elseif($transaksi->getTransaksipaytransfer->status == 2)
								<button type="submit" class="btn btn-primary btn-block">Confirm Bank Transfer</button>
							@elseif($transaksi->getTransaksipaytransfer->status == 1)
								<button type="button" class="btn btn-primary btn-block" disabled>Waiting Bank Transfer</button>
							@endif
							</form>
						@else
							SALAH
						@endif
					</section>
				</div>
			</div>
		</div>
	</div>
@endsection