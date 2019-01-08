<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJalingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jalings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lokasi');
            $table->text('lokasi_keg');
            $table->string('kecamatan');
            $table->string('rencana');
            $table->integer('wilayah_id')->nullable();
            $table->text('data');
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
        Schema::dropIfExists('jalings');
    }
}
