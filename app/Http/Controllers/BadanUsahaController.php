<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\BadanUsaha;

class BadanUsahaController extends Controller
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

    //return datatables object
    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $badan_usaha = BadanUsaha::with(['bentuk_badan_usaha', 'kelurahan', 'kecamatan', 'kota'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'badan_usaha.*'
        ]);

        return Datatables::eloquent($badan_usaha)
            ->addColumn('nama_bentuk_badan_usaha', function($badan_usaha){
                return $badan_usaha->bentuk_badan_usaha->nama_bentuk_badan_usaha;
            })
            ->addColumn('nama_kecamatan', function($badan_usaha){
                return $badan_usaha->kecamatan->nama;
            })
            ->addColumn('nama_kelurahan', function($badan_usaha){
                return $badan_usaha->kelurahan->nama;
            })
            ->make(true);
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
        //
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

    public function synchronize(Request $request)
    {
        $token = getCurrentActiveToken()['token'];
        
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;


        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('app.gatrik_base_uri'),
            'verify'=>false,
            'headers'=>[
                'Content-Type'=>'multipart/form-data',
                'Enctype'=>'multipart/form-data',
                'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                'Token'=> $token
            ]
            
        ]);
        $response = $client->post('/Service/Badan-Usaha/Tarik');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            //Truncate moodel model
            BadanUsaha::truncate();
            foreach($decode->result as $res){
                BadanUsaha::create(
                    [
                        'uid_badan_usaha'=>$res->uid_badan_usaha,
                        'bentuk_badan_usaha_uid'=>$res->bentuk_badan_usaha_uid,
                        'nama_badan_usaha'=>$res->nama_badan_usaha,
                        'alamat_badan_usaha'=>$res->alamat_badan_usaha,
                        'kelurahan_uid'=>$res->kelurahan_uid,
                        'kecamatan_uid'=>$res->kecamatan_uid,
                        'kota_uid'=>$res->kota_uid,
                        'no_telp_kantor'=>$res->no_telp_kantor,
                        'no_hp_kantor'=>$res->no_hp_kantor,
                        'no_fax'=>$res->no_fax,
                        'website'=>$res->website,
                        'nik_penanggung_jawab'=>$res->nik_penanggung_jawab,
                        'nama_penanggung_jawab'=>$res->nama_penanggung_jawab,
                        'jenis_kewarganegaraan'=>$res->jenis_kewarganegaraan,
                        'kewarganegaraan'=>$res->kewarganegaraan,
                        'passport'=>$res->passport,
                        'no_telepon_penanggung_jawab'=>$res->no_telepon_penanggung_jawab,
                        'email_perusahaan'=>$res->email_perusahaan,
                    ]
                );
            }

            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            return $ajaxResponse;
        }
        catch(GuzzleException $e){
            return $e;
        }
    }


}
