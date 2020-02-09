@extends('layouts.app')

@section('page_title')
    Role Detail
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Role Detail</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('role') }}" class="breadcrumb-link">Role</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $role->code }}</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">Role Information</h4>
                <div class="toolbar ml-auto">
                    
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                       <tbody>
                           <tr>
                               <td style="width:10%;">Code</td>
                               <td style="width:5%;">:</td>
                               <td style="">{{ $role->code }}</td>
                           </tr>
                           <tr>
                               <td style="width:10%;">Name</td>
                               <td style="width:5%;">:</td>
                               <td style="">{{ $role->name }}</td>
                           </tr>
                       </tbody>
                   </table>     
                </div>
               
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <form id="form-update-role-permission" action="{{ url('role/update-permission') }}" method="POST">
                @csrf
            <div class="card-header d-flex">
                <h4 class="card-header-title">Permissions</h4>
                <div class="toolbar ml-auto">
                    
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="permission-role">
                        <thead>
                            <tr>
                                <th style="width:15%;text-align:center;">
                                    <button id="btn-check-uncheck-all" type="button" data-state="1" class="btn btn-xs">
                                        <text id="btn-check-uncheck-actor" style="color:black">Check ALL</text>
                                    </button>
                                </th>
                                <th style="width:25%;">Permission Slug</th>
                                <th style="">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                              <td style="text-align:center">
                                @if($role->permissions->contains('slug', $permission->slug))
                                  <input type="checkbox" name="permission_id[]" class="permission_id" value="{{ $permission->id }}" checked>
                                @else
                                  <input type="checkbox" name="permission_id[]" class="permission_id" value="{{ $permission->id }}">
                                @endif
                              </td>
                              <td>{{ $permission->slug }}</td>
                              <td>{{ $permission->description }}</td>

                            </tr>

                            @endforeach
                        </tbody>
                   </table>     
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="role_id" value="{{ $role->id }}" />
                <button type="submit" class="btn btn-info pull-right">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('additional_scripts')
<script type="text/javascript">
   $(document).ready(function(){
        $('#btn-check-uncheck-all').on('click', function(event){
          event.preventDefault();
          if($(this).attr('data-state') == "1"){
            $('.permission_id').prop('checked', true);
            $('#btn-check-uncheck-all').attr('data-state', '2');
            $('#btn-check-uncheck-actor').html("Uncheck All");
          }
          else{
            $('.permission_id').prop('checked', false);
            $('#btn-check-uncheck-all').attr('data-state', '1');
            $('#btn-check-uncheck-actor').html("Check All");
          }
        });
   });
</script>
@endsection
