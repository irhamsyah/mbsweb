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
// Route::get('/', function () {
//     return redirect(route('login'));
// });

Route::get('/','Auth\LoginController@LoginUser')->name('login');
Route::post('/login','Auth\LoginController@AuthLoginUser')->name('authlogin');

// Route::get('/','Auth\LoginController@LoginUser')->name('login');
// Route::post('/','Auth\LoginController@AuthLoginUser')->name('authlogin');

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
Route::get('/bo_cs_de_nasabah/printspicemen','NasabahController@bo_cs_de_spicemen_rppdf')->name('cetakspicemen');//print spicemen profil nasabah

Route::get('/bo_cs_de_profil', 'NasabahController@bo_cs_de_profil');
// Route::post('/bo_cs_de_profil', 'NasabahController@bo_cs_de_profil_add');
// Route::put('/bo_cs_de_profil', 'NasabahController@bo_cs_de_profil_edit');
Route::delete('/bo_cs_de_profil', 'NasabahController@bo_cs_de_profil_destroy');
Route::post('/bo_cs_de_profil/cari','NasabahController@bo_cs_de_profil_cari');//search filter
Route::post('/bo_cs_de_profil/detail','NasabahController@bo_cs_de_profil_detail');//detail profile
Route::post('/bo_cs_de_profil/kredit','NasabahController@bo_cs_de_profil_kredit');//detail kredit

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
//nasabah
Route::get('/bo_cs_rp_nasabah', 'ReportController@bo_cs_rp_nasabah')->name('carinasabah');
Route::post('/bo_cs_rp_nasabah/cari','ReportController@bo_cs_rp_nasabah_cari');//search filter
Route::post('/bo_cs_rp_nasabah/exportnasabah', 'ReportController@bo_cs_rp_nasabah_rp');//export nasabah
Route::get('/bo_cs_rp_nasabah/printnasabah','ReportController@bo_cs_rp_nasabah_rppdf')->name('cetaknasabah');//print nasabah
Route::get('/bo_cs_rp_nasabah/exportamplop', 'ReportController@bo_cs_rp_nasabah_rp_amplop')->name('cetaknasabahamplop');//print amplop surat
//tabungan
Route::get('/bo_cs_rp_tabungan', 'ReportController@bo_cs_rp_tabungan')->name('caritabungan');
Route::post('/bo_cs_rp_tabungan/cari','ReportController@bo_cs_rp_tabungan_cari');//search filter
Route::get('/bo_cs_rp_tabungan/printcovertab', 'ReportController@bo_cs_rp_tabungan_rp_covertab')->name('cetakcovertab');//print cover butab
Route::post('/bo_cs_rp_tabungan/buktisetortab', 'ReportController@bo_cs_rp_tabungan_buktisetor')->name('caribuktisetortab');//form bukti setor tabungan
Route::post('/bo_cs_rp_tabungan/printbuktisetortab', 'ReportController@bo_cs_rp_tabungan_rp_buktisetortab');//print bukti setor tab
//Umum
Route::get('/bo_cs_rp_umum', 'ReportController@bo_cs_rp_umum')->name('cariumum');
Route::post('/bo_cs_rp_umum/cari','ReportController@bo_cs_rp_umum_cari');//search filter
Route::post('/bo_cs_rp_umum/printdokumenumum', 'ReportController@bo_cs_rp_umum_rp_umum');//print umum


//BO DEPOSITO DP Data Entry Deposito
Route::get('/bo_dp_de_deposito', 'DepositoController@bo_dp_de_deposito')->name('showdeposito');
Route::post('/bo_dp_de_deposito/cari','DepositoController@bo_dp_de_deposito_cari');//search filter
Route::post('/bo_dp_de_deposito', 'DepositoController@bo_dp_de_deposito_add');
Route::put('/bo_dp_de_deposito', 'DepositoController@bo_dp_de_deposito_edit');
Route::delete('/bo_dp_de_deposito', 'DepositoController@bo_dp_de_deposito_destroy');
Route::get('/bo_dp_de_deposito/printbukarekdeposito','DepositoController@bo_cs_de_bukarekdeposito_rppdf')->name('cetakbukarekdeposito');//print buka rekening deposito

