<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Users;
use App\Consignee;
use App\Location;
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

class ConsigneeController extends Controller
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
    public function admin_consignee()
    {
      $logos = Logo::all();
      $consignees = Consignee::select('consignee.*','location.name_city','location.province_city')->leftjoin('location','location.id','=','consignee.id_city')->get();
      $locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();

      return view('admin/consignee', ['logos'=> $logos,'consignees'=> $consignees,'locations'=> $locations]);
    }
    public function admin_consignee_add(Request $request)
    {
      $logos = Logo::all();
      $consignees = new Consignee;
      $consignees->code_consignee = $request->inputConsigneeCode;
      $consignees->name_consignee = $request->inputConsigneeName;
      $consignees->address_invoice = $request->inputAddressInvoice;
      $consignees->address = $request->inputAddress;
      $consignees->id_city = $request->inputIdCity;
      $consignees->postal = $request->inputPostal;
      $consignees->telp = $request->inputTelp;
      $consignees->fax = $request->inputFax;
      $consignees->npwp = $request->inputNPWP;
      $consignees->pkp_no = $request->inputPkp;
      $consignees->desc_consignee = $request->inputConsigneeDesc;
      $consignees->payment_term = $request->inputTOP;
      $consignees->name_person = $request->inputPersonName;
      $consignees->phone_person = $request->inputPersonEmail;
      $consignees->email_person = $request->inputPersonPhone;
      $consignees->fax_person = $request->inputPersonFax;
      $consignees->created_at = date('Y-m-d H:i:s');
      $consignees->save();

      $consignees = Consignee::select('consignee.*','location.name_city','location.province_city')->leftjoin('location','location.id','=','consignee.id_city')->get();;
      $locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();

      return view('admin/consignee', ['logos'=> $logos,'consignees'=> $consignees,'locations'=> $locations]);
    }
    public function admin_consignee_edit(Request $request)
    {
      $logos = Logo::all();
      //update Consignee
      $consignees = Consignee::find($request->inputIdConsignee);
      $consignees->code_consignee = $request->inputConsigneeCode;
      $consignees->name_consignee = $request->inputConsigneeName;
      $consignees->address_invoice = $request->inputAddressInvoice;
      $consignees->address = $request->inputAddress;
      $consignees->id_city = $request->inputIdCity;
      $consignees->postal = $request->inputPostal;
      $consignees->telp = $request->inputTelp;
      $consignees->fax = $request->inputFax;
      $consignees->npwp = $request->inputNPWP;
      $consignees->pkp_no = $request->inputPkp;
      $consignees->desc_consignee = $request->inputConsigneeDesc;
      $consignees->payment_term = $request->inputTOP;
      $consignees->name_person = $request->inputPersonName;
      $consignees->phone_person = $request->inputPersonEmail;
      $consignees->email_person = $request->inputPersonPhone;
      $consignees->fax_person = $request->inputPersonFax;
      $consignees->created_at = date('Y-m-d H:i:s');
      $consignees->save();

      $consignees = Consignee::select('consignee.*','location.name_city','location.province_city')->leftjoin('location','location.id','=','consignee.id_city')->get();;
      $locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();

      return view('admin/consignee', ['logos'=> $logos,'consignees'=> $consignees,'locations'=> $locations]);
    }
    //Direct to Proses DeleteConsignee
    public function admin_consignee_destroy(Request $request)
    {
      $logos = Logo::all();
      $consignees = Consignee::find($request->inputIdConsignee);
      $consignees->delete();

      $consignees = Consignee::select('consignee.*','location.name_city','location.province_city')->leftjoin('location','location.id','=','consignee.id_city')->get();;
      $locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();

      return view('admin/consignee', ['logos'=> $logos,'consignees'=> $consignees,'locations'=> $locations]);
    }
}
