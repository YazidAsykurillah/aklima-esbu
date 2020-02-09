<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersyaratanTeknisPenanggungJawabTeknikRequest extends FormRequest
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
            'uid_verifikasi_pt'=>'required',
            'jenis_identitas'=>'required',
            'nama'=>'required',
            'nomor_identitas'=>'required',
            'nomor_hp'=>'required',
            'file_kartu_identitas'=>'required|file|mimes:jpg,jpeg,png',
            'file_pernyataan_pjt'=>'required|file|mimes:pdf',
            'file_daftar_riwayat_hidup'=>'required',
            'file_surat_penunjukan_pjt'=>'required',
            'kewarganegaraan'=>'required',
        ];
    }
}
