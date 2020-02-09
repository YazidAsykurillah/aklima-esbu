<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersyaratanTeknisTenagaTeknik extends Model
{
    protected $table = 'persyaratan_teknis_tenaga_teknik';

    protected $primaryKey = 'uid_ver_pt_tt';

    protected $fillable = [
    	'uid_permohonan', 'uid_verifikasi_pt', 'jenis_identitas', 'nama', 'nomor_identitas', 'nomor_hp', 'nomor_passpor', 'nomor_ktp',
    	'file_kartu_identitas', 'file_pernyataan_pjt', 'file_surat_penunjukan_pjt', 'file_daftar_riwayat_hidup', 'kewarganegaraan',
    	'uid_ver_pt_tt',
    ];

    public function persyaratan_teknis()
    {
    	return $this->belongsTo('App\PersyaratanTeknis', 'uid_verifikasi_pt');
    }

    public function sertifikat_pt_tt()
    {
        return $this->hasMany('App\SertifikatPtTt', 'uid_ver_pt_tt');
    }

}
