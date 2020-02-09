<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPengurusPemegangSaham extends Model
{
    protected $table = 'data_pengurus_pemegang_saham';
    protected $fillable = [
    	'uid_permohonan', 'uid_pemegang_saham', 'uid_verifikasi_dp', 'jenis_identitas', 'nama',
    	'nomor_identitas', 'negara', 'nomor_passpor', 'nomor_ktp', 'prosentase_kepemilikan_saham',
    	'nominal_kepemilikan_saham'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan', 'uid_permohonan');
    }
}
