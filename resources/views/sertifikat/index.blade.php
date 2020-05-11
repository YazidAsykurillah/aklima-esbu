@extends('layouts.app')

@section('page_title')
    Sertifikat
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Sertifikat</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sertifikat</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Daftar Sertifikat</h4>
        <div class="toolbar ml-auto"></div>
    </div>
    <div class="card-body">
       <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor Sertifikat</th>
                        <th scope="col">Nomor Registrasi</th>
                        <th scope="col">Nomor Seri</th>
                        <th scope="col">Badan Usaha</th>
                        <th scope="col">Jenis Usaha</th>
                        <th scope="col">Bidang</th>
                        <th scope="col">Sub Bidang</th>
                        <th scope="col">Kualifikasi</th>
                        <th scope="col">Tanggal Terbit</th>
                        <th scope="col">Tanggal Expired</th>
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
            ajax : '{!! url('sertifikat/datatables') !!}',
            columns :[
                { data: 'rownum', name: 'rownum', searchable:false },
                { data: 'nomor_sertifikat', name: 'nomor_sertifikat', render:function(data, type, row, meta){
                    let temp =data;
                        temp+='<br/>';
                        temp+='<a class="btn btn-brand btn-xs" href="{{ url('sertifikat') }}/'+row.id+'/print-pdf">';
                        temp+=  '<i class="fa fa-print"></i>';
                        temp+='</a>';
                    return temp;
                }},
                { data: 'nomor_registrasi', name: 'nomor_registrasi' },
                { data: 'nomor_seri', name: 'nomor_seri' },
                { data: 'nama_badan_usaha', name: 'permohonan.badan_usaha.nama_badan_usaha' },
                { data: 'uid_jenis_usaha', name: 'jenis_usaha.nama_jenis_usaha', render:function(data, type, row, meta){
                    return row.jenis_usaha.nama_jenis_usaha;
                }},
                { data: 'uid_bidang', name: 'sub_bidang.bidang.nama_bidang', render:function(data, type, row, meta){
                    return row.sub_bidang.bidang.nama_bidang;
                }},
                { data: 'uid_sub_bidang', name: 'sub_bidang.nama_sub_bidang', render:function(data, type, row, meta){
                    return row.sub_bidang.nama_sub_bidang;
                }},
                { data: 'kualifikasi', name: 'kualifikasi' },
                { data: 'tanggal_terbit', name: 'tanggal_terbit' },
                { data: 'tanggal_expired', name: 'tanggal_expired' },
            ]
        });
   });
</script>
@endsection
