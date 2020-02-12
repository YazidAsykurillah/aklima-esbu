<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\LsbuWilayah;
use App\PersyaratanAdministratif;
use App\AktaPerubahanBuPa;

class AktaPerubahanBuPaController extends Controller
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
        $persyaratan_administratif = PersyaratanAdministratif::findOrFail($request->uid_verifikasi_pa);
        //return $persyaratan_administratif;

        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;
        
        try{
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> getCurrentActiveToken()['token']
                ],
                'form_params' => [
                    'uid_verifikasi_pa' => $persyaratan_administratif->uid_verifikasi_pa,
                    'uid_permohonan' => $persyaratan_administratif->permohonan->uid_permohonan,
                    'file_akta_pendirian_bu' => base64_encode(file_get_contents($request->file_akta_pendirian_bu)),
                    'nama_notaris' => $request->nama_notaris,
                    'judul_akta' => $request->judul_akta,
                    'tanggal_akta' => $request->tanggal_akta,
                    'nomor_akta' => $request->nomor_akta,
                    'hal_yang_diubah' => $request->hal_yang_diubah,
                    'file_akta_perubahan_bu' => base64_encode(file_get_contents($request->file_akta_perubahan_bu))
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Administratif/Akta-Perubahan-Badan-Usaja/Tambah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                
            }
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
        }
        return $ajaxResponse;
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

    public function pullFromGatrik(Request $request)
    {
        $persyaratan_administratif = PersyaratanAdministratif::findOrFail($request->uid_verifikasi_pa);
        //return $persyaratan_administratif;

        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;
        
        try{
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> getCurrentActiveToken()['token']
                ],
                'form_params' => [
                    'uid_verifikasi_pa' => $persyaratan_administratif->uid_verifikasi_pa,
                    'uid_permohonan' => $persyaratan_administratif->permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Administratif/Akta-Perubahan-Badan-Usaja/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                
            }
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
        }
        return $ajaxResponse;
    }
}
