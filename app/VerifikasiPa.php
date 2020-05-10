<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifikasiPa extends Model
{
    protected $table = 'verifikasi_pa';

    protected $fillable =[
    	'uid_permohonan',
    	'hasil_ver_pa_file_akta_pendirian_bu', 'catatan_ver_pa_file_akta_pendirian_bu',
    	'hasil_ver_pa_nama_notaris', 'catatan_ver_pa_nama_notaris',
    	'hasil_ver_pa_judul_akta', 'catatan_ver_pa_judul_akta',
    	'hasil_ver_pa_tanggal_akta', 'catatan_ver_pa_tanggal_akta',
    	'hasil_ver_pa_nomor_akta', 'catatan_ver_pa_nomor_akta',
    	'hasil_ver_pa_maksud_tujuan_akta', 'catatan_ver_pa_maksud_tujuan_akta',
    	'hasil_ver_pa_file_pengesahan_sebagai_badan_hukum', 'catatan_ver_pa_file_pengesahan_sebagai_badan_hukum',
    	'hasil_ver_pa_nomor_badan_hukum', 'catatan_ver_pa_nomor_badan_hukum',
    	'hasil_ver_pa_tentang_badan_hukum', 'catatan_ver_pa_tentang_badan_hukum',
    	'hasil_ver_pa_tanggal_badan_hukum', 'catatan_ver_pa_tanggal_badan_hukum',
    	'hasil_ver_pa_file_npwp', 'catatan_ver_pa_file_npwp',
    	'hasil_ver_pa_nomor_npwp', 'catatan_ver_pa_nomor_npwp',
    	'hasil_ver_pa_file_skdu', 'catatan_ver_pa_file_skdu',
    	'hasil_ver_pa_instansi_penerbit_skdu', 'catatan_ver_pa_instansi_penerbit_skdu',
    	'hasil_ver_pa_nomor_skdu', 'catatan_ver_pa_nomor_skdu',
    	'hasil_ver_pa_tanggal_skdu', 'catatan_ver_pa_tanggal_skdu',
    	'hasil_ver_pa_masa_berlaku_skdu', 'catatan_ver_pa_masa_berlaku_skdu',
    	'hasil_ver_pa_file_pjbu', 'catatan_ver_pa_file_pjbu',
    	'hasil_ver_pa_nama_pjbu', 'catatan_ver_pa_nama_pjbu',
    	'hasil_ver_pa_jenis_identitas_pjbu', 'catatan_ver_pa_jenis_identitas_pjbu',
    	'hasil_ver_pa_nomor_ktp_pjbu', 'catatan_ver_pa_nomor_ktp_pjbu',
    	'hasil_ver_pa_nomor_paspor_pjbu', 'catatan_ver_pa_nomor_paspor_pjbu',
    	'hasil_ver_pa_file_laporan_keuangan', 'catatan_ver_pa_file_laporan_keuangan',
    	'hasil_ver_pa_kekayaan_bersih', 'catatan_ver_pa_kekayaan_bersih',
    	'hasil_ver_pa_modal_disetor', 'catatan_ver_pa_modal_disetor',
    	'hasil_ver_pa_nama_kantor_akuntan_publik', 'catatan_ver_pa_nama_kantor_akuntan_publik',
    	'hasil_ver_pa_alamat_kantor_akuntan_pulik', 'catatan_ver_pa_alamat_kantor_akuntan_pulik',
    	'hasil_ver_pa_nomor_telepon_kantor_akuntan_publik', 'catatan_ver_pa_nomor_telepon_kantor_akuntan_publik',
    	'hasil_ver_pa_nama_akuntan', 'catatan_ver_pa_nama_akuntan',
    	'hasil_ver_pa_nomor_laporan_keuangan', 'catatan_ver_pa_nomor_laporan_keuangan',
    	'hasil_ver_pa_tanggal_laporan_keuangan', 'catatan_ver_pa_tanggal_laporan_keuangan',
    	'hasil_ver_pa_pendapat_akuntan', 'catatan_ver_pa_pendapat_akuntan',
    	'hasil_ver_pa_file_struktur_organisasi_badan_usaha', 'catatan_ver_pa_file_struktur_organisasi_badan_usaha',
    	'hasil_ver_pa_file_profile_badan_usaha', 'catatan_ver_pa_file_profile_badan_usaha',
    	'hasil_ver_pa_file_ppm', 'catatan_ver_pa_file_ppm',
    	'hasil_ver_pa_nomor_ppm', 'catatan_ver_pa_nomor_ppm',
    	'hasil_ver_pa_tanggal_ppm', 'catatan_ver_pa_tanggal_ppm',
    	'hasil_ver_pa_prosentase_saham_pma_ppm', 'catatan_ver_pa_prosentase_saham_pma_ppm',
    	'hasil_ver_pa_file_ppm_perubahan', 'catatan_ver_pa_file_ppm_perubahan',
    	'hasil_ver_pa_nomor_ppm_perubahan', 'catatan_ver_pa_nomor_ppm_perubahan',
    	'hasil_ver_pa_tanggal_ppm_perubahan', 'catatan_ver_pa_tanggal_ppm_perubahan',
    	'hasil_ver_pa_prosentase_saham_pma_ppm_perubahan', 'catatan_ver_pa_prosentase_saham_pma_ppm_perubahan'
    ];
}
