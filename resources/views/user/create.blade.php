@extends('layouts.app')

@section('page_title')
    Create User
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Buat User</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('user') }}" class="breadcrumb-link">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Form Buat User</h4>
        <div class="toolbar ml-auto">
           
        </div>
    </div>
    <div class="card-body">
       <form method="POST" action="{{ url('user') }}" aria-label="{{ __('Store user') }}">
        @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-md-right">{{ __('Nama') }}</label>
                <div class="col-md-6">
                    <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name')}}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label text-md-right">{{ __('Email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email')}}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="role_id" class="col-sm-2 col-form-label text-md-right">{{ __('Role') }}</label>
                <div class="col-md-6">
                    <select class="form-control" id="role_id" name="role_id" placeholder="Pilih Jabatan">
                        <option value="">Pilih Role</option>
                        @foreach($role_options as $role)
                        <option value="{{ $role->id }}">{{$role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('role_id')}}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="provinsi_id" class="col-sm-2 col-form-label text-md-right">{{ __('Provinsi') }}</label>
                <div class="col-md-6">
                    <select class="form-control" id="provinsi_id" name="provinsi_id" placeholder="Pilih Provinsi">
                        <option value="">Pilih Provinsi</option>
                        @foreach($provinsi_options as $provinsi)
                        <option value="{{ $provinsi->uid_provinsi }}">{{$provinsi->nama_provinsi }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('provinsi_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('provinsi_id')}}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
                    </button>

                    <a class="btn btn-link" href="{{ url('user') }}">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
       </form>
    </div>
</div>

@endsection

@section('additional_scripts')
<script type="text/javascript">
   $(document).ready(function(){
        
   });
</script>
@endsection
