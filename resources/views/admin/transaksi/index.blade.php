@extends('admin.layouts.layout_admin')
@section('title','Daftar Transaksi')
@section('content')
    <div class="card">
        <div class="card-body">
            <section id="page-title" class="border-bottom">
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-title">Transaksi</h4>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-primary btn-xs" onclick="warningAlert('Saat ini transaksi hanya dapat ditambah oleh pengunjung')">Tambah Transaksi</button>
                    </div>
                </div>
            </section>
            <ul class="nav nav-pills mb-3 nav-fill" id="tipeTransaksi" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="pill" href="#" role="tab" aria-selected="true" id="all">Semua Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#" role="tab" id="listTunai">Transaksi Tunai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#" role="tab" id="listTransfer">Transaksi Transfer Bank</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#" role="tab" id="cod">Menunggu Pembayaran Tunai</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#" role="tab" id="transfer">Menunggu Konfirmasi Transfer</a>
                </li>
              </ul>
            <section id="table-content" class="mt-3">
                <table class="table table-hovered" id="transaksiTable" data-url="{!! route('api.admin.daftartransaksi') !!}" data-csrf="{!! csrf_token() !!}">
                    <thead>
                        <tr>
                            <th class="col-4">ID Transaksi</th>
                            <th class="col-5">Nama Pengunjung</th>
                            <th class="col-3">Aksi</th>
                        </tr>                
                    </thead>
                </table>
            </section>
        </div>
    </div>
@endsection
@push('script')
<script type="text/javascript">
    var transaksiTable = $('#transaksiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#transaksiTable').data('url'),
        columns: [
            { data: 'id', name:'id'},
            { data: 'get_pengunjung.nama_pengunjung', name:'pengunjung' },
            { data: 'action', name:'action'}
        ]
    });
    $('#tipeTransaksi #all').on('click',function(){
        transaksiTable.ajax.url($('#transaksiTable').data('url')).load();
    })
    $('#tipeTransaksi #listTunai').on('click',function(){
        transaksiTable.ajax.url($('#transaksiTable').data('url')+'/?listTunai').load();
    })
    $('#tipeTransaksi #listTransfer').on('click',function(){
        transaksiTable.ajax.url($('#transaksiTable').data('url')+'/?listTransfer').load();
    })
    $('#tipeTransaksi #cod').on('click',function(){
        transaksiTable.ajax.url($('#transaksiTable').data('url')+'/?cod').load();
    })
    $('#tipeTransaksi #transfer').on('click',function(){
        transaksiTable.ajax.url($('#transaksiTable').data('url')+'/?transfer').load();
    })
</script>
@endpush