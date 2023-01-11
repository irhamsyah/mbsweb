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

class LocationController extends Controller
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
    public function admin_location()
    {
      $logos = Logo::all();
      $locations = Location::all();

      return view('admin/location', ['logos'=> $logos,'locations'=> $locations]);
    }
    public function admin_location_add(Request $request)
    {
      $logos = Logo::all();
      $locations = new Location;
      $locations->code_city = $request->inputCityCode;
      $locations->name_city = $request->inputCityName;
      $locations->province_city = $request->inputProvince;
      $locations->status_loading = $request->inputStatusLoading;
      $locations->status_pelayaran = $request->inputStatusPelayaran;
      $locations->created_at = date('Y-m-d H:i:s');
      $locations->save();

      $locations = Location::all();

      return view('admin/location', ['logos'=> $logos,'locations'=> $locations]);
    }
    public function admin_location_edit(Request $request)
    {
      $logos = Logo::all();
      //update location
      $locations = Location::find($request->inputIdLocation);
      $locations->code_city = $request->inputCityCode;
      $locations->name_city = $request->inputCityName;
      $locations->province_city = $request->inputProvince;
      $locations->status_loading = $request->inputStatusLoading;
      $locations->status_pelayaran = $request->inputStatusPelayaran;
      $locations->created_at = date('Y-m-d H:i:s');
      $locations->save();

      $locations = Location::all();

      return view('admin/location', ['logos'=> $logos,'locations'=> $locations]);
    }
    //Direct to Proses Delete location
    public function admin_location_destroy(Request $request)
    {
      $logos = Logo::all();
      $locations = Location::find($request->inputIdLocation);
      $locations->delete();

      $locations = Location::all();

      return view('admin/location', ['logos'=> $logos,'locations'=> $locations]);
    }
}
