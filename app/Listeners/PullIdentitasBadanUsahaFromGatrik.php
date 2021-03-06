<?php

namespace App\Listeners;

use App\Events\IdentitasBadanUsahaIsUploaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\IdentitasBadanUsaha;

class PullIdentitasBadanUsahaFromGatrik
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
     * @param  IdentitasBadanUsahaIsUploaded  $event
     * @return void
     */
    public function handle(IdentitasBadanUsahaIsUploaded $event)
    {
        $permohonan = $event->permohonan;
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
            }
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            return $contents;
            
        }

    }
}
