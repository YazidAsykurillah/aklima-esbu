<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

use App\BadanUsaha;
class FetchBadanUsaha extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrator:fetch-badan-usaha';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Badan Usaha';

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

            $response = $client->post('Service/Badan-Usaha/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            $counted_result = count($decode->result);
            $bar = $this->output->createProgressBar($counted_result);
            BadanUsaha::truncate();
            foreach($decode->result as $res){
                BadanUsaha::create(
                    [
                        'uid_badan_usaha'=>$res->uid_badan_usaha,
                        'bentuk_badan_usaha_uid'=>$res->bentuk_badan_usaha_uid,
                        'nama_badan_usaha'=>$res->nama_badan_usaha,
                        'alamat_badan_usaha'=>$res->alamat_badan_usaha,
                        'kelurahan_uid'=>$res->kelurahan_uid,
                        'kecamatan_uid'=>$res->kecamatan_uid,
                        'kota_uid'=>$res->kota_uid,
                        'no_telp_kantor'=>$res->no_telp_kantor,
                        'no_hp_kantor'=>$res->no_hp_kantor,
                        'no_fax'=>$res->no_fax,
                        'website'=>$res->website,
                        'nik_penanggung_jawab'=>$res->nik_penanggung_jawab,
                        'nama_penanggung_jawab'=>$res->nama_penanggung_jawab,
                        'jenis_kewarganegaraan'=>$res->jenis_kewarganegaraan,
                        'kewarganegaraan'=>$res->kewarganegaraan,
                        'passport'=>$res->passport,
                        'no_telepon_penanggung_jawab'=>$res->no_telepon_penanggung_jawab,
                        'email_perusahaan'=>$res->email_perusahaan,
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
