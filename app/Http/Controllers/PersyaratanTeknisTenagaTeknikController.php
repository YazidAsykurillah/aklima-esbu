<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\LsbuWilayah;
use App\Permohonan;
use App\PersyaratanTeknis;
use App\PersyaratanTeknisTenagaTeknik;
use App\SertifikatPtTt;

class PersyaratanTeknisTenagaTeknikController extends Controller
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
        $persyaratan_teknis = PersyaratanTeknis::findOrFail($request->uid_verifikasi_pt);
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $provinsi_uid = $permohonan->badan_usaha->kota->provinsi_uid;
        $x_lsbu_key_wilayah = LsbuWilayah::where('provinsi_uid', '=', $provinsi_uid)->get()->first()->api_keys;
        $token = getCurrentActiveToken()['token'];

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
                    'X-Lsbu-Key'=>$x_lsbu_key_wilayah,
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_verifikasi_pt' => $persyaratan_teknis->uid_verifikasi_pt,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                    'nama' => $request->nama,
                    'jenis_identitas' => $request->jenis_identitas,
                    'nomor_identitas' => $request->nomor_identitas,
                    'nomor_hp' => $request->nomor_hp,
                    'file_kartu_identitas' =>base64_encode(file_get_contents($request->file_kartu_identitas)),
                    'file_pernyataan_tt' => base64_encode(file_get_contents($request->file_pernyataan_tt)),
                    'file_surat_penunjukan_tt' => base64_encode(file_get_contents($request->file_surat_penunjukan_tt)),
                    'file_daftar_riwayat_hidup' => base64_encode(file_get_contents($request->file_daftar_riwayat_hidup)),
                    'kewarganegaraan' => $request->kewarganegaraan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/TT/Tambah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                
                return $this->pullFromGatrik($request);
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
        $persyaratan_teknis = PersyaratanTeknis::findOrFail($request->uid_verifikasi_pt);
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $token = getCurrentActiveToken()['token'];

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
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_verifikasi_pt' => $persyaratan_teknis->uid_verifikasi_pt,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/TT/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                foreach($decode->result as $res){
                    PersyaratanTeknisTenagaTeknik::updateOrCreate(
                        [
                            'uid_ver_pt_tt'=>$res->uid_ver_pt_tt,
                            'uid_verifikasi_pt'=>$res->uid_verifikasi_pt,
                            'uid_permohonan'=>$res->uid_permohonan,
                        ],
                        [
                            'uid_ver_pt_tt'=>$res->uid_ver_pt_tt,
                            'uid_verifikasi_pt'=>$res->uid_verifikasi_pt,
                            'uid_permohonan'=>$res->uid_permohonan,
                            'nama'=>$res->nama,
                            'jenis_identitas'=>$res->jenis_identitas,
                            'nomor_ktp'=>$res->nomor_ktp,
                            'nomor_passpor'=>$res->nomor_paspor,
                            'nomor_hp'=>$res->nomor_hp,
                            'file_kartu_identitas'=>$res->file_kartu_identitas,
                            'file_pernyataan_tt'=>$res->file_surat_pernyataan_tt,
                            'file_surat_penunjukan_tt'=>$res->file_surat_penunjukan_tt,
                            'file_daftar_riwayat_hidup'=>$res->file_daftar_riwayat_hidup,
                        ]
                    );
                }
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


    public function delete(Request $request)
    {
        $persyaratan_teknis_tenaga_teknik = PersyaratanTeknisTenagaTeknik::findOrFail($request->uid_ver_pt_tt);
        $persyaratan_teknis = PersyaratanTeknis::findOrFail($request->uid_verifikasi_pt);
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $provinsi_uid = $permohonan->badan_usaha->kota->provinsi_uid;
        $x_lsbu_key_wilayah = LsbuWilayah::where('provinsi_uid', '=', $provinsi_uid)->get()->first()->api_keys;

        $token = getCurrentActiveToken()['token'];
        
        try{
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>$x_lsbu_key_wilayah,
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_ver_pt_tt' => $persyaratan_teknis_tenaga_teknik->uid_ver_pt_tt,
                    'uid_verifikasi_pt' => $persyaratan_teknis->uid_verifikasi_pt,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/TT/Hapus');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                $persyaratan_teknis_tenaga_teknik->delete();
                //Delete also related sertifikat TT 
                SertifikatPtTt::where('uid_permohonan','=', $permohonan->uid_permohonan)
                        ->where('uid_verifikasi_pt', '=', $persyaratan_teknis->uid_verifikasi_pt)
                        ->where('uid_ver_pt_tt', '=', $persyaratan_teknis_tenaga_teknik->uid_ver_pt_tt)
                        ->delete();
            }
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            
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
