@extends('layouts.layout_user')
@section('title','Panel Akun')
@section('content')
<div class="card">
    <div class="card-body">
        <section id="page-title" class="border-bottom">
            <div class="row">
                <div class="col-6">
                    <h4 class="header-title">Account Configuration</h4>
                </div>
                <div class="col-md-6 text-right">
                    <ul class="nav nav-pills nav-fill mb-3 tabs-card" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="config-pengunjung-tab" data-toggle="pill" href="#config-pengunjung" role="tab" aria-controls="config-pengunjung" aria-selected="true">Personal Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="config-password-tab" data-toggle="pill" href="#config-password" role="tab" aria-controls="config-password" aria-selected="false">Change Password</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="tab-content mt-3" id="pills-tabContent">
            <div class="tab-pane fade show active" id="config-pengunjung" role="tabpanel" aria-labelledby="config-pengunjung-tab">
                <form action="{!! route('front.profile.update', $user->id) !!}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                            <label for="email">Registered Email</label>
                            <input type="email" name="email" class="form-control" value="{!! $data->getUser->email !!}" readonly="readonly" />
                        </div>
                    <div class="form-group">
                        <label for="nama_pengunjung">Visitor Name</label>
                        <input type="text" name="nama_pengunjung" class="form-control" value="{!! $data->nama_pengunjung !!}" />
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">Phone Number</label>
                        <input type="number" name="no_telepon" class="form-control" value="{!! $data->no_telepon !!}" />
                    </div>
                    <p class="alert alert-info">Your phone number using to send notification messages</p>
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
            <div class="tab-pane fade" id="config-password" role="tabpanel" aria-labelledby="config-password-tab">
                <form action="{!! route('front.profile.changepw',$user->id) !!}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="password_lama">Old Password</label>
                        <input type="password" name="password_lama" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="password_baru">New Password</label>
                        <input type="password" name="password_baru" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password">Confirmation New Password</label>
                        <input type="password" name="konfirmasi_password" class="form-control" />
                    </div>
                    <p class="alert alert-info">If you lost a password, password can be reset with registered email.</p>
                    <button type="submit" class="btn btn-primary btn-block">Save</button>                                                        
                </form>
            </div>
        </section>
    </div>
</div>
@endsection