<!doctype html>
<html lang="en">
 
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/libs/css/style.css') }}">
    <title>Hasil Verifikasi</title>
    
</head>
<body>
	
	<div class="container">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Identifikasi Pemohon</h3>
                    <table id="table-identifikasi-pemohon" class="table" style="width: 100%;">
						<tr>
							<td style="width: 30%;">Nama Badan Usaha</td>
							<td style="width: 5%;">:</td>
							<td>{{ $badan_usaha->nama_badan_usaha }}</td>
						</tr>
						<tr>
							<td style="width: 30%;">Wilayah (Provinsi)</td>
							<td style="width: 5%;">:</td>
							<td>{{ $badan_usaha->kota->provinsi->nama_provinsi }}</td>
						</tr>
						<tr>
							<td style="width: 30%;">Jenis Usaha</td>
							<td style="width: 5%;">:</td>
							<td>{{ $permohonan->jenis_usaha->nama_jenis_usaha }}</td>
						</tr>
					</table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Identittas Badan Usaha</h3>
                    <table class="table">
                        <thead>
							<tr>
								<th style="width: 20%;">Point Verifikasi</th>
								<th style="width: 20%;">Isi Point</th>
								<th style="width: 10%;">Sesuai</th>
								<th style="width: 10%;">Tidak Sesuai</th>
								<th style="">Catatan</th>
							</tr>
						</thead>
						<tbody>
							@if($identitas_badan_usaha != null)
							<tr>
								<td>File Surat Permohoan SBU</td>
								<td>
									@if($identitas_badan_usaha->file_surat_permohonan_sbu != NULL)
				                    <a href="{{ $identitas_badan_usaha->file_surat_permohonan_sbu }}" class="btn btn-xs btn-link">
				                        Download Lampiran
				                    </a>
				                    @else
				                        ---
				                    @endif
								</td>
								<td>						
									@if( $verifikasi_ibu->hasil_ver_ibu_file_surat_permohonan_sbu == 1)
										<input type="radio" checked>
									@endif
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_file_surat_permohonan_sbu == 0)
										<input type="radio" checked>
									@endif
								</td>
								<td>{{ $verifikasi_ibu->catatan_ver_ibu_file_surat_permohonan_sbu }}</td>
							</tr>
							<tr>
								<td>Nomor Surat</td>
								<td>
									{{ $identitas_badan_usaha->nomor_surat }}
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_nomor_surat == 1)
										<input type="radio" checked="checked"> 
									@endif
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_nomor_surat == 0)
										<input type="radio" checked="checked">
									@endif
								</td>
								<td>{{ $verifikasi_ibu->catatan_ver_ibu_nomor_surat }}</td>
							</tr>
							<tr>
								<td>Perihal</td>
								<td>
									{{ $identitas_badan_usaha->perihal }}
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_perihal == 1)
										<input type="radio" checked="checked"> 
									@endif
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_perihal == 0)
										<input type="radio" checked="checked">
									@endif
								</td>
								<td>{{ $verifikasi_ibu->catatan_ver_ibu_perihal }}</td>
							</tr>
							<tr>
								<td>Tanggal Surat</td>
								<td>
									{{ $identitas_badan_usaha->tanggal_surat }}
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_tanggal_surat == 1)
										<input type="radio" checked="checked"> 
									@endif
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_tanggal_surat == 0)
										<input type="radio" checked="checked">
									@endif
								</td>
								<td>{{ $verifikasi_ibu->catatan_ver_ibu_tanggal_surat }}</td>
							</tr>
							<tr>
								<td>Nama Penandatangan Surat</td>
								<td>
									{{ $identitas_badan_usaha->nama_penandatangan_surat }}
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_nama_penandatangan_surat == 1)
										<input type="radio" checked="checked"> 
									@endif
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_nama_penandatangan_surat == 0)
										<input type="radio" checked="checked">
									@endif
								</td>
								<td>{{ $verifikasi_ibu->catatan_ver_ibu_nama_penandatangan_surat }}</td>
							</tr>
							<tr>
								<td>Jabatan Penandatangan Surat</td>
								<td>
									{{ $identitas_badan_usaha->jabatan_penandatangan_surat }}
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_jabatan_penandatangan_surat == 1)
										<input type="radio" checked="checked"> 
									@endif
								</td>
								<td>
									@if( $verifikasi_ibu->hasil_ver_ibu_jabatan_penandatangan_surat == 0)
										<input type="radio" checked="checked">
									@endif
								</td>
								<td>{{ $verifikasi_ibu->catatan_ver_ibu_jabatan_penandatangan_surat }}</td>
							</tr>
							@else
							<tr>
								<td colspan="3">No data available</td>
							</tr>
							@endif
						</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

	<script src="{{ url('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
