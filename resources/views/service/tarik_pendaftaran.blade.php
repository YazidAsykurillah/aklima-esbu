@extends('layouts.app')

@section('page_title')
    Service :: Tarik Pendaftaran
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Service : Tarik Pendaftaran</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Service Tarik Pendaftaran</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Pendaftaran Belum Di Proses</h4>
        <div class="toolbar ml-auto">
            <a href="#" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#synchModal">
                <i class="fas fa-sync"></i> Tarik Pendaftaran
            </a>
        </div>
    </div>
    <div class="card-body">
       <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="width:5%;">#</th>
                        <th scope="col" style="width:5%;">Detail</th>
                        <th scope="col">Nama Badan Usaha</th>
                        <th scope="col" style="width:15%;">Jenis Usaha</th>
                        <th scope="col" style="width:10%;">Jenis Sertifikasi</th>
                        <th scope="col" style="width:10%;">Perpanjangan Ke</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Synchronize -->
<div class="modal fade" id="synchModal" tabindex="-1" role="dialog" aria-labelledby="synchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="synchModalLabel">Tarik Pendaftaran</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
               <p>Tekan tombol Tarik Pendaftaran untuk melanjutkan, tekan tombol Batal untuk membatalkan</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" id="btn-synchronize">Tarik Pendaftaran</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script type="text/javascript">
   //Synchronize handler
    $('#btn-synchronize').on('click', function(event){
        event.preventDefault();
        $('#btn-synchronize').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
        var _token = "{{ csrf_token() }}";
        $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '{{ url('service/tarik-pendaftaran') }}', // This is the url we gave in the route
            data: {'_token' : _token}, // a JSON object to send back
            success: function(response){ // What to do if we succeed
                console.log(response);
                if(response.response == 1){
                    $('#synchModal').modal('hide');
                    alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                    table.ajax.reload();
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
        $('#btn-synchronize').prop('disabled', false).html('Tarik Pendaftaran');
    }

   var table =  $('#table').DataTable({
            processing :true,
            serverSide : true,
            //ajax : '{!! url('permohonan/datatables') !!}',
            ajax: {
                url: '{!! url('permohonan/datatables') !!}',
                "data": function ( d ) {
                    d.status = '0';
                }
            },
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_permohonan', name: 'uid_permohonan', orderable:false, searchable:false, render:function(data, type, row, meta){
                    var link = '';
                        link+= '<a href="{{ url('permohonan')}}/'+data+'">';
                        link+=      '<i class="fa fa-link"></i>';
                        link+= '</a>';
                    return link;
                }},
                { data: 'nama_badan_usaha', name: 'badan_usaha.nama_badan_usaha', orderable:false },
                { data: 'nama_jenis_usaha', name: 'jenis_usaha.nama_jenis_usaha', orderable:false },
                { data: 'jenis_sertifikasi', name: 'jenis_sertifikasi', orderable:false },
                { data: 'perpanjangan_ke', name: 'perpanjangan_ke', orderable:false },
            ]
        });
</script>
@endsection
