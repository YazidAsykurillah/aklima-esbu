<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersyaratanTeknisPenanggungJawabTeknisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persyaratan_teknis_penanggung_jawab_teknis', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');
            $table->bigInteger('uid_verifikasi_pt');
            $table->enum('jenis_identitas', ['KTP', 'Passpor'])->nullable();
            $table->string('nama')->nullable();
            $table->string('nomor_identitas')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->text('file_kartu_identitas')->nullable();
            $table->text('file_pernyataan_pjt')->nullable();
            $table->text('file_daftar_riwayat_hidup')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->bigInteger('uid_ver_pt_pjt')->nullable();
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
        Schema::dropIfExists('persyaratan_teknis_penanggung_jawab_teknis');
    }
}
