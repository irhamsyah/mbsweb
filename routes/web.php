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
Auth::routes();
// Route::get('tes',function(){
//     return view('auth.register');
// });

// Route::get('/verify','Auth\RegisterController@verifyUser')->name('verify.user');

Route::get('/', function () {
    return redirect(route('login'));
});
// Route::get('/', 'FrontendController@index');
Route::get('/tracking', 'FrontendController@tracking');
Route::post('/tracking', 'FrontendController@trackingpost');
Route::get('/service', 'FrontendController@service')->name('service.get');
Route::get('/contact', 'FrontendController@contact');
Route::post('/contact', 'RegistercustomerController@contact_add');
// Route::post('/contact', 'FrontendController@contact_add');

Route::post('/trans_new', 'FrontendController@trans_new');
Route::put('/trans_new', 'FrontendController@trans_new_add');
Route::get('/news', 'FrontendController@news');
Route::get('/news_detail/{id}', 'FrontendController@news_detail');

//set multilingual Frontend Page
Route::get('lang/{language}', 'LocalizationController@switch')->name('localization.switch');

//Admin Page
Auth::routes([
    'register'=>false
    ]);

Route::get('/home', 'HomeController@admin_index')->name('home')->middleware('verified');
Route::get('/verify','Auth\RegisterController@verifyUser')->name('verify.user');

/* Verifiy CUstomer User*/
Route::get('/verifyuser','RegistercustomerController@verifyUser')->name('verify.cust');

//Route to admin pages
Route::get('/bo_cs_de_nasabah', 'NasabahController@bo_cs_de_nasabah');

Route::get('/adm_logo', 'HomeController@admin_logo');
Route::put('/adm_logo', 'HomeController@admin_logo_edit');

Route::get('/adm_tracking', 'TrackingController@admin_tracking');
Route::post('/adm_tracking', 'TrackingController@admin_tracking_add');
Route::put('/adm_tracking', 'TrackingController@admin_tracking_edit');
Route::delete('/adm_tracking', 'TrackingController@admin_tracking_destroy');

Route::get('/adm_transaction', 'TransactionController@admin_transaction');
Route::post('/adm_transaction', 'TransactionController@admin_transaction_add');
Route::put('/adm_transaction', 'TransactionController@admin_transaction_edit');
Route::delete('/adm_transaction', 'TransactionController@admin_transaction_destroy');
Route::post('/adm_transaction_detail', 'TransactionController@admin_transaction_detail');

Route::get('/adm_news', 'NewsController@admin_news');
Route::post('/adm_news', 'NewsController@admin_news_add');
Route::put('/adm_news', 'NewsController@admin_news_edit');
Route::delete('/adm_news', 'NewsController@admin_news_destroy');

Route::get('/adm_news_category', 'NewsController@admin_news_category');
Route::post('/adm_news_category', 'NewsController@admin_news_category_add');
Route::put('/adm_news_category', 'NewsController@admin_news_category_edit');
Route::delete('/adm_news_category', 'NewsController@admin_news_category_destroy');

Route::get('/adm_news_img', 'NewsController@admin_news_image');
Route::post('/adm_news_img', 'NewsController@admin_news_image_add');
Route::put('/adm_news_img', 'NewsController@admin_news_image_edit');
Route::delete('/adm_news_img', 'NewsController@admin_news_image_destroy');

Route::get('/adm_customer', 'CustomerController@admin_customer');
Route::post('/adm_customer', 'CustomerController@admin_customer_add');
Route::put('/adm_customer', 'CustomerController@admin_customer_edit');
Route::delete('/adm_customer', 'CustomerController@admin_customer_destroy');

Route::get('/adm_agent', 'AgentController@admin_agent');
Route::post('/adm_agent', 'AgentController@admin_agent_add');
Route::put('/adm_agent', 'AgentController@admin_agent_edit');
Route::delete('/adm_agent', 'AgentController@admin_agent_destroy');

