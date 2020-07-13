<?php

use Illuminate\Database\Seeder;

class defaultPengaturanSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengaturan')->insert([
        	'name' => 'sitename',
        	'alias' => 'Site Name',
        	'value' => 'Wibisana'
        ]);
        DB::table('pengaturan')->insert([
        	'name' => 'contact',
        	'alias' => 'Contact',
        	'value' => '08115349997'
        ]);        
    }
}
