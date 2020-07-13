@extends('admin.layouts.layout_admin')
@section('title','Profile')
@section('content')

    <div class="card">
        <div class="card-body">
            <section id="page-title" class="border-bottom">
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-title">Pengaturan Akun</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <ul class="nav nav-pills nav-fill mb-3 tabs-card" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="config-karyawan-tab" data-toggle="pill" href="#config-karyawan" role="tab" aria-controls="config-karyawan" aria-selected="true">Pengaturan Karyawan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="config-password-tab" data-toggle="pill" href="#config-password" role="tab" aria-controls="config-password" aria-selected="false">Ganti Password</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="tab-content mt-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="config-karyawan" role="tabpanel" aria-labelledby="config-karyawan-tab">
                    <form action="{!! route('admin.profile.update',$user->id) !!}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" class="form-control" value="{!! $data->nama_karyawan !!}" />
                        </div>
                        <div class="form-group">
                            <label for="no_telepon">Nomor Telepon</label>
                            <input type="number" name="no_telepon" class="form-control" value="{!! $data->no_telepon !!}" />
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control">{!! $data->alamat !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="config-password" role="tabpanel" aria-labelledby="config-password-tab">
                    <form action="{!! route('admin.profile.changepw',$user->id) !!}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="form-group">
                            <label for="password_lama">Kata Sandi Lama</label>
                            <input type="password" name="password_lama" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="password_baru">Kata Sandi Baru</label>
                            <input type="password" name="password_baru" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="konfirmasi_password">Konfirmasi Kata Sandi</label>
                            <input type="password" name="konfirmasi_password" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ganti Password</button>                                                        
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection