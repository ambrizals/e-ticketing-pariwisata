@extends('admin.layouts.layout_admin')
@section('title','Karyawan')
@section('content')
    <div class="card">
        <div class="card-body">
            <section id="page-title" class="border-bottom">
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-title">Karyawan</h4>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambahKaryawan">Tambah Karyawan</button>
                    </div>
                </div>
            </section>
            <section id="table-content" class="mt-3">
                <table class="table table-hovered" id="karyawanTable" data-url="{!! route('api.admin.tabelkaryawan') !!}" data-csrf="{!! csrf_token() !!}">
                    <thead>
                        <tr>
                            <th class="col-8">Nama Karyawan</th>
                            <th class="col-4">Aksi Karyawan</th>
                        </tr>                
                    </thead>
                </table>
            </section>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambahKaryawan" tabindex="-1" role="dialog" aria-labelledby="tambahKaryawanID" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tambahKaryawanID">Tambah Karyawan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('karyawan.store') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="nama_karyawan">*Nama Karyawan :</label>
                                <input type="text" name="nama_karyawan" placeholder="Masukkan Nama Karyawan" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">Nomor Telepon :</label>
                                <input type="number" name="no_telepon" placeholder="Masukkan Nomor Telepon" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alamat">*Alamat Karyawan :</label>
                                <textarea class="form-control" name="alamat" required="required" ></textarea>
                            </div>
                            {{--  <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control" />
                            </div>  --}}
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

    <div class="modal fade" id="ubahKaryawan" tabindex="-1" role="dialog" aria-labelledby="ubahKaryawanID" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ubahKaryawanID">Lihat Karyawan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('karyawan.store') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="nama_karyawan">*Nama Karyawan :</label>
                                <input type="text" name="nama_karyawan" placeholder="Masukkan Nama Karyawan" required="required" class="form-control" id="nama_karyawan">
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">Nomor Telepon :</label>
                                <input type="number" name="no_telepon" placeholder="Masukkan Nomor Telepon" required="required" class="form-control" id="nomor_telepon">
                            </div>
                            <div class="form-group">
                                <label for="alamat">*Alamat Karyawan :</label>
                                <textarea class="form-control" name="alamat" required="required" id="alamat"></textarea>
                            </div>
                            {{--  <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control" />
                            </div>  --}}
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


@endsection

@push('script')
<script type="text/javascript">
    var karyawanTable = $('#karyawanTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#karyawanTable').data('url'),
        columns: [
            { data: 'nama_karyawan', name:'nama_karyawan'},
            { data: 'action', name:'action'}
        ]
    });
</script>
@endpush
