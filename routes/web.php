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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){

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

	//Asesor
	Route::post('asesor/synchronize', 'AsesorController@synchronize');
	Route::get('asesor/datatables', 'AsesorController@datatables');
	Route::resource('asesor', 'AsesorController');

	//BadanUsaha
	Route::post('badan-usaha/synchronize', 'BadanUsahaController@synchronize');
	Route::get('badan-usaha/datatables', 'BadanUsahaController@datatables');
	Route::resource('badan-usaha', 'BadanUsahaController');

	//Permohonan Resource Controller
	Route::get('permohonan/{uid_permohonan}/print-certificate', 'PermohonanController@printCertificate');
	Route::post('permohonan/change-status', 'PermohonanController@changeStatus');
	Route::get('permohonan/{uid_permohonan}/persyaratan-administratif', 'PermohonanController@fetchPersyaratanAdministratif');
	Route::get('permohonan/{uid_permohonan}/identitas-badan-usaha', 'PermohonanController@getIdentitasBadanUsaha');
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
	Route::resource('persyaratan-administratif', 'PersyaratanAdministratifController');


	//Configuration
		Route::post('configuration/service-integrator/generate-token', 'ConfigurationController@generateToken');
		Route::post('configuration/service-integrator/test-connection', 'ConfigurationController@testConnection');
		Route::get('configuration/service-integrator', 'ConfigurationController@renderServiceIntegratorView');

});

