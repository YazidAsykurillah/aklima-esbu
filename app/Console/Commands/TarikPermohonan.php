<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;

class TarikPermohonan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:tarik-permohonan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tarik permohonan belum diproses dari GATRIK';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        

        $this->info($this->description);
        $token = getCurrentActiveToken()['token'];

        $response['response']= NULL;
        $response['message']= NULL;
        $response['result']= NULL;

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
                ]
                
            ]);
            $response = $client->post('Service/Pendaftaran/Tarik');
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            //Truncate moodel model
            //Permohonan::truncate();
            \DB::table('permohonan')->where('is_processed', '=', FALSE)->orWhere('status','=', NULL)->delete();
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

            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
          
        }

        //$this->info($response['message']);
    }
}
