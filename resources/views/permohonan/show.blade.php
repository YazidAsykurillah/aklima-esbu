@extends('layouts.app')

@section('page_title')
    Permohonan :: {{ $permohonan->uid_permohonan }}
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Detail Permohonan</h2>
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
    <div class="col-md-7">
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
                            <td style="width: 20%;">UID Permohonan</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->uid_permohonan }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Jenis Usaha</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->jenis_usaha->nama_jenis_usaha }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Jenis Sertifikasi</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->jenis_sertifikasi }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Perpanjangan ke</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->perpanjangan_ke }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Nama Badan Usaha</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->badan_usaha->nama_badan_usaha }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Bentuk Badan Usaha</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->badan_usaha->bentuk_badan_usaha->nama_bentuk_badan_usaha }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Bentuk Badan Usaha</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->badan_usaha->alamat_badan_usaha }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">Identitas Badan Usaha</h4>
                <div class="toolbar ml-auto">
                   <a href="#" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#addIBUModal">
                        <i class="fas fa-plus-circle"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td style="width: 20%;">UID Verifikasi</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->identitas_badan_usaha->uid_verifikasi_ibu }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">File Surat Permohoan SBU</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->identitas_badan_usaha->file_surat_permohonan_sbu }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Nomor Surat</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->identitas_badan_usaha->nomor_surat }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Perihal</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->identitas_badan_usaha->perihal }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Tanggal Surat</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->identitas_badan_usaha->tanggal_surat }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Nama Penandatanganan Surat</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->identitas_badan_usaha->nama_penandatangan_surat }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Jabatan Penandatanganan Surat</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $permohonan->identitas_badan_usaha->jabatan_penandatangan_surat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Identitas Badan Usaha -->
<div class="modal fade" id="addIBUModal" tabindex="-1" role="dialog" aria-labelledby="addIBUModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-tambah-identitas-badan-usaha" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIBUModalLabel">Tambah Identitas Badan Usaha</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="uid_permohonan" class="col-form-label">UID Permohonan</label>
                        <input id="uid_permohonan" name="uid_permohonan" type="text" class="form-control" value="{{ $permohonan->uid_permohonan }}" readonly />
                    </div>
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="file_surat_permohonan_sbu">File Surat Permohonan SBU</label>
                        <input type="file" class="custom-file-input" id="file_surat_permohonan_sbu" name="file_surat_permohonan_sbu">
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
                        <input id="tanggal_surat" name="tanggal_surat" type="text" class="form-control" />
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
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-add-ibu">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        //Synchronize handler
        $('#form-tambah-identitas-badan-usaha').on('submit', function(event){
            event.preventDefault();
            var addIBUData = new FormData($(this)[0]);
            $('#btn-add-ibu').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '{{ url('identitas-badan-usaha') }}', // This is the url we gave in the route
                data: addIBUData,
                processData: false,
                contentType: false,
                success: function(response){ // What to do if we succeed
                    console.log(response);
                    if(response.response == 1){
                        $('#addIBUModal').modal('hide');
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                        resetAddIBUButton();
                    } else{
                        console.log(response);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    alertify.notify(jqXHR.responseJSON.message, textStatus, 5, function(){  console.log('dismissed'); });
                    resetAddIBUButton();
                }
            });
        });

        function resetAddIBUButton(){
            $('#btn-add-ibu').prop('disabled', false).html('Tambah');
        }
    });
</script>
@endsection
