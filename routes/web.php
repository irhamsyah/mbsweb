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
Route::get('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah');
Route::post('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah_add');
Route::put('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah_edit');
Route::delete('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah_destroy');
Route::post('/bo_cs_de_nasabah/cari','NasabahController@bo_cs_de_nasabah_cari');//search filter
//Route Tabungan
Route::get('/bo_cs_de_tabungan','TabunganController@bo_cs_de_tabungan')->name('showtabungan');
//Route Edit Tabungan 
Route::post('bo_tab_edit_tabungan',
    [
        'as'=>'bo_tab_edit_tabungan',
        'uses'=>'TabunganController@bo_tab_edit_tabungan'
    ]
);

Route::post('bo_tab_add_tabung',
[
    'as'=>'bo_tab_add_tabung',
    'uses'=>'TabunganController@bo_tab_add_tabung'
]
);
Route::post('bo_tabungan_edit_cari',
[
    'as'=>'cariprofiletab',
    'uses'=>'TabunganController@cariprofiletab'
]);
Route::get('bo_tabungan_edit_cari',
[
    'as'=>'getcariprofiletab',
    'uses'=>'TabunganController@bo_cs_de_tabungan'
]);
