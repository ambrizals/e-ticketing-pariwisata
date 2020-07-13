@extends('layouts.layout_pages')
@section('title','My Cart Is Empty')

@section('content')
<div class="container-fluid mt-2">
    <div class="row my-5 justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 text-center">
                    <i class="fa fa-shopping-cart icon-pages"></i>
                    <h1>My Cart Is Empty</h1>
                    <p class="lead">You missed something in catalog?</p>
                    <a href="{{ route('front.wahana.katalog') }}" class="btn btn-primary">Go To Catalog Pages</a>
                    <hr>
                    <p class="lead">You need help ?</p>
                    <a href="mailto:sabuncolek@ambrizal.net" class="btn btn-primary">Send us an email</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
