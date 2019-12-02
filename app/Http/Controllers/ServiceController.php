<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;

class ServiceController extends Controller
{
    protected $gatrik_api_mode;

    public function __construct()
    {
        $this->gatrik_api_mode = config('app.gatrik_api_mode');
    }

    public function renderTarikPendaftaranView(Request $request)
    {
    	return view('service.tarik_pendaftaran');
    }

    public function runTarikPendaftaran(Request $request)
    {
        if($this->gatrik_api_mode == 'disabled'){
            return $this->runTarikPendaftaranDummy();
        }
        
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
        $response = $client->post('/Service/Pendaftaran/Tarik');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            //Truncate moodel model
            //Permohonan::truncate();
            \DB::table('permohonan')->where('status', '=', '0')->orWhere('status','=', NULL)->delete();
            foreach($decode->result as $res){
                Permohonan::create(
                    [
                        'uid_permohonan'=>$res->uid_permohonan,
                        'jenis_usaha_uid'=>$res->jenis_usaha_uid,
                        'jenis_sertifikasi'=>$res->jenis_sertifikasi,
                        'perpanjangan_ke'=>$res->perpanjangan_ke,
                        'badan_usaha_uid'=>$res->badan_usaha_uid,
                        'status'=>'0'
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
    
    protected function runTarikPendaftaranDummy()
    {
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;   
        try {
            Permohonan::truncate();
            factory(Permohonan::class, 15)->create();
            $ajaxResponse['response'] = '1';
            $ajaxResponse['message'] = "Permohonan berhasil ditarik [d]";
            return $ajaxResponse;
        } catch (Exception $e) {
            return $e;
        }
        
    }
}
