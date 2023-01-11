<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Customer;
use App\Entity;
use App\Location;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    /**************************/
    protected function validatorbaru(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
            'securityquestion' => ['required', 'string', 'max:255'],
            'answersecurity' => ['required', 'string', 'max:255'],
        ]);
    }
    /**************************/
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1(time());
        $user->save();

        if($user != null){
            MailController::sendSignupEmail($user->name, $user->email, $user->verification_code);
            return redirect()->back()->with(session()->flash('alert-success', 'Your account has been created. Please check email for verification link.'));
        }

        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong!'));
    }

    /*********** Tambahan *****/
    public function contact_add(Request $request)
    {
        /*Proses Simpan*/
        // if($request->password==$request->passwordconf)
        // {
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
          $user->address_invoice = $request->npwpaddress;
          $user->address = $request->address;
          $user->id_city = $request->city;
          $user->postal = $request->postal;
          $user->telp = $request->phone;
          $user->fax = $request->fax;
          $user->npwp = $request->npwp;
          $user->pkp_no = 0;
          $user->desc_customer = '';
          $user->payment_term = 0;
          $user->name_person = $request->company;
          $user->phone_person = $request->mphone;
          $user->email_person = $request->email;
          $user->fax_person = $request->fax;
          $user->username = $request->username;
          $user->password = $password;
          $user->entity_id = $request->entity;
          $user->created_at = date('Y-m-d H:i:s');
          $user->verification_code = sha1(time());
          $user->save();
        // }
    
        $entitys = Entity::all();
        $locations = Location::all();
    
        // return view('page_contact', ['entitys'=> $entitys, 'locations'=> $locations]);
        /****/
        if($user != null){
            MailController::sendSignupEmail($user->name_customer, $user->email_person, $user->verification_code);
            return redirect()->back()->with(session()->flash('alert-success', 'Your account has been created. Please check email for verification link.'));
        }

        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong!'));
    }

    /*****************/


    public function verifyUser(Request $request){
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = Customer::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->save();
            return redirect()->route('login')->with(session()->flash('alert-success', 'Your account is verified. Please login!'));
        }

        return redirect()->route('login')->with(session()->flash('alert-danger', 'Invalid verification code!'));
    }


    /*****************************************/

    /******************************************/
    // public function signupuser(Request $request){
    //     dd($request);
    // }
}
