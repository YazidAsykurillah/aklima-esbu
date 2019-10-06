@extends('layouts.app')

@section('page_title')
    Master Data :: Kelurahan
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Kelurahan</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Kelurahan</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Kelurahan</h4>
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
                        <th scope="col">uid_kelurahan</th>
                        <th scope="col">kecamatan_uid</th>
                        <th scope="col">nama</th>
                        <th scope="col">jenis</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>"1101012001"</td>
                        <td>"110101"</td>
                        <td>Keude Bakongan</td>
                        <td>4</td>
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
