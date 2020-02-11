<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusDjk extends Model
{
    protected $table = 'status_djk';

    protected $fillable = [
    	'uid_permohonan', 'tahap', 'keterangan_tahap', 'status', 'keterangan_status', 'updated_at'
    ];

    public function permohonan()
    {
    	return $this->belongsTo('App\Permohonan');
    }
}
