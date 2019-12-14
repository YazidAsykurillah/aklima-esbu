<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LsbuWilayah extends Model
{
    protected $table = 'lsbu_wilayah';
    protected $fillable = [
    	'uid_lsbu', 'kode_lsbu', 'nama_lsbu', 'nama_lsbu_short', 'kategori_lsbu', 'jenis_lsbu', 
    	'alamat', 'provinsi_uid', 'parent_lsbu_uid', 'api_keys', 'is_active'
    ];
    protected $primaryKey = 'uid_lsbu';
}
