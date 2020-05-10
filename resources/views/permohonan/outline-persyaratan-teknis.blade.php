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
                <!--Tab Pane Persyaratan Teknis-->
                <div class="tab-pane fade show active" id="outline-persyaratan-teknis" role="tabpanel" aria-labelledby="tab-outline-persyaratan-teknis">
                    <!--Card Data Persyaratan Teknis-->
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4 class="card-header-title">
                                Persyaratan Teknis
                            </h4>
                            <div class="toolbar ml-auto">
                               <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                                @if($permohonan->status == '0' || $permohonan->status == '1')
                                    <a href="#" class="btn btn-light btn-xs"  data-toggle="modal" data-target="#pullPTModal" title="Tarik Persyaratan Teknis">
                                        <i class="fas fa-sync"></i> Tarik
                                    </a>
                                    <a href="#" class="btn btn-light btn-xs"  data-toggle="modal" data-target="#addPTModal">
                                        <i class="fas fa-plus-circle"></i> Tambah
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if(!is_null($persyaratan_teknis))
                                @foreach($persyaratan_teknis as $pt)
                                    <!--Block Persyaratan Teknis-->
                                    <div class="card">
                                        <div class="card-header d-flex">
                                            <h5 class="card-header-title">
                                                {{ $pt->sub_bidang->nama_sub_bidang }}
                                                <!-- ({{ $pt->uid_verifikasi_pt }}) -->
                                            </h5>
                                            <div class="toolbar ml-auto">
                                                <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                                                @if($permohonan->status == '0' || $permohonan->status == '1')
                                                <button type="button" class="btn btn-danger btn-xs btn-trigger-delete-persyaratan-teknis" data-uid-verifikasi-pt="{{ $pt->uid_verifikasi_pt }}" title="Hapus Sub Bidang" data-delete-confirmation-text="Hapus Persyaratan Teknis Sub Bidang {{ $pt->sub_bidang->nama_sub_bidang}}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <!--Block Persyaratan Teknis Penanggung Jawab Teknis-->
                                            <div class="card">
                                                <div class="card-header d-flex">
                                                    <h5 class="card-header-title">
                                                        A. Penanggung Jawab Teknik
                                                    </h5>
                                                    <div class="toolbar ml-auto">
                                                        <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                                                        @if($permohonan->status == '0' || $permohonan->status == '1')
                                                        <button type="button" class="btn btn-light btn-xs btn-pull-ptpjt-trigger" title="Tarik Persyaratan Teknis Penanggung Jawab Teknik" data-uid-verifikasi-pt="{{ $pt->uid_verifikasi_pt }}" data-uid-permohonan="{{ $permohonan->uid_permohonan }}">
                                                            <i class="fas fa-sync"></i> Tarik PJT
                                                        </button>
                                                        <button type="button" class="btn btn-light btn-xs btn-add-ptpjt-trigger" title="Tambah Persyaratan Teknis Penanggung Jawab Teknik" data-uid-verifikasi-pt="{{ $pt->uid_verifikasi_pt }}" data-uid-permohonan="{{ $permohonan->uid_permohonan }}">
                                                            <i class="fas fa-plus-circle"></i> Tambah PJT
                                                        </button>
                                                        <button type="button" class="btn btn-xs btn-light btn-pull-sertifikat-pt-pjt-trigger" title="Tarik Serkom" data-uid_verifikasi_pt="{{ $pt->uid_verifikasi_pt }}" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                                                            <i class="fa fa-sync"></i> Tarik Sertifikat PJT
                                                        </button>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th>Jenis Identitas / No.Identitas</th>
                                                                <th>No. HP</th>
                                                                <th style="width: 25%;text-align: center;">Sertifikat</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if($pt->persyaratan_teknis_penanggung_jawab_teknis->count())
                                                            @foreach($pt->persyaratan_teknis_penanggung_jawab_teknis as $ptpjt)
                                                            <tr>
                                                                <td>{{ $ptpjt->nama }}</td>
                                                                <td>
                                                                    {{ $ptpjt->jenis_identitas }} /
                                                                    @if($ptpjt->jenis_identitas == 'KTP')
                                                                        {{ $ptpjt->nomor_ktp }}
                                                                    @else
                                                                        {{ $ptpjt->nomor_passpor }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $ptpjt->nomor_hp }}</td>
                                                                <td>
                                                                    @if($ptpjt->sertifikat_pt_pjt->count())
                                                                        <p>
                                                                            Nomor Sertifikat : {{ $ptpjt->sertifikat_pt_pjt->first()->no_serkom }}
                                                                        </p>
                                                                        <p>
                                                                            Nomor Registrasi : {{ $ptpjt->sertifikat_pt_pjt->first()->noreg_serkom }}
                                                                        </p>
                                                                        <button type="button" class="btn btn-xs btn-danger btn-delete-sertifikat-pt-pjt-trigger" title="Hapus Serkom" data-uid_permohonan="{{ $permohonan->uid_permohonan}}" data-uid_verifikasi_pt="{{ $pt->uid_verifikasi_pt }}" data-uid_ver_pt_pjt="{{ $ptpjt->uid_ver_pt_pjt }}" data-id="{{ $ptpjt->sertifikat_pt_pjt->first()->id }}">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    @else
                                                                        <button type="button" class="btn btn-xs btn-primary btn-add-sertifikat-pt-pjt-trigger" title="Upload Serkom" data-uid_permohonan="{{ $permohonan->uid_permohonan}}" data-uid_verifikasi_pt="{{ $pt->uid_verifikasi_pt }}" data-uid_ver_pt_pjt="{{ $ptpjt->uid_ver_pt_pjt }}">
                                                                            <i class="fa fa-plus-circle"></i>
                                                                        </button>
                                                                    @endif
                                                                    
                                                                    
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-rounded btn-danger btn-xs btn-delete-ptpjt-trigger" title="Hapus Penanggung Jawab Teknik" data-uid-ver-pt-pjt="{{ $ptpjt->uid_ver_pt_pjt }}" data-uid-verifikasi-pt="{{ $ptpjt->uid_verifikasi_pt }}" data-uid-permohonan="{{ $ptpjt->uid_permohonan }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="5">Tidak ada data</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                
                                                </div>
                                            </div>
                                            <!--Block Persyaratan Teknis Penanggung Jawab Teknis-->

                                            <!--Block Persyaratan Teknis Tenaga Teknik-->
                                            <div class="card">
                                                <div class="card-header d-flex">
                                                    <h5 class="card-header-title">
                                                        B. Tenaga Teknik
                                                    </h5>
                                                    <div class="toolbar ml-auto">
                                                        <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                                                        @if($permohonan->status == '0' || $permohonan->status == '1')
                                                        <button type="button" class="btn btn-light btn-xs btn-pull-pttt-trigger" title="Tarik Persyaratan Teknis Tenaga Teknik" data-uid_verifikasi_pt="{{ $pt->uid_verifikasi_pt }}" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                                                            <i class="fas fa-sync"></i> Tarik TT
                                                        </button>
                                                        <button type="button" class="btn btn-light btn-xs btn-add-pttt-trigger" title="Tambah Persyaratan Teknis Tenaga Teknik" data-uid_verifikasi_pt="{{ $pt->uid_verifikasi_pt }}" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                                                            <i class="fas fa-plus-circle"></i> Tambah TT
                                                        </button>
                                                        <button type="button" class="btn btn-xs btn-light btn-pull-sertifikat-pt-tt-trigger" title="Tarik Serkom" data-uid_verifikasi_pt="{{ $pt->uid_verifikasi_pt }}" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                                                            <i class="fa fa-sync"></i> Tarik Sertifikat TT
                                                        </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th>Jenis Identitas / No.Identitas</th>
                                                                <th>No. HP</th>
                                                                <th style="width: 25%;text-align: center;">Sertifikat</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if($pt->persyaratan_teknis_tenaga_teknik->count())
                                                                @foreach($pt->persyaratan_teknis_tenaga_teknik as $pttt)
                                                                <tr>
                                                                    <td>{{ $pttt->nama }}</td>
                                                                    <td>
                                                                        {{ $pttt->jenis_identitas }} /
                                                                        @if($pttt->jenis_identitas == 'KTP')
                                                                            {{ $pttt->nomor_ktp }}
                                                                        @else
                                                                            {{ $pttt->nomor_passpor }}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $pttt->nomor_hp }}</td>
                                                                    <td>
                                                                        @if($pttt->sertifikat_pt_tt->count())
                                                                            <p>
                                                                                Nomor Sertifikat : {{ $pttt->sertifikat_pt_tt->first()->no_serkom }}
                                                                            </p>
                                                                            <p>
                                                                                Nomor Registrasi : {{ $pttt->sertifikat_pt_tt->first()->noreg_serkom }}
                                                                            </p>
                                                                            <button type="button" class="btn btn-xs btn-danger btn-delete-sertifikat-pt-tt-trigger" title="Hapus Serkom" data-uid_permohonan="{{ $permohonan->uid_permohonan}}" data-uid_verifikasi_pt="{{ $pt->uid_verifikasi_pt }}" data-uid_ver_pt_tt="{{ $pttt->uid_ver_pt_tt }}" data-id="{{ $pttt->sertifikat_pt_tt->first()->id }}">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        @else
                                                                            <button type="button" class="btn btn-xs btn-primary btn-add-sertifikat-pt-tt-trigger" title="Upload Serkom" data-uid_permohonan="{{ $permohonan->uid_permohonan}}" data-uid_verifikasi_pt="{{ $pt->uid_verifikasi_pt }}" data-uid_ver_pt_tt="{{ $pttt->uid_ver_pt_tt }}">
                                                                                <i class="fa fa-plus-circle"></i>
                                                                            </button>
                                                                        @endif
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-rounded btn-danger btn-xs btn-delete-pttt-trigger" title="Hapus Tenaga Teknik" data-uid_ver_pt_tt="{{ $pttt->uid_ver_pt_tt }}" data-uid_verifikasi_pt="{{ $pttt->uid_verifikasi_pt }}" data-uid_permohonan="{{ $pttt->uid_permohonan }}">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="5">Tidak ada data</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--ENDBlock Persyaratan Teknis Tenaga Teknik-->
                                        </div>
                                    </div>
                                    <!--ENDBlock Persyaratan Teknis-->
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!--ENDCard Data Persyaratan Teknis-->

                    <!--Card Form Verifikasi Persyaratan Teknis-->
                    @include('permohonan.components.form-verifikasi-pt')
                    <!--ENDCard Form Verifikasi Persyaratan Teknis-->

                </div>
                <!--ENDTab Pane Persyaratan Teknis-->

            </div>
        </div>
    </div>
