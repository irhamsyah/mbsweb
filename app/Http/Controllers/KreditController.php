<?php

namespace App\Http\Controllers;
use App\KodeGroup1Deposito;
use App\KodeGroup2Deposito;
use App\KodeGroup3Deposito;
use App\KodeJenisDeposito;
use App\Kodecabang;
use App\KodeTransDeposito;
use App\Deposito;
use App\Kodeketerkaitanlapbul;
use App\Kodemetoda;
use App\Golonganpihaklawan;
use App\Logo;
use App\Mysysid;
use App\Nasabah;
use App\User;
use App\Tabungan;
use App\Deptran;
use App\Tellertran;

use App\Kredit;

use App\Exports\ReporttabunganExport;
use App\Exports\ReporttabunganrekapExport;
use App\Exports\ReporttabunganexpressExport;
use App\Exports\ReporttabunganpasifExport;
use App\Exports\ReporttransaksitabunganExport;
use App\Exports\ReporttabunganblokirExport;
use App\Exports\ReportbungapajakExport;
use App\Exports\ReporttabunganperjenisExport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function bo_kr_de_kredit()
    {
        $logos = Logo::all();
        $users = User::all();
        $kredits = Kredit::select('nasabah.*','NO_REKENING','JENIS_PINJAMAN','POKOK_SALDO_REALISASI','POKOK_SALDO_AKHIR','DESKRIPSI_JENIS_KREDIT','kredit.NASABAH_ID')
        ->leftJoin('kodejeniskredit', function($join) {
        $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
        })
        ->leftJoin('nasabah', function($join) {
            $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
          })
        ->orderby('kredit.NO_REKENING','ASC')->get();
      if(!$kredits)
        abort('404');

    
    return view('admin/kredit', ['logos'=> $logos,'kredits'=> $kredits,'msgstatus'=> '']);}
    
}