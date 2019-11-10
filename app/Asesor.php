<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $table ='asesor';
    protected $primaryKey = 'uid_asesor';
    protected $fillable = [
    	'uid_asesor', 'nik', 'nama_asesor', 'alamat', 'email', 'nomor_handphone', 'is_active'
    ];


}
