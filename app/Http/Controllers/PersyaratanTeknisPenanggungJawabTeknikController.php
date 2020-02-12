<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StorePersyaratanTeknisPenanggungJawabTeknikRequest;

use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\LsbuWilayah;
use App\Permohonan;
use App\PersyaratanTeknis;
use App\PersyaratanTeknisPenanggungJawabTeknis;
use App\SertifikatPtPjt;

class PersyaratanTeknisPenanggungJawabTeknikController extends Controller
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
    public function store(StorePersyaratanTeknisPenanggungJawabTeknikRequest $request)
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
                    'file_pernyataan_pjt' => base64_encode(file_get_contents($request->file_pernyataan_pjt)),
                    'file_surat_penunjukan_pjt' => base64_encode(file_get_contents($request->file_surat_penunjukan_pjt)),
                    'file_daftar_riwayat_hidup' => base64_encode(file_get_contents($request->file_daftar_riwayat_hidup)),
                    'kewarganegaraan' => $request->kewarganegaraan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/PJT/Tambah');
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
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/PJT/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                PersyaratanTeknisPenanggungJawabTeknis::where('uid_verifikasi_pt','=', $persyaratan_teknis->uid_verifikasi_pt)->where('uid_permohonan', '=', $permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    PersyaratanTeknisPenanggungJawabTeknis::updateOrCreate(
                        [
                            'uid_ver_pt_pjt'=>$res->uid_ver_pt_pjt,
                            'uid_verifikasi_pt'=>$res->uid_verifikasi_pt,
                            'uid_permohonan'=>$res->uid_permohonan,
                        ],
                        [
                            'uid_ver_pt_pjt'=>$res->uid_ver_pt_pjt,
                            'uid_verifikasi_pt'=>$res->uid_verifikasi_pt,
                            'uid_permohonan'=>$res->uid_permohonan,
                            'nama'=>$res->nama,
                            'jenis_identitas'=>$res->jenis_identitas,
                            'nomor_ktp'=>$res->nomor_ktp,
                            'nomor_passpor'=>$res->nomor_paspor,
                            'nomor_hp'=>$res->nomor_hp,
                            'kewarganegaraan'=>$res->kewarganegaraan,
                            'file_kartu_identitas'=>$res->file_kartu_identitas,
                            'file_pernyataan_pjt'=>$res->file_surat_pernyataan_pjt,
                            'file_surat_penunjukan_pjt'=>$res->file_surat_penunjukan_pjt,
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
        // return $request->all();
        $persyaratan_teknis_penanggung_jawab_teknis = PersyaratanTeknisPenanggungJawabTeknis::findOrFail($request->uid_ver_pt_pjt);
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
                    'uid_ver_pt_pjt' => $persyaratan_teknis_penanggung_jawab_teknis->uid_ver_pt_pjt,
                    'uid_verifikasi_pt' => $persyaratan_teknis->uid_verifikasi_pt,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/PJT/Hapus');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                $persyaratan_teknis_penanggung_jawab_teknis->delete();
                //Delete also sertifikat PJT related PJT
                SertifikatPtPjt::where('uid_permohonan','=', $permohonan->uid_permohonan)
                        ->where('uid_verifikasi_pt', '=', $persyaratan_teknis->uid_verifikasi_pt)
                        ->where('uid_ver_pt_pjt', '=', $persyaratan_teknis_penanggung_jawab_teknis->uid_ver_pt_pjt)
                        ->delete();
                return redirect()->back()
                    ->with('successMessage', $decode->message);
            }
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            var_dump($contents);

        }
    }
}
