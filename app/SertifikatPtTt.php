<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SertifikatPtTt extends Model
{
    protected $table = 'sertifikat_pt_tt';
    protected $fillable =[
    	'id',
    	'uid_permohonan', 'uid_verifikasi_pt', 'uid_ver_pt_tt', 'noreg_serkom', 'no_serkom',
    	'tgl_sertifikat', 'lembaga_penerbit', 'level', 'unit_kompetensi', 'file_serkom', 'bidang',
    	'jenis_pekerjaan'
    ];
}
