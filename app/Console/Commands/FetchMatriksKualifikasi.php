<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

use App\MatriksKualifikasi;
class FetchMatriksKualifikasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-matriks-kualifikasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Matriks Kualifikasi';

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
        try{
            $token = getCurrentActiveToken()['token'];
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

            $response = $client->post('Service/Ref/Matriks-Kualifikasi');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $bar = $this->output->createProgressBar($counted_result);
            MatriksKualifikasi::truncate();
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

            $bar->finish();
            $this->info('');
            $this->info('Completed '.$this->description);
        }
        catch(GuzzleException $e){
            $this->info('ERROR');
        }
    }
}