</div>
<!--ENDRow Tabs-->
<!--Modal Tarik Persyaratan Teknis-->
<div class="modal fade" id="pullPTModal" tabindex="-1" role="dialog" aria-labelledby="pullPTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-pull-persyaratan-teknis" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis/pull-from-gatrik/'.$permohonan->uid_permohonan.'') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="pullPTModalLabel">Tarik Persyaratan Teknis</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>Tarik data Persyaratan Teknis dari gatrik</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-pull-pt">Tarik</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tarik Persyaratan Teknis-->

<!--Modal Tambah Persyaratan Teknis-->
<div class="modal fade" id="addPTModal" tabindex="-1" role="dialog" aria-labelledby="addPTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-persyaratan-teknis" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPTModalLabel">Tambah Persyaratan Teknis</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="uid_sub_bidang" class="col-form-label">Sub Bidang</label>
                        <select name="uid_sub_bidang" id="uid_sub_bidang_opt" class="form-control" style="width: 100%;" required></select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="uid_permohonan" value="{{ $permohonan->uid_permohonan }}">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-persyaratan-teknis">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Persyaratan Teknis-->

<!--Modal Hapus Persyaratan Teknis-->
<div class="modal fade" id="deletePTModal" tabindex="-1" role="dialog" aria-labelledby="deletePTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <form id="form-delete-persyaratan-teknis" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis/delete') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePTModalLabel">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    
                    <text id="delete-confirmation-text"></text>


                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_permohonan" value="{{ $permohonan->uid_permohonan }}">
                    <input type="hidden" id="uid_verifikasi_pt_to_delete" name="uid_verifikasi_pt_to_delete" value="">
                    <button class="btn btn-default btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-xs" id="btn-delete-persyaratan-teknis">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Hapus Persyaratan Teknis-->


