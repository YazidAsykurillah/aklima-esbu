<div class="card">
    <form id="form-verifikasi-pa" method="post" enctype="multipart/form-data" action="{{ url('verifikasi-pa/') }}">
    <div class="card-header d-flex">
        <h4 class="card-header-title">
            <i class="fa fa-tag"></i> Form Verifikasi Persyaratan Administratif
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(!is_null($persyaratan_administratif))
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
                        <td>File Akta Pendirian BU</td>
                        <td style="">
                            @if($persyaratan_administratif->file_akta_pendirian_bu != NULL)
                            <a href="{{ $persyaratan_administratif->file_akta_pendirian_bu }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_akta_pendirian_bu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_akta_pendirian_bu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_akta_pendirian_bu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nama Notaris</td>
                        <td style="">
                            {{ $persyaratan_administratif->nama_notaris }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nama_notaris" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nama_notaris" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nama_notaris" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Judul Akta</td>
                        <td style="">
                            {{ $persyaratan_administratif->judul_akta }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_judul_akta" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_judul_akta" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_judul_akta" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal Akta</td>
                        <td style="">
                            {{ $persyaratan_administratif->tanggal_akta }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_akta" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_akta" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_tanggal_akta" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor Akta</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_akta }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_akta" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_akta" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_akta" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Maksud Tujuan Akta</td>
                        <td style="">
                            {{ $persyaratan_administratif->maksud_tujuan_akta }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_maksud_tujuan_akta" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_maksud_tujuan_akta" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_maksud_tujuan_akta" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File Pengesahan Sebagai Badan Hukum</td>
                        <td style="">
                            @if($persyaratan_administratif->file_pengesahan_sebagai_badan_hukum != NULL)
                            <a href="{{ $persyaratan_administratif->file_pengesahan_sebagai_badan_hukum }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_pengesahan_sebagai_badan_hukum" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_pengesahan_sebagai_badan_hukum" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_pengesahan_sebagai_badan_hukum" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor Badan Hukum</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_badan_hukum }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_badan_hukum" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_badan_hukum" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_badan_hukum" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Tentang Badan Hukum</td>
                        <td style="">
                            {{ $persyaratan_administratif->tentang_badan_hukum }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tentang_badan_hukum" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tentang_badan_hukum" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_tentang_badan_hukum" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal Badan Hukum</td>
                        <td style="">
                            {{ $persyaratan_administratif->tanggal_badan_hukum }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_badan_hukum" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_badan_hukum" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_tanggal_badan_hukum" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File NPWP</td>
                        <td style="">
                            @if($persyaratan_administratif->file_npwp != NULL)
                            <a href="{{ $persyaratan_administratif->file_npwp }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_npwp" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_npwp" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_npwp" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor NPWP</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_npwp }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_npwp" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_npwp" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_npwp" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File SKDU</td>
                        <td style="">
                            @if($persyaratan_administratif->file_skdu != NULL)
                            <a href="{{ $persyaratan_administratif->file_skdu }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_skdu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_skdu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_skdu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Instansi Penerbit SKDU</td>
                        <td style="">
                            {{ $persyaratan_administratif->instansi_penerbit_skdu }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_instansi_penerbit_skdu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_instansi_penerbit_skdu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_instansi_penerbit_skdu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor SKDU</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_skdu }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_skdu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_skdu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_skdu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal SKDU</td>
                        <td style="">
                            {{ $persyaratan_administratif->tanggal_skdu }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_skdu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_skdu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_tanggal_skdu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Masa Berlaku SKDU</td>
                        <td style="">
                            {{ $persyaratan_administratif->masa_berlaku_skdu }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_masa_berlaku_skdu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_masa_berlaku_skdu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_masa_berlaku_skdu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File PJBU</td>
                        <td style="">
                            @if($persyaratan_administratif->file_pjbu != NULL)
                            <a href="{{ $persyaratan_administratif->file_pjbu }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_pjbu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_pjbu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_pjbu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nama PJBU</td>
                        <td style="">
                            {{ $persyaratan_administratif->nama_pjbu }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nama_pjbu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nama_pjbu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nama_pjbu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Jenis Identitas PJBU</td>
                        <td style="">
                            {{ $persyaratan_administratif->jenis_identitas_pjbu }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_jenis_identitas_pjbu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_jenis_identitas_pjbu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_jenis_identitas_pjbu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor KTP PJBU</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_ktp_pjbu }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_ktp_pjbu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_ktp_pjbu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_ktp_pjbu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor Passpor PJBU</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_paspor_pjbu }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_paspor_pjbu" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_paspor_pjbu" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_paspor_pjbu" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File Laporan Keuangan</td>
                        <td style="">
                            @if($persyaratan_administratif->file_laporan_keuangan != NULL)
                            <a href="{{ $persyaratan_administratif->file_laporan_keuangan }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_laporan_keuangan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_laporan_keuangan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_laporan_keuangan" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Kekayaan Bersih</td>
                        <td style="">
                            {{ rupiah($persyaratan_administratif->kekayaan_bersih) }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_kekayaan_bersih" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_kekayaan_bersih" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_kekayaan_bersih" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Modal Disetor</td>
                        <td style="">
                            {{ rupiah($persyaratan_administratif->modal_disetor) }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_modal_disetor" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_modal_disetor" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_modal_disetor" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nama Kantor Akuntan Publik</td>
                        <td style="">
                            {{ $persyaratan_administratif->nama_kantor_akuntan_publik }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nama_kantor_akuntan_publik" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nama_kantor_akuntan_publik" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nama_kantor_akuntan_publik" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Alamat Kantor Akuntan Publik</td>
                        <td style="">
                            {{ $persyaratan_administratif->alamat_kantor_akuntan_pulik }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_alamat_kantor_akuntan_pulik" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_alamat_kantor_akuntan_pulik" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_alamat_kantor_akuntan_pulik" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor Telp Kantor Akuntan Publik</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_telepon_kantor_akuntan_publik }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_telepon_kantor_akuntan_publik" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_telepon_kantor_akuntan_publik" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_telepon_kantor_akuntan_publik" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nama Akuntan</td>
                        <td style="">
                            {{ $persyaratan_administratif->nama_akuntan }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nama_akuntan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nama_akuntan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nama_akuntan" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor Laporan Keuangan</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_laporan_keuangan }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_laporan_keuangan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_laporan_keuangan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_laporan_keuangan" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal Laporan Keuangan</td>
                        <td style="">
                            {{ $persyaratan_administratif->tanggal_laporan_keuangan }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_laporan_keuangan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_laporan_keuangan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_tanggal_laporan_keuangan" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Pendapat Akuntan</td>
                        <td style="">
                            {{ $persyaratan_administratif->pendapat_akuntan }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_pendapat_akuntan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_pendapat_akuntan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_pendapat_akuntan" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File Struktur Organisasi Badan Usaha</td>
                        <td style="">
                            @if($persyaratan_administratif->file_struktur_organisasi_badan_usaha != NULL)
                            <a href="{{ $persyaratan_administratif->file_struktur_organisasi_badan_usaha }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_struktur_organisasi_badan_usaha" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_struktur_organisasi_badan_usaha" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_struktur_organisasi_badan_usaha" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File Profile Badan Usaha</td>
                        <td style="">
                            @if($persyaratan_administratif->file_profile_badan_usaha != NULL)
                            <a href="{{ $persyaratan_administratif->file_profile_badan_usaha }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_profile_badan_usaha" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_profile_badan_usaha" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_profile_badan_usaha" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File PPM</td>
                        <td style="">
                            @if($persyaratan_administratif->file_ppm != NULL)
                            <a href="{{ $persyaratan_administratif->file_ppm }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_ppm" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_ppm" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_ppm" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor PPM</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_ppm }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_ppm" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_ppm" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_ppm" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal PPM</td>
                        <td style="">
                            {{ $persyaratan_administratif->tanggal_ppm }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_ppm" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_ppm" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_tanggal_ppm" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Prosentase Saham PMA PPM</td>
                        <td style="">
                            {{ $persyaratan_administratif->prosentase_saham_pma_ppm }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_prosentase_saham_pma_ppm" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_prosentase_saham_pma_ppm" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_prosentase_saham_pma_ppm" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>File PPM Perubahan</td>
                        <td style="">
                            @if($persyaratan_administratif->file_ppm_perubahan != NULL)
                            <a href="{{ $persyaratan_administratif->file_ppm_perubahan }}" class="btn btn-xs btn-rounded btn-info">
                                Download Lampiran
                            </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_ppm_perubahan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_file_ppm_perubahan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_file_ppm_perubahan" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor PPM Perubahan</td>
                        <td style="">
                            {{ $persyaratan_administratif->nomor_ppm_perubahan }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_ppm_perubahan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_nomor_ppm_perubahan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_nomor_ppm_perubahan" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Tanggal PPM Perubahan</td>
                        <td style="">
                            {{ $persyaratan_administratif->tanggal_ppm_perubahan }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_ppm_perubahan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_tanggal_ppm_perubahan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_tanggal_ppm_perubahan" class="form-control"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Prosentase Saham PMA PPM Perubahan</td>
                        <td style="">
                            {{ $persyaratan_administratif->prosentase_saham_pma_ppm_perubahan }}
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_prosentase_saham_pma_ppm_perubahan" class="custom-control-input hasil_ver_pa_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pa_prosentase_saham_pma_ppm_perubahan" class="custom-control-input hasil_ver_pa_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pa_prosentase_saham_pma_ppm_perubahan" class="form-control"></textarea>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: center;">
                            <button type="button" id="btn-check-all-ver-pa" class="btn btn-xs btn-success">
                                Sesuai Semua
                            </button>
                            <button type="button" id="btn-uncheck-all-ver-pa" class="btn btn-xs btn-secondary">
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
        <div class="card-footer-item card-footer-item-bordered">
            @csrf
            <input type="hidden" name="uid_permohonan" value="{{ $permohonan->uid_permohonan }}">
            <button type="submit" class="btn btn-block btn-primary">
                <i class="fa fa-save"></i> Simpan Data Verifikasi
            </button>
        </div>
    </div>
    </form>
</div>