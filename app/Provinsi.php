<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    protected $primaryKey = 'uid_provinsi';

    protected $fillable = [
    	'uid_provinsi', 'kode_provinsi', 'nama_provinsi', 'is_active'
    ];
}
