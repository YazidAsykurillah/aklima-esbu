<?php

namespace App\Listeners;

use App\Events\PersyaratanTeknisIsDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\PersyaratanTeknis;

class PullPersyaratanTeknisFromGatrik
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PersyaratanTeknisIsDeleted  $event
     * @return void
     */
    public function handle(PersyaratanTeknisIsDeleted $event)
    {
        $persyaratan_teknis = $event->persyaratan_teknis;
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
                    'uid_permohonan' => $persyaratan_teknis->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Teknis/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            if($decode->response == '1'){
                
                foreach($decode->result as $res){
                    PersyaratanTeknis::create(
                        [
                            'uid_permohonan'=>$res->uid_permohonan,
                            'uid_sub_bidang'=>$res->sub_bidang_uid,
                            'uid_verifikasi_pt'=>$res->uid_verifikasi_pt,
                        ]
                    );
                }
            }
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            return $contents;
            
        }
    }
}
