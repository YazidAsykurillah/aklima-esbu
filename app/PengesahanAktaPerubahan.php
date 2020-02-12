<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengesahanAktaPerubahan extends Model
{
    protected $table = 'pengesahan_akta_perubahan';

    protected $fillable = [
    	'uid_verifikasi_pa', 'uid_permohonan', 'file_pengesahan_akta_perubahan', 'nomor',
    	'tentang', 'tanggal'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan', 'uid_permohonan');
    }
}
