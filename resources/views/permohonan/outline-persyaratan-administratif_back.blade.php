@extends('layouts.app')

@section('page_title')
    Permohonan :: {{ $permohonan->uid_permohonan }}
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Detail Permohonan</h2>
@endsection

@section('additional_styles')

@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item">Permohonan</li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">
                    <i class="fas fa-book"></i> Informasi Permohonan
                </h4>
                <div class="toolbar ml-auto">
                   
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td style="width: 30%;">Jenis Usaha</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->jenis_usaha->nama_jenis_usaha }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Jenis Sertifikasi</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->jenis_sertifikasi }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Perpanjangan ke</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->perpanjangan_ke }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Nama Badan Usaha</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->badan_usaha->nama_badan_usaha }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Bentuk Badan Usaha</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->badan_usaha->bentuk_badan_usaha->nama_bentuk_badan_usaha }}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Provinsi</td>
                            <td style="width: 5%;">:</td>
                            <td style="">
                                {!! $permohonan->badan_usaha->kota->provinsi->nama_provinsi !!}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Alamat</td>
                            <td style="width: 5%;">:</td>
                            <td style="">
                                {!! $permohonan->badan_usaha->full_address !!}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Status</td>
                            <td style="width: 5%;">:</td>
                            <td style="">
                                {{ translate_status_permohonan($permohonan->status) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Nomor Agenda</td>
                            <td style="width: 5%;">:</td>
                            <td style="">
                                {{ $permohonan->nomor_agenda }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!--Row Asesor-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-title">
                    <i class="fa fa-users"></i> Asesor
                </h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 30%;">Asesor Tenaga Teknik</td>
                            <td style="width: 5%;">:</td>
                            <td style="">
                                @if($permohonan->asesor_tenaga_teknik)
                                    {{ $permohonan->asesor_tenaga_teknik->nama_asesor }}
                                @else
                                    <i> Belum ditetapkan</i>
                                @endif
                            </td>
                            <td>
                                @if($permohonan->asesor_tenaga_teknik && $permohonan->status=='0')
                                    <button id="btn-delete-asesor-tt" class="btn btn-danger btn-xs" data-uid-permohonan-asesor="{{ $permohonan->uid_permohonan_tt }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @else
                                    @if($permohonan->status == '0')
                                        <button id="btn-add-asesor-tt" class="btn btn-info btn-xs" data-uid-permohonan="{{ $permohonan->uid_permohonan }}" data-provinsi-id="{{ $permohonan->badan_usaha->kota->provinsi_uid}}">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Asesor Penanggung Jawab Teknik</td>
                            <td style="width: 5%;">:</td>
                            <td style="">
                                @if($permohonan->asesor_penanggung_jawab_teknik)
                                    {{ $permohonan->asesor_penanggung_jawab_teknik->nama_asesor }}
                                @else
                                    <i> Belum ditetapkan</i>
                                @endif
                            </td>
                            <td>
                                @if($permohonan->asesor_penanggung_jawab_teknik && $permohonan->status=='0')
                                    <button id="btn-delete-asesor-pjt" class="btn btn-danger btn-xs" data-uid-permohonan-asesor="{{ $permohonan->uid_permohonan_pjt }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @else
                                    @if($permohonan->status == '0')
                                        <button id="btn-add-asesor-pjt" class="btn btn-info btn-xs" data-uid-permohonan="{{ $permohonan->uid_permohonan }}" data-provinsi-id="{{ $permohonan->badan_usaha->kota->provinsi_uid}}">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--ENDRow Asesor-->

<!--Row Tabs-->
<div class="row">
    <div class="col-md-12">
        <div class="section-block">
            <h5 class="section-title">Data Verifikasi</h5>
            <p></p>
        </div>
        <div class="tab-outline">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-identitas-badan-usaha" href="{{ url('permohonan/'.$permohonan->uid_permohonan.'') }}" >
                        <i class="fas fa-file-alt"></i> Identitas Badan Usaha
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="tab-outline-persyaratan-administratif" href="{{ url('permohonan/'.$permohonan->uid_permohonan.'/outline-persyaratan-administratif') }}">
                        <i class="fas fa-file-alt"></i> Persyaratan Administratif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-persyaratan-teknis" href="{{ url('permohonan/'.$permohonan->uid_permohonan.'/outline-persyaratan-teknis') }}">
                        <i class="fas fa-file-alt"></i> Persyaratan Teknis
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-data-pengurus" href="{{ url('permohonan/'.$permohonan->uid_permohonan.'/outline-data-pengurus') }}">
                        <i class="fas fa-file-alt"></i> Data Pengurus
                    </a>
                </li>
            </ul>
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


<!--Row Change Next Status-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!--
                    Urutan Status
                    Frontdesk->Verifikator->Auditor->Validator->DJK (Evaluator, Top Approval, ...dst)
                !-->
                @if($permohonan->status == '0')
                    @if(\Auth::user()->can('view-permohonan-0'))
                        <a href="#" class="btn btn-primary btn-sm btn-change-status" data-next-status="1">
                            <i class="fa fa-check-circle"></i> Kirim ke Asesor TT
                        </a>
                    @endif
                @elseif($permohonan->status == '1')
                    @if(\Auth::user()->can('view-permohonan-1'))
                        <a href="#" class="btn btn-primary btn-sm btn-change-status" data-next-status="4">
                            <i class="fa fa-check-circle"></i> Kirim Ke Asesor PJT
                        </a>
                    @endif
                @elseif($permohonan->status == '4')
                    @if(\Auth::user()->can('view-permohonan-4'))
                        <a href="#" class="btn btn-primary btn-sm btn-change-status" data-next-status="5">
                            <i class="fa fa-check-circle"></i>&nbsp;Approve By Verifikator
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-change-status" data-next-status="1">
                            <i class="far fa-window-close"></i> Kembalikan
                        </a>
                    @endif
                @elseif($permohonan->status == '5')
                    @if(\Auth::user()->can('view-permohonan-5'))
                        <a href="#" class="btn btn-primary btn-sm btn-change-status" data-next-status="6">
                            <i class="fa fa-check-circle"></i>&nbsp; Approve by Auditor
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-change-status" data-next-status="1">
                             <i class="far fa-window-close"></i> Kembalikan
                        </a>
                    @endif
                @elseif($permohonan->status == '6')
                    @if(\Auth::user()->can('view-permohonan-6'))
                        <a href="#" class="btn btn-primary btn-sm btn-change-status" data-next-status="7">
                            Approve By Validator
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-change-status" data-next-status="1">
                            <i class="far fa-window-close"></i> Kembalikan
                        </a>
                    @endif
                @else
                    {{ translate_status_permohonan($permohonan->status) }}
                @endif
            </div>
        </div>
    </div>
</div>
<!--ENDRow Change Next Status-->

<!--Row Fasilitas Generate Nomor Agenda dan Tarik Nomor Sertifikat-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-title">
                    <i class="fa fa-th-list"></i> Generate Nomor Agenda dan Tarik Nomor Sertifikat
                </h5>
            </div>
            <div class="card-body">
                <button id="btn-generate-nomor-agenda" class="btn btn-info" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                    <i class="fa fa-barcode"></i> Generate Nomor Agenda
                </button>
                <button id="btn-tarik-nomor-sertifikat" class="btn btn-primary" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                    <i class="fa fa-barcode"></i> Tarik Nomor Sertifikat
                </button>
            </div>
        </div>
    </div>
</div>
<!--ENDRow Fasilitas Generate Nomor Agenda dan Tarik Nomor Sertifikat-->

<!--Row List Sertifikat-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-title">
                    <i class="fa fa-th-list"></i> List Sertifikat
                </h5>
            </div>
            <div class="card-body">
                @if($sertifikat->count())
                <div class="list-group">
                    @foreach($sertifikat as $sert)
                        <a href="{{ url('sertifikat/'.$sert->id.'/print-pdf') }}" class="list-group-item list-group-item-action">
                            <i class="fa fa-print"></i> {{ $sert->sub_bidang->nama_sub_bidang }}
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--ENDRow List Sertifikat-->

<!--Row Log status permohonan-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-title">
                    <i class="fa fa-clock"></i> Log Perubahan Status
                </h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th style="width: 50%;">Catatan</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($permohonan->log_permohonan)
                            @foreach($log_permohonan as $log)
                            <tr>
                                <td>{{ translate_log_from_to($log->from_to) }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Tidak ada log</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--ENDRow Log status permohonan-->

<!--Row Status DJK-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-title">
                    <i class="fa fa-clock"></i> Status DJK
                </h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tahap</th>
                            <th>Keterangan Tahap</th>
                            <th>Status</th>
                            <th>Keterangan Status</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($status_djk)
                        <tr>
                            <td>{{ $status_djk->tahap }}</td>
                            <td>{{ $status_djk->keterangan_tahap }}</td>
                            <td>{{ $status_djk->status }}</td>
                            <td>{{ $status_djk->keterangan_status }}</td>
                            <td>{{ $status_djk->updated_at }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--ENDRow Status DJK-->

<!--Modal Change Status-->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-change-status" method="post" action="{{ url('permohonan/change-status') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel">Ubah Status Permohonan</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p id="change_status_confirmation_text"></p>
                    <div class="form-group">
                        <label for="log_description" class="col-form-label">Description</label>
                        <textarea name="log_description" id="log_description" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="permohonan_original_status" id="permohonan_original_status" value="{{ $permohonan->status }}" />
                    <input type="hidden" name="permohonan_next_status" id="permohonan_next_status" />
                    <input type="hidden" name="permohonan_id_to_change" id="permohonan_id_to_change" value="{{ $permohonan->uid_permohonan }}" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Change Status-->

<!--Modal Add Asesor TT-->
<div class="modal fade" id="addAsesorTTModal" tabindex="-1" role="dialog" aria-labelledby="addAsesorTTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-asesor-tt" method="post" action="{{ url('permohonan/add-asesor-tt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAsesorTTModalLabel">Tetapkan Asesor TT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="asesor_tt_id" class="col-form-label">Asesor TT</label>
                        <select name="asesor_tt_id" id="asesor_tt_id" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="peran" class="col-form-label">Peran</label>
                        <select name="peran" id="peran" class="form-control" required>
                            <option>--Pilih Peran--</option>
                            <option value="KETUA">Ketua</option>
                            <option value="ANGGOTA">Anggota</option>
                        </select>
                    </div>
                    <input type="hidden" name="uid_permohonan_to_add_asesor_tt" id="uid_permohonan_to_add_asesor_tt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-submit-asesor-tt">
                        <i class="fa fa-save"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Asesor TT-->

<!--Modal Delete Asesor TT-->
<div class="modal fade" id="deleteAsesorTTModal" tabindex="-1" role="dialog" aria-labelledby="deleteAsesorTTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <form id="form-delete-asesor-tt" method="post" action="{{ url('permohonan/delete-asesor-tt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAsesorTTModalLabel">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning">
                        Klik Hapus untuk menghapus asesor TT
                    </p>
                    <input type="hidden" name="uid_permohonan_asesor_tt" id="uid_permohonan_asesor_tt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-xs" id="btn-submit-delete-asesor-tt">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Asesor TT-->

<!--Modal Add Asesor PJT-->
<div class="modal fade" id="addAsesorPJTModal" tabindex="-1" role="dialog" aria-labelledby="addAsesorPJTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-asesor-pjt" method="post" action="{{ url('permohonan/add-asesor-pjt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAsesorPJTModalLabel">Tambah Asesor PJT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="asesor_pjt_id" class="col-form-label">Asesor PJT</label>
                        <select name="asesor_pjt_id" id="asesor_pjt_id" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="peran" class="col-form-label">Peran</label>
                        <select name="peran" id="peran" class="form-control" required>
                            <option>--Pilih Peran--</option>
                            <option value="KETUA">Ketua</option>
                            <option value="ANGGOTA">Anggota</option>
                        </select>
                    </div>
                    <input type="hidden" name="uid_permohonan_to_add_asesor_pjt" id="uid_permohonan_to_add_asesor_pjt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-submit-asesor-pjt">
                        <i class="fa fa-save"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Asesor PJT-->

<!--Modal Delete Asesor PJT-->
<div class="modal fade" id="deleteAsesorPJTModal" tabindex="-1" role="dialog" aria-labelledby="deleteAsesorPJTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <form id="form-delete-asesor-pjt" method="post" action="{{ url('permohonan/delete-asesor-pjt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAsesorPJTModalLabel">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="alert alert-warning">
                        Klik Hapus untuk menghapus asesor PJT
                    </p>
                    <input type="hidden" name="uid_permohonan_asesor_pjt" id="uid_permohonan_asesor_pjt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-xs" id="btn-submit-delete-asesor-pjt">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Asesor PJT-->


@endsection

@section('additional_scripts')
<script type="text/javascript" src="{{ url('assets/vendor/autonumeric/autoNumeric.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //Prepare all datetime picker instances
        if ($("#tanggal_surat").length) {
            $('#tanggal_surat').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }

    //Block Identitas Badan Usaha
        //Handler Tambah Identitas Badan Usaha
        $('#form-tambah-identitas-badan-usaha').on('submit', function(event){
            event.preventDefault();
            var addIBUData = new FormData($(this)[0]);
            addIBUData.append('uid_permohonan','{{ $permohonan->uid_permohonan }}');
            $('#btn-add-ibu').prop('disabled', true).html('<i class="fa fa-hourglass"></i> Processing');
            $.ajax({
                method: 'POST',
                url: '{{ url('identitas-badan-usaha') }}', 
                data: addIBUData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#addIBUModal').modal('hide');
                        alertify.notify(response.message, 'success', 2, function(){
                          location.reload();
                        });
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){  console.log('dismissed'); });
                        $('#btn-add-ibu').prop('disabled', false).html('Tambah');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    console.log(message);
                    console.log(errors);
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                    alertify.notify(error_template, textStatus, 10, function(){});
                    $('#btn-add-ibu').prop('disabled', false).html('Tambah');
                }
            });
        });
        //ENDHandler Tambah Identitas Badan Usaha

        //Handler Edit Identitas Badan Usaha
        $('#form-edit-identitas-badan-usaha').on('submit', function(event){
            event.preventDefault();
            var editIBUData = new FormData($(this)[0]);
            editIBUData.append('uid_permohonan','{{ $permohonan->uid_permohonan }}');
            $('#btn-edit-ibu').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            $.ajax({
                method: 'POST',
                url: '{{ url('identitas-badan-usaha/edit') }}', 
                data: editIBUData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#editIBUModal').modal('hide');
                        alertify.notify(response.message, 'success', 5, function(){
                          location.reload();
                        });
                    } else{
                        $('#editIBUModal').modal('hide');
                        alertify.notify(response.message, 'error', 5, function(){  console.log('dismissed'); });
                        $('#btn-edit-ibu').prop('disabled', false).html('Edit');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    console.log(message);
                    console.log(errors);
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                    alertify.notify(error_template, textStatus, 10, function(){});
                    $('#btn-edit-ibu').prop('disabled', false).html('Edit');
                }
            });
        });
        //ENDHandler Edit Identitas Badan Usaha

        //Handler Show Edit IBU Modal
        $('#editIBUModal').on('show.bs.modal', function(){
            $.ajax({
                type: 'GET',
                url: '{{ url('permohonan') }}/{{ $permohonan->uid_permohonan }}/identitas-badan-usaha', 
                success: function (response) {
                    if(response.data != null){
                        //Update modal edit Identitas Badan Usaha form fields
                        $('#nomor_surat_edit').val(response.data.nomor_surat);
                        $('#perihal_edit').val(response.data.perihal);
                        $('#tanggal_surat_edit').datetimepicker({
                            format: 'YYYY-MM-DD',
                            defaultDate: response.data.tanggal_surat
                        });
                        $('#nama_penandatangan_surat_edit').val(response.data.nama_penandatangan_surat);
                        $('#jabatan_penandatangan_surat_edit').val(response.data.jabatan_penandatangan_surat);
                    }
                    
                },
                error: function(){ 
                    console.log(response);
                }
            });
        });
        //ENDHandler Show Edit IBU Modal


        //Handler Pull IBU Trigger
            $('#btn-pull-ibu-trigger').on('click', function(event){
                event.preventDefault();
                $('#form-pull-identitas-badan-usaha').find("input[name=uid_permohonan]").val($(this).attr('data-uid_permohonan'));
                $('#pullIBUModal').modal('show');
            });
        //ENDHandler Pull IBU Trigger

        //Hanlder pull IBU submission
        $('#form-pull-identitas-badan-usaha').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'), 
                data: $(this).serialize(),
                beforeSend:function(){
                    $('#btn-pull-ibu').prop('disabled', true);
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#pullIBUModal').modal('hide');
                        alertify.notify(response.message, 'success', 2, function(){
                            location.reload();
                        });
                       
                    } else{
                        
                        alertify.notify(response.message, 'error', 5, function(){  console.log('dismissed'); });
                        $('#btn-pull-ibu').prop('disabled', false).html('Tarik');
                        $("#form-pull-persyaratan-administratif")[0].reset();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    console.log(objResponse);
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    console.log(message);
                    console.log(errors);
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                    alertify.notify(error_template, textStatus, 10, function(){});
                    $('#btn-pull-ibu').prop('disabled', false).html('Tarik');

                }
            });

        });
        //ENDHanlder pull IBU submission

    //ENDBlock Identitas Badan Usaha


    //Block Persyaratan Administratif
        if ($("#tanggal_akta").length) {
            $('#tanggal_akta').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }
        if ($("#tanggal_badan_hukum").length) {
            $('#tanggal_badan_hukum').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }
        if ($("#tanggal_skdu").length) {
            $('#tanggal_skdu').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }
        if ($("#masa_berlaku_skdu").length) {
            $('#masa_berlaku_skdu').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }
        if ($("#tanggal_laporan_keuangan").length) {
            $('#tanggal_laporan_keuangan').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }
        if ($("#tanggal_ppm").length) {
            $('#tanggal_ppm').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }
        if ($("#tanggal_ppm_perubahan").length) {
            $('#tanggal_ppm_perubahan').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }
        //Handle Tambah Persyaratan Administratif
        $('#form-tambah-persyaratan-administratif').on('submit', function(event){
            event.preventDefault();
            var addPAData = new FormData($(this)[0]);
            addPAData.append('uid_permohonan','{{ $permohonan->uid_permohonan }}');
            $('#btn-add-pa').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            $.ajax({
                method: 'POST',
                url: '{{ url('persyaratan-administratif') }}', 
                data: addPAData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#addPAModal').modal('hide');
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                        fetchPersyaratanAdministratif();
                        $('#btn-add-pa').prop('disabled', false).html('Tambah');
                        $("#form-tambah-persyaratan-administratif")[0].reset();
                        location.reload();
                    } else{
                        console.log(response);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    console.log(message);
                    console.log(errors);
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                    alertify.notify(error_template, textStatus, 10, function(){});
                    $('#btn-add-pa').prop('disabled', false).html('Tambah');
                }
            });
        });

        //Handler Pull Persyaratan Administratif
        $('#form-pull-persyaratan-administratif').on('submit', function(event){
            event.preventDefault();
            var pullPAData = new FormData($(this)[0]);
            pullPAData.append('uid_permohonan','{{ $permohonan->uid_permohonan }}');
            $('#btn-pull-pa').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            $.ajax({
                method: 'POST',
                url: '{{ url('persyaratan-administratif/pull-from-gatrik') }}', 
                data: pullPAData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#pullPAModal').modal('hide');
                        alertify.notify(response.message, 'success', 2, function(){
                            location.reload();
                        });
                       
                    } else{
                        $('#pullPAModal').modal('hide');
                        alertify.notify(response.message, 'error', 5, function(){  console.log('dismissed'); });
                        fetchPersyaratanAdministratif();
                        $('#btn-pull-pa').prop('disabled', false).html('Tarik');
                        $("#form-pull-persyaratan-administratif")[0].reset();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    console.log(objResponse);
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    console.log(message);
                    console.log(errors);
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                    alertify.notify(error_template, textStatus, 10, function(){});
                    $('#btn-pull-pa').prop('disabled', false).html('Tarik');

                }
            });
        });
        //ENDHandler Pull Persyaratan Administratif

        //Handler Edit Persyaratan Administratif
        $('#form-edit-persyaratan-administratif').on('submit', function(event){
            event.preventDefault();
            var editPAData = new FormData($(this)[0]);
            editPAData.append('uid_permohonan','{{ $permohonan->uid_permohonan }}');
            $('#btn-edit-pa').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            $.ajax({
                method: 'POST',
                url: '{{ url('persyaratan-administratif/edit') }}', 
                data: editPAData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#editPAModal').modal('hide');
                        alertify.notify(response.message, 'success', 5, function(){
                          location.reload();
                        });
                    } else{
                        $('#editPAModal').modal('hide');
                        alertify.notify(response.message, 'error', 5, function(){  console.log('dismissed'); });
                        $('#btn-edit-pa').prop('disabled', false).html('Edit');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    console.log(message);
                    console.log(errors);
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                    alertify.notify(error_template, textStatus, 10, function(){});
                    $('#btn-edit-pa').prop('disabled', false).html('Edit');
                }
            });
        });
        //ENDHandler Edit Persyaratan Administratif

        //Handler Show Edit Persyaratan Administratif Modal
        $('#editPAModal').on('show.bs.modal', function(){
            $.ajax({
                type: 'GET',
                url: '{{ url('permohonan') }}/{{ $permohonan->uid_permohonan }}/persyaratan-administratif', 
                success: function (response) {
                    if(response.data != null){
                        $('#nama_notaris_edit').val(response.data.nama_notaris);
                        $('#judul_akta_edit').val(response.data.judul_akta);
                        $('#tanggal_akta_edit').datetimepicker({
                            format: 'YYYY-MM-DD',
                            defaultDate: response.data.tanggal_akta
                        });
                        $('#nomor_akta_edit').val(response.data.nomor_akta);
                        $('#maksud_tujuan_akta_edit').val(response.data.maksud_tujuan_akta);
                        $('#nomor_badan_hukum_edit').val(response.data.nomor_badan_hukum);
                        $('#tentang_badan_hukum_edit').val(response.data.tentang_badan_hukum);
                        $('#tanggal_badan_hukum_edit').datetimepicker({
                            format: 'YYYY-MM-DD',
                            defaultDate: response.data.tanggal_badan_hukum
                        });
                        $('#nomor_npwp_edit').val(response.data.nomor_npwp);
                        $('#instansi_penerbit_skdu_edit').val(response.data.instansi_penerbit_skdu);
                        $('#nomor_skdu_edit').val(response.data.nomor_skdu);
                        $('#tanggal_skdu_edit').datetimepicker({
                            format: 'YYYY-MM-DD',
                            defaultDate: response.data.tanggal_skdu
                        });
                        $('#masa_berlaku_skdu_edit').datetimepicker({
                            format: 'YYYY-MM-DD',
                            defaultDate: response.data.masa_berlaku_skdu
                        });
                        $('#nama_pjbu_edit').val(response.data.nama_pjbu);
                        $('#jenis_identitas_pjbu_edit').val(response.data.jenis_identitas_pjbu);
                        $('#nomor_ktp_pjbu_edit').val(response.data.nomor_ktp_pjbu);
                        $('#nomor_paspor_pjbu_edit').val(response.data.nomor_paspor_pjbu);
                        $('#kekayaan_bersih_edit').val(response.data.kekayaan_bersih);
                        $('#modal_disetor_edit').val(response.data.modal_disetor);
                        $('#nama_kantor_akuntan_publik_edit').val(response.data.nama_kantor_akuntan_publik);
                        $('#alamat_kantor_akuntan_pulik_edit').val(response.data.alamat_kantor_akuntan_pulik);
                        $('#nomor_telepon_kantor_akuntan_publik_edit').val(response.data.nomor_telepon_kantor_akuntan_publik);
                        $('#nama_akuntan_edit').val(response.data.nama_akuntan);
                        $('#nomor_laporan_keuangan_edit').val(response.data.nomor_laporan_keuangan);
                        $('#tanggal_laporan_keuangan_edit').datetimepicker({
                            format: 'YYYY-MM-DD',
                            defaultDate: response.data.tanggal_laporan_keuangan
                        });
                        $('#pendapat_akuntan_edit').val(response.data.pendapat_akuntan);
                        $('#nomor_ppm_edit').val(response.data.nomor_ppm);
                        $('#tanggal_ppm_edit').datetimepicker({
                            format: 'YYYY-MM-DD',
                            defaultDate: response.data.tanggal_ppm
                        });
                        $('#prosentase_saham_pma_ppm_edit').val(response.data.prosentase_saham_pma_ppm);
                        $('#nomor_ppm_perubahan_edit').val(response.data.nomor_ppm_perubahan);
                        $('#tanggal_ppm_perubahan_edit').datetimepicker({
                            format: 'YYYY-MM-DD',
                            defaultDate: response.data.tanggal_ppm_perubahan
                        });
                        $('#prosentase_saham_pma_ppm_perubahan_edit').val(response.data.prosentase_saham_pma_ppm_perubahan);
                    }
                    
                },
                error: function() { 
                     console.log(response);
                }
            });
        });
        //ENDHandler Show Edit Persyaratan Administratif Modal

        //Block Tambah Akta Perubahan Badan Usaha Persyaratan Administratif Trigger
        $('#btn-add-akta-perubahan-bu-pa-trigger').on('click', function(event){
            event.preventDefault();
            let uid_verifikasi_pa = $(this).attr('data-uid_verifikasi_pa');
            $('#form-add-akta-perubahan-bu-pa').find("input[name=uid_verifikasi_pa]").val(uid_verifikasi_pa);
            $('#addAktaPerubahanBuPaModal').modal('show');
        });
        //ENDBlock Tambah Akta Perubahan Badan Usaha Persyaratan Administratif Trigger

        //Block Submit Akta Perubahan Badan Usaha Persyaratan Administratif
        $('#form-add-akta-perubahan-bu-pa').on('submit', function(event){
            event.preventDefault();
            var addAktaPerubahanBuPaData = new FormData($(this)[0]);
            $('#btn-add-akta-perubahan-bu-pa').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'), 
                data: addAktaPerubahanBuPaData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#addAktaPerubahanBuPaModal').modal('hide');
                        alertify.notify(response.message, 'success', 2, function(){
                            $("#form-add-akta-perubahan-bu-pa")[0].reset();
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-add-akta-perubahan-bu-pa').prop('disabled', false).html('Submit');
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 10, function(){
                        $('#btn-add-akta-perubahan-bu-pa').prop('disabled', false).html('Submit');    
                    });
                    
                }
            });
        });
        //ENDBlock Submit Akta Perubahan Badan Usaha Persyaratan Administratif

        //Block Pull Akta Perubahan Badan Usaha Persyaratan Administratif
        $('#btn-pull-akta-perubahan-bu-pa').on('click', function(event){
            event.preventDefault();
            let uid_verifikasi_pa = $(this).attr('data-uid_verifikasi_pa');
            $.ajax({
                method: 'POST',
                url: "{{ url('akta-perubahan-bu-pa/pull-from-gatrik') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'uid_verifikasi_pa='+uid_verifikasi_pa,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){

                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 10, function(){
                        console.log(errors);
                    });
                    
                }
            });

        });
        //ENDBlock Pull Akta Perubahan Badan Usaha Persyaratan Administratif


        //Block Tambah Pengesahan Akta Perubahan Badan Usaha Trigger
        $('#btn-add-pengesahan-akta-perubahan-trigger').on('click', function(event){
            event.preventDefault();
            let uid_verifikasi_pa = $(this).attr('data-uid_verifikasi_pa');
            $('#form-add-pengesahan-akta-perubahan #tanggal-pengesahan-akta-perubahan').datetimepicker({
                    format: 'YYYY-MM-DD',
            });
            $('#form-add-pengesahan-akta-perubahan').find("input[name=uid_verifikasi_pa]").val(uid_verifikasi_pa);
            $('#addPengesahanAktaPerubahanModal').modal('show');
        });
        //ENDBlock Tambah Pengesahan Akta Perubahan Badan Usaha Trigger

        //Block Submit Tambah Pengesahan Akta Perubahan
        $('#form-add-pengesahan-akta-perubahan').on('submit', function(event){
            event.preventDefault();
            var addPengesahanAktaPerubahanData = new FormData($(this)[0]);
            
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'), 
                data: addPengesahanAktaPerubahanData,
                processData: false,
                contentType: false,
                beforeSend:function(){
                    $('#btn-add-pengesahan-akta-perubahan').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');        
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#addPengesahanAktaPerubahanModal').modal('hide');
                        alertify.notify(response.message, 'success', 2, function(){
                            $("#form-add-pengesahan-akta-perubahan")[0].reset();
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-add-pengesahan-akta-perubahan').prop('disabled', false).html('Submit');
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 10, function(){
                        $('#btn-add-pengesahan-akta-perubahan').prop('disabled', false).html('Submit');    
                    });
                    
                }
            });
        });
        //ENDBlock Submit Tambah Pengesahan Akta Perubahan

        //Block Pull Pengesahan Akta Perubahan
        $('#btn-pull-pengesahan-akta-perubahan').on('click', function(event){
            event.preventDefault();
            let uid_verifikasi_pa = $(this).attr('data-uid_verifikasi_pa');
            $.ajax({
                method: 'POST',
                url: "{{ url('pengesahan-akta-perubahan/pull-from-gatrik') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'uid_verifikasi_pa='+uid_verifikasi_pa,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){

                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 10, function(){
                        console.log(errors);
                    });
                    
                }
            });

        });
        //ENDBlock Pull Pengesahan Akta Perubahan



    //ENDBlock Persyaratan Administratif


    //Block Persyaratan Teknis

            //Select Sub Bidang
            $('#uid_sub_bidang_opt').select2({
                placeholder : 'Pilih Sub Bidang',
                ajax: {
                url: '{!! url('persyaratan-teknis/selectSubBidang') !!}',
                  dataType: 'json',
                  delay: 250,
                  data: function (params) {
                        return {
                            q: params.term,
                            page: params.page,
                            jenis_usaha_uid:"{{ $permohonan->jenis_usaha_uid }}"
                        };
                    },
                  processResults: function (data) {
                    return {
                      results:  $.map(data, function (item) {
                            return {
                                text: item.nama_sub_bidang,
                                id: item.uid_sub_bidang,
                            }
                        })
                    };
                  },
                  cache: true
                },
                allowClear : true,
            });

            //Trigger delete persyaratan teknis
            $('.btn-trigger-delete-persyaratan-teknis').on('click', function(event){
                event.preventDefault();
                let uid_verifikasi_pt = $(this).attr('data-uid-verifikasi-pt');
                $('#uid_verifikasi_pt_to_delete').val(uid_verifikasi_pt);
                $('#delete-confirmation-text').html($(this).attr('data-delete-confirmation-text'));
                $('#deletePTModal').modal('show');

            });
            $('#form-delete-persyaratan-teknis').on('submit', function(){
                $('#btn-delete-persyaratan-teknis').prop('disabled', true);
            });

            //Block Trigger Tarik Persyaratan Teknis Penanggung Jawab Teknik
            $('.btn-pull-ptpjt-trigger').on('click', function(event){
                let uid_verifikasi_pt = $(this).attr('data-uid-verifikasi-pt');
                let uid_permohonan = $(this).attr('data-uid-permohonan');
                event.preventDefault();
                $('#form-pull-ptpjt').find("input[name=uid_verifikasi_pt]").val(uid_verifikasi_pt);
                $('#form-pull-ptpjt').find("input[name=uid_permohonan]").val(uid_permohonan);
                $('#pullPTPJTModal').modal('show');
            });
            //ENDBlock Trigger Tarik Persyaratan Teknis Penanggung Jawab Teknik

            //Block Tarik Persyaratan Teknis Penanggung Jawab Teknik
            $('#form-pull-ptpjt').on('submit', function(event){
                event.preventDefault();
                var pullPTPJTData = new FormData($(this)[0]);
                $('#btn-pull-ptpjt').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'), 
                    data: pullPTPJTData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            $('#pullPTPJTModal').modal('hide');
                            alertify.notify(response.message, 'success', 2, function(){
                                location.reload();
                                //console.log(response);
                            });
                           
                        } else{
                            $('#pullPTPJTModal').modal('hide');
                            alertify.notify(response.message, 'error', 5, function(){  console.log('dismissed'); });
                            $('#btn-pull-ptpjt').prop('disabled', false).html('Tarik');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        console.log(objResponse);
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        console.log(message);
                        console.log(errors);
                            if(errors){
                                $.each( errors, function( key, value ) {
                                    console.log(value);
                                    error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                                });
                            }
                        alertify.notify(error_template, textStatus, 10, function(){});
                        $('#btn-pull-ptpjt').prop('disabled', false).html('Tarik');

                    }
                });
            });
            //ENDBlock Tarik Persyaratan Teknis Penanggung Jawab Teknik

            //Block Trigger Tambah Persyaratan Teknis Penanggung Jawab Teknik
            $('.btn-add-ptpjt-trigger').on('click', function(event){
                event.preventDefault();
                let uid_verifikasi_pt = $(this).attr('data-uid-verifikasi-pt');
                let uid_permohonan = $(this).attr('data-uid-permohonan');
                event.preventDefault();
                $('#form-add-ptpjt').find("input[name=uid_verifikasi_pt]").val(uid_verifikasi_pt);
                $('#form-add-ptpjt').find("input[name=uid_permohonan]").val(uid_permohonan);
                $('#addPTPJTModal').modal('show');
            });
            //ENDBlock Trigger Tambah Persyaratan Teknis Penanggung Jawab Teknik

            //Block Submit Tambah Persyaratan Teknis Penanggung Jawab Teknik
            $('#form-add-ptpjt').on('submit', function(event){
                event.preventDefault();
                var addPTPJTData = new FormData($(this)[0]);
                $('#btn-add-ptpjt').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'), 
                    data: addPTPJTData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            $('#addPTPJTModal').modal('hide');
                            alertify.notify(response.message, 'success', 2, function(){
                                $("#form-add-ptpjt")[0].reset();
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-add-ptpjt').prop('disabled', false).html('Submit');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            $('#btn-add-ptpjt').prop('disabled', false).html('Submit');    
                        });
                        
                    }
                });
            });
            //ENDBlock Submit Tambah Persyaratan Teknis Penanggung Jawab Teknik

            //Block Trigger Delete Persyaratan Teknis Penanggung Jawab Teknik
            $('.btn-delete-ptpjt-trigger').on('click', function(event){
                event.preventDefault();
                let uid_ver_pt_pjt = $(this).attr('data-uid-ver-pt-pjt');
                let uid_verifikasi_pt = $(this).attr('data-uid-verifikasi-pt');
                let uid_permohonan = $(this).attr('data-uid-permohonan');

                $('#form-delete-ptpjt').find("input[name=uid_ver_pt_pjt]").val(uid_ver_pt_pjt);
                $('#form-delete-ptpjt').find("input[name=uid_verifikasi_pt]").val(uid_verifikasi_pt);
                $('#form-delete-ptpjt').find("input[name=uid_permohonan]").val(uid_permohonan);
                $('#deletePTPJTModal').modal('show');
            });
            //ENDBlock Trigger Delete Persyaratan Teknis Penanggung Jawab Teknik

        

        //Block Sertifikat Persyaratan Teknis Penanggung Jawab Teknik
            //Block add sertifikat pt pjt trigger
            $('.btn-add-sertifikat-pt-pjt-trigger').on('click', function(event){
                event.preventDefault();
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                let uid_verifikasi_pt = $(this).attr('data-uid_verifikasi_pt');
                let uid_ver_pt_pjt = $(this).attr('data-uid_ver_pt_pjt');
                $('#form-add-sertifikat-pt-pjt #tgl_sertifikat').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
                $('#form-add-sertifikat-pt-pjt').find("input[name=uid_permohonan]").val(uid_permohonan);
                $('#form-add-sertifikat-pt-pjt').find("input[name=uid_verifikasi_pt]").val(uid_verifikasi_pt);
                $('#form-add-sertifikat-pt-pjt').find("input[name=uid_ver_pt_pjt]").val(uid_ver_pt_pjt);
                $('#addSertifikatPtPjtModal').modal('show');
            });
            //ENDBlock add sertifikat pt pjt trigger

            //Block Submit Sertifikat PT PJT
            $('#form-add-sertifikat-pt-pjt').on('submit',function(event){
                event.preventDefault();
                var addSertifikatPtPjtData = new FormData($(this)[0]);
                $('#btn-add-sertifikat-pt-pjt').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'), 
                    data: addSertifikatPtPjtData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            $('#addSertifikatPtPjtModal').modal('hide');
                            alertify.notify(response.message, 'success', 2, function(){
                                $("#form-add-sertifikat-pt-pjt")[0].reset();
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-add-sertifikat-pt-pjt').prop('disabled', false).html('Submit');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            $('#btn-add-sertifikat-pt-pjt').prop('disabled', false).html('Submit');    
                        });
                        
                    }
                });

            });
            //ENDBlock Submit Sertifikat PT PJT

            //Block pull sertifikat pt pjt
            $('.btn-pull-sertifikat-pt-pjt-trigger').on('click', function(event){
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                let uid_verifikasi_pt = $(this).attr('data-uid_verifikasi_pt');
                $.ajax({
                    method: 'POST',
                    url: "{{ url('sertifikat-pt-pjt/pull-from-gatrik') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'uid_verifikasi_pt='+uid_verifikasi_pt+'&uid_permohonan='+uid_permohonan,
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){

                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                        });
                        
                    }
                });

            });
            //ENDBlock pull sertifikat pt pjt 

            //Block Delete Sertifikat PT PJT
            $('.btn-delete-sertifikat-pt-pjt-trigger').on('click', function(event){
                event.preventDefault();
                let id = $(this).attr('data-id');
                $('#form-delete-sertifikat-pt-pjt').find("input[name=id]").val(id);
                $('#deleteSertifikatPtPjtModal').modal('show');
            });
            //ENDBlock Delete Sertifikat PT PJT

            //Block Delete Sertifikat PT PJT
            $('#form-delete-sertifikat-pt-pjt').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){

                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                        });
                        
                    }
                });
            });
            //ENDBlock Delete Sertifikat PT PJT

        //ENDBlock Sertifikat Persyaratan Teknis Penanggung Jawab Teknik


            //Block Pull Persyaratan Teknis Tenaga Teknik
            $('.btn-pull-pttt-trigger').on('click', function(event){
                let uid_verifikasi_pt = $(this).attr('data-uid_verifikasi_pt');
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                $.ajax({
                    method: 'POST',
                    url: "{{ url('persyaratan-teknis-tt/pull-from-gatrik') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'uid_verifikasi_pt='+uid_verifikasi_pt+'&uid_permohonan='+uid_permohonan,
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){

                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                        });
                        
                    }
                });

            });
            //ENDBlock Pull Persyaratan Teknis Tenaga Teknik

            //Block Add Persyaratan Teknis Tenaga Teknik trigger
            $('.btn-add-pttt-trigger').on('click', function(event){
                event.preventDefault();
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                let uid_verifikasi_pt = $(this).attr('data-uid_verifikasi_pt');
                $('#form-add-pt-tt').find("input[name=uid_permohonan]").val(uid_permohonan);
                $('#form-add-pt-tt').find("input[name=uid_verifikasi_pt]").val(uid_verifikasi_pt);
                $('#addPtTtModal').modal('show');
            });
            //ENDBlock Add Persyaratan Teknis Tenaga Teknik trigger

            //Block Submit Tambah Persyaratan Teknis Tenaga Teknik
            $('#form-add-pt-tt').on('submit', function(event){
                event.preventDefault();
                var addPtTtData = new FormData($(this)[0]);
                $('#btn-add-pt-tt').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'), 
                    data: addPtTtData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            $('#addPtTtModal').modal('hide');
                            alertify.notify("Tenaga Teknik ditambahkan", 'success', 2, function(){
                                $("#form-add-pt-tt")[0].reset();
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-add-pt-tt').prop('disabled', false).html('Submit');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            $('#btn-add-pt-tt').prop('disabled', false).html('Submit');    
                        });
                        
                    }
                });
            });
            //ENDBlock Submit Tambah Persyaratan Teknis Tenaga Teknik

            //Block Trigger Delete Persyaratan Teknis Tenaga Teknik
            $('.btn-delete-pttt-trigger').on('click', function(event){
                event.preventDefault();
                let uid_ver_pt_tt = $(this).attr('data-uid_ver_pt_tt');
                let uid_verifikasi_pt = $(this).attr('data-uid_verifikasi_pt');
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                

                $('#form-delete-pt-tt').find("input[name=uid_ver_pt_tt]").val(uid_ver_pt_tt);
                $('#form-delete-pt-tt').find("input[name=uid_verifikasi_pt]").val(uid_verifikasi_pt);
                $('#form-delete-pt-tt').find("input[name=uid_permohonan]").val(uid_permohonan);
                $('#deletePtTtModal').modal('show');
            });
            //ENDBlock Trigger Delete Persyaratan Teknis Tenaga Teknik

            //Block Submit Delete Persyaratan Teknis TEnaga teknik
            $('#form-delete-pt-tt').on('submit', function(event){
                event.preventDefault();
                $('#btn-delete-pt-tt').prop('disabled', true);
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-delete-pt-tt').prop('disabled', false);
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                            $('#btn-delete-pt-tt').prop('disabled', false);
                        });
                        
                    }
                });
            });
            //ENDBlock Submit Delete Persyaratan Teknis TEnaga teknik

            //Block pull sertifikat Persyaratan Teknis TT
            $('.btn-pull-sertifikat-pt-tt-trigger').on('click', function(event){
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                let uid_verifikasi_pt = $(this).attr('data-uid_verifikasi_pt');
                $.ajax({
                    method: 'POST',
                    url: "{{ url('sertifikat-pt-tt/pull-from-gatrik') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'uid_verifikasi_pt='+uid_verifikasi_pt+'&uid_permohonan='+uid_permohonan,
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){

                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                        });
                        
                    }
                });

            });
            //ENDBlock pull sertifikat Persyaratan Teknis TT 

            //Block Add Sertifikat Persyaratan Teknis TT Trigger
            $('.btn-add-sertifikat-pt-tt-trigger').on('click', function(event){
                event.preventDefault();
                let uid_ver_pt_tt = $(this).attr('data-uid_ver_pt_tt');
                let uid_verifikasi_pt = $(this).attr('data-uid_verifikasi_pt');
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                $('#form-add-sertifikat-pt-tt').find("input[name=uid_ver_pt_tt]").val(uid_ver_pt_tt);
                $('#form-add-sertifikat-pt-tt').find("input[name=uid_verifikasi_pt]").val(uid_verifikasi_pt);
                $('#form-add-sertifikat-pt-tt').find("input[name=uid_permohonan]").val(uid_permohonan);
                $('#form-add-sertifikat-pt-tt #tgl_sertifikat_sert_pt_tt').datetimepicker({
                    format: 'YYYY-MM-DD',
                });
                $('#addSertifikatPtTtModal').modal('show');
            });
            //ENDBlock Add Sertifikat Persyaratan Teknis TT Trigger

            //Block Submit Add Sertifikat Persyaratan Teknis Tenaga Teknik
            $('#form-add-sertifikat-pt-tt').on('submit', function(event){
                event.preventDefault();
                var addSertifikatPtTtData = new FormData($(this)[0]);
                $('#btn-add-sertifikat-pt-tt').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'), 
                    data: addSertifikatPtTtData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                $("#form-add-sertifikat-pt-tt")[0].reset();
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-add-sertifikat-pt-tt').prop('disabled', false).html('Submit');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            $('#btn-add-sertifikat-pt-tt').prop('disabled', false).html('Submit');    
                        });
                        
                    }
                });
            });
            //ENDBlock Submit Add Sertifikat Persyaratan Teknis Tenaga Teknik

            //Block Delete Sertifikat Persyaratan Teknis Tenaga Teknik
            $('.btn-delete-sertifikat-pt-tt-trigger').on('click', function(event){
                event.preventDefault();
                $('#form-delete-sertifikat-pt-tt').find("input[name=id]").val($(this).attr('data-id'));
                $('#deleteSertifikatPtTtModal').modal('show');
            });
            //ENDBlock Delete Sertifikat Persyaratan Teknis Tenaga Teknik

            //Block Submit Delete Sertifikat Persyaratan Teknis Tenaga Teknik
            $('#form-delete-sertifikat-pt-tt').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){

                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                        });
                        
                    }
                });
            });
            //ENDBlock Submit Delete Sertifikat Persyaratan Teknis Tenaga Teknik

    //ENDBlock Persyaratan Teknis


    //Block Data Pengurus Dewan Komisaris

            //Block Pull Data Pengurus Dewan Komisaris
            $('#btn-pull-dp-dk-trigger').on('click', function(event){
                event.preventDefault();
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                
                $.ajax({
                    method: 'POST',
                    url: "{{ url('data-pengurus-dewan-komisaris/pull-from-gatrik') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'uid_permohonan='+uid_permohonan,
                    beforeSend:function(){
                        $('#btn-pull-dp-dk-trigger').prop('disabled', true).html('Processing..');        
                    },
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                //console.log(response);
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-pull-dp-dk-trigger').prop('disabled', false).html('<i class="fa fa-sync"></i> Tarik');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 5, function(){
                            console.log(errors);
                            $('#btn-pull-dp-dk-trigger').prop('disabled', false).html('<i class="fa fa-sync"></i> Tarik');
                        });
                        
                    }
                });
            });
            //ENDBlock Pull Data Pengurus Dewan Komisaris

            //Block Tambah Data Pengurus Dewan Komisaris
            $('#form-add-dp-dk').on('submit', function(event){
                event.preventDefault();
                $('#btn-add-dp-dk').prop('disabled', true);
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-add-dp-dk').prop('disabled', false);
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                            $('#btn-add-dp-dk').prop('disabled', false);
                        });
                        
                    }
                });
            });
            //ENDBlock Tambah Data Pengurus Dewan Komisaris

            //Block Delete Data Pengurus Dewan Komisaris Trigger
            $('.btn-delete-dp-dk-trigger').on('click', function(event){
                event.preventDefault();
                let id = $(this).attr('data-id');
                $('#form-delete-dp-dk').find("input[name=id]").val(id);
                $('#deleteDpDkModal').modal('show');
            });
            //ENDBlock Delete Data Pengurus Dewan Komisaris Trigger

            //Block Submit Delete Data Pengurus Dewan Komisaris
            $('#form-delete-dp-dk').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    beforeSend:function(){
                        $('#btn-delete-dp-dk').prop('disabled', true).html('Processing..');        
                    },
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                //console.log(response);
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-delete-dp-dk').prop('disabled', false).html('Hapus');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 5, function(){
                            console.log(errors);
                            $('#btn-delete-dp-dk').prop('disabled', false).html('Hapus');
                        });
                        
                    }
                });
            });
            //ENDBlock Submit Delete Data Pengurus Dewan Komisaris

    //ENDBlock Data Pengurus Dewan Komisaris


    //Block Data Pengurus Dewan Direksi

            //Block Tambah Data Pengurus Dewan Direksi
            $('#form-add-dp-dd').on('submit', function(event){
                event.preventDefault();
                $('#btn-add-dp-dd').prop('disabled', true);
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-add-dp-dd').prop('disabled', false);
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                            $('#btn-add-dp-dd').prop('disabled', false);
                        });
                        
                    }
                });
            });
            //ENDBlock Tambah Data Pengurus Dewan Direksi

            //Block Delete Data Pengurus Dewan Direksi Trigger
            $('.btn-delete-dp-dd-trigger').on('click', function(event){
                event.preventDefault();
                let id = $(this).attr('data-id');
                $('#form-delete-dp-dd').find("input[name=id]").val(id);
                $('#deleteDpDdModal').modal('show');
            });
            //ENDBlock Delete Data Pengurus Dewan Direksi Trigger

            //Block Submit Delete Data Pengurus Dewan Direksi
            $('#form-delete-dp-dd').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    beforeSend:function(){
                        $('#btn-delete-dp-dd').prop('disabled', true).html('Processing..');        
                    },
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                //console.log(response);
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-delete-dp-dd').prop('disabled', false).html('Hapus');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 5, function(){
                            console.log(errors);
                            $('#btn-delete-dp-dd').prop('disabled', false).html('Hapus');
                        });
                        
                    }
                });
            });
            //ENDBlock Submit Delete Data Pengurus Dewan Direksi

            //Block Pull Data Pengurus Dewan Direksi
            $('#btn-pull-dp-dd-trigger').on('click', function(event){
                event.preventDefault();
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                
                $.ajax({
                    method: 'POST',
                    url: "{{ url('data-pengurus-dewan-direksi/pull-from-gatrik') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'uid_permohonan='+uid_permohonan,
                    beforeSend:function(){
                        $('#btn-pull-dp-dd-trigger').prop('disabled', true).html('Processing..');        
                    },
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                //console.log(response);
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-pull-dp-dd-trigger').prop('disabled', false).html('<i class="fa fa-sync"></i> Tarik');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 5, function(){
                            console.log(errors);
                            $('#btn-pull-dp-dd-trigger').prop('disabled', false).html('<i class="fa fa-sync"></i> Tarik');
                        });
                        
                    }
                });
            });
            //EDNBlock Pull Data Pengurus Dewan Direksi

    //ENDBlock Data Pengurus Dewan Direksi

    //Block Data Pengurus Pemegang Saham
            //Set autonumerical inputs
            $('#form-add-dp-ps .autonumerical').autoNumeric('init',{
                aSep:',',
                aDec:'.',
                mDec:'0',
            });
            //Block Tambah Data Pengurus Pemegang Saham
            $('#form-add-dp-ps').on('submit', function(event){
                event.preventDefault();
                $('#btn-add-dp-ps').prop('disabled', true);
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                $('#form-add-dp-ps')[0].reset();
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-add-dp-ps').prop('disabled', false);
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 10, function(){
                            console.log(errors);
                            $('#btn-add-dp-ps').prop('disabled', false);
                        });
                        
                    }
                });
            });
            //ENDBlock Tambah Data Pengurus Pemegang Saham

            //Block Delete Data Pengurus Dewan Direksi Trigger
            $('.btn-delete-dp-ps-trigger').on('click', function(event){
                event.preventDefault();
                let id = $(this).attr('data-id');
                $('#form-delete-dp-ps').find("input[name=id]").val(id);
                $('#deleteDpPsModal').modal('show');
            });
            //ENDBlock Delete Data Pengurus Dewan Direksi Trigger

            //Block Submit Delete Data Pengurus Pemegang Saham
            $('#form-delete-dp-ps').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    beforeSend:function(){
                        $('#btn-delete-dp-ps').prop('disabled', true).html('Processing..');        
                    },
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                //console.log(response);
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-delete-dp-ps').prop('disabled', false).html('Hapus');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 5, function(){
                            console.log(errors);
                            $('#btn-delete-dp-ps').prop('disabled', false).html('Hapus');
                        });
                        
                    }
                });
            });
            //ENDBlock Submit Delete Data Pengurus Pemegang Saham

            //Block Pull Data Pengurus Pemegang Saham
            $('#btn-pull-dp-ps-trigger').on('click', function(event){
                event.preventDefault();
                let uid_permohonan = $(this).attr('data-uid_permohonan');
                
                $.ajax({
                    method: 'POST',
                    url: "{{ url('data-pengurus-pemegang-saham/pull-from-gatrik') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'uid_permohonan='+uid_permohonan,
                    beforeSend:function(){
                        $('#btn-pull-dp-ps-trigger').prop('disabled', true).html('Processing..');        
                    },
                    success: function(response){
                        console.log(response);
                        if(response.response == 1){
                            alertify.notify(response.message, 'success', 2, function(){
                                //console.log(response);
                                location.reload();
                            });
                            
                        } else{
                            alertify.notify(response.message, 'error', 5, function(){
                                $('#btn-pull-dp-ps-trigger').prop('disabled', false).html('<i class="fa fa-sync"></i> Tarik');
                            });
                            
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        let objResponse = jqXHR.responseJSON;
                        let message = objResponse.message;
                        let errors = objResponse.errors;
                        let error_template = message;
                        
                        if(errors){
                            $.each( errors, function( key, value ) {
                                console.log(value);
                                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                            });
                        }
                        alertify.notify(error_template, textStatus, 5, function(){
                            console.log(errors);
                            $('#btn-pull-dp-ps-trigger').prop('disabled', false).html('<i class="fa fa-sync"></i> Tarik');
                        });
                        
                    }
                });
            });
            //EDNBlock Pull Data Pengurus Pemegang Saham

    //ENDBlock Data Pengurus Pemegang Saham
    
        //Handler Change status
        $('.btn-change-status').on('click', function(event){
            event.preventDefault();
            var permohonan_next_status = $(this).attr('data-next-status');
            var text_next_status = $(this).text();
            $('#change_status_confirmation_text').html(text_next_status);
            $('#changeStatusModalLabel').html(text_next_status);
            $('#permohonan_next_status').val(permohonan_next_status);
            $('#changeStatusModal').modal('show');

        });
        //ENDHandler Change status

    //Block Asesor
        var selected_provinsi_id = null;
        //Block Select Asesor TT
        $('#asesor_tt_id').select2({
            placeholder : 'Pilih Asesor TT',
            ajax: {
            url: '{!! url('asesor/select2') !!}',
              dataType: 'json',
              delay: 250,
              data: function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                        provinsi_id : selected_provinsi_id
                    };
                },
              processResults: function (data) {
                return {
                  results:  $.map(data, function (item) {
                        return {
                            text: item.nama_asesor,
                            id: item.uid_asesor,
                        }
                    })
                };
              },
              cache: true
            },
            allowClear : true,
        });
        //ENDBlock Select Asesor TT

        //Block Add Asesor TT
        $('#btn-add-asesor-tt').on('click', function(){
            event.preventDefault();
            selected_provinsi_id = $(this).attr('data-provinsi-id');
            $('#uid_permohonan_to_add_asesor_tt').val($(this).attr('data-uid-permohonan'));
            $('#addAsesorTTModal').modal('show');
        });
        $('#form-add-asesor-tt').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend:function(){
                    $('#btn-submit-asesor-tt').prop('disabled', true).html('Processing...');
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            $('#form-add-asesor-tt')[0].reset();
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-submit-asesor-tt').prop('disabled', false);
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 10, function(){
                        console.log(errors);
                        $('#btn-submit-asesor-tt').prop('disabled', false);
                    });
                    
                }
            });
        });
        //ENDBlock Add Asesor TT

        //Block Delete Asessor TT
        $('#btn-delete-asesor-tt').on('click', function(event){
            event.preventDefault();
            var uid_permohonan_asesor_tt = $(this).attr('data-uid-permohonan-asesor');
            $('#uid_permohonan_asesor_tt').val(uid_permohonan_asesor_tt);
            $('#deleteAsesorTTModal').modal('show');
        });
        $('#form-delete-asesor-tt').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend:function(){
                    $('#btn-submit-delete-asesor-tt').prop('disabled', true).html('Processing...');
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            $('#form-delete-asesor-tt')[0].reset();
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-submit-delete-asesor-tt').prop('disabled', false);
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 10, function(){
                        console.log(errors);
                        $('#btn-submit-delete-asesor-tt').prop('disabled', false);
                    });
                    
                }
            });
        });
        //ENDBlock Delete Asessor TT
        
        //Block Select Asesor PJT
        $('#asesor_pjt_id').select2({
            placeholder : 'Pilih Asesor PJT',
            ajax: {
            url: '{!! url('asesor/select2') !!}',
              dataType: 'json',
              delay: 250,
              data: function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                        provinsi_id : selected_provinsi_id
                    };
                },
              processResults: function (data) {
                return {
                  results:  $.map(data, function (item) {
                        return {
                            text: item.nama_asesor,
                            id: item.uid_asesor,
                        }
                    })
                };
              },
              cache: true
            },
            allowClear : true,
        });
        //ENDBlock Select Asesor PJT

        //Block Add Asesor PJT
        $('#btn-add-asesor-pjt').on('click', function(){
            event.preventDefault();
            selected_provinsi_id = $(this).attr('data-provinsi-id');
            $('#uid_permohonan_to_add_asesor_pjt').val($(this).attr('data-uid-permohonan'));
            $('#addAsesorPJTModal').modal('show');
        });
        $('#form-add-asesor-pjt').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend:function(){
                    $('#btn-submit-asesor-pjt').prop('disabled', true).html('Processing...');
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            $('#form-add-asesor-pjt')[0].reset();
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-submit-asesor-pjt').prop('disabled', false).html('<i class="fa fa-save"></i> Submit');
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 10, function(){
                        console.log(errors);
                        $('#btn-submit-asesor-pjt').prop('disabled', false).html('<i class="fa fa-save"></i> Submit');
                    });
                    
                }
            });
        });
        //ENDBlock Add Asesor PJT

        //Block Delete Asesor PJT
        $('#btn-delete-asesor-pjt').on('click', function(event){
            event.preventDefault();
            var uid_permohonan_asesor_pjt = $(this).attr('data-uid-permohonan-asesor');
            $('#uid_permohonan_asesor_pjt').val(uid_permohonan_asesor_pjt);
            $('#deleteAsesorPJTModal').modal('show');
        });

        $('#form-delete-asesor-pjt').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend:function(){
                    $('#btn-submit-delete-asesor-pjt').prop('disabled', true).html('Processing...');
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            $('#form-delete-asesor-pjt')[0].reset();
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-submit-delete-asesor-pjt').prop('disabled', false);
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 10, function(){
                        console.log(errors);
                        $('#btn-submit-delete-asesor-pjt').prop('disabled', false);
                    });
                    
                }
            });
        });
        //ENDBlock Delete Asesor PJT
    //ENDBlock Asesor

        //Block Generate Nomor Agenda
        $('#btn-generate-nomor-agenda').on('click', function(event){
            event.preventDefault();
            let uid_permohonan = $(this).attr('data-uid_permohonan');
            $.ajax({
                method: 'POST',
                url: "{{ url('permohonan/generate-nomor-agenda') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'uid_permohonan='+uid_permohonan,
                beforeSend:function(){
                    $('#btn-generate-nomor-agenda').prop('disabled', true).html('<i class="fa fa-barcode"></i> Processing..');        
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            //console.log(response);
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-generate-nomor-agenda').prop('disabled', false).html('<i class="fa fa-barcode"></i> Generate Nomor Agenda');
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 5, function(){
                        console.log(errors);
                        $('#btn-generate-nomor-agenda').prop('disabled', false).html('<i class="fa fa-barcode"></i> Generate Nomor Agenda');
                    });
                    
                }
            });

        });
        //ENDBlock Generate Nomor Agenda

        //Block Tarik Nomor Sertifikat
        $('#btn-tarik-nomor-sertifikat').on('click', function(event){
            event.preventDefault();
            let uid_permohonan = $(this).attr('data-uid_permohonan');
            $.ajax({
                method: 'POST',
                url: "{{ url('permohonan/tarik-nomor-sertifikat') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'uid_permohonan='+uid_permohonan,
                beforeSend:function(){
                    $('#btn-tarik-nomor-sertifikat').prop('disabled', true).html('<i class="fa fa-barcode"></i> Processing..');        
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            //console.log(response);
                            location.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-tarik-nomor-sertifikat').prop('disabled', false).html('<i class="fa fa-barcode"></i> Tarik Nomor Sertifikat');
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 5, function(){
                        console.log(errors);
                        $('#btn-tarik-nomor-sertifikat').prop('disabled', false).html('<i class="fa fa-barcode"></i> Tarik Nomor Sertifikat');
                    });
                    
                }
            });

        });
        //ENDBlock Tarik Nomor Sertifikat
    });

    

</script>
@endsection

