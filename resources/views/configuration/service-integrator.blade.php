@extends('layouts.app')

@section('page_title')
    Configuration :: Service Integrator
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Configuration : Service Integrator</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configuration Service Integrator</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">Username & X-LSBU-Key</h4>
            </div>
            <div class="card-body">
               <form>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username</label>
                        <input id="username" type="text" class="form-control" value="{{ $service_integrator->username }}">
                    </div>
                    <div class="form-group">
                        <label for="x_lsbu_key" class="col-form-label">X-LSBU-Key</label>
                        <input id="x_lsbu_key" type="text" class="form-control" value="{{ $service_integrator->x_lsbu_key }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label"></label>
                        <button type="submit" id="btn-test-coneection" class="btn btn-primary">Test Connection</button>
                    </div>
               </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">Token</h4>
            </div>
            <div class="card-body">
               <form>
                    <div class="form-group">
                        <label for="token" class="col-form-label">Token</label>
                        <input id="token" type="text" class="form-control" value="{{ $service_integrator->token }}">
                    </div>
                    <div class="form-group">
                        <label for="expired" class="col-form-label">Expired</label>
                        <input id="expired" type="text" class="form-control" value="{{ $service_integrator->expired }}" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label"></label>
                        <button type="submit" id="btn-generate-token" class="btn btn-primary">Generate Token</button>
                    </div>
               </form>
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
