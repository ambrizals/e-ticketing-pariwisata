<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGambarWahana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_wahana', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wahana')->unsigned();
            $table->string('wahanagambar_filename');
            $table->string('wahanagambar_type');
            $table->timestamps();
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
        Schema::dropIfExists('gambar_wahana');
    }
}