//BO KREDIT Data Entry KREDIT
Route::get('/bo_kr_de_kredit', 'KreditController@bo_kr_de_kredit')->name('showkredit');
Route::post('/bo_kr_de_kredit/add','KreditController@bo_kr_de_kredit_add');//add kredit
Route::get('/bo_kr_de_kredit/getKredits','KreditController@getKredits')->name('Getkredits');
// Route::post('/bo_dp_de_deposito', 'DepositoController@bo_dp_de_deposito_add');
// Route::put('/bo_dp_de_deposito', 'DepositoController@bo_dp_de_deposito_edit');
// Route::delete('/bo_dp_de_deposito', 'DepositoController@bo_dp_de_deposito_destroy');
// Route::get('/bo_dp_de_deposito/printbukarekdeposito','DepositoController@bo_cs_de_bukarekdeposito_rppdf')->name('cetakbukarekdeposito');//print buka rekening deposito


//Route Tabungan
Route::get('/bo_tb_de_tabungan','TabunganController@bo_tb_de_tabungan')->name('showtabungan');
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

// Routing Report Nominatif
Route::get('bo_tb_rpt_nominatif','TabunganController@bo_tb_rpt_nominatif')->name('bo_tb_rpt_nominatif');
Route::post('bo_tb_rpt_nominatifview','TabunganController@bo_tb_rpt_nominatifview')->name('bo_tb_rpt_nominatifview');
Route::post('nominatifeksport/{id}',
[
    'as'=>'nominatifeksport',
    'uses'=>'TabunganController@exportnominatiftabungan'
]
);
Route::get('nominatifeksport/{id}','TabunganController@bo_tb_rpt_nominatif');
Route::get('bo_tb_rpt_pdfnominatif','TabunganController@bo_tb_rpt_pdfnominatif')->name('cetaknomtabungan');
// Report Nominatif Rekap
Route::get('bo_tb_rpt_nominatifrekap','TabunganController@bo_tb_rpt_nominatifrekap')->name('bo_tb_rpt_nominatifrekap');
Route::post('bo_tb_rpt_nominatifrekapview','TabunganController@bo_tb_rpt_nominatifrekapview');
Route::get('bo_tb_rpt_nominatifrekapview','TabunganController@bo_tb_rpt_nominatifrekap');
Route::post('nominatifrekapeksport/{id}',
[
    'as'=>'nominatifrekapeksport',
    'uses'=>'TabunganController@exportnominatiftabunganrekap'
]);
Route::get('nominatifrekapeksport/{id}','TabunganController@bo_tb_rpt_nominatifrekap');
Route::get('bo_tb_rpt_pdfnominatifrekap','TabunganController@bo_tb_rpt_pdfnominatifrekap')->name('cetaknomtabunganrekap');
// Report Nominatif Express
Route::get('bo_tb_rpt_nominatifexpress','TabunganController@bo_tb_rpt_nominatifexpress')->name('bo_tb_rpt_nominatifexpress');
Route::post('bo_tb_rpt_nominatifexpressview','TabunganController@bo_tb_rpt_nominatifexpressview');
Route::post('nominatifexpresseksport/{id}','TabunganController@nominatifexpresseksport')->name('nominatifexpresseksport');
Route::get('bo_tb_rpt_pdfnominatifexpress','TabunganController@bo_tb_rpt_pdfnominatifexpress')->name('cetaknomtabunganexpress');
// Report Nominatif Tabungan PASIF
Route::get('bo_tb_rpt_nominatifpasif','TabunganController@bo_tb_rpt_nominatifpasif')->name('bo_tb_rpt_nominatifpasif');
Route::post('bo_tb_rpt_nominatifpasifview','TabunganController@bo_tb_rpt_nominatifpasifview');
// Report Tabungan Blokir
Route::get('bo_tb_rpt_tabunganblokir','TabunganController@bo_tb_rpt_tabunganblokir')->name('bo_tb_rpt_tabunganblokir');
Route::post('bo_tb_rpt_tabunganblokirview','TabunganController@bo_tb_rpt_tabunganblokirview')->name('bo_tb_rpt_tabunganblokirview');
// MUNCULKAN HALAMAN NOMINATIF BLOKIR YANG AKAN DI CETAK
Route::get('bo_tb_rpt_pdftabblokir','TabunganController@bo_tb_rpt_pdftabblokir')->name('cetaktabunganblokir');

