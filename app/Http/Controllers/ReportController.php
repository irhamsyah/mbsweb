<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Nasabah;
use App\Tabungan;
use App\Logo;
use App\Kodetranstabungan;
use App\KodeJurnal;
use App\Perkiraan;
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

    //Nasabah
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

    //Tabungan
    public function bo_cs_rp_tabungan()
    {
      $logos = Logo::all();
      $tabungans = Tabungan::select('tabung.NO_REKENING','tabung.SALDO_AKHIR','tabung.JENIS_TABUNGAN','nasabah.nasabah_id','nasabah.nama_nasabah','nasabah.alamat',
      'nasabah.kelurahan','nasabah.kecamatan','nasabah.kode_pos','jenis_kota.Deskripsi_Kota')
      ->leftJoin('nasabah', function($join1) {
        $join1->on('tabung.NASABAH_ID', '=', 'nasabah.nasabah_id');
      })
      ->leftJoin('jenis_kota', function($join2) {
        $join2->on('nasabah.kota_id', '=', 'jenis_kota.Kota_id');
      })
      ->limit(20)->orderby('nasabah.nama_nasabah','ASC')->get();

      return view('reports/frmsearchtabungan', ['logos'=> $logos,'tabungans'=> $tabungans,'filter'=> '','msgstatus'=> '']);
    }
    public function bo_cs_rp_tabungan_cari(Request $request)
    {
      $logos = Logo::all();

      $tabungans = Tabungan::select('tabung.NO_REKENING','tabung.SALDO_AKHIR','tabung.JENIS_TABUNGAN','nasabah.nasabah_id','nasabah.nama_nasabah','nasabah.alamat',
      'nasabah.kelurahan','nasabah.kecamatan','nasabah.kode_pos','jenis_kota.Deskripsi_Kota')
      ->leftJoin('nasabah', function($join1) {
        $join1->on('tabung.NASABAH_ID', '=', 'nasabah.nasabah_id');
      })
      ->leftJoin('jenis_kota', function($join2) {
        $join2->on('nasabah.kota_id', '=', 'jenis_kota.Kota_id');
      })
      ->where('tabung.NASABAH_ID', 'LIKE', '%' . request()->idnasabah1 . '%')
      ->when(request()->namanasabah1, function($query) {
        $query->where('nasabah.nama_nasabah', 'LIKE', '%' . request()->namanasabah1 . '%');
      })
      ->when(request()->norekening1, function($query) {
        $query->where('tabung.NO_REKENING', request()->norekening1);
      })
      ->orderby('nasabah.nama_nasabah','ASC')->get();

      $filters = request()->idnasabah1.'|'.request()->namanasabah1.'|'.request()->norekening1;

      return view('reports/frmsearchtabungan', ['logos'=> $logos,'tabungans'=> $tabungans,'filter'=> $filters,'msgstatus'=> '']);
    }
    public function bo_cs_rp_tabungan_rp_covertab(Request $request)
    {
        $filteridnasabah = request()->inputIdNasabahprint;
        $filternorektab = request()->inputNoRekprint;
        $sql="SELECT
        a.nasabah_id,
        a.nama_nasabah,
        a.alamat,
        a.kelurahan,
        a.kecamatan,
        a.kode_pos,
        b.Deskripsi_Kota,
        c.NO_REKENING
        FROM nasabah a LEFT JOIN jenis_kota b ON a.kota_id = b.Kota_id
        LEFT JOIN tabung c ON a.nasabah_id = c.NASABAH_ID
        WHERE a.nasabah_id = '$filteridnasabah' AND c.NO_REKENING = '$filternorektab'
        ";
        $nasabah=DB::select($sql);
        // dd($nasabah);
        return view('pdf.cetakcovertab',['nasabah'=>$nasabah]);         
    }
    public function bo_cs_rp_tabungan_buktisetor(Request $request)
    {
      $logos = Logo::all();
        $filteridnasabah = request()->inputIdNasabahprint;
        $filternorektab = request()->inputNoRekprint;
        $sql="SELECT
        a.nasabah_id,
        a.nama_nasabah,
        a.alamat,
        a.kelurahan,
        a.kecamatan,
        a.kode_pos,
        b.Deskripsi_Kota,
        c.NO_REKENING,
        c.SALDO_AKHIR
        FROM nasabah a LEFT JOIN jenis_kota b ON a.kota_id = b.Kota_id LEFT JOIN tabung c ON a.nasabah_id=c.NASABAH_ID
        WHERE a.nasabah_id = '$filteridnasabah' AND c.NO_REKENING = '$filternorektab'
        ";
        $nasabah=DB::select($sql);
        $kodetranstab = KodeTransTabungan::all();
        // dd($nasabah);
        return view('reports/frmsearchtabunganbuktisetor',['logos'=> $logos,'nasabah'=>$nasabah,'kodetranstab'=> $kodetranstab,'msgstatus'=> '']);         
    }
    public function bo_cs_rp_tabungan_rp_buktisetortab(Request $request)
    {
        $tanggal = request()->tanggal;
        $norek = request()->norek;
        $namanasabah = request()->namanasabah;
        $alamat = request()->alamat;
        $kwitansi = request()->kwitansi;
        $jumlah = request()->jumlah;
        $debetkredit = request()->debetkredit;
        $tunaiovb = request()->tunaiovb;
        $keterangan = request()->keterangan;
        $kodetranstab = request()->kodetranstab;
        $kota = request()->kota;
        return view('pdf.cetakbuktisetortab',['tanggal'=>$tanggal,'norek'=>$norek,'namanasabah'=>$namanasabah,'kwitansi'=>$kwitansi,
        'jumlah'=>$jumlah,'debetkredit'=>$debetkredit,'tunaiovb'=>$tunaiovb,'keterangan'=>$keterangan,'kodetranstab'=>$kodetranstab,
        'kota'=>$kota]);         
    }

    //Umum
    public function bo_cs_rp_umum()
    {
      $logos = Logo::all();
      $kodejurnals = KodeJurnal::all();
      $perkiraans = Perkiraan::all();
      
      $nasabahs = Nasabah::select('nasabah.*','jenis_kota.Deskripsi_Kota')
      ->leftJoin('jenis_kota', function($join) {
        $join->on('nasabah.kota_id', '=', 'jenis_kota.Kota_id');
      })
      ->orderby('nasabah.nama_nasabah','ASC')->get();

      // dd($kodejurnals);
      return view('reports/frmsearchumum', ['logos'=> $logos,'nasabahs'=> $nasabahs,'kodejurnals'=> $kodejurnals,'perkiraans'=> $perkiraans,'filter'=> '','msgstatus'=> '']);
    }
    public function bo_cs_rp_umum_rp_umum(Request $request)
    {
        $tanggal = request()->tanggal;
        $kodejurnal = request()->kodejurnal;
        $atasnama = request()->atasnama;
        $keteranganumum = request()->keteranganumum;
        $glbalance1 = request()->glbalance1;
        $glbalance2 = request()->glbalance2;
        $uraian = request()->uraian;
        $jumlah = request()->jumlah;
        $typedokumen = request()->typedokumen;
        $nasabah = request()->nasabah;
        
        return view('pdf.cetakdokumenumum',['tanggal'=>$tanggal,'kodejurnal'=>$kodejurnal,'atasnama'=>$atasnama,'keteranganumum'=>$keteranganumum,
        'glbalance1'=>$glbalance1,'glbalance2'=>$glbalance2,'uraian'=>$uraian,'jumlah'=>$jumlah,'nasabah'=>$nasabah,
        'typedokumen'=>$typedokumen]);
    }
}