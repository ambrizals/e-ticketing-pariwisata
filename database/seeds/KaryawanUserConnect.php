<?php

use Illuminate\Database\Seeder;

class KaryawanUserConnect extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawan')->insert([
            'user' => 1,
            'nama_karyawan' => 'Ambrizal Suryadinata',
            'no_telepon' => '8115349997',
            'alamat' => 'Jl. Letda Made Putra No. 6E, Denpasar Timur, Bali'
        ]);
    }
}
