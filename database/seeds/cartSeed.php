<?php

use Illuminate\Database\Seeder;

class cartSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cart')->insert([
        	'user' => 3,
        	'wahana' => 3,
        	'qty' => 1
        ]);     
    }
}
