@extends('layouts.app')

@section('page_title')
    Master Data :: Kota
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Kota</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Kota</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Kota</h4>
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
                        <th scope="col">provinsi_uid</th>
                        <th scope="col">kode_provinsi</th>
                        <th scope="col">nama_provinsi</th>
                        <th scope="col">uid_kota</th>
                        <th scope="col">kode_kota</th>
                        <th scope="col">nama_kota</th>
                        <th scope="col">is_active</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>11</td>
                        <td>11</td>
                        <td>Aceh</td>
                        <td>1105</td>
                        <td>1105</td>
                        <td>KAB. ACEH BARAT</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var table =  $('#table').DataTable({});
    });
</script>
@endsection
