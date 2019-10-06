<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
	//Bentuk Badan Usaha
    public function renderBentukBadanUsahaView(Request $request)
    {
    	return view('master-data.bentuk-badan-usaha');
    }

    //Jenis Usaha
    public function renderJenisUsahaView(Request $request)
    {
    	return view('master-data.jenis-usaha');
    }

    //Bidang
    public function renderBidangView(Request $request)
    {
    	return view('master-data.bidang');
    }

    //SubBidang
    public function renderSubBidangView(Request $request)
    {
    	return view('master-data.sub-bidang');
    }

    //Matriks Kualifikasi
    public function renderMatriksKualifikasiView(Request $request)
    {
        return view('master-data.matriks-kualifikasi');
    }

    //Provinsi
    public function renderProvinsiView(Request $request)
    {
        return view('master-data.provinsi');
    }

    //Kota
    public function renderKotaView(Request $request)
    {
        return view('master-data.kota');
    }

    //Kota
    public function renderKecamatanView(Request $request)
    {
        return view('master-data.kecamatan');
    }

    //Kelurahan
    public function renderKelurahanView(Request $request)
    {
        return view('master-data.kelurahan');
    }

    //Asesor
    public function renderAsesorView(Request $request)
    {
        return view('master-data.asesor');
    }

    //Badan Usaha
    public function renderBadanUsahaView(Request $request)
    {
        return view('master-data.badan-usaha');
    }

}
