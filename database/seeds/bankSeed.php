<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class bankSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank')->insert([
            'nama_bank' => 'BCA',
            'nama_rekening' => 'Ambrizal Suryadinata',
            'nomor_rekening' => '0401461778',
            // 'status' => 1, // 1 is open and 0 is closed
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
