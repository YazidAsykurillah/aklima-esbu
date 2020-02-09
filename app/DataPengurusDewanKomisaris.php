<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPengurusDewanKomisaris extends Model
{
    protected $table = 'data_pengurus_dewan_komisaris';
    protected $fillable = [
    	'uid_ver_dp_dewan_komisaris',
    	'uid_permohonan', 'jenis_identitas', 'nama', 'nomor_identitas', 'nomor_passpor', 'nomor_ktp', 'alamat',
    	'kewarganegaraan', 'jabatan', 'npwp', 'uid_dewan_pengurus'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan', 'uid_permohonan');
    }
}
