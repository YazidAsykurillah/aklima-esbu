<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $table = 'permohonan';
    protected $primaryKey = 'uid_permohonan';
    protected $fillable = [
    	'uid_permohonan', 'jenis_usaha_uid', 'jenis_sertifikasi', 'perpanjangan_ke', 'badan_usaha_uid', 'is_processed',
    	'asesor_tt_id', 'asesor_pjt_id', 'status', 'nomor_sertifikat', 'nomor_registrasi', 'nomor_agenda'
    ];

    //Relation with JenisUsaha
    public function jenis_usaha()
    {
    	return $this->belongsTo('App\JenisUsaha', 'jenis_usaha_uid', 'uid_jenis_usaha')->withDefault();
    }

    //Relation with BadanUsaha
    public function badan_usaha()
    {
    	return $this->belongsTo('App\BadanUsaha', 'badan_usaha_uid', 'uid_badan_usaha')->withDefault();
    }

    //Relation with Identitas Badan Usaha
    public function identitas_badan_usaha()
    {
        return $this->hasOne('App\IdentitasBadanUsaha', 'permohonan_uid');
    }

    //Relation with Persyaratan Administratif
    public function persyaratan_administratif()
    {
        return $this->hasOne('App\PersyaratanAdministratif', 'uid_permohonan');
    }


    public function persyaratan_teknis()
    {
        return $this->hasMany('App\PersyaratanTeknis', 'uid_permohonan');
    }

    //Asesor Tenaga Teknik
    public function asesor_tenaga_teknik()
    {
        return $this->belongsTo('App\Asesor', 'asesor_tt_id', 'uid_asesor');
    }

    public function getUidPermohonanTTAttribute()
    {

        $uid_permohonan_asesor_tt = NULL;
        if($this->asesor_tenaga_teknik){
            $query = \DB::table('asesor_permohonan')->select('uid_permohonan_asesor')
                ->where('uid_asesor', '=', $this->asesor_tt_id)
                ->where('type', '=', 'tt')
                ->where('uid_permohonan', '=', $this->uid_permohonan)
                ->get();
            if($query->count()){
                $uid_permohonan_asesor_tt = $query->first()->uid_permohonan_asesor;
            }
        }
        return $uid_permohonan_asesor_tt;
    }

    //Asesor Penanggun Jawab Teknik
    public function asesor_penanggung_jawab_teknik()
    {
        return $this->belongsTo('App\Asesor', 'asesor_pjt_id', 'uid_asesor');
    }

    public function getUidPermohonanPJTAttribute()
    {
        $uid_permohonan_asesor_pjt = NULL;
        if($this->asesor_penanggung_jawab_teknik){
            $query = \DB::table('asesor_permohonan')->select('uid_permohonan_asesor')
                ->where('uid_asesor', '=', $this->asesor_pjt_id)
                ->where('type', '=', 'pjt')
                ->where('uid_permohonan', '=', $this->uid_permohonan)
                ->get();
            if($query->count()){
                $uid_permohonan_asesor_pjt = $query->first()->uid_permohonan_asesor;
            }
        }
        return $uid_permohonan_asesor_pjt;
    }

    public function log_permohonan()
    {
        return $this->hasMany('App\LogPermohonan', 'uid_permohonan');
    }

    //Data Pengurus Dewan Komisaris
    public function data_pengurus_dewan_komisaris()
    {
        return $this->hasMany('App\DataPengurusDewanKomisaris', 'uid_permohonan');
    }

    //Data Pengurus Dewan Direksi
    public function data_pengurus_dewan_direksi()
    {
        return $this->hasMany('App\DataPengurusDewanDireksi', 'uid_permohonan');
    }

    //Data Pengurus Pemegang Saham
    public function data_pengurus_pemegang_saham()
    {
        return $this->hasMany('App\DataPengurusPemegangSaham', 'uid_permohonan');
    }


    public function sertifikat()
    {
        return $this->hasMany('App\Sertifikat', 'uid_permohonan');
    }

    public function status_djk()
    {
        return $this->hasOne('App\StatusDjk', 'uid_permohonan');
    }

    public function akta_perubahan_bu_pa()
    {
        return $this->hasOne('App\AktaPerubahanBuPa', 'uid_permohonan');
    }

    public function pengesahan_akta_perubahan()
    {
        return $this->hasOne('App\PengesahanAktaPerubahan', 'uid_permohonan');
    }


    public function verifikasi_ibu()
    {
        return $this->hasOne('App\VerifikasiIbu', 'uid_permohonan');
    }


    public function verifikasi_pa()
    {
        return $this->hasOne('App\VerifikasiPa', 'uid_permohonan');
    }


    //custom medthods
    public static function counter()
    {
        $result['permohonan_0_count'] = 'DUMMY NUMBER';
        $result['permohonan_1_count'] = 'DUMMY NUMBER';
        $result['permohonan_4_count'] = 'DUMMY NUMBER';
        $result['permohonan_5_count'] = 'DUMMY NUMBER';
        $result['permohonan_7_count'] = 'DUMMY NUMBER';

        $user = \Auth::user();
        $provinsi_id = $user->provinsi_id;

        if($user->isSuperAdmin() == TRUE){
            $result['permohonan_0_count'] = Permohonan::where('status','=', '0')
                ->where('is_processed', '=', TRUE)
                ->get()->count();

            $result['permohonan_1_count'] = Permohonan::where('status','=', '1')
                ->where('is_processed', '=', TRUE)
                ->get()->count();

            $result['permohonan_4_count'] = Permohonan::where('status','=', '4')
                ->where('is_processed', '=', TRUE)
                ->get()->count();

            $result['permohonan_5_count'] = Permohonan::where('status','=', '5')
                ->where('is_processed', '=', TRUE)
                ->get()->count();
            $result['permohonan_7_count'] = Permohonan::where('status','=', '7')
                ->where('is_processed', '=', TRUE)
                ->get()->count();
        }
        //User DPP
        else if($user->isDpp() == TRUE){
            $result['permohonan_0_count'] = Permohonan::where('status','=', '0')
                ->where('is_processed', '=', TRUE)
                ->get()->count();

            $result['permohonan_1_count'] = Permohonan::where('status','=', '1')
                ->where('is_processed', '=', TRUE)
                ->get()->count();

            $result['permohonan_4_count'] = Permohonan::where('status','=', '4')
                ->where('is_processed', '=', TRUE)
                ->get()->count();

            $result['permohonan_5_count'] = Permohonan::where('status','=', '5')
                ->where('is_processed', '=', TRUE)
                ->get()->count();
            $result['permohonan_7_count'] = Permohonan::where('status','=', '7')
                ->where('is_processed', '=', TRUE)
                ->get()->count();
        }
        //User DPD
        else if($user->isDpd() == TRUE){
            $result['permohonan_0_count'] = Permohonan::with(['badan_usaha', 'badan_usaha.kota.provinsi'])
                ->where('status','=', '0')
                ->where('is_processed', '=', TRUE)
                ->where('badan_usaha_uid','!=', NULL)
                ->whereHas('badan_usaha.kota.provinsi', function($query) use($provinsi_id){
                    return $query->where('uid_provinsi','=', $provinsi_id);
                })
                ->get()->count();

            $result['permohonan_1_count'] = Permohonan::with(['badan_usaha', 'badan_usaha.kota.provinsi'])
                ->where('status','=', '1')
                ->where('is_processed', '=', TRUE)
                ->where('badan_usaha_uid','!=', NULL)
                ->whereHas('badan_usaha.kota.provinsi', function($query) use($provinsi_id){
                    return $query->where('uid_provinsi','=', $provinsi_id);
                })
                ->get()->count();

            $result['permohonan_4_count'] = Permohonan::with(['badan_usaha', 'badan_usaha.kota.provinsi'])
                ->where('status','=', '4')
                ->where('is_processed', '=', TRUE)
                ->where('badan_usaha_uid','!=', NULL)
                ->whereHas('badan_usaha.kota.provinsi', function($query) use($provinsi_id){
                    return $query->where('uid_provinsi','=', $provinsi_id);
                })
                ->get()->count();

            $result['permohonan_5_count'] = Permohonan::with(['badan_usaha', 'badan_usaha.kota.provinsi'])
                ->where('status','=', '5')
                ->where('is_processed', '=', TRUE)
                ->where('badan_usaha_uid','!=', NULL)
                ->whereHas('badan_usaha.kota.provinsi', function($query) use($provinsi_id){
                    return $query->where('uid_provinsi','=', $provinsi_id);
                })
                ->get()->count();

            $result['permohonan_7_count'] = Permohonan::with(['badan_usaha', 'badan_usaha.kota.provinsi'])
                ->where('status','=', '7')
                ->where('is_processed', '=', TRUE)
                ->where('badan_usaha_uid','!=', NULL)
                ->whereHas('badan_usaha.kota.provinsi', function($query) use($provinsi_id){
                    return $query->where('uid_provinsi','=', $provinsi_id);
                })
                ->get()->count();
        }
        //User ASESOR
        else if($user->asesor->count()){
            
            $result['permohonan_1_count'] = Permohonan::where('status','=', '1')
                ->where('is_processed', '=', TRUE)
                ->where('asesor_tt_id', $user->asesor->uid_asesor)
                ->get()->count();

            $result['permohonan_4_count'] = Permohonan::where('status','=', '4')
                ->where('is_processed', '=', TRUE)
                ->where('asesor_pjt_id', $user->asesor->uid_asesor)
                ->get()->count();
        }
        else{

        }


        return $result;
    }
}
