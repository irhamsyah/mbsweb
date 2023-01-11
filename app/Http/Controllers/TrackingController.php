<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Users;
use App\Agent;
use App\BankAccount;
use App\Consignee;
use App\Customer;
use App\Location;
use App\Pelayaran;
use App\Tarif;
use App\Tracking;
use App\Transaction;
use App\TruckingType;
use App\VendorTruck;
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

class TrackingController extends Controller
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

    public function admin_tracking()
    {
      $logos = Logo::all();
      $trackings = Tracking::select('tracking.*','transaction.trans_no','transaction.resi_no','transaction.customer_id','customer.code_customer','customer.name_customer')
      ->leftjoin('transaction','transaction.id','=','transaction_id')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->orderby('tracking.date','DESC')
      ->get();

      $transactions = Transaction::select('transaction.id','transaction.trans_no','transaction.loading_date','transaction.resi_no','customer.name_customer')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->orderby('customer.name_customer','ASC')
      ->orderby('transaction.id','DESC')
      ->get();

      return view('admin/tracking', ['logos'=> $logos,'trackings'=> $trackings, 'transactions'=> $transactions]);
    }
    public function admin_tracking_add(Request $request)
    {
      $logos = Logo::all();
      $trackings = new Tracking;
      $trackings->transaction_id = $request->inputTransactionNo;
      $trackings->longitude = $request->inputLongitude;
      $trackings->latitude = $request->inputLatitude;
      $trackings->description = $request->inputDesc;
      $trackings->date = $request->inputDate4;
      $trackings->created_at = date('Y-m-d H:i:s');
      $trackings->save();

      $trackings = Tracking::select('tracking.*','transaction.trans_no','transaction.resi_no','transaction.customer_id','customer.code_customer','customer.name_customer')
      ->leftjoin('transaction','transaction.id','=','transaction_id')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->orderby('tracking.date','DESC')
      ->get();

      $transactions = Transaction::select('transaction.id','transaction.trans_no','transaction.loading_date','transaction.resi_no','customer.name_customer')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->orderby('customer.name_customer','ASC')
      ->orderby('transaction.id','DESC')
      ->get();

      return view('admin/tracking', ['logos'=> $logos,'trackings'=> $trackings, 'transactions'=> $transactions]);
    }
    public function admin_tracking_edit(Request $request)
    {
      $logos = Logo::all();
      //update Tracking
      $trackings = Tracking::find($request->inputIdTracking);
      $trackings->transaction_id = $request->inputIdTransaction;
      $trackings->longitude = $request->inputLongitude;
      $trackings->latitude = $request->inputLatitude;
      $trackings->description = $request->inputDesc;
      $trackings->date = $request->inputDate3;
      $trackings->updated_at = date('Y-m-d H:i:s');
      $trackings->save();

      $trackings = Tracking::select('tracking.*','transaction.trans_no','transaction.resi_no','transaction.customer_id','customer.code_customer','customer.name_customer')
      ->leftjoin('transaction','transaction.id','=','transaction_id')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->orderby('tracking.date','DESC')
      ->get();

      $transactions = Transaction::select('transaction.id','transaction.trans_no','transaction.loading_date','transaction.resi_no','customer.name_customer')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->orderby('customer.name_customer','ASC')
      ->orderby('transaction.id','DESC')
      ->get();

      return view('admin/tracking', ['logos'=> $logos,'trackings'=> $trackings, 'transactions'=> $transactions]);
    }
    //Direct to Proses Delete Tracking
    public function admin_tracking_destroy(Request $request)
    {
      $logos = Logo::all();
      $trackings = Tracking::find($request->inputIdTracking);
      $trackings->delete();

      $trackings = Tracking::select('tracking.*','transaction.trans_no','transaction.customer_id','customer.code_customer','customer.name_customer')
      ->leftjoin('transaction','transaction.id','=','transaction_id')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->orderby('tracking.date','DESC')
      ->get();

      $transactions = Transaction::select('transaction.id','transaction.trans_no','transaction.loading_date','customer.name_customer')
      ->leftjoin('customer','customer.id','=','transaction.customer_id')
      ->orderby('customer.name_customer','ASC')
      ->orderby('transaction.id','DESC')
      ->get();

      return view('admin/tracking', ['logos'=> $logos,'trackings'=> $trackings, 'transactions'=> $transactions]);
    }
}
