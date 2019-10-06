@extends('layouts.app')

@section('page_title')
    Master Data :: Asesor
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Asesor</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Asesor</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Asesor</h4>
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
                        <th scope="col">uid_asesor</th>
                        <th scope="col">nik</th>
                        <th scope="col">nama_asesor</th>
                        <th scope="col">alamat</th>
                        <th scope="col">email</th>
                        <th scope="col">nomor_handphone</th>
                        <th scope="col">is_active</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>"4"</td>
                        <td>"987456321"</td>
                        <td>Coba Asessor</td>
                        <td>Jalan</td>
                        <td>@man</td>
                        <td>"123456"</td>
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
