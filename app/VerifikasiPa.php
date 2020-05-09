<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifikasiPa extends Model
{
    protected $table = 'verifikasi_pa';

    protected $fillable =[
    	'uid_permohonan'
    ];
}
