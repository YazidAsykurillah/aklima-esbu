<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreIdentitasBadanUsahaRequest;
use App\Http\Requests\UpdateIdentitasBadanUsahaRequest;

use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\LsbuWilayah;
use App\IdentitasBadanUsaha;

use Event;
use App\Events\IdentitasBadanUsahaIsUploaded;

class IdentitasBadanUsahaController_back20200214 extends Controller
{
    protected $link_file_surat_permohonan_sbu = "";

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
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $provinsi_uid = $permohonan->badan_usaha->kota->provinsi_uid;
        $x_lsbu_key_wilayah = LsbuWilayah::where('provinsi_uid', '=', $provinsi_uid)->get()->first()->api_keys;
        
        
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
                //'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                'X-Lsbu-Key'=>$x_lsbu_key_wilayah,
                'Token'=> $token
            ],
            'form_params' => [
                'uid_permohonan' => $permohonan->uid_permohonan,
                'file_surat_permohonan_sbu'=>base64_encode(file_get_contents($request->file_surat_permohonan_sbu)),
                'nomor_surat'=>$request->nomor_surat,
                'perihal'=>$request->perihal,
                'tanggal_surat'=>Carbon::parse($request->tanggal_surat)->format('d-m-Y'),
                'nama_penandatangan_surat'=>$request->nama_penandatangan_surat,
                'jabatan_penandatangan_surat'=>$request->jabatan_penandatangan_surat,
            ]
        ]);
        $response = $client->post('Service/Permohonan/Identitas-Badan-Usaha/Tambah');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            
            //Fire event IdentitasBadanUsahaIsUploaded
            Event::fire(new IdentitasBadanUsahaIsUploaded($permohonan));

            return $ajaxResponse;
        }
        catch(GuzzleException $e){
            return $e;
        }
    }

    
    protected function upload_file_surat_permohonan_sbu($file)
    {
        $path = 'files/surat-permohonan-sbu';
        $extension = $file->getClientOriginalExtension();
        $file_name = time().'.'.$extension;
        $file->move($path, $file_name);
        $this->link_file_surat_permohonan_sbu = config('app.url').'/'.$path.'/'.$file_name;
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
        $token = getCurrentActiveToken()['token'];
        
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
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Identitas-Badan-Usaha/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            
            if($decode->response == '1'){
                IdentitasBadanUsaha::where('permohonan_uid', '=',$permohonan->uid_permohonan)->delete();
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
                return redirect()->back()
                    ->with('successMessage', $decode->message);
            }
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            return redirect()->back()
                ->with('warningMessage', $decode->message);
            
        }
    }



    //Update Identitas Badan Usaha
    public function updateData(UpdateIdentitasBadanUsahaRequest $request)
    {
        //return $request->all();
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
                    'uid_verifikasi_ibu'=>$request->uid_verifikasi_ibu,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                    'file_surat_permohonan_sbu'=>$request->has('file_surat_permohonan_sbu_edit') ? base64_encode(file_get_contents($request->file_surat_permohonan_sbu_edit)) : NULL,
                    'nomor_surat'=>$request->nomor_surat_edit,
                    'perihal'=>$request->perihal_edit,
                    'tanggal_surat'=>Carbon::parse($request->tanggal_surat_edit)->format('d-m-Y'),
                    'nama_penandatangan_surat'=>$request->nama_penandatangan_surat_edit,
                    'jabatan_penandatangan_surat'=>$request->jabatan_penandatangan_surat_edit,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Identitas-Badan-Usaha/Ubah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            if($decode->response == '1'){
                //Fire event IdentitasBadanUsahaIsUploaded
                Event::fire(new IdentitasBadanUsahaIsUploaded($permohonan));
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
