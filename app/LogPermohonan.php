<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogPermohonan extends Model
{
    protected $table = 'log_permohonan';

    protected $fillable = [
    	'uid_permohonan', 'from_to', 'description'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan','uid_permohonan');
    }
}
