<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBentukBadanUsahasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bentuk_badan_usahas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid_bentuk_badan_usaha');
            $table->string('nama_bentuk_badan_usaha');
            $table->string('nama_singkat');
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
        Schema::dropIfExists('bentuk_badan_usahas');
    }
}
