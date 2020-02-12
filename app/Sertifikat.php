<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';

    protected $fillable = [
    	'uid_permohonan', 'nomor_sertifikat', 'nomor_registrasi',
    	'tanggal_terbit', 'tanggal_expired', 'uid_jenis_usaha', 'uid_bidang', 'uid_sub_bidang',
    	'kualifikasi', 'status_sertifikat'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan', 'uid_permohonan', 'uid_permohonan');
    }

    public function sub_bidang()
    {
        return $this->belongsTo('App\SubBidang', 'uid_sub_bidang');
    }

    public function jenis_usaha()
    {
        return $this->belongsTo('App\JenisUsaha', 'uid_jenis_usaha');
    }
}