Route::post('nominatifpasifeksport','TabunganController@nominatifpasifeksport');
Route::get('bo_tb_rpt_pdfnominatifpasif','TabunganController@bo_tb_rpt_pdfnominatifpasif')->name('cetaknomtabunganpasif');
//Form Hitung Bunga Tabungan
Route::get('bo_tb_de_frmhitungbungatab','TabunganController@bo_tb_de_frmhitungbungatab')->name('frmhitungbungatab');
Route::post('bo_tb_de_hitungbungatab','TabunganController@bo_tb_de_hitungbungatab');
// Form Browse Bunga dan Pajak
Route::get('bo_tb_de_frmbrowsebungapajak','TabunganController@bo_tb_de_frmbrowsebungapajak')->name('frmbrowsebungapajak');
// EXPORT BROWSE BUNGA DAN PAJAK TABUNGAN
Route::post('exporttoexcelbungapajaktabungan',
[
    'as'=>'exporttoexcelbungapajaktabungan',
    'uses'=>'TabunganController@exporttoexcelbungapajaktabungan'
]
);
// form Report tabungan berdasarkan jenis
Route::get('bo_tb_rpt_nominatijenis','TabunganController@bo_tb_rpt_nominatijenis')->name('nominatifperjenistab');
// Form Report Nominatif Jenis untuk Cetak dan Export
Route::post('bo_tb_rpt_nominatifperjenisview','TabunganController@bo_tb_rpt_nominatifperjenisview');
// cetak PDF/PRIN REPORT NOM
Route::get('cetaknomtabunganperjenis',
    [
        'as'=>'cetaknomtabunganperjenis',
        'uses'=>'TabunganController@cetaknomtabunganperjenis'
    ]
);
Route::post('nominatifperjeniseksport',
    [
        'as'=>'nominatifperjeniseksport',
        'uses'=>'TabunganController@nominatifperjeniseksport'
    ]
);

Route::post('bo_adm_update_bngpjk','TabunganController@bo_adm_update_bngpjk');
// Form Overbooking tabungan
Route::get('bo_tb_de_frmoverbooktabungan','TabunganController@bo_tb_de_frmoverbooktabungan')->name('frmoverbooktabungan');
// Proses Overbooking Tabungan 
Route::get('bo_tab_overbook','TabunganController@bo_tab_overbook')->name('prosesoverbooking');
// Form Blokir Tabungan
Route::get('bo_tb_de_showfrmblokir','TabunganController@bo_tb_de_showfrmblokir')->name('frmblokir');
// Form simpan blokiran
Route::post('bo_tb_de_simpanblokirtab','TabunganController@bo_tb_de_simpanblokirtab');
// SHow form for unblokir
Route::get('bo_tb_de_showfrmunblokir','TabunganController@bo_tb_de_showfrmunblokir');
Route::post('bo_adm_update_unblokir','TabunganController@bo_adm_update_unblokir');


// Form Hapus Transaksi
Route::get('bo_tb_de_frmhapustransaksi','TabunganController@bo_tb_de_frmhapustransaksi')->name('bo_tb_de_frmhapustransaksi');
// del transaksi
Route::post('bo_tab_del_trs','TabunganController@bo_tab_del_trs');
// cari transaksi per tgl
Route::get('bo_tabungan_transaksi_cari','TabunganController@bo_tabungan_transaksi_cari');
// Form Cetak Transaksi Tabungan
Route::get('bo_tb_rpt_frmtransaksi','TabunganController@bo_tb_rpt_frmtransaksi')->name('formcetaktransaksi');
// Cari transaksi tabungan
Route::post('bo_tb_rpt_caritransaksi','TabunganController@bo_tb_rpt_caritransaksi')->name('formcetaktransaksi2');
Route::get('bo_tb_rpt_pdftransaksi','TabunganController@bo_tb_rpt_pdftransaksi')->name('cetaktransaksitabungan');

