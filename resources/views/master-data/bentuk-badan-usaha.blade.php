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
                        <th scope="col">Nama Bentuk Badan Usaha</th>
                        <th scope="col">Nama Singkat</th>
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
    });
    
</script>
@endsection