<!--Modal Tarik Persyaratan Teknis Penanggung Jawab Teknis-->
<div class="modal fade" id="pullPTPJTModal" tabindex="-1" role="dialog" aria-labelledby="pullPTPJTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-pull-ptpjt" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis-pjt/pull-from-gatrik') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="pullPTPJTModalLabel">Tarik Persyaratan Teknis Penanggung Jawab Teknik</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>Tarik data Persyaratan Teknis Penanggung Jawab Teknik dari gatrik</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="uid_verifikasi_pt" value=""/>
                    <input type="hidden" name="uid_permohonan" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-pull-ptpjt">Tarik</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tarik Persyaratan Teknis Penanggung Jawab Teknis-->


<!--Modal Tambah Persyaratan Teknis Penanggung Jawab Teknis-->
<div class="modal fade" id="addPTPJTModal" tabindex="-1" role="dialog" aria-labelledby="addPTPJTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-ptpjt" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis-pjt') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPTPJTModalLabel">Tambah Persyaratan Teknis Penanggung Jawab Teknik</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_identitas" class="col-form-label">Jenis Identitas</label>
                        <select name="jenis_identitas" class="form-control" style="width: 100%;" required>
                            <option value="">--Pilih--</option>
                            <option value="KTP">KTP</option>
                            <option value="Passpor">Passpor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_identitas" class="col-form-label">Nomor Identitas</label>
                        <input type="text" name="nomor_identitas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nomor_hp" class="col-form-label">Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file_kartu_identitas" class="col-form-label">File Kartu Identitas</label>
                        <input type="file" class="form-control" id="file_kartu_identitas" name="file_kartu_identitas">
                    </div>
                    <div class="form-group">
                        <label for="file_pernyataan_pjt" class="col-form-label">File Pernyataan PJT</label>
                        <input type="file" class="form-control" id="file_pernyataan_pjt" name="file_pernyataan_pjt">
                    </div>
                    <div class="form-group">
                        <label for="file_surat_penunjukan_pjt" class="col-form-label">File Surat Penunjukan PJT</label>
                        <input type="file" class="form-control" id="file_surat_penunjukan_pjt" name="file_surat_penunjukan_pjt">
                    </div>
                    <div class="form-group">
                        <label for="file_daftar_riwayat_hidup" class="col-form-label">File Daftar Riwayat Hidup</label>
                        <input type="file" class="form-control" id="file_daftar_riwayat_hidup" name="file_daftar_riwayat_hidup">
                    </div>
                    <div class="form-group">
                        <label for="kewarganegaraan" class="col-form-label">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" class="form-control">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_verifikasi_pt" value=""/>
                    <input type="hidden" name="uid_permohonan" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-ptpjt">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Persyaratan Teknis Penanggung Jawab Teknis-->

