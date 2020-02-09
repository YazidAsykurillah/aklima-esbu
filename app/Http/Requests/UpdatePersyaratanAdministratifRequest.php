<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersyaratanAdministratifRequest extends FormRequest
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
            'uid_verifikasi_pa'=>'required',
            'uid_permohonan'=>'required',
            'file_akta_pendirian_bu_edit'=>'required',
            'nama_notaris_edit'=>'required',
            'judul_akta_edit'=>'required',
            'tanggal_akta_edit'=>'required',
            'nomor_akta_edit'=>'required',
            'maksud_tujuan_akta_edit'=>'required',
            'file_pengesahan_sebagai_badan_hukum_edit'=>'required',
            'nomor_badan_hukum_edit'=>'required',
            'tentang_badan_hukum_edit'=>'required',
            'tanggal_badan_hukum_edit'=>'required',
            'file_npwp_edit'=>'required',
            'nomor_npwp_edit'=>'required',
            'file_skdu_edit'=>'required',
            'instansi_penerbit_skdu_edit'=>'required',
            'nomor_skdu_edit'=>'required',
            'tanggal_skdu_edit'=>'required',
            'masa_berlaku_skdu_edit'=>'required',
            'file_pjbu_edit'=>'required',
            'nama_pjbu_edit'=>'required',
            'jenis_identitas_pjbu_edit'=>'required',
            'nomor_ktp_pjbu_edit'=>'required',
            'nomor_paspor_pjbu_edit'=>'required',
            'file_laporan_keuangan_edit'=>'required',
            'kekayaan_bersih_edit'=>'required',
            'modal_disetor_edit'=>'required',
            'nama_kantor_akuntan_publik_edit'=>'required',
            'alamat_kantor_akuntan_pulik_edit'=>'required',
            'nomor_telepon_kantor_akuntan_publik_edit'=>'required',
            'nama_akuntan_edit'=>'required',
            'nomor_laporan_keuangan_edit'=>'required',
            'tanggal_laporan_keuangan_edit'=>'required',
            'pendapat_akuntan_edit'=>'required',
            'file_struktur_organisasi_badan_usaha_edit'=>'required',
            'file_profile_badan_usaha_edit'=>'required',
            'file_ppm_edit'=>'required',
            'nomor_ppm_edit'=>'required',
            'tanggal_ppm_edit'=>'required',
            'prosentase_saham_pma_ppm_edit'=>'required',
            'file_ppm_perubahan_edit'=>'required',
            'nomor_ppm_perubahan_edit'=>'required',
            'tanggal_ppm_perubahan_edit'=>'required',
            'prosentase_saham_pma_ppm_perubahan_edit'=>'required',
        ];
    }
}
