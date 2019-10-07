<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatriksKualifikasi extends Model
{
    protected $table = 'matriks_kualifikasi';

    protected $primaryKey = 'uid_matriks_kualifikasi';

    protected $fillable = [
    	'uid_matriks_kualifikasi', 'jenis_usaha_uid', 'bidang_uid', 'sub_bidang_uid', 'kualifikasi',
    	'modal_disetor_min', 'modal_disetor_maks', 'pjt_jumlah', 'pjt_level', 'tt_jumlah', 'tt_level',
    	'batas_nilai_1_pekerjaan'
    ];


    //Relation to Jenis Usaha
    public function jenis_usaha()
    {
    	return $this->belongsTo('App\JenisUsaha', 'jenis_usaha_uid', 'uid_jenis_usaha')->withDefault();
    }

    public function bidang()
    {
    	return $this->belongsTo('App\Bidang', 'bidang_uid', 'uid_bidang')->withDefault();
    }


    public function sub_bidang()
    {
    	return $this->belongsTo('App\SubBidang', 'sub_bidang_uid', 'uid_sub_bidang')->withDefault();
    }
}
