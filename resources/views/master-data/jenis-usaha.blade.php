@extends('layouts.app')

@section('page_title')
    Master Data :: Jenis Usaha
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Jenis Usaha</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Jenis Usaha</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Jenis Usaha</h4>
        <div class="toolbar ml-auto">
            <a href="#" class="btn btn-primary btn-sm ">
                <i class="fas fa-sync"></i> Sinkronisasi
            </a>
            <!-- <a href="#" class="btn btn-light btn-sm">PDF</a> -->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">UID</th>
                        <th scope="col">Kode Jenis Usaha</th>
                        <th scope="col">Nama Jenis Usaha</th>
                        <th scope="col">Is Active</th>
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
            ajax : '{!! url('jenis-usaha/datatables') !!}',
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_jenis_usaha', name: 'uid_jenis_usaha' },
                { data: 'kode_jenis_usaha', name: 'kode_jenis_usaha' },
                { data: 'nama_jenis_usaha', name: 'nama_jenis_usaha' },
                { data: 'is_active', name: 'is_active' },
            ]
        });
    });
</script>
@endsection
