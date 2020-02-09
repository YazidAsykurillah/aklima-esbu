<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePersyaratanAdministratifRequest;
use App\Http\Requests\UpdatePersyaratanAdministratifRequest;

use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\LsbuWilayah;
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
        
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $provinsi_uid = $permohonan->badan_usaha->kota->provinsi_uid;
        $x_lsbu_key_wilayah = LsbuWilayah::where('provinsi_uid', '=', $provinsi_uid)->get()->first()->api_keys;

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
                'X-Lsbu-Key'=>$x_lsbu_key_wilayah,
                'Token'=> $token
            ],
            'form_params' => [
                'uid_permohonan' => $permohonan->uid_permohonan,
                'file_akta_pendirian_bu'=>base64_encode(file_get_contents($request->file_akta_pendirian_bu)),
                'nama_notaris'=>$request->nama_notaris,
                'judul_akta'=>$request->judul_akta,
                'tanggal_akta'=>Carbon::parse($request->tanggal_akta)->format('d-m-Y'),
                'nomor_akta'=>$request->nomor_akta,
                'maksud_tujuan_akta'=>$request->maksud_tujuan_akta,
                'file_pengesahan_sebagai_badan_hukum'=>base64_encode(file_get_contents($request->file_pengesahan_sebagai_badan_hukum)),
                'nomor_badan_hukum'=>$request->nomor_badan_hukum,
                'tentang_badan_hukum'=>$request->tentang_badan_hukum,
                'tanggal_badan_hukum'=>Carbon::parse($request->tanggal_badan_hukum)->format('d-m-Y'),
                'file_npwp'=>base64_encode(file_get_contents($request->file_npwp)),
                'nomor_npwp'=>$request->nomor_npwp,
                'file_skdu'=>base64_encode(file_get_contents($request->file_skdu)),
                'instansi_penerbit_skdu'=>$request->instansi_penerbit_skdu,
                'nomor_skdu'=>$request->nomor_skdu,
                'tanggal_skdu'=>Carbon::parse($request->tanggal_skdu)->format('d-m-Y'),
                'masa_berlaku_skdu'=>Carbon::parse($request->masa_berlaku_skdu)->format('d-m-Y'),
                'file_pjbu'=>base64_encode(file_get_contents($request->file_pjbu)),
                'nama_pjbu'=>$request->nama_pjbu,
                'jenis_identitas_pjbu'=>$request->jenis_identitas_pjbu,
                'nomor_ktp_pjbu'=>$request->nomor_ktp_pjbu,
                'nomor_paspor_pjbu'=>$request->nomor_paspor_pjbu,
                'file_laporan_keuangan'=>base64_encode(file_get_contents($request->file_laporan_keuangan)),
                'kekayaan_bersih'=>$request->kekayaan_bersih,
                'modal_disetor'=>$request->modal_disetor,
                'nama_kantor_akuntan_publik'=>$request->nama_kantor_akuntan_publik,
                'alamat_kantor_akuntan_pulik'=>$request->alamat_kantor_akuntan_pulik,
                'nomor_telepon_kantor_akuntan_publik'=>$request->nomor_telepon_kantor_akuntan_publik,
                'nama_akuntan'=>$request->nama_akuntan,
                'nomor_laporan_keuangan'=>$request->nomor_laporan_keuangan,
                'tanggal_laporan_keuangan'=>Carbon::parse($request->tanggal_laporan_keuangan)->format('d-m-Y'),
                'pendapat_akuntan'=>$request->pendapat_akuntan,
                'file_struktur_organisasi_badan_usaha'=>base64_encode(file_get_contents($request->file_struktur_organisasi_badan_usaha)),
                'file_profile_badan_usaha'=>base64_encode(file_get_contents($request->file_profile_badan_usaha)),
                'file_ppm'=>base64_encode(file_get_contents($request->file_ppm)),
                'nomor_ppm'=>$request->nomor_ppm,
                'tanggal_ppm'=>Carbon::parse($request->tanggal_ppm)->format('d-m-Y'),
                'prosentase_saham_pma_ppm'=>$request->prosentase_saham_pma_ppm,
                'file_ppm_perubahan'=>base64_encode(file_get_contents($request->file_ppm_perubahan)),
                'nomor_ppm_perubahan'=>$request->nomor_ppm_perubahan,
                'tanggal_ppm_perubahan'=>Carbon::parse($request->tanggal_ppm_perubahan)->format('d-m-Y'),
                'prosentase_saham_pma_ppm_perubahan'=>$request->prosentase_saham_pma_ppm_perubahan,

            ]
        ]);
        $response = $client->post('Service/Permohonan/Persyaratan-Administratif/Tambah');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            return $ajaxResponse;
        }
        catch(GuzzleException $e){
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

    public function pullFromGatrik(Request $request)
    {
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);

        $token = getCurrentActiveToken()['token'];

        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;
        
        try{
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
            $response = $client->post('Service/Permohonan/Persyaratan-Administratif/Tarik');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                PersyaratanAdministratif::where('uid_permohonan', '=',$permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    PersyaratanAdministratif::create(
                        [
                            'uid_verifikasi_pa'=>$res->uid_verifikasi_pa,
                            'uid_permohonan'=>$res->uid_permohonan,
                            'file_akta_pendirian_bu'=>$res->file_akta_pendirian_bu,
                            'nama_notaris'=>$res->nama_notaris,
                            'judul_akta'=>$res->judul_akta,
                            'tanggal_akta'=>$res->tanggal_akta,
                            'nomor_akta'=>$res->nomor_akta,
                            'maksud_tujuan_akta'=>$res->maksud_tujuan_akta,
                            'file_pengesahan_sebagai_badan_hukum'=>$res->file_pengesahan_sebagai_badan_hukum,
                            'nomor_badan_hukum'=>$res->nomor_badan_hukum,
                            'tentang_badan_hukum'=>$res->tentang_badan_hukum,
                            'tanggal_badan_hukum'=>$res->tanggal_badan_hukum,
                            'file_npwp'=>$res->file_npwp,
                            'nomor_npwp'=>$res->nomor_npwp,
                            'file_skdu'=>$res->file_skdu,
                            'instansi_penerbit_skdu'=>$res->instansi_penerbit_skdu,
                            'nomor_skdu'=>$res->nomor_skdu,
                            'tanggal_skdu'=>$res->tanggal_skdu,
                            'masa_berlaku_skdu'=>$res->masa_berlaku_skdu,
                            'file_pjbu'=>$res->file_pjbu,
                            'nama_pjbu'=>$res->nama_pjbu,
                            'jenis_identitas_pjbu'=>$res->jenis_identitas_pjbu,
                            'nomor_ktp_pjbu'=>$res->nomor_ktp_pjbu,
                            'nomor_paspor_pjbu'=>$res->nomor_paspor_pjbu,
                            'file_laporan_keuangan'=>$res->file_laporan_keuangan,
                            'kekayaan_bersih'=>$res->kekayaan_bersih,
                            'modal_disetor'=>$res->modal_disetor,
                            'nama_kantor_akuntan_publik'=>$res->nama_kantor_akuntan_publik,
                            'alamat_kantor_akuntan_pulik'=>$res->alamat_kantor_akuntan_pulik,
                            'nomor_telepon_kantor_akuntan_publik'=>$res->nomor_telepon_kantor_akuntan_publik,
                            'nama_akuntan'=>$res->nama_akuntan,
                            'nomor_laporan_keuangan'=>$res->nomor_laporan_keuangan,
                            'tanggal_laporan_keuangan'=>$res->tanggal_laporan_keuangan,
                            'pendapat_akuntan'=>$res->pendapat_akuntan,
                            'file_struktur_organisasi_badan_usaha'=>$res->file_struktur_organisasi_badan_usaha,
                            'file_profile_badan_usaha'=>$res->file_profile_badan_usaha,
                            'file_ppm'=>$res->file_ppm,
                            'nomor_ppm'=>$res->nomor_ppm,
                            'tanggal_ppm'=>$res->tanggal_ppm,
                            'prosentase_saham_pma_ppm'=>intval($res->prosentase_saham_pma_ppm),
                            'file_ppm_perubahan'=>$res->file_ppm_perubahan,
                            'nomor_ppm_perubahan'=>$res->nomor_ppm_perubahan,
                            'tanggal_ppm_perubahan'=>$res->tanggal_ppm_perubahan,
                            'prosentase_saham_pma_ppm_perubahan'=>intval($res->prosentase_saham_pma_ppm_perubahan),
                        ]
                    );
                }
            }
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
        }
        return $ajaxResponse;
    }


    public function updateData(UpdatePersyaratanAdministratifRequest $request)
    {
        //return $request->all();
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $provinsi_uid = $permohonan->badan_usaha->kota->provinsi_uid;
        $x_lsbu_key_wilayah = LsbuWilayah::where('provinsi_uid', '=', $provinsi_uid)->get()->first()->api_keys;

        $token = getCurrentActiveToken()['token'];
        
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;
        
        try{
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>$x_lsbu_key_wilayah,
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_verifikasi_pa'=>$request->uid_verifikasi_pa,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                    'file_akta_pendirian_bu'=>base64_encode(file_get_contents($request->file_akta_pendirian_bu_edit)),
                    'nama_notaris'=>$request->nama_notaris_edit,
                    'judul_akta'=>$request->judul_akta_edit,
                    'tanggal_akta'=>Carbon::parse($request->tanggal_akta_edit)->format('d-m-Y'),
                    'nomor_akta'=>$request->nomor_akta_edit,
                    'maksud_tujuan_akta'=>$request->maksud_tujuan_akta_edit,
                    'file_pengesahan_sebagai_badan_hukum'=>base64_encode(file_get_contents($request->file_pengesahan_sebagai_badan_hukum_edit)),
                    'nomor_badan_hukum'=>$request->nomor_badan_hukum_edit,
                    'tentang_badan_hukum'=>$request->tentang_badan_hukum_edit,
                    'tanggal_badan_hukum'=>Carbon::parse($request->tanggal_badan_hukum_edit)->format('d-m-Y'),
                    'file_npwp'=>base64_encode(file_get_contents($request->file_npwp_edit)),
                    'nomor_npwp'=>$request->nomor_npwp_edit,
                    'file_skdu'=>base64_encode(file_get_contents($request->file_skdu_edit)),
                    'instansi_penerbit_skdu'=>$request->instansi_penerbit_skdu_edit,
                    'nomor_skdu'=>$request->nomor_skdu_edit,
                    'tanggal_skdu'=>Carbon::parse($request->tanggal_skdu_edit)->format('d-m-Y'),
                    'masa_berlaku_skdu'=>Carbon::parse($request->masa_berlaku_skdu_edit)->format('d-m-Y'),
                    'file_pjbu'=>base64_encode(file_get_contents($request->file_pjbu_edit)),
                    'nama_pjbu'=>$request->nama_pjbu_edit,
                    'jenis_identitas_pjbu'=>$request->jenis_identitas_pjbu_edit,
                    'nomor_ktp_pjbu'=>$request->nomor_ktp_pjbu_edit,
                    'nomor_paspor_pjbu'=>$request->nomor_paspor_pjbu_edit,
                    'file_laporan_keuangan'=>base64_encode(file_get_contents($request->file_laporan_keuangan_edit)),
                    'kekayaan_bersih'=>$request->kekayaan_bersih_edit,
                    'modal_disetor'=>$request->modal_disetor_edit,
                    'nama_kantor_akuntan_publik'=>$request->nama_kantor_akuntan_publik_edit,
                    'alamat_kantor_akuntan_pulik'=>$request->alamat_kantor_akuntan_pulik_edit,
                    'nomor_telepon_kantor_akuntan_publik'=>$request->nomor_telepon_kantor_akuntan_publik_edit,
                    'nama_akuntan'=>$request->nama_akuntan_edit,
                    'nomor_laporan_keuangan'=>$request->nomor_laporan_keuangan_edit,
                    'tanggal_laporan_keuangan'=>Carbon::parse($request->tanggal_laporan_keuangan_edit)->format('d-m-Y'),
                    'pendapat_akuntan'=>$request->pendapat_akuntan_edit,
                    'file_struktur_organisasi_badan_usaha'=>base64_encode(file_get_contents($request->file_struktur_organisasi_badan_usaha_edit)),
                    'file_profile_badan_usaha'=>base64_encode(file_get_contents($request->file_profile_badan_usaha_edit)),
                    'file_ppm'=>base64_encode(file_get_contents($request->file_ppm_edit)),
                    'nomor_ppm'=>$request->nomor_ppm_edit,
                    'tanggal_ppm'=>Carbon::parse($request->tanggal_ppm_edit)->format('d-m-Y'),
                    'prosentase_saham_pma_ppm'=>$request->prosentase_saham_pma_ppm_edit,
                    'file_ppm_perubahan'=>base64_encode(file_get_contents($request->file_ppm_perubahan_edit)),
                    'nomor_ppm_perubahan'=>$request->nomor_ppm_perubahan_edit,
                    'tanggal_ppm_perubahan'=>Carbon::parse($request->tanggal_ppm_perubahan_edit)->format('d-m-Y'),
                    'prosentase_saham_pma_ppm_perubahan'=>$request->prosentase_saham_pma_ppm_perubahan_edit,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Persyaratan-Administratif/Ubah');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            
            if($decode->response == '1'){
                
            }
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            
        }
        return $ajaxResponse;
    }
}
