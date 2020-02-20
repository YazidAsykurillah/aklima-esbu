<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 class="card-header-title">
                    <i class="fas fa-briefcase"></i> Data Pengurus
                </h4>
                <div class="toolbar ml-auto">

                </div>
            </div>
            <div class="card-body">
                <!--Block Dewan Komisaris-->
                <div class="card">
                    <div class="card-header d-flex">
                        <h4 class="card-header-title">
                            A. Dewan Komisaris
                        </h4>
                        <div class="toolbar ml-auto">
                            <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                            @if($permohonan->status == '0' || $permohonan->status == '1')
                            <button class="btn btn-light btn-xs" id="btn-pull-dp-dk-trigger" title="Tarik Data Pengurus Dewan Komisaris" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                                <i class="fas fa-sync"></i> Tarik
                            </button>
                            <a href="#" class="btn btn-light btn-xs" title="Tambah Data Pengurus Dewan Komisaris"  data-toggle="modal" data-target="#addDpDkModal">
                                <i class="fas fa-plus-circle"></i> Tambah 
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:15%;">Nama</th>
                                        <th>Jenis Identitas / No.Identitas</th>
                                        <th>Jabatan</th>
                                        <th style="width: 5%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($data_pengurus_dewan_komisaris->count())
                                    @foreach($data_pengurus_dewan_komisaris as $dp_dk)
                                    <tr>
                                        <td>{{ $dp_dk->nama }}</td>
                                        <td>
                                            {{ $dp_dk->jenis_identitas}} /
                                            @if($dp_dk->jenis_identitas == 'KTP')
                                                {{ $dp_dk->nomor_ktp }}
                                            @else
                                                {{ $dp_dk->nomor_passpor }}
                                            @endif

                                        </td>
                                        <td>{{ $dp_dk->jabatan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete-dp-dk-trigger" title="Hapus Data Pengurus Dewan Komisaris" data-id="{{ $dp_dk->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">Tidak ada data</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>    
                        </div>
                        
                    </div>
                </div>
                <!--ENDBlock Dewan Komisaris-->

                <!--Block Dewan Direksi-->
                <div class="card">
                    <div class="card-header d-flex">
                        <h4 class="card-header-title">
                            B. Dewan Direksi
                        </h4>
                        <div class="toolbar ml-auto">
                            <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                            @if($permohonan->status == '0' || $permohonan->status == '1')
                            <button class="btn btn-light btn-xs" id="btn-pull-dp-dd-trigger" title="Tarik Data Pengurus Dewan Direksi" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                                <i class="fas fa-sync"></i> Tarik
                            </button>
                            <a href="#" class="btn btn-light btn-xs" title="Tambah Data Pengurus Dewan Direksi"  data-toggle="modal" data-target="#addDpDdModal">
                                <i class="fas fa-plus-circle"></i> Tambah 
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:15%;">Nama</th>
                                    <th>Jenis Identitas / No.Identitas</th>
                                    <th>Jabatan</th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data_pengurus_dewan_direksi->count())
                                    @foreach($data_pengurus_dewan_direksi as $dp_dd)
                                    <tr>
                                        <td>{{ $dp_dd->nama }}</td>
                                        <td>
                                            {{ $dp_dd->jenis_identitas}} /
                                            @if($dp_dd->jenis_identitas == 'KTP')
                                                {{ $dp_dd->nomor_ktp }}
                                            @else
                                                {{ $dp_dd->nomor_passpor }}
                                            @endif

                                        </td>
                                        <td>{{ $dp_dd->jabatan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete-dp-dd-trigger"  title="Hapus Data Pengurus Dewan direksi" data-id="{{ $dp_dd->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">Tidak ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--ENDBlock Dewan Direksi-->

                <!--Block Dewan Pemegang Saham-->
                <div class="card">
                    <div class="card-header d-flex">
                        <h4 class="card-header-title">
                            C. Pemegang Saham
                        </h4>
                        <div class="toolbar ml-auto">
                            <!--Show document action if only status is Menunggu Dokumen (0) or Frontdesk -->
                            @if($permohonan->status == '0' || $permohonan->status == '1')
                            <button class="btn btn-light btn-xs" id="btn-pull-dp-ps-trigger" title="Tarik Data Pengurus Pemegang Saham" data-uid_permohonan="{{ $permohonan->uid_permohonan }}">
                                <i class="fas fa-sync"></i> Tarik
                            </button>
                            <a href="#" class="btn btn-light btn-xs" title="Tambah Data Pengurus Pemegang Saham"  data-toggle="modal" data-target="#addDpPsModal">
                                <i class="fas fa-plus-circle"></i> Tambah 
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:15%;">Nama</th>
                                    <th>Negara</th>
                                    <th>Jenis Identitas / No.Identitas</th>
                                    <th>Prosentase Kepemilikan Saham</th>
                                    <th>Nominal Kepemilikan Saham</th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data_pengurus_pemegang_saham->count())
                                    @foreach($data_pengurus_pemegang_saham as $dp_ps)
                                    <tr>
                                        <td>{{ $dp_ps->nama }}</td>
                                        <td>{{ $dp_ps->negara }}</td>
                                        <td>
                                            {{ $dp_ps->jenis_identitas}} /
                                            @if($dp_ps->jenis_identitas == 'KTP')
                                                {{ $dp_ps->nomor_ktp }}
                                            @else
                                                {{ $dp_ps->nomor_passpor }}
                                            @endif

                                        </td>
                                        <td>{{ $dp_ps->prosentase_kepemilikan_saham }}</td>
                                        <td>{{ rupiah($dp_ps->nominal_kepemilikan_saham) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete-dp-ps-trigger"  title="Hapus Data Pengurus Pemegang Saham" data-id="{{ $dp_ps->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">Tidak ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--ENDBlock Dewan Pemegang Saham-->
            </div>
        </div>
    </div>
</div>

<!--Modal Tambah Data Pengurus Dewan Komisaris-->
<div class="modal fade" id="addDpDkModal" tabindex="-1" role="dialog" aria-labelledby="addDpDkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-dp-dk" method="post" enctype="multipart/form-data" action="{{ url('data-pengurus-dewan-komisaris') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDpDkModalLabel">Tambah Data Pengurus Dewan Komisaris</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_identitas" class="col-form-label">Jenis Identitas</label>
                        <select name="jenis_identitas" class="form-control" style="width: 100%;" required>
                            <option value="">--Pilih--</option>
                            <option value="KTP">KTP</option>
                            <option value="Passpor">Passpor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_identitas" class="col-form-label">Nomor Identitas</label>
                        <input type="text" name="nomor_identitas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kewarganegaraan" class="col-form-label">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="col-form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="npwp" class="col-form-label">NPWP</label>
                        <input type="text" name="npwp" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="uid_permohonan" value="{{ $permohonan->uid_permohonan }}">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-dp-dk">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Data Pengurus Dewan Komisaris-->

<!--Modal Delete Data Pengurus Dewan Komisaris-->
<div class="modal fade" id="deleteDpDkModal" tabindex="-1" role="dialog" aria-labelledby="deleteDpDkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <form id="form-delete-dp-dk" method="post" enctype="multipart/form-data" action="{{ url('data-pengurus-dewan-komisaris/delete') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDpDkModalLabel">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    Hapus Data Dewan Pengurus Dewan Komisaris

                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-delete-dp-dk">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Data Pengurus Dewan Komisaris-->

<!--Modal Tambah Data Pengurus Dewan Direksi-->
<div class="modal fade" id="addDpDdModal" tabindex="-1" role="dialog" aria-labelledby="addDpDdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-dp-dd" method="post" enctype="multipart/form-data" action="{{ url('data-pengurus-dewan-direksi') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDpDdModalLabel">Tambah Data Pengurus Dewan Direksi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_identitas" class="col-form-label">Jenis Identitas</label>
                        <select name="jenis_identitas" class="form-control" style="width: 100%;" required>
                            <option value="">--Pilih--</option>
                            <option value="KTP">KTP</option>
                            <option value="Passpor">Passpor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_identitas" class="col-form-label">Nomor Identitas</label>
                        <input type="text" name="nomor_identitas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kewarganegaraan" class="col-form-label">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="col-form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="npwp" class="col-form-label">NPWP</label>
                        <input type="text" name="npwp" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="uid_permohonan" value="{{ $permohonan->uid_permohonan }}">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-dp-dd">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Data Pengurus Dewan Direksi-->

<!--Modal Delete Data Pengurus Dewan Direksi-->
<div class="modal fade" id="deleteDpDdModal" tabindex="-1" role="dialog" aria-labelledby="deleteDpDdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <form id="form-delete-dp-dd" method="post" enctype="multipart/form-data" action="{{ url('data-pengurus-dewan-direksi/delete') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDpDdModalLabel">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    Hapus Data Dewan Pengurus Dewan Direksi

                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-delete-dp-dd">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Data Pengurus Dewan Direksi-->

<!--Modal Tambah Data Pengurus Pemegang Saham-->
<div class="modal fade" id="addDpPsModal" tabindex="-1" role="dialog" aria-labelledby="addDpDkMoPslLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form-add-dp-ps" method="post" enctype="multipart/form-data" action="{{ url('data-pengurus-pemegang-saham') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDpDkMoPslLabel">Tambah Data Pengurus Pemegang Saham</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jenis_identitas" class="col-form-label">Jenis Identitas</label>
                        <select name="jenis_identitas" class="form-control" style="width: 100%;" required>
                            <option value="">--Pilih--</option>
                            <option value="KTP">KTP</option>
                            <option value="Passpor">Passpor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_identitas" class="col-form-label">Nomor Identitas</label>
                        <input type="text" name="nomor_identitas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="negara" class="col-form-label">Negara</label>
                        <input type="text" name="negara" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prosentase_kepemilikan_saham" class="col-form-label">Prosentase Kepemilikan Saham </label>
                        <input type="text" name="prosentase_kepemilikan_saham" class="form-control autonumerical">
                    </div>
                    <div class="form-group">
                        <label for="nominal_kepemilikan_saham" class="col-form-label">Nominal Kepemilikan Saham </label>
                        <input type="text" name="nominal_kepemilikan_saham" class="form-control autonumerical">
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="uid_permohonan" value="{{ $permohonan->uid_permohonan }}">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-add-dp-ps">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Tambah Data Pengurus Pemegang Saham-->

<!--Modal Delete Data Pengurus Pemegang Saham-->
<div class="modal fade" id="deleteDpPsModal" tabindex="-1" role="dialog" aria-labelledby="deleteDpPsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <form id="form-delete-dp-ps" method="post" enctype="multipart/form-data" action="{{ url('data-pengurus-pemegang-saham/delete') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDpPsModalLabel">Konfirmasi</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    Hapus Data Dewan Pengurus Dewan Pemegang Saham

                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <button class="btn btn-secondary btn-xs" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-xs" id="btn-delete-dp-ps">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Delete Data Pengurus Pemegang Saham-->