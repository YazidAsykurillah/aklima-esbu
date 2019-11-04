<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersyaratanAdministratifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persyaratan_administratif', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_verifikasi_pa')->nullable()->default(NULL);
            $table->bigInteger('uid_permohonan');
            $table->string('file_akta_pendirian_bu')->nullable();
            $table->string('nama_notaris')->nullable();
            $table->string('judul_akta')->nullable();
            $table->date('tanggal_akta')->nullable();
            $table->string('nomor_akta')->nullable();
            $table->string('maksud_tujuan_akta')->nullable();
            $table->string('file_pengesahan_sebagai_badan_hukum')->nullable();
            $table->string('nomor_badan_hukum')->nullable();
            $table->string('tentang_badan_hukum')->nullable();
            $table->string('tanggal_badan_hukum')->nullable();
            $table->string('file_npwp')->nullable();
            $table->string('nomor_npwp')->nullable();
            $table->string('file_skdu')->nullable();
            $table->string('instansi_penerbit_skdu')->nullable();
            $table->string('nomor_skdu')->nullable();
            $table->date('tanggal_skdu')->nullable();
            $table->date('masa_berlaku_skdu')->nullable();
            $table->string('file_pjbu')->nullable();
            $table->string('nama_pjbu')->nullable();
            $table->string('jenis_identitas_pjbu')->nullable();
            $table->string('nomor_ktp_pjbu')->nullable();
            $table->string('nomor_paspor_pjbu')->nullable();
            $table->string('file_laporan_keuangan')->nullable();
            $table->decimal('kekayaan_bersih', 20, 2)->nullable();
            $table->decimal('modal_disetor', 20, 2)->nullable();
            $table->string('nama_kantor_akuntan_publik')->nullable();
            $table->text('alamat_kantor_akuntan_pulik')->nullable();
            $table->string('nomor_telepon_kantor_akuntan_publik')->nullable();
            $table->string('nama_akuntan')->nullable();
            $table->string('nomor_laporan_keuangan')->nullable();
            $table->date('tanggal_laporan_keuangan')->nullable();
            $table->string('pendapat_akuntan')->nullable();
            $table->string('file_struktur_organisasi_badan_usaha')->nullable();
            $table->string('file_profile_badan_usaha')->nullable();
            $table->string('file_ppm')->nullable();
            $table->string('nomor_ppm')->nullable();
            $table->date('tanggal_ppm')->nullable();
            $table->decimal('prosentase_saham_pma_ppm', 20, 2)->nullable();
            $table->string('file_ppm_perubahan')->nullable();
            $table->string('nomor_ppm_perubahan')->nullable();
            $table->date('tanggal_ppm_perubahan')->nullable();
            $table->decimal('prosentase_saham_pma_ppm_perubahan', 20, 2)->nullable();
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
        Schema::dropIfExists('persyaratan_administratif');
    }
}
