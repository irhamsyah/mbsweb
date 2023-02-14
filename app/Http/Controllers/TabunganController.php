<?php

namespace App\Http\Controllers;
// use illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use App\Golonganpihaklawan;
use App\KodeGroup1Nasabah;
use App\KodeGroup1Tabung;
use App\KodeGroup2Tabung;
use App\KodeGroup3Tabung;
use App\Kodejenistabungan;
use App\Kodeketerkaitanlapbul;
use App\Kodemetoda;
use App\Kodecabang;
use Illuminate\Http\Request;
use App\Tabungan;
use App\Logo;
use App\Mysysid;
use App\Nasabah;
use App\User;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Tests;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function bo_cs_de_tabungan()
    {
        $logos = Logo::all();
        $tabArray=[];
        $tabungan=DB::table('tabung')
                    ->join('nasabah', 'tabung.nasabah_id','=','nasabah.nasabah_id')
                    ->select('tabung.no_rekening','tabung.jenis_tabungan','nasabah.nama_nasabah','nasabah.alamat','tabung.saldo_akhir','tabung.status_aktif')->orderBy('tabung.no_rekening')->limit(100)->get();
        $users = User::all();
        $kodecabang=Kodecabang::where('data_cab','=','mydata')->get();
        $kodegrou1tabungan = KodeGroup1Tabung::all();
        $kodegrou2tabungan = KodeGroup2Tabung::all();
        $kodegrou3tabungan = KodeGroup3Tabung::all();
        $kodejenistabungan = Kodejenistabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodeketerkaitanlapbul = Kodeketerkaitanlapbul::all();
        $kodemetoda = Kodemetoda::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

  
        return view('admin.tabungan', ['logos'=> $logos,'tabungan'=> $tabungan,'kodegrou1tabungan'=> $kodegrou1tabungan,'kodegrou2tabungan'=> $kodegrou2tabungan,
        'kodegrou3tabungan'=> $kodegrou3tabungan,'kodejenistabungan'=> $kodejenistabungan,'golonganpihaklawan'=> $golonganpihaklawan,'kodeketerkaitanlapbul'=> $kodeketerkaitanlapbul,'kodemetoda'=> $kodemetoda,'kodecabang'=>$kodecabang,'tgllogin'=>$tgllogin]);
    
        // return view('tabungan1',['tabungan'=>$tabungan]);
    }

}
