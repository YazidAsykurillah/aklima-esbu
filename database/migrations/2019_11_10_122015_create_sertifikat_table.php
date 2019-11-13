<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSertifikatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');
            $table->string('nomor_sertifikat');
            $table->string('nomor_registrasi');
            $table->date('tanggal_terbit');
            $table->date('tanggal_expired');
            $table->bigInteger('uid_jenis_usaha');
            $table->bigInteger('uid_bidang');
            $table->bigInteger('uid_sub_bidang');
            $table->string('kualifikasi');
            $table->string('status_sertifikat');
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
        Schema::dropIfExists('sertifikat');
    }
}
