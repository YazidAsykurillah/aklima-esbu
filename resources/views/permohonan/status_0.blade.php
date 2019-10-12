@extends('layouts.app')

@section('page_title')
    Permohonan :: Menunggu Dokumen
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Permohonan : Menunggu Dokumen</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permohonan Menunggu Dokumen</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Menunggu Dokumen</h4>
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
                        <th scope="col">Nomor Pendaftaran</th>
                        <th scope="col">Nama Badan Usaha</th>
                        <th scope="col">Preview SBU</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>----</td>
                        <td>PT ABC</td>
                        <td>
                            <a href="#" class="btn btn-light btn-xs"><i class="fas fa-bullseye"></i> Sub Bidang 1</a>
                            <a href="#" class="btn btn-light btn-xs"><i class="fas fa-bullseye"></i> Sub Bidang 2</a>
                        </td>
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
