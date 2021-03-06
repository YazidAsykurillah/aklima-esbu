<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permohonan;
use App\VerifikasiIbu;

class VerifikasiIbuController extends Controller
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
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);

        $verifikasi_ibu = VerifikasiIbu::updateOrCreate(
            [
                'uid_permohonan'=>$permohonan->uid_permohonan
            ],
            [
                'uid_permohonan'=>$permohonan->uid_permohonan,
                'hasil_ver_ibu_file_surat_permohonan_sbu'=>$request->hasil_ver_ibu_file_surat_permohonan_sbu,
                'catatan_ver_ibu_file_surat_permohonan_sbu'=>$request->catatan_ver_ibu_file_surat_permohonan_sbu,
                'hasil_ver_ibu_nomor_surat'=>$request->hasil_ver_ibu_nomor_surat,
                'catatan_ver_ibu_nomor_surat'=>$request->catatan_ver_ibu_nomor_surat,
                'hasil_ver_ibu_perihal'=>$request->hasil_ver_ibu_perihal,
                'catatan_ver_ibu_perihal'=>$request->catatan_ver_ibu_perihal,
                'hasil_ver_ibu_tanggal_surat'=>$request->hasil_ver_ibu_tanggal_surat,
                'catatan_ver_ibu_tanggal_surat'=>$request->catatan_ver_ibu_tanggal_surat,
                'hasil_ver_ibu_nama_penandatangan_surat'=>$request->hasil_ver_ibu_nama_penandatangan_surat,
                'catatan_ver_ibu_nama_penandatangan_surat'=>$request->catatan_ver_ibu_nama_penandatangan_surat,
                'hasil_ver_ibu_jabatan_penandatangan_surat'=>$request->hasil_ver_ibu_jabatan_penandatangan_surat,
                'catatan_ver_ibu_jabatan_penandatangan_surat'=>$request->catatan_ver_ibu_jabatan_penandatangan_surat,
            ]
        );
        
        return redirect()->back();
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
}
