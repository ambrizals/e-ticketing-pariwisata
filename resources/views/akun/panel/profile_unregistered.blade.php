@extends('layouts.layout_pages')
@section('title','Visitor Registration')
@section('content')
    <div class="card mt-2">
        <div class="card-header">
            Visitor Registration Form
        </div>
        <form action="{!! route('front.profile.store') !!}" method="POST">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div class="card-body">
                <p class="alert alert-info">If you make transaction in this site, system need your identity to send notification about your transaction.</p>
                <div class="form-group">
                    <label for="nama_pengunjung">Visitor Name</label>
                    <input type="text" name="nama_pengunjung" class="form-control">
                </div>
                <div class="form-group">
                    <label for="no_pengunjung">Phone Number</label>
                    <input type="number" name="no_telepon" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">Tambah Pengunjung</button>            
            </div>            
        </form>
    </div>
@endsection