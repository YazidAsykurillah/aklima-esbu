<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifikasiIbu extends Model
{
    protected $table = 'verifikasi_ibus';

    protected $fillable = [
    	'uid_permohonan',
    	'hasil_ver_ibu_file_surat_permohonan_sbu', 'catatan_ver_ibu_file_surat_permohonan_sbu',
    	'hasil_ver_ibu_nomor_surat', 'catatan_ver_ibu_nomor_surat',
    	'hasil_ver_ibu_perihal', 'catatan_ver_ibu_perihal',
    	'hasil_ver_ibu_tanggal_surat', 'catatan_ver_ibu_tanggal_surat',
    	'hasil_ver_ibu_nama_penandatangan_surat', 'catatan_ver_ibu_nama_penandatangan_surat',
    	'hasil_ver_ibu_jabatan_penandatangan_surat', 'catatan_ver_ibu_jabatan_penandatangan_surat'
    ];

    
}
