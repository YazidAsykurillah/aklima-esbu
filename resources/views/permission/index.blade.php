@extends('layouts.app')

@section('page_title')
    Permission
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Permission</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permission</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Permission List</h4>
        <div class="toolbar ml-auto">
            <button type="button" id="btn-create-permission" class="btn btn-primary btn-xs" title="Create new Permission">
                <i class="fa fa-plus-circle"></i> Create
            </button>
        </div>
    </div>
    <div class="card-body">
       <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!--Modal Create Permission-->
<div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog" aria-labelledby="createPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-create-permission" method="post" enctype="multipart/form-data" action="{{ url('permission') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPermissionModalLabel">Create Permission</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="slug" class="col-form-label">Slug</label>
                        <input name="slug" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light btn-xs" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-save">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Create Permission-->
@endsection

@section('additional_scripts')
<script type="text/javascript">
   $(document).ready(function(){
        var table =  $('#table').DataTable({
            processing :true,
            serverSide : true,
            ajax : '{!! url('permission/datatables') !!}',
            columns :[
                { data: 'rownum', name: 'rownum', searchable:false},
                { data: 'slug', name: 'slug' },
                { data: 'description', name: 'description' },
            ]
        });

        $('#btn-create-permission').on('click', function(event){
            event.preventDefault();
            $('#createPermissionModal').modal('show');
        });

        $('#form-create-permission').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend:function(){
                    $('#btn-save').prop('disabled', true);
                },
                success: function(response){
                    console.log(response);
                    if(response.response == 1){
                        alertify.notify(response.message, 'success', 2, function(){
                            $('#form-create-permission')[0].reset();
                            $('#createPermissionModal').modal('hide');
                            table.ajax.reload();
                        });
                        
                    } else{
                        alertify.notify(response.message, 'error', 5, function(){
                            $('#btn-save').prop('disabled', false);
                        });
                        
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let objResponse = jqXHR.responseJSON;
                    let message = objResponse.message;
                    let errors = objResponse.errors;
                    let error_template = message;
                    
                    if(errors){
                        $.each( errors, function( key, value ) {
                            console.log(value);
                            error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
                        });
                    }
                    alertify.notify(error_template, textStatus, 5, function(){
                        console.log(errors);
                        $('#btn-save').prop('disabled', false);
                    });
                    
                }
            });
        });
   });
</script>
@endsection