<!--Modal Hapus Persyaratan Teknis Penanggung Jawab Teknis-->
<div class="modal fade" id="deletePTPJTModal" tabindex="-1" role="dialog" aria-labelledby="deletePTPJTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-delete-ptpjt" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis-pjt/delete') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePTPJTModalLabel">Hapus Persyaratan Teknis Penanggung Jawab Teknik</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_ver_pt_pjt" value=""/>
                    <input type="hidden" name="uid_verifikasi_pt" value=""/>
                    <input type="hidden" name="uid_permohonan" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-delete-ptpjt">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Hapus Persyaratan Teknis Penanggung Jawab Teknis-->


<!--Modal Add Sertifikat Persyaratan Teknis Penanggung Jawab Teknis-->
<div class="modal fade" id="addSertifikatPtPjtModal" tabindex="-1" role="dialog" aria-labelledby="addSertifikatPtPjtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-sertifikat-pt-pjt" method="post" enctype="multipart/form-data" action="{{ url('sertifikat-pt-pjt') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSertifikatPtPjtModalLabel">Tambah Sertifikat PT PJT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="noreg_serkom" class="col-form-label">Nomor Registrasi Serkom</label>
                        <input type="text" name="noreg_serkom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="no_serkom" class="col-form-label">Nomor Serkom</label>
                        <input type="text" name="no_serkom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_sertifikat" class="col-form-label">Tanggal Sertifikat</label>
                        <div class="input-group date" id="tgl_sertifikat" data-target-input="nearest">
                            <input type="text" id="tgl_sertifikat" name="tgl_sertifikat" class="form-control datetimepicker-input" data-target="#tgl_sertifikat" />
                            <div class="input-group-append" data-target="#tgl_sertifikat" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lembaga_penerbit" class="col-form-label">Lembaga Penerbit</label>
                        <input type="text" name="lembaga_penerbit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="level" class="col-form-label">Level</label>
                        <input type="text" name="level" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="unit_kompetensi" class="col-form-label">Unit kompetensi</label>
                        <input type="text" name="unit_kompetensi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file_serkom" class="col-form-label">File Serkom</label>
                        <input type="file" class="form-control" id="file_serkom" name="file_serkom" required>
                    </div>
                    <div class="form-group">
                        <label for="bidang" class="col-form-label">Bidang</label>
                        <input type="text" name="bidang" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_pekerjaan" class="col-form-label">Jenis pekerjaan</label>
                        <input type="text" name="jenis_pekerjaan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_ver_pt_pjt" value=""/>
                    <input type="hidden" name="uid_verifikasi_pt" value=""/>
                    <input type="hidden" name="uid_permohonan" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-sertifikat-pt-pjt">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Sertifikat Persyaratan Teknis Penanggung Jawab Teknis-->


