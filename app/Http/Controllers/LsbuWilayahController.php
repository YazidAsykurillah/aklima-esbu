<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\LsbuWilayah;

class LsbuWilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master-data.lsbu-wilayah');
    }

    //return datatables object
    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $lsbu_wilayah = LsbuWilayah::with(['provinsi'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'lsbu_wilayah.*'
        ]);

        return Datatables::eloquent($lsbu_wilayah)
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
        $response = $client->post('Service/Ref/LSBU-Wilayah');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            //Truncate moodel model
            LsbuWilayah::truncate();
            foreach($decode->result as $res){
                LsbuWilayah::create(
                    [
                        'uid_lsbu'=>$res->uid_lsbu,
                        'kode_lsbu'=>$res->kode_lsbu,
                        'nama_lsbu'=>$res->nama_lsbu,
                        'nama_lsbu_short'=>$res->nama_lsbu_short,
                        'kategori_lsbu'=>$res->kategori_lsbu,
                        'jenis_lsbu'=>$res->jenis_lsbu,
                        'alamat'=>$res->alamat,
                        'provinsi_uid'=>$res->provinsi_uid,
                        'parent_lsbu_uid'=>$res->parent_lsbu_uid,
                        'api_keys'=>$res->api_keys,
                        'is_active'=>$res->is_active,
                        
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
