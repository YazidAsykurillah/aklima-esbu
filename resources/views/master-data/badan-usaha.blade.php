@extends('layouts.app')

@section('page_title')
    Master Data :: Badan Usaha
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Badan Usaha</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Badan Usaha</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Badan Usaha</h4>
        <div class="toolbar ml-auto">
            <a href="#" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#synchModal">
                <i class="fas fa-sync"></i> Sinkronisasi
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bentuk Badan Usaha</th>
                        <th scope="col">Nama Badan Usaha</th>
                        <th scope="col">Alamat Badan Usaha</th>
                        <th scope="col">Nama Kecamatan</th>
                        <th scope="col">Nama Kelurahan</th>
                        <th scope="col">no_telp_kantor</th>
                        <th scope="col">no_hp_kantor</th>
                        <th scope="col">no_fax</th>
                        <th scope="col">website</th>
                        <th scope="col">nik_penanggung_jawab</th>
                        <th scope="col">nama_penanggung_jawab</th>
                        <th scope="col">jenis_kewarganegaraan</th>
                        <th scope="col">kewarganegaraan</th>
                        <th scope="col">passport</th>
                        <th scope="col">no_telepon_penanggung_jawab</th>
                        <th scope="col">email_perusahaan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Synchronize -->
<div class="modal fade" id="synchModal" tabindex="-1" role="dialog" aria-labelledby="synchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="synchModalLabel">Sinkronisasi Badan Usaha</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
               <p>Tekan tombol Sinkronisasi untuk melanjutkan, tekan tombol Batal untuk membatalkan sinkronisasi</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" id="btn-synchronize">Sinkronisasi</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var table =  $('#table').DataTable({
            processing :true,
            serverSide : true,
            ajax : '{!! url('badan-usaha/datatables') !!}',
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'nama_bentuk_badan_usaha', name: 'bentuk_badan_usaha.nama_bentuk_badan_usaha', orderable:false },
                { data: 'nama_badan_usaha', name: 'nama_badan_usaha' },
                { data: 'alamat_badan_usaha', name: 'alamat_badan_usaha' },
                { data: 'nama_kecamatan', name: 'kecamatan.nama', orderable:false },
                { data: 'nama_kelurahan', name: 'kelurahan.nama', orderable:false },
                { data: 'no_telp_kantor', name: 'no_telp_kantor' },
                { data: 'no_hp_kantor', name: 'no_hp_kantor' },
                { data: 'no_fax', name: 'no_fax' },
                { data: 'website', name: 'website' },
                { data: 'nik_penanggung_jawab', name: 'nik_penanggung_jawab' },
                { data: 'nama_penanggung_jawab', name: 'nama_penanggung_jawab' },
                { data: 'jenis_kewarganegaraan', name: 'jenis_kewarganegaraan' },
                { data: 'kewarganegaraan', name: 'kewarganegaraan' },
                { data: 'passport', name: 'passport' },
                { data: 'no_telepon_penanggung_jawab', name: 'no_telepon_penanggung_jawab' },
                { data: 'email_perusahaan', name: 'email_perusahaan' },

                //Hidden columns
                { data: 'uid_badan_usaha', name: 'uid_badan_usaha', visible:false },
                { data: 'kelurahan_uid', name: 'kelurahan_uid', visible:false },
                { data: 'kecamatan_uid', name: 'kecamatan_uid', visible:false },
                { data: 'kota_uid', name: 'kota_uid', visible:false },
                { data: 'bentuk_badan_usaha_uid', name: 'bentuk_badan_usaha_uid', visible:false },
            ]
        });


        //Synchronize handler
        $('#btn-synchronize').on('click', function(event){
            event.preventDefault();
            $('#btn-synchronize').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            var _token = "{{ csrf_token() }}";
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '{{ url('badan-usaha/synchronize') }}', // This is the url we gave in the route
                data: {'_token' : _token}, // a JSON object to send back
                success: function(response){ // What to do if we succeed
                    console.log(response);
                    if(response.response == 1){
                        $('#synchModal').modal('hide');
                        table.ajax.reload();
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                        resetSynchronizeButton();
                    } else{
                        console.log(response);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    alertify.notify(jqXHR.responseJSON.message, textStatus, 5, function(){  console.log('dismissed'); });
                    resetSynchronizeButton();
                }
            });
        });

        function resetSynchronizeButton(){
            $('#btn-synchronize').prop('disabled', false).html('Sinkronisasi');
        }


    });
</script>
@endsection
