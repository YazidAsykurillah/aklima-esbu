<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriksKualifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriks_kualifikasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid_matriks_kualifikasi')->unique();
            $table->integer('jenis_usaha_uid');
            $table->integer('bidang_uid');
            $table->integer('sub_bidang_uid');
            $table->string('kualifikasi');
            $table->decimal('modal_disetor_min', 20, 2);
            $table->decimal('modal_disetor_maks', 20, 2);
            $table->integer('pjt_jumlah');
            $table->integer('pjt_level');
            $table->integer('tt_jumlah');
            $table->integer('tt_level');
            $table->string('batas_nilai_1_pekerjaan');
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
        Schema::dropIfExists('matriks_kualifikasi');
    }
}
