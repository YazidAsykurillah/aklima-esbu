<!doctype html>
<html lang="en">
 
<head>
    <title>Hasil Verifikasi</title>
    <style>
		.page-break {
		    page-break-after: always;
		}
		
		.table-verification-result{
			width: 100%;
			border: 1px solid;
			font-size: 13px;
			margin-bottom: 17px;
		}
		
	</style>
</head>
<body>
	<center>
		<h4>
			DAFTAR PENILAIAN (CEKLIST) PERMOHONAN SERTIFIKAT BADAN USAHA JASA PENUNJANG TENAGA LISTRIK
		</h4>	
	</center>
	<p></p>

	<table id="table-identifikasi-pemohon" class="table-verification-result" style="width: 100%;">
		<tr>
			<th colspan="3" style="text-align: center;">Identifikasi Pemohon</th>
		</tr>
		<tr>
			<td style="width: 20%;">Nama Badan Usaha</td>
			<td style="width: 5%;">:</td>
			<td>{{ $badan_usaha->nama_badan_usaha }}</td>
		</tr>
		<tr>
			<td style="width: 20%;">Wilayah (Provinsi)</td>
			<td style="width: 5%;">:</td>
			<td>{{ $badan_usaha->kota->provinsi->nama_provinsi }}</td>
		</tr>
		<tr>
			<td style="width: 20%;">Jenis Usaha</td>
			<td style="width: 5%;">:</td>
			<td>{{ $permohonan->jenis_usaha->nama_jenis_usaha }}</td>
		</tr>
	</table>

	<h4>I. Identitas Badan Usaha</h4>
	<table id="table-identitas-badan-usaha" class="table-verification-result">
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
                    <a href="{{ $identitas_badan_usaha->file_surat_permohonan_sbu }}" class="btn btn-xs btn-rounded btn-info">
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

	<h4>II. Persyaratan Administratif</h4>
	<table id="table-persyaratan-administratif" class="table-verification-result">
		<thead>
			<tr>
				<th style="width: 20%;">Point Verifikasi</th>
				<th style="width: 25%;">Isi Point</th>
				<th style="width: 10%;">Sesuai</th>
				<th style="width: 10%;">Tidak Sesuai</th>
				<th style="">Catatan</th>
			</tr>
		</thead>
		<tbody>
			@if($persyaratan_administratif != null)
			<tr>
				<td>File Akta Pendirian BU</td>
				<td>
					@if($persyaratan_administratif->file_akta_pendirian_bu != NULL)
                    <a href="{{ $persyaratan_administratif->file_akta_pendirian_bu }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_akta_pendirian_bu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_akta_pendirian_bu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_akta_pendirian_bu }}</td>
			</tr>
			<tr>
				<td>Nama Notaris</td>
				<td>
					{{ $persyaratan_administratif->nama_notaris}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nama_notaris == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nama_notaris == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nama_notaris }}</td>
			</tr>
			<tr>
				<td>Judul Akta</td>
				<td>
					{{ $persyaratan_administratif->judul_akta}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_judul_akta == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_judul_akta == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_judul_akta }}</td>
			</tr>
			<tr>
				<td>Tanggal Akta</td>
				<td>
					{{ $persyaratan_administratif->tanggal_akta}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_akta == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_akta == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_tanggal_akta }}</td>
			</tr>
			<tr>
				<td>Nomor Akta</td>
				<td>
					{{ $persyaratan_administratif->nomor_akta}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_akta == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_akta == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_akta }}</td>
			</tr>
			<tr>
				<td>Maksud Tujuan Akta</td>
				<td>
					{{ $persyaratan_administratif->maksud_tujuan_akta}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_maksud_tujuan_akta == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_maksud_tujuan_akta == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_maksud_tujuan_akta }}</td>
			</tr>
			<tr>
				<td>File Pengesahan Sebagai Badan Hukum</td>
				<td>
					@if($persyaratan_administratif->file_pengesahan_sebagai_badan_hukum != NULL)
                    <a href="{{ $persyaratan_administratif->file_pengesahan_sebagai_badan_hukum }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_pengesahan_sebagai_badan_hukum == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_pengesahan_sebagai_badan_hukum == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_pengesahan_sebagai_badan_hukum }}</td>
			</tr>
			<tr>
				<td>Nomor Badan Hukum</td>
				<td>
					{{ $persyaratan_administratif->nomor_badan_hukum}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_badan_hukum == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_badan_hukum == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_badan_hukum }}</td>
			</tr>
			<tr>
				<td>Tentang Badan Hukum</td>
				<td>
					{{ $persyaratan_administratif->tentang_badan_hukum}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tentang_badan_hukum == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tentang_badan_hukum == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_tentang_badan_hukum }}</td>
			</tr>
			<tr>
				<td>Tanggal Badan Hukum</td>
				<td>
					{{ $persyaratan_administratif->tanggal_badan_hukum}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_badan_hukum == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_badan_hukum == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_tanggal_badan_hukum }}</td>
			</tr>
			<tr>
				<td>File NPWP</td>
				<td>
					@if($persyaratan_administratif->file_npwp != NULL)
                    <a href="{{ $persyaratan_administratif->file_npwp }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_npwp == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_npwp == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_npwp }}</td>
			</tr>
			<tr>
				<td>Nomor NPWP</td>
				<td>
					{{ $persyaratan_administratif->nomor_npwp}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_npwp == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_npwp == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_npwp }}</td>
			</tr>

			<tr>
				<td>File SKDU</td>
				<td>
					@if($persyaratan_administratif->file_skdu != NULL)
                    <a href="{{ $persyaratan_administratif->file_skdu }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_skdu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_skdu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_skdu }}</td>
			</tr>

			<tr>
				<td>Instansi Penerbit SKDU</td>
				<td>
					{{ $persyaratan_administratif->instansi_penerbit_skdu}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_instansi_penerbit_skdu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_instansi_penerbit_skdu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_instansi_penerbit_skdu }}</td>
			</tr>

			<tr>
				<td>Nomor SKDU</td>
				<td>
					{{ $persyaratan_administratif->nomor_skdu}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_skdu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_skdu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_skdu }}</td>
			</tr>
			<tr>
				<td>Tanggal SKDU</td>
				<td>
					{{ $persyaratan_administratif->tanggal_skdu}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_skdu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_skdu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_tanggal_skdu }}</td>
			</tr>

			<tr>
				<td>Masa Berlaku SKDU</td>
				<td>
					{{ $persyaratan_administratif->masa_berlaku_skdu}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_masa_berlaku_skdu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_masa_berlaku_skdu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_masa_berlaku_skdu }}</td>
			</tr>

			<tr>
				<td>File PJBU</td>
				<td>
					@if($persyaratan_administratif->file_pjbu != NULL)
                    <a href="{{ $persyaratan_administratif->file_pjbu }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_pjbu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_pjbu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_pjbu }}</td>
			</tr>

			<tr>
				<td>Nama PJBU</td>
				<td>
					{{ $persyaratan_administratif->nama_pjbu}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nama_pjbu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nama_pjbu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nama_pjbu }}</td>
			</tr>

			<tr>
				<td>Jenis Identitas PJBU</td>
				<td>
					{{ $persyaratan_administratif->jenis_identitas_pjbu}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_jenis_identitas_pjbu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_jenis_identitas_pjbu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_jenis_identitas_pjbu }}</td>
			</tr>

			<tr>
				<td>Nomor KTP PJBU</td>
				<td>
					{{ $persyaratan_administratif->nomor_ktp_pjbu}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_ktp_pjbu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_ktp_pjbu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_ktp_pjbu }}</td>
			</tr>

			<tr>
				<td>Nomor Passport PJBU</td>
				<td>
					{{ $persyaratan_administratif->nomor_paspor_pjbu}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_paspor_pjbu == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_paspor_pjbu == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_paspor_pjbu }}</td>
			</tr>

			<tr>
				<td>File Laporan Keuangan</td>
				<td>
					@if($persyaratan_administratif->file_laporan_keuangan != NULL)
                    <a href="{{ $persyaratan_administratif->file_laporan_keuangan }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_laporan_keuangan == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_laporan_keuangan == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_laporan_keuangan }}</td>
			</tr>

			<tr>
				<td>Kekayaan Bersih</td>
				<td>
					{{ rupiah($persyaratan_administratif->kekayaan_bersih) }}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_kekayaan_bersih == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_kekayaan_bersih == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_kekayaan_bersih }}</td>
			</tr>

			<tr>
				<td>Modal Disetor</td>
				<td>
					{{ rupiah($persyaratan_administratif->modal_disetor) }}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_modal_disetor == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_modal_disetor == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_modal_disetor }}</td>
			</tr>

			<tr>
				<td>Nama Kantor Akuntan Publik</td>
				<td>
					{{ $persyaratan_administratif->nama_kantor_akuntan_publik}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nama_kantor_akuntan_publik == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nama_kantor_akuntan_publik == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nama_kantor_akuntan_publik }}</td>
			</tr>

			<tr>
				<td>Alamat Kantor Akuntan Publik</td>
				<td>
					{{ $persyaratan_administratif->alamat_kantor_akuntan_pulik}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_alamat_kantor_akuntan_pulik == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_alamat_kantor_akuntan_pulik == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_alamat_kantor_akuntan_pulik }}</td>
			</tr>

			<tr>
				<td>Nomor Telepon Kantor Akuntan Publik</td>
				<td>
					{{ $persyaratan_administratif->nomor_telepon_kantor_akuntan_publik}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_telepon_kantor_akuntan_publik == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_telepon_kantor_akuntan_publik == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_telepon_kantor_akuntan_publik }}</td>
			</tr>

			<tr>
				<td>Nama Akuntan</td>
				<td>
					{{ $persyaratan_administratif->nama_akuntan}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nama_akuntan == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nama_akuntan == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nama_akuntan }}</td>
			</tr>

			<tr>
				<td>Nomor Laporan Keuangan</td>
				<td>
					{{ $persyaratan_administratif->nomor_laporan_keuangan}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_laporan_keuangan == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_laporan_keuangan == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_laporan_keuangan }}</td>
			</tr>

			<tr>
				<td>Tanggal Laporan Keuangan</td>
				<td>
					{{ $persyaratan_administratif->tanggal_laporan_keuangan}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_laporan_keuangan == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_laporan_keuangan == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_tanggal_laporan_keuangan }}</td>
			</tr>

			<tr>
				<td>Pendapat Akuntan</td>
				<td>
					{{ $persyaratan_administratif->pendapat_akuntan}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_pendapat_akuntan == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_pendapat_akuntan == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_pendapat_akuntan }}</td>
			</tr>

			<tr>
				<td>File Struktur Organisasi Badan Usaha</td>
				<td>
					@if($persyaratan_administratif->file_struktur_organisasi_badan_usaha != NULL)
                    <a href="{{ $persyaratan_administratif->file_struktur_organisasi_badan_usaha }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_struktur_organisasi_badan_usaha == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_struktur_organisasi_badan_usaha == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_struktur_organisasi_badan_usaha }}</td>
			</tr>

			<tr>
				<td>File Profil Badan Usaha</td>
				<td>
					@if($persyaratan_administratif->file_profile_badan_usaha != NULL)
                    <a href="{{ $persyaratan_administratif->file_profile_badan_usaha }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_profile_badan_usaha == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_profile_badan_usaha == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_profile_badan_usaha }}</td>
			</tr>
			<tr>
				<td>File PPM</td>
				<td>
					@if($persyaratan_administratif->file_ppm != NULL)
                    <a href="{{ $persyaratan_administratif->file_ppm }}" class="btn btn-xs btn-rounded btn-info">
                        Download Lampiran
                    </a>
                    @else
                        ---
                    @endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_ppm == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_file_ppm == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_file_ppm }}</td>
			</tr>

			<tr>
				<td>Nomor PPM</td>
				<td>
					{{ $persyaratan_administratif->nomor_ppm}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_ppm == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_nomor_ppm == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_nomor_ppm }}</td>
			</tr>
			<tr>
				<td>Tanggal PPM</td>
				<td>
					{{ $persyaratan_administratif->tanggal_ppm}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_ppm == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_tanggal_ppm == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_tanggal_ppm }}</td>
			</tr>
			<tr>
				<td>Prosentase Saham PPM</td>
				<td>
					{{ $persyaratan_administratif->prosentase_saham_pma_ppm}}
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_prosentase_saham_pma_ppm == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pa->hasil_ver_pa_prosentase_saham_pma_ppm == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pa->catatan_ver_pa_prosentase_saham_pma_ppm }}</td>
			</tr>
			@else
			<tr>
				<td colspan="3">No data available</td>
			</tr>
			@endif
		</tbody>
	</table>

	<h4>III. Persyaratan Teknis</h4>
	<table id="table-persyaratan-teknis" class="table-verification-result">
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
			@if($verifikasi_pt != null)
			<tr>
				<td>Data Persyaratan Teknis</td>
				<td>
					Terlampir
				</td>
				<td>
					@if( $verifikasi_pt->hasil_ver_pt == 1)
						<input type="radio" checked="checked"> 
					@endif
				</td>
				<td>
					@if( $verifikasi_pt->hasil_ver_pt == 0)
						<input type="radio" checked="checked">
					@endif
				</td>
				<td>{{ $verifikasi_pt->catatan_ver_pt }}</td>
			</tr>
			@endif
		</tbody>
	</table>
	
</body>
</html>
