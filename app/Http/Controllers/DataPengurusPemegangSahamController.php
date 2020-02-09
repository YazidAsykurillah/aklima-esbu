<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\DataPengurusPemegangSaham;
use App\LsbuWilayah;

class DataPengurusPemegangSahamController extends Controller
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
                    'negara' => $request->negara,
                    'prosentase_kepemilikan_saham' => $request->prosentase_kepemilikan_saham,
                    'nominal_kepemilikan_saham' => $request->nominal_kepemilikan_saham,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Data-Pengurus/Dewan-Pemegang-Saham/Tambah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                DataPengurusPemegangSaham::where('uid_permohonan', '=', $permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    DataPengurusPemegangSaham::create([
                        'uid_pemegang_saham'=>$res->uid_pemegang_saham,
                        'uid_verifikasi_dp'=>$res->uid_verifikasi_dp,
                        'uid_permohonan'=>$res->uid_permohonan,
                        'nama'=>$res->nama,
                        'negara'=>$res->negara,
                        'prosentase_kepemilikan_saham'=>preg_replace('#[^0-9.]#', '', $res->prosentase_kepemilikan_saham),
                        'nominal_kepemilikan_saham'=>preg_replace('#[^0-9.]#', '', $res->nominal_kepemilikan_saham),
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

    public function delete(Request $request)
    {
        $dp_ps = DataPengurusPemegangSaham::findOrFail($request->id);

        $permohonan = $dp_ps->permohonan;


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
                    'uid_pemegang_saham' => $dp_ps->uid_pemegang_saham,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Data-Pengurus/Dewan-Pemegang-Saham/Hapus');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                $dp_ps->delete();
                
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
            $response = $client->post('Service/Permohonan/Data-Pengurus/Dewan-Pemegang-Saham/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
               DataPengurusPemegangSaham::where('uid_permohonan', '=', $permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    DataPengurusPemegangSaham::create([
                        'uid_pemegang_saham'=>$res->uid_pemegang_saham,
                        'uid_verifikasi_dp'=>$res->uid_verifikasi_dp,
                        'uid_permohonan'=>$res->uid_permohonan,
                        'nama'=>$res->nama,
                        'negara'=>$res->negara,
                        'prosentase_kepemilikan_saham'=>floatval(preg_replace('#[^0-9.]#', '', $res->prosentase_kepemilikan_saham)),
                        'nominal_kepemilikan_saham'=>floatval(preg_replace('#[^0-9.]#', '', $res->nominal_kepemilikan_saham)),
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
}
