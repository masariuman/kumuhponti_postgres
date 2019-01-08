<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaerahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daerahs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_daerah')->nullable();
            $table->decimal('x', 8,5)->default(-0,02677);
            $table->decimal('y', 8,5)->default(109,34211);
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
        Schema::dropIfExists('daerahs');
    }
}
