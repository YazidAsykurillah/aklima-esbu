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
                        <th scope="col">UID Matriks Kualifikasi</th>
                        <th scope="col">Nama Jenis Usaha</th>
                        <th scope="col">Nama Bidang</th>
                        <th scope="col">Nama Sub Bidang</th>
                        <th scope="col">Kualifikasi</th>
                        <th scope="col">Modal Disetor Min</th>
                        <th scope="col">Modal Disetor Maks</th>
                        <th scope="col">Jumlah PJT</th>
                        <th scope="col">Level PJT</th>
                        <th scope="col">Jumlah TT</th>
                        <th scope="col">Level TT</th>
                        <th scope="col">Batas Nilai 1 Pekerjaan</th>
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
                { data: 'nama_jenis_usaha', name: 'jenis_usaha.nama_jenis_usaha' },
                { data: 'nama_bidang', name: 'bidang.nama_bidang' },
                { data: 'nama_sub_bidang', name: 'sub_bidang.nama_sub_bidang' },
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
