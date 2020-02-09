<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSertifikatPtPjtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sertifikat_pt_pjt', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');
            $table->bigInteger('uid_verifikasi_pt');
            $table->bigInteger('uid_ver_pt_pjt');
            $table->string('noreg_serkom')->nullable();
            $table->string('no_serkom')->nullable();
            $table->date('tgl_sertifikat')->nullable();
            $table->string('lembaga_penerbit')->nullable();
            $table->string('level')->nullable();
            $table->string('unit_kompetensi')->nullable();
            $table->text('file_serkom')->nullable();
            $table->string('bidang')->nullable();
            $table->string('jenis_pekerjaan')->nullable();
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
        Schema::dropIfExists('sertifikat_pt_pjt');
    }
}
