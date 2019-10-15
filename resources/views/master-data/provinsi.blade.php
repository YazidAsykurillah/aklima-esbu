@extends('layouts.app')

@section('page_title')
    Master Data :: Provinsi
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Provinsi</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Provinsi</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Provinsi</h4>
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
                        <th scope="col">uid provinsi</th>
                        <th scope="col">Kode provinsi</th>
                        <th scope="col">Nama provinsi</th>
                        <th scope="col">is active</th>
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
                <h5 class="modal-title" id="synchModalLabel">Sinkronisasi Provinsi</h5>
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
            ajax : '{!! url('provinsi/datatables') !!}',
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_provinsi', name: 'uid_provinsi' },
                { data: 'kode_provinsi', name: 'kode_provinsi' },
                { data: 'nama_provinsi', name: 'nama_provinsi' },
                { data: 'is_active', name: 'is_active' },
            ]
        });


        //Synchronize handler
        $('#btn-synchronize').on('click', function(event){
            event.preventDefault();
            $('#btn-synchronize').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            var _token = "{{ csrf_token() }}";
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '{{ url('provinsi/synchronize') }}', // This is the url we gave in the route
                data: {'_token' : _token}, // a JSON object to send back
                success: function(response){ // What to do if we succeed
                    console.log(response);
                    if(response.response == 1){
                        $('#synchModal').modal('hide');
                        table.ajax.reload();
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                        resetSynchronizeButton();
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
