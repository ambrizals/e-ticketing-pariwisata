@extends('layouts.layout_pages')
@section('title','Reset Password')
@section('content')
    <div class="col-12 text-center">
        <div class="my-5">
            <i class="fa fa-check-circle-o icon-pages my-2"></i>
            <h1>Reset Password Success</h1>
            <p class="lead">System has sended your password with sms to your registered phone number.</p>
            <p>You can login with a new password, but remember to change it.</p>
        </div>
        <hr>
        <div class="my-5">
            <p class="lead">You need help ?</p>
            <a href="mailto:sabuncolek@ambrizal.net" class="btn btn-primary">Send us an email</a>
        </div>
    </div>
@endsection