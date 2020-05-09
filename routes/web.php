<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('refreshcaptcha', 'CaptchaController@refresh');

Auth::routes();

Route::get('/home/identitas-provinsi', 'HomeController@getIdentitasProvinsi');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){

	//User Controller
	Route::get('user/datatables', 'UserController@datatables');
	Route::resource('user', 'UserController');

	//Bentuk Badan Usaha controller resource
	Route::post('bentuk-badan-usaha/synchronize', 'BentukBadanUsahaController@synchronize');
	Route::get('bentuk-badan-usaha/datatables','BentukBadanUsahaController@datatables');
	Route::resource('bentuk-badan-usaha', 'BentukBadanUsahaController');

	//Jenis Usaha controller resource
	Route::post('jenis-usaha/synchronize', 'JenisUsahaController@synchronize');
	Route::get('jenis-usaha/datatables', 'JenisUsahaController@datatables');
	Route::resource('jenis-usaha', 'JenisUsahaController');

	//Bidang Controller resource
	Route::post('bidang/synchronize', 'BidangController@synchronize');
	Route::get('bidang/datatables','BidangController@datatables');
	Route::resource('bidang', 'BidangController');

	//SubBidangController resource
	Route::get('sub-bidang/select2', 'SubBidangController@select2');
	Route::post('sub-bidang/synchronize', 'SubBidangController@synchronize');
	Route::get('sub-bidang/datatables', 'SubBidangController@datatables');
	Route::resource('sub-bidang', 'SubBidangController');

	//MatriksKualifikasiController resource
	Route::post('matriks-kualifikasi/synchronize', 'MatriksKualifikasiController@synchronize');
	Route::get('matriks-kualifikasi/datatables', 'MatriksKualifikasiController@datatables');
	Route::resource('matriks-kualifikasi', 'MatriksKualifikasiController');

	//Provinsi
	Route::post('provinsi/synchronize', 'ProvinsiController@synchronize');
	Route::get('provinsi/datatables', 'ProvinsiController@datatables');
	Route::resource('provinsi', 'ProvinsiController');

	//Kota
	Route::post('kota/synchronize', 'KotaController@synchronize');
	Route::get('kota/datatables', 'KotaController@datatables');
	Route::resource('kota', 'KotaController');

	//Kecamatan
	Route::post('kecamatan/synchronize', 'KecamatanController@synchronize');
	Route::get('kecamatan/datatables', 'KecamatanController@datatables');
	Route::resource('kecamatan', 'KecamatanController');

	//Kelurahan
	Route::post('kelurahan/synchronize', 'KelurahanController@synchronize');
	Route::get('kelurahan/datatables', 'KelurahanController@datatables');
	Route::resource('kelurahan', 'KelurahanController');

	//LSBU Wilayah
	Route::post('lsbu-wilayah/synchronize', 'LsbuWilayahController@synchronize');
	Route::get('lsbu-wilayah/datatables', 'LsbuWilayahController@datatables');
	Route::get('master-data/lsbu-wilayah', 'LsbuWilayahController@index');
	Route::resource('lsbu-wilayah', 'LsbuWilayahController');

	//LingkupPekerjaanLsbu
	Route::post('lingkup-pekerjaan-lsbu/synchronize', 'LingkupPekerjaanLsbuController@synchronize');
	Route::get('lingkup-pekerjaan-lsbu/datatables', 'LingkupPekerjaanLsbuController@datatables');
	Route::get('master-data/lingkup-pekerjaan-lsbu', 'LingkupPekerjaanLsbuController@index');
	Route::resource('lingkup-pekerjaan-lsbu', 'LingkupPekerjaanLsbuController');

	//Asesor
	Route::get('asesor/select2', 'AsesorController@select2');
	Route::post('asesor/synchronize', 'AsesorController@synchronize');
	Route::get('asesor/datatables', 'AsesorController@datatables');
	Route::resource('asesor', 'AsesorController');

	//BadanUsaha
	Route::post('badan-usaha/synchronize', 'BadanUsahaController@synchronize');
	Route::get('badan-usaha/datatables', 'BadanUsahaController@datatables');
	Route::resource('badan-usaha', 'BadanUsahaController');

	//Permohonan Resource Controller
	Route::get('permohonan/counter', 'PermohonanController@counter');
	Route::post('permohonan/tarik-nomor-sertifikat', 'PermohonanController@tarikNomorSertifikat');
	Route::post('permohonan/generate-nomor-agenda', 'PermohonanController@generateNomorAgenda');
	Route::post('permohonan/set-is-processed', 'PermohonanController@setIsProcessed');
	Route::post('permohonan/delete-asesor-pjt', 'PermohonanController@deleteAsesorPJT');
	Route::post('permohonan/add-asesor-pjt', 'PermohonanController@saveAsesorPJT');
	Route::post('permohonan/delete-asesor-tt', 'PermohonanController@deleteAsesorTT');
	Route::post('permohonan/add-asesor-tt', 'PermohonanController@saveAsesorTT');
	Route::get('permohonan/{uid_permohonan}/print-certificate', 'PermohonanController@printCertificate');
	Route::post('permohonan/change-status', 'PermohonanController@changeStatus');

	Route::get('permohonan/{uid_permohonan}/persyaratan-administratif', 'PermohonanController@fetchPersyaratanAdministratif');
	Route::get('permohonan/{uid_permohonan}/identitas-badan-usaha', 'PermohonanController@getIdentitasBadanUsaha');
	Route::get('permohonan/{uid_permohonan}/verifikasi-ibu', 'PermohonanController@getVerifikasiIbu');

	//Outline renderers
		Route::get('permohonan/{uid_permohonan}/outline-persyaratan-administratif', 'PermohonanController@renderOutlinePersyaratanAdministratif');
		Route::get('permohonan/{uid_permohonan}/outline-persyaratan-teknis', 'PermohonanController@renderOutlinePersyaratanTeknis');
		Route::get('permohonan/{uid_permohonan}/outline-data-pengurus', 'PermohonanController@renderOutlineDataPengurus');

	Route::get('permohonan/datatables', 'PermohonanController@datatables');
	Route::resource('permohonan', 'PermohonanController');

	//Master Data controllers
	Route::get('master-data/bentuk-badan-usaha', 'MasterDataController@renderBentukBadanUsahaView');
	Route::get('master-data/jenis-usaha', 'MasterDataController@renderJenisUsahaView');
	Route::get('master-data/bidang', 'MasterDataController@renderBidangView');
	Route::get('master-data/sub-bidang', 'MasterDataController@renderSubBidangView');
	Route::get('master-data/matriks-kualifikasi', 'MasterDataController@renderMatriksKualifikasiView');
	Route::get('master-data/provinsi', 'MasterDataController@renderProvinsiView');
	Route::get('master-data/kota', 'MasterDataController@renderKotaView');
	Route::get('master-data/kecamatan', 'MasterDataController@renderKecamatanView');
	Route::get('master-data/kelurahan', 'MasterDataController@renderKelurahanView');
	Route::get('master-data/asesor', 'MasterDataController@renderAsesorView');
	Route::get('master-data/badan-usaha', 'MasterDataController@renderBadanUsahaView');

	//Service Controllers
	Route::post('service/tarik-pendaftaran', 'ServiceController@runTarikPendaftaran');
	Route::get('service/tarik-pendaftaran', 'ServiceController@renderTarikPendaftaranView');

	//Identitas Badan Usaha
	Route::post('identitas-badan-usaha/edit', 'IdentitasBadanUsahaController@updateData');
	Route::post('identitas-badan-usaha/pull-from-gatrik', 'IdentitasBadanUsahaController@pullFromGatrik');
	Route::resource('identitas-badan-usaha', 'IdentitasBadanUsahaController');

	//Persyaratan Administratif
	Route::post('persyaratan-administratif/edit', 'PersyaratanAdministratifController@updateData');
	Route::post('persyaratan-administratif/pull-from-gatrik', 'PersyaratanAdministratifController@pullFromGatrik');
	Route::resource('persyaratan-administratif', 'PersyaratanAdministratifController');

	//Persyaratan Teknis
	Route::get('persyaratan-teknis/selectSubBidang', 'PersyaratanTeknisController@selectSubBidang');
	Route::post('persyaratan-teknis/delete', 'PersyaratanTeknisController@delete');
	Route::post('persyaratan-teknis/pull-from-gatrik/{uid_permohonan}', 'PersyaratanTeknisController@pullFromGatrik');
	Route::resource('persyaratan-teknis', 'PersyaratanTeknisController');


	// Persyaratan Teknis Penanggung Jawab Teknik
	Route::post('persyaratan-teknis-pjt/delete', 'PersyaratanTeknisPenanggungJawabTeknikController@delete');
	Route::post('persyaratan-teknis-pjt/pull-from-gatrik', 'PersyaratanTeknisPenanggungJawabTeknikController@pullFromGatrik');
	Route::resource('persyaratan-teknis-pjt', 'PersyaratanTeknisPenanggungJawabTeknikController');

	//Sertifikat Persyaratan Teknis Penanggung Jawab teknis
	Route::post('sertifikat-pt-pjt/delete', 'SertifikatPtPjtController@delete');
	Route::post('sertifikat-pt-pjt/pull-from-gatrik', 'SertifikatPtPjtController@pullFromGatrik');
	Route::resource('sertifikat-pt-pjt', 'SertifikatPtPjtController');


	//Persyaratan Teknis Tenaga Teknik
	Route::post('persyaratan-teknis-tt/delete', 'PersyaratanTeknisTenagaTeknikController@delete');
	Route::post('persyaratan-teknis-tt/pull-from-gatrik', 'PersyaratanTeknisTenagaTeknikController@pullFromGatrik');
	Route::resource('persyaratan-teknis-tt', 'PersyaratanTeknisTenagaTeknikController');

	//Sertifikat Persyaratan Teknis Tenaga Teknik
	Route::post('sertifikat-pt-tt/delete', 'SertifikatPtTtController@delete');
	Route::post('sertifikat-pt-tt/pull-from-gatrik', 'SertifikatPtTtController@pullFromGatrik');
	Route::resource('sertifikat-pt-tt', 'SertifikatPtTtController');


	//Data Pengurus Dewan Komisaris
	Route::post('data-pengurus-dewan-komisaris/delete', 'DataPengurusDewanKomisarisController@delete');
	Route::post('data-pengurus-dewan-komisaris/pull-from-gatrik', 'DataPengurusDewanKomisarisController@pullFromGatrik');
	Route::resource('data-pengurus-dewan-komisaris', 'DataPengurusDewanKomisarisController');

	//Data Pengurus Dewan Direksi
	Route::post('data-pengurus-dewan-direksi/delete', 'DataPengurusDewanDireksiController@delete');
	Route::post('data-pengurus-dewan-direksi/pull-from-gatrik', 'DataPengurusDewanDireksiController@pullFromGatrik');
	Route::resource('data-pengurus-dewan-direksi', 'DataPengurusDewanDireksiController');

	//Data Pengurus Pemegang Saham
	Route::post('data-pengurus-pemegang-saham/delete', 'DataPengurusPemegangSahamController@delete');
	Route::post('data-pengurus-pemegang-saham/pull-from-gatrik', 'DataPengurusPemegangSahamController@pullFromGatrik');
	Route::resource('data-pengurus-pemegang-saham', 'DataPengurusPemegangSahamController');


	//Akta Perubahan BU Persyaratan Administratif
	Route::post('akta-perubahan-bu-pa/pull-from-gatrik', 'AktaPerubahanBuPaController@pullFromGatrik');
	Route::resource('akta-perubahan-bu-pa', 'AktaPerubahanBuPaController');

	//Pengesahan Akta Perubahan
	Route::post('pengesahan-akta-perubahan/pull-from-gatrik', 'PengesahanAktaPerubahanController@pullFromGatrik');
	Route::resource('pengesahan-akta-perubahan', 'PengesahanAktaPerubahanController');


	//Sertifikat
	Route::get('sertifikat/{id}/print-pdf', 'SertifikatController@printPdf');
	Route::resource('sertifikat', 'SertifikatController');
	//Configuration
		Route::post('configuration/service-integrator/generate-token', 'ConfigurationController@generateToken');
		Route::post('configuration/service-integrator/test-connection', 'ConfigurationController@testConnection');
		Route::get('configuration/service-integrator', 'ConfigurationController@renderServiceIntegratorView');

	//Role
	Route::post('role/update-permission', 'RoleController@updatePermission');
	Route::get('role/datatables', 'RoleController@datatables');
	Route::resource('role', 'RoleController');

	//Permission
	Route::get('permission/datatables', 'PermissionController@datatables');
	Route::resource('permission', 'PermissionController');


	//Verifikasi IBU
	Route::resource('verifikasi-ibu', 'VerifikasiIbuController');

	//Verifikasi PA
	Route::Resource('verifikasi-pa', 'VerifikasiPaController');
});

