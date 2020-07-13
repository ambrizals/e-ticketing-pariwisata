@extends('layouts.layout_pages')
@section('title','Transaction Waiting Payment')
@section('content')
    <div class="col-12 text-center">
        <div class="my-5">
            <i class="fa fa-check-circle-o icon-pages my-2"></i>
            <h1>Your transaction {{ $newTransaksi->id }} is ready to pay</h1>
            <p class="lead">You can pay for this transaction before the order date or pay at the date of booking at the counter.</p>
            <p>Your transaction is saved on transaction pages</p>
        </div>
        <hr>
        <div class="my-5">
            <p class="lead">You need help ?</p>
            <a href="mailto:sabuncolek@ambrizal.net" class="btn btn-primary">Send us an email</a>
        </div>
    </div>
@endsection