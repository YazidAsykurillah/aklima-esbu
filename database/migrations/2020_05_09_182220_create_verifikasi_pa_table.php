<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifikasiPaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_pa', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');

            $table->boolean('hasil_ver_pa_file_akta_pendirian_bu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_akta_pendirian_bu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nama_notaris')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nama_notaris')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_judul_akta')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_judul_akta')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_tanggal_akta')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_tanggal_akta')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_akta')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_akta')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_maksud_tujuan_akta')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_maksud_tujuan_akta')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_pengesahan_sebagai_badan_hukum')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_pengesahan_sebagai_badan_hukum')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_badan_hukum')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_badan_hukum')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_tentang_badan_hukum')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_tentang_badan_hukum')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_tanggal_badan_hukum')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_tanggal_badan_hukum')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_npwp')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_npwp')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_npwp')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_npwp')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_skdu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_skdu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_instansi_penerbit_skdu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_instansi_penerbit_skdu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_skdu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_skdu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_tanggal_skdu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_tanggal_skdu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_masa_berlaku_skdu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_masa_berlaku_skdu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_pjbu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_pjbu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nama_pjbu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nama_pjbu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_jenis_identitas_pjbu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_jenis_identitas_pjbu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_ktp_pjbu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_ktp_pjbu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_paspor_pjbu')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_paspor_pjbu')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_laporan_keuangan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_laporan_keuangan')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_kekayaan_bersih')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_kekayaan_bersih')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_modal_disetor')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_modal_disetor')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nama_kantor_akuntan_publik')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nama_kantor_akuntan_publik')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_alamat_kantor_akuntan_pulik')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_alamat_kantor_akuntan_pulik')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_telepon_kantor_akuntan_publik')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_telepon_kantor_akuntan_publik')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nama_akuntan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nama_akuntan')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_laporan_keuangan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_laporan_keuangan')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_tanggal_laporan_keuangan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_tanggal_laporan_keuangan')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_pendapat_akuntan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_pendapat_akuntan')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_struktur_organisasi_badan_usaha')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_struktur_organisasi_badan_usaha')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_profile_badan_usaha')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_profile_badan_usaha')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_ppm')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_ppm')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_ppm')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_ppm')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_tanggal_ppm')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_tanggal_ppm')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_prosentase_saham_pma_ppm')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_prosentase_saham_pma_ppm')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_file_ppm_perubahan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_file_ppm_perubahan')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_nomor_ppm_perubahan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_nomor_ppm_perubahan')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_tanggal_ppm_perubahan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_tanggal_ppm_perubahan')->nullable()->default(NULL);

            $table->boolean('hasil_ver_pa_prosentase_saham_pma_ppm_perubahan')->nullable()->default(NULL);
            $table->text('catatan_ver_pa_prosentase_saham_pma_ppm_perubahan')->nullable()->default(NULL);

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
        Schema::dropIfExists('verifikasi_pa');
    }
}
