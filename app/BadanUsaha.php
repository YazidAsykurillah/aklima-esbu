<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadanUsaha extends Model
{
    protected $table ='badan_usaha';
    protected $primaryKey = 'uid_badan_usaha';
    protected $fillable = [
    	'uid_badan_usaha', 'bentuk_badan_usaha_uid', 'nama_badan_usaha', 'alamat_badan_usaha',
    	'kelurahan_uid', 'kecamatan_uid', 'kota_uid', 'no_telp_kantor', 'no_hp_kantor', 'no_fax',
    	'website', 'nik_penanggung_jawab', 'nama_penanggung_jawab', 'jenis_kewarganegaraan', 'kewarganegaraan',
    	'passport', 'no_telepon_penanggung_jawab', 'email_perusahaan'
    ];

    protected $append = ['full_address'];

    //Relation with BentukBadanUsaha
    public function bentuk_badan_usaha()
    {
    	return $this->belongsTo('App\BentukBadanUsaha', 'bentuk_badan_usaha_uid', 'uid_bentuk_badan_usaha')->withDefault();
    }

    //Relation with Kelurahan
    public function kelurahan()
    {
    	return $this->belongsTo('App\Kelurahan', 'kelurahan_uid', 'uid_kelurahan')->withDefault();
    }

    //Relation with Kecamatan
    public function kecamatan()
    {
    	return $this->belongsTo('App\Kecamatan', 'kecamatan_uid', 'uid_kecamatan')->withDefault();
    }

    //Relation with Kota
    public function kota()
    {
    	return $this->belongsTo('App\Kota', 'kota_uid', 'uid_kota')->withDefault();
    }

    
    //Full Address attribute
    public function getFullAddressAttribute()
    {
        $full_address="";
        $full_address.=$this->alamat_badan_usaha.'<br/>';
        $full_address.='Kecamatan '.$this->kecamatan->nama.',&nbsp;';
        $full_address.=$this->kota->nama_kota.',';
        $full_address.='Provinsi '.$this->kota->provinsi->nama_provinsi;
        return $full_address;
    }
}
