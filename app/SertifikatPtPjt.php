<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SertifikatPtPjt extends Model
{
    protected $table = 'sertifikat_pt_pjt';
    protected $fillable =[
    	'id',
    	'uid_permohonan', 'uid_verifikasi_pt', 'uid_ver_pt_pjt', 'noreg_serkom', 'no_serkom',
    	'tgl_sertifikat', 'lembaga_penerbit', 'level', 'unit_kompetensi', 'file_serkom', 'bidang',
    	'jenis_pekerjaan'
    ];
}
