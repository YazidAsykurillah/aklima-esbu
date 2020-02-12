<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktaPerubahanBuPa extends Model
{
    protected $table = 'akta_perubahan_bu_pa';
    protected $fillable = [
    	'uid_verifikasi_pa', 'uid_permohonan', 'file_akta_pendirian_bu', 'nama_notaris', 'judul_akta',
    	'tanggal_akta', 'nomor_akta', 'hal_yang_diubah', 'file_akta_perubahan_bu', 'uid_akta_perubahan_bu'
    ];
}
