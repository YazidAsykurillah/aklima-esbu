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
                <!--Tab Pane Identitas Badan Usaha-->
                <div class="tab-pane fade show active" id="outline-identitas-badan-usaha" role="tabpanel" aria-labelledby="tab-outline-identitas-badan-usaha">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4 class="card-header-title">
                                Identitas Badan Usaha
                            </h4>
                            <div class="toolbar ml-auto">
                                <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                                @if($permohonan->status == '0' || $permohonan->status == '1')
                                    <button type="button" id="btn-pull-ibu-trigger" class="btn btn-light btn-xs" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                                        <i class="fas fa-sync"></i> Tarik
                                    </button>
                                    @if(is_null($permohonan->identitas_badan_usaha))
                                        
                                        <a href="#" class="btn btn-light btn-xs"  data-toggle="modal" data-target="#addIBUModal">
                                            <i class="fas fa-plus-circle"></i> Tambah
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-light btn-xs"  data-toggle="modal" data-target="#editIBUModal">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if(!is_null($identitas_badan_usaha))
                                <table class="table">
                                    <tr>
                                        <td style="width: 30%;">UID Verifikasi IBU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="ibu_holder_uid_verifikasi_ibu">
                                            {{ $identitas_badan_usaha->uid_verifikasi_ibu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">File Surat Permohoan SBU</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="ibu_holder_file_surat_permohonan_sbu">
                                            <a href="{{ $identitas_badan_usaha->file_surat_permohonan_sbu }}">
                                                {{ $identitas_badan_usaha->file_surat_permohonan_sbu }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nomor Surat</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="ibu_holder_nomor_surat">
                                            {{ $identitas_badan_usaha->nomor_surat }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Perihal</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="ibu_holder_perihal">
                                            {{ $identitas_badan_usaha->perihal }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Tanggal Surat</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="ibu_holder_tanggal_surat">
                                            {{ indonesian_date($identitas_badan_usaha->tanggal_surat) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Nama Penandatanganan Surat</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="ibu_holder_nama_penandatangan_surat">
                                            {{ $identitas_badan_usaha->nama_penandatangan_surat }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Jabatan Penandatanganan Surat</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="" id="ibu_holder_jabatan_penandatangan_surat">
                                            {{ $identitas_badan_usaha->jabatan_penandatangan_surat }}
                                        </td>
                                    </tr>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--ENDTab Pane Identitas Badan Usaha-->

            </div>
        </div>
    </div>
</div>
<!--ENDRow Tabs-->

<!--Modal Tarik Identitas Badan Usaha-->
<div class="modal fade" id="pullIBUModal" tabindex="-1" role="dialog" aria-labelledby="pullIBUModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-pull-identitas-badan-usaha" method="post" enctype="multipart/form-data" action="{{ url('identitas-badan-usaha/pull-from-gatrik') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="pullIBUModalLabel">Tarik Identitas Badan Usaha</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <p>Tarik data Identitas Badan Usaha dari gatrik</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="uid_permohonan">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-pull-ibu">Tarik</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tarik Identitas Badan Usaha-->

<!--Modal Tambah Identitas Badan Usaha-->
<div class="modal fade" id="addIBUModal" tabindex="-1" role="dialog" aria-labelledby="addIBUModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-tambah-identitas-badan-usaha" method="post" enctype="multipart/form-data" action="{{ url('identitas-badan-usaha') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIBUModalLabel">Tambah Identitas Badan Usaha</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="file_surat_permohonan_sbu" class="col-form-label">File Surat Permohonan SBU</label>
                        <input type="file" class="form-control" id="file_surat_permohonan_sbu" name="file_surat_permohonan_sbu">
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat" class="col-form-label">Nomor Surat</label>
                        <input id="nomor_surat" name="nomor_surat" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="perihal" class="col-form-label">Perihal</label>
                        <input id="perihal" name="perihal" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat" class="col-form-label">Tanggal Surat</label>
                        <div class="input-group date" id="tanggal_surat" data-target-input="nearest">
                            <input type="text" id="tanggal_surat" name="tanggal_surat" class="form-control datetimepicker-input" data-target="#tanggal_surat" />
                            <div class="input-group-append" data-target="#tanggal_surat" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_penandatangan_surat" class="col-form-label">Nama Penandatangan Surat</label>
                        <input id="nama_penandatangan_surat" name="nama_penandatangan_surat" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="jabatan_penandatangan_surat" class="col-form-label">Jabatan Penandatangan Surat</label>
                        <input id="jabatan_penandatangan_surat" name="jabatan_penandatangan_surat" type="text" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-ibu">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Identitas Badan Usaha-->

<!--Modal Edit Identitas Badan Usaha-->
<div class="modal fade" id="editIBUModal" tabindex="-1" role="dialog" aria-labelledby="editIBUModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-edit-identitas-badan-usaha" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIBUModalLabel">Edit Identitas Badan Usaha</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="file_surat_permohonan_sbu_edit" class="col-form-label">File Surat Permohonan SBU</label>
                        <input type="file" class="form-control" id="file_surat_permohonan_sbu_edit" name="file_surat_permohonan_sbu_edit">
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat_edit" class="col-form-label">Nomor Surat</label>
                        <input id="nomor_surat_edit" name="nomor_surat_edit" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="perihal_edit" class="col-form-label">Perihal</label>
                        <input id="perihal_edit" name="perihal_edit" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat_edit" class="col-form-label">Tanggal Surat</label>
                        <div class="input-group date" id="tanggal_surat_edit" data-target-input="nearest">
                            <input type="text" id="tanggal_surat_edit" name="tanggal_surat_edit" class="form-control datetimepicker-input" data-target="#tanggal_surat_edit" />
                            <div class="input-group-append" data-target="#tanggal_surat_edit" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_penandatangan_surat_edit" class="col-form-label">Nama Penandatangan Surat</label>
                        <input id="nama_penandatangan_surat_edit" name="nama_penandatangan_surat_edit" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="jabatan_penandatangan_surat_edit" class="col-form-label">Jabatan Penandatangan Surat</label>
                        <input id="jabatan_penandatangan_surat_edit" name="jabatan_penandatangan_surat_edit" type="text" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    @if($permohonan->identitas_badan_usaha)
                        <input type="hidden" id="uid_verifikasi_ibu" name="uid_verifikasi_ibu" value="{{ $permohonan->identitas_badan_usaha->uid_verifikasi_ibu }}">
                    @endif
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-edit-ibu">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Edit Identitas Badan Usaha-->
@endSection


