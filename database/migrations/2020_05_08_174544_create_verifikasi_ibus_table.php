<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifikasiIbusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_ibus', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');
            
            $table->boolean('hasil_ver_ibu_file_surat_permohonan_sbu')->nullable()->default(NULL);
            $table->text('catatan_ver_ibu_file_surat_permohonan_sbu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_ibu_nomor_surat')->nullable()->default(NULL);
            $table->text('catatan_ver_ibu_nomor_surat')->nullable()->default(NULL);

            $table->boolean('hasil_ver_ibu_perihal')->nullable()->default(NULL);
            $table->text('catatan_ver_ibu_perihal')->nullable()->default(NULL);

            $table->boolean('hasil_ver_ibu_tanggal_surat')->nullable()->default(NULL);
            $table->text('catatan_ver_ibu_tanggal_surat')->nullable()->default(NULL);

            $table->boolean('hasil_ver_ibu_nama_penandatangan_surat')->nullable()->default(NULL);
            $table->text('catatan_ver_ibu_nama_penandatangan_surat')->nullable()->default(NULL);

            $table->boolean('hasil_ver_ibu_jabatan_penandatangan_surat')->nullable()->default(NULL);
            $table->text('catatan_ver_ibu_jabatan_penandatangan_surat')->nullable()->default(NULL);



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
        Schema::dropIfExists('verifikasi_ibus');
    }
}
