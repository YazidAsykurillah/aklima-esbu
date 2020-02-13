@extends('layouts.app')

@section('page_title')
    Permohonan :: {{ translate_status_permohonan($status) }}
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Permohonan : {{ translate_status_permohonan($status) }}</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Permohonan {{ translate_status_permohonan($status) }}
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-header-title">Daftar Permohonan :: {{ translate_status_permohonan($status) }}</h4>
        <div class="toolbar ml-auto">
           
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col" style="width:5%;">#</th>
                        <th scope="col" style="width:5%;">Detail</th>
                        <th scope="col">Nama Badan Usaha</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col" style="width:15%;">Jenis Usaha</th>
                        <th scope="col" style="width:10%;">Jenis Sertifikasi</th>
                        <th scope="col" style="width:10%;">Perpanjangan Ke</th>
                        <th scope="col" style="width:10%;">Asesor TT</th>
                        <th scope="col" style="width:10%;">Asesor PJT</th>
                        <th scope="col" style="width:15%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!--Modal Change Status-->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-change-status" method="post" action="{{ url('permohonan/change-status') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel">Ubah Status Permohonan</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p id="change_status_confirmation_text"></p>
                    <div class="form-group">
                        <label for="log_description" class="col-form-label">Description</label>
                        <textarea name="log_description" id="log_description" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="permohonan_original_status" id="permohonan_original_status" />
                    <input type="hidden" name="permohonan_next_status" id="permohonan_next_status" />
                    <input type="hidden" name="permohonan_id_to_change" id="permohonan_id_to_change" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Change Status-->

<!--Modal Add Asesor TT-->
<div class="modal fade" id="addAsesorTTModal" tabindex="-1" role="dialog" aria-labelledby="addAsesorTTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-asesor-tt" method="post" action="{{ url('permohonan/add-asesor-tt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAsesorTTModalLabel">Tambah Asesor TT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="asesor_tt_id" class="col-form-label">Asesor TT</label>
                        <select name="asesor_tt_id" id="asesor_tt_id" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="peran" class="col-form-label">Peran</label>
                        <select name="peran" id="peran" class="form-control" required>
                            <option>--Pilih Peran--</option>
                            <option value="KETUA">Ketua</option>
                            <option value="ANGGOTA">Anggota</option>
                        </select>
                    </div>
                    <input type="hidden" name="uid_permohonan_to_add_asesor_tt" id="uid_permohonan_to_add_asesor_tt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Asesor TT-->

<!--Modal Delete Asesor TT-->
<div class="modal fade" id="deleteAsesorTTModal" tabindex="-1" role="dialog" aria-labelledby="deleteAsesorTTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-delete-asesor-tt" method="post" action="{{ url('permohonan/delete-asesor-tt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAsesorTTModalLabel">Hapus Asesor TT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    
                    <input type="hidden" name="uid_permohonan_asesor_tt" id="uid_permohonan_asesor_tt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Asesor TT-->



<!--Modal Add Asesor PJT-->
<div class="modal fade" id="addAsesorPJTModal" tabindex="-1" role="dialog" aria-labelledby="addAsesorPJTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-asesor-pjt" method="post" action="{{ url('permohonan/add-asesor-pjt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAsesorPJTModalLabel">Tambah Asesor PJT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="asesor_pjt_id" class="col-form-label">Asesor PJT</label>
                        <select name="asesor_pjt_id" id="asesor_pjt_id" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="peran" class="col-form-label">Peran</label>
                        <select name="peran" id="peran" class="form-control" required>
                            <option>--Pilih Peran--</option>
                            <option value="KETUA">Ketua</option>
                            <option value="ANGGOTA">Anggota</option>
                        </select>
                    </div>
                    <input type="hidden" name="uid_permohonan_to_add_asesor_pjt" id="uid_permohonan_to_add_asesor_pjt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Asesor PJT-->

<!--Modal Delete Asesor PJT-->
<div class="modal fade" id="deleteAsesorPJTModal" tabindex="-1" role="dialog" aria-labelledby="deleteAsesorPJTModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-delete-asesor-pjt" method="post" action="{{ url('permohonan/delete-asesor-pjt') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAsesorPJTModalLabel">Hapus Asesor PJT</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    
                    <input type="hidden" name="uid_permohonan_asesor_pjt" id="uid_permohonan_asesor_pjt" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-update-status">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Asesor PJT-->

