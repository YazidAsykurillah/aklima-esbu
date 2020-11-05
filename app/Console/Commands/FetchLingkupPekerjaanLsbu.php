<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

use App\LingkupPekerjaanLSBU;
class FetchLingkupPekerjaanLSBU extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-lingkup-pekerjaan-lsbu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Lingkup Pekerjaan LSBU';

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

            $response = $client->post('Service/Ref/Lingkup-Pekerjaan-LSBU');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $bar = $this->output->createProgressBar($counted_result);
            LingkupPekerjaanLSBU::truncate();
            foreach($decode->result as $res){
                LingkupPekerjaanLSBU::create(
                    [
                        'uid_lsbu_lingkup_pekerjaan'=>$res->uid_lsbu_lingkup_pekerjaan,
                        'uid_lsbu'=>$res->uid_lsbu,
                        'uid_jenis_usaha'=>$res->uid_jenis_usaha,
                        'uid_bidang'=>$res->uid_bidang,
                        'uid_sub_bidang'=>$res->uid_sub_bidang,
                        
                    ]
                );
                $bar->advance();
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
