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
                        @if($permohonan->status =='11')
                        <tr>
                            <td style="width: 30%;"></td>
                            <td style="width: 5%;"></td>
                            <td style="">
                                <a href="{{ url('permohonan/'.$permohonan->uid_permohonan.'/print-certificate') }}" class="btn btn-primary btn-xs" id="btn-print-certificate">
                                    <i class="fa fa-print"></i> Cetak Sertifikat
                                </a>
                                <a href="#" class="btn btn-info btn-change-status btn-xs" data-next-status="12">
                                    Sudah Dicetak
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if($permohonan->status =='12')
                        <tr>
                            <td style="width: 30%;"></td>
                            <td style="width: 5%;"></td>
                            <td style="">
                                <a href="{{ url('permohonan/'.$permohonan->uid_permohonan.'/print-certificate') }}" class="btn btn-primary btn-xs" id="btn-print-certificate">
                                    <i class="fa fa-print"></i> Cetak Sertifikat
                                </a>
                                <a href="#" class="btn btn-info btn-change-status btn-xs" data-next-status="14">
                                    Sudah diterima Pemohon
                                </a>
                            </td>
                        </tr>
                        @endif
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
                                    <button id="btn-delete-asesor-pjt" class="btn btn-danger btn-xs" data-uid-permohonan-asesor="{{ $permohonan->uid_permohonan_tt }}">
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

<!--Component Identitas Badan Usaha-->
@include('permohonan.components.component-identitas-badan-usaha')
<!--ENDComponent Identitas Badan Usaha-->

<!--Component Persyaratan Administratif-->
@include('permohonan.components.component-persyaratan-administratif')
<!--ENDComponent Persyaratan Administratif-->

<!--Component Persyaratan Teknis-->
@include('permohonan.components.component-persyaratan-teknis')
<!--ENDComponent Persyaratan Teknis-->

<!--Component Persyaratan Teknis-->
@include('permohonan.components.component-data-pengurus')
<!--ENDComponent Persyaratan Teknis-->

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
                            <i class="fas fa-check-circle"></i> Kirim ke Frontdesk
                        </a>
                    @endif
                @elseif($permohonan->status == '1')
                    @if(\Auth::user()->can('view-permohonan-1'))
                        <a href="#" class="btn btn-primary btn-sm btn-change-status" data-next-status="4">
                            <i class="fas fa-check-circle"></i> Kirim Ke Verifikator
                        </a>
                    @endif
                @elseif($permohonan->status == '4')
                    @if(\Auth::user()->can('view-permohonan-4'))
                        <a href="#" class="btn btn-primary btn-sm btn-change-status" data-next-status="5">
                            <i class="fas fa-check-circle"></i>&nbsp;Approve By Verifikator
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-change-status" data-next-status="1">
                            <i class="far fa-window-close"></i> Kembalikan
                        </a>
                    @endif
                @elseif($permohonan->status == '5')
                    @if(\Auth::user()->can('view-permohonan-5'))
                        <a href="#" class="btn btn-primary btn-sm btn-change-status" data-next-status="6">
                            Approve by Auditor
                        </a>
                        <a href="#" class="btn btn-danger btn-sm btn-change-status" data-next-status="1">
                            Reject By Auditor
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

<!--Log status permohonan-->
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
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Asesor TT-->

<!--Modal Delete Asesor TT-->
<div class="modal fade" id="deleteAsesorTTModal" tabindex="-1" role="dialog" aria-labelledby="deleteAsesorTTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-delete-asesor-tt" method="post" action="{{ url('permohonan/delete-asesor-tt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAsesorTTModalLabel">Hapus Asesor TT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    
                    <input type="hidden" name="uid_permohonan_asesor_tt" id="uid_permohonan_asesor_tt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
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
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Asesor PJT-->

<!--Modal Delete Asesor PJT-->
<div class="modal fade" id="deleteAsesorPJTModal" tabindex="-1" role="dialog" aria-labelledby="deleteAsesorPJTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-delete-asesor-pjt" method="post" action="{{ url('permohonan/delete-asesor-pjt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAsesorPJTModalLabel">Hapus Asesor PJT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    
                    <input type="hidden" name="uid_permohonan_asesor_pjt" id="uid_permohonan_asesor_pjt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
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
            $('#btn-add-ibu').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
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
                        $('#btn-add-ibu').prop('disabled', false).html('Edit');
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


        var selected_provinsi_id = null;
        //Handler Select Asesor TT
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
        //ENDHandler Select Asesor TT
        $('#btn-add-asesor-tt').on('click', function(){
            event.preventDefault();
            selected_provinsi_id = $(this).attr('data-provinsi-id');
            $('#uid_permohonan_to_add_asesor_tt').val($(this).attr('data-uid-permohonan'));
            $('#addAsesorTTModal').modal('show');
        });

        //Handler Select Asesor PJT
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
        //ENDHandler Select Asesor PJT
        $('#btn-add-asesor-pjt').on('click', function(){
            event.preventDefault();
            selected_provinsi_id = $(this).attr('data-provinsi-id');
            $('#uid_permohonan_to_add_asesor_pjt').val($(this).attr('data-uid-permohonan'));
            $('#addAsesorPJTModal').modal('show');
        });

    });
</script>
@endsection


