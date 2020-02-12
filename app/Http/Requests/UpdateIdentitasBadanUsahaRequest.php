<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIdentitasBadanUsahaRequest extends FormRequest
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
            'uid_verifikasi_ibu'=>'required',
            'uid_permohonan'=>'required',
            'file_surat_permohonan_sbu_edit'=>'required|file|mimes:pdf|max:1000',
            'nomor_surat_edit'=>'required',
            'perihal_edit'=>'required',
            'tanggal_surat_edit'=>'required',
            'nama_penandatangan_surat_edit'=>'required',
            'jabatan_penandatangan_surat_edit'=>'required',
        ];
    }
}
