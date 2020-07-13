@extends('admin.layouts.layout_admin')
@section('title','Pengguna')
@section('content')
    <div class="card">
        <div class="card-body">
            <section id="page-title" class="border-bottom">
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-title">Pengguna</h4>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambahUser">Tambah Pengguna</button>
                    </div>
                </div>
            </section>
            <section id="table-content" class="mt-3">
                <table class="table table-hovered" id="penggunaTable" data-url="{!! route('api.admin.daftaruser') !!}" data-csrf="{!! csrf_token() !!}">
                    <thead>
                        <tr>
                            <th class="col-8">Nama Pengguna</th>
                            <th class="col-4">Aksi</th>
                        </tr>                
                    </thead>
                </table>
            </section>
        </div>
    </div>
    <div class="modal fade" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="tambahUserID" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tambahUserID">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="nama">*Nama Pengguna :</label>
                                <input type="text" name="name" placeholder="Masukkan Nama Pengguna" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" name="email" placeholder="Masukkan Email Anda" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">*Password :</label>
                                <input type="password" name="password" placeholder="Masukkan Password Anda" required="required" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ubahUser" tabindex="-1" role="dialog" aria-labelledby="ubahUserID" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ubahUserID">Ubah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="nama">*Nama Pengguna :</label>
                                <input type="text" name="name" id="name" placeholder="Masukkan Nama Pengguna" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" name="email" id="email" placeholder="Masukkan Email Anda" required="required" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="passwordUser" tabindex="-1" role="dialog" aria-labelledby="passwordUserID" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="passwordUserID">Ganti Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="new_password">*Password Baru :</label>
                                    <input type="password" name="new_password" id="new_password" placeholder="Masukkan Password Baru" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Konfirmasi Password :</label>
                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Masukkan Ulang Password Baru Seperti Yang Inputan Sebelumnya" required="required" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@push('script')
<script type="text/javascript">
    var penggunaTable = $('#penggunaTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#penggunaTable').data('url'),
        columns: [
            { data: 'name', name:'name'},
            { data: 'action', name:'action'}
        ]
    });
</script>
@endpush