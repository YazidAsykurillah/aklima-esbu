<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\DataPengurusDewanKomisaris;
use App\LsbuWilayah;

class DataPengurusDewanKomisarisController extends Controller
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
                    'uid_permohonan' => $permohonan->uid_permohonan,
                    'jenis_identitas' => $request->jenis_identitas,
                    'nama' => $request->nama,
                    'nomor_identitas' => $request->nomor_identitas,
                    'alamat' => $request->alamat,
                    'kewarganegaraan' => $request->kewarganegaraan,
                    'jabatan' => $request->jabatan,
                    'npwp' => $request->npwp,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Data-Pengurus/Dewan-Komisaris/Tambah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                DataPengurusDewanKomisaris::where('uid_permohonan', '=', $permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    DataPengurusDewanKomisaris::create([
                        'uid_dewan_pengurus'=>$res->uid_dewan_pengurus,
                        'uid_ver_dp_dewan_komisaris'=>$res->uid_verifikasi_dp,
                        'uid_permohonan'=>$res->uid_permohonan,
                        'nama'=>$res->nama,
                        'kewarganegaraan'=>$res->kewarganegaraan,
                        'alamat'=>$res->alamat,
                        'jabatan'=>$res->jabatan,
                        'npwp'=>$res->npwp,
                        'jenis_identitas'=>$res->jenis_identitas,
                        'nomor_ktp'=>$res->nomor_ktp,
                        'nomor_passpor'=>$res->nomor_paspor,
                    ]);
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
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Data-Pengurus/Dewan-Komisaris/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                DataPengurusDewanKomisaris::where('uid_permohonan', '=', $permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    DataPengurusDewanKomisaris::create([
                        'uid_dewan_pengurus'=>$res->uid_dewan_pengurus,
                        'uid_ver_dp_dewan_komisaris'=>$res->uid_verifikasi_dp,
                        'uid_permohonan'=>$res->uid_permohonan,
                        'nama'=>$res->nama,
                        'kewarganegaraan'=>$res->kewarganegaraan,
                        'alamat'=>$res->alamat,
                        'jabatan'=>$res->jabatan,
                        'npwp'=>$res->npwp,
                        'jenis_identitas'=>$res->jenis_identitas,
                        'nomor_ktp'=>$res->nomor_ktp,
                        'nomor_passpor'=>$res->nomor_paspor,
                    ]);
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
        $dp_dk = DataPengurusDewanKomisaris::findOrFail($request->id);

        $permohonan = $dp_dk->permohonan;

        $provinsi_uid = $permohonan->badan_usaha->kota->provinsi_uid;
        $x_lsbu_key_wilayah = LsbuWilayah::where('provinsi_uid', '=', $provinsi_uid)->get()->first()->api_keys;

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
                    'Token'=> getCurrentActiveToken()['token']
                ],
                'form_params' => [
                    'uid_permohonan' => $permohonan->uid_permohonan,
                    'uid_ver_dp_dewan_komisaris' => $dp_dk->uid_ver_dp_dewan_komisaris,
                    'uid_dewan_pengurus' => $dp_dk->uid_dewan_pengurus,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Data-Pengurus/Dewan-Komisaris/Hapus');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                $dp_dk->delete();
                
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
