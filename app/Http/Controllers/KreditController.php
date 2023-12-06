<?php

namespace App\Http\Controllers;
use App\Logo;
use App\User;
use App\Kredit;
use App\Kretrans;
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
        $inputtglpklama = \DateTime::createFromFormat('d/m/Y', $request->input("inputtglpklama"))->format('Y-m-d');
        $newkredit->TGL_PK_LAMA = $inputtglpklama;
        $newkredit->NO_PK_BARU = $request->input("inputnopkbaru");
      }
      // $newkredit->REVIEW_BUNGA = $request->input("inputreviewbunga");
      $newkredit->STATUS_AKTIF = $request->input("inputstatus");
      $newkredit->NASABAH_ID = $request->input("inputnasabahid");      
      $newkredit->KODE_GROUP1 = $request->input("inputkodegorup1");
      if($request->input("inputkodegorup2")!=''){
        $newkredit->KODE_GROUP2 = $request->input("inputkodegorup2");
      }
      if($request->input("inputkodegorup2")!=''){
        $newkredit->KODE_GROUP3 = $request->input("inputkodegorup3");
      }
      $newkredit->KODE_SUMBER_DANA = $request->input("inputsumberdana");
      // data angsuran
      $newkredit->TYPE_PINJAMAN = $request->input("inputtipepinjaman");
      $inputtanggalpengajuan = \DateTime::createFromFormat('d/m/Y', $request->input("inputtanggalpengajuan"))->format('Y-m-d');
      $newkredit->TGL_PENGAJUAN = $inputtanggalpengajuan;
      $inputtanggalrealisasi = \DateTime::createFromFormat('d/m/Y', $request->input("inputtanggalrealisasi"))->format('Y-m-d');
      $newkredit->TGL_REALISASI = $inputtanggalrealisasi;
      $newkredit->JML_PINJAMAN = $request->input("inputjumlahpinjaman");
      $newkredit->JML_BUNGA_PINJAMAN = $request->input("inputjumlahbungapinjaman");
      $newkredit->JML_ANGSURAN = $request->input("inputjmlangsuran");
      $newkredit->SATUAN_WAKTU_ANGSURAN = $request->input("inputsatuanwaktuangsuran");
      $newkredit->BI_JANGKA_WAKTU = $request->input("inputjw");
      $newkredit->TGL_JATUH_TEMPO = \DateTime::createFromFormat('d/m/Y', $request->input("inputtanggaljttempo"))->format('Y-m-d');
      $newkredit->SUKU_BUNGA_PER_TAHUN = $request->input("inputbungaperthn");
      $newkredit->suku_bunga_eff_per_tahun = $request->input("inputbungaeffperthn");
      $newkredit->SUKU_BUNGA_PER_ANGSURAN = $request->input("inputsukubunga");
      $newkredit->ADM_PER_BLN = $request->input("inputbyadmin");
      $newkredit->BUNGA_EFEKTIF_THN_INI = $request->input("inputbybonus");
      $newkredit->FAKTOR_ANUITAS = $request->input("inputfaktoanuitas");
      $newkredit->PERIODE_ANGSURAN_POKOK = $request->input("inputterminpokok");
      $newkredit->PERIODE_ANGSURAN_BUNGA = $request->input("inputterminbunga");
      $newkredit->GRACE_PERIOD_POKOK = $request->input("inputgppokok");
      $newkredit->GRACE_PERIOD_BUNGA = $request->input("inputgpbunga");
      $newkredit->JML_BUNGA_PINJAMAN = $request->input("inputjumlahbungapinjaman");
      $newkredit->angsuran_total = $request->input("inputangsuranbln");
      $newkredit->angsuran_pokok = $request->input("angsuranpokok")[1];
      $newkredit->angsuran_bunga = $request->input("angsuranbunga")[1];
      $newkredit->SUKU_BUNGA_EKIVALEN = $request->input("inputbungaekiv");
      $newkredit->FEE_BUNGA_1_PER_TAHUN = $request->input("inputangsuranfee1");
      $newkredit->FEE_BUNGA_2_PER_TAHUN = $request->input("inputangsuranfee2");
      $newkredit->denda_per_hari = $request->input("inputdendaharian");
      $newkredit->TAGIHAN_JT = $request->input("inputdendajtharian");
      $newkredit->GRACE_PERIOD = $request->input("inputgphari");
      $newkredit->ADM_PER_BLN = $request->input("inputbyadminpersen");
      // biaya dan potongan pinjaman
      $newkredit->PERSEN_PROVISI = $request->input("inputprovisi");
      $newkredit->PROVISI = $request->input("inputprovisirp");
      $newkredit->AMORTISASI_PROVISI = $request->input("inputbyadminpersen");
      $newkredit->PERSEN_ADM = $request->input("inputadmfinal");
      $newkredit->ADM = $request->input("inputadmfinalrp");
      $newkredit->amortisasi_adm = $request->input("inputbyadminpersen");
      $newkredit->PERSEN_BIAYA_TRANSAKSI = $request->input("inputbytrans");
      $newkredit->biaya_transaksi = $request->input("inputbytransrp");
      $newkredit->amortisasi_biaya_transaksi = $request->input("inputbyadminpersen");
      $newkredit->PREMI = $request->input("inputpremi");
      $newkredit->NOTARIEL = $request->input("inputnotariel");
      $newkredit->MATERAI = $request->input("inputmaterai");
      $newkredit->POKOK_MATERAI = $request->input("inputpkmaterai");
      $newkredit->ANGSURAN_ADMIN = $request->input("inputlainlain");
      $newkredit->JKW_PREMI = $request->input("inputangsuranpremi");
      $newkredit->ANGSURAN_PREMI = $request->input("inputangsuranpremirp");
      $newkredit->TOTAL_PREMI = $request->input("inputtotalpremi");
      $newkredit->amortisasi_biaya_transaksi = $request->input("inputbyadminpersen");
      $newkredit->PERSEKOT = $request->input("inputditanggung");
      $newkredit->save();

      $length = count($request->input("tglangsuran"));
      for ($i = 0; $i < $length; $i++) {
        $newkretrans = New Kretrans();
        $newkretrans->NO_REKENING = $request->input("inputnorekening");
        $newkretrans->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tglangsuran")[$i])->format('Y-m-d');
        $newkretrans->POKOK_TRANS = $request->input("angsuranpokok")[$i];
        $newkretrans->BUNGA_TRANS = $request->input("angsuranbunga")[$i];
        $newkretrans->PROVISI_TRANS = 0;
        $newkretrans->ANGSURAN_KE = $i+1;
        $newkretrans->MY_KODE_TRANS = '200';
        $newkretrans->save();

        $newkretrans2 = New Kretrans();
        $newkretrans2->NO_REKENING = $request->input("inputnorekening");
        $newkretrans2->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tglprovisi")[$i])->format('Y-m-d');
        $newkretrans2->POKOK_TRANS = 0;
        $newkretrans2->BUNGA_TRANS = 0;
        $newkretrans2->PROVISI_TRANS = $request->input("angsuranprovisi")[$i];
        $newkretrans2->ANGSURAN_KE = $i+1;
        $newkretrans2->MY_KODE_TRANS = '225';
        $newkretrans2->save();
      }
      
      
      
      return redirect()->back()->with('msgstatus', '1');
    }
    
}