<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentitasBadanUsahaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas_badan_usaha', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('permohonan_uid');
            $table->bigInteger('uid_verifikasi_ibu')->nullable()->default(NULL);
            $table->string('file_surat_permohonan_sbu')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('perihal')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('nama_penandatangan_surat')->nullable();
            $table->string('jabatan_penandatangan_surat')->nullable();
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
        Schema::dropIfExists('identitas_badan_usaha');
    }
}
