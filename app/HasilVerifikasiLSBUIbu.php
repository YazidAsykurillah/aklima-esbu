<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilVerifikasiLSBUIbu extends Model
{
    protected $table = 'hasil_verifikasi_lsbu_ibu';

    protected $fillable = [
    	'uid_verifikasi_lsbu_ibu', 'permohonan_uid',
    	'hasil_ver_nama_badan_usaha', 'catatan_ver_nama_badan_usaha',
    	'hasil_ver_alamat_badan_usaha', 'catatan_ver_alamat_badan_usaha',
    	'hasil_ver_kota_badan_usaha', 'catatan_ver_kota_badan_usaha',
    	'hasil_ver_kecamatan_badan_usaha', 'catatan_ver_kecamatan_badan_usaha',
    	'hasil_ver_kelurahan_badan_usaha', 'catatan_ver_kelurahan_badan_usaha',
    	'hasil_ver_kode_pos_badan_usaha', 'catatan_ver_kode_pos_badan_usaha',
    	'hasil_ver_no_telp_kantor_badan_usaha', 'catatan_ver_no_telp_kantor_badan_usaha',
    	'hasil_ver_no_hp_kantor_badan_usaha', 'catatan_ver_no_hp_kantor_badan_usaha',
    	'hasil_ver_no_fax_badan_usaha', 'catatan_ver_no_fax_badan_usaha',
    	'hasil_ver_email_badan_usaha', 'catatan_ver_email_badan_usaha', 
    	'hasil_ver_website_badan_usaha', 'catatan_ver_website_badan_usaha',
    	'hasil_ver_nama_penghubung_badan_usaha', 'catatan_ver_nama_penghubung_badan_usaha',
    	'hasil_ver_no_hp_penghubung_badan_usaha', 'catatan_ver_no_hp_penghubung_badan_usaha',
    	'hasil_ver_file_surat_permohonan_sbu_badan_usaha', 'catatan_ver_file_surat_permohonan_sbu_badan_usaha',
    	'hasil_ver_nomor_surat_badan_usaha', 'catatan_ver_nomor_surat_badan_usaha',
    	'hasil_ver_perihal_badan_usaha', 'catatan_ver_perihal_badan_usaha',
    	'hasil_ver_tanggal_surat_badan_usaha', 'catatan_ver_tanggal_surat_badan_usaha',
    	'hasil_ver_nama_penandatangan_surat_badan_usaha', 'catatan_ver_nama_penandatangan_surat_badan_usaha',
    	'hasil_ver_jabatan_penandatangan_surat_badan_usaha', 'catatan_ver_jabatan_penandatangan_surat_badan_usaha',
    	'hasil_ver_bentuk_badan_usaha', 'catatan_ver_bentuk_badan_usaha',
    	'updated_at'

    ];


}
