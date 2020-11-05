<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

use App\Asesor;
use App\User;
class FetchAsesor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-asesor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Asesor';

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

            $response = $client->post('Service/Ref/Asesor');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $bar = $this->output->createProgressBar($counted_result);
            Asesor::truncate();
            foreach($decode->result as $res){
               Asesor::create(
                    [
                        'uid_asesor'=>$res->uid_asesor,
                        'nik'=>$res->nik,
                        'nama_asesor'=>$res->nama_asesor,
                        'alamat'=>$res->alamat,
                        'email'=>$res->email,
                        'nomor_handphone'=>$res->nomor_handphone,
                        'is_active'=>$res->is_active,
                    ]
                );

                //Update or create user
                $user = User::updateOrCreate(
                    ['email'=>$res->email],
                    [

                        'name'=>$res->nama_asesor,
                        'username'=>$res->email,
                        'email'=>$res->email,
                        'password'=>bcrypt('12345678'),
                        'type'=>'internal',
                        'is_asesor'=>TRUE,
                        'uid_asesor'=>$res->uid_asesor
                    ]
                );
                \DB::table('role_user')->where('user_id', '=', $user->id)->delete();
                $role_user = [
                    ['role_id'=>3, 'user_id'=>$user->id],
                    ['role_id'=>4, 'user_id'=>$user->id],
                ];
                \DB::table('role_user')->insert($role_user);
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
