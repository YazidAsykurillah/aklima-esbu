<?php

namespace App\Listeners;

use App\Events\PermohonanIsDisplayed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\PersyaratanAdministratif;

class CallApiTarikPersyaratanAdministratif
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PermohonanIsDisplayed  $event
     * @return void
     */
    public function handle(PermohonanIsDisplayed $event)
    {
        $permohonan = $event->permohonan;
        try{
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> getCurrentActiveToken()['token']
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
                //PersyaratanAdministratif::where('uid_permohonan', '=',$permohonan->uid_permohonan)->delete();
                foreach($decode->result as $res){
                    PersyaratanAdministratif::updateOrCreate(
                        ['uid_permohonan'=>$res->uid_permohonan],
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
                            'updated_at'=>Carbon::now()
                        ]
                    );
                }
            }
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            return $contents;
        }
        
    }
}
