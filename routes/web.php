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
	Route::get('provinsi/datatables', 'ProvinsiController@datatables');
	Route::resource('provinsi', 'ProvinsiController');

	//Permohonan Resource Controller
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


	//Configuration
		Route::post('configuration/service-integrator/generate-token', 'ConfigurationController@generateToken');
		Route::post('configuration/service-integrator/test-connection', 'ConfigurationController@testConnection');
		Route::get('configuration/service-integrator', 'ConfigurationController@renderServiceIntegratorView');

});

