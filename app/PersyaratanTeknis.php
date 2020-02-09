<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersyaratanTeknis extends Model
{
    protected $table = 'persyaratan_teknis';
    protected $primaryKey = 'uid_verifikasi_pt';

    protected $fillable = [
    	'uid_permohonan', 'uid_sub_bidang', 'uid_verifikasi_pt'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan', 'uid_permohonan', 'uid_permohonan');
    }

    public function sub_bidang()
    {
    	return $this->belongsTo('App\SubBidang', 'uid_sub_bidang', 'uid_sub_bidang');
    }

    public function persyaratan_teknis_penanggung_jawab_teknis()
    {
        return $this->hasMany('App\PersyaratanTeknisPenanggungJawabTeknis','uid_verifikasi_pt');
    }

    public function persyaratan_teknis_tenaga_teknik()
    {
        return $this->hasMany('App\PersyaratanTeknisTenagaTeknik', 'uid_verifikasi_pt');
    }
}
