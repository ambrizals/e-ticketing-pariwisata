<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ubahUser" data-id="{{ $data->id }}">Lihat Data</button>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#passwordUser" data-id="{{ $data->id }}">Ganti Password</button>
<button type="button" class="btn btn-danger" onclick="hapusUser({{ $data->id }})">Hapus Data</button>