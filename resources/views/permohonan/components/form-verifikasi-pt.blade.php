<div class="card">
    <form id="form-verifikasi-pt" method="post" enctype="multipart/form-data" action="{{ url('verifikasi-pt/') }}">
    <div class="card-header d-flex">
        <h4 class="card-header-title">
            <i class="fa fa-tag"></i> Form Verifikasi Persyaratan Teknis
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(!is_null($persyaratan_teknis))
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20%;">Point Verifikasi</th>
                        <th style="width: 30%;">Isi Point</th>
                        <th style="width: 30%; text-align: center;">Sesuai / Tidak Sesuai</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Daftar Persyaratan Teknis Badan Usaha</td>
                        <td style="">
                            Terlampir Diatas
                        </td>
                        <td style="text-align: center;">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pt" class="custom-control-input hasil_ver_pt_radio" value="1">
                                <span class="custom-control-label">Sesuai</span>
                            </label>

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="hasil_ver_pt" class="custom-control-input hasil_ver_pt_radio" value="0">
                                <span class="custom-control-label">Tidak Sesuai</span>
                            </label>
                        </td>
                        <td>
                            <textarea name="catatan_ver_pt" class="form-control"></textarea>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: center;">
                            <button type="button" id="btn-check-all-ver-pt" class="btn btn-xs btn-success">
                                Sesuai Semua
                            </button>
                            <button type="button" id="btn-uncheck-all-ver-pt" class="btn btn-xs btn-secondary">
                                Tidak Sesuai Semua
                            </button>
                        </td>
                    </tr>
                </tfoot>
                
            </table>
            @endif
        </div>
    </div>
    <div class="card-footer p-0 text-center">
        
        @csrf
        <input type="hidden" name="uid_permohonan" value="{{ $permohonan->uid_permohonan }}">
        <button type="submit" id="btn-submit-ver-pt" class="btn btn-block btn-primary">
            <i class="fa fa-save"></i> Simpan Verifikasi Persyaratan Teknis
        </button>
        
    </div>
</form>
</div>