// EXPORT KE EXCEL TRANSAKSI TABUNGAN
Route::post('exporttoexceltransaksitab',
[
    'as'=>'exporttoexceltransaksitab',
    'uses'=>'TabunganController@exporttoexceltransaksitab'
]
);
// EXPORT KE EXCEL TABUNGAN BLOKIR
Route::post('exporttoexceltabblokir',
[
    'as'=>'exporttoexceltabblokir',
    'uses'=>'TabunganController@exporttoexceltabblokir'
]
);
// TELLER
Route::get('bo_tl_tt_setoranpenarikantabungan','TellertabunganController@bo_tl_tt_setoranpenarikantabungan')->name('setoranpenarikantabungan');
Route::post('bo_tl_tt_simpantrstabungan','TellertabunganController@bo_tl_tt_simpantrstabungan');
// AKUNTANSI
Route::get('bo_ak_tt_postingdatatransaksi','AkuntansiController@bo_ak_tt_postingdatatransaksi')->name('showformpostingdatatransaksi');
// cari dan posting ke trans_master_buffer dan trans_detail_buffer
Route::post('bo_ak_tr_postingtransaksi','AkuntansiController@bo_ak_tr_postingtransaksi');
// Show form validation
Route::get('bo_ak_tt_validasidatatransaksi','AkuntansiController@bo_ak_tt_validasidatatransaksi')->name('showformvalidasidatatransaksi');
Route::get('bo_ak_tt_caridatatransaksi','AkuntansiController@bo_ak_tt_caridatatransaksi')->name('caritrans');
// simpan update/perubhan validasi
Route::post('bo_ak_tt_simpanupdvalidasi','AkuntansiController@bo_ak_tt_simpanupdvalidasi')->name('simpanperubahankodeperk');
// simpan penambahan record trans_detail_buffer
Route::post('bo_ak_tt_addrecvalidasi','AkuntansiController@bo_ak_tt_addrecvalidasi')->name('addcodetransdetailbuff');
Route::delete('bo_ak_tt_deltransdetailbuff','AkuntansiController@bo_ak_tt_deltransdetailbuff')->name('hapustransdetailbuff');
// Simpan jurnal
Route::post('bo_ak_tt_simpanjurnal','AkuntansiController@bo_ak_tt_simpanjurnal');
// Pencatatan Transaksi Jurnal Memorial/Manual
Route::get('bo_ak_tt_showfrmctttransaksi','AkuntansiController@bo_ak_tt_showfrmctttransaksi')->name('showformcatattransaksi');
Route::post('bo_tb_de_savetempjurnalmemorial','AkuntansiController@bo_tb_de_savetempjurnalmemorial');
Route::delete('bo_ak_tt_delcatatjurnaldetail','AkuntansiController@bo_ak_tt_delcatatjurnaldetail');
Route::post('bo_ak_tt_simpancatatjurnal','AkuntansiController@bo_ak_tt_simpancatatjurnal');
// Update kode_perk, debet.kredit pada pencatatan transaksi dari Modal
Route::post('bo_ak_tt_updatecatatjurnal','AkuntansiController@bo_ak_tt_updatecatatjurnal')->name('saveperubahankodeperkpencttjur');
// SHOW FORM HISTORY CATAT JURNAL/MEMORIAL
Route::get('bo_ak_tt_historycatatjurnal','AkuntansiController@bo_ak_tt_historycatatjurnal')->name('showformhistoryjurnal');
Route::post('bo_ak_tt_carihistorycatatjurnal','AkuntansiController@bo_ak_tt_carihistorycatatjurnal');
// Munculkan detail jurnal pada history pencatatan jurnal
Route::get('bo_ak_tt_detailhistorycatatjurnal/{id}','AkuntansiController@bo_ak_tt_detailhistorycatatjurnal')->name('historycatatjurnal');
// SIMPAN DATA PERUBAHAN HISTORY PENCATATAN JURNAL
Route::post('bo_ak_tt_updatehistorycatatjurnal','AkuntansiController@bo_ak_tt_updatehistorycatatjurnal')->name('updatehistorycttjurnal');
Route::delete('bo_ak_tt_deletehistorycatatjurnal','AkuntansiController@bo_ak_tt_deletehistorycatatjurnal');
    // DATA ENTRY DAFTAR PERKIRAAN
