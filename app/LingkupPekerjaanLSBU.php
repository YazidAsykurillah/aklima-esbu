<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LingkupPekerjaanLSBU extends Model
{
    protected $table = 'lingkup_pekerjaan_lsbu';

    protected $fillable = [
    	'uid_lsbu_lingkup_pekerjaan', 'uid_lsbu', 'uid_jenis_usaha', 'uid_bidang', 'uid_sub_bidang'
    ];

    protected $primaryKey = 'uid_lsbu_lingkup_pekerjaan';
}
