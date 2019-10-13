<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\MatriksKualifikasi;

class MatriksKualifikasiController extends Controller
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
        $matriks_kualifikasi = MatriksKualifikasi::with(['jenis_usaha', 'bidang', 'sub_bidang'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'matriks_kualifikasi.*',
        ])->get();

        $data_matriks_kualifikasi = Datatables::of($matriks_kualifikasi)
            ->addColumn('nama_jenis_usaha', function($matriks_kualifikasi){
                return $matriks_kualifikasi->jenis_usaha->nama_jenis_usaha;
            })
            ->addColumn('nama_bidang', function($matriks_kualifikasi){
                return $matriks_kualifikasi->bidang->nama_bidang;
            })
            ->addColumn('nama_sub_bidang', function($matriks_kualifikasi){
                return $matriks_kualifikasi->sub_bidang->nama_sub_bidang;
            })
            ;

        if ($keyword = $request->get('search')['value']) {
            $data_matriks_kualifikasi->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $data_matriks_kualifikasi->make(true);
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

        try{
            $response = $client->post('/Service/Ref/Matriks-Kualifikasi');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            //Empty table matriks_kualifikasi
            \DB::table('matriks_kualifikasi')->delete();
            foreach($decode->result as $res){
                MatriksKualifikasi::create(
                    [
                        'uid_matriks_kualifikasi'=>$res->uid_matriks_kualifikasi, 
                        'jenis_usaha_uid'=>$res->jenis_usaha_uid, 
                        'bidang_uid'=>$res->bidang_uid,
                        'sub_bidang_uid'=>$res->sub_bidang_uid,
                        'kualifikasi'=>$res->kualifikasi,
                        'modal_disetor_min'=>$res->modal_disetor_min,
                        'modal_disetor_maks'=>$res->modal_disetor_maks,
                        'pjt_jumlah'=>$res->pjt_jumlah,
                        'pjt_level'=>$res->pjt_level,
                        'tt_jumlah'=>$res->tt_jumlah,
                        'tt_level'=>$res->tt_level,
                        'batas_nilai_1_pekerjaan'=>$res->batas_nilai_1_pekerjaan,
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
