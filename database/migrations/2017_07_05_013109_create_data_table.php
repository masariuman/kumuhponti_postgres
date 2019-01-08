<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_spk')->nullable();
            $table->date('tgl_spk')->nullable();
            $table->string('no_adendum')->nullable();
            $table->date('tgl_adendum')->nullable();
            $table->string('nama_pr')->nullable();
            $table->text('alamat_pr')->nullable();
            $table->string('direktur')->nullable();
            $table->string('judul_pekerjaan')->nullable();
            $table->integer('volume')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('kab_kota')->nullable();
            $table->biginteger('pagu')->nullable();
            $table->biginteger('nilai')->nullable();
            $table->biginteger('sisa')->nullable();
            $table->integer('persen')->nullable();
            $table->string('no_pho')->nullable();
            $table->date('tgl_pho')->nullable();
            $table->text('ket_pho')->nullable();
            $table->string('no_bast')->nullable();
            $table->date('tgl_bast')->nullable();
            $table->text('ket_bast')->nullable();
            $table->decimal('x', 8,5)->default(-0,02677);
            $table->decimal('y', 8,5)->default(109,34211);
            $table->integer('kategoris_id')->default(1)->unsigned();
            $table->integer('daerahs_id')->default(1)->unsigned();
            $table->timestamps();

            $table->foreign('kategoris_id')->references('id')->on('kategoris')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('daerahs_id')->references('id')->on('daerahs')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
