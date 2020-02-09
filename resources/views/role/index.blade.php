@extends('layouts.app')

@section('page_title')
    Role
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Role</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Role</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Daftar Role</h4>
        <div class="toolbar ml-auto">
            
        </div>
    </div>
    <div class="card-body">
       <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Label</th>
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
            ajax : '{!! url('role/datatables') !!}',
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'code', name: 'code', render:function(data, type, row, meta){
                    var link ='';
                        link+='<a href="{{ url('role') }}/'+row.id+'">';
                        link+= data;  
                        link+='</a>'; 
                    return link;
                }},
                { data: 'name', name: 'name' },
                { data: 'label', name: 'label' },
            ]
        });
   });
</script>
@endsection
