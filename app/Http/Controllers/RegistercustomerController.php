<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailcustomerController;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Customer;
use App\Entity;
use App\Location;
date_default_timezone_set('Asia/Jakarta');


class RegistercustomerController extends Controller
{
    //
    // use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    /*********** Tambahan *****/
    public function contact_add(Request $request)
    {
        /*Proses Simpan*/
        $request->validate([
            'username' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            // 'email' => 'required|email|unique:customer',
            'password' => 'min:8|required_with:passwordconf|same:passwordconf',
            'passwordconf' => 'required|same:password'
        ]);

          //enkripsi md5 password
          $password=md5($request->password);

          //Get last code customer
          $lastcodecustomer=Customer::select('code_customer')
          ->orderBy('id','desc')->limit(1)->get();
          //generate code customer
          $pecah=substr($lastcodecustomer, 20, 4);
          $codecustomer = "R" . sprintf("%04s", $pecah+1);

          $user = new Customer;
          $user->code_customer = $codecustomer;
          $user->name_customer = $request->company;
          //$user->address_invoice = $request->npwpaddress;
          $user->address = $request->address;
          $user->id_city = 1;
          $user->city = $request->city;
          $user->province = $request->province;
          $user->postal = $request->postal;
          $user->telp = $request->phone;
          $user->fax = $request->fax;
          //$user->npwp = $request->npwp;
          $user->pkp_no = 0;
          $user->desc_customer = '';
          $user->payment_term = 0;
          $user->name_person = $request->company;
          $user->phone_person = $request->mphone;
          $user->email = $request->email;
          $user->fax_person = $request->fax;
          $user->username = $request->username;
          $user->password = $password;
          $user->verification_code = sha1(time());
          $user->entity_id = $request->entity;
          $user->created_at = date('Y-m-d H:i:s');
          $user->save();

        $entitys = Entity::all();
        //$locations = Location::all();



        // return view('page_contact', ['entitys'=> $entitys, 'locations'=> $locations]);
        /****/
        if($user != null){
            MailcustomerController::sendSignupEmail($user->name_customer, $user->email, $user->verification_code);
            return redirect()->back()->with(session()->flash('alert-success', 'Your account has been created. Please check email for verification link.'));
        }

        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong!'));
    }

    /*****************/


    public function verifyUser(Request $request)
    {
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = Customer::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->email_verified_at = date('d-m-Y H:i:s');
            $user->save();
            return redirect()->route('service.get')->with(session()->flash('alert-success', 'Your account is verified. Please login!'));
        }

        return redirect()->route('login')->with(session()->flash('alert-danger', 'Invalid verification code!'));
    }

}
