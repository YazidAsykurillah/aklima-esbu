@extends('permohonan.show')

@section('sub-content')
<!--Row Tabs-->
<div class="row">
    <div class="col-md-12">
        <div class="section-block">
            <h5 class="section-title">Data Verifikasi</h5>
            <p></p>
        </div>
        <div class="tab-outline">
            @include('permohonan.components.nav-tabs')
            <div class="tab-content" id="myTabContent2">
                <!--Tab Pane Persyaratan Administratif-->
                <div class="tab-pane fade show active" id="outline-persyaratan-administratif" role="tabpanel" aria-labelledby="tab-outline-persyaratan-administratif">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4 class="card-header-title">
                               Persyaratan Administratif
                            </h4>
                            <div class="toolbar ml-auto">
                                <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                                @if($permohonan->status == '0' || $permohonan->status == '1')
                                    <a href="#" class="btn btn-light btn-xs"  data-toggle="modal" data-target="#pullPAModal">
                                        <i class="fa fa-sync"></i> Tarik
                                    </a>
                                    @if(is_null($permohonan->persyaratan_administratif))
                                        
                                        <a href="#" class="btn btn-light btn-xs"  data-toggle="modal" data-target="#addPAModal">
                                            <i class="fa fa-plus-circle"></i> Tambah
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-light btn-xs"  data-toggle="modal" data-target="#editPAModal">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if(!is_null($persyaratan_administratif))
                                <table class="table">
                                    <tr>
                                        <td style="width: 30%;">UID Verifikasi PA</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_uid_verifikasi_pa">
                                            {{ $persyaratan_administratif->uid_verifikasi_pa }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File Akta Pendirian BU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_akta_pendirian_bu">
                                            <a href="{{ $persyaratan_administratif->file_akta_pendirian_bu }}">
                                                {{ $persyaratan_administratif->file_akta_pendirian_bu }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nama Notaris</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nama_notaris">
                                            {{ $persyaratan_administratif->nama_notaris }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Judul Akta</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_judul_akta">
                                            {{ $persyaratan_administratif->judul_akta }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tanggal Akta</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_tanggal_akta">
                                            {{ indonesian_date($persyaratan_administratif->tanggal_akta) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor Akta</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_akta">
                                            {{ $persyaratan_administratif->nomor_akta }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Maksud Tujuan Akta</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_maksud_tujuan_akta">
                                            {{ $persyaratan_administratif->maksud_tujuan_akta }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File Pengesahan Sebagai Badan Hukum</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_pengesahan_sebagai_badan_hukum">
                                            <a href="{{ $persyaratan_administratif->file_pengesahan_sebagai_badan_hukum }}">
                                                {{ $persyaratan_administratif->file_pengesahan_sebagai_badan_hukum }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor Badan Hukum</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_badan_hukum">
                                            {{ $persyaratan_administratif->nomor_badan_hukum }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tentang Badan Hukum</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_tentang_badan_hukum">
                                            {{ $persyaratan_administratif->tentang_badan_hukum }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tanggal Badan Hukum</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_tanggal_badan_hukum">
                                            {{ indonesian_date($persyaratan_administratif->tanggal_badan_hukum) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File NPWP</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_npwp">
                                            <a href="{{ $persyaratan_administratif->file_npwp }}">
                                                {{ $persyaratan_administratif->file_npwp }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor NPWP</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_npwp">
                                            {{ $persyaratan_administratif->nomor_npwp }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File SKDU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_skdu">
                                            <a href="{{ $persyaratan_administratif->file_skdu }}">
                                                {{ $persyaratan_administratif->file_skdu }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Instansi Penerbit SKDU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_instansi_penerbit_skdu">
                                            {{ $persyaratan_administratif->instansi_penerbit_skdu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor SKDU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_skdu">
                                            {{ $persyaratan_administratif->nomor_skdu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tanggal SKDU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_tanggal_skdu">
                                            {{ indonesian_date($persyaratan_administratif->tanggal_skdu) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Masa Berlaku SKDU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_masa_berlaku_skdu">
                                            {{ indonesian_date($persyaratan_administratif->masa_berlaku_skdu) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File PJBU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_pjbu">
                                            <a href="{{ $persyaratan_administratif->file_pjbu }}">
                                                {{ $persyaratan_administratif->file_pjbu }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nama PJBU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nama_pjbu">
                                            {{ $persyaratan_administratif->nama_pjbu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Jenis Identitas PJBU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_jenis_identitas_pjbu">
                                            {{ $persyaratan_administratif->jenis_identitas_pjbu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor KTP PJBU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_ktp_pjbu">
                                            {{ $persyaratan_administratif->nomor_ktp_pjbu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor Paspor PJBU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_paspor_pjbu">
                                            {{ $persyaratan_administratif->nomor_paspor_pjbu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File Laporan Keuangan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_laporan_keuangan">
                                            <a href="{{ $persyaratan_administratif->file_laporan_keuangan }}">
                                                {{ $persyaratan_administratif->file_laporan_keuangan }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Kekayaan Bersih</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_kekayaan_bersih">
                                            {{ rupiah($persyaratan_administratif->kekayaan_bersih) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Modal Disetor</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_modal_disetor">
                                            {{ rupiah($persyaratan_administratif->modal_disetor) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nama Kantor Akuntan Publik</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nama_kantor_akuntan_publik">
                                            {{ $persyaratan_administratif->nama_kantor_akuntan_publik }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Alamat Kantor Akuntan Publik</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_alamat_kantor_akuntan_pulik">
                                            {{ $persyaratan_administratif->alamat_kantor_akuntan_pulik }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor Telepon Kantor Akuntan Publik</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_telepon_kantor_akuntan_publik">
                                            {{ $persyaratan_administratif->nomor_telepon_kantor_akuntan_publik }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nama Akuntan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nama_akuntan">
                                            {{ $persyaratan_administratif->nama_akuntan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor Laporan Keuangan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_laporan_keuangan">
                                            {{ $persyaratan_administratif->nomor_laporan_keuangan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tanggal Laporan Keuangan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_tanggal_laporan_keuangan">
                                            {{ indonesian_date($persyaratan_administratif->tanggal_laporan_keuangan) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Pendapat Akuntan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_pendapat_akuntan">
                                            {{ $persyaratan_administratif->pendapat_akuntan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File Struktur Organisasi Badan Usaha</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_struktur_organisasi_badan_usaha">
                                            <a href="{{ $persyaratan_administratif->file_struktur_organisasi_badan_usaha }}">
                                                {{ $persyaratan_administratif->file_struktur_organisasi_badan_usaha }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File Profile Badan Usaha</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_profile_badan_usaha">
                                            <a href="{{ $persyaratan_administratif->file_profile_badan_usaha }}">
                                                {{ $persyaratan_administratif->file_profile_badan_usaha }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File PPM</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_ppm">
                                            <a href="{{ $persyaratan_administratif->file_ppm }}">
                                                {{ $persyaratan_administratif->file_ppm }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor PPM</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_ppm">
                                            {{ $persyaratan_administratif->nomor_ppm }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tanggal PPM</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_tanggal_ppm">
                                            {{ indonesian_date($persyaratan_administratif->tanggal_ppm) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Prosentase Saham PMA PPM</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_prosentase_saham_pma_ppm">
                                            {{ $persyaratan_administratif->prosentase_saham_pma_ppm }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File PPM Perubahan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_file_ppm_perubahan">
                                            <a href="{{ $persyaratan_administratif->file_ppm_perubahan }}">
                                                {{ $persyaratan_administratif->file_ppm_perubahan }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor PPM Perubahan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_nomor_ppm_perubahan">
                                            {{ $persyaratan_administratif->nomor_ppm_perubahan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tanggal PPM Perubahan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_tanggal_ppm_perubahan">
                                            {{ indonesian_date($persyaratan_administratif->tanggal_ppm_perubahan) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Prosentase Saham PMA PPM Perubahan</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="pa_holder_prosentase_saham_pma_ppm_perubahan">
                                            {{ $persyaratan_administratif->prosentase_saham_pma_ppm_perubahan }}
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <p class="alert alert-warning">
                                    Data Persyaratan Administratif tidak ditemukan, silahkan tarik data atau tambahkan
                                </p>
                                @endif
                            </div>

                            <!--Block Akta Perubahan BU Persyaratan Administratif-->
                            <div class="card">
                                <div class="card-header d-flex">
                                    <h4 class="card-header-title">
                                        <i class="fa fa-file-alt"></i> Akta Perubahan Badan Usaha
                                    </h4>
                                    <div class="toolbar ml-auto">
                                        <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                                        @if($permohonan->status == '0' || $permohonan->status == '1')
                                            @if(!is_null($persyaratan_administratif))
                                            <button class="btn btn-light btn-xs" id="btn-pull-akta-perubahan-bu-pa" title="Tarik Akta Perubahan BU" data-uid_verifikasi_pa="{{ $persyaratan_administratif ? $persyaratan_administratif->uid_verifikasi_pa : null }}">
                                                <i class="fa fa-sync"></i> Tarik
                                            </button>
                                            <button class="btn btn-light btn-xs" id="btn-add-akta-perubahan-bu-pa-trigger" title="Tambah Akta Perubahan BU" data-uid_verifikasi_pa="{{ $persyaratan_administratif ? $persyaratan_administratif->uid_verifikasi_pa : null }}">
                                                <i class="fa fa-plus-circle"></i> Tambah
                                            </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if($akta_perubahan_bu_pa)
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%;">Nama Notaris</td>
                                                    <td style="width: 5%;">:</td>
                                                    <td style="">
                                                        {{ $akta_perubahan_bu_pa->nama_notaris }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%;">Judul Akta</td>
                                                    <td style="width: 5%;">:</td>
                                                    <td style="">
                                                        {{ $akta_perubahan_bu_pa->judul_akta }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%;">Tanggal Akta</td>
                                                    <td style="width: 5%;">:</td>
                                                    <td style="">
                                                        {{ $akta_perubahan_bu_pa->tanggal_akta }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%;">Nomor Akta</td>
                                                    <td style="width: 5%;">:</td>
                                                    <td style="">
                                                        {{ $akta_perubahan_bu_pa->nomor_akta }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30%;">Hal Yang Diubah</td>
                                                    <td style="width: 5%;">:</td>
                                                    <td style="">
                                                        {{ $akta_perubahan_bu_pa->hal_yang_diubah }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="alert alert-warning">
                                            Tidak ada data
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <!--ENDBlock Akta Perubahan BU Persyaratan Administratif-->

                            <!--Block Pengesahan Akta Perubahan-->
                            <div class="card">
                                <div class="card-header d-flex">
                                    <h4 class="card-header-title">
                                        <i class="fa fa-file-alt"></i> Pengesahan Akta Perubahan
                                    </h4>
                                    <div class="toolbar ml-auto">
                                        <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                                        @if($permohonan->status == '0' || $permohonan->status == '1')
                                            @if(!is_null($persyaratan_administratif))
                                            <button class="btn btn-light btn-xs" id="btn-pull-pengesahan-akta-perubahan" title="Tarik Pengesahan Akta Perubahan" data-uid_verifikasi_pa="{{ $persyaratan_administratif ? $persyaratan_administratif->uid_verifikasi_pa : null }}">
                                                <i class="fa fa-sync"></i> Tarik
                                            </button>
                                            <button class="btn btn-light btn-xs" id="btn-add-pengesahan-akta-perubahan-trigger" title="Tambah Pengesahan Akta Perubahan" data-uid_verifikasi_pa="{{ $persyaratan_administratif ? $persyaratan_administratif->uid_verifikasi_pa : null }}">
                                                <i class="fa fa-plus-circle"></i> Tambah
                                            </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if($pengesahan_akta_perubahan)
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="width: 30%;">File Pengesahan Akta Perubahan</td>
                                                <td style="width: 5%;">:</td>
                                                <td style="">
                                                    {{ $pengesahan_akta_perubahan->file_pengesahan_akta_perubahan }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%;">Nomor</td>
                                                <td style="width: 5%;">:</td>
                                                <td style="">
                                                    {{ $pengesahan_akta_perubahan->nomor }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%;">Tentang</td>
                                                <td style="width: 5%;">:</td>
                                                <td style="">
                                                    {{ $pengesahan_akta_perubahan->tentang }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%;">Tanggal</td>
                                                <td style="width: 5%;">:</td>
                                                <td style="">
                                                    {{ $pengesahan_akta_perubahan->tanggal }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                        <p class="alert alert-warning">
                                            Tidak ada data
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <!--ENDBlock Pengesahan Akta Perubahan-->
                        </div>
                    </div>
                </div>
                <!--ENDTab Pane Persyaratan Administratif-->

            </div>
        </div>
    </div>
</div>
<!--ENDRow Tabs-->

<!--Modal Tarik Persyaratan Administratif-->
<div class="modal fade" id="pullPAModal" tabindex="-1" role="dialog" aria-labelledby="pullPAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-pull-persyaratan-administratif" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="pullPAModalLabel">Tarik Persyaratan Administratif</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>Tarik data Persyaratan Administratif dari gatrik</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-pull-ibu">Tarik</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tarik Persyaratan Administratif-->

<!--Modal Tambah Persyaratan Administratif-->
<div class="modal fade" id="addPAModal" tabindex="-1" role="dialog" aria-labelledby="addPAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-tambah-persyaratan-administratif" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPAModalLabel">Tambah Persyaratan Administratif</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label" for="file_akta_pendirian_bu">File Akta Pendirian BU</label>
                        <input type="file" class="form-control" id="file_akta_pendirian_bu" name="file_akta_pendirian_bu" >
                    </div>
                    <div class="form-group">
                        <label for="nama_notaris" class="col-form-label">Nama Notaris</label>
                        <input id="nama_notaris" name="nama_notaris" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="judul_akta" class="col-form-label">Judul Akta</label>
                        <input id="judul_akta" name="judul_akta" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_akta" class="col-form-label">Tanggal Akta</label>
                        <div class="input-group date" id="tanggal_akta" data-target-input="nearest">
                            <input type="text" id="tanggal_akta" name="tanggal_akta" class="form-control datetimepicker-input" data-target="#tanggal_akta" />
                            <div class="input-group-append" data-target="#tanggal_akta" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nomor_akta" class="col-form-label">Nomor Akta</label>
                        <input id="nomor_akta" name="nomor_akta" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="maksud_tujuan_akta" class="col-form-label">Maksud Tujuan Akta</label>
                        <input id="maksud_tujuan_akta" name="maksud_tujuan_akta" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_pengesahan_sebagai_badan_hukum">File Pengesahan Sebagai Badan Hukum</label>
                        <input type="file" class="form-control" id="file_pengesahan_sebagai_badan_hukum" name="file_pengesahan_sebagai_badan_hukum" >
                    </div>
                    <div class="form-group">
                        <label for="nomor_badan_hukum" class="col-form-label">Nomor Badan Hukum</label>
                        <input id="nomor_badan_hukum" name="nomor_badan_hukum" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tentang_badan_hukum" class="col-form-label">Tentang Badan Hukum</label>
                        <input id="tentang_badan_hukum" name="tentang_badan_hukum" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_badan_hukum" class="col-form-label">Tanggal Badan Hukum</label>
                        <div class="input-group date" id="tanggal_badan_hukum" data-target-input="nearest">
                            <input type="text" id="tanggal_badan_hukum" name="tanggal_badan_hukum" class="form-control datetimepicker-input" data-target="#tanggal_badan_hukum" />
                            <div class="input-group-append" data-target="#tanggal_badan_hukum" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_npwp">File NPWP</label>
                        <input type="file" class="form-control" id="file_npwp" name="file_npwp" >
                    </div>
                    <div class="form-group">
                        <label for="nomor_npwp" class="col-form-label">Nomor NPWP</label>
                        <input id="nomor_npwp" name="nomor_npwp" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_skdu">File SKDU</label>
                        <input type="file" class="form-control" id="file_skdu" name="file_skdu" >
                    </div>
                    <div class="form-group">
                        <label for="instansi_penerbit_skdu" class="col-form-label">Instansi Penerbit SKDU</label>
                        <input id="instansi_penerbit_skdu" name="instansi_penerbit_skdu" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_skdu" class="col-form-label">Nomor SKDU</label>
                        <input id="nomor_skdu" name="nomor_skdu" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_skdu" class="col-form-label">Tanggal SKDU</label>
                        <div class="input-group date" id="tanggal_skdu" data-target-input="nearest">
                            <input type="text" id="tanggal_skdu" name="tanggal_skdu" class="form-control datetimepicker-input" data-target="#tanggal_skdu" />
                            <div class="input-group-append" data-target="#tanggal_skdu" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="masa_berlaku_skdu" class="col-form-label">Masa Berlaku SKDU</label>
                        <div class="input-group date" id="masa_berlaku_skdu" data-target-input="nearest">
                            <input type="text" id="masa_berlaku_skdu" name="masa_berlaku_skdu" class="form-control datetimepicker-input" data-target="#masa_berlaku_skdu" />
                            <div class="input-group-append" data-target="#masa_berlaku_skdu" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_pjbu">File PJBU</label>
                        <input type="file" class="form-control" id="file_pjbu" name="file_pjbu" >
                    </div>
                    <div class="form-group">
                        <label for="nama_pjbu" class="col-form-label">Nama PJBU</label>
                        <input id="nama_pjbu" name="nama_pjbu" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="jenis_identitas_pjbu" class="col-form-label">Jenis Identitas PJBU</label>
                        <input id="jenis_identitas_pjbu" name="jenis_identitas_pjbu" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_ktp_pjbu" class="col-form-label">Nomor KTP PJBU</label>
                        <input id="nomor_ktp_pjbu" name="nomor_ktp_pjbu" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_paspor_pjbu" class="col-form-label">Nomor Paspor pjbu</label>
                        <input id="nomor_paspor_pjbu" name="nomor_paspor_pjbu" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_laporan_keuangan">File Laporan Keuangan</label>
                        <input type="file" class="form-control" id="file_laporan_keuangan" name="file_laporan_keuangan" >
                    </div>
                    <div class="form-group">
                        <label for="kekayaan_bersih" class="col-form-label">Kekayaan Bersih</label>
                        <input id="kekayaan_bersih" name="kekayaan_bersih" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="modal_disetor" class="col-form-label">Modal Disetor</label>
                        <input id="modal_disetor" name="modal_disetor" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nama_kantor_akuntan_publik" class="col-form-label">Nama Kantor Akuntan Publik</label>
                        <input id="nama_kantor_akuntan_publik" name="nama_kantor_akuntan_publik" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="alamat_kantor_akuntan_pulik" class="col-form-label">Alamat Kantor Akuntan Publik</label>
                        <input id="alamat_kantor_akuntan_pulik" name="alamat_kantor_akuntan_pulik" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_telepon_kantor_akuntan_publik" class="col-form-label">Nomor Telepon Kantor Akuntan Publik</label>
                        <input id="nomor_telepon_kantor_akuntan_publik" name="nomor_telepon_kantor_akuntan_publik" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nama_akuntan" class="col-form-label">Nama Akuntan</label>
                        <input id="nama_akuntan" name="nama_akuntan" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_laporan_keuangan" class="col-form-label">Nomor Laporan Keuangan</label>
                        <input id="nomor_laporan_keuangan" name="nomor_laporan_keuangan" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_laporan_keuangan" class="col-form-label">Tanggal Laporan Keuangan</label>
                        <div class="input-group date" id="tanggal_laporan_keuangan" data-target-input="nearest">
                            <input type="text" id="tanggal_laporan_keuangan" name="tanggal_laporan_keuangan" class="form-control datetimepicker-input" data-target="#tanggal_laporan_keuangan" />
                            <div class="input-group-append" data-target="#tanggal_laporan_keuangan" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pendapat_akuntan" class="col-form-label">Pendapat Akuntan</label>
                        <input id="pendapat_akuntan" name="pendapat_akuntan" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_struktur_organisasi_badan_usaha">File Struktur Organisasi Badan Usaha</label>
                        <input type="file" class="form-control" id="file_struktur_organisasi_badan_usaha" name="file_struktur_organisasi_badan_usaha" >
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_profile_badan_usaha">File Profile Badan Usaha</label>
                        <input type="file" class="form-control" id="file_profile_badan_usaha" name="file_profile_badan_usaha" >
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_ppm">File PPM</label>
                        <input type="file" class="form-control" id="file_ppm" name="file_ppm" >
                    </div>
                    <div class="form-group">
                        <label for="nomor_ppm" class="col-form-label">Nomor PPM</label>
                        <input id="nomor_ppm" name="nomor_ppm" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ppm" class="col-form-label">Tanggal PPM</label>
                        <div class="input-group date" id="tanggal_ppm" data-target-input="nearest">
                            <input type="text" id="tanggal_ppm" name="tanggal_ppm" class="form-control datetimepicker-input" data-target="#tanggal_ppm" />
                            <div class="input-group-append" data-target="#tanggal_ppm" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prosentase_saham_pma_ppm" class="col-form-label">Prosentase Saham PMA PPM</label>
                        <input id="prosentase_saham_pma_ppm" name="prosentase_saham_pma_ppm" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_ppm_perubahan">File PPM Perubahan</label>
                        <input type="file" class="form-control" id="file_ppm_perubahan" name="file_ppm_perubahan" >
                    </div>
                    <div class="form-group">
                        <label for="nomor_ppm_perubahan" class="col-form-label">Nomor PPM Perubahan</label>
                        <input id="nomor_ppm_perubahan" name="nomor_ppm_perubahan" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ppm_perubahan" class="col-form-label">Tanggal PPM Perubahan</label>
                        <div class="input-group date" id="tanggal_ppm_perubahan" data-target-input="nearest">
                            <input type="text" id="tanggal_ppm_perubahan" name="tanggal_ppm_perubahan" class="form-control datetimepicker-input" data-target="#tanggal_ppm_perubahan" />
                            <div class="input-group-append" data-target="#tanggal_ppm_perubahan" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prosentase_saham_pma_ppm_perubahan" class="col-form-label">Prosentase Saham PMA PPM Perubahan</label>
                        <input id="prosentase_saham_pma_ppm_perubahan" name="prosentase_saham_pma_ppm_perubahan" type="text" class="form-control"  />
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-pa">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Persyaratan Administratif-->


<!--Modal Edit Persyaratan Administratif-->
<div class="modal fade" id="editPAModal" tabindex="-1" role="dialog" aria-labelledby="editPAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-edit-persyaratan-administratif" method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPAModalLabel">Edit Persyaratan Administratif</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label" for="file_akta_pendirian_bu_edit">File Akta Pendirian BU</label>
                        <input type="file" class="form-control" id="file_akta_pendirian_bu_edit" name="file_akta_pendirian_bu_edit" >
                    </div>
                    <div class="form-group">
                        <label for="nama_notaris_edit" class="col-form-label">Nama Notaris</label>
                        <input id="nama_notaris_edit" name="nama_notaris_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="judul_akta_edit" class="col-form-label">Judul Akta</label>
                        <input id="judul_akta_edit" name="judul_akta_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_akta_edit" class="col-form-label">Tanggal Akta</label>
                        <div class="input-group date" id="tanggal_akta_edit" data-target-input="nearest">
                            <input type="text" id="tanggal_akta_edit" name="tanggal_akta_edit" class="form-control datetimepicker-input" data-target="#tanggal_akta_edit" />
                            <div class="input-group-append" data-target="#tanggal_akta_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nomor_akta_edit" class="col-form-label">Nomor Akta</label>
                        <input id="nomor_akta_edit" name="nomor_akta_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="maksud_tujuan_akta_edit" class="col-form-label">Maksud Tujuan Akta</label>
                        <input id="maksud_tujuan_akta_edit" name="maksud_tujuan_akta_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_pengesahan_sebagai_badan_hukum_edit">File Pengesahan Sebagai Badan Hukum</label>
                        <input type="file" class="form-control" id="file_pengesahan_sebagai_badan_hukum_edit" name="file_pengesahan_sebagai_badan_hukum_edit" >
                    </div>
                    <div class="form-group">
                        <label for="nomor_badan_hukum_edit" class="col-form-label">Nomor Badan Hukum</label>
                        <input id="nomor_badan_hukum_edit" name="nomor_badan_hukum_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tentang_badan_hukum_edit" class="col-form-label">Tentang Badan Hukum</label>
                        <input id="tentang_badan_hukum_edit" name="tentang_badan_hukum_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_badan_hukum_edit" class="col-form-label">Tanggal Badan Hukum</label>
                        <div class="input-group date" id="tanggal_badan_hukum_edit" data-target-input="nearest">
                            <input type="text" id="tanggal_badan_hukum_edit" name="tanggal_badan_hukum_edit" class="form-control datetimepicker-input" data-target="#tanggal_badan_hukum_edit" />
                            <div class="input-group-append" data-target="#tanggal_badan_hukum_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_npwp_edit">File NPWP</label>
                        <input type="file" class="form-control" id="file_npwp_edit" name="file_npwp_edit" >
                    </div>
                    <div class="form-group">
                        <label for="nomor_npwp_edit" class="col-form-label">Nomor NPWP</label>
                        <input id="nomor_npwp_edit" name="nomor_npwp_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_skdu_edit">File SKDU</label>
                        <input type="file" class="form-control" id="file_skdu_edit" name="file_skdu_edit" >
                    </div>
                    <div class="form-group">
                        <label for="instansi_penerbit_skdu_edit" class="col-form-label">Instansi Penerbit SKDU</label>
                        <input id="instansi_penerbit_skdu_edit" name="instansi_penerbit_skdu_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_skdu_edit" class="col-form-label">Nomor SKDU</label>
                        <input id="nomor_skdu_edit" name="nomor_skdu_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_skdu_edit" class="col-form-label">Tanggal SKDU</label>
                        <div class="input-group date" id="tanggal_skdu_edit" data-target-input="nearest">
                            <input type="text" id="tanggal_skdu_edit" name="tanggal_skdu_edit" class="form-control datetimepicker-input" data-target="#tanggal_skdu_edit" />
                            <div class="input-group-append" data-target="#tanggal_skdu_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="masa_berlaku_skdu_edit" class="col-form-label">Masa Berlaku SKDU</label>
                        <div class="input-group date" id="masa_berlaku_skdu_edit" data-target-input="nearest">
                            <input type="text" id="masa_berlaku_skdu_edit" name="masa_berlaku_skdu_edit" class="form-control datetimepicker-input" data-target="#masa_berlaku_skdu_edit" />
                            <div class="input-group-append" data-target="#masa_berlaku_skdu_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_pjbu_edit">File PJBU</label>
                        <input type="file" class="form-control" id="file_pjbu_edit" name="file_pjbu_edit" >
                    </div>
                    <div class="form-group">
                        <label for="nama_pjbu_edit" class="col-form-label">Nama PJBU</label>
                        <input id="nama_pjbu_edit" name="nama_pjbu_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="jenis_identitas_pjbu_edit" class="col-form-label">Jenis Identitas PJBU</label>
                        <input id="jenis_identitas_pjbu_edit" name="jenis_identitas_pjbu_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_ktp_pjbu_edit" class="col-form-label">Nomor KTP PJBU</label>
                        <input id="nomor_ktp_pjbu_edit" name="nomor_ktp_pjbu_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_paspor_pjbu_edit" class="col-form-label">Nomor Paspor pjbu</label>
                        <input id="nomor_paspor_pjbu_edit" name="nomor_paspor_pjbu_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_laporan_keuangan_edit">File Laporan Keuangan</label>
                        <input type="file" class="form-control" id="file_laporan_keuangan_edit" name="file_laporan_keuangan_edit" >
                    </div>
                    <div class="form-group">
                        <label for="kekayaan_bersih_edit" class="col-form-label">Kekayaan Bersih</label>
                        <input id="kekayaan_bersih_edit" name="kekayaan_bersih_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="modal_disetor_edit" class="col-form-label">Modal Disetor</label>
                        <input id="modal_disetor_edit" name="modal_disetor_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nama_kantor_akuntan_publik_edit" class="col-form-label">Nama Kantor Akuntan Publik</label>
                        <input id="nama_kantor_akuntan_publik_edit" name="nama_kantor_akuntan_publik_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="alamat_kantor_akuntan_pulik_edit" class="col-form-label">Alamat Kantor Akuntan Publik</label>
                        <input id="alamat_kantor_akuntan_pulik_edit" name="alamat_kantor_akuntan_pulik_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_telepon_kantor_akuntan_publik_edit" class="col-form-label">Nomor Telepon Kantor Akuntan Publik</label>
                        <input id="nomor_telepon_kantor_akuntan_publik_edit" name="nomor_telepon_kantor_akuntan_publik_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nama_akuntan_edit" class="col-form-label">Nama Akuntan</label>
                        <input id="nama_akuntan_edit" name="nama_akuntan_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_laporan_keuangan_edit" class="col-form-label">Nomor Laporan Keuangan</label>
                        <input id="nomor_laporan_keuangan_edit" name="nomor_laporan_keuangan_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_laporan_keuangan_edit" class="col-form-label">Tanggal Laporan Keuangan</label>
                        <div class="input-group date" id="tanggal_laporan_keuangan_edit" data-target-input="nearest">
                            <input type="text" id="tanggal_laporan_keuangan_edit" name="tanggal_laporan_keuangan_edit" class="form-control datetimepicker-input" data-target="#tanggal_laporan_keuangan_edit" />
                            <div class="input-group-append" data-target="#tanggal_laporan_keuangan_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pendapat_akuntan_edit" class="col-form-label">Pendapat Akuntan</label>
                        <input id="pendapat_akuntan_edit" name="pendapat_akuntan_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_struktur_organisasi_badan_usaha_edit">File Struktur Organisasi Badan Usaha</label>
                        <input type="file" class="form-control" id="file_struktur_organisasi_badan_usaha_edit" name="file_struktur_organisasi_badan_usaha_edit" >
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_profile_badan_usaha_edit">File Profile Badan Usaha</label>
                        <input type="file" class="form-control" id="file_profile_badan_usaha_edit" name="file_profile_badan_usaha_edit" >
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_ppm_edit">File PPM</label>
                        <input type="file" class="form-control" id="file_ppm_edit" name="file_ppm_edit" >
                    </div>
                    <div class="form-group">
                        <label for="nomor_ppm_edit" class="col-form-label">Nomor PPM</label>
                        <input id="nomor_ppm_edit" name="nomor_ppm_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ppm_edit" class="col-form-label">Tanggal PPM</label>
                        <div class="input-group date" id="tanggal_ppm_edit" data-target-input="nearest">
                            <input type="text" id="tanggal_ppm_edit" name="tanggal_ppm_edit" class="form-control datetimepicker-input" data-target="#tanggal_ppm_edit" />
                            <div class="input-group-append" data-target="#tanggal_ppm_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prosentase_saham_pma_ppm_edit" class="col-form-label">Prosentase Saham PMA PPM</label>
                        <input id="prosentase_saham_pma_ppm_edit" name="prosentase_saham_pma_ppm_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="file_ppm_perubahan_edit">File PPM Perubahan</label>
                        <input type="file" class="form-control" id="file_ppm_perubahan_edit" name="file_ppm_perubahan_edit" >
                    </div>
                    <div class="form-group">
                        <label for="nomor_ppm_perubahan_edit" class="col-form-label">Nomor PPM Perubahan</label>
                        <input id="nomor_ppm_perubahan_edit" name="nomor_ppm_perubahan_edit" type="text" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ppm_perubahan_edit" class="col-form-label">Tanggal PPM Perubahan</label>
                        <div class="input-group date" id="tanggal_ppm_perubahan_edit" data-target-input="nearest">
                            <input type="text" id="tanggal_ppm_perubahan_edit" name="tanggal_ppm_perubahan_edit" class="form-control datetimepicker-input" data-target="#tanggal_ppm_perubahan_edit" />
                            <div class="input-group-append" data-target="#tanggal_ppm_perubahan_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prosentase_saham_pma_ppm_perubahan_edit" class="col-form-label">Prosentase Saham PMA PPM Perubahan</label>
                        <input id="prosentase_saham_pma_ppm_perubahan_edit" name="prosentase_saham_pma_ppm_perubahan_edit" type="text" class="form-control"  />
                    </div>

                </div>
                <div class="modal-footer">
                    @if($permohonan->persyaratan_administratif)
                        <input type="hidden" id="uid_verifikasi_pa" name="uid_verifikasi_pa" value="{{ $permohonan->persyaratan_administratif->uid_verifikasi_pa }}">
                    @endif
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-edit-pa">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Edit Persyaratan Administratif-->


<!--Modal Tambah Akta Perubahan Badan Usaha Persyaratan Administratif-->
<div class="modal fade" id="addAktaPerubahanBuPaModal" tabindex="-1" role="dialog" aria-labelledby="addAktaPerubahanBuPaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-akta-perubahan-bu-pa" method="post" enctype="multipart/form-data" action="{{ url('akta-perubahan-bu-pa') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAktaPerubahanBuPaModalLabel">Tambah Akta Perubahan Badan Usaha</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="file_akta_pendirian_bu">File Akta Pendirian BU</label>
                        <input type="file" class="form-control" name="file_akta_pendirian_bu" >
                    </div>
                    <div class="form-group">
                        <label for="nama_notaris" class="col-form-label">Nama Notaris</label>
                        <input type="text" name="nama_notaris" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="judul_akta" class="col-form-label">Judul Akta</label>
                        <input type="text" name="judul_akta" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_akta" class="col-form-label">Tanggal Akta</label>
                        <input type="text" name="tanggal_akta" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="nomor_akta" class="col-form-label">Nomor Akta</label>
                        <input type="text" name="nomor_akta" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="hal_yang_diubah" class="col-form-label">Hal Yang Dirubah</label>
                        <textarea name="hal_yang_diubah" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file_akta_perubahan_bu" class="col-form-label">File Akta Perubahan BU</label>
                        <input type="file" class="form-control" name="file_akta_perubahan_bu" >
                    </div>
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_verifikasi_pa" value="">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-akta-perubahan-bu-pa">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Akta Perubahan Badan Usaha Persyaratan Administratif-->

<!--Modal Tambah Pengesahan Akta Perubahan-->
<div class="modal fade" id="addPengesahanAktaPerubahanModal" tabindex="-1" role="dialog" aria-labelledby="addPengesahanAktaPerubahanModallLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-pengesahan-akta-perubahan" method="post" enctype="multipart/form-data" action="{{ url('pengesahan-akta-perubahan') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPengesahanAktaPerubahanModallLabel">Tambah Pengesahan Akta Perubahan Badan Usaha</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="file_pengesahan_akta_perubahan">File Pengesahan Akta Perubahan</label>
                        <input type="file" class="form-control" name="file_pengesahan_akta_perubahan" >
                    </div>
                    <div class="form-group">
                        <label for="nomor" class="col-form-label">Nomor</label>
                        <input type="text" name="nomor" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tentang" class="col-form-label">Tentang</label>
                        <input type="text" name="tentang" class="form-control"  />
                    </div>
                    <div class="form-group">
                        <label for="tanggal" class="col-form-label">Tanggal</label>
                        <div class="input-group date" id="tanggal-pengesahan-akta-perubahan" data-target-input="nearest">
                            <input type="text" id="tanggal-pengesahan-akta-perubahan" name="tanggal" class="form-control datetimepicker-input" data-target="#tanggal-pengesahan-akta-perubahan" />
                            <div class="input-group-append" data-target="#tanggal-pengesahan-akta-perubahan" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_verifikasi_pa" value="">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-pengesahan-akta-perubahan">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Pengesahan Akta Perubahan-->
@endSection


