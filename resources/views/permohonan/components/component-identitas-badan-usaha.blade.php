<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">Identitas Badan Usaha</h4>
                <div class="toolbar ml-auto">
                   <a href="#" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#addIBUModal">
                        <i class="fas fa-plus-circle"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td style="width: 30%;">UID Verifikasi</td>
                            <td style="width: 5%;">:</td>
                            <td style="" id="ibu_holder_uid_verifikasi_ibu"></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">File Surat Permohoan SBU</td>
                            <td style="width: 5%;">:</td>
                            <td style="" id="ibu_holder_file_surat_permohonan_sbu"></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Nomor Surat</td>
                            <td style="width: 5%;">:</td>
                            <td style="" id="ibu_holder_nomor_surat"></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Perihal</td>
                            <td style="width: 5%;">:</td>
                            <td style="" id="ibu_holder_perihal"></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Tanggal Surat</td>
                            <td style="width: 5%;">:</td>
                            <td style="" id="ibu_holder_tanggal_surat"></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Nama Penandatanganan Surat</td>
                            <td style="width: 5%;">:</td>
                            <td style="" id="ibu_holder_nama_penandatangan_surat"></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Jabatan Penandatanganan Surat</td>
                            <td style="width: 5%;">:</td>
                            <td style="" id="ibu_holder_jabatan_penandatangan_surat"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal Tambah Identitas Badan Usaha-->
<div class="modal fade" id="addIBUModal" tabindex="-1" role="dialog" aria-labelledby="addIBUModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-tambah-identitas-badan-usaha" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIBUModalLabel">Tambah Identitas Badan Usaha</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="custom-file mb-3">
                        <label class="custom-file-label" for="file_surat_permohonan_sbu">File Surat Permohonan SBU</label>
                        <input type="file" class="custom-file-input" id="file_surat_permohonan_sbu" name="file_surat_permohonan_sbu">
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat" class="col-form-label">Nomor Surat</label>
                        <input id="nomor_surat" name="nomor_surat" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="perihal" class="col-form-label">Perihal</label>
                        <input id="perihal" name="perihal" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat" class="col-form-label">Tanggal Surat</label>
                        <div class="input-group date" id="tanggal_surat" data-target-input="nearest">
                            <input type="text" id="tanggal_surat" name="tanggal_surat" class="form-control datetimepicker-input" data-target="#tanggal_surat" />
                            <div class="input-group-append" data-target="#tanggal_surat" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_penandatangan_surat" class="col-form-label">Nama Penandatangan Surat</label>
                        <input id="nama_penandatangan_surat" name="nama_penandatangan_surat" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="jabatan_penandatangan_surat" class="col-form-label">Jabatan Penandatangan Surat</label>
                        <input id="jabatan_penandatangan_surat" name="jabatan_penandatangan_surat" type="text" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-add-ibu">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
