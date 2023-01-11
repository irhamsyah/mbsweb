<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Users;
use App\BankAccount;
use App\Customer;
use App\Location;
use App\Entity;
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

class CustomerController extends Controller
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
    public function admin_customer()
    {
      $logos = Logo::all();
      $customers = Customer::select('customer.*','entity.entity_name')
      ->leftjoin('entity','entity.id','=','customer.entity_id')
      ->get();
      //dd($customers);
      //$locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();
      $entitys = Entity::all();

      return view('admin/customer', ['logos'=> $logos,'customers'=> $customers, 'entitys'=> $entitys]);
    }
    public function admin_customer_add(Request $request)
    {
      $logos = Logo::all();
      if($request->inputPassword==$request->inputConfPassword)
      {
        //enkripsi md5 password
        $password=md5($request->inputPassword);

        $customers = new Customer;
        $customers->code_customer = $request->inputCostumerCode;
        $customers->name_customer = $request->inputCostumerName;
        $customers->address_invoice = $request->inputAddressInvoice;
        $customers->address = $request->inputAddress;
        $customers->city = $request->inputCity;
        $customers->province = $request->inputProvince;
        $customers->postal = $request->inputPostal;
        $customers->telp = $request->inputTelp;
        $customers->fax = $request->inputFax;
        $customers->npwp = $request->inputNPWP;
        $customers->pkp_no = $request->inputPkp;
        $customers->desc_customer = $request->inputCustomerDesc;
        $customers->payment_term = $request->inputTOP;
        $customers->name_person = $request->inputPersonName;
        $customers->phone_person = $request->inputPersonPhone;
        $customers->email = $request->inputPersonEmail;
        $customers->fax_person = $request->inputPersonFax;
        $customers->username = $request->inputUsername;
        $customers->password = $password;
        $customers->entity_id = $request->inputEntity;
        $customers->created_at = date('Y-m-d H:i:s');
        $customers->save();
      }

      $customers = Customer::select('customer.*','entity.entity_name')
      ->leftjoin('entity','entity.id','=','customer.entity_id')
      ->get();
      //dd($customers);
      //$locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();
      $entitys = Entity::all();

      return view('admin/customer', ['logos'=> $logos,'customers'=> $customers, 'entitys'=> $entitys]);
    }
    public function admin_customer_edit(Request $request)
    {
      $logos = Logo::all();
      if($request->inputPassword==$request->inputConfPassword)
      {
        if($request->inputPassword != null){
          //enkripsi md5 password
          $password=md5($request->inputPassword);
        }else{
          $password=$request->inputPasswordOld;
        }

        //update Customer
        $customers = Customer::find($request->inputIdCustomer);
        $customers->code_customer = $request->inputCostumerCode;
        $customers->name_customer = $request->inputCostumerName;
        $customers->address_invoice = $request->inputAddressInvoice;
        $customers->address = $request->inputAddress;
        $customers->city = $request->inputCity;
        $customers->province = $request->inputProvince;
        $customers->postal = $request->inputPostal;
        $customers->telp = $request->inputTelp;
        $customers->fax = $request->inputFax;
        $customers->npwp = $request->inputNPWP;
        $customers->pkp_no = $request->inputPkp;
        $customers->desc_customer = $request->inputCustomerDesc;
        $customers->payment_term = $request->inputTOP;
        $customers->name_person = $request->inputPersonName;
        $customers->phone_person = $request->inputPersonPhone;
        $customers->email = $request->inputPersonEmail;
        $customers->fax_person = $request->inputPersonFax;
        $customers->username = $request->inputUsername;
        $customers->password = $password;
        $customers->entity_id = $request->inputEntity;
        $customers->status = $request->inputStatus;
        $customers->updated_at = date('Y-m-d H:i:s');
        $customers->save();
      }

      $customers = Customer::select('customer.*','entity.entity_name')
      ->leftjoin('entity','entity.id','=','customer.entity_id')
      ->get();
      //dd($customers);
      //$locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();
      $entitys = Entity::all();

      return view('admin/customer', ['logos'=> $logos,'customers'=> $customers, 'entitys'=> $entitys]);
    }
    //Direct to Proses DeleteCustomer
    public function admin_customer_destroy(Request $request)
    {
      $logos = Logo::all();
      $customers = Customer::find($request->inputIdCustomer);
      $customers->delete();

      $customers = Customer::select('customer.*','entity.entity_name')
      ->leftjoin('entity','entity.id','=','customer.entity_id')
      ->get();
      //dd($customers);
      //$locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();
      $entitys = Entity::all();

      return view('admin/customer', ['logos'=> $logos,'customers'=> $customers, 'entitys'=> $entitys]);
    }
}
