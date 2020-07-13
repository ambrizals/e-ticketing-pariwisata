@extends('admin.layouts.layout_admin')
@section('title','Daftar Bank')
@section('content')
<div class="card">
    <div class="card-body">
        <section id="page-title" class="border-bottom">
            <div class="row">
                <div class="col-6">
                    <h4 class="header-title">Bank</h4>
                </div>
                <div class="col-6 text-right">
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambahBank">Tambah Bank</button>
                </div>
            </div>
        </section>
        <section id="table-content" class="mt-3">
            <table class="table table-hovered" id="bankTable" data-url="{!! route('api.admin.daftarbank') !!}" data-csrf="{!! csrf_token() !!}">
                <thead>
                    <tr>
                        <th class="col-2">Nama Bank</th>
                        <th class="col-6">Nama Rekening</th>
                        <th class="col-4">Aksi</th>
                    </tr>                
                </thead>
            </table>
        </section>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahBank" tabindex="-1" role="dialog" aria-labelledby="tambahBankID" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('bank.store') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_bank">Nama Bank</label>
                        <input type="text" class="form-control" name="nama_bank" placeholder="Masukkan Nama Bank Ex: BRI">
                    </div>
                    <div class="form-group">
                        <label for="nama_rekening">Nama Rekening</label>
                        <input type="text" class="form-control" name="nama_rekening" placeholder="Masukkan Nama Pemilik Rekening">
                    </div>
                    <div class="form-group">
                        <label for="nomor_rekening">Nomor Rekening</label>
                        <input type="text" class="form-control" name="nomor_rekening" placeholder="Masukkan Nomor Rekening">
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

<div class="modal fade" id="ubahBank" tabindex="-1" role="dialog" aria-labelledby="tambahBankID" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lihat Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bank.store') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_bank">Nama Bank</label>
                            <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Masukkan Nama Bank Ex: BRI">
                        </div>
                        <div class="form-group">
                            <label for="nama_rekening">Nama Rekening</label>
                            <input type="text" class="form-control" name="nama_rekening" id="nama_rekening" placeholder="Masukkan Nama Pemilik Rekening">
                        </div>
                        <div class="form-group">
                            <label for="nomor_rekening">Nomor Rekening</label>
                            <input type="text" class="form-control" name="nomor_rekening" id="nomor_rekening" placeholder="Masukkan Nomor Rekening">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script type="text/javascript">
    var bankTable = $('#bankTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#bankTable').data('url'),
        columns: [
            { data: 'nama_bank', name:'nama_bank'},
            { data: 'nama_rekening', name:'nama_rekening' },
            { data: 'action', name:'action'}
        ]
    });
</script>
@endpush