<!--Modal Delete Sertifikat Persyaratan Teknis Penanggung Jawab Teknis-->
<div class="modal fade" id="deleteSertifikatPtPjtModal" tabindex="-1" role="dialog" aria-labelledby="deleteSertifikatPtPjtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-delete-sertifikat-pt-pjt" method="post" enctype="multipart/form-data" action="{{ url('sertifikat-pt-pjt/delete') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSertifikatPtPjtModalLabel">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    Hapus Sertifikat PJT
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="id" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-delete-sertifikat-pt-pjt">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Sertifikat Persyaratan Teknis Penanggung Jawab Teknis-->



<!--Modal Tarik Persyaratan Teknis Tenaga Teknik-->
<div class="modal fade" id="pullPtTtModal" tabindex="-1" role="dialog" aria-labelledby="pullPtTtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-pull-pttt" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis-tt/pull-from-gatrik') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="pullPtTtModalLabel">Tarik Persyaratan Teknis Tenaga Teknik</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>Tarik data Persyaratan Teknis Tenaga Teknik dari gatrik</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="uid_verifikasi_pt" value=""/>
                    <input type="hidden" name="uid_permohonan" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-pull-pttt">Tarik</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tarik Persyaratan Teknis Tenaga Teknik-->

<!--Modal Tambah Persyaratan Teknis Tenaga Teknik-->
<div class="modal fade" id="addPtTtModal" tabindex="-1" role="dialog" aria-labelledby="addPtTtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-pt-tt" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis-tt') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPtTtModalLabel">Tambah Persyaratan Teknis Tenaga Teknik</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_identitas" class="col-form-label">Jenis Identitas</label>
                        <select name="jenis_identitas" class="form-control" style="width: 100%;" required>
                            <option value="">--Pilih--</option>
                            <option value="KTP">KTP</option>
                            <option value="Passpor">Passpor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_identitas" class="col-form-label">Nomor Identitas</label>
                        <input type="text" name="nomor_identitas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nomor_hp" class="col-form-label">Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file_kartu_identitas" class="col-form-label">File Kartu Identitas</label>
                        <input type="file" class="form-control" id="file_kartu_identitas" name="file_kartu_identitas">
                    </div>
                    <div class="form-group">
                        <label for="file_pernyataan_tt" class="col-form-label">File Pernyataan PJT</label>
                        <input type="file" class="form-control" id="file_pernyataan_tt" name="file_pernyataan_tt">
                    </div>
                    <div class="form-group">
                        <label for="file_surat_penunjukan_tt" class="col-form-label">File Surat Penunjukan PJT</label>
                        <input type="file" class="form-control" id="file_surat_penunjukan_tt" name="file_surat_penunjukan_tt">
                    </div>
                    <div class="form-group">
                        <label for="file_daftar_riwayat_hidup" class="col-form-label">File Daftar Riwayat Hidup</label>
                        <input type="file" class="form-control" id="file_daftar_riwayat_hidup" name="file_daftar_riwayat_hidup">
                    </div>
                    <div class="form-group">
                        <label for="kewarganegaraan" class="col-form-label">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" class="form-control">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_verifikasi_pt" value=""/>
                    <input type="hidden" name="uid_permohonan" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-pt-tt">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Persyaratan Teknis Tenaga Teknik-->

