<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';

    protected $primaryKey = 'uid_kelurahan';

    protected $fillable = [
    	'kecamatan_uid', 'uid_kelurahan', 'nama', 'jenis'
    ];

    public function kecamatan()
    {
    	return $this->belongsTo('App\Kecamatan', 'kecamatan_uid');
    }

    
}
