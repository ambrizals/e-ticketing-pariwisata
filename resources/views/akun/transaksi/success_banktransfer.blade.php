@extends('layouts.layout_pages')
@section('title','Transaction Waiting Payment')
@section('content')
    <div class="col-12 text-center">
        <div class="my-5">
            <i class="fa fa-shopping-cart icon-pages my-2"></i>
            <h1>Your transaction {{ $newTransaksi->id }} is ready to pay</h1>
            <p class="lead">{{ $msgPaytransfer }}</p>
        </div>
        <hr>
        <p class="lead">You need help ?</p>
        <a href="mailto:sabuncolek@ambrizal.net" class="btn btn-primary">Send us an email</a>
    </div>
@endsection