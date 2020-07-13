<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class transaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksi')->insert([
            'user' => 3,
            'pengunjung' => 1,
            'tanggal_booking' => Carbon::now(),
            'jenis_pembayaran' => 2, // 1 is COD, 2 is transfer bank 
            'total_bayar' => 350000,
            'jumlah_bayar' => 350000,
            'kembalian' => 0,
            'status' => 1, // 0 is cancel, 1 is wait payment, 2 is paid
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('transaksi')->insert([
            'user' => 3,
            'pengunjung' => 1,
            'tanggal_booking' => Carbon::now(),
            'jenis_pembayaran' => 1, // 1 is COD, 2 is transfer bank 
            'total_bayar' => 700000,
            'jumlah_bayar' => 700000,
            'kembalian' => 0,
            'status' => 1, // 0 is cancel, 1 is wait payment, 2 is paid
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
