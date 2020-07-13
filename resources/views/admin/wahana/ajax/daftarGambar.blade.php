@if($gambar->count() > 0)
<div class="row galleryGambar">
    <span id="gambar-token" data-token="{!! csrf_token() !!}"></span> 
    @foreach($gambar as $item)
        <div class="col-md-3 col">
            <div class="detail_gambar">
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#ambilgambar" data-id="{!! $item->id !!}">
                    <i class="fa fa-edit"></i> Lihat Gambar
                </button>
                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#hapusgambar" onclick="removeGambar_wahana({!! $item->id !!})">
                    <i class="fa fa-remove"></i> Hapus Gambar
                </button>
            </div>
            <img src="{!! asset('/uploads/thumbs/wahana/').'/'.$item->wahanagambar_filename !!}" class="img-responsive tabel-gambar" />
        </div>
    @endforeach
</div>
@else
<div class="alert alert-danger alert-dismissible">
    <h4><i class="icon fa fa-ban"></i> Terjadi Kesalahan!</h4>
    <p>Wahana ini tidak memiliki gambar, silahkan upload gambar wahana terlebih dahulu untuk menampilkan daftar gambar.</p>
  </div>
@endif
<div class="row mt-3">
    <div class="col-md-8">
        <div id="gallery_paginate">
            {{ $gambar->links('admin.wahana.ajax.pagination_gambar') }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="pull-right">
            <button type="button" data-toggle="modal" data-target="#upload_gambar" class="btn btn-success"><i class="fa fa-upload"></i> Upload Gambar</button>
            @if($gambar->count() > 0)
                <button type="button" class="btn btn-danger" onclick="removeGambar_all()"><i class="fa fa-remove"></i> Hapus Semua Gambar</button>  
            @else
                <button type="button" class="btn btn-secondary" onclick="warningAlert('Tidak ada gambar yang tersimpan!')"><i class="fa fa-remove"></i> Hapus Semua Gambar</button>  
            @endif    
        </div>
    </div>
</div>