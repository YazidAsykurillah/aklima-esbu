<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BentukBadanUsaha extends Model
{
    protected $table = 'bentuk_badan_usaha';

    protected $primaryKey = 'uid_bentuk_badan_usaha';

    protected $fillable = [
    	'uid_bentuk_badan_usaha', 'nama_bentuk_badan_usaha', 'nama_singkat',
    	'updated_at'
    ];
}
