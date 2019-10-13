@extends('layouts.app')

@section('page_title')
    Master Data :: Sub Bidang
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Sub Bidang</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Sub Bidang</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Sub Bidang</h4>
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
                        <th scope="col">UID Sub Bidang</th>
                        <th scope="col">Kode Sub Bidang</th>
                        <th scope="col">Nama Sub Bidang</th>
                        <th scope="col">UID Bidang</th>
                        <th scope="col">Nama Bidang</th>
                        <th scope="col">UID Jenis Usaha</th>
                        <th scope="col">Nama Jenis Usaha</th>
                        <th scope="col">Is Active</th>
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
                <h5 class="modal-title" id="synchModalLabel">Sinkronisasi Sub Bidang</h5>
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
            ajax : '{!! url('sub-bidang/datatables') !!}',
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_sub_bidang', name: 'uid_sub_bidang' },
                { data: 'kode_sub_bidang', name: 'kode_sub_bidang' },
                { data: 'nama_sub_bidang', name: 'nama_sub_bidang' },
                { data: 'uid_bidang', name: 'uid_bidang' },
                { data: 'nama_bidang', name: 'bidang.nama_bidang' },
                { data: 'uid_jenis_usaha', name: 'uid_jenis_usaha' },
                { data: 'nama_jenis_usaha', name: 'jenis_usaha.nama_jenis_usaha' },
                { data: 'is_active', name: 'is_active' },
            ]
        });

        //Synchronize handler
        $('#btn-synchronize').on('click', function(event){
            event.preventDefault();
            $('#btn-synchronize').prop('disabled', true);
            var _token = "{{ csrf_token() }}";
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '{{ url('sub-bidang/synchronize') }}', // This is the url we gave in the route
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
