<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class transaksiPaytransferSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksi_paytransfer')->insert([
            'transaksi' => 1,
            'bank' => 1,
            'jumlah_transfer' => 350000,
            'tanggal_transfer' => Carbon::now(),
            'status' => 2, //0 is transfer invalid, 1 is waiting transfer, 2 is waiting transfer validation, 3 transfer is valid
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
