@extends('layouts.app')

@section('page_title')
    User Detail
@endsection

@section('page_header_title')
<h2 class="pageheader-title">User Detail</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('user') }}" class="breadcrumb-link">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Show</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">User Detail</h4>
                <div class="toolbar ml-auto"></div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 10%;">Name</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">Email</td>
                            <td style="width: 5%;">:</td>
                            <td style="">{{ $user->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">Roles</h4>
                <div class="toolbar ml-auto"></div>
            </div>
            <div class="card-body">
                @foreach($roles as $role)
                <label class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" {{ $user->roles->contains('code', $role->code) ? 'checked':'' }}>
                    <span class="custom-control-label">{{ $role->name }}</span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
@endsection
