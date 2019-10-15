@extends('layouts.app')

@section('page_title')
    Master Data :: Matriks Kualifikasi
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Matriks Kualifikasi</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Matriks Kualifikasi</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Matriks Kualifikasi</h4>
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
                        <th scope="col">UID Matriks Kualifikasi</th>
                        <th scope="col">Nama Jenis Usaha</th>
                        <th scope="col">Nama Bidang</th>
                        <th scope="col">Nama Sub Bidang</th>
                        <th scope="col">Kualifikasi</th>
                        <th scope="col">Modal Disetor Min</th>
                        <th scope="col">Modal Disetor Maks</th>
                        <th scope="col">Jumlah PJT</th>
                        <th scope="col">Level PJT</th>
                        <th scope="col">Jumlah TT</th>
                        <th scope="col">Level TT</th>
                        <th scope="col">Batas Nilai 1 Pekerjaan</th>
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
                <h5 class="modal-title" id="synchModalLabel">Sinkronisasi Matriks Kualifikasi</h5>
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
            ajax : '{!! url('matriks-kualifikasi/datatables') !!}',
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_matriks_kualifikasi', name: 'uid_matriks_kualifikasi' },
                { data: 'nama_jenis_usaha', name: 'jenis_usaha.nama_jenis_usaha' },
                { data: 'nama_bidang', name: 'bidang.nama_bidang' },
                { data: 'nama_sub_bidang', name: 'sub_bidang.nama_sub_bidang' },
                { data: 'kualifikasi', name: 'kualifikasi' },
                { data: 'modal_disetor_min', name: 'modal_disetor_min' },
                { data: 'modal_disetor_maks', name: 'modal_disetor_maks' },
                { data: 'pjt_jumlah', name: 'pjt_jumlah' },
                { data: 'pjt_level', name: 'pjt_level' },
                { data: 'tt_jumlah', name: 'tt_jumlah' },
                { data: 'tt_level', name: 'tt_level' },
                { data: 'batas_nilai_1_pekerjaan', name: 'batas_nilai_1_pekerjaan' },
            ]
        });


        //Synchronize handler
        $('#btn-synchronize').on('click', function(event){
            event.preventDefault();
            $('#btn-synchronize').prop('disabled', true).html('<i class="fas fa-hourglass"></i> Processing');
            var _token = "{{ csrf_token() }}";
            $.ajax({
                method: 'POST', // Type of response and matches what we said in the route
                url: '{{ url('matriks-kualifikasi/synchronize') }}', // This is the url we gave in the route
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
