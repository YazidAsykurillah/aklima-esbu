<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\ServiceIntegrator;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:generate-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genereate token from GATRIK';

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
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('app.gatrik_base_uri'),
            'verify'=>false,
            'headers'=>[
                'Content-Type'=>'multipart/form-data',
                'Enctype'=>'multipart/form-data',
                'X-Lsbu-Key'=>config('app.x_lsbu_key')
            ]
            
        ]);
        
        try{
            $response = $client->post('Service/Auth/Generate-Token');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();

            $data = json_decode($contents);
            $message = $data->message;
            $token = $data->token;
            $expired = $data->expired;
            $this->info('Truncate service integrator');
            ServiceIntegrator::truncate();
            $this->info('Service integrator is deleted');
            //create service integrator
            $serviceIntegrator = ServiceIntegrator::create(
                ['token' => $token, 'expired' => $expired ,'is_active'=>TRUE]
            );
            $this->info($message);

        }
        catch(GuzzleException $e){
            dd($e);
        }
    }
}
