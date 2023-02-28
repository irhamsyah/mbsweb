<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//Frontend Page
// PERUBAHAN PADA ROUTE 
//PENAMABAHAN KOMNENTAR KE 2
Auth::routes();
// tes lagi
// Route::get('tes',function(){
//     return view('auth.register');
// });

// Route::get('/verify','Auth\RegisterController@verifyUser')->name('verify.user');
//Route To login
Route::get('/', function () {
    return redirect(route('login'));
});
//Admin Page
Auth::routes([
    'register'=>false
    ]);

Route::get('/home', 'HomeController@admin_index')->name('home')->middleware('verified');
Route::get('/verify','Auth\RegisterController@verifyUser')->name('verify.user');

/* Verifiy Customer User*/
Route::get('/verifyuser','RegistercustomerController@verifyUser')->name('verify.cust');

//Route to admin pages
//BO CS Data Entry Nasabah
Route::get('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah');
Route::post('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah_add');
Route::put('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah_edit');
Route::delete('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah_destroy');
Route::post('/bo_cs_de_nasabah/cari','NasabahController@bo_cs_de_nasabah_cari');//search filter

Route::get('/bo_cs_de_profil', 'NasabahController@bo_cs_de_profil');
Route::post('/bo_cs_de_profil', 'NasabahController@bo_cs_de_profil_add');
Route::put('/bo_cs_de_profil', 'NasabahController@bo_cs_de_profil_edit');
Route::delete('/bo_cs_de_profil', 'NasabahController@bo_cs_de_profil_destroy');
Route::post('/bo_cs_de_profil/cari','NasabahController@bo_cs_de_profil_cari');//search filter

Route::get('/bo_cs_de_simulasi', 'NasabahController@bo_cs_de_simulasi');
Route::post('/bo_cs_de_simulasi', 'NasabahController@bo_cs_de_simulasi_add');
Route::put('/bo_cs_de_simulasi', 'NasabahController@bo_cs_de_simulasi_edit');
Route::delete('/bo_cs_de_simulasi', 'NasabahController@bo_cs_de_simulasi_destroy');
Route::post('/bo_cs_de_simulasi/cari','NasabahController@bo_cs_de_simulasi_cari');//search filter

//BO CS Administrator
Route::get('/bo_cs_ad_nasabah', 'AdministratorController@bo_cs_ad_nasabah');
Route::post('/bo_cs_ad_nasabah', 'AdministratorController@bo_cs_ad_nasabah_add');
Route::put('/bo_cs_ad_nasabah', 'AdministratorController@bo_cs_ad_nasabah_edit');
Route::delete('/bo_cs_ad_nasabah', 'AdministratorController@bo_cs_ad_nasabah_destroy');
Route::post('/bo_cs_ad_nasabah/cari','AdministratorController@bo_cs_ad_nasabah_cari');//search filter

Route::get('/bo_cs_ad_agama', 'AdministratorController@bo_cs_ad_agama');
Route::post('/bo_cs_ad_agama', 'AdministratorController@bo_cs_ad_agama_add');
Route::put('/bo_cs_ad_agama', 'AdministratorController@bo_cs_ad_agama_edit');
Route::delete('/bo_cs_ad_agama', 'AdministratorController@bo_cs_ad_agama_destroy');
Route::post('/bo_cs_ad_agama/cari','AdministratorController@bo_cs_ad_agama_cari');//search filter

Route::get('/bo_cs_ad_golongan', 'AdministratorController@bo_cs_ad_golongan');
Route::post('/bo_cs_ad_golongan', 'AdministratorController@bo_cs_ad_golongan_add');
Route::put('/bo_cs_ad_golongan', 'AdministratorController@bo_cs_ad_golongan_edit');
Route::delete('/bo_cs_ad_golongan', 'AdministratorController@bo_cs_ad_golongan_destroy');
Route::post('/bo_cs_ad_golongan/cari','AdministratorController@bo_cs_ad_golongan_cari');//search filter

//BO CS Laporan
Route::get('/bo_cs_rp_nasabah', 'ReportController@bo_cs_rp_nasabah');
Route::post('/bo_cs_rp_nasabah', 'ReportController@bo_cs_rp_nasabah_add');
Route::put('/bo_cs_rp_nasabah', 'ReportController@bo_cs_rp_nasabah_edit');
Route::delete('/bo_cs_rp_nasabah', 'ReportController@bo_cs_rp_nasabah_destroy');
Route::post('/bo_cs_rp_nasabah/cari','ReportController@bo_cs_rp_nasabah_cari');//search filter

//Route Tabungan
Route::get('/bo_tb_de_tabungan','TabunganController@bo_tb_de_tabungan');

Route::get('tes',function()
{
    

    $nama=App\Tabungan::where('NASABAH_ID','02000020')->nasabah()->get();
    foreach($nama as $names)
    {
        echo $names->no_rekening;
    }
});
