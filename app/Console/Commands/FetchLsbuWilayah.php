<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

use App\LsbuWilayah;
class FetchLsbuWilayah extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-lsbu-wilayah';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Lsbu Wilayah';

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

            $response = $client->post('Service/Ref/LSBU-Wilayah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $bar = $this->output->createProgressBar($counted_result);
            LsbuWilayah::truncate();
            foreach($decode->result as $res){
                if($res->nama_lsbu_short != NULL){
                    LsbuWilayah::create(
                        [
                            'uid_lsbu'=>$res->uid_lsbu,
                            'kode_lsbu'=>$res->kode_lsbu,
                            'nama_lsbu'=>$res->nama_lsbu,
                            'nama_lsbu_short'=>$res->nama_lsbu_short,
                            'kategori_lsbu'=>$res->kategori_lsbu,
                            'jenis_lsbu'=>$res->jenis_lsbu,
                            'alamat'=>$res->alamat,
                            'provinsi_uid'=>$res->provinsi_uid,
                            'parent_lsbu_uid'=>$res->parent_lsbu_uid,
                            'api_keys'=>$res->api_keys,
                            'is_active'=>$res->is_active,
                            
                        ]
                    );
                    $bar->advance();    
                }
                
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
