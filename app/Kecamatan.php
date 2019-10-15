<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'kota_uid';
    protected $fillable = [
    	'uid_kecamatan', 'kota_uid', 'nama'
    ];

    public function kota()
    {
    	return $this->belongsTo('App\Kota', 'kota_uid', 'uid_kota')->withDefault();
    }
}
