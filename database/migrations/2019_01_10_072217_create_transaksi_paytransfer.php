<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPaytransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_paytransfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaksi')->unsigned();
            $table->integer('bank')->unsigned();
            $table->integer('jumlah_transfer')->nullable();
            $table->date('tanggal_transfer')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('transaksi')->references('id')->on('transaksi');
            $table->foreign('bank')->references('id')->on('bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_paytransfer');
    }
}
