<!doctype html>
<html lang="en">
 
<head>
    <title>Print Certificate</title>
    
    <style>
		.page-break {
		    page-break-after: always;
		}
		table{
			border-collapse: collapse;
			border-spacing: 0;
		}
		#table-keahlian-kerja-perorangan{
			width: 100%;
			border: 1px solid;
			font-size: 12px;
		}
		#table-keahlian-kerja-perorangan th{
			border: 1px solid;
    		padding: 4px;
		}

		#table-keahlian-kerja-perorangan td{
			border: 1px solid;
    		padding: 2px;
		}
		
	</style>
</head>
<body>

	<table style="width: 100%;">
		<tr>
			<td style="width: 15%; vertical-align: top;">
				<img src="{{ url('assets/images/logo_aklima.jpg') }}" style="width: 100px; height: 80px;">
			</td>
			<td style="text-align: center; vertical-align: top;">
				<div style="font-weight:bold;">LEMBAGA SERTIFIKASI BADAN USAHA</div>
				<div style="font-weight: bold; font-family: helvetica; font-size: 19px;">
					PT AK LIMA
				</div>
				<div style="font-size: 12px; font-weight: bold;">
					(ANUGERAH KUALITAS LINGKUNGAN MADANI INDONESIA)
				</div>
				<div style="font-size: 11px; font-weight: bold;">
					Akreditasi Menteri Energi dan Sumber Daya Mineal Republik Indonesia Nomor : 36 Sft/20/DJL4/2017 Tanggal 19 Desember 2017
					<hr>
				</div>
				
				<div style="font-size: 11px; font-weight: bold;">
					Jalan K.H Abdullah Syafe'i No.36-37 Tebet Jakarta Selatan
				</div>
				<div style="font-size: 11px; font-weight: bold;">
					Telp.(021) 83788536 Fax.(021) 83702607 email : aklima.pusat@gmail.com / aklima.pusat@yahoo.com
				</div>
			</td>
			<td style="width: 20%; vertical-align: top;">
				<img src="{{ url('assets/images/logo-esdm.png') }}" style="width: 130px; height: 100px;">
				<div style="font-size: 10px;">No Seri: 12345678910111213</div>
			</td>
		</tr>
		<tr>
			<td style="width: 15%;"></td>
			<td style="text-align: center; vertical-align: top;">
				<div style="font-size: 19px; font-family: helvetica; font-weight:bold;">
					SERTIFIKAT BADAN USAHA
				</div>
			</td>
			<td style="width: 15%;"></td>
		</tr>
		<tr>
			<td style="width: 15%;"></td>
			<td style="text-align: center; vertical-align: top;">
				<div style="font-size: 12px; line-height: 0.1; font-weight: bold;">
					<p>NOMOR SERTIFIKAT : {{ $sertifikat->nomor_sertifikat }}</p>
					<p>NOMOR REGISTRASI : {{ $sertifikat->nomor_registrasi }}</p>
				</div>
			</td>
			<td style="width: 15%;"></td>
		</tr>
	</table>
	<div style="font-size: 13px; margin-bottom: 12px;">
		Dengan ini menerangkan bahwa,
	</div>
	<table style="width: 100%; font-size: 13px;">
		<tr>
			<td style="width: 25%;">Nama Badan Usaha</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">{{ $sertifikat->permohonan->badan_usaha->nama_badan_usaha }}</td>
		</tr>
		<tr>
			<td style="width: 25%;">Penanggung Jawab Badan Usaha</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">{{ strtoupper($sertifikat->permohonan->badan_usaha->nama_penanggung_jawab) }}</td>
		</tr>
		<tr>
			<td style="width: 25%;">Alamat Badan Usaha</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">{{ $sertifikat->permohonan->badan_usaha->alamat_badan_usaha }}</td>
		</tr>
		<tr>
			<td style="width: 25%;">Kabupaten / Kota</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">
				{{ $sertifikat->permohonan->badan_usaha->kota->nama_kota }}, {{ $sertifikat->permohonan->badan_usaha->kota->provinsi->nama_provinsi }}
			</td>
		</tr>
		<tr>
			<td style="width: 25%;">Nomor Telepon, Fax, Email</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">
				{{ $sertifikat->permohonan->badan_usaha->no_telp_kantor }},
				{{ $sertifikat->permohonan->badan_usaha->no_fax }},
				{{ $sertifikat->permohonan->badan_usaha->email_perusahaan }},
			</td>
		</tr>
		<tr>
			<td style="width: 25%;">NPWP</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">{{ $sertifikat->permohonan->persyaratan_administratif->nomor_npwp }}</td>
		</tr>
		<tr>
			<td style="width: 25%;">Jenis Usaha</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">{{ $sertifikat->jenis_usaha->nama_jenis_usaha }}</td>
		</tr>
		<tr>
			<td style="width: 25%;">Klasifikasi</td>
			<td style="width: 5%; text-align:right;"></td>
			<td style=""></td>
		</tr>
		<tr>
			<td style="width: 25%;"> - Bidang</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style=""> {{ $sertifikat->sub_bidang->bidang->nama_bidang }}</td>
		</tr>
		<tr>
			<td style="width: 25%;"> - Sub Bidang</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">{{ $sertifikat->sub_bidang->nama_sub_bidang }}</td>
		</tr>
		<tr>
			<td style="width: 25%;"> - Spesialisasi</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">-</td>
		</tr>
		<tr>
			<td style="width: 25%;">Kualifikasi</td>
			<td style="width: 5%; text-align:right;">:</td>
			<td style="">{{ ucwords($sertifikat->kualifikasi) }}</td>
		</tr>
	</table>
	<p></p>
	<div style="font-size: 13px;">
		telah memiliki kemampuan untuk melaksanakan usaha jasa penunjang tenaga listrik di seluruh wilayah Republik Indonesia sesuai dengan klasifikasi dan kualfikasi yang tercantum dalam sertifikat ini.
	</div>
	<div style="font-size: 13px;">
		Sertifikat Badan Usaha ini berlaku sampai dengan tanggal {{ indonesian_date($sertifikat->tanggal_expired) }}
	</div>
	<p></p>
	<table style="width: 100%;">
		<tr>
			<td style="width: 15%; text-align: left;">
				<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate('https://sbudjk.esdm.go.id')) }} ">
			</td>
			<td style="text-align: center; vertical-align: top;">
				
			</td>
			<td style="width: 20%; font-size: 12px; line-height: 0.5;">
				<p>Ditetapkan di Jakarta</p>
				<p>Pada tanggal {{ indonesian_date($sertifikat->tanggal_terbit) }}</p>
				<p>Direktur Utama,</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>SOEWARTO, BE</p>
			</td>
		</tr>
	</table>

	<div class="page-break"></div>

	<table style="width: 100%;">
		<tr>
			<td style="width: 25%; vertical-align: top;">
				<div style="font-size: 12px;">Lampiran Sertifikasi Badan Usaha</div>
				<div style="font-size: 10px;">
					Nomor Sertifikat: {{ $sertifikat->nomor_sertifikat }}
				</div>
			</td>
			<td style="text-align: center; vertical-align: top;">
				<div style="font-weight:bold;">
					RINCIAN KLASIFIKASI DAN KUALIFIKASI BADAN USAHA JASA PENUNJANG TENAGA LISTRIK
				</div>
			</td>
			<td style="width: 25%;font-size: 10px; vertical-align: top; text-align: right;">
				No Seri: 12345678910111213
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<table style="width: 100%; font-size: 13px;">
		<tbody>
			<tr>
				<td style="width: 25%;">NAMA BADAN USAHA</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style="">
					{{ $sertifikat->permohonan->badan_usaha->nama_badan_usaha }}
				</td>
			</tr>
			<tr>
				<td style="width: 25%;">JENIS USAHA</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style="">
					{{ $sertifikat->jenis_usaha->nama_jenis_usaha }}
				</td>
			</tr>
			<tr>
				<td style="width: 25%;">KLASIFIKASI</td>
				<td style="width: 5%;"></td>
				<td style=""></td>
			</tr>
			<tr>
				<td style="width: 25%;"> - BIDANG</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style=""> {{ $sertifikat->sub_bidang->bidang->nama_bidang }}</td>
			</tr>
			<tr>
				<td style="width: 25%;"> - SUBBIDANG</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style="">{{ $sertifikat->sub_bidang->nama_sub_bidang }}</td>
			</tr>
			<tr>
				<td style="width: 25%;"> - SPESIALISASI</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style="">-</td>
			</tr>
			<tr>
				<td style="width: 25%;">KUALIFIKASI</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style="">{{ ucwords($sertifikat->kualifikasi) }}</td>
			</tr>
			<tr>
				<td style="width: 25%;">KEMAMPUAN USAHA</td>
				<td style="width: 5%; text-align: right;"></td>
				<td style=""></td>
			</tr>
			<tr>
				<td style="width: 25%;"> - KEKAYAAN BERSIH</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style=""> {{ rupiah($sertifikat->permohonan->persyaratan_administratif->kekayaan_bersih) }}</td>
			</tr>
			<tr>
				<td style="width: 25%;"> - BATAS NILAI SATU PEKERJAAN</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style="">
					@if($matriks_kualifikasi)
						{{ $matriks_kualifikasi->first()->batas_nilai_1_pekerjaan }}
					@endif
				</td>
			</tr>
			<tr>
				<td style="width: 25%;"> - KEAHLIAN KERJA ORANG PERORANGAN</td>
				<td style="width: 5%; text-align: right;">:</td>
				<td style=""></td>
			</tr>
		</tbody>
	</table>
	
	<table id="table-keahlian-kerja-perorangan">
		<tr>
			<th style="width: 5%; text-align: center;">No.</th>
			<th style="width: 20%; text-align: left;">Nama (No. Identitas)</th>
			<th style="width:15%; text-align: center;">No. Sertifikat</th>
			<th style="width:15%; text-align: center;">No. Registrasi</th>
			<th style="width: 5%; text-align: center;">Level</th>
			<th style="width:40%; text-align: center;">Okupasi Jabatan / Unit Kompetensi</th>
		</tr>
		<tr>
			<td colspan="6">A. PENANGGUNG JAWAB TEKNIK</td>
		</tr>
		@if(!is_null($penanggung_jawab_teknis))
			<?php $pjt_no = 0; ?>
			@foreach($penanggung_jawab_teknis as $pjt)
			<?php $pjt_no++;?>
			<tr>
				<td style="text-align: center;">
					{{ $pjt_no }}
				</td>
				<td style="text-align: left;">
					{{ $pjt->nama }} <br/>
					@if($pjt->jenis_identitas == 'KTP')
						( {{$pjt->nomor_ktp}} )
					@else
						( {{$pjt->nomor_passpor}} )
					@endif
				</td>
				<td style="text-align: center;">
					{{ $pjt->sertifikat_pt_pjt->count()  ? $pjt->sertifikat_pt_pjt->first()->no_serkom : NULL }}
				</td>
				<td style="text-align: center;">
					{{ $pjt->sertifikat_pt_pjt->count()  ? $pjt->sertifikat_pt_pjt->first()->noreg_serkom : NULL }}
				</td>
				<td style="text-align: center;">
					{{ $pjt->sertifikat_pt_pjt->count()  ? $pjt->sertifikat_pt_pjt->first()->level : NULL }}
				</td>
				<td style="text-align: center;">
					{{ $pjt->sertifikat_pt_pjt->count()  ? $pjt->sertifikat_pt_pjt->first()->unit_kompetensi : NULL }}
				</td>

			</tr>
			@endforeach
		@endif
		<tr>
			<td colspan="6">B. TENAGA TEKNIK</td>
		</tr>
		@if(!is_null($tenaga_teknik))
			<?php $tt_no = 0; ?>
			@foreach($tenaga_teknik as $tt)
			<?php $tt_no++;?>
			<tr>
				<td style="text-align: center;">
					{{ $tt_no }}
				</td>
				<td style="text-align: left;">
					{{ $tt->nama }} <br/>
					@if($tt->jenis_identitas == 'KTP')
						( {{$tt->nomor_ktp}} )
					@else
						( {{$tt->nomor_passpor}} )
					@endif
				</td>
				<td style="text-align: center;">
					{{ $tt->sertifikat_pt_tt->count()  ? $tt->sertifikat_pt_tt->first()->no_serkom : NULL }}
				</td>
				<td style="text-align: center;">
					{{ $tt->sertifikat_pt_tt->count()  ? $tt->sertifikat_pt_tt->first()->noreg_serkom : NULL }}
				</td>
				<td style="text-align: center;">
					{{ $tt->sertifikat_pt_tt->count()  ? $tt->sertifikat_pt_tt->first()->level : NULL }}
				</td>
				<td style="text-align: center;">
					{{ $tt->sertifikat_pt_tt->count()  ? $tt->sertifikat_pt_tt->first()->unit_kompetensi : NULL }}
				</td>
			</tr>
			@endforeach
		@endif
	</table>
	<p>&nbsp;</p>
	<div style="font-size: 12px; line-height: 1px; margin-left: 120px;">
		<p>Lembaga Sertifikasi Badan Usaha</p>
		<p>PT Anugerah Kualitas Lingkungan Madani Indonesia</p>
		<p>Direktur Utama,</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>SOEWARTO, BE</p>
	</div>
</body>
</html>