<?php

namespace App\Http\Controllers;
use App\Logo;
use App\User;
use App\Kredit;
use App\Kretrans;
use App\Kodejeniskredit;
use App\Nasabah;
use App\Tabungan;
use App\KodeGroup1Kredit;
use App\KodeGroup2Kredit;
use App\KodeGroup3Kredit;
use App\KodeSumberDanaKredit;
use App\KodeTypeKredit;
use App\KodeSatuanWaktuKredit;
use App\KodeSifatKredit;
use App\KodeJenisPenggunaanKredit;
use App\KodeGolDebitur;
use App\KodeSektorEkonomiKredit;
use App\KodeGolPenjaminKredit;
use App\KodeAsuransiKredit;
use App\Kodemetoda;
use App\KodeSumberPelunasan;
use App\Kodeketerkaitanlapbul;
use App\KodeJenisUsaha;
use App\SidKodeSifatKredit;
use App\SidKodeJenisPenggunaan;
use App\SidKodeBidangUsaha;
use App\SidKodeGolonganPenjamin;
use App\SidKodeJenisAsuransi;
use App\SidKodeGolKredit;
use App\SidKodeJenisFasilitas;
use App\KodePeriodePembayaran;
use App\JenisAgunan;
use App\Mysysid;
use App\Agunan;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

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
        //lapbul options
        $kodesifatkredit = KodeSifatKredit::all()->sort();
        $kodejenispenggunaankredit = KodeJenisPenggunaanKredit::all()->sort();
        $kodegoldebitur = KodeGolDebitur::all()->sort();
        $kodesektorekonomikredit = KodeSektorEkonomiKredit::all()->sort();
        $kodegolpenjaminkredit = KodeGolPenjaminKredit::all()->sort();
        $kodeasuransikredit = KodeAsuransiKredit::all()->sort();
        $kodemetoda = Kodemetoda::all()->sort();
        $kodesumberpelunasan = KodeSumberPelunasan::all()->sort();
        $kodeketerkaitanlapbul = Kodeketerkaitanlapbul::all()->sort();
        $kodejenisusaha = KodeJenisUsaha::all()->sort();
        $sidkodebidangusaha = SidKodeBidangUsaha::all()->sort();
        $sidkodesifatkredit = SidKodeSifatKredit::all()->sort();
        $sidkodejenispenggunaan = SidKodeJenisPenggunaan::all()->sort();
        $sidkodegolonganpenjamin = SidKodeGolonganPenjamin::all()->sort();
        $sidkodejenisasuransi = SidKodeJenisAsuransi::all()->sort();
        $sidkodegolkredit = SidKodeGolKredit::all()->sort();
        $sidkodejenisfasilitas = SidKodeJenisFasilitas::all()->sort();
        $kodeperiodepembayaran = KodePeriodePembayaran::all()->sort();
        $jenisagunan = JenisAgunan::all()->sort();
        $nasabahs = Nasabah::select('nasabah_id','nama_nasabah','alamat')->get()->toArray();
        $tabungans = Tabungan::select('tabung.NO_REKENING','nasabah.nama_nasabah','nasabah.alamat')
                      ->leftJoin('nasabah', function($join) {
                        $join->on('nasabah.nasabah_id', '=', 'tabung.NASABAH_ID');
                        })
                      ->get()->toArray();
        $kodejeniskredit=Kodejeniskredit::all();

      return view('admin/kredit', ['logos'=> $logos, '
      users'=> $users,'nasabahs'=> $nasabahs,
      'tabungans' => $tabungans,
      'kodejeniskredit'=>$kodejeniskredit, 
      'kodegroup1kredit'=>$kodegroup1kredit, 
      'kodegroup2kredit'=>$kodegroup2kredit, 
      'kodegroup3kredit'=>$kodegroup3kredit,
      'kodesumberdanakredit'=>$kodesumberdanakredit, 
      'kodetypekredit'=>$kodetypekredit,
      'kodesatuanwaktuangsuran'=>$kodesatuanwaktuangsuran,
      'kodesifatkredit'=>$kodesifatkredit,
      'sidkodesifatkredit'=>$sidkodesifatkredit,
      'kodejenispenggunaankredit'=>$kodejenispenggunaankredit,
      'sidkodejenispenggunaan'=>$sidkodejenispenggunaan,
      'kodegoldebitur'=>$kodegoldebitur,
      'kodesektorekonomikredit'=>$kodesektorekonomikredit,
      'sidkodebidangusaha'=>$sidkodebidangusaha,
      'kodegolpenjaminkredit'=>$kodegolpenjaminkredit,
      'sidkodegolonganpenjamin'=>$sidkodegolonganpenjamin,
      'kodeasuransikredit'=>$kodeasuransikredit,
      'sidkodejenisasuransi'=>$sidkodejenisasuransi,
      'sidkodegolkredit'=>$sidkodegolkredit,
      'kodemetoda'=>$kodemetoda,
      'sidkodejenisfasilitas'=>$sidkodejenisfasilitas,
      'kodesumberpelunasan'=>$kodesumberpelunasan,
      'kodeketerkaitanlapbul'=>$kodeketerkaitanlapbul,
      'kodeperiodepembayaranpokok'=>$kodeperiodepembayaran,
      'kodeperiodepembayaranbunga'=>$kodeperiodepembayaran,
      'kodejenisusaha'=>$kodejenisusaha,
      'jenisagunan'=>$jenisagunan,
      'msgstatus'=> '']);
    }

    public function bo_kr_de_kredit_add(Request $request)
    {
      $newkredit = new Kredit();
      // data utama
      $newkredit->JENIS_PINJAMAN =  $request->input("inputjeniskredit");
      $newkredit->CAB =  $request->input("inputcabang");
      $newkredit->NO_REKENING = $request->input("inputnorekening");
      // dd($request->input("inputnorekening"));
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
      // dd($request->input("inputjw"));
      $newkredit->BI_JANGKA_WAKTU = $request->input("inputjw");
      $newkredit->TGL_JATUH_TEMPO = \DateTime::createFromFormat('d/m/Y', $request->input("inputtanggaljttempo"))->format('Y-m-d');
      $newkredit->SUKU_BUNGA_PER_TAHUN = $request->input("inputbungaperthn");
      $newkredit->suku_bunga_eff_per_tahun = $request->input("inputbungaeffperthn");
      $newkredit->SUKU_BUNGA_PER_ANGSURAN = $request->input("inputsukubunga");
      $newkredit->BI_SUKU_BUNGA = $request->input("inputsukubunga");
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
      $newkredit->TGL_ANGSURAN = \DateTime::createFromFormat('d/m/Y', $request->input("inputmulaiangsuran"))->format('Y-m-d');
      //form lapbul empty($var1)? $var2 : $var1;
      $newkredit->PENJAMIN = empty($request->input("inputpenjamin"))? " " : $request->input("inputpenjamin");
      $newkredit->ID_PENJAMIN = empty($request->input("inputidpenjamin"))? " " : $request->input("inputidpenjamin");
      $newkredit->TGL_ANALISA = \DateTime::createFromFormat('d/m/Y', $request->input("inputtglanalisa"))->format('Y-m-d');
      $newkredit->alamat_penjamin = empty($request->input("inputalamatpenjamin"))? " " : $request->input("inputalamatpenjamin");
      $newkredit->PEKERJAAN_PENJAMIN = empty($request->input("inputpekerjaanpenjamin"))? " " : $request->input("inputpekerjaanpenjamin");
      $newkredit->BI_SIFAT = $request->input("inputkodesifatkredit");
      $newkredit->SID_SIFAT = $request->input("inputsidkodesifatkredit");
      $newkredit->BI_JENIS_PENGGUNAAN = $request->input("inputkodejenispenggunaankredit");
      $newkredit->SID_JENIS_PENGGUNAAN = $request->input("inputsidkodejenispenggunaan");
      $newkredit->BI_GOL_DEBITUR = $request->input("inputkodegoldebitur");
      $newkredit->BI_SEKTOR_EKONOMI = $request->input("inputkodesektorekonomikredit");
      $newkredit->SID_SEKTOR_EKONOMI = $request->input("inputsidkodebidangusaha");
      $newkredit->BI_GOL_PENJAMIN = $request->input("inputkodegolpenjaminkredit");
      $newkredit->SID_GOL_PENJAMIN = $request->input("inputsidkodegolonganpenjamin");
      $newkredit->KODE_ASURANSI = $request->input("inputkodeasuransikredit");
      $newkredit->SID_JENISASURANSI = $request->input("inputsidkodejenisasuransi");
      // jmlasuransi
      // dijaminkan
      $newkredit->SID_GOLKREDIT = $request->input("inputsidkodegolkredit");
      $newkredit->KODE_METODA = $request->input("inputkodemetoda");
      $newkredit->SID_JENISFASILITAS = $request->input("inputsidkodejenisfasilitas");
      $newkredit->sumber_dana_pelunasan = $request->input("inputkodesumberpelunasan");
      $newkredit->TUJUAN_PENGGUNAAN = empty($request->input("inputtujuanpenggunaan"))? " " : $request->input("inputtujuanpenggunaan");
      $newkredit->kode_bi_hubungan = $request->input("inputkodeketerkaitanlapbul");
      $newkredit->periode_pembayaran = $request->input("inputkodeperiodepembayaranpokok");
      $newkredit->jenis_usaha = $request->input("inputkodejenisusaha");
      $newkredit->periode_pembayaran_bunga = $request->input("inputkodeperiodepembayaranbunga"); 
      $newkredit->STATUS_PASANGAN = empty($request->input("inputdatasuamiistri"))? " " : $request->input("inputdatasuamiistri");
      $newkredit->NO_PENSIUN = empty($request->input("inputnopensiun"))? " " : $request->input("inputnopensiun");
      $newkredit->NAMA_PASANGAN = empty($request->input("inputnamasuamiistri"))? " " : $request->input("inputnamasuamiistri");
      // no kartu pensiun
      $newkredit->ALAMAT_PASANGAN = empty($request->input("inputalamatsuamiistri"))? " " : $request->input("inputalamatsuamiistri");
      $newkredit->JENIS_PENSIUN = empty($request->input("inputjenispensiun"))? " " : $request->input("inputjenispensiun");
      $newkredit->PEKERJAAN_PASANGAN = empty($request->input("inputpekerjaansuamiistri"))? " " : $request->input("inputpekerjaansuamiistri");
      // pkpinjaman
      $newkredit->JENIS_CHANNELING = $request->input("inputkelompokgroup");
      $newkredit->NO_REK_NOTARIEL = empty($request->input("inputtabnotariel"))? " " : $request->input("inputtabnotariel");
      $newkredit->NO_REK_DEBET_TAB = empty($request->input("inputtabasuransi"))? " " : $request->input("inputtabasuransi");
      $newkredit->NO_REK_DEBET = empty($request->input("inputtabholddana"))? " " : $request->input("inputtabholddana");
      $newkredit->STATUS_AKTIF = 1;
      $newkredit->FLAG_JADWAL = "TERKUNCI";
      $newkredit->save();

      // form agunan
      if($request->input("jenisagunan")){
        $length = count($request->input("jenisagunan"));
        for ($i = 0; $i < $length; $i++) {
          $newagunan = New Agunan();
          if($request->file("agunanimage")){
            $filename = time().'.'.$request->file("agunanimage")->getClientOriginalExtension();
            $request->file("agunanimage")->move(public_path('img'), $filename);
            $newagunan->path_agunan = $filename;
          }

          $newagunan->NO_AGUNAN = $request->input("noagunan")[$i];
          $newagunan->agunan = $request->input("uraianagunan")[$i];
          $newagunan->agunan_nilai = $request->input("nilaiagunan")[$i];
          $newagunan->agunan_jenis = $request->input("jenisagunan")[$i];
          $newagunan->agunan_ikatan_hukum = "1";
          $newagunan->sid_kode_agunan = "02";
          $newagunan->sid_agunan_ikatan_hukum = "03";
          $newagunan->bi_agunan_nilai = $request->input("nilaiagunanbi")[$i];
          $newagunan->BI_AGUNAN_YG_DIJAMINKAN = $request->input("persenlikuidasi")[$i];
          $newagunan->NILAI_LIKUIDASI = $request->input("nilailikuidasi")[$i];
          $newagunan->PEMILIK_AGUNAN = $request->input("pemilikagunan")[$i];
          $newagunan->ALAMAT_AGUNAN = $request->input("alamatagunan")[$i];
          $newagunan->BUKTI_AGUNAN = $request->input("buktiagunan")[$i];
          if($request->input("jtempoagunan")[$i]){
            $newagunan->TGL_JT_AGUNAN = \DateTime::createFromFormat('d/m/Y', $request->input("jtempoagunan")[$i])->format('Y-m-d');
          }
          $newagunan->KODE_AGUNAN = "5";
          $newagunan->agunan_rincian = $request->input("rincianagunan")[$i];
          if($request->input("inputnorekening")==''){
            $newagunan->no_rekening = $request->input("inputnopkbaru");
          }else{
            $newagunan->no_rekening = $request->input("inputnorekening");
          }        
          $newagunan->id_agunan = $request->input("idagunan")[$i];
          $newagunan->save();
        }
      }
      
      // input jadwal kredit transaction
      if($request->input("tglangsuran")) {
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
          $newkretrans->VALIDATED = 1;
          $newkretrans->save();

          $newkretrans2 = New Kretrans();
          $newkretrans2->NO_REKENING = $request->input("inputnorekening");
          $newkretrans2->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tglprovisi")[$i])->format('Y-m-d');
          $newkretrans2->POKOK_TRANS = 0;
          $newkretrans2->BUNGA_TRANS = 0;
          $newkretrans2->PROVISI_TRANS = $request->input("angsuranprovisi")[$i];
          $newkretrans2->ANGSURAN_KE = $i+1;
          $newkretrans2->MY_KODE_TRANS = '225';
          $newkretrans2->VALIDATED = 1;
          $newkretrans2->save();
        }
      }
      return redirect()->back()->with('msgstatus', '1');
    }

    /*
    AJAX request
    */
    public function getKredits(Request $request){

      ## Read value
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); // Rows display per page

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');

      $columnIndex = $columnIndex_arr[0]['column']; // Column index
      $columnName = $columnName_arr[$columnIndex]['data']; // Column name
      $columnSortOrder = $order_arr[0]['dir']; // asc or desc
      $searchValue = $search_arr['value']; // Search value

      // Total records
      $totalRecords = Kredit::select('count(*) as allcount')->count();
      $totalRecordswithFilter = Kredit::select('count(*) as allcount')->where('NO_REKENING', 'like', '%' .$searchValue . '%')->count();

      // Fetch records
      $records = Kredit::select('nasabah.*','NO_REKENING','JENIS_PINJAMAN','POKOK_SALDO_REALISASI','POKOK_SALDO_AKHIR','DESKRIPSI_JENIS_KREDIT','kredit.NASABAH_ID')
          ->leftJoin('kodejeniskredit', function($join) {
          $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
          })
          ->leftJoin('nasabah', function($join) {
              $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
            })
          ->where('NO_REKENING', 'like', '%' .$searchValue . '%')
          ->orWhere('nama_nasabah', 'like', '%' .$searchValue . '%')
          ->orWhere('DESKRIPSI_JENIS_KREDIT', 'like', '%' .$searchValue . '%')
          ->skip($start)
          ->take($rowperpage)
          ->orderBy($columnName,$columnSortOrder)
          ->get();

      $data_arr = array();
      
      foreach($records as $record){
        $namanasabah = $record->nama_nasabah;
        $deskripsi = $record->DESKRIPSI_JENIS_KREDIT;
        $norek = $record->NO_REKENING; 
        $saldorealisasi = $record->POKOK_SALDO_REALISASI; 
        $saldoakhir = $record->POKOK_SALDO_AKHIR; 

        $data_arr[] = array(
          "nama_nasabah" => $namanasabah,
          "DESKRIPSI_JENIS_KREDIT" => $deskripsi,
          "NO_REKENING" => $norek,
          "POKOK_SALDO_REALISASI" => $saldorealisasi,
          "POKOK_SALDO_AKHIR" => $saldoakhir
        );
      }

      $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "aaData" => $data_arr
      );

      echo json_encode($response);
      exit;
    }
    
    public function bo_kr_de_kredittrans(Request $request)
    {
      $logos = Logo::all();
      $users = User::all();
      $tanggaltransaksi = Mysysid::select('Value')->where('KeyName','=','TANGGALHARIINI')->get();
      $tanggal = $tanggaltransaksi[0]->Value;
      return view('admin/kredittransdelete',['logos'=> $logos, 
      'users'=> $users,
      'tanggaltransaksi'=>$tanggal,
      'msgstatus'=> '']);
    }

    public function bo_kr_de_kredittransdelete(Request $request)
    {
      Kretrans::where('KRETRANS_ID',$request->input("kretransid"))->delete();
      return redirect()->back()->with('msgstatus', '1');
    }

    public function getKreditTransactions(Request $request){

      ## Read value
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); // Rows display per page

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');

      $columnIndex = $columnIndex_arr[0]['column']; // Column index
      $columnName = $columnName_arr[$columnIndex]['data']; // Column name
      $columnSortOrder = $order_arr[0]['dir']; // asc or desc
      $searchValue = $search_arr['value']; // Search value

      $tanggaltransaksi = Mysysid::select('Value')->where('KeyName','=','TANGGALHARIINI')->get();
      $tanggal = $tanggaltransaksi[0]->Value;
      $tglhariini = \DateTime::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d');

      // Total records
      $totalRecords = Kretrans::select('count(*) as allcount')->count();
      $totalRecordswithFilter = Kretrans::select('count(*) as allcount')->where('MY_KODE_TRANS', '=', '300')->orWhere('MY_KODE_TRANS', '=', '100')->where('NO_REKENING', 'like', '%' .$searchValue . '%')->where('TGL_TRANS','=',$tglhariini)->count();

      // Fetch records
      $records = Kretrans::select('kretrans.*', 'kredit.*','nasabah.*','my_kodetrans.*')
          ->leftJoin('my_kodetrans', function($join) {
            $join->on('my_kodetrans.MY_KODE_TRANS', '=', 'kretrans.MY_KODE_TRANS');
            })
          ->leftJoin('kredit', function($join) {
          $join->on('kredit.NO_REKENING', '=', 'kretrans.NO_REKENING');
          })
          ->leftJoin('nasabah', function($join) {
              $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
            })
          ->where('kretrans.NO_REKENING', 'like', '%' .$searchValue . '%')
          ->where('kretrans.TGL_TRANS','=',$tglhariini)
          ->where(function ($query) {
            $query->where('kretrans.MY_KODE_TRANS', '=', '300')
            ->orWhere('kretrans.MY_KODE_TRANS', '=', '100');
            })
          ->skip($start)
          ->take($rowperpage)
          ->orderBy($columnName,$columnSortOrder)
          ->get();

      $data_arr = array();
      
      foreach($records as $record){
        $kretransid = $record->KRETRANS_ID;
        $tgltrans = \DateTime::createFromFormat('Y-m-d', $record->TGL_TRANS)->format('d/m/Y');
        $nasabahid = $record->NASABAH_ID;
        $namanasabah = $record->nama_nasabah;
        $norek = $record->NO_REKENING; 
        $deskripsikodetransaksi = $record->DESKRIPSI_MY_KODE_TRANS;
        $pokok = $record->POKOK_TRANS;
        $bunga = $record->BUNGA_TRANS;
        $denda = $record->DENDA_TRANS;
        $kuitansi = $record->KUITANSI; 
        $kodetrans = $record->MY_KODE_TRANS; 

        $data_arr[] = array(
          "KRETRANS_ID" => $kretransid,
          "TGL_TRANS" => $tgltrans,
          "NASABAH_ID" => $nasabahid,
          "nama_nasabah" => $namanasabah,
          "NO_REKENING" => $norek,
          "DESKRIPSI_MY_KODE_TRANS" => $deskripsikodetransaksi,
          "POKOK_TRANS" => $pokok,
          "BUNGA_TRANS" => $bunga,
          "DENDA_TRANS" => $denda,
          "KUITANSI" => $kuitansi,
          "MY_KODE_TRANS" => $kodetrans
        );
      }

      $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "aaData" => $data_arr
      );

      echo json_encode($response);
      exit;
    }
}