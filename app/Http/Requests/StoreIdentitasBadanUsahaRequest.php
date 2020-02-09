<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIdentitasBadanUsahaRequest extends FormRequest
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
            'file_surat_permohonan_sbu'=>'required|file|mimes:pdf|max:2048',
            'nomor_surat'=>'required',
            'perihal'=>'required',
            'tanggal_surat'=>'required',
            'nama_penandatangan_surat'=>'required',
            'jabatan_penandatangan_surat'=>'required',
        ];
    }
}
