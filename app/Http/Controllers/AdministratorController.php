<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Nasabah;
use App\Identitas;
use App\KodeGroup1Nasabah;
use App\Perkawinan;
use App\Negara;
use App\Kota;
use App\Gelar;
use App\Pekerjaan;
use App\HubunganDebitur;
use App\HubunganBank;
use App\GolonganDebitur;
use App\BidangUsaha;
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

class AdministratorController extends Controller
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

    public function bo_cs_ad_agama()
    {
      $logos = Logo::all();
      $users = User::all();
      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $lastagamaid = KodeGroup1Nasabah::max('NASABAH_GROUP1');

      return view('admin/agama', ['logos'=> $logos,'users'=> $users,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'lastagamaid'=> $lastagamaid,'msgstatus'=> '']);
    }

    public function bo_cs_ad_agama_add(Request $request)
    {
      $logos = Logo::all();
      $users = User::all();
      
      $kodegroup1nasabahs = new KodeGroup1Nasabah;
      $kodegroup1nasabahs->NASABAH_GROUP1 = trim($request->inputidagamaedit);
      $kodegroup1nasabahs->DESKRIPSI_GROUP1 = $request->inputdescagamaedit;
      $kodegroup1nasabahs->save();

      if ($kodegroup1nasabahs){
        $msg='1';
      }else{
        $msg='0';
      }

      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $lastagamaid = KodeGroup1Nasabah::max('NASABAH_GROUP1');

      return view('admin/agama', ['logos'=> $logos,'users'=> $users,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'lastagamaid'=> $lastagamaid,'msgstatus'=> $msg]);
    }

    
    public function bo_cs_ad_agama_edit(Request $request)
    {
      $logos = Logo::all();
      $users = User::all();
      if(md5($request->inputidagamaedit.'Bast90') == $request->inputIdagamaedithash){
        
        //update Agama
        $kodegroup1nasabahs = KodeGroup1Nasabah::where("NASABAH_GROUP1", $request->inputidagamaedit)->update(["DESKRIPSI_GROUP1" => $request->inputdescagamaedit]);
        if ($kodegroup1nasabahs){
          $msg='1';
        }else{
          $msg='0';
        }
      }else{
        $msg='0';
      }

      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $lastagamaid = KodeGroup1Nasabah::max('NASABAH_GROUP1');

      return view('admin/agama', ['logos'=> $logos,'users'=> $users,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'lastagamaid'=> $lastagamaid,'msgstatus'=> $msg]);
    }

    //Direct to Proses Delete Agama
    public function bo_cs_ad_agama_destroy(Request $request)
    {
      if(md5($request->inputIdagamadel.'Bast90') == $request->inputIdagamadelhash){
        $proses_delete = KodeGroup1Nasabah::where('NASABAH_GROUP1',$request->inputIdagamadel)->delete();
        if ($proses_delete){
          $msg='1';
        }else{
          $msg='0';
        }
      }else{
        $msg='0';
      }
      $logos = Logo::all();
      $users = User::all();
      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $lastagamaid = KodeGroup1Nasabah::max('NASABAH_GROUP1');

      return view('admin/agama', ['logos'=> $logos,'users'=> $users,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'lastagamaid'=> $lastagamaid,'msgstatus'=> $msg]);
    }

    public function bo_cs_ad_golongan()
    {
        $logos = Logo::all();
        $users = User::all();
        $hubunganbanks = HubunganBank::all();
        $lastgolonganid = HubunganBank::max('KODE_HUBUNGAN');
  
        return view('admin/golongan', ['logos'=> $logos,'users'=> $users,'hubunganbanks'=> $hubunganbanks,
        'lastgolonganid'=> $lastgolonganid,'msgstatus'=> '']);
    }

    public function bo_cs_ad_golongan_add(Request $request)
    {
      $logos = Logo::all();
      $users = User::all();
      
      $hubunganbanks = new HubunganBank;
      $hubunganbanks->KODE_HUBUNGAN = trim($request->inputidgoledit);
      $hubunganbanks->DESKRIPSI_HUBUNGAN = $request->inputdescgoledit;
      $hubunganbanks->save();

      if ($hubunganbanks){
        $msg='1';
      }else{
        $msg='0';
      }

      $hubunganbanks = HubunganBank::all();
      $lastgolonganid = HubunganBank::max('KODE_HUBUNGAN');
  
      return view('admin/golongan', ['logos'=> $logos,'users'=> $users,'hubunganbanks'=> $hubunganbanks,
      'lastgolonganid'=> $lastgolonganid,'msgstatus'=> $msg]);
    }

    public function bo_cs_ad_golongan_edit(Request $request)
    {
      $logos = Logo::all();
      $users = User::all();
      if(md5($request->inputidgoledit.'Bast90') == $request->inputIdgoledithash){
        
        //update Golongan 
        $hubunganbanks = HubunganBank::where('KODE_HUBUNGAN', $request->inputidgoledit)->update(['DESKRIPSI_HUBUNGAN' => $request->inputdescgoledit]);
        if ($hubunganbanks){
          $msg='1';
        }else{
          $msg='0';
        }
      }else{
        $msg='0';
      }

      $hubunganbanks = HubunganBank::all();
      $lastgolonganid = HubunganBank::max('KODE_HUBUNGAN');
  
      return view('admin/golongan', ['logos'=> $logos,'users'=> $users,'hubunganbanks'=> $hubunganbanks,
      'lastgolonganid'=> $lastgolonganid,'msgstatus'=> $msg]);
    }

    //Direct to Proses Delete golongan
    public function bo_cs_ad_golongan_destroy(Request $request)
    {
      if(md5($request->inputIdgoldel.'Bast90') == $request->inputIdgoldelhash){
        $proses_delete = HubunganBank::where('KODE_HUBUNGAN',$request->inputIdgoldel)->delete();
        if ($proses_delete){
          $msg='1';
        }else{
          $msg='0';
        }
      }else{
        $msg='0';
      }
      $logos = Logo::all();
      $users = User::all();
      $hubunganbanks = HubunganBank::all();
      $lastgolonganid = HubunganBank::max('KODE_HUBUNGAN');
  
      return view('admin/golongan', ['logos'=> $logos,'users'=> $users,'hubunganbanks'=> $hubunganbanks,
      'lastgolonganid'=> $lastgolonganid,'msgstatus'=> $msg]);
    }
}
