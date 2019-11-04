<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePersyaratanAdministratifRequest;

use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\PersyaratanAdministratif;

class PersyaratanAdministratifController extends Controller
{
    protected $gatrik_api_mode;

    public function __construct()
    {
        $this->gatrik_api_mode = config('app.gatrik_api_mode');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersyaratanAdministratifRequest $request)
    {
        if($this->gatrik_api_mode == 'disabled'){
            return $this->runStoreDummy($request);
        }
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);

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
            ],
            'form_params' => [
                'uid_permohonan' => $permohonan->uid_permohonan,
            ]
        ]);
        $response = $client->post('/Service/Permohonan/Persyaratan-Administratif/Tambah');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            
            foreach($decode->result as $res){
                PersyaratanAdministratif::create(
                    [
                        'uid_permohonan'=>$res->uid_permohonan,
                        
                    ]
                );
            }

            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            return $ajaxResponse;
        }
        catch(GuzzleException $e){
            return $e;
        }
    }

    protected function runStoreDummy($request)
    {

        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
    
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;

        try {
            $max_uid_verifikasi_pa = PersyaratanAdministratif::max('uid_verifikasi_pa');
            $uid_verifikasi_pa = $max_uid_verifikasi_pa+1;
            $uid_permohonan  = $permohonan->uid_permohonan;

            PersyaratanAdministratif::where('uid_permohonan', '=', $uid_permohonan)->delete();
            PersyaratanAdministratif::create(
                [
                    'uid_verifikasi_pa'=>$uid_verifikasi_pa,
                    'uid_permohonan'=>$uid_permohonan,
                    'file_akta_pendirian_bu'=>config('app.url'),
                    'nama_notaris'=>$request->nama_notaris,
                    'judul_akta'=>$request->judul_akta,
                    'tanggal_akta'=>$request->tanggal_akta,
                    'nomor_akta'=>$request->nomor_akta,
                    'maksud_tujuan_akta'=>$request->maksud_tujuan_akta,
                    'file_pengesahan_sebagai_badan_hukum'=>config('app.url'),
                    'nomor_badan_hukum'=>$request->nomor_badan_hukum,
                    'tentang_badan_hukum'=>$request->tentang_badan_hukum,
                    'tanggal_badan_hukum'=>$request->tanggal_badan_hukum,
                    'file_npwp'=>config('app.url'),
                    'nomor_npwp'=>$request->nomor_npwp,
                    'file_skdu'=>config('app.url'),
                    'instansi_penerbit_skdu'=>$request->instansi_penerbit_skdu,
                    'nomor_skdu'=>$request->nomor_skdu,
                    'tanggal_skdu'=>$request->tanggal_skdu,
                    'masa_berlaku_skdu'=>$request->masa_berlaku_skdu,
                    'file_pjbu'=>config('app.url'),
                    'nama_pjbu'=>$request->nama_pjbu,
                    'jenis_identitas_pjbu'=>$request->jenis_identitas_pjbu,
                    'nomor_ktp_pjbu'=>$request->nomor_ktp_pjbu,
                    'nomor_paspor_pjbu'=>$request->nomor_paspor_pjbu,
                    'file_laporan_keuangan'=>config('app.url'),
                    'kekayaan_bersih'=>9999999,
                    'modal_disetor'=>9999999,
                    'nama_kantor_akuntan_publik'=>$request->nama_kantor_akuntan_publik,
                    'alamat_kantor_akuntan_pulik'=>$request->alamat_kantor_akuntan_pulik,
                    'nomor_telepon_kantor_akuntan_publik'=>$request->nomor_telepon_kantor_akuntan_publik,
                    'nama_akuntan'=>$request->nama_akuntan,
                    'nomor_laporan_keuangan'=>$request->nomor_laporan_keuangan,
                    'tanggal_laporan_keuangan'=>$request->tanggal_laporan_keuangan,
                    'pendapat_akuntan'=>$request->pendapat_akuntan,
                    'file_struktur_organisasi_badan_usaha'=>config('app.url'),
                    'file_profile_badan_usaha'=>config('app.url'),
                    'file_ppm'=>config('app.url'),
                    'nomor_ppm'=>$request->nomor_ppm,
                    'tanggal_ppm'=>$request->tanggal_ppm,
                    'prosentase_saham_pma_ppm'=>$request->prosentase_saham_pma_ppm,
                    'file_ppm_perubahan'=>config('app.url'),
                    'nomor_ppm_perubahan'=>$request->nomor_ppm_perubahan,
                    'tanggal_ppm_perubahan'=>$request->tanggal_ppm_perubahan,
                    'prosentase_saham_pma_ppm_perubahan'=>$request->prosentase_saham_pma_ppm_perubahan,
                ]
            );
            $ajaxResponse['response']= 1;
            $ajaxResponse['message']= "[DUMMY] Data Persyaratan Administratif Berhasil Disimpan";
            $ajaxResponse['result']= NULL;
            return $ajaxResponse;
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
