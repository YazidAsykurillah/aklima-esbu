<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatriksKualifikasi extends Model
{
    protected $table = 'matriks_kualifikasi';

    protected $fillable = [
    	'uid_matriks_kualifikasi', 'jenis_usaha_uid', 'bidang_uid', 'sub_bidang_uid', 'kualifikasi',
    	'modal_disetor_min', 'modal_disetor_maks', 'pjt_jumlah', 'pjt_level', 'tt_jumlah', 'tt_level',
    	'batas_nilai_1_pekerjaan'
    ];
}
