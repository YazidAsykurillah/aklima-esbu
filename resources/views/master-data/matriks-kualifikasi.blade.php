@extends('layouts.app')

@section('page_title')
    Master Data :: Matriks Kualifikasi
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Master Data : Matriks Kualifikasi</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Data Matriks Kualifikasi</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Matriks Kualifikasi</h4>
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
                        <th scope="col">uid_matriks_kualifikasi</th>
                        <th scope="col">jenis_usaha_uid</th>
                        <th scope="col">bidang_uid</th>
                        <th scope="col">sub_bidang_uid</th>
                        <th scope="col">kualifikasi</th>
                        <th scope="col">modal_disetor_min</th>
                        <th scope="col">modal_disetor_maks</th>
                        <th scope="col">pjt_jumlah</th>
                        <th scope="col">pjt_level</th>
                        <th scope="col">tt_jumlah</th>
                        <th scope="col">tt_level</th>
                        <th scope="col">batas_nilai_1_pekerjaan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var table =  $('#table').DataTable({
            processing :true,
            serverSide : true,
            ajax : '{!! url('matriks-kualifikasi/datatables') !!}',
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_matriks_kualifikasi', name: 'uid_matriks_kualifikasi' },
                { data: 'jenis_usaha_uid', name: 'jenis_usaha_uid' },
                { data: 'bidang_uid', name: 'bidang_uid' },
                { data: 'sub_bidang_uid', name: 'sub_bidang_uid' },
                { data: 'kualifikasi', name: 'kualifikasi' },
                { data: 'modal_disetor_min', name: 'modal_disetor_min' },
                { data: 'modal_disetor_maks', name: 'modal_disetor_maks' },
                { data: 'pjt_jumlah', name: 'pjt_jumlah' },
                { data: 'pjt_level', name: 'pjt_level' },
                { data: 'tt_jumlah', name: 'tt_jumlah' },
                { data: 'tt_level', name: 'tt_level' },
                { data: 'batas_nilai_1_pekerjaan', name: 'batas_nilai_1_pekerjaan' },
            ]
        });
    });
</script>
@endsection
