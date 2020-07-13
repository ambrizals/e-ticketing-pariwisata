<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWahanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wahana', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_wahana')->unique();;
            $table->text('deskripsi_wahana')->nullable();
            $table->integer('biaya_wahana');
            $table->string('urlslug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jasa');
    }
}
