<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kota';
    protected $primaryKey = 'uid_kota';
    protected $fillable = [
    	'provinsi_uid', 'uid_kota', 'kode_kota', 'nama_kota', 'is_active'
    ];

    public function provinsi()
    {
    	return $this->belongsTo('App\Provinsi', 'provinsi_uid', 'uid_provinsi')->withDefault();
    }
}
