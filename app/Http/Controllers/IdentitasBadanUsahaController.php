<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreIdentitasBadanUsahaRequest;

use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\IdentitasBadanUsaha;

class IdentitasBadanUsahaController extends Controller
{
    protected $gatrik_api_mode;

    public function __construct()
    {
        $this->gatrik_api_mode = config('app.gatrik_api_mode');
    }

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
    public function store(StoreIdentitasBadanUsahaRequest $request)
    {
        if($this->gatrik_api_mode == 'disabled'){
            return $this->runStoreDummy($request);
        }
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);

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
            ],
            'form_params' => [
                'uid_permohonan' => $permohonan->uid_permohonan,
                'file_surat_permohonan_sbu'=>$request->file_surat_permohonan_sbu,
                'nomor_surat'=>$request->nomor_surat,
                'perihal'=>$request->perihal,
                'tanggal_surat'=>$request->tanggal_surat,
                'nama_penandatangan_surat'=>$request->nama_penandatangan_surat,
                'jabatan_penandatangan_surat'=>$request->jabatan_penandatangan_surat,
            ]
        ]);
        $response = $client->post('/Service/Permohonan/Identitas-Badan-Usaha/Tarik');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            
            foreach($decode->result as $res){
                IdentitasBadanUsaha::create(
                    [
                        'uid_verifikasi_ibu'=>$res->uid_verifikasi_ibu,
                        'permohonan_uid'=>$res->permohonan_uid,
                        'file_surat_permohonan_sbu'=>$res->file_surat_permohonan_sbu,
                        'nomor_surat'=>$res->nomor_surat,
                        'perihal'=>$res->perihal,
                        'tanggal_surat'=>$res->tanggal_surat,
                        'nama_penandatangan_surat'=>$res->nama_penandatangan_surat,
                        'jabatan_penandatangan_surat'=>$res->jabatan_penandatangan_surat,
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

    protected function runStoreDummy($request)
    {

        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
    
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;

        try {
            $max_uid_verifikasi_ibu = \DB::table('identitas_badan_usaha')->max('uid_verifikasi_ibu'); 
            $uid_verifikasi_ibu = $max_uid_verifikasi_ibu+1;
            $permohonan_uid  = $permohonan->uid_permohonan;
            $file_surat_permohonan_sbu = config('app.url');

            IdentitasBadanUsaha::where('permohonan_uid', '=', $permohonan_uid)->delete();
            IdentitasBadanUsaha::create(
                [
                    'uid_verifikasi_ibu'=>$uid_verifikasi_ibu,
                    'permohonan_uid'=>$permohonan_uid,
                    'file_surat_permohonan_sbu'=>$file_surat_permohonan_sbu,
                    'nomor_surat'=>$request->nomor_surat,
                    'perihal'=>$request->perihal,
                    'tanggal_surat'=>$request->tanggal_surat,
                    'nama_penandatangan_surat'=>$request->nama_penandatangan_surat,
                    'jabatan_penandatangan_surat'=>$request->jabatan_penandatangan_surat,
                ]
            );
            $ajaxResponse['response']= 1;
            $ajaxResponse['message']= "[DUMMY] Data Identitas Badan Usaha Berhasil Disimpan";
            $ajaxResponse['result']= NULL;
            return $ajaxResponse;
        } catch (Exception $e) {
            return $e;
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
}
