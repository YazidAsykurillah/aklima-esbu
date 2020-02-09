@extends('layouts.app')

@section('page_title')
    Permohonan :: {{ $permohonan->uid_permohonan }}
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Detail Permohonan</h2>
@endsection

@section('additional_styles')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
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
                                    <button id="btn-delete-asesor-tt" class="btn btn-info btn-xs" data-uid-permohonan-asesor="{{ $permohonan->uid_permohonan_tt }}">
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
                                    <button id="btn-delete-asesor-pjt" class="btn btn-info btn-xs" data-uid-permohonan-asesor="{{ $permohonan->uid_permohonan_tt }}">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //Prepare all datetime picker instances
        if ($("#tanggal_surat").length) {
            $('#tanggal_surat').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }
        if ($("#tanggal_surat_edit").length) {
            $('#tanggal_surat_edit').datetimepicker({
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
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                        getIdentitasBadanUsaha();
                        $('#btn-add-ibu').prop('disabled', false).html('Tambah');
                        $("#form-tambah-identitas-badan-usaha")[0].reset();
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
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                        getIdentitasBadanUsaha();
                        $('#btn-edit-ibu').prop('disabled', false).html('Edit');
                        $("#form-edit-identitas-badan-usaha")[0].reset();
                    } else{
                        $('#editIBUModal').modal('hide');
                        alertify.notify(response.message, 'error', 5, function(){  console.log('dismissed'); });
                        getIdentitasBadanUsaha();
                        $('#btn-edit-ibu').prop('disabled', false).html('Edit');
                        $("#form-edit-identitas-badan-usaha")[0].reset();
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

        //Handler Pull Identitas Badan Usaha
        $('#form-pull-identitas-badan-usaha').on('submit', function(event){
            event.preventDefault();
            var pullIBUData = new FormData($(this)[0]);
            pullIBUData.append('uid_permohonan','{{ $permohonan->uid_permohonan }}');
            $('#btn-pull-ibu').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            $.ajax({
                method: 'POST',
                url: '{{ url('identitas-badan-usaha/pull-from-gatrik') }}', 
                data: pullIBUData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        $('#pullIBUModal').modal('hide');
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                        getIdentitasBadanUsaha();
                        $('#btn-pull-ibu').prop('disabled', false).html('Tarik');
                        $("#form-pull-identitas-badan-usaha")[0].reset();
                    } else{
                        $('#pullIBUModal').modal('hide');
                        alertify.notify(response.message, 'error', 5, function(){  console.log('dismissed'); });
                        getIdentitasBadanUsaha();
                        $('#btn-pull-ibu').prop('disabled', false).html('Tarik');
                        $("#form-pull-identitas-badan-usaha")[0].reset();
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
        //ENDHandler Pull Identitas Badan Usaha

        //auto pull identitas badan usaha from gatrik
        function auto_pull_ibu_from_gatrik()
        {
            $.ajax({
                method: 'POST',
                url: '{{ url('identitas-badan-usaha/pull-from-gatrik') }}', 
                data: pullIBUData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        
                        getIdentitasBadanUsaha();
                        $('#btn-pull-ibu').prop('disabled', false).html('Tarik');
                        $("#form-pull-identitas-badan-usaha")[0].reset();
                    } else{
                        
                        getIdentitasBadanUsaha();
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    console.log(objResponse);

                }
            });
        }
        getIdentitasBadanUsaha();
        //fetch Identitas Badan Usaha
        function getIdentitasBadanUsaha()
        {
            $.ajax({
                type: 'GET',
                url: '{{ url('permohonan') }}/{{ $permohonan->uid_permohonan }}/identitas-badan-usaha', 
                success: function (response) {
                    // console.log(response);
                    $('#ibu_holder_uid_verifikasi_ibu').html(response.uid_verifikasi_ibu);
                    $('#ibu_holder_file_surat_permohonan_sbu').html(
                        '<a href="'+response.file_surat_permohonan_sbu+'">'
                            +response.file_surat_permohonan_sbu+
                        '</a>'
                    );
                    $('#ibu_holder_nomor_surat').html(response.nomor_surat);
                    $('#ibu_holder_perihal').html(response.perihal);
                    $('#ibu_holder_tanggal_surat').html(response.tanggal_surat);
                    $('#ibu_holder_nama_penandatangan_surat').html(response.nama_penandatangan_surat);
                    $('#ibu_holder_jabatan_penandatangan_surat').html(response.jabatan_penandatangan_surat);
                },
                error: function() { 
                     console.log(response);
                }
            });
        }
    //ENDBlock Identitas Badan Usaha

    //Block Tambah Persyaratan Administratif
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
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                        fetchPersyaratanAdministratif();
                        $('#btn-pull-pa').prop('disabled', false).html('Tarik');
                        $("#form-pull-persyaratan-administratif")[0].reset();
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


        fetchPersyaratanAdministratif();
        //fetch Persyaratan Administratif
        function fetchPersyaratanAdministratif()
        {
            $.ajax({
                type: 'GET',
                url: '{{ url('permohonan') }}/{{ $permohonan->uid_permohonan }}/persyaratan-administratif', 
                success: function (response) {
                    // console.log(response);
                    $('#pa_holder_uid_verifikasi_pa').html(response.uid_verifikasi_pa);
                    $('#pa_holder_file_akta_pendirian_bu').html(
                        '<a href="'+response.file_akta_pendirian_bu+'">'
                            +response.file_akta_pendirian_bu+
                        '</a>'
                    );
                    $('#pa_holder_nama_notaris').html(response.nama_notaris);
                    $('#pa_holder_judul_akta').html(response.judul_akta);
                    $('#pa_holder_tanggal_akta').html(response.tanggal_akta);
                    $('#pa_holder_nomor_akta').html(response.nomor_akta);
                    $('#pa_holder_maksud_tujuan_akta').html(response.maksud_tujuan_akta);
                    $('#pa_holder_file_pengesahan_sebagai_badan_hukum').html(
                        '<a href="'+response.file_pengesahan_sebagai_badan_hukum+'">'
                            +response.file_pengesahan_sebagai_badan_hukum+
                        '</a>'
                    );
                    $('#pa_holder_nomor_badan_hukum').html(response.nomor_badan_hukum);
                    $('#pa_holder_tentang_badan_hukum').html(response.tentang_badan_hukum);
                    $('#pa_holder_tanggal_badan_hukum').html(response.tanggal_badan_hukum);
                    $('#pa_holder_file_npwp').html(
                        '<a href="'+response.file_npwp+'">'
                            +response.file_npwp+
                        '</a>'
                    );
                    $('#pa_holder_nomor_npwp').html(response.nomor_npwp);
                    $('#pa_holder_file_skdu').html(
                        '<a href="'+response.file_skdu+'">'
                            +response.file_skdu+
                        '</a>'
                    );
                    $('#pa_holder_instansi_penerbit_skdu').html(response.instansi_penerbit_skdu);
                    $('#pa_holder_nomor_skdu').html(response.nomor_skdu);
                    $('#pa_holder_tanggal_skdu').html(response.tanggal_skdu);
                    $('#pa_holder_masa_berlaku_skdu').html(response.masa_berlaku_skdu);
                    $('#pa_holder_file_pjbu').html(
                        '<a href="'+response.file_pjbu+'">'
                            +response.file_pjbu+
                        '</a>'
                    );
                    $('#pa_holder_nama_pjbu').html(response.nama_pjbu);
                    $('#pa_holder_jenis_identitas_pjbu').html(response.jenis_identitas_pjbu);
                    $('#pa_holder_nomor_ktp_pjbu').html(response.nomor_ktp_pjbu);
                    $('#pa_holder_nomor_paspor_pjbu').html(response.nomor_paspor_pjbu);
                    $('#pa_holder_file_laporan_keuangan').html(
                        '<a href="'+response.file_laporan_keuangan+'">'
                            +response.file_laporan_keuangan+
                        '</a>'
                    );
                    $('#pa_holder_kekayaan_bersih').html(response.kekayaan_bersih);
                    $('#pa_holder_modal_disetor').html(response.modal_disetor);
                    $('#pa_holder_nama_kantor_akuntan_publik').html(response.nama_kantor_akuntan_publik);
                    $('#pa_holder_alamat_kantor_akuntan_pulik').html(response.alamat_kantor_akuntan_pulik);
                    $('#pa_holder_nomor_telepon_kantor_akuntan_publik').html(
                        response.nomor_telepon_kantor_akuntan_publik != 0 ? response.nomor_telepon_kantor_akuntan_publik : '-'
                    );
                    $('#pa_holder_nama_akuntan').html(response.nama_akuntan);
                    $('#pa_holder_nomor_laporan_keuangan').html(response.nomor_laporan_keuangan);
                    $('#pa_holder_tanggal_laporan_keuangan').html(response.tanggal_laporan_keuangan);
                    $('#pa_holder_pendapat_akuntan').html(response.pendapat_akuntan);
                    $('#pa_holder_file_struktur_organisasi_badan_usaha').html(
                        '<a href="'+response.file_struktur_organisasi_badan_usaha+'">'
                            +response.file_struktur_organisasi_badan_usaha+
                        '</a>'
                    );
                    $('#pa_holder_file_profile_badan_usaha').html(
                        '<a href="'+response.file_profile_badan_usaha+'">'
                            +response.file_profile_badan_usaha+
                        '</a>'
                    );
                    if(response.file_ppm != null){
                        $('#pa_holder_file_ppm').html(
                            '<a href="'+response.file_ppm+'">'
                                +response.file_ppm+
                            '</a>'
                        );    
                    }
                    
                    $('#pa_holder_nomor_ppm').html(response.nomor_ppm);
                    $('#pa_holder_tanggal_ppm').html(response.tanggal_ppm);
                    $('#pa_holder_prosentase_saham_pma_ppm').html(response.prosentase_saham_pma_ppm);
                    if(response.file_ppm_perubahan!=null){
                        $('#pa_holder_file_ppm_perubahan').html(
                            '<a href="'+response.file_ppm_perubahan+'">'
                                +response.file_ppm_perubahan+
                            '</a>'
                        );    
                    }
                    
                    $('#pa_holder_nomor_ppm_perubahan').html(response.nomor_ppm_perubahan);
                    $('#pa_holder_tanggal_ppm_perubahan').html(response.tanggal_ppm_perubahan);
                    $('#pa_holder_prosentase_saham_pma_ppm_perubahan').html(response.prosentase_saham_pma_ppm_perubahan);
                },
                error: function() { 
                     console.log(response);
                }
            });
        }
        //ENDBlock Tambah Persyaratan Administratif
    
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


