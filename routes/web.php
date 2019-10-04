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

Route::group(['middleware' => 'auth'], function () {

	Route::get('master-data/bentuk-badan-usaha/dataTables','BentukBadanUsahaController@dataTables');
	Route::get('master-data/bentuk-badan-usaha', 'MasterDataController@bentukBadanUsaha');

});

