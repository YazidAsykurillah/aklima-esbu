<!doctype html>
<html lang="en">
 
<head>
    <title>Print Certificate</title>

    <link href="{{ public_path('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
		.page-break {
		    page-break-after: always;
		}
		body{
			font-family: 'arial';
			font-size: 14px;
			line-height: 1.3;
		}
		#second-row table td{
			vertical-align: top;
		}
	</style>
</head>
<body>
	<div id="first-row">
		<table style="width: 100%;">
			<tr>
				<td style="width: 10%;">
					<img src="https://via.placeholder.com/75">
				</td>
				<td style="width: 10%;">
					<img src="https://via.placeholder.com/75">
				</td>
				<td style="text-align: center; vertical-align: top;">
					<p>LEMBAGA SERTIFIKASI BADAN USAHA</p>
					<p><strong>PT. ANUGERAH KUALITAS LINGKUNGAN MADANI INDONESIA (AKLIMA)</strong></p>
					<p>Nomor Akreditasi, Tanggal dan Masa Berlaku</p>
				</td>
				<td style="width: 10%;">
					<img src="https://via.placeholder.com/75">
				</td>
				<td style="width: 10%;">
					<img src="https://via.placeholder.com/75">
				</td>
			</tr>
			<tr>
				<td style="width: 10%;"></td>
				<td style="width: 10%;"></td>
				<td style="vertical-align: top;">
					<p><center><strong>SERTIFIKAT BADAN USAHA</strong></center></p>
					<p><center>NOMOR SERTIFIKAT : {{ $permohonan->nomor_sertifikat }}</center></p>
					<p><center>NOMOR REGISTRASI : {{ $permohonan->nomor_registrasi }}</center></p>
				</td>
				<td style="width: 10%;"></td>
				<td style="width: 10%;"></td>
			</tr>
		</table>	
	</div>
	

	<div id="second-row">
		<p></p>
		<p>Dengan ini menerangkan bahwa,</p>
		<table style="width: 100%;">
			<tr>
				<td style="width: 40%;">Nama Badan Usaha</td>
				<td style="width: 5%;">:</td>
				<td style="">{{ $badan_usaha->nama_badan_usaha }}</td>
			</tr>
			<tr>
				<td style="width: 40%;">Penanggung Jawab Badan Usaha</td>
				<td style="width: 5%;">:</td>
				<td style="">{{ $badan_usaha->nama_penanggung_jawab }}</td>
			</tr>
			<tr>
				<td style="width: 40%;">Alamat Badan Usaha</td>
				<td style="width: 5%;">:</td>
				<td style="">{{ $badan_usaha->alamat_badan_usaha }}</td>
			</tr>
			<tr>
				<td style="width: 40%;">Kabupaten / Kota</td>
				<td style="width: 5%;">:</td>
				<td style="">
					{{ $badan_usaha->kota->nama_kota }}, {{ $badan_usaha->kota->provinsi->nama_provinsi }}
				</td>
			</tr>
			<tr>
				<td style="width: 40%;">Nomor Telepon, Fax, Email</td>
				<td style="width: 5%;">:</td>
				<td style="">
					{{ $badan_usaha->no_telp_kantor }},
					{{ $badan_usaha->no_fax }},
					{{ $badan_usaha->email_perusahaan }},
				</td>
			</tr>
			<tr>
				<td style="width: 40%;">NPWP</td>
				<td style="width: 5%;">:</td>
				<td style="">NPWP</td>
			</tr>
			<tr>
				<td style="width: 40%;">Jenis Usaha</td>
				<td style="width: 5%;">:</td>
				<td style="">{{ $jenis_usaha->nama_jenis_usaha }}</td>
			</tr>
			<tr>
				<td style="width: 40%;">Kualifikasi</td>
				<td style="width: 5%;"></td>
				<td style=""></td>
			</tr>
			<tr>
				<td style="width: 40%;"> - Bidang</td>
				<td style="width: 5%;">:</td>
				<td style=""> Instalasi Pemanfaatan Tenaga Listrik</td>
			</tr>
			<tr>
				<td style="width: 40%;"> - Sub Bidang</td>
				<td style="width: 5%;">:</td>
				<td style="">Pembangunan dan Pemasangan</td>
			</tr>
			<tr>
				<td style="width: 40%;">Kualifikasi</td>
				<td style="width: 5%;">:</td>
				<td style="">Besar</td>
			</tr>
		</table>
	</div>
	
	<div id="third-row">
		<p>
			Telah memiliki kemampuan untuk melaksanakan usaha jasa penunjang tenaga listrik di seluruh wilayah Republik Indonesia sesuai dengan klasifikasi dan kualfikasi yang tercantum dalam sertifikat ini.
		</p>
		<p>
			Sertifikat Badan Usaha ini berlaku sampai dengan tanggal {tanggal bulan tahun}.
		</p>
	</div>

	<div id="fourth-row" style="margin-top: 50px;">
		<table style="width: 100%;">
			<tr>
				<td style="width: 40%; text-align: justify;">
					<img src="https://via.placeholder.com/75">
					<p>
						Verifikasi keabsahan SBU dapat dilakukan melalui website resmi Direktorat Jenderal Ketenagalistrikan atau dengan scan QR Code diatas
					</p>
				</td>
				<td style="width: 20%; text-align: justify;"></td>
				<td style="width: 40%; text-align: justify;">
					<p>
						Ditetapkan di Jakarta
					</p>
					<p>Pada tanggal {{$tanggal_cetak}}</p>
					<p>Direktur Utama,</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>ttd</p>
					<p><strong>Soewarto, BE</strong></p>
				</td>
			</tr>
		</table>
	</div>

	


</body>
</html>