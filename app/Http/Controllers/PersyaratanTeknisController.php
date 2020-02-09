<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\SubBidang;
use App\LsbuWilayah;
use App\PersyaratanTeknis;

use Event;
use App\Events\PersyaratanTeknisIsDeleted;

class PersyaratanTeknisController extends Controller
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
        $sub_bidang = SubBidang::findOrFail($request->uid_sub_bidang);

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
                    'uid_permohonan' => $permohonan->uid_permohonan,
                    'uid_sub_bidang' => $sub_bidang->uid_sub_bidang,
                    'spesialisasi' => 'spesialisasi',
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/Tambah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            if($decode->response == '1'){
                /*echo '<pre>';
                print_r($decode);
                echo '</pre>';*/
                return $this->pullFromGatrik($permohonan->uid_permohonan);

            }
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            return redirect()->back()
                ->with('errorMessage', $decode->message);
            
        }
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


    public function pullFromGatrik($uid_permohonan = NULL)
    {
        $permohonan = Permohonan::findOrFail($uid_permohonan);
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
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            if($decode->response == '1'){
                PersyaratanTeknis::where('uid_permohonan','=', $permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    PersyaratanTeknis::create(
                        [
                            'uid_permohonan'=>$res->uid_permohonan,
                            'uid_sub_bidang'=>$res->sub_bidang_uid,
                            'uid_verifikasi_pt'=>$res->uid_verifikasi_pt,
                        ]
                    );
                }
                return redirect()->back()
                    ->with('successMessage', $decode->message);
            }
            
        }
        catch(GuzzleException $e){

            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            return redirect()->back()
                    ->with('errorMessage', $decode->message);
            
        }
    }


    public function delete(Request $request)
    {
        $persyaratanTeknis = PersyaratanTeknis::findOrFail($request->uid_verifikasi_pt_to_delete);
        
        $provinsi_uid = $persyaratanTeknis->permohonan->badan_usaha->kota->provinsi_uid;
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
                    'uid_verifikasi_pt' => $persyaratanTeknis->uid_verifikasi_pt,
                    'uid_permohonan' => $persyaratanTeknis->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/Hapus');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            if($decode->response == '1'){
                PersyaratanTeknis::where('uid_permohonan','=', $persyaratanTeknis->uid_permohonan)->delete();
                Event::fire(new PersyaratanTeknisIsDeleted($persyaratanTeknis));
                return redirect()->back()
                        ->with('successMessage', $decode->message);
            }
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            return $contents;
            
        }

    }

    public function selectSubBidang(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = SubBidang::where('nama_sub_bidang', 'LIKE', "%$search%")
                    ->where('uid_jenis_usaha', '=', $request->jenis_usaha_uid)
                    ->get();
        }
        else{
            $data = SubBidang::where('uid_jenis_usaha', '=', $request->jenis_usaha_uid)
                    ->get();
        }
        return response()->json($data);
    }
}
