<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubBidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_bidang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid_sub_bidang')->unique();
            $table->string('kode_sub_bidang');
            $table->string('nama_sub_bidang');
            $table->integer('uid_bidang');
            $table->integer('uid_jenis_usaha');
            $table->boolean('is_active')->default(TRUE);
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
        Schema::dropIfExists('sub_bidang');
    }
}
