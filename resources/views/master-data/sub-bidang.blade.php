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
    });
</script>
@endsection
