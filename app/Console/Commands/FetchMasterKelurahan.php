<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Kelurahan;

class FetchMasterKelurahan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-master-kelurahan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch master kelurahan by calling GATRIK API';

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
        $token = getCurrentActiveToken()['token'];
        
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;


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
        $response = $client->post('/Service/Ref/Kelurahan');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $this->info('Loaded '. $counted_result);
            $this->info('');

            $this->info('Prepare to truncate Kelurahan Model');
            //Truncate moodel model
            Kelurahan::truncate();
            $this->info('Kelurahan model has been truncated');
            $this->info('');

            $this->info('Composing bulk data');
            
            $bar = $this->output->createProgressBar($counted_result);

            $bulk = [];
            foreach($decode->result as $res){
                /*$bulk[] = [
                    'kecamatan_uid'=>$res->kecamatan_uid,
                    'uid_kelurahan'=>$res->uid_kelurahan,
                    'nama'=>$res->nama,
                    'jenis'=>$res->jenis,

                ];*/
                \DB::table('kelurahan')->insert([
                    'kecamatan_uid'=>$res->kecamatan_uid,
                    'uid_kelurahan'=>$res->uid_kelurahan,
                    'nama'=>$res->nama,
                    'jenis'=>$res->jenis,

                ]);
                $bar->advance();
            }
            $bar->finish();

        }
        catch(GuzzleException $e){
            return $e;
        }

    }
}
