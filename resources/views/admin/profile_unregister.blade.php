@extends('admin.layouts.layout_admin')
@section('title','Profile')
@section('content')

	<div class="card">
		<div class="card-body">
			<section id="page-title" class="border-bottom">
				<div class="row">
					<div class="col-6">
						<h4 class="header-title">Pendaftaran Karyawan</h4>
					</div>
				</div>
			</section>
			<section id="karyawan-register" class="mt-3">
				<form action="{!! route('admin.profile.store') !!}" method="POST">
					{{ csrf_field() }}
					{{ method_field('POST') }}
					<div class="form-group">
						<label for="nama_karyawan">Nama Karyawan</label>
						<input type="text" name="nama_karyawan" class="form-control" />
					</div>
					<div class="form-group">
						<label for="no_telepon">Nomor Telepon</label>
						<input type="number" name="no_telepon" class="form-control" />
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea name="alamat" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="foto">Foto</label>
						<input type="file" name="foto" class="form-control" />
					</div>
					<button type="submit" class="btn btn-primary btn-block">Simpan</button>
				</form>
			</section>
		</div>
	</div>

@endsection