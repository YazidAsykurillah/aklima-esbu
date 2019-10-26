<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $table = 'permohonan';
    protected $primaryKey = 'uid_permohonan';
    protected $fillable = [
    	'uid_permohonan', 'jenis_usaha_uid', 'jenis_sertifikasi', 'perpanjangan_ke', 'badan_usaha_uid',
    	'status'
    ];

    //Relation with JenisUsaha
    public function jenis_usaha()
    {
    	return $this->belongsTo('App\JenisUsaha', 'jenis_usaha_uid', 'uid_jenis_usaha')->withDefault();
    }

    //Relation with BadanUsaha
    public function badan_usaha()
    {
    	return $this->belongsTo('App\BadanUsaha', 'badan_usaha_uid', 'uid_badan_usaha')->withDefault();
    }
}