<!--Modal Hapus Persyaratan Teknis Tenaga Teknik-->
<div class="modal fade" id="deletePtTtModal" tabindex="-1" role="dialog" aria-labelledby="deletePtTtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-delete-pt-tt" method="post" enctype="multipart/form-data" action="{{ url('persyaratan-teknis-tt/delete') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePtTtModalLabel">Hapus Persyaratan Teknis Tenaga Teknik</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_ver_pt_tt" value=""/>
                    <input type="hidden" name="uid_verifikasi_pt" value=""/>
                    <input type="hidden" name="uid_permohonan" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-delete-pt-tt">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Hapus Persyaratan Teknis Tenaga Teknik-->


<!--Modal Add Sertifikat Persyaratan Teknis Tenaga Teknik-->
<div class="modal fade" id="addSertifikatPtTtModal" tabindex="-1" role="dialog" aria-labelledby="addSertifikatPtTtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-sertifikat-pt-tt" method="post" enctype="multipart/form-data" action="{{ url('sertifikat-pt-tt') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSertifikatPtTtModalLabel">Tambah Sertifikat PT TT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="noreg_serkom" class="col-form-label">Nomor Registrasi Serkom</label>
                        <input type="text" name="noreg_serkom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="no_serkom" class="col-form-label">Nomor Serkom</label>
                        <input type="text" name="no_serkom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_sertifikat" class="col-form-label">Tanggal Sertifikat</label>
                        <div class="input-group date" id="tgl_sertifikat_sert_pt_tt" data-target-input="nearest">
                            <input type="text" id="tgl_sertifikat_sert_pt_tt" name="tgl_sertifikat" class="form-control datetimepicker-input" data-target="#tgl_sertifikat_sert_pt_tt" />
                            <div class="input-group-append" data-target="#tgl_sertifikat_sert_pt_tt" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lembaga_penerbit" class="col-form-label">Lembaga Penerbit</label>
                        <input type="text" name="lembaga_penerbit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="level" class="col-form-label">Level</label>
                        <input type="text" name="level" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="unit_kompetensi" class="col-form-label">Unit kompetensi</label>
                        <input type="text" name="unit_kompetensi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file_serkom" class="col-form-label">File Serkom</label>
                        <input type="file" class="form-control" id="file_serkom" name="file_serkom" required>
                    </div>
                    <div class="form-group">
                        <label for="bidang" class="col-form-label">Bidang</label>
                        <input type="text" name="bidang" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_pekerjaan" class="col-form-label">Jenis pekerjaan</label>
                        <input type="text" name="jenis_pekerjaan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="uid_ver_pt_tt" value=""/>
                    <input type="hidden" name="uid_verifikasi_pt" value=""/>
                    <input type="hidden" name="uid_permohonan" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-sertifikat-pt-tt">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Sertifikat Persyaratan Teknis Tenaga Teknik-->

<!--Modal Delete Sertifikat Persyaratan Teknis Tenaga Teknik-->
<div class="modal fade" id="deleteSertifikatPtTtModal" tabindex="-1" role="dialog" aria-labelledby="deleteSertifikatPtTtModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-delete-sertifikat-pt-tt" method="post" enctype="multipart/form-data" action="{{ url('sertifikat-pt-tt/delete') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSertifikatPtTtModalLabel">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    Hapus Sertifikat TT
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="id" value=""/>
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-delete-sertifikat-pt-tt">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Sertifikat Persyaratan Teknis Tenaga Teknik-->
@endSection