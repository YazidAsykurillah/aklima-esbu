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
                <h4 class="card-header-title">Informasi Permohonan</h4>
                <div class="toolbar ml-auto">
                   
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td style="width: 30%;">UID Permohonan</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->uid_permohonan }}</td>
                        </tr>
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
                            <td style="width: 30%;">Bentuk Badan Usaha</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->badan_usaha->alamat_badan_usaha }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!--Component Identitas Badan Usaha-->
@include('permohonan.components.component-identitas-badan-usaha')
<!--ENDComponent Identitas Badan Usaha-->

<!--Component Persyaratan Administratif-->
@include('permohonan.components.component-persyaratan-administratif')
<!--ENDComponent Persyaratan Administratif-->



@endsection

@section('additional_scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    //Block Identitas Badan Usaha
        if ($("#tanggal_surat").length) {
            $('#tanggal_surat').datetimepicker({
                format: 'YYYY-MM-DD'
            });

        }
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

        getIdentitasBadanUsaha();
        //fetch Identitas Badan Usaha
        function getIdentitasBadanUsaha()
        {
            $.ajax({
                type: 'GET',
                url: '{{ url('permohonan') }}/{{ $permohonan->uid_permohonan }}/identitas-badan-usaha', 
                success: function (response) {
                    console.log(response);
                    $('#ibu_holder_uid_verifikasi_ibu').html(response.uid_verifikasi_ibu);
                    $('#ibu_holder_file_surat_permohonan_sbu').html(response.file_surat_permohonan_sbu);
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


        fetchPersyaratanAdministratif();
        //fetch Persyaratan Administratif
        function fetchPersyaratanAdministratif()
        {
            $.ajax({
                type: 'GET',
                url: '{{ url('permohonan') }}/{{ $permohonan->uid_permohonan }}/persyaratan-administratif', 
                success: function (response) {
                    console.log(response);
                    $('#pa_holder_uid_verifikasi_pa').html(response.uid_verifikasi_pa);
                    $('#pa_holder_file_akta_pendirian_bu').html(response.file_akta_pendirian_bu);
                    $('#pa_holder_nama_notaris').html(response.nama_notaris);
                    $('#pa_holder_judul_akta').html(response.judul_akta);
                    $('#pa_holder_tanggal_akta').html(response.tanggal_akta);
                    $('#pa_holder_nomor_akta').html(response.nomor_akta);
                    $('#pa_holder_maksud_tujuan_akta').html(response.maksud_tujuan_akta);
                    $('#pa_holder_file_pengesahan_sebagai_badan_hukum').html(response.file_pengesahan_sebagai_badan_hukum);
                    $('#pa_holder_nomor_badan_hukum').html(response.nomor_badan_hukum);
                    $('#pa_holder_tentang_badan_hukum').html(response.tentang_badan_hukum);
                    $('#pa_holder_tanggal_badan_hukum').html(response.tanggal_badan_hukum);
                    $('#pa_holder_file_npwp').html(response.file_npwp);
                    $('#pa_holder_nomor_npwp').html(response.nomor_npwp);
                    $('#pa_holder_file_skdu').html(response.file_skdu);
                    $('#pa_holder_instansi_penerbit_skdu').html(response.instansi_penerbit_skdu);
                    $('#pa_holder_nomor_skdu').html(response.nomor_skdu);
                    $('#pa_holder_tanggal_skdu').html(response.tanggal_skdu);
                    $('#pa_holder_masa_berlaku_skdu').html(response.masa_berlaku_skdu);
                    $('#pa_holder_file_pjbu').html(response.file_pjbu);
                    $('#pa_holder_nama_pjbu').html(response.nama_pjbu);
                    $('#pa_holder_jenis_identitas_pjbu').html(response.jenis_identitas_pjbu);
                    $('#pa_holder_nomor_ktp_pjbu').html(response.nomor_ktp_pjbu);
                    $('#pa_holder_nomor_paspor_pjbu').html(response.nomor_paspor_pjbu);
                    $('#pa_holder_file_laporan_keuangan').html(response.file_laporan_keuangan);
                    $('#pa_holder_kekayaan_bersih').html(response.kekayaan_bersih);
                    $('#pa_holder_modal_disetor').html(response.modal_disetor);
                    $('#pa_holder_nama_kantor_akuntan_publik').html(response.nama_kantor_akuntan_publik);
                    $('#pa_holder_alamat_kantor_akuntan_pulik').html(response.alamat_kantor_akuntan_pulik);
                    $('#pa_holder_nomor_telepon_kantor_akuntan_publik').html(response.nomor_telepon_kantor_akuntan_publik);
                    $('#pa_holder_nama_akuntan').html(response.nama_akuntan);
                    $('#pa_holder_nomor_laporan_keuangan').html(response.nomor_laporan_keuangan);
                    $('#pa_holder_tanggal_laporan_keuangan').html(response.tanggal_laporan_keuangan);
                    $('#pa_holder_pendapat_akuntan').html(response.pendapat_akuntan);
                    $('#pa_holder_file_struktur_organisasi_badan_usaha').html(response.file_struktur_organisasi_badan_usaha);
                    $('#pa_holder_file_profile_badan_usaha').html(response.file_profile_badan_usaha);
                    $('#pa_holder_file_ppm').html(response.file_ppm);
                    $('#pa_holder_nomor_ppm').html(response.nomor_ppm);
                    $('#pa_holder_tanggal_ppm').html(response.tanggal_ppm);
                    $('#pa_holder_prosentase_saham_pma_ppm').html(response.prosentase_saham_pma_ppm);
                    $('#pa_holder_file_ppm_perubahan').html(response.file_ppm_perubahan);
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
        

    });
</script>
@endsection


