<?php

namespace App\Listeners;

use App\Events\PermohonanIsDisplayed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\StatusDjk;
use App\HasilVerifikasiLSBUIbu;

class CallApiTarikStatusPermohonan
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
            $response = $client->post('Service/Tarik-Status-Permohonan');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            //dd($decode);
            $hasil_verifikasi_lsbu_ibu = $decode->hasil_verifikasi->lsbu->identitas_badan_usaha;
            //dd($hasil_verifikasi_lsbu_ibu);

            if($decode->response == '1'){
                StatusDjk::updateOrCreate(
                    ['uid_permohonan'=>$permohonan->uid_permohonan],
                    [
                        'uid_permohonan'=>$decode->uid_permohonan,
                        'status'=>$decode->status,
                        'keterangan_status'=>$decode->keterangan_status,
                        'tahap'=>$decode->tahap,
                        'keterangan_tahap'=>$decode->keterangan_tahap,
                        'updated_at'=>Carbon::now()
                    ]
                );
                foreach($hasil_verifikasi_lsbu_ibu as $hvli){
                    HasilVerifikasiLSBUIbu::updateOrCreate(
                        [
                            'uid_verifikasi_lsbu_ibu'=>$hvli->uid_verifikasi_lsbu_ibu,
                            'permohonan_uid'=>$hvli->permohonan_uid,
                        ],
                        [
                            'uid_verifikasi_lsbu_ibu'=>$hvli->uid_verifikasi_lsbu_ibu,
                            'permohonan_uid'=>$hvli->permohonan_uid,

                            'hasil_ver_nama_badan_usaha'=>$hvli->hasil_ver_nama_badan_usaha,
                            'catatan_ver_nama_badan_usaha'=>$hvli->catatan_ver_nama_badan_usaha,
                            'hasil_ver_alamat_badan_usaha'=>$hvli->hasil_ver_alamat_badan_usaha,
                            'catatan_ver_alamat_badan_usaha'=>$hvli->catatan_ver_alamat_badan_usaha,
                            'hasil_ver_kota_badan_usaha'=>$hvli->hasil_ver_kota_badan_usaha,
                            'catatan_ver_kota_badan_usaha'=>$hvli->catatan_ver_kota_badan_usaha,
                            'hasil_ver_kecamatan_badan_usaha'=>$hvli->hasil_ver_kecamatan_badan_usaha,
                            'catatan_ver_kecamatan_badan_usaha'=>$hvli->catatan_ver_kecamatan_badan_usaha,
                            'hasil_ver_kelurahan_badan_usaha'=>$hvli->hasil_ver_kelurahan_badan_usaha,
                            'catatan_ver_kelurahan_badan_usaha'=>$hvli->catatan_ver_kelurahan_badan_usaha,
                            'hasil_ver_kode_pos_badan_usaha'=>$hvli->hasil_ver_kode_pos_badan_usaha,
                            'catatan_ver_kode_pos_badan_usaha'=>$hvli->catatan_ver_kode_pos_badan_usaha,
                            'hasil_ver_no_telp_kantor_badan_usaha'=>$hvli->hasil_ver_no_telp_kantor_badan_usaha,
                            'catatan_ver_no_telp_kantor_badan_usaha'=>$hvli->catatan_ver_no_telp_kantor_badan_usaha,
                            'hasil_ver_no_hp_kantor_badan_usaha'=>$hvli->hasil_ver_no_hp_kantor_badan_usaha,
                            'catatan_ver_no_hp_kantor_badan_usaha'=>$hvli->catatan_ver_no_hp_kantor_badan_usaha,
                            'hasil_ver_no_fax_badan_usaha'=>$hvli->hasil_ver_no_fax_badan_usaha,
                            'catatan_ver_no_fax_badan_usaha'=>$hvli->catatan_ver_no_fax_badan_usaha,
                            'hasil_ver_email_badan_usaha'=>$hvli->hasil_ver_email_badan_usaha,
                            'catatan_ver_email_badan_usaha'=>$hvli->catatan_ver_email_badan_usaha,
                            'hasil_ver_website_badan_usaha'=>$hvli->hasil_ver_website_badan_usaha,
                            'catatan_ver_website_badan_usaha'=>$hvli->catatan_ver_website_badan_usaha,
                            'hasil_ver_nama_penghubung_badan_usaha'=>$hvli->hasil_ver_nama_penghubung_badan_usaha,
                            'catatan_ver_nama_penghubung_badan_usaha'=>$hvli->catatan_ver_nama_penghubung_badan_usaha,
                            'hasil_ver_no_hp_penghubung_badan_usaha'=>$hvli->hasil_ver_no_hp_penghubung_badan_usaha,
                            'catatan_ver_no_hp_penghubung_badan_usaha'=>$hvli->catatan_ver_no_hp_penghubung_badan_usaha,
                            'hasil_ver_file_surat_permohonan_sbu_badan_usaha'=>$hvli->hasil_ver_file_surat_permohonan_sbu_badan_usaha,
                            'catatan_ver_file_surat_permohonan_sbu_badan_usaha'=>$hvli->catatan_ver_file_surat_permohonan_sbu_badan_usaha,
                            'hasil_ver_nomor_surat_badan_usaha'=>$hvli->hasil_ver_nomor_surat_badan_usaha,
                            'catatan_ver_nomor_surat_badan_usaha'=>$hvli->catatan_ver_nomor_surat_badan_usaha,
                            'hasil_ver_perihal_badan_usaha'=>$hvli->hasil_ver_perihal_badan_usaha,
                            'catatan_ver_perihal_badan_usaha'=>$hvli->catatan_ver_perihal_badan_usaha,
                            'hasil_ver_tanggal_surat_badan_usaha'=>$hvli->hasil_ver_tanggal_surat_badan_usaha,
                            'catatan_ver_tanggal_surat_badan_usaha'=>$hvli->catatan_ver_tanggal_surat_badan_usaha,
                            'hasil_ver_nama_penandatangan_surat_badan_usaha'=>$hvli->hasil_ver_nama_penandatangan_surat_badan_usaha,
                            'catatan_ver_nama_penandatangan_surat_badan_usaha'=>$hvli->catatan_ver_nama_penandatangan_surat_badan_usaha,
                            'hasil_ver_jabatan_penandatangan_surat_badan_usaha'=>$hvli->hasil_ver_jabatan_penandatangan_surat_badan_usaha,
                            'catatan_ver_jabatan_penandatangan_surat_badan_usaha'=>$hvli->catatan_ver_jabatan_penandatangan_surat_badan_usaha,
                            'hasil_ver_bentuk_badan_usaha'=>$hvli->hasil_ver_bentuk_badan_usaha,
                            'catatan_ver_bentuk_badan_usaha'=>$hvli->catatan_ver_bentuk_badan_usaha,

                            'updated_at'=>Carbon::now()


                        ]
                    );
                }
                
            }
            //return $decode;
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            return $contents;
            
        }
    }

}
