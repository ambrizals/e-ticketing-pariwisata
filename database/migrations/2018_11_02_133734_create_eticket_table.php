<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEticketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaksi')->unsigned();
            $table->integer('wahana')->unsigned();
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('total');
            $table->timestamps();
            $table->foreign('transaksi')->references('id')->on('transaksi');
            $table->foreign('wahana')->references('id')->on('wahana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eticket');
    }
}
