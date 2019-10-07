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
    });
</script>
@endsection
