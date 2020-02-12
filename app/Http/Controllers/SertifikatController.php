<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sertifikat;
use App\PersyaratanTeknis;
use App\PersyaratanTeknisPenanggungJawabTeknis;
use App\PersyaratanTeknisTenagaTeknik;
use App\MatriksKualifikasi;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function printPdf($id){
        $sertifikat = Sertifikat::findOrFail($id);
        //return $sertifikat;
        $matriks_kualifikasi = MatriksKualifikasi::where('jenis_usaha_uid','=', $sertifikat->uid_jenis_usaha)
                                ->where('bidang_uid', '=', $sertifikat->uid_bidang)
                                ->where('sub_bidang_uid', '=', $sertifikat->uid_sub_bidang)
                                ->where('kualifikasi','=', $sertifikat->kualifikasi)
                                ->get();
        
        $permohonan = $sertifikat->permohonan;
        $penanggung_jawab_teknis = NULL;
        $tenaga_teknik = NULL;
        $persyaratan_teknis = PersyaratanTeknis::where('uid_sub_bidang', '=', $sertifikat->uid_sub_bidang)->first();
        if($persyaratan_teknis){
            $penanggung_jawab_teknis = PersyaratanTeknisPenanggungJawabTeknis::where('uid_verifikasi_pt','=',$persyaratan_teknis->uid_verifikasi_pt)->get();
            $tenaga_teknik = PersyaratanTeknisTenagaTeknik::where('uid_verifikasi_pt','=',$persyaratan_teknis->uid_verifikasi_pt)->get();
        }
        

        $export_name = 'Permohonan-'.$permohonan->uid_permohonan.'.pdf';
        

        $data = [
            'sertifikat'=>$sertifikat,
            'penanggung_jawab_teknis'=>$penanggung_jawab_teknis,
            'tenaga_teknik'=>$tenaga_teknik,
            'matriks_kualifikasi'=>$matriks_kualifikasi,
        ];

        $pdf = \PDF::loadView('sertifikat.print_pdf', $data)->setPaper('A4', 'landscape');


        return $pdf->stream($export_name);
    }
}
