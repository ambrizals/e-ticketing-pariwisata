# Sistem Reservasi Tiket Pariwisata
Deskripsi

# Getting Started
- Ketik command composer dump-autoload untuk merefresh daftar file pada project
- Ketik command composer install untuk menginstall packages yang terdapat pada composer.json
- Ketik command composer update untuk memperbarui packages yang terdapat pada composer.json
- Buat file konfigurasi bernama .env format penulisan konfigurasi terdapat pada .env.example
- Ketik php artisan key:generate untuk membuat kunci aplikasi pada file .env
- Ketik http://localhost/[folder_project]/public atau http://localhost/public untuk mencoba secara langsung
- php artisan serve digunakan jika ingin menggunakan web server yang disediakan laravel
- Ketik php artisan migrate --seed untuk melakukan migrasi database, pastikan database telah terbuat sesuai dengan konfigurasi pada file .env
- Beberapa field table yang menggunakan integer digunakan sebagai alias atau kode penanda, hal tersebut dapat dilihat pada file yang terdapat pada migrations/seed

# Anggota Kelompok :
- Ambri
- Alfin
- ~~Indra~~
- ~~Putu Ari~~
- ~~Umam~~
- ~~Venan~~

## Halaman untuk pengguna

- Beranda (Ambri)
- Login (Ambri)
- Pendaftaran (Ambri)
- Katalog (Putu Ari)
- Halaman Jasa (Putu Ari)
- Halaman Paket Jasa (Putu Ari)
- Troli (Ambri)
- Checkout (Ambri)
- Transaksi (Ambri)
- Detail Transaksi (Ambri)
- Panel User (Ambri)
- Lost Password (Ambri)
- Daftar Pengunjung (Alfin)
- Tambah Pengunjung (Alfin)
- Ubah Pengunjung (Alfin)
- Halaman Pencarian (Venan / Indra)

## Halaman untuk manajemen

- Dashboard (Ambri)
- Login (Ambri)
- Lost Password (Ambri)
- Daftar Transaksi (Venan / Indra)
- Detail Transaksi (Venan / Indra)
- Laporan Penjualan Tiket (Venan / Indra)
- Daftar Pengunjung (Alfin)
- Ubah Pengunjung (Alfin)
- Daftar Jasa Pariwisata (Alfin)
- Daftar Paket Jasa Pariwisata (Putu Ari)
- Daftar Kategori Jasa Pariwisata (Putu Ari)

# Database Design
Daftar tabel yang ada di sistem
- Kategori
- Jasa
- User
- Karyawan
- Agent (Travel Agent)
- Pengunjung
- Paket Jasa
- Transaksi
- E-Ticket / Detail Transaksi


# Roadmap 

0.2 (On progress)
- Make a login system when user have one visitor or have one staff.
- System use SMS Gateway to notify user.
- Make a basic CRUD in wahana.
- Adding list of wahana.
- Basic of languages has added.

0.1
- Initialize Project
- Added some packages like yajra in project
- Create a user interface