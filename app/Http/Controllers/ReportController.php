<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Nasabah;
use App\Logo;
use App\Exports\ReportnasabahExport;
use App\Exports\ReportnasabahamplopExport;

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

class ReportController extends Controller
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

    public function bo_cs_rp_nasabah()
    {
      $logos = Logo::all();
      $nasabahs = Nasabah::select('nasabah.*','jenis_kota.Deskripsi_Kota')
      ->leftJoin('jenis_kota', function($join) {
        $join->on('nasabah.kota_id', '=', 'jenis_kota.Kota_id');
      })
      ->limit(20)->orderby('nasabah.nasabah_id','ASC')->get();

      return view('reports/frmsearchnasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs,'filter'=> '','msgstatus'=> '']);
    }
    public function bo_cs_rp_nasabah_cari(Request $request)
    {
      $logos = Logo::all();

      $nasabahs = Nasabah::select('nasabah.*','jenis_kota.Deskripsi_Kota')
      ->leftJoin('jenis_kota', function($join) {
        $join->on('nasabah.kota_id', '=', 'jenis_kota.Kota_id');
      })
      ->where('nasabah_id', 'LIKE', '%' . request()->idnasabah1 . '%')
      ->when(request()->namanasabah1, function($query) {
        $query->where('nama_nasabah', 'LIKE', '%' . request()->namanasabah1 . '%');
      })
      ->when(request()->jenisnasabah1, function($query) {
        $query->where('jenis_nasabah', request()->jenisnasabah1);
      })
      ->orderby('nasabah.nasabah_id','ASC')->get();

      $filters = request()->idnasabah1.'|'.request()->namanasabah1.'|'.request()->jenisnasabah1;

      return view('reports/frmsearchnasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs,'filter'=> $filters,'msgstatus'=> '']);
    }

    public function bo_cs_rp_nasabah_rp(Request $request)
    {
      $filteridnasabah = request()->exportidnasabah;
      $filternamanasabah = request()->exportnamanasabah;
      $filterjenisnasabah = request()->exportjenisnasabah;
      $sql="SELECT
        a.nasabah_id,
        a.nama_nasabah,
        a.alamat,
        a.telpon,
        a.tgllahir,
        b.Deskripsi_Kota
        FROM nasabah a LEFT JOIN jenis_kota b ON a.kota_id = b.Kota_id
        WHERE a.nasabah_id LIKE '%$filteridnasabah%' 
        AND a.nama_nasabah LIKE '%$filternamanasabah%'
        AND a.jenis_nasabah LIKE '%$filterjenisnasabah%'
        ";
      $nasabah=DB::select($sql);
      return (new ReportnasabahExport($nasabah))->download('nasabah.xlsx');
    }

    public function bo_cs_rp_nasabah_rppdf(Request $request)
    {
        $filteridnasabah = request()->printidnasabah;
        $filternamanasabah = request()->printnamanasabah;
        $filterjenisnasabah = request()->printjenisnasabah;
        $sql="SELECT
        a.nasabah_id,
        a.nama_nasabah,
        a.alamat,
        a.telpon,
        a.tgllahir,
        b.Deskripsi_Kota
        FROM nasabah a LEFT JOIN jenis_kota b ON a.kota_id = b.Kota_id
        WHERE a.nasabah_id LIKE '%$filteridnasabah%' 
        AND a.nama_nasabah LIKE '%$filternamanasabah%'
        AND a.jenis_nasabah LIKE '%$filterjenisnasabah%'
        ";
        $nasabah=DB::select($sql);
        // dd($nasabah);
        return view('pdf.cetaknasabah',['nasabah'=>$nasabah]);         
    }

    public function bo_cs_rp_nasabah_rp_amplop(Request $request)
    {
        $filteridnasabah = request()->inputIdNasabahprint;
        $sql="SELECT
        a.nasabah_id,
        a.nama_nasabah,
        a.alamat,
        a.kelurahan,
        a.kecamatan,
        a.kode_pos,
        b.Deskripsi_Kota
        FROM nasabah a LEFT JOIN jenis_kota b ON a.kota_id = b.Kota_id
        WHERE a.nasabah_id = '$filteridnasabah' 
        ";
        $nasabah=DB::select($sql);
        // dd($nasabah);
        return view('pdf.cetaknasabahamplop',['nasabah'=>$nasabah]);         
    }
    
}