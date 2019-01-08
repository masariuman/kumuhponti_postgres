<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTampilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tampilans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('favicon');
            $table->string('logo_instansi');
            $table->string('nama_instansi');
            $table->string('logo_pem');
            $table->string('nama_pem');
            $table->string('logo_aplikasi');
            $table->string('nama_aplikasi');
            $table->string('site_title');
            $table->string('site_keyword');
            $table->string('site_desc');
            $table->text('tentang');
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
        Schema::dropIfExists('tampilans');
    }
}
