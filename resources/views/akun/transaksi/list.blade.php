@extends('layouts.layout_user')
@section('title','Transaction List')
@section('content')
<section class="block-product">
    <div class="pages-subtitles">
        <p>Transaction <span>List</span></p>
    </div>

    <table class="table table-hovered">
        <thead>
            <tr>
                <th>Transaction</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>
                    <p class="m-0">Transaction ID : {{ $item->id }}</p>
                    <p class="m-0">Transaction Date : {{ $item->created_at->format('d M Y') }}</p>
                    <p class="m-0">Total Transaction : @money($item->total_bayar,'IDR')</p>
                </td>
                <td>
                    @if($item->jenis_pembayaran == 1)
                    <a href="{{ route('front.transaction.show',$item->id) }}" class="btn btn-primary btn-block">See Transaction</a>
                    @elseif($item->jenis_pembayaran == 2)
                        @if($item->status == 1)
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('front.transaction.show',$item->id) }}" class="btn btn-primary btn-block">See Transaction</a>
                            </div>
                            <div class="col-6">
                                @if($item->getTransaksipaytransfer->status == 1)
                                    <button type="button" data-id="{{ $item->id }}" class="btn btn-success btn-block" data-toggle="modal" data-target="#confirmTransfer">Confirmation Payment</button>
                                @else
                                    <button type="button" data-id="{{ $item->id }}" class="btn btn-secondary btn-block" disabled="disabled">Waiting Confirmation</button>
                                @endif
                            </div>
                        </div>
                        @elseif ($item->status == 2)
                        <a href="{{ route('front.transaction.show',$item->id) }}" class="btn btn-primary btn-block">See Transaction</a>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</section>

<div class="modal fade" id="confirmTransfer" tabindex="-1" role="dialog" aria-labelledby="confirmTransferID" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bank Transfer Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formconfirmTransfer">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="total_bayar">Total Payment :</label>
                        <input type="text" class="form-control" id="total_bayar" name="total_bayar" value="" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="bank">Bank :</label>
                        <input type="text" class="form-control" id="bank" name="bank" value="" readonly="readonly">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection