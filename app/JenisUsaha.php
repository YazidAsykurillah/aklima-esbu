<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisUsaha extends Model
{
    protected $table = 'jenis_usaha';

    protected $primaryKey = 'uid_jenis_usaha';

    protected $fillable = [
    	'uid_jenis_usaha', 'kode_jenis_usaha', 'nama_jenis_usaha', 'is_active'
    ];
}
