@extends('layouts.app')

@section('page_title')
    Permohonan :: All
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Permohonan : All</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permohonan All</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">All</h4>
        <div class="toolbar ml-auto">
           
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">UID Permohonan</th>
                        <th scope="col">Jenis Usaha</th>
                        <th scope="col">Jenis Sertifikasi</th>
                        <th scope="col">Perpanjangan Ke</th>
                        <th scope="col">Nama Badan Usaha</th>
                        <th scope="col">Bentuk Badan Usaha</th>
                        <th scope="col">Alamat Badan Usaha</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
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
            //ajax : '{!! url('permohonan/datatables') !!}',
            ajax: {
                url: '{!! url('permohonan/datatables') !!}',
                "data": function ( d ) {
                    d.status = '{!! $status !!}';
                }
            },
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_permohonan', name: 'uid_permohonan', render:function(data, type, row, meta){
                    var link = '';
                        link+= '<a href="{{ url('permohonan')}}/'+data+'">';
                        link+=    data;
                        link+= '</a>';
                    return link;
                }},
                { data: 'nama_jenis_usaha', name: 'jenis_usaha.nama_jenis_usaha', orderable:false },
                { data: 'jenis_sertifikasi', name: 'jenis_sertifikasi', orderable:false },
                { data: 'perpanjangan_ke', name: 'perpanjangan_ke', orderable:false },
                { data: 'nama_badan_usaha', name: 'badan_usaha.nama_badan_usaha', orderable:false },
                { data: 'nama_bentuk_badan_usaha', name: 'badan_usaha.bentuk_badan_usaha.nama_bentuk_badan_usaha', orderable:false },
                { data: 'alamat_badan_usaha', name: 'badan_usaha.alamat_badan_usaha', orderable:false, searchable:false },
                {data: 'status', name: 'status', orderable:true, searchable:true},
                { data: 'jenis_usaha_uid', name: 'jenis_usaha_uid', visible:false },
                { data: 'badan_usaha_uid', name: 'badan_usaha_uid', visible:false },
                
            ]
        });
    });
</script>
@endsection
