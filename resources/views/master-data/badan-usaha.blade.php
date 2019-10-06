@extends('layouts.app')

@section('page_title')
    Master Data :: Badan Usaha
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Badan Usaha</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Badan Usaha</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Badan Usaha</h4>
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
                        <th scope="col">uid_badan_usaha</th>
                        <th scope="col">bentuk_badan_usaha_uid</th>
                        <th scope="col">nama_badan_usaha</th>
                        <th scope="col">alamat_badan_usaha</th>
                        <th scope="col">kelurahan_uid</th>
                        <th scope="col">kecamatan_uid</th>
                        <th scope="col">kota_uid</th>
                        <th scope="col">nama_kecamatan</th>
                        <th scope="col">nama_kelurahan</th>
                        <th scope="col">no_telp_kantor</th>
                        <th scope="col">no_hp_kantor</th>
                        <th scope="col">no_fax</th>
                        <th scope="col">website</th>
                        <th scope="col">nik_penanggung_jawab</th>
                        <th scope="col">nama_penanggung_jawab</th>
                        <th scope="col">jenis_kewarganegaraan</th>
                        <th scope="col">kewarganegaraan</th>
                        <th scope="col">passport</th>
                        <th scope="col">no_telepon_penanggung_jawab</th>
                        <th scope="col">email_perusahaan</th>
                    </tr>
                </thead>
                <tbody>
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
