<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

use App\SubBidang;
class FetchSubBidang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-sub-bidang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Sub Bidang from GATRIK';

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

            $response = $client->post('Service/Ref/Sub-Bidang');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $bar = $this->output->createProgressBar($counted_result);
            SubBidang::truncate();
            foreach($decode->result as $res){
                SubBidang::create(
                    [
                        'uid_sub_bidang'=>$res->uid_sub_bidang, 
                        'kode_sub_bidang'=>$res->kode_sub_bidang, 
                        'nama_sub_bidang'=>$res->nama_sub_bidang,
                        'uid_bidang'=>$res->uid_bidang,
                        'uid_jenis_usaha'=>$res->uid_jenis_usaha,
                        'is_active'=>$res->is_active,
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
