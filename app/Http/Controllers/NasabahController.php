<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Nasabah;
use App\Logo;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App;
use Auth;
use Validator;
use Hash;
use Image;
use Mail;
use PDF;

class NasabahController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Untuk munculkan home setelah register user
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function bo_cs_de_nasabah()
    {
      $logos = Logo::all();
      $nasabahs = Nasabah::select('*')->limit(100)->orderby('nasabah.nasabah_id','ASC')->get();
      $users = User::all();

      return view('admin/nasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs]);
    }
    public function bo_cs_de_nasabah_cari(Request $request)
    {
      $logos = Logo::all();

      $nasabahs = Nasabah::where('nasabah_id', 'LIKE', '%' . request()->idnasabah1 . '%')
      ->when(request()->namanasabah1, function($query) {
        $query->where('nama_nasabah', 'LIKE', '%' . request()->namanasabah1 . '%');
      })
      ->when(request()->jenisnasabah1, function($query) {
        $query->where('jenis_nasabah', request()->jenisnasabah1);
      })
      ->limit(100)->orderby('nasabah.nasabah_id','ASC')->get();

      $users = User::all();

      return view('admin/nasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs]);
    }

    public function admin_transaction_add(Request $request)
    {
      $logos = Logo::all();
      $transactions = new Transaction;
      $transactions->loading_date = $request->inputDate4;
      $transactions->location_from = $request->inputFromCity;
      $transactions->location_to = $request->inputToCity;
      $transactions->pelayaran_id = $request->inputPelayaran;
      $transactions->resi_no = $request->inputResi;
      $transactions->status = $request->inputStatus;
      $transactions->save();

      $transactions = Transaction::select('transaction.*','customer.code_customer','customer.name_customer',
      'pelayaran.code_pelayaran','pelayaran.name_pelayaran','pelayaran.alias')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->leftjoin('pelayaran','pelayaran.id','=','transaction.pelayaran_id')
      ->orderby('transaction.id','DESC')
      ->get();

      $pelayarans = Pelayaran::all();

      /*$vendors = VendorTruck::select('vendor_truck.*','name_trucking')
      ->leftjoin('trucking_type','trucking_type.id','=','vendor_truck.trucking_type_id')->get();

      $agents = Agent::all();
      $locations = Location::all();
      */

      return view('admin/transaction', ['logos'=> $logos,'transactions'=> $transactions, 'pelayarans'=> $pelayarans]);
    }
    public function admin_transaction_edit(Request $request)
    {
      $logos = Logo::all();
      //update Transaction
      $transactions = Transaction::find($request->inputIdTransaction);
      $transactions->loading_date = $request->inputDate3;
      $transactions->location_from = $request->inputFromCity;
      $transactions->location_to = $request->inputToCity;
      $transactions->pelayaran_id = $request->inputPelayaran;
      $transactions->resi_no = $request->inputResi;
      $transactions->status = $request->inputStatus;
      $transactions->save();

      $transactions = Transaction::select('transaction.*','customer.code_customer','customer.name_customer',
      'pelayaran.code_pelayaran','pelayaran.name_pelayaran','pelayaran.alias')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->leftjoin('pelayaran','pelayaran.id','=','transaction.pelayaran_id')
      ->orderby('transaction.id','DESC')
      ->get();

      $pelayarans = Pelayaran::all();

      /*$vendors = VendorTruck::select('vendor_truck.*','name_trucking')
      ->leftjoin('trucking_type','trucking_type.id','=','vendor_truck.trucking_type_id')->get();

      $agents = Agent::all();
      $locations = Location::all();
      */

      return view('admin/transaction', ['logos'=> $logos,'transactions'=> $transactions, 'pelayarans'=> $pelayarans]);
    }
    //Direct to Proses Delete Transaction
    public function admin_transaction_destroy(Request $request)
    {
      $logos = Logo::all();
      $transactions = Tracking::find($request->inputIdTransaction);
      $transactions->delete();

      $transactions = Transaction::select('transaction.*','customer.code_customer','customer.name_customer',
      'pelayaran.code_pelayaran','pelayaran.name_pelayaran','pelayaran.alias')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->leftjoin('pelayaran','pelayaran.id','=','transaction.pelayaran_id')
      ->orderby('transaction.id','DESC')
      ->get();

      $pelayarans = Pelayaran::all();

      /*$vendors = VendorTruck::select('vendor_truck.*','name_trucking')
      ->leftjoin('trucking_type','trucking_type.id','=','vendor_truck.trucking_type_id')->get();

      $agents = Agent::all();
      $locations = Location::all();
      */

      return view('admin/transaction', ['logos'=> $logos,'transactions'=> $transactions, 'pelayarans'=> $pelayarans]);
    }
    public function admin_transaction_detail(Request $request)
    {
      $logos = Logo::all();
      $transactiondetails = TransactionDetail::select('*')->where('transaction_id',$request->inputIdTransaction)->get();
      $transactions = Transaction::select('transaction.*','customer.code_customer','customer.name_customer',
      'pelayaran.code_pelayaran','pelayaran.name_pelayaran','pelayaran.alias')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->leftjoin('pelayaran','pelayaran.id','=','transaction.pelayaran_id')
      ->where('transaction.id',$request->inputIdTransaction)
      ->get();

      return view('admin/transaction_detail', ['logos'=> $logos,'transactiondetails'=> $transactiondetails, 'transactions'=> $transactions]);
    }
}
