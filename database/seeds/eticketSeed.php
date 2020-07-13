<?php

use Illuminate\Database\Seeder;

class eticketSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eticket')->insert([
            'transaksi' => 1,
            'wahana' => 1,
            'qty' => 1,
            'harga' => 350000,
            'total' => 350000
        ]);
        DB::table('eticket')->insert([
            'transaksi' => 2,
            'wahana' => 1,
            'qty' => 1,
            'harga' => 350000,
            'total' => 350000
        ]);
        DB::table('eticket')->insert([
            'transaksi' => 2,
            'wahana' => 2,
            'qty' => 1,
            'harga' => 350000,
            'total' => 350000
        ]);
    }
}