Route::get('bo_ak_de_showformdataperkiraan','AkuntansiController@bo_ak_de_showformdataperkiraan')->name('showformperkiraan');
// ADD Perkiraan
Route::post('bo_ak_de_addperkiraan','AkuntansiController@bo_ak_de_addperkiraan')->name('addperkiraan');
// Update / Edit Perkiraan
Route::post('bo_ak_de_updateperkiraan','AkuntansiController@bo_ak_de_updateperkiraan')->name('updtperkiraan');
// DELETE Perkiraan
Route::delete('bo_ak_de_delperkiraan','AkuntansiController@bo_ak_de_delperkiraan')->name('delperkiraan');
// SHow form pencatatan Kode Jurnal Transaksi
Route::get('bo_ak_de_showfrmkodetransaksi','AkuntansiController@bo_ak_de_showfrmkodetransaksi')->name('showfrmkodetransaksi');
// Add Kode Jurnal
Route::post('bo_ak_de_addkodejurnal','AkuntansiController@bo_ak_de_addkodejurnal');
// Update Kode Jurnal
Route::post('bo_ak_de_updatekodejurnal','AkuntansiController@bo_ak_de_updatekodejurnal');
// delete Kode Jurnal
Route::delete('bo_ak_de_delkodejurnaltrans','AkuntansiController@bo_ak_de_delkodejurnaltrans');
// LAPORAN-LAPORAN AKUNTANSI
Route::get('bo_ak_lp_showfrnrptdaftarperkiraan','AkuntansiController@bo_ak_lp_showfrnrptdaftarperkiraan')->name('showfrnrptdaftarperkiraan');
// Munculkan preview cetak daftar perkiraan
Route::get('bo_pr_perkiraan','AkuntansiController@bo_pr_perkiraan')->name('pdfperkiraan');
// export to excel daftar perkiraan
Route::post('bo_ex_daftarperkiraan','AkuntansiController@bo_ex_daftarperkiraan');
// Show form report translation jurnal
Route::get('bo_ak_lp_showfrmrptjurnaltransaksi','AkuntansiController@showfrmrptjurnaltransaksi')->name('showfrmrptjurnaltransaksi');
// cari jurnal transaksi
Route::post('bo_ak_lp_carijurnal','AkuntansiController@bo_ak_lp_carijurnal');
// cetak pdf jurnal transaksi
Route::post('bo_ak_lp_cetakjurnal','AkuntansiController@bo_ak_lp_cetakjurnal');


//TELLER TRANS DEPOSITO
//SETORAN DEPOSITO
Route::get('/bo_tl_td_setorandeposito', 'TellerDepositoController@bo_tl_td_setorandeposito')->name('showsetorandeposito');
//Route::post('/bo_tl_td_setorandeposito/cari','TellerDepositoController@bo_tl_td_setorandeposito_cari');//search filter
Route::post('/bo_tl_td_setorandeposito', 'TellerDepositoController@bo_tl_td_setorandeposito_add');
// Route::put('/bo_tl_td_setorandeposito', 'TellerDepositoController@bo_tl_td_setorandeposito_edit');
// Route::delete('/bo_tl_td_setorandeposito', 'TellerDepositoController@bo_tl_td_setorandeposito_destroy');
Route::get('/bo_tl_td_setorandeposito/printbukarekdeposito','TellerDepositoController@bo_tl_td_setorandeposito_rppdf')->name('cetakbukarekdeposito');//print buka rekening deposito
//PENGAMBILAN BUNGA DEPOSITO
Route::get('/bo_tl_td_pengambilanbungadeposito', 'TellerDepositoController@bo_tl_td_pengambilanbungadeposito')->name('showpengambilanbungadeposito');
//Route::post('/bo_tl_td_pengambilanbungadeposito/cari','TellerDepositoController@bo_tl_td_pengambilanbungadeposito_cari');//search filter
Route::post('/bo_tl_td_pengambilanbungadeposito', 'TellerDepositoController@bo_tl_td_pengambilanbungadeposito_add');
//PENUTUPAN BUNGA DEPOSITO
Route::get('/bo_tl_td_penutupandeposito', 'TellerDepositoController@bo_tl_td_penutupandeposito')->name('showpenutupandeposito');
//Route::post('/bo_tl_td_penutupandeposito/cari','TellerDepositoController@bo_tl_td_penutupandeposito_cari');//search filter
Route::post('/bo_tl_td_penutupandeposito', 'TellerDepositoController@bo_tl_td_penutupandeposito_add');