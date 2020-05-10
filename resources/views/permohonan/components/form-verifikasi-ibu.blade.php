<div class="card">
    <form id="form-verifikasi-ibu" method="post" enctype="multipart/form-data" action="{{ url('verifikasi-ibu/') }}">
    <div class="card-header d-flex">
        <h4 class="card-header-title">
            <i class="fa fa-tag"></i> Form Verifikasi Identitas Badan Usaha
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(!is_null($identitas_badan_usaha))
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20%;">Point Verifikasi</th>
                        <th style="width: 30%;">Isi Point</th>
                        <th style="width: 30%; text-align: center;">Sesuai / Tidak Sesuai</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>File Surat Permohoan SBU</td>
                        <td style="">
                            @if($identitas_badan_usaha->file_surat_permohonan_sbu != NULL)
                            <a href="{{ $identitas_badan_usaha->file_surat_permohonan_sbu }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_file_surat_permohonan_sbu" class="custom-control-input hasil_ver_ibu_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_file_surat_permohonan_sbu" class="custom-control-input hasil_ver_ibu_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_ibu_file_surat_permohonan_sbu" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Nomor Surat</td>
                        <td style="">
                            {{ $identitas_badan_usaha->nomor_surat }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_nomor_surat" class="custom-control-input hasil_ver_ibu_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_nomor_surat" class="custom-control-input hasil_ver_ibu_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_ibu_nomor_surat" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td style="">
                            {{ $identitas_badan_usaha->perihal }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_perihal" class="custom-control-input hasil_ver_ibu_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_perihal" class="custom-control-input hasil_ver_ibu_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_ibu_perihal" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat</td>
                        <td style="">
                            {{ indonesian_date($identitas_badan_usaha->tanggal_surat) }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_tanggal_surat" class="custom-control-input hasil_ver_ibu_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_tanggal_surat" class="custom-control-input hasil_ver_ibu_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_ibu_tanggal_surat" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Penandatanganan Surat</td>
                        <td style="">
                            {{ $identitas_badan_usaha->nama_penandatangan_surat }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_nama_penandatangan_surat" class="custom-control-input hasil_ver_ibu_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_nama_penandatangan_surat" class="custom-control-input hasil_ver_ibu_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_ibu_nama_penandatangan_surat" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan Penandatanganan Surat</td>
                        <td style="">
                            {{ $identitas_badan_usaha->jabatan_penandatangan_surat }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_jabatan_penandatangan_surat" class="custom-control-input hasil_ver_ibu_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_ibu_jabatan_penandatangan_surat" class="custom-control-input hasil_ver_ibu_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_ibu_jabatan_penandatangan_surat" class="form-control"></textarea>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: center;">
                            <button type="button" id="btn-check-all-ver-ibu" class="btn btn-xs btn-success">
                                Sesuai Semua
                            </button>
                            <button type="button" id="btn-uncheck-all-ver-ibu" class="btn btn-xs btn-secondary">
                                Tidak Sesuai Semua
                            </button>
                        </td>
                    </tr>
                </tfoot>
                
            </table>
            @endif
        </div>
    </div>
    <div class="card-footer p-0 text-center">
        
            @csrf
            <input type="hidden" name="uid_permohonan" value="{{ $permohonan->uid_permohonan }}">
            <button type="submit" id="btn-submit-ver-ibu" class="btn btn-block btn-primary">
                <i class="fa fa-save"></i> Simpan Verifikasi Identitas Badan Usaha
            </button>
        
    </div>
</form>
</div>