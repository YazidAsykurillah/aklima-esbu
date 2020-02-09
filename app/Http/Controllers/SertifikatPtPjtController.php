<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\PersyaratanTeknis;
use App\PersyaratanTeknisPenanggungJawabTeknis;
use App\SertifikatPtPjt;
use App\Permohonan;
use App\LsbuWilayah;

class SertifikatPtPjtController extends Controller
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
        $ptpjt = PersyaratanTeknisPenanggungJawabTeknis::findOrFail($request->uid_ver_pt_pjt);
        //return $ptpjt;
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
                    'uid_verifikasi_pt' => $ptpjt->uid_verifikasi_pt,
                    'uid_permohonan' => $ptpjt->uid_permohonan,
                    'uid_ver_pt_pjt' => $ptpjt->uid_ver_pt_pjt,
                    'noreg_serkom' => $request->noreg_serkom,
                    'no_serkom' => $request->no_serkom,
                    'tgl_sertifikat' => Carbon::parse($request->tgl_sertifikat)->format('d-m-Y'),
                    'lembaga_penerbit' => $request->lembaga_penerbit,
                    'level' => $request->level,
                    'unit_kompetensi' => $request->unit_kompetensi,
                    'file_serkom' => base64_encode(file_get_contents($request->file_serkom)),
                    'bidang' => $request->bidang,
                    'jenis_pekerjaan' => $request->jenis_pekerjaan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/PJT/Sertifikat/Tambah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            if($decode->response == '1'){
                SertifikatPtPjt::where('uid_ver_pt_pjt', '=', $ptpjt->uid_ver_pt_pjt)->delete();
                foreach($decode->result as $res){
                    SertifikatPtPjt::create(
                        [
                            'id'=>$res->id,
                            'uid_verifikasi_pt'=>$res->uid_verifikasi_pt,
                            'uid_ver_pt_pjt'=>$res->uid_ver_pt_pjt,
                            'uid_permohonan'=>$res->uid_permohonan,
                            'noreg_serkom'=>$res->noreg_serkom,
                            'no_serkom'=>$res->no_serkom,
                            'tgl_sertifikat'=>Carbon::parse($res->tgl_sertifikat)->format('Y-m-d'),
                            'lembaga_penerbit'=>$res->lembaga_penerbit,
                            'level'=>$res->level,
                            'unit_kompetensi'=>$res->unit_kompetensi,
                            'file_serkom'=>$res->file_serkom,
                            'bidang'=>$res->bidang,
                            'jenis_pekerjaan'=>$res->jenis_pekerjaan,
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

        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $persyaratan_teknis = PersyaratanTeknis::findOrFail($request->uid_verifikasi_pt);
        
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
                    'uid_verifikasi_pt' => $persyaratan_teknis->uid_verifikasi_pt,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/PJT/Sertifikat/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            if($decode->response == '1'){
                SertifikatPtPjt::where('uid_verifikasi_pt', '=', $persyaratan_teknis->uid_verifikasi_pt)
                    ->where('uid_permohonan','=', $permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    SertifikatPtPjt::create(
                        [
                            'id'=>$res->id,
                            'uid_verifikasi_pt'=>$res->uid_verifikasi_pt,
                            'uid_ver_pt_pjt'=>$res->uid_ver_pt_pjt,
                            'uid_permohonan'=>$res->uid_permohonan,
                            'noreg_serkom'=>$res->noreg_serkom,
                            'no_serkom'=>$res->no_serkom,
                            'tgl_sertifikat'=>Carbon::parse($res->tgl_sertifikat)->format('Y-m-d'),
                            'lembaga_penerbit'=>$res->lembaga_penerbit,
                            'level'=>$res->level,
                            'unit_kompetensi'=>$res->unit_kompetensi,
                            'file_serkom'=>$res->file_serkom,
                            'bidang'=>$res->bidang,
                            'jenis_pekerjaan'=>$res->jenis_pekerjaan,
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
        $sertifikat_pjt = SertifikatPtPjt::findOrFail($request->id);
        $permohonan = Permohonan::findOrFail($sertifikat_pjt->uid_permohonan);
        $provinsi_uid = $permohonan->badan_usaha->kota->provinsi_uid;
        $x_lsbu_key_wilayah = LsbuWilayah::where('provinsi_uid', '=', $provinsi_uid)->get()->first()->api_keys;
        try{
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>$x_lsbu_key_wilayah,
                    'Token'=> getCurrentActiveToken()['token']
                ],
                'form_params' => [
                    'uid_ver_pt_pjt' => $sertifikat_pjt->uid_ver_pt_pjt,
                    'uid_verifikasi_pt' => $sertifikat_pjt->uid_verifikasi_pt,
                    'uid_permohonan' => $sertifikat_pjt->uid_permohonan,
                    'id' => $sertifikat_pjt->id,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/PJT/Sertifikat/Hapus');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            if($decode->response == '1'){
                $sertifikat_pjt->delete();
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
