<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

use App\Kota;
class FetchKota extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-kota';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Kota';

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

            $response = $client->post('Service/Ref/Kota');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $bar = $this->output->createProgressBar($counted_result);
            Kota::truncate();
            foreach($decode->result as $res){
                Kota::create(
                    [
                        'provinsi_uid'=>$res->provinsi_uid,
                        'uid_kota'=>$res->uid_kota,
                        'kode_kota'=>$res->kode_kota,
                        'nama_kota'=>$res->nama_kota,
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
