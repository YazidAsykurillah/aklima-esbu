<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPengurusDewanDireksi extends Model
{
    protected $table = 'data_pengurus_dewan_direksi';
    protected $fillable = [
    	'uid_ver_dp_dewan_direksi', 'uid_dewan_direksi', 'uid_permohonan',
    	'jenis_identitas', 'nama', 'nomor_identitas', 'nomor_passpor', 'nomor_ktp', 'alamat',
    	'kewarganegaraan', 'jabatan', 'npwp'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan', 'uid_permohonan');
    }
}
