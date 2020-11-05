<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permohonan;

class VerificationResultController extends Controller
{
    public function index($uid_permohonan)
    {
    	$permohonan = Permohonan::findOrFail($uid_permohonan);
    	$export_name = 'Hasil Verifikasi-'.$permohonan->uid_permohonan.'.pdf';
        

        $data = [
            'permohonan'=>$permohonan,
            'badan_usaha'=>$permohonan->badan_usaha,
            'identitas_badan_usaha'=>$permohonan->identitas_badan_usaha,
            'verifikasi_ibu'=>$permohonan->verifikasi_ibu,
            'persyaratan_administratif'=>$permohonan->persyaratan_administratif,
            'verifikasi_pa'=>$permohonan->verifikasi_pa,
            'persyaratan_teknis'=>$permohonan->persyaratan_teknis,
            'verifikasi_pt'=>$permohonan->verifikasi_pt,
        ];
        
        //return $data['verifikasi_ibu'];
        $pdf = \PDF::loadView('verification-result.print_pdf', $data);


        return $pdf->stream($export_name);
    }
}
