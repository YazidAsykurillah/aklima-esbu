<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifikasiDp extends Model
{
    protected $table = 'verifikasi_dp';

    protected $fillable = [
    	'uid_permohonan',
    	'hasil_ver_dp_dk', 'catatan_ver_dp_dk',
    	'hasil_ver_dp_dd', 'catatan_ver_dp_dd',
    	'hasil_ver_dp_ps', 'catatan_ver_dp_ps'
    ];
}
