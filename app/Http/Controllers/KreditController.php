<?php

namespace App\Http\Controllers;
use App\Logo;
use App\User;
use App\Kredit;
use App\Kodejeniskredit;
use App\Nasabah;
use App\KodeGroup1Kredit;
use App\KodeGroup2Kredit;
use App\KodeGroup3Kredit;
use App\KodeSumberDanaKredit;
use App\KodeTypeKredit;
use App\KodeSatuanWaktuKredit;

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
        $kodegroup1kredit = KodeGroup1Kredit::all()->sort();
        $kodegroup2kredit = KodeGroup2Kredit::all()->sort();
        $kodegroup3kredit = KodeGroup3Kredit::all()->sort();
        $kodesumberdanakredit = KodeSumberDanaKredit::all()->sort();
        $kodetypekredit = KodeTypeKredit::all()->sort();
        $kodesatuanwaktuangsuran = KodeSatuanWaktuKredit::all()->sort();
        $nasabahs = Nasabah::select('nasabah_id','nama_nasabah','alamat')->get()->toArray();
        $kodejeniskredit=Kodejeniskredit::all();
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
      return view('admin/kredit', ['logos'=> $logos, '
      users'=> $users,'kredits'=> $kredits,'nasabahs'=> $nasabahs,
      'kodejeniskredit'=>$kodejeniskredit, 
      'kodegroup1kredit'=>$kodegroup1kredit, 
      'kodegroup2kredit'=>$kodegroup2kredit, 
      'kodegroup3kredit'=>$kodegroup3kredit,
      'kodesumberdanakredit'=>$kodesumberdanakredit, 
      'kodetypekredit'=>$kodetypekredit,
      'kodesatuanwaktuangsuran'=>$kodesatuanwaktuangsuran,
      'msgstatus'=> '']);
    }

    public function bo_kr_de_kredit_add(Request $request)
    {

      $newkredit = new Kredit();
      // data utama
      $newkredit->JENIS_PINJAMAN =  $request->input("inputjeniskredit");
      $newkredit->CAB =  $request->input("inputcabang");
      $newkredit->NO_REKENING = $request->input("inputnorekening");
      if($request->input("inputnorekening")==''){
        $newkredit->NO_PK_LAMA = $request->input("inputnopklama");
        $newkredit->TGL_PK_LAMA = $request->input("inputtglpklama");
        $newkredit->NO_PK_BARU = $request->input("inputnopkbaru");
      }
      // $newkredit->REVIEW_BUNGA = $request->input("inputreviewbunga");
      $newkredit->STATUS_AKTIF = $request->input("inputstatus");
      $newkredit->NASABAH_ID = $request->input("inputnasabahid");      
      $newkredit->KODE_GROUP1 = $request->input("inputkodegorup1");
      $newkredit->KODE_GROUP2 = $request->input("inputkodegorup2");
      $newkredit->KODE_GROUP3 = $request->input("inputkodegorup3");
      $newkredit->KODE_SUMBER_DANA = $request->input("inputsumberdana");
      // data angsuran
      $newkredit->TYPE_PINJAMAN = $request->input("inputtipepinjaman");
      $newkredit->TGL_PENGAJUAN = $request->input("inputtanggalpengajuan");
      $newkredit->TGL_REALISASI = $request->input("inputtanggalrealisasi");
      $newkredit->JML_PINJAMAN = $request->input("inputjumlahpinjaman");
      // $newkredit->JML_BUNGA_PINJAMAN = $request->input("inputjumlahbungapinjaman");
      $newkredit->JML_ANGSURAN = $request->input("inputjmlangsuran");
      $newkredit->SATUAN_WAKTU_ANGSURAN = $request->input("inputsatuanwaktuangsuran");
      // $newkredit->BI_JANGKA_WAKTU = $request->input("inputjw");
      // $newkredit->TGL_JATUH_TEMPO = $request->input("inputtanggaljttempo");
      $newkredit->SUKU_BUNGA_PER_TAHUN = $request->input("inputbungaperthn");
      $newkredit->suku_bunga_eff_per_tahun = $request->input("inputbungaeffperthn");
      // $newkredit->SUKU_BUNGA_PER_ANGSURAN = $request->input("inputsukubunga");
      // $newkredit->ADM_PER_BLN = $request->input("inputbyadmin");
      $newkredit->BUNGA_EFEKTIF_THN_INI = $request->input("inputbybonus");
      // $newkredit->FAKTOR_ANUITAS = $request->input("inputfaktoanuitas");
      // $newkredit->PERIODE_ANGSURAN_POKOK = $request->input("inputterminpokok");
      // $newkredit->PERIODE_ANGSURAN_BUNGA = $request->input("inputterminbunga");
      // $newkredit->GRACE_PERIOD_POKOK = $request->input("inputgppokok");
      // $newkredit->GRACE_PERIOD_BUNGA = $request->input("inputgpbunga");
      // $newkredit->JML_BUNGA_PINJAMAN = $request->input("inputangsuranblnpersen");
      // $newkredit->angsuran_total = $request->input("inputangsuranbln");
      // $newkredit->SUKU_BUNGA_EKIVALEN = $request->input("inputbungaekiv");
      // $newkredit->FEE_BUNGA_1_PER_TAHUN = $request->input("inputangsuranfee1");
      // $newkredit->FEE_BUNGA_2_PER_TAHUN = $request->input("inputangsuranfee2");
      // $newkredit->denda_per_hari = $request->input("inputdendaharian");
      // $newkredit->TAGIHAN_JT = $request->input("inputdendajtharian");
      // $newkredit->GRACE_PERIOD = $request->input("inputgphari");
      // $newkredit->ADM_PER_BLN = $request->input("inputbyadminpersen");
      // biaya dan potongan pinjaman
      $newkredit->PERSEN_PROVISI = $request->input("inputprovisi");
      $newkredit->PROVISI = $request->input("inputprovisirp");
      // $newkredit->AMORTISASI_PROVISI = $request->input("inputbyadminpersen");
      // $newkredit->PERSEN_ADM = $request->input("inputadmfinal");
      // $newkredit->ADM = $request->input("inputadmfinalrp");
      // $newkredit->amortisasi_adm = $request->input("inputbyadminpersen");
      // $newkredit->PERSEN_BIAYA_TRANSAKSI = $request->input("inputbytrans");
      $newkredit->biaya_transaksi = $request->input("inputbytransrp");
      // $newkredit->amortisasi_biaya_transaksi = $request->input("inputbyadminpersen");
      // $newkredit->PREMI = $request->input("inputpremi");
      // $newkredit->NOTARIEL = $request->input("inputnotariel");
      // $newkredit->MATERAI = $request->input("inputmaterai");
      // $newkredit->POKOK_MATERAI = $request->input("inputpkmaterai");
      // $newkredit->ANGSURAN_ADMIN = $request->input("inputlainlain");
      // $newkredit->JKW_PREMI = $request->input("inputangsuranpremi");
      // $newkredit->ANGSURAN_PREMI = $request->input("inputangsuranpremirp");
      // $newkredit->TOTAL_PREMI = $request->input("inputtotalpremi");
      // $newkredit->amortisasi_biaya_transaksi = $request->input("inputbyadminpersen");
      // $newkredit->PERSEKOT = $request->input("inputditanggung");
      $newkredit->save();
    }
    
}