Route::get('/adm_bank_account', 'AgentController@admin_bank_account');
Route::post('/adm_bank_account', 'AgentController@admin_bank_account_add');
Route::put('/adm_bank_account', 'AgentController@admin_bank_account_edit');
Route::delete('/adm_bank_account', 'AgentController@admin_bank_account_destroy');

Route::get('/adm_pelayaran', 'PelayaranController@admin_pelayaran');
Route::post('/adm_pelayaran', 'PelayaranController@admin_pelayaran_add');
Route::put('/adm_pelayaran', 'PelayaranController@admin_pelayaran_edit');
Route::delete('/adm_pelayaran', 'PelayaranController@admin_pelayaran_destroy');

Route::get('/adm_tarif', 'PelayaranController@admin_tarif');
Route::post('/adm_tarif', 'PelayaranController@admin_tarif_add');
Route::put('/adm_tarif', 'PelayaranController@admin_tarif_edit');
Route::delete('/adm_tarif', 'PelayaranController@admin_tarif_destroy');

Route::get('/adm_consignee', 'ConsigneeController@admin_consignee');
Route::post('/adm_consignee', 'ConsigneeController@admin_consignee_add');
Route::put('/adm_consignee', 'ConsigneeController@admin_consignee_edit');
Route::delete('/adm_consignee', 'ConsigneeController@admin_consignee_destroy');

Route::get('/adm_trucking', 'TruckingController@admin_trucking');
Route::post('/adm_trucking', 'TruckingController@admin_trucking_add');
Route::put('/adm_trucking', 'TruckingController@admin_trucking_edit');
Route::delete('/adm_trucking', 'TruckingController@admin_trucking_destroy');

Route::get('/adm_vendor_truck', 'TruckingController@admin_vendor_truck');
Route::post('/adm_vendor_truck', 'TruckingController@admin_vendor_truck_add');
Route::put('/adm_vendor_truck', 'TruckingController@admin_vendor_truck_edit');
Route::delete('/adm_vendor_truck', 'TruckingController@admin_vendor_truck_destroy');

Route::get('/adm_location', 'LocationController@admin_location');
Route::post('/adm_location', 'LocationController@admin_location_add');
Route::put('/adm_location', 'LocationController@admin_location_edit');
Route::delete('/adm_location', 'LocationController@admin_location_destroy');

Route::get('/adm_slider', 'HomeController@admin_slider');
Route::post('/adm_slider', 'HomeController@admin_slider_add');
Route::put('/adm_slider', 'HomeController@admin_slider_edit');
Route::delete('/adm_slider', 'HomeController@admin_slider_destroy');

Route::get('/adm_testimoni', 'HomeController@admin_testimoni');
Route::post('/adm_testimoni', 'HomeController@admin_testimoni_add');
Route::put('/adm_testimoni', 'HomeController@admin_testimoni_edit');
Route::delete('/adm_testimoni', 'HomeController@admin_testimoni_destroy');

Route::get('/adm_service', 'HomeController@admin_service');
Route::post('/adm_service', 'HomeController@admin_service_add');
Route::put('/adm_service', 'HomeController@admin_service_edit');
Route::delete('/adm_service', 'HomeController@admin_service_destroy');

Route::get('/adm_content', 'HomeController@admin_content');
Route::put('/adm_content', 'HomeController@admin_content_edit');

Route::get('/adm_contentfooter', 'HomeController@admin_contentfooter');
Route::put('/adm_contentfooter', 'HomeController@admin_contentfooter_edit');

Route::get('/adm_contentimage', 'HomeController@admin_contentimage');
Route::post('/adm_contentimage', 'HomeController@admin_contentimage_add');
Route::put('/adm_contentimage', 'HomeController@admin_contentimage_edit');
Route::delete('/adm_contentimage', 'HomeController@admin_contentimage_destroy');
