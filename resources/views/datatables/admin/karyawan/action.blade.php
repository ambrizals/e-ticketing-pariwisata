<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ubahKaryawan" data-id="{{ $item->id }}">Lihat Data</button>
@if (!$item->user == null)
<button type="button" class="btn btn-danger btn-xs" onclick="warningAlert('Anda tidak dapat menghapus karyawan yang telah memiliki akun pada sistem!')">Hapus Data</button>
@else
<button type="button" class="btn btn-danger btn-xs" onclick="hapusKaryawan({!! $item->id !!})">Hapus Data</button>
@endif