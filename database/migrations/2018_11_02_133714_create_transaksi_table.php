<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user')->unsigned();
            $table->integer('pengunjung')->unsigned();
            $table->date('tanggal_booking');
            $table->integer('jenis_pembayaran');
            $table->integer('total_bayar');
            $table->integer('jumlah_bayar')->default('0');
            $table->integer('kembalian')->default('0');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('pengunjung')->references('id')->on('pengunjung');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
