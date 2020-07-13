@extends('admin.layouts.layout_admin')
@section('title','Wahana')
@section('content')
    <div class="card">
        <div class="card-body">
            <section id="page-title" class="border-bottom">
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-title">Wahana</h4>
                    </div>
                    <div class="col-6 text-right">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambahWahana">Tambah Wahana</button>
                    </div>
                </div>
            </section>
            <section id="table-content" class="mt-3">
                <table class="table table-hovered" id="wahanaTable" data-url="{!! route('api.admin.daftarwahana') !!}" data-csrf="{!! csrf_token() !!}">
                    <thead>
                        <tr>
                            <th class="col-8">Nama Wahana</th>
                            <th class="col-4">Aksi Wahana</th>
                        </tr>                
                    </thead>
                </table>
            </section>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambahWahana" tabindex="-1" role="dialog" aria-labelledby="tambahWahanaID" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tambahWahanaID">Tambah Wahana</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('wahana.store') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="nama_wahana">*Nama Wahana :</label>
                                <input type="text" name="nama_wahana" placeholder="Masukkan Nama Wahana" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_wahana">Deskripsi Wahana :</label>
                                <textarea name="deskripsi_wahana" placeholder="Masukkan deskripsi penuh mengenai wahana ini..." class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="biaya_wahana">*Biaya Wahana :</label>
                                <input type="number" name="biaya_wahana" placeholder="Masukkan Nama Wahana" required="required" class="form-control">
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

@endsection

@push('script')
<script type="text/javascript">
    var wahanaTable = $('#wahanaTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#wahanaTable').data('url'),
        columns: [
            { data: 'nama_wahana', name:'nama_wahana'},
            { data: 'action', name:'action'}
        ]
    });
</script>
@endpush
