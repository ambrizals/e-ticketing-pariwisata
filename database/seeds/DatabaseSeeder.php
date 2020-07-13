<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run example data and default configuration
        $this->call(defaultPengaturanSeed::class);
        $this->call(userTableSeeder::class);
        $this->call(wahanaSeed::class);
        $this->call(KaryawanUserConnect::class);
        $this->call(pengunjungUserConnect::class);
        $this->call(cartSeed::class);
        $this->call(bankSeed::class);
        $this->call(transaksiSeeder::class);
        $this->call(eticketSeed::class);
        $this->call(transaksiPaytransferSeed::class);
    }
}
