<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifikasiPt extends Model
{
    protected $table = 'verifikasi_pt';

    protected $fillable = [
    	'uid_permohonan',
    	'hasil_ver_pt', 'catatan_ver_pt'
    ];
}