@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var table =  $('#table').DataTable({
            processing :true,
            serverSide : true,
            ajax: {
                url: '{!! url('permohonan/datatables') !!}',
                "data": function ( d ) {
                    d.status = '{!! $status !!}';
                    d.is_processed = 1;
                }
            },
            columns :[
                {data: 'rownum', name: 'rownum', searchable:false},
                { data: 'uid_permohonan', name: 'uid_permohonan', orderable:false, searchable:false, render:function(data, type, row, meta){
                    var link = '';
                        link+= '<a href="{{ url('permohonan')}}/'+data+'">';
                        
                        if(row.status == 'SBU Sudah Diregistrasi'){
                            link+=      '<i class="fa fa-print"></i>';  
                        }else{
                            link+=      '<i class="fa fa-link"></i>'; 
                        }
                        
                        link+= '</a>';
                    return link;
                }},
                { data: 'nama_badan_usaha', name: 'badan_usaha.nama_badan_usaha', orderable:true },
                { data: 'provinsi_badan_usaha', name: 'badan_usaha.kota.provinsi.nama_provinsi', orderable:true },
                { data: 'nama_jenis_usaha', name: 'jenis_usaha.nama_jenis_usaha', orderable:false },
                { data: 'jenis_sertifikasi', name: 'jenis_sertifikasi', orderable:false },
                { data: 'perpanjangan_ke', name: 'perpanjangan_ke', orderable:false },
                { data: 'asesor_tt_id', name: 'asesor_tt_id', orderable:false },
                { data: 'asesor_pjt_id', name: 'asesor_pjt_id', orderable:false },
                { data: 'actions', name: 'actions', orderable:false, searchable:false, className:'text-center' },   
            ]
        });

        //Handler Change status
        table.on('click','.btn-change-status', function(event){
            event.preventDefault();
            var permohonan_original_status = $(this).attr('data-original-status');
            var permohonan_next_status = $(this).attr('data-next-status');
            var permohonan_id_to_change = $(this).attr('data-uid-permohonan');
            var text_next_status = $(this).attr('title');
            $('#change_status_confirmation_text').html(text_next_status);
            $('#changeStatusModalLabel').html(text_next_status);
            $('#permohonan_original_status').val(permohonan_original_status);
            $('#permohonan_next_status').val(permohonan_next_status);
            $('#permohonan_id_to_change').val(permohonan_id_to_change);
            $('#changeStatusModal').modal('show');

        });
        //ENDHandler Change status

        var selected_provinsi_id = null;
        //Handler Select Asesor TT
        $('#asesor_tt_id').select2({
            placeholder : 'Pilih Asesor TT',
            ajax: {
            url: '{!! url('asesor/select2') !!}',
              dataType: 'json',
              delay: 250,
              data: function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                        provinsi_id : selected_provinsi_id
                    };
                },
              processResults: function (data) {
                return {
                  results:  $.map(data, function (item) {
                        return {
                            text: item.nama_asesor,
                            id: item.uid_asesor,
                        }
                    })
                };
              },
              cache: true
            },
            allowClear : true,
        });
        //ENDHandler Select Asesor TT

        //Handler Add Asesor TT
        table.on('click', '.btn-add-asesor-tt', function(event){
            event.preventDefault();
            selected_provinsi_id = $(this).attr('data-provinsi-id');
            $('#uid_permohonan_to_add_asesor_tt').val($(this).attr('data-uid-permohonan'));
            $('#addAsesorTTModal').modal('show');


        });
        //ENDHandler Add Asesor TT

        //Handler Delete Asessor TT
        table.on('click', '.btn-delete-asesor-tt', function(event){
            event.preventDefault();
            var uid_permohonan_asesor_tt = $(this).attr('data-uid-permohonan-asesor');
            $('#uid_permohonan_asesor_tt').val(uid_permohonan_asesor_tt);
            $('#deleteAsesorTTModal').modal('show');

        });
        //ENDHandler Delete Asessor TT



        //Handler Select Asesor PJT
        $('#asesor_pjt_id').select2({
            placeholder : 'Pilih Asesor PJT',
            ajax: {
              url: '{!! url('asesor/select2') !!}',
              dataType: 'json',
              delay: 250,
              data: function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                        provinsi_id : selected_provinsi_id
                    };
                },
              processResults: function (data) {
                return {
                  results:  $.map(data, function (item) {
                        return {
                            text: item.nama_asesor,
                            id: item.uid_asesor,
                        }
                    })
                };
              },
              cache: true
            },
            allowClear : true,
        });
        //ENDHandler Select Asesor PJT

        //Handler Add Asesor PJT
        table.on('click', '.btn-add-asesor-pjt', function(event){
            event.preventDefault();
            selected_provinsi_id = $(this).attr('data-provinsi-id');
            $('#uid_permohonan_to_add_asesor_pjt').val($(this).attr('data-uid-permohonan'));
            $('#addAsesorPJTModal').modal('show');
        });
        //ENDHandler Add Asesor PJT

        //Handler Delete Asessor PJT
        table.on('click', '.btn-delete-asesor-pjt', function(event){
            event.preventDefault();
            var uid_permohonan_asesor_pjt = $(this).attr('data-uid-permohonan-asesor');
            $('#uid_permohonan_asesor_pjt').val(uid_permohonan_asesor_pjt);
            $('#deleteAsesorPJTModal').modal('show');

        });
        //ENDHandler Delete Asessor PJT
    });
</script>
@endsection
