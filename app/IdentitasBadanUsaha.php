<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentitasBadanUsaha extends Model
{
    protected $table = 'identitas_badan_usaha';

    protected $fillable = [
    	'permohonan_uid', 'uid_verifikasi_ibu', 'file_surat_permohonan_sbu',
    	'nomor_surat', 'perihal', 'tanggal_surat', 'nama_penandatangan_surat', 'jabatan_penandatangan_surat'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan', 'permohonan_uid', 'uid_permohonan');
    }
}
