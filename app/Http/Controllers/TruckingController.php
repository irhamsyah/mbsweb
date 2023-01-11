<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Users;
use App\News;
use App\NewsCategory;
use App\NewsImage;
use App\Agent;
use App\BankAccount;
use App\Consignee;
use App\Customer;
use App\Location;
use App\Pelayaran;
use App\Tarif;
use App\TruckingType;
use App\VendorTruck;
use App\Testimoni;
use App\Slider;
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

class TruckingController extends Controller
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
    public function admin_trucking()
    {
      $logos = Logo::all();
      $truckings = TruckingType::all();
      return view('admin/trucking', ['logos'=> $logos,'truckings'=> $truckings]);
    }
    public function admin_trucking_add(Request $request)
    {
      $logos = Logo::all();
      $truckings = new TruckingType;
      $truckings->name_trucking = $request->inputTruckingName;
      $truckings->created_at = date('Y-m-d H:i:s');
      $truckings->save();

      $truckings = TruckingType::all();
      return view('admin/trucking', ['logos'=> $logos,'truckings'=> $truckings]);
    }
    public function admin_trucking_edit(Request $request)
    {
      $logos = Logo::all();
      //update Trucking
      $truckings = TruckingType::find($request->inputIdTrucking);
      $truckings->name_trucking = $request->inputTruckingName;
      $truckings->created_at = date('Y-m-d H:i:s');
      $truckings->save();

      $truckings = TruckingType::all();
      return view('admin/trucking', ['logos'=> $logos,'truckings'=> $truckings]);
    }
    //Direct to Proses DeleteTrucking
    public function admin_trucking_destroy(Request $request)
    {
      $logos = Logo::all();
      $truckings = TruckingType::find($request->inputIdTrucking);
      $truckings->delete();

      $truckings = TruckingType::all();
      return view('admin/trucking', ['logos'=> $logos,'truckings'=> $truckings]);
    }
    public function admin_vendor_truck()
    {
      $logos = Logo::all();
      $vendor_trucks = VendorTruck::select('vendor_truck.*','trucking_type.name_trucking')->leftjoin('trucking_type','trucking_type.id','=','vendor_truck.trucking_type_id')->get();
      $truckings = TruckingType::select('trucking_type.id as trucking_id','trucking_type.name_trucking')->orderby('trucking_type.name_trucking')->get();

      return view('admin/vendor_truck', ['logos'=> $logos,'vendor_trucks'=> $vendor_trucks,'truckings'=> $truckings]);
    }
    public function admin_vendor_truck_add(Request $request)
    {
      $logos = Logo::all();
      $vendor_trucks = new VendorTruck;
      $vendor_trucks->code_vendor = $request->inputVendorCode;
      $vendor_trucks->name_vendor = $request->inputVendorName;
      $vendor_trucks->address = $request->inputAddress;
      $vendor_trucks->telp = $request->inputTelp;
      $vendor_trucks->payment_term = $request->inputTOP;
      $vendor_trucks->trucking_type_id = $request->inputIdTruckingType;
      $vendor_trucks->created_at = date('Y-m-d H:i:s');
      $vendor_trucks->save();

      $vendor_trucks = VendorTruck::select('vendor_truck.*','trucking_type.name_trucking')->leftjoin('trucking_type','trucking_type.id','=','vendor_truck.trucking_type_id')->get();
      $truckings = TruckingType::select('trucking_type.id as trucking_id','trucking_type.name_trucking')->orderby('trucking_type.name_trucking')->get();

      return view('admin/vendor_truck', ['logos'=> $logos,'vendor_trucks'=> $vendor_trucks,'truckings'=> $truckings]);
    }
    public function admin_vendor_truck_edit(Request $request)
    {
      $logos = Logo::all();
      //update VendorTruck
      $vendor_trucks = VendorTruck::find($request->inputIdVendorTruck);
      $vendor_trucks->code_vendor = $request->inputVendorCode;
      $vendor_trucks->name_vendor = $request->inputVendorName;
      $vendor_trucks->address = $request->inputAddress;
      $vendor_trucks->telp = $request->inputTelp;
      $vendor_trucks->payment_term = $request->inputTOP;
      $vendor_trucks->trucking_type_id = $request->inputIdTruckingType;
      $vendor_trucks->created_at = date('Y-m-d H:i:s');
      $vendor_trucks->save();

      $vendor_trucks = VendorTruck::select('vendor_truck.*','trucking_type.name_trucking')->leftjoin('trucking_type','trucking_type.id','=','vendor_truck.trucking_type_id')->get();
      $truckings = TruckingType::select('trucking_type.id as trucking_id','trucking_type.name_trucking')->orderby('trucking_type.name_trucking')->get();

      return view('admin/vendor_truck', ['logos'=> $logos,'vendor_trucks'=> $vendor_trucks,'truckings'=> $truckings]);
    }
    //Direct to Proses Delete VendorTruck
    public function admin_vendor_truck_destroy(Request $request)
    {
      $logos = Logo::all();
      $vendor_trucks = VendorTruck::find($request->inputIdVendorTruck);
      $vendor_trucks->delete();

      $vendor_trucks = VendorTruck::select('vendor_truck.*','trucking_type.name_trucking')->leftjoin('trucking_type','trucking_type.id','=','vendor_truck.trucking_type_id')->get();
      $truckings = TruckingType::select('trucking_type.id as trucking_id','trucking_type.name_trucking')->orderby('trucking_type.name_trucking')->get();

      return view('admin/vendor_truck', ['logos'=> $logos,'vendor_trucks'=> $vendor_trucks,'truckings'=> $truckings]);
    }
}
