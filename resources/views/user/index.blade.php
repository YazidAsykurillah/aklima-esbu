@extends('layouts.app')

@section('page_title')
    User
@endsection

@section('page_header_title')
<h2 class="pageheader-title">User</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Daftar User</h4>
        <div class="toolbar ml-auto">
            <a href="{{ url('user/create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle"></i> Tambah User Baru
            </a>
        </div>
    </div>
    <div class="card-body">
       <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Provinsi</th>
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
            ajax : '{!! url('user/datatables') !!}',
            columns :[
                { data: 'rownum', name: 'rownum', searchable:false },
                { data: 'name', name: 'name', render:function(data, type, row, meta){
                    var link ='';
                        link+='<a href="{{ url('user') }}/'+row.id+'">';
                        link+=  data;
                        link+='</a>';
                    return link;
                }},
                { data: 'username', name: 'username' },
                { data: 'email', name: 'email' },
                { data: 'roles', name: 'roles.name' },
                { data: 'provinsi_nama_provinsi', name: 'provinsi.nama_provinsi' },
            ]
        });
   });
</script>
@endsection
