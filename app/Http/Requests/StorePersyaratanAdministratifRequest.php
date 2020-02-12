<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersyaratanAdministratifRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            'uid_permohonan'=>'required',
            'file_akta_pendirian_bu'=>'required|file|mimes:pdf|max:1000',
            'nama_notaris'=>'required',
            'judul_akta'=>'required',
            'tanggal_akta'=>'required',
            'nomor_akta'=>'required',
            'maksud_tujuan_akta'=>'required',
            'file_pengesahan_sebagai_badan_hukum'=>'required',
            'nomor_badan_hukum'=>'required',
            'tentang_badan_hukum'=>'required',
            'tanggal_badan_hukum'=>'required',
            'file_npwp'=>'required',
            'nomor_npwp'=>'required',
            'file_skdu'=>'required',
            'instansi_penerbit_skdu'=>'required',
            'nomor_skdu'=>'required',
            'tanggal_skdu'=>'required',
            'masa_berlaku_skdu'=>'required',
            'file_pjbu'=>'required',
            'nama_pjbu'=>'required',
            'jenis_identitas_pjbu'=>'required',
            'nomor_ktp_pjbu'=>'required',
            'nomor_paspor_pjbu'=>'required',
            'file_laporan_keuangan'=>'required',
            'kekayaan_bersih'=>'required',
            'modal_disetor'=>'required',
            'nama_kantor_akuntan_publik'=>'required',
            'alamat_kantor_akuntan_pulik'=>'required',
            'nomor_telepon_kantor_akuntan_publik'=>'required',
            'nama_akuntan'=>'required',
            'nomor_laporan_keuangan'=>'required',
            'tanggal_laporan_keuangan'=>'required',
            'pendapat_akuntan'=>'required',
            'file_struktur_organisasi_badan_usaha'=>'required',
            'file_profile_badan_usaha'=>'required',
            'file_ppm'=>'required',
            'nomor_ppm'=>'required',
            'tanggal_ppm'=>'required',
            'prosentase_saham_pma_ppm'=>'required',
            'file_ppm_perubahan'=>'required',
            'nomor_ppm_perubahan'=>'required',
            'tanggal_ppm_perubahan'=>'required',
            'prosentase_saham_pma_ppm_perubahan'=>'required',
        ];
    }
}
