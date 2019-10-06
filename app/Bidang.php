<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'bidang';

    protected $primaryKey = 'uid_bidang';

    protected $fillable = [
    	'uid_bidang', 'kode_bidang', 'nama_bidang', 'is_active'
    ];
}
