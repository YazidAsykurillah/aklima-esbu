<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

use App\Kelurahan;

class FetchKelurahan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-kelurahan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Kelurahan';


    protected $token;

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

            $response = $client->post('Service/Ref/Kelurahan');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $bar = $this->output->createProgressBar($counted_result);
            Kelurahan::truncate();
            foreach($decode->result as $res){
                Kelurahan::create(
                    [
                        'uid_kelurahan'=>$res->uid_kelurahan,
                        'kecamatan_uid'=>$res->kecamatan_uid,
                        'nama'=>$res->nama,
                        'jenis'=>$res->jenis,
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
