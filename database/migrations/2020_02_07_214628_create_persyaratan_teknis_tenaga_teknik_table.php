<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersyaratanTeknisTenagaTeknikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persyaratan_teknis_tenaga_teknik', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');
            $table->bigInteger('uid_verifikasi_pt');
            $table->bigInteger('uid_ver_pt_tt')->nullable();
            $table->enum('jenis_identitas', ['KTP', 'Passpor']);
            $table->string('nama');
            $table->string('nomor_identitas')->nullable();
            $table->string('nomor_passpor')->nullable();
            $table->string('nomor_ktp')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->text('file_kartu_identitas')->nullable();
            $table->text('file_pernyataan_tt')->nullable();
            $table->text('file_daftar_riwayat_hidup')->nullable();
            $table->string('kewarganegaraan')->nullable();
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
        Schema::dropIfExists('persyaratan_teknis_tenaga_teknik');
    }
}
