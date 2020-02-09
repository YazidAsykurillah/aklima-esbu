<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersyaratanAdministratif extends Model
{
    protected $table = 'persyaratan_administratif';
    protected $primaryKey = 'uid_verifikasi_pa';

    protected $fillable = [
    	'uid_verifikasi_pa', 'uid_permohonan',
    	'file_akta_pendirian_bu', 'nama_notaris', 'judul_akta', 'tanggal_akta',
    	'nomor_akta', 'maksud_tujuan_akta', 'file_pengesahan_sebagai_badan_hukum', 'nomor_badan_hukum',
    	'tentang_badan_hukum', 'tanggal_badan_hukum', 'file_npwp', 'nomor_npwp', 'file_skdu', 'instansi_penerbit_skdu',
    	'nomor_skdu', 'tanggal_skdu', 'masa_berlaku_skdu', 'file_pjbu', 'nama_pjbu', 'jenis_identitas_pjbu',
    	'nomor_ktp_pjbu', 'nomor_paspor_pjbu', 'file_laporan_keuangan', 'kekayaan_bersih', 'modal_disetor',
    	'nama_kantor_akuntan_publik', 'alamat_kantor_akuntan_pulik', 'nomor_telepon_kantor_akuntan_publik',
    	'nama_akuntan', 'nomor_laporan_keuangan', 'tanggal_laporan_keuangan', 'pendapat_akuntan',
    	'file_struktur_organisasi_badan_usaha', 'file_profile_badan_usaha', 'file_ppm', 'nomor_ppm' ,'tanggal_ppm',
    	'prosentase_saham_pma_ppm', 'file_ppm_perubahan', 'nomor_ppm_perubahan', 'tanggal_ppm_perubahan',
    	'prosentase_saham_pma_ppm_perubahan'
    ];

    //Relation to Permohonan
    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan', 'uid_permohonan', 'uid_permohonan')->withDefault();
    }
    
}
