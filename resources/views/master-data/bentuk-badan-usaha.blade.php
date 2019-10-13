@extends('layouts.app')

@section('page_title')
    Master Data :: Bentuk Badan Usaha
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Bentuk Badan Usaha</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Bentuk Badan Usaha</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Bentuk Badan Usaha</h4>
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
                        <th scope="col">UID</th>
                        <th scope="col">Nama Bentuk Badan Usaha</th>
                        <th scope="col">Nama Singkat</th>
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
                <h5 class="modal-title" id="synchModalLabel">Sinkronisasi Bentuk Badan Usaha</h5>
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
<!-- Modal Synchronize -->
@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        
        var table =  $('#table').DataTable({
            processing :true,
            serverSide : true,
            ajax: {
                "url": "{{url('bentuk-badan-usaha/datatables')}}",
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
            },
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_bentuk_badan_usaha', name: 'uid_bentuk_badan_usaha' },
                { data: 'nama_bentuk_badan_usaha', name: 'nama_bentuk_badan_usaha' },
                { data: 'nama_singkat', name: 'nama_singkat' },
            ]
        });

        //Synchronize handler
        $('#btn-synchronize').on('click', function(event){
            event.preventDefault();
            $('#btn-synchronize').prop('disabled', true);
            var _token = "{{ csrf_token() }}";
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '{{ url('bentuk-badan-usaha/synchronize') }}', // This is the url we gave in the route
                data: {'_token' : _token}, // a JSON object to send back
                success: function(response){ // What to do if we succeed
                    console.log(response);
                    if(response.response == 1){
                        $('#synchModal').modal('hide');
                        table.ajax.reload();
                        $('#btn-synchronize').prop('disabled', false);
                        alertify.notify(response.message, 'success', 5, function(){  console.log('dismissed'); });
                    } 
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        });
        
    });
    
</script>
@endsection
