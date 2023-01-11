<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Users;
use App\Agent;
use App\BankAccount;
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

class AgentController extends Controller
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
    public function admin_agent()
    {
      $logos = Logo::all();
      $agents = Agent::select('agent.*','location.name_city','location.province_city')->leftjoin('location','location.id','=','agent.id_city')->get();
      $locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();

      return view('admin/agent', ['logos'=> $logos,'agents'=> $agents,'locations'=> $locations]);
    }
    public function admin_agent_add(Request $request)
    {
      $logos = Logo::all();
      $agents = new Agent;
      $agents->code_agent = $request->inputAgentCode;
      $agents->name_agent = $request->inputAgentName;
      $agents->address = $request->inputAddress;
      $agents->id_city = $request->inputIdCity;
      $agents->postal = $request->inputPostal;
      $agents->telp = $request->inputTelp;
      $agents->fax = $request->inputFax;
      $agents->npwp = $request->inputNPWP;
      $agents->pkp_no = $request->inputPkp;
      $agents->desc_agent = $request->inputAgentDesc;
      $agents->payment_term = $request->inputTOP;
      $agents->name_person = $request->inputPersonName;
      $agents->phone_person = $request->inputPersonEmail;
      $agents->email_person = $request->inputPersonPhone;
      $agents->fax_person = $request->inputPersonFax;
      $agents->created_at = date('Y-m-d H:i:s');
      $agents->save();

      $agents = Agent::select('agent.*','location.name_city','location.province_city')->leftjoin('location','location.id','=','agent.id_city')->get();
      $locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();

      return view('admin/agent', ['logos'=> $logos,'agents'=> $agents,'locations'=> $locations]);
    }
    public function admin_agent_edit(Request $request)
    {
      $logos = Logo::all();
      //update Agent
      $agents = Agent::find($request->inputIdAgent);
      $agents->code_agent = $request->inputAgentCode;
      $agents->name_agent = $request->inputAgentName;
      $agents->address = $request->inputAddress;
      $agents->id_city = $request->inputIdCity;
      $agents->postal = $request->inputPostal;
      $agents->telp = $request->inputTelp;
      $agents->fax = $request->inputFax;
      $agents->npwp = $request->inputNPWP;
      $agents->pkp_no = $request->inputPkp;
      $agents->desc_agent = $request->inputAgentDesc;
      $agents->payment_term = $request->inputTOP;
      $agents->name_person = $request->inputPersonName;
      $agents->phone_person = $request->inputPersonEmail;
      $agents->email_person = $request->inputPersonPhone;
      $agents->fax_person = $request->inputPersonFax;
      $agents->updated_at = date('Y-m-d H:i:s');
      $agents->save();

      $agents = Agent::select('agent.*','location.name_city','location.province_city')->leftjoin('location','location.id','=','agent.id_city')->get();
      $locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();

      return view('admin/agent', ['logos'=> $logos,'agents'=> $agents,'locations'=> $locations]);
    }
    //Direct to Proses DeleteAgent
    public function admin_agent_destroy(Request $request)
    {
      $logos = Logo::all();
      $agents = Agent::find($request->inputIdAgent);
      $agents->delete();

      $agents = Agent::select('agent.*','location.name_city','location.province_city')->leftjoin('location','location.id','=','agent.id_city')->get();
      $locations = Location::select('location.id as loc_id','location.code_city','location.name_city','location.province_city')->orderby('location.name_city')->get();

      return view('admin/agent', ['logos'=> $logos,'agents'=> $agents,'locations'=> $locations]);
    }

    public function admin_bank_account()
    {
      $logos = Logo::all();
      $banks = BankAccount::select('bank_account.*','agent.code_agent','agent.name_agent')->leftjoin('agent','agent.id','=','bank_account.agent_id')->get();
      $agents = Agent::select('agent.id','agent.name_agent','agent.code_agent')->get();

      return view('admin/bank_account', ['logos'=> $logos,'banks'=> $banks,'agents'=> $agents]);
    }
    public function admin_bank_account_add(Request $request)
    {
      $logos = Logo::all();
      $banks = new BankAccount;
      $banks->bank_name = $request->inputBankName;
      $banks->bank_account = $request->inputBankAccount;
      $banks->branch = $request->inputBranch;
      $banks->account_name = $request->inputAccountName;
      $banks->bank_address = $request->inputBankAddress;
      $banks->agent_id = $request->inputIdAgent;
      $banks->created_at = date('Y-m-d H:i:s');
      $banks->save();

      $banks = BankAccount::select('bank_account.*','agent.code_agent','agent.name_agent')->leftjoin('agent','agent.id','=','bank_account.agent_id')->get();
      $agents = Agent::select('agent.id','agent.name_agent','agent.code_agent')->get();

      return view('admin/bank_account', ['logos'=> $logos,'banks'=> $banks,'agents'=> $agents]);
    }
    public function admin_bank_account_edit(Request $request)
    {
      $logos = Logo::all();
      //update Bank Account
      $banks = BankAccount::find($request->inputIdBankAccount);
      $banks->bank_name = $request->inputBankName;
      $banks->bank_account = $request->inputBankAccount;
      $banks->branch = $request->inputBranch;
      $banks->account_name = $request->inputAccountName;
      $banks->bank_address = $request->inputBankAddress;
      $banks->agent_id = $request->inputIdAgent;
      $banks->created_at = date('Y-m-d H:i:s');
      $banks->save();

      $banks = BankAccount::select('bank_account.*','agent.code_agent','agent.name_agent')->leftjoin('agent','agent.id','=','bank_account.agent_id')->get();
      $agents = Agent::select('agent.id','agent.name_agent','agent.code_agent')->get();

      return view('admin/bank_account', ['logos'=> $logos,'banks'=> $banks,'agents'=> $agents]);
    }
    //Direct to Proses DeleteBankAccount
    public function admin_bank_account_destroy(Request $request)
    {
      $logos = Logo::all();
      $banks = BankAccount::find($request->inputIdBankAccount);
      $banks->delete();

      $banks = BankAccount::select('bank_account.*','agent.code_agent','agent.name_agent')->leftjoin('agent','agent.id','=','bank_account.agent_id')->get();
      $agents = Agent::select('agent.id','agent.name_agent','agent.code_agent')->get();

      return view('admin/bank_account', ['logos'=> $logos,'banks'=> $banks,'agents'=> $agents]);
    }
}
