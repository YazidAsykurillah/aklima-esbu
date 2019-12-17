@extends('layouts.app')

@section('page_title')
    Permohonan :: {{ translate_status_permohonan($status) }}
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Permohonan : {{ translate_status_permohonan($status) }}</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permohonan {{ translate_status_permohonan($status) }}</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Daftar Permohonan :: {{ translate_status_permohonan($status) }}</h4>
        <div class="toolbar ml-auto">
           
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
                        <th scope="col" style="width:15%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
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
                    <input type="hidden" name="permohonan_original_status" id="permohonan_original_status" />
                    <input type="hidden" name="permohonan_next_status" id="permohonan_next_status" />
                    <input type="hidden" name="permohonan_id_to_change" id="permohonan_id_to_change" />
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

@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var table =  $('#table').DataTable({
            processing :true,
            serverSide : true,
            //ajax : '{!! url('permohonan/datatables') !!}',
            ajax: {
                url: '{!! url('permohonan/datatables') !!}',
                "data": function ( d ) {
                    d.status = '{!! $status !!}';
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
                { data: 'actions', name: 'actions', orderable:false, searchable:false, className:'text-center' },   
            ]
        });

        //Handler Change status
        table.on('click','.btn-change-status', function(event){
            event.preventDefault();
            var permohonan_original_status = $(this).attr('data-original-status');
            var permohonan_next_status = $(this).attr('data-next-status');
            var permohonan_id_to_change = $(this).attr('data-uid-permohonan');
            var text_next_status = $(this).attr('title');
            $('#change_status_confirmation_text').html(text_next_status);
            $('#changeStatusModalLabel').html(text_next_status);
            $('#permohonan_original_status').val(permohonan_original_status);
            $('#permohonan_next_status').val(permohonan_next_status);
            $('#permohonan_id_to_change').val(permohonan_id_to_change);
            $('#changeStatusModal').modal('show');

        });
        //ENDHandler Change status
    });
</script>
@endsection
