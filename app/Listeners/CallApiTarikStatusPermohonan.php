<?php

namespace App\Listeners;

use App\Events\PermohonanIsDisplayed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\StatusDjk;

class CallApiTarikStatusPermohonan
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
     * @param  PermohonanIsDisplayed  $event
     * @return void
     */
    public function handle(PermohonanIsDisplayed $event)
    {
        $permohonan = $event->permohonan;
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
            $response = $client->post('Service/Tarik-Status-Permohonan');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            
            if($decode->response == '1'){
                StatusDjk::updateOrCreate(
                    ['uid_permohonan'=>$permohonan->uid_permohonan],
                    [
                        'uid_permohonan'=>$decode->uid_permohonan,
                        'status'=>$decode->status,
                        'keterangan_status'=>$decode->keterangan_status,
                        'tahap'=>$decode->tahap,
                        'keterangan_tahap'=>$decode->keterangan_tahap,
                        'updated_at'=>Carbon::now()
                    ]
                );
            }
            //return $decode;
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            return $contents;
            
        }
    }

}
