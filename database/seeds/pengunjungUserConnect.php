<?php

use Illuminate\Database\Seeder;

class pengunjungUserConnect extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengunjung')->insert([
            'user' => 3,
            'nama_pengunjung' => 'User',
            'no_telepon' => '81236809195'
        ]);
    }
}
