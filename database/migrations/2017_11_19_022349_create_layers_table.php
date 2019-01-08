<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_layer')->nullable();
            $table->string('link_layer')->nullable();
            $table->integer('daerahs_id')->default(1)->unsigned();
            $table->integer('kategoris_id')->default(1)->unsigned();
            $table->timestamps();

            $table->foreign('daerahs_id')->references('id')->on('daerahs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kategoris_id')->references('id')->on('kategoris')
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
        Schema::dropIfExists('layers');
    }
}
