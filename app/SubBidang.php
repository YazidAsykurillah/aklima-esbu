<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubBidang extends Model
{
    protected $table = 'sub_bidang';

    protected $primaryKey = 'uid_sub_bidang';

    protected $fillable = [
    	'uid_sub_bidang', 'kode_sub_bidang', 'nama_sub_bidang', 'uid_bidang', 'uid_jenis_usaha', 'is_active'
    ];

    //Relation to Bidang
    public function bidang()
    {
    	return $this->belongsTo('App\Bidang', 'uid_bidang', 'uid_bidang');
    }

    //Relation to Jenis Usaha
    public function jenis_usaha()
    {
    	return $this->belongsTo('App\JenisUsaha', 'uid_jenis_usaha', 'uid_jenis_usaha');
    }
}
