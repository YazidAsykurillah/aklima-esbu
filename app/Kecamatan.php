<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'uid_kecamatan';
    protected $fillable = [
    	'kota_uid', 'uid_kecamatan', 'nama'
    ];

    public function kota()
    {
    	return $this->belongsTo('App\Kota', 'kota_uid', 'uid_kota')->withDefault();
    }
}
