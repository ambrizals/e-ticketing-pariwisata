@extends('admin.layouts.layout_admin')
@section('title', 'Ubah Wahana : ' . $item->nama_wahana)

@section('content')
    <div class="card">
        <div class="card-body">
            <section id="page-title" class="border-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="header-title mt-2">{!! $item->nama_wahana !!}</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <ul class="nav nav-pills nav-fill mb-3 tabs-card" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="info-wahana-tab" data-toggle="pill" href="#info-wahana" role="tab" aria-controls="info-wahana" aria-selected="true">Informasi Wahana</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="galeri-wahana-tab" data-toggle="pill" href="#galeri-wahana" role="tab" aria-controls="galeri-wahana" aria-selected="false">Galeri Wahana</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>      
            <section id="page-content" class="mt-3">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="info-wahana" role="tabpanel" aria-labelledby="info-wahana-tab">
                        <form action="{!! route('wahana.update',$item->id) !!}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="row border-bottom">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_wahana">Nama Wahana :</label>
                                        <input type="text" name="nama_wahana" id="nama_wahana" class="form-control" value="{!! $item->nama_wahana !!}" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="urlslug">URL Slug</label>
                                        <input type="text" name="urlslug" id="urlslug" class="form-control" value="{!! $item->urlslug !!}" readonly="readonly">
                                    </div>                                
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="deskripsi_wahana">Deskripsi Wahana :</label>
                                        <textarea name="deskripsi_wahana" id="deskripsi_wahana" class="form-control tarea-big">{!! $item->deskripsi_wahana !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya_wahana">Biaya Wahana :</label>
                                        <input type="number" name="biaya_wahana" id="biaya_wahana" class="form-control" value="{!! $item->biaya_wahana !!}">
                                    </div>                      
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <a href="{!! route('wahana.index') !!}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                                <div class="col-md-4 text-right">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Perbarui Data</button>
                                    <a href="{!! route('front.wahana.detail',$item->urlslug) !!}" class="btn btn-primary" target="_tab"><i class="fa fa-eye"></i> Lihat Wahana</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="galeri-wahana" role="tabpanel" aria-labelledby="galeri-wahana-tab">
                        <div id="galleryGambar" data-wahana="{!! route('wahana.daftar.gambar', $item->id) !!}">

                        </div>
                    </div>
                </div>
            </section>      
        </div>
    </div>
    <div class="modal fade" id="upload_gambar" tabindex="-1" role="dialog" aria-labelledby="ambilgambar">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Gambar</h4>
                </div>
                <div class="modal-body">
                    <p class="alert alert-info">Gunakan gambar dengan aspect ratio 3:4 agar sistem dapat menyesuaikan</p>
                    <form action="{{ route('wahana.upload.gambar',$item->id) }}" id="uploadImagesFiles" class="dropzone mt-2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-block btn-primary" data-dismiss="modal" aria-label="Close">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ambilgambar" tabindex="-1" role="dialog" aria-labelledby="ambilgambar">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div id="ambilgambar_body">
                    <p class='loading'>Sedang mengambil gambar</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

@endpush