<?php

namespace App\Http\Controllers;
use App\KodeGroup1Deposito;
use App\KodeGroup2Deposito;
use App\KodeGroup3Deposito;
use App\KodeJenisDeposito;
use App\Kodecabang;
use App\Deposito;
use App\Kodeketerkaitanlapbul;
use App\Kodemetoda;
use App\Golonganpihaklawan;
use App\Logo;
use App\Mysysid;
use App\Nasabah;
use App\User;
use App\Tabtran;
use App\Deptran;
use App\Tellertran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Exports\ReportDepbungapajakExport;
Use App\Exports\ReportNominDepExport;
Use App\Exports\ReportNominGroupDepExport;
Use App\Exports\ReportNominGrpJnsDepExport;
Use App\Exports\ReportNominGrpJkwDepExport;
Use App\Exports\ReportNominGrpSkbngDepExport;
Use App\Exports\ReportNominGrpKDGRP1DepExport;
Use App\Exports\ReportNominGrpKDGRP2DepExport;
Use App\Exports\ReportNominGrpKDGRP3DepExport;
Use App\Exports\ReportNominGrpKELSALDepExport;
Use App\Exports\ReportTransaksiDepExport;
use App\KodeTransDeposito;
use App\Kodetranstabungan;
use App\Tabungan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DepositoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        // Mbalekno Kehalaman LOGIN jika Waktu expired
    public function __construct()
    {
            $this->middleware('auth');
    }
    
    public function bo_dp_de_deposito()
    {
        $logos = Logo::all();
        $nasabah=Nasabah::select('nasabah_id','nama_nasabah','alamat')->get();
        $tabungan=DB::select('select tabung.NO_REKENING,tabung.NASABAH_ID,tabung.JENIS_TABUNGAN,tabung.SALDO_AKHIR,nasabah.nama_nasabah,nasabah.alamat FROM tabung LEFT JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id');
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id LIMIT 25');
        $users = User::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodegroup1deposito = KodeGroup1Deposito::all();
        $kodegroup2deposito = KodeGroup2Deposito::all();
        $kodegroup3deposito = KodeGroup3Deposito::all();
        $kodejenisdeposito = Kodejenisdeposito::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodeketerkaitanlapbul = Kodeketerkaitanlapbul::all();
        $kodemetoda = Kodemetoda::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        
        return view('admin.deposito', ['users'=>$users,'nasabah'=>$nasabah,'tabungan'=>$tabungan,'logos'=> $logos,'depositos'=> $depositos,'kodegroup1deposito'=> $kodegroup1deposito,'kodegroup2deposito'=> $kodegroup2deposito,'kodegroup3deposito'=>$kodegroup3deposito,'kodejenisdeposito'=> $kodejenisdeposito,'golonganpihaklawan'=>$golonganpihaklawan,'kodeketerkaitanlapbul'=>$kodeketerkaitanlapbul,'kodemetoda'=>$kodemetoda,'kodecabang'=>$kodecabang,'tgllogin'=>$tgllogin,'tgl_login'=>$tgllogin,'msgstatus'=> '','msgview'=> '']);
    }
    
    public function bo_dp_de_deposito_cari(Request $request) 
    {
        if(is_null($request->namanasabahcari)==true)
        {
            $opsi ="deposito.NO_REKENING like '%".$request->norekcari."%'";
        }elseif(is_null($request->norekcari)==true){
            $opsi ="nasabah.nama_nasabah like '%".$request->namanasabahcari."%'";
        }else{
            return redirect()->route('showdeposito');
        }

        $sql="select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id WHERE ".$opsi;
        $logos = Logo::all();
        $nasabah=Nasabah::select('nasabah_id','nama_nasabah','alamat')->get();
        $depositos = DB::select($sql);
        $tabungan=DB::select('select tabung.NO_REKENING,tabung.NASABAH_ID,tabung.JENIS_TABUNGAN,tabung.SALDO_AKHIR,nasabah.nama_nasabah,nasabah.alamat FROM tabung LEFT JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id');
        $users = User::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodegroup1deposito = KodeGroup1Deposito::all();
        $kodegroup2deposito = KodeGroup2Deposito::all();
        $kodegroup3deposito = KodeGroup3Deposito::all();
        $kodejenisdeposito = Kodejenisdeposito::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodeketerkaitanlapbul = Kodeketerkaitanlapbul::all();
        $kodemetoda = Kodemetoda::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        return view('admin.deposito', ['users'=>$users,'nasabah'=>$nasabah,'tabungan'=>$tabungan,'logos'=> $logos,'depositos'=> $depositos,'kodegroup1deposito'=> $kodegroup1deposito,'kodegroup2deposito'=> $kodegroup2deposito,'kodegroup3deposito'=>$kodegroup3deposito,'kodejenisdeposito'=> $kodejenisdeposito,'golonganpihaklawan'=>$golonganpihaklawan,'kodeketerkaitanlapbul'=>$kodeketerkaitanlapbul,'kodemetoda'=>$kodemetoda,'kodecabang'=>$kodecabang,'tgllogin'=>$tgllogin,'tgl_login'=>$tgllogin,'msgstatus'=> '','msgview'=> '']);
    }

    public function bo_dp_de_deposito_add(Request $request)
    {
      $logos = Logo::all();

      $this->validate($request,[
        'no_rekening'=>'required',
      ]);
      if ($request->no_rekening != '' && $request->jenis_deposito !='' && $request->jml_deposito !='' && $request->tgl_registrasi !='' && $request->inputstatus !='')
      {
        if($request->aro=="on"){
            $aro='1';
        }else{
            $aro='0';
        }
        if($request->bungaberbunga=="on"){
            $bungaberbunga='1';
        }else{
            $bungaberbunga='0';
        }
        if($request->masuktitipan=="on"){
            $masuktitipan='1';
        }else{
            $masuktitipan='0';
        }
        if($request->blokir=="on"){
            $blokir='1';
        }else{
            $blokir='0';
        }
        $depositos = new Deposito;
        $depositos->NO_REKENING = $request->no_rekening;
        if(is_null($request->no_bilyet)||$request->no_bilyet=="")
        {
            $depositos->NO_ALTERNATIF = $request->no_rekening;
        }else{
            $depositos->NO_ALTERNATIF = $request->no_bilyet;
        }
        $depositos->NASABAH_ID = $request->nasabah_id;
        if(is_null($request->qq)==false||$request->qq<>"")
        {
            $depositos->QQ = $request->qq;
        }
        $depositos->KODE_BI_PEMILIK = $request->kode_bi_pemilik;
        $depositos->KODE_BI_HUBUNGAN = $request->kode_bi_hubungan;
        $depositos->KODE_BI_METODA = $request->metoda;
        $depositos->JENIS_DEPOSITO = $request->jenis_deposito;
        $depositos->JML_DEPOSITO = $request->jml_deposito;
        $depositos->SUKU_BUNGA = $request->suku_bunga;
        $depositos->PERSEN_PPH = $request->persen_pph;
        $depositos->TGL_REGISTRASI = $request->tgl_registrasi;
        $depositos->JKW = $request->jkw;
        $depositos->TGL_JT = $request->tgl_jt;
        $depositos->STATUS_AKTIF = $request->inputstatus;
        if(is_null($request->kode_group1)==false){
            $depositos->KODE_GROUP1 = $request->kode_group1;
        }
        if(is_null($request->kode_group2)==false){
            $depositos->KODE_GROUP2 = $request->kode_group2;
        }
        if(is_null($request->kode_group3)==false){
            $depositos->KODE_GROUP3 = $request->kode_group3;
        }
        if(is_null($request->catatanaro)==false){
            $depositos->STATUS_BUNGA = $request->catatanaro;
        }

        $depositos->ARO = $aro;
        if(is_null($request->kerekeningtab)==false){
            $depositos->NO_REK_TABUNGAN = $request->kerekeningtab;
        }

        $depositos->BUNGA_BERBUNGA = $bungaberbunga;
        $depositos->MASUK_TITIPAN = $masuktitipan;
        $depositos->KODE_CAB = $request->cab;
        $depositos->ABP = $request->tipe_deposito;
        $depositos->PROVISI = $request->provisi;
        $depositos->ADM = $request->administrasi;
        $depositos->TYPE_SUKU_BUNGA = $request->type_bunga;
        $depositos->TGL_VALUTA = $request->tgl_valuta;
        $depositos->TGL_MULAI = $request->tgl_penempatan;
        $depositos->BLOKIR = $blokir;
        $depositos->AKAD = '2';
        $depositos->gol_nasabah = '876';
        $depositos->KETERANGAN = $request->keterangan;
        $depositos->save();

        if ($depositos){
          $msg='1';
          $msgdetail='Proses Berhasil';
        }else{
          $msg='0';
          $msgdetail='Proses Simpan Data Gagal!';
        }
      }else{
        $msg='0';
        $msgdetail='Proses Gagal, Harap mengisi data dengan lengkap!';
      }
      
        $nasabah=Nasabah::select('nasabah_id','nama_nasabah','alamat')->get();
        $tabungan=DB::select('select tabung.NO_REKENING,tabung.NASABAH_ID,tabung.JENIS_TABUNGAN,tabung.SALDO_AKHIR,nasabah.nama_nasabah,nasabah.alamat FROM tabung LEFT JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id');
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id WHERE deposito.NO_REKENING="'.$request->no_rekening.'"');
        $users = User::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodegroup1deposito = KodeGroup1Deposito::all();
        $kodegroup2deposito = KodeGroup2Deposito::all();
        $kodegroup3deposito = KodeGroup3Deposito::all();
        $kodejenisdeposito = Kodejenisdeposito::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodeketerkaitanlapbul = Kodeketerkaitanlapbul::all();
        $kodemetoda = Kodemetoda::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        return view('admin.deposito', ['users'=>$users,'nasabah'=>$nasabah,'tabungan'=>$tabungan,'logos'=> $logos,'depositos'=> $depositos,'kodegroup1deposito'=> $kodegroup1deposito,'kodegroup2deposito'=> $kodegroup2deposito,'kodegroup3deposito'=>$kodegroup3deposito,'kodejenisdeposito'=> $kodejenisdeposito,'golonganpihaklawan'=>$golonganpihaklawan,'kodeketerkaitanlapbul'=>$kodeketerkaitanlapbul,'kodemetoda'=>$kodemetoda,'kodecabang'=>$kodecabang,'tgllogin'=>$tgllogin,'tgl_login'=>$tgllogin,'msgstatus'=> $msg,'msgview'=> $msgdetail]);
    }

    public function bo_dp_de_deposito_edit(Request $request)
    {
        $logos = Logo::all();
        if(md5($request->eno_rekening.'Bast90') == $request->eno_rekeningHashedit)
        {
            //update Deposito
            $depositos = Deposito::where('NO_REKENING', $request->eno_rekening)->first();
            
            if ($request->eno_rekening != '' && $request->ejenis_deposito !='' && $request->ejml_deposito !='' && $request->etgl_registrasi !='' && $request->einputstatus !='')
            {   
                if($request->earo=="on"){
                    $earo='1';
                }else{
                    $earo='0';
                }
                if($request->ebungaberbunga=="on"){
                    $ebungaberbunga='1';
                }else{
                    $ebungaberbunga='0';
                }
                if($request->emasuktitipan=="on"){
                    $emasuktitipan='1';
                }else{
                    $emasuktitipan='0';
                }
                if($request->eblokir=="on"){
                    $eblokir='1';
                }else{
                    $eblokir='0';
                }

                Deposito::where('NO_REKENING',$request->eno_rekening)
                ->update(['NO_ALTERNATIF' => $request->eno_bilyet,
                    'NASABAH_ID' => $request->enasabah_id,
                    'QQ' => $request->eqq,
                    'KODE_BI_PEMILIK' => $request->ekode_bi_pemilik,
                    'KODE_BI_HUBUNGAN' => $request->ekode_bi_hubungan,
                    'KODE_BI_METODA' => $request->emetoda,
                    'JENIS_DEPOSITO' => $request->ejenis_deposito,
                    'JML_DEPOSITO' => $request->ejml_deposito,
                    'SUKU_BUNGA' => $request->esuku_bunga,
                    'PERSEN_PPH' => $request->epersen_pph,
                    'TGL_REGISTRASI' => $request->etgl_registrasi,
                    'JKW' => $request->ejkw,
                    'TGL_JT' => $request->etgl_jt,
                    'STATUS_AKTIF' => $request->einputstatus,
                    'KODE_GROUP1' => $request->ekode_group1,
                    'KODE_GROUP2' => $request->ekode_group2,
                    'KODE_GROUP3' => $request->ekode_group3,
                    'STATUS_BUNGA' => $request->ecatatanaro,
                    'ARO' => $earo,
                    'NO_REK_TABUNGAN' => $request->ekerekeningtab,
                    'BUNGA_BERBUNGA' => $ebungaberbunga,
                    'MASUK_TITIPAN' => $emasuktitipan,
                    'KODE_CAB' => $request->ecab,
                    'ABP' => $request->etipe_deposito,
                    'PROVISI' => $request->eprovisi,
                    'ADM' => $request->eadministrasi,
                    'TYPE_SUKU_BUNGA' => $request->etype_bunga,
                    'TGL_VALUTA' => $request->etgl_valuta,
                    'TGL_MULAI' => $request->etgl_penempatan,
                    'BLOKIR' => $eblokir,
                    'KETERANGAN' => $request->eketerangan
              
                ]);
                
                if ($depositos){
                    $msg='1';
                    $msgdetail='Proses Berhasil';
                }else{
                    $msg='0';
                    $msgdetail='Proses Simpan Data Gagal!';
                }
            }else{
                $msg='0';
                $msgdetail='Proses Gagal, Harap mengisi data dengan lengkap!';
            }
        }else{
        $msg='0';
        $msgdetail='Proses Gagal, No Rekening Deposito tidak dapat diganti.';
        }

        $nasabah=Nasabah::select('nasabah_id','nama_nasabah','alamat')->get();
        $tabungan=DB::select('select tabung.NO_REKENING,tabung.NASABAH_ID,tabung.JENIS_TABUNGAN,tabung.SALDO_AKHIR,nasabah.nama_nasabah,nasabah.alamat FROM tabung LEFT JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id');
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id WHERE deposito.NO_REKENING="'.$request->eno_rekening.'"');
        $users = User::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodegroup1deposito = KodeGroup1Deposito::all();
        $kodegroup2deposito = KodeGroup2Deposito::all();
        $kodegroup3deposito = KodeGroup3Deposito::all();
        $kodejenisdeposito = Kodejenisdeposito::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodeketerkaitanlapbul = Kodeketerkaitanlapbul::all();
        $kodemetoda = Kodemetoda::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        return view('admin.deposito', ['users'=>$users,'nasabah'=>$nasabah,'tabungan'=>$tabungan,'logos'=> $logos,'depositos'=> $depositos,'kodegroup1deposito'=> $kodegroup1deposito,'kodegroup2deposito'=> $kodegroup2deposito,'kodegroup3deposito'=>$kodegroup3deposito,'kodejenisdeposito'=> $kodejenisdeposito,'golonganpihaklawan'=>$golonganpihaklawan,'kodeketerkaitanlapbul'=>$kodeketerkaitanlapbul,'kodemetoda'=>$kodemetoda,'kodecabang'=>$kodecabang,'tgllogin'=>$tgllogin,'tgl_login'=>$tgllogin,'msgstatus'=> $msg,'msgview'=> $msgdetail]);
    
    }
    // SHOW FORM HAPUS TRANSAKSI DEPOSITO
    public function bo_dp_de_hpstrsdeposito()
    {
        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        $deptrans = DB::select("select deptrans.*,deposito.masuk_titipan,deposito.bunga_berbunga,nasabah.nama_nasabah from (deposito inner join deptrans on deposito.no_rekening=deptrans.no_rekening) inner join nasabah on deposito.nasabah_id=nasabah.nasabah_id where deptrans.tgl_trans='$tgllogin'");
        return view ('admin.deposito.frmhapustransaksideposito',['logos'=>$logos,'users'=>$users,'deptrans'=>$deptrans,'msgstatus'=>'']);
    }
    // Hapus transaksi deposito
    public function bo_dep_del_trs(Request $request)
    {
        // dd($request);
        if($request->bunga_berbunga == '0' AND $request->masuk_titipan=='1' AND $request->no_bukti=='SYS-BNG')
        {
            Deptran::where('DEPTRANS_ID',$request->deptrans_id)->delete();
            Deptran::where('NO_REKENING',$request->no_rekening)
                    ->where('KUITANSI',$request->no_bukti)
                    ->where('TGL_TRANS',date('Y-m-d',strtotime($request->tgl_trans)))
                    ->delete();
            $tptambah = DB::select("SELECT SUM(SALDO_TRANS) as titipan_tambah FROM deptrans WHERE MY_KODE_TRANS='100' AND NO_REKENING='$request->no_rekening'")[0]->titipan_tambah;
            $tpambil = DB::select("SELECT SUM(SALDO_TRANS) as titipan_ambil FROM deptrans WHERE MY_KODE_TRANS='475' AND NO_REKENING='$request->no_rekening'")[0]->titipan_ambil;
            $tpakhir = $tptambah-$tpambil;
            Deposito::where('NO_REKENING',$request->no_rekening)->update(
                [
                    'TITIPAN_TAMBAH'=>$tptambah,
                    'TITIPAN_AMBIL' => $tpambil,
                    'TITIPAN_AKHIR' => $tpakhir,
                    'BUNGA_YMH' => 0
                ]
            );

        }elseif(is_null($request->no_rekening_tab)==false)
        {
            Deptran::where('DEPTRANS_ID',$request->deptrans_id)->delete();
            Deptran::where('NO_REKENING',$request->no_rekening)
                    ->where('NO_REK_OB',$request->no_rekening_tab)
                    ->where('TGL_TRANS',date('Y-m-d',strtotime($request->tgl_trans)))
                    ->delete();
            Deposito::where('NO_REKENING',$request->no_rekening)->update
            (
                [
                    'BUNGA_YMH' => 0
                ]
            );
            $link_id= DB::select("select tabtrans_id from tabtrans where link_rekening = '$request->no_rekening' AND tgl_trans='".date('Y-m-d',strtotime($request->tgl_trans))."'")[0]->tabtrans_id;
            Tabtran::where('MY_KODE_TRANS',175)
                    ->where('LINK_REKENING',$request->no_rekening)
                    ->where('TGL_TRANS',$request->tgl_trans)
                    ->delete();
            Tellertran::where('modul_trans_id',$link_id)->delete();
            $sldsetor = DB::select("SELECT sum(saldo_trans) as saldo_trans FROM tabtrans where NO_REKENING = '$request->no_rekening_tab' AND MY_KODE_TRANS LIKE '1%'")[0]->saldo_trans;
            $sldtarik = DB::select("SELECT sum(saldo_trans) as saldo_trans FROM tabtrans where NO_REKENING = '$request->no_rekening_tab' AND MY_KODE_TRANS LIKE '2%'")[0]->saldo_trans;
            $saldoakhir = $sldsetor-$sldtarik;
            Tabungan::where('NO_REKENING',$request->no_rekening_tab)->update([
                'SALDO_SETORAN' => $sldsetor,
                'SALDO_PENARIKAN' => $sldtarik,
                'SALDO_AKHIR' => $saldoakhir
            ]);
        }
        if($request->bunga_berbunga == '1' AND ($request->masuk_titipan=='1' OR $request->masuk_titipan=='0') AND substr($request->no_bukti,0,3)=='SYS')
        {
            Deptran::where('NO_REKENING',$request->no_rekening)
                    ->where('KUITANSI','LIKE','SYS%')
                    ->where('TGL_TRANS',date('Y-m-d',strtotime($request->tgl_trans)))
                    ->delete();
            $saldodep = DB::select("SELECT SUM(SALDO_TRANS) as saldo_trans FROM deptrans WHERE NO_REKENING='$request->no_rekening' AND (MY_KODE_TRANS='0' OR MY_KODE_TRANS='1')
            ")[0]->saldo_trans;
            $titipan = DB::select("SELECT SUM(SALDO_TRANS) as saldo_trans FROM deptrans WHERE NO_REKENING='$request->no_rekening' AND (MY_KODE_TRANS='100')
            ")[0]->saldo_trans;
            Deposito::where('NO_REKENING',$request->no_rekening)->update([
                'JML_DEPOSITO' => $saldodep,
                'SALDO_SETORAN'=>$saldodep,
                'SALDO_AKHIR' => $saldodep,
                'TITIPAN_TAMBAH' => $titipan,
                'TITIPAN_AMBIL' => $titipan,
                'BUNGA_YMH' => 0
            ]);
        }

        return redirect()->route('frmhapustrsdeposito')->with('alert', 'Transaksi Deposito 
         '.$request->no_rekening.' Sudah di Hapus');
    }
    // SHow form hitung bunga
    public function bo_dp_de_hitungbunga()
    {
        $logos = Logo::all();
        $users = User::all();
        
        return view ('admin.deposito.frmhitungbungadep',['logos'=>$logos, 'users'=>$users,'msgstatus'=>'']);

    }
   // proses hitung bunga DEPOSITO
   public function bo_tb_de_hitungbungadep(Request $request)
   {
        // METODE HITUUNG BUNGA : BUNGA  ATAU BAGIHASIL
        $methitbng=DB::select("SELECT KeyName,Value FROM mysysid WHERE KeyName like 'DEP_MET%HIT%'")[0]->Value;
        // Hitung PAJAK Berdasarkan APA ? : NASABAH_ID OR NO_REKEKNING
        $methitpjk=DB::select("SELECT KeyName,Value FROM mysysid WHERE KeyName like 'DEP_%HIT%PAJAK_%'")[0]->Value;
        // SALDO MINIMUM TERKENA PAJAK
        $depsalmin=DB::select("SELECT KeyName,Value FROM mysysid WHERE KeyName like 'DEP_SALDO_%'")[0]->Value;
        // METODE PEMBULATAN BUNGA ROUND / FLOOR
        $depbulatbng = DB::select("SELECT KeyName,Value FROM mysysid WHERE KeyName like 'DEP_METODE%PEMBULATAN%'")[0]->Value;
        //VERSI PERHITUNGAN BUNGA : RATA2_BULANAN / RATA2 TAHUNAN
        $depversi = DB::select("SELECT KeyName,Value FROM mysysid WHERE KeyName like 'DEP_VERSI%'")[0]->Value;
        // DIGIT DIBELAKANG KOMA
        $depdigit = DB::select("SELECT KeyName,Value FROM mysysid WHERE KeyName like 'DEP%DIGIT%'")[0]->Value;
        // JUMLAH HARI DALAM SETAHUN
        $jmlhr1tahun = DB::select("SELECT * FROM mysysid WHERE KeyName ='DEP_JML_HARI_SETAHUN'")[0]->Value;
        // Cek Jika ada Deposito yang belum diaktifasi
        $cek = Deposito::where('STATUS_AKTIF',1)->get();
        if(count($cek)>0)
        {
            return redirect()->route('showhitungbungadep')->with('alert','Masih Terdapat Data Yang Belum AKTIF :'.$cek[0]->NO_REKENING);
        }
        // Cek Jika ada Deposito yang belum DIPERPANJANG
        $tglcek = (int)date('m',strtotime($request->tahun.'-'.substr($request->bulan,0,2).'-'.substr($request->bulan,2,4)));

        $cekaro = DB::select("select tgl_jt from deposito where month(tgl_jt)<".$tglcek);
        if(count($cekaro)>0)
        {
            return redirect()->route('showhitungbungadep')->with('alert','Masih Terdapat Data Yang Belum DIPERPANJANG');
        }
        // JUMLAH HARI DALAM SETAHUN
        $jumlahharidlmthn=0;
        if($jmlhr1tahun=='SESUAI_TAHUN')
        {
            $tahun =0;
            if(substr($request->bulan,0,2)=='01')
            {
                $tahun =date('Y')-1;
            }else{
                $tahun =date('Y');
            }
            if(cal_days_in_month(CAL_GREGORIAN,2,$tahun)==28){
                $jumlahharidlmthn=365;
            }else{
                $jumlahharidlmthn=366;
            }
        }elseif($jmlhr1tahun=='365'){
            $jumlahharidlmthn=365;
        }else{
            $jumlahharidlmthn=360;
        }

        // PROSES HITUNG BUNGA dengan Query agar Tidak Memnghitung BUNGA berulang bagi yg sudah diberi BUNGA
        $datahitung =  DB::select("SELECT deposito.* FROM deposito LEFT JOIN (SELECT NO_REKENING FROM deptrans WHERE MONTH(deptrans.TGL_TRANS)=".(int)substr($request->bulan,0,2)." AND YEAR(deptrans.TGL_TRANS)=".(int)$request->tahun.") as x ON deposito.NO_REKENING=x.NO_REKENING WHERE (x.NO_REKENING) IS NULL");
        if(count($datahitung)==0){
            return redirect()->route('showhitungbungadep')->with('alert','BULAN '.substr($request->bulan,0,2).' SUDAH DIBERIKAN BUNGA/JASA');
        }
        foreach($datahitung as $values)
        {
            // nilai awal pajak
            $persenpjk =0;
            $total=0;
            // ambil nilai nasabah_id
            $nasabahid = $values->NASABAH_ID;
            // ambil nilai no_rekening
            $norekening = $values->NO_REKENING;
            $saldoakhir = $values->SALDO_AKHIR;
            $skbng = $values->SUKU_BUNGA;
            // proses hitung total account TABUNGAN dan DEPOSITO 
            $sldtab = DB::select("SELECT SUM(IF(MY_KODE_TRANS like '1%',SALDO_TRANS,0)-IF(MY_KODE_TRANS like '2%',SALDO_TRANS,0)) as saldoakhir from tabtrans INNER JOIN tabung ON tabtrans.NO_REKENING=tabung.NO_REKENING WHERE tabung.NASABAH_ID='$nasabahid'")[0]->saldoakhir;
            $slddep = DB::select("select sum(saldo_akhir) as saldo_akhir from deposito WHERE nasabah_id='$nasabahid'")[0]->saldo_akhir;
            // CEK KONFIGURASI METODE PERHITUNGAN PAJAK BERDASAR NASABAAH_ID/NO_REKEKNING
            if(str_replace(' ','',$methitpjk)=='NASABAH_ID')
            {
                $total = $sldtab+$slddep;
            }elseif(str_replace(' ','',$methitpjk)=='NO_REKENING')
            {
                $total = $saldoakhir;
            }
            // CEK SALDO TERKENA PAJAK ATAU TIDAK
            if((int)$total>=(int)$depsalmin)
            {
                $persenpjk = (int)$values->PERSEN_PPH*1/100;
            }
            // HITUNG BUNGA
            if($depversi=='RATA_RATA_BULANAN')
            {
                if($depbulatbng=='ROUND')
                {
                    $jmlbng = Round($saldoakhir*$skbng/12*1/100,(int)$depdigit);
                }elseif($depbulatbng=='FLOOR')
                {
                    $jmlbng = Floor($saldoakhir*$skbng/12*1/100);
                }
                $jmlpajak = $jmlbng*$persenpjk;

            }elseif($depversi=='RATA_RATA_TAHUNAN')
            {
                $jmlhari=(strtotime($values->TGL_JT)-strtotime($values->TGL_REGISTRASI))/60/60/24;
                if($values->JKW>1)
                {
                    $bln = (int)substr($request->bulan,0,2);
                    switch ($bln)
                    {
                        case 1:
                            $jmlhari=31;
                            break;
                        case 2:
                            $jmlhari=31;
                            break;
                        case 3:
                            $jmlhari=28;
                            break;
                        case 4:
                            $jmlhari=31;
                            break;
                        case 5:
                            $jmlhari=30;
                            break;
                        case 6:
                            $jmlhari=31;
                            break;
                        case 7:
                            $jmlhari=30;
                            break;
                        case 8:
                            $jmlhari=31;
                            break;
                        case 9:
                            $jmlhari=31;
                            break;
                        case 10:
                            $jmlhari=30;
                            break;
                        case 11:
                            $jmlhari=31;
                            break;
                        case 12:
                            $jmlhari=30;
                            break;
                    }
                }
                if($depbulatbng=='ROUND')
                {
                    $jmlbng = Round($saldoakhir*$skbng*1/100*$jmlhari*1/$jumlahharidlmthn,(int)$depdigit);
                }elseif($depbulatbng=='FLOOR')
                {
                    $jmlbng = Floor($saldoakhir*$skbng*1/100*$jmlhari*1/$jumlahharidlmthn);
                }
                $jmlpajak = $jmlbng*$persenpjk; 

            }
            // MENCEGAH PERHITUNGAN BUNGA DIBERIKAN SALAH
            $cekbulan=date('m',strtotime($values->TGL_REGISTRASI));
            $cektahun=date('Y',strtotime($values->TGL_REGISTRASI));

            if($cekbulan==substr($request->bulan,0,2) AND $cektahun==$request->tahun)
            {
                $jmlbng=0;$jmlpajak=0;
            }elseif((int)$cekbulan>(int)substr($request->bulan,0,2) AND $cektahun>=$request->tahun){
                $jmlbng=0;$jmlpajak=0;
            }
            Deposito::where('NO_REKENING',$norekening)->update(
                [
                    'BUNGA_BLN_INI'=>$jmlbng,
                    'PAJAK_BLN_INI'=>$jmlpajak,
                    'BUNGA_YMH'=>($jmlbng-$jmlpajak)
                ]
            );
        }
        return redirect()->route('showhitungbungadep')->with('alert','PERHITUNGAN BUNGA SELESAI');
   }
   //show form browese bunga and pajak deposito 
   public function bo_dp_de_browsebunga()
   {
        $logos = Logo::all();
        $users = User::all();
        $brwsebngpjk = Deposito::with('nasabah')->where('STATUS_AKTIF',2)->OrderBy('NO_REKENING')->get();
        return view('admin.deposito.frmbrowsebunga',['users'=>$users,'logos'=>$logos,'brwsebngpjk'=>$brwsebngpjk,'msgstatus'=>'']);
   }
   //Simpan perubbahan deposito
   public function bo_dep_update_bngpjk(Request $request)
   {
        $this->validate($request,[
            "no_rekening" => "required",
            "bunga_bln_ini" => "required|numeric|min:0",
            "pajak_bln_ini" => "required|numeric|min:0"
        ]);
        Deposito::where('NO_REKENING',$request->no_rekening)->update(
            [
                'BUNGA_BLN_INI' => $request->bunga_bln_ini,
                'PAJAK_BLN_INI' => $request->pajak_bln_ini
            ]
        );
        return redirect()->route('showbrowsebungadp')->with('alert','Update Bunga/Pajak Berhasil');
   }
    //Export Browse BUnga Pajak Deposito
    public function exportbngpjkdeposito()
    {
        $sql = "select *,nasabah.nama_nasabah from deposito inner join nasabah on deposito.nasabah_id=nasabah.nasabah_id";
        $rs = DB::select($sql);
        // dd($rs);
        return (new ReportDepbungapajakExport($rs))->download('bungadesp.xlsx');
    }    
    // Show form OVB Bunga Deposito
    public function bo_dp_de_overbookbunga()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetransdep = KodeTransDeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        return view('admin.deposito.frmoverbookbungadep',['users' => $users, 'logos' => $logos, 'kodetransdep' => $kodetransdep, 'kodetranstab'=>$kodetranstab,'tgllogin'=>$tgllogin,'msgstatus'=>'']);
    }
    // proses simpan data overbook deposito
    public function bo_dp_de_overbookbngdep(Request $request)
    {
        if($request->yatidak=='Tidak')
        {
            $cek = DB::select("select tgl_trans from deptrans where tgl_trans='$request->tgl_trans' AND kuitansi like 'SYS%'");

            $data = DB::select("select deposito.*,nasabah.nama_nasabah as nama from deposito inner join nasabah on deposito.nasabah_id=nasabah.nasabah_id where deposito.tgl_valuta<= ".(int)date('d',strtotime($request->tgl_trans))." AND deposito.bunga_bln_ini>0 AND deposito.status_aktif=2");
            // dd($data);
            foreach($data as $values)
            {
                if($values->MASUK_TITIPAN == 1 && $values->BUNGA_BERBUNGA == 0)
                {
                    $x=strlen($request->kode_trs_titipan)-1;
                    $y=strlen($request->kode_trs_titipan);
                    $simpantrstitip = new Deptran();
                    $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                    $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                    $simpantrstitip->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                    $simpantrstitip->SALDO_TRANS = $values->BUNGA_BLN_INI;
                    $simpantrstitip->MY_KODE_TRANS = 100;
                    $simpantrstitip->KUITANSI = 'SYS-BNG';
                    $simpantrstitip->USERID = Auth::id();
                    $simpantrstitip->TOB = substr($request->kode_trs_titipan,$x,$y);
                    $simpantrstitip->POSTED = 0;
                    $simpantrstitip->VALIDATED = 1;
                    $simpantrstitip->save();
                    // PROSES SIMPAN PAJAK JIKA ADA
                    if($values->PAJAK_BLN_INI>0)
                    {
                        $simpantrstitip = new Deptran();
                        $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                        $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                        $simpantrstitip->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                        $simpantrstitip->SALDO_TRANS = $values->PAJAK_BLN_INI;
                        $simpantrstitip->MY_KODE_TRANS = 475;
                        $simpantrstitip->KUITANSI = 'SYS-BNG';
                        $simpantrstitip->USERID = Auth::id();
                        $simpantrstitip->TOB = substr($request->kode_trs_titipan,$x,$y);
                        $simpantrstitip->POSTED = 0;
                        $simpantrstitip->VALIDATED = 1;
                        $simpantrstitip->save();
                    }
                    // PROSES UPDATE DEPOSITO 
                    Deposito::where('NO_REKENING',$values->NO_REKENING)->update([
                        'TITIPAN_TAMBAH'=>($values->BUNGA_BLN_INI+$values->TITIPAN_TAMBAH),
                        'TITIPAN_AMBIL'=>($values->PAJAK_BLN_INI+$values->TITIPAN_AMBIL),
                        'TITIPAN_AKHIR'=>(($values->BUNGA_BLN_INI+$values->TITIPAN_TAMBAH)-($values->PAJAK_BLN_INI+$values->TITIPAN_AMBIL)),
                        'BUNGA_YMH' => ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI),
                        'BUNGA_BLN_INI' => 0,
                        'PAJAK_BLN_INI' => 0,
                    ]);
                }
                elseif(strlen(str_replace(' ','',$values->NO_REK_TABUNGAN)) > 0)
                {
                    // Ambil nama naabah tabungan
                    $rektab = DB::select("select nasabah.nama_nasabah as nama from nasabah inner join tabung on nasabah.nasabah_id=tabung.nasabah_id where tabung.no_rekening ='$values->NO_REK_TABUNGAN'");
                    $x=strlen($request->kode_trs_titipan)-1;
                    $y=strlen($request->kode_trs_titipan);
                    // Simpan data di DPTRANS
                    $simpantrstab = new Deptran();
                    $simpantrstab->TGL_TRANS = $request->tgl_trans;
                    $simpantrstab->NO_REKENING = $values->NO_REKENING;
                    $simpantrstab->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                    $simpantrstab->SALDO_TRANS = $values->BUNGA_BLN_INI;
                    $simpantrstab->MY_KODE_TRANS = 250;
                    $simpantrstab->KUITANSI = 'SYS-BNG';
                    $simpantrstab->USERID = Auth::id();
                    $simpantrstab->TOB = substr($request->kode_trs_titipan,$x,$y);
                    $simpantrstab->POSTED = 0;
                    $simpantrstab->VALIDATED = 1;
                    $simpantrstab->NO_REK_OB = $values->NO_REK_TABUNGAN;
                    $simpantrstab->save();

                    if($values->PAJAK_BLN_INI>0)
                    {
                        $simpantrstab = new Deptran();
                        $simpantrstab->TGL_TRANS = $request->tgl_trans;
                        $simpantrstab->NO_REKENING = $values->NO_REKENING;
                        $simpantrstab->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                        $simpantrstab->SALDO_TRANS = $values->PAJAK_BLN_INI;
                        $simpantrstab->MY_KODE_TRANS = 450;
                        $simpantrstab->KUITANSI = 'SYS-BNG';
                        $simpantrstab->USERID = Auth::id();
                        $simpantrstab->TOB = substr($request->kode_trs_titipan,$x,$y);
                        $simpantrstab->POSTED = 0;
                        $simpantrstab->VALIDATED = 1;
                        $simpantrstab->NO_REK_OB = $values->NO_REK_TABUNGAN;
                        $simpantrstab->save();
                    }
                    // Simapan ditabel TABTRANS 
                        // ambil kode trans 
                    $x=strlen($request->kode_trs_tab)-1;
                    $y=strlen($request->kode_trs_tab);

                    $savetabtrans = new Tabtran();
                    $savetabtrans->TGL_TRANS = $request->tgl_trans;
                    $savetabtrans->NO_REKENING = $values->NO_REK_TABUNGAN;
                    $savetabtrans->KODE_TRANS = substr($request->kode_trs_tab,0,$x);
                    $savetabtrans->SALDO_TRANS = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $savetabtrans->MY_KODE_TRANS = 175;
                    $savetabtrans->KUITANSI = 'SYS-BNG'.$values->NO_REKENING;
                    $savetabtrans->USERID = Auth::id();
                    $savetabtrans->TOB = substr($request->kode_trs_tab,$x,$y);
                    $savetabtrans->USERID = Auth::id();
                    $savetabtrans->POSTED = 1;
                    $savetabtrans->VALIDATED = 1;
                    $savetabtrans->KETERANGAN = 'SYS-BNG'.$values->NO_REKENING;
                    $savetabtrans->LINK_REKENING = $values->NO_REKENING;
                    $savetabtrans->save();
                    $linktellerid = $savetabtrans->TABTRANS_ID;
                    // UPDATE TABUNG 
                    DB::select("update tabung set saldo_setoran = saldo_setoran+".($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI).",saldo_akhir=(saldo_awal+saldo_setoran-saldo_penarikan+".($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI).") where no_rekening="."'".$values->NO_REK_TABUNGAN."'");
                    // Simpan trans TLLERTRANS
                    $savetellertr = new Tellertran();
                    $savetellertr->modul = 'TAB';
                    $savetellertr->tgl_trans = $request->tgl_trans;
                    $savetellertr->NO_BUKTI = 'SYS-ARO';
                    $savetellertr->uraian = "OB/PB Bunga Deposito :#".$values->NO_REKENING." Ke Tabungan :#".$values->NO_REK_TABUNGAN."-".$rektab[0]->nama;
                    $savetellertr->my_kode_trans = 200;
                    $savetellertr->saldo_trans = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $savetellertr->tob = substr($request->kode_trs_tab,$x,$y);
                    $savetellertr->modul_trans_id = $linktellerid;
                    $savetellertr->userid = Auth::id();
                    $savetellertr->VALIDATED = 0;
                    $savetellertr->POSTED = 0;
                    $savetellertr->cab = '001';
                    $savetellertr->save();
                    // PROSES UPDATE DEPOSITO 
                    Deposito::where('NO_REKENING',$values->NO_REKENING)->update([
                        'BUNGA_YMH' => ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI),
                        'BUNGA_BLN_INI' => 0,
                        'PAJAK_BLN_INI' => 0
                    ]);

                }elseif($values->BUNGA_BERBUNGA==1)
                {
                    // ambil nilai kode trans titipan
                    $x=strlen($request->kode_trs_titipan)-1;
                    $y=strlen($request->kode_trs_titipan);
                    $simpantrstitip = new Deptran();
                    $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                    $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                    $simpantrstitip->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                    $simpantrstitip->SALDO_TRANS = $values->BUNGA_BLN_INI;
                    $simpantrstitip->MY_KODE_TRANS = 100;
                    $simpantrstitip->KUITANSI = 'SYS-BNG';
                    $simpantrstitip->USERID = Auth::id();
                    $simpantrstitip->TOB = substr($request->kode_trs_titipan,$x,$y);
                    $simpantrstitip->POSTED = 0;
                    $simpantrstitip->VALIDATED = 1;
                    $simpantrstitip->save();
                    if($values->PAJAK_BLN_INI>0)
                    {
                        $simpantrstitip = new Deptran();
                        $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                        $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                        $simpantrstitip->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                        $simpantrstitip->SALDO_TRANS = $values->PAJAK_BLN_INI;
                        $simpantrstitip->MY_KODE_TRANS = 475;
                        $simpantrstitip->KUITANSI = 'SYS-BNG';
                        $simpantrstitip->USERID = Auth::id();
                        $simpantrstitip->TOB = substr($request->kode_trs_titipan,$x,$y);
                        $simpantrstitip->POSTED = 0;
                        $simpantrstitip->VALIDATED = 1;
                        $simpantrstitip->save();
                    }
                    // prose simpan bunga masuk pokok 
                    // PROSES KE 1
                    $x=strlen($request->kode_trs_aro)-1;
                    $y=strlen($request->kode_trs_aro);

                    $simpantrstitip = new Deptran();
                    $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                    $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                    $simpantrstitip->KODE_TRANS = substr($request->kode_trs_aro,0,$x);
                    $simpantrstitip->SALDO_TRANS = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $simpantrstitip->MY_KODE_TRANS = 1;
                    $simpantrstitip->KUITANSI = 'SYS-ARO';
                    $simpantrstitip->USERID = Auth::id();
                    $simpantrstitip->TOB = substr($request->kode_trs_aro,$x,$y);
                    $simpantrstitip->POSTED = 0;
                    $simpantrstitip->VALIDATED = 1;
                    $simpantrstitip->save();
                    $linktellerproses1 = $simpantrstitip->DEPTRANS_ID;
                    // PROSES KE 2
                    $simpantrstitip = new Deptran();
                    $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                    $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                    $simpantrstitip->KODE_TRANS = 99;
                    $simpantrstitip->SALDO_TRANS = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $simpantrstitip->MY_KODE_TRANS = 277;
                    $simpantrstitip->KUITANSI = 'SYS-ARO';
                    $simpantrstitip->USERID = Auth::id();
                    $simpantrstitip->TOB = substr($request->kode_trs_aro,$x,$y);
                    $simpantrstitip->POSTED = 1;
                    $simpantrstitip->VALIDATED = 1;
                    $simpantrstitip->save();
                    $linktellerproses2 = $simpantrstitip->DEPTRANS_ID;

                    // PROSES 1 SIMPAN bunga ber bunga di tellertrans
                    $savetellertr = new Tellertran();
                    $savetellertr->modul = 'DEP';
                    $savetellertr->tgl_trans = $request->tgl_trans;
                    $savetellertr->NO_BUKTI = 'SYS-ARO';
                    $savetellertr->uraian = "OB Penerimaan Deposito : #".$values->NO_REKENING."-".str_replace(' ','',$values->nama)." Dari GL";
                    $savetellertr->my_kode_trans = 200;
                    $savetellertr->saldo_trans = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $savetellertr->tob = substr($request->kode_trs_aro,$x,$y);
                    $savetellertr->modul_trans_id = $linktellerproses1;
                    $savetellertr->userid = Auth::id();
                    $savetellertr->VALIDATED = 0;
                    $savetellertr->POSTED = 0;
                    $savetellertr->cab = '001';
                    $savetellertr->save();
                    // PROSES 2 SIMPAN bunga ber bunga di tellertrans
                    $savetellertr = new Tellertran();
                    $savetellertr->modul = 'DEP';
                    $savetellertr->tgl_trans = $request->tgl_trans;
                    $savetellertr->NO_BUKTI = 'SYS-ARO';
                    $savetellertr->uraian = "OB Titipan Bunga Deposito: ".$values->NO_REKENING."-".str_replace(' ','',$values->nama)." ke deposito";
                    $savetellertr->my_kode_trans = 300;
                    $savetellertr->saldo_trans = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $savetellertr->tob = substr($request->kode_trs_aro,$x,$y);
                    $savetellertr->modul_trans_id = $linktellerproses2;
                    $savetellertr->userid = Auth::id();
                    $savetellertr->VALIDATED = 0;
                    $savetellertr->POSTED = 0;
                    $savetellertr->cab = '001';
                    $savetellertr->save();
                    // PROSES UPDATE DEPOSITO 
                    Deposito::where('NO_REKENING',$values->NO_REKENING)->update([
                        'JML_DEPOSITO'=>(($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI)+$values->JML_DEPOSITO),
                        'SALDO_SETORAN'=>(($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI)+$values->SALDO_SETORAN),
                        'SALDO_AKHIR'=>(($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI)+$values->SALDO_AKHIR),
                        'TITIPAN_TAMBAH'=>(($values->BUNGA_BLN_INI+$values->TITIPAN_TAMBAH)),
                        'TITIPAN_AMBIL'=>(($values->BUNGA_BLN_INI+$values->TITIPAN_AMBIL)),
                        'BUNGA_YMH' => ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI),
                        'BUNGA_BLN_INI' => 0,
                        'PAJAK_BLN_INI' => 0
                    ]);
                }
            }
        }
        else
        {
            $cek = DB::select("select tgl_trans from deptrans where tgl_trans='$request->tgl_trans' AND kuitansi like 'SYS%'");
            if(count($cek)>0){
                return redirect()->route('showhitungbungadep')->with('alert','Transaksi Untuk Tanggal '.$request->tgl_trans.' Sudah Pernah dilakukan');
            }
            $data = DB::select("select deposito.*,nasabah.nama_nasabah as nama from deposito inner join nasabah on deposito.nasabah_id=nasabah.nasabah_id where deposito.bunga_bln_ini>0 AND deposito.status_aktif=2");
            foreach($data as $values)
            {
                if($values->MASUK_TITIPAN == 1 && $values->BUNGA_BERBUNGA == 0)
                {
                    $x=strlen($request->kode_trs_titipan)-1;
                    $y=strlen($request->kode_trs_titipan);
                    $simpantrstitip = new Deptran();
                    $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                    $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                    $simpantrstitip->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                    $simpantrstitip->SALDO_TRANS = $values->BUNGA_BLN_INI;
                    $simpantrstitip->MY_KODE_TRANS = 100;
                    $simpantrstitip->KUITANSI = 'SYS-BNG';
                    $simpantrstitip->USERID = Auth::id();
                    $simpantrstitip->TOB = substr($request->kode_trs_titipan,$x,$y);
                    $simpantrstitip->POSTED = 0;
                    $simpantrstitip->VALIDATED = 1;
                    $simpantrstitip->save();
                    // PROSES SIMPAN PAJAK JIKA ADA
                    if($values->PAJAK_BLN_INI>0)
                    {
                        $simpantrstitip = new Deptran();
                        $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                        $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                        $simpantrstitip->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                        $simpantrstitip->SALDO_TRANS = $values->PAJAK_BLN_INI;
                        $simpantrstitip->MY_KODE_TRANS = 475;
                        $simpantrstitip->KUITANSI = 'SYS-BNG';
                        $simpantrstitip->USERID = Auth::id();
                        $simpantrstitip->TOB = substr($request->kode_trs_titipan,$x,$y);
                        $simpantrstitip->POSTED = 0;
                        $simpantrstitip->VALIDATED = 1;
                        $simpantrstitip->save();
                    }
                    // PROSES UPDATE DEPOSITO 
                    Deposito::where('NO_REKENING',$values->NO_REKENING)->update([
                        'TITIPAN_TAMBAH'=>($values->BUNGA_BLN_INI+$values->TITIPAN_TAMBAH),
                        'TITIPAN_AMBIL'=>($values->PAJAK_BLN_INI+$values->TITIPAN_AMBIL),
                        'TITIPAN_AKHIR'=>(($values->BUNGA_BLN_INI+$values->TITIPAN_TAMBAH)-($values->PAJAK_BLN_INI+$values->TITIPAN_AMBIL)),
                        'BUNGA_YMH' => ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI),
                        'BUNGA_BLN_INI' => 0,
                        'PAJAK_BLN_INI' => 0,
                    ]);
                }
                elseif(strlen(str_replace(' ','',$values->NO_REK_TABUNGAN)) > 0)
                {
                    // Ambil nama naabah tabungan
                    $rektab = DB::select("select nasabah.nama_nasabah as nama from nasabah inner join tabung on nasabah.nasabah_id=tabung.nasabah_id where tabung.no_rekening ='$values->NO_REK_TABUNGAN'");
                    $x=strlen($request->kode_trs_titipan)-1;
                    $y=strlen($request->kode_trs_titipan);
                    // Simpan data di DPTRANS
                    $simpantrstab = new Deptran();
                    $simpantrstab->TGL_TRANS = $request->tgl_trans;
                    $simpantrstab->NO_REKENING = $values->NO_REKENING;
                    $simpantrstab->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                    $simpantrstab->SALDO_TRANS = $values->BUNGA_BLN_INI;
                    $simpantrstab->MY_KODE_TRANS = 250;
                    $simpantrstab->KUITANSI = 'SYS-BNG';
                    $simpantrstab->USERID = Auth::id();
                    $simpantrstab->TOB = substr($request->kode_trs_titipan,$x,$y);
                    $simpantrstab->POSTED = 0;
                    $simpantrstab->VALIDATED = 1;
                    $simpantrstab->NO_REK_OB = $values->NO_REK_TABUNGAN;
                    $simpantrstab->save();

                    if($values->PAJAK_BLN_INI>0)
                    {
                        $simpantrstab = new Deptran();
                        $simpantrstab->TGL_TRANS = $request->tgl_trans;
                        $simpantrstab->NO_REKENING = $values->NO_REKENING;
                        $simpantrstab->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                        $simpantrstab->SALDO_TRANS = $values->PAJAK_BLN_INI;
                        $simpantrstab->MY_KODE_TRANS = 450;
                        $simpantrstab->KUITANSI = 'SYS-BNG';
                        $simpantrstab->USERID = Auth::id();
                        $simpantrstab->TOB = substr($request->kode_trs_titipan,$x,$y);
                        $simpantrstab->POSTED = 0;
                        $simpantrstab->VALIDATED = 1;
                        $simpantrstab->NO_REK_OB = $values->NO_REK_TABUNGAN;
                        $simpantrstab->save();
                    }
                    // Simapan ditabel TABTRANS 
                        // ambil kode trans 
                    $x=strlen($request->kode_trs_tab)-1;
                    $y=strlen($request->kode_trs_tab);

                    $savetabtrans = new Tabtran();
                    $savetabtrans->TGL_TRANS = $request->tgl_trans;
                    $savetabtrans->NO_REKENING = $values->NO_REK_TABUNGAN;
                    $savetabtrans->KODE_TRANS = substr($request->kode_trs_tab,0,$x);
                    $savetabtrans->SALDO_TRANS = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $savetabtrans->MY_KODE_TRANS = 175;
                    $savetabtrans->KUITANSI = 'SYS-BNG'.$values->NO_REKENING;
                    $savetabtrans->USERID = Auth::id();
                    $savetabtrans->TOB = substr($request->kode_trs_tab,$x,$y);
                    $savetabtrans->USERID = Auth::id();
                    $savetabtrans->POSTED = 1;
                    $savetabtrans->VALIDATED = 1;
                    $savetabtrans->KETERANGAN = 'SYS-BNG'.$values->NO_REKENING;
                    $savetabtrans->LINK_REKENING = $values->NO_REKENING;
                    $savetabtrans->save();
                    $linktellerid = $savetabtrans->TABTRANS_ID;
                    // UPDATE TABUNG 
                    DB::select("update tabung set saldo_setoran = saldo_setoran+".($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI).",saldo_akhir=(saldo_awal+saldo_setoran-saldo_penarikan+".($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI).") where no_rekening="."'".$values->NO_REK_TABUNGAN."'");
                    // Simpan trans TLLERTRANS
                    $savetellertr = new Tellertran();
                    $savetellertr->modul = 'TAB';
                    $savetellertr->tgl_trans = $request->tgl_trans;
                    $savetellertr->NO_BUKTI = 'SYS-ARO';
                    $savetellertr->uraian = "OB/PB Bunga Deposito :#".$values->NO_REKENING." Ke Tabungan :#".$values->NO_REK_TABUNGAN."-".$rektab[0]->nama;
                    $savetellertr->my_kode_trans = 200;
                    $savetellertr->saldo_trans = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $savetellertr->tob = substr($request->kode_trs_tab,$x,$y);
                    $savetellertr->modul_trans_id = $linktellerid;
                    $savetellertr->userid = Auth::id();
                    $savetellertr->VALIDATED = 0;
                    $savetellertr->POSTED = 0;
                    $savetellertr->cab = '001';
                    $savetellertr->save();
                    // PROSES UPDATE DEPOSITO 
                    Deposito::where('NO_REKENING',$values->NO_REKENING)->update([
                        'BUNGA_YMH' => ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI),
                        'BUNGA_BLN_INI' => 0,
                        'PAJAK_BLN_INI' => 0
                    ]);

                }elseif($values->BUNGA_BERBUNGA==1)
                {
                    // ambil nilai kode trans titipan
                    $x=strlen($request->kode_trs_titipan)-1;
                    $y=strlen($request->kode_trs_titipan);
                    $simpantrstitip = new Deptran();
                    $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                    $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                    $simpantrstitip->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                    $simpantrstitip->SALDO_TRANS = $values->BUNGA_BLN_INI;
                    $simpantrstitip->MY_KODE_TRANS = 100;
                    $simpantrstitip->KUITANSI = 'SYS-BNG';
                    $simpantrstitip->USERID = Auth::id();
                    $simpantrstitip->TOB = substr($request->kode_trs_titipan,$x,$y);
                    $simpantrstitip->POSTED = 0;
                    $simpantrstitip->VALIDATED = 1;
                    $simpantrstitip->save();
                    if($values->PAJAK_BLN_INI>0)
                    {
                        $simpantrstitip = new Deptran();
                        $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                        $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                        $simpantrstitip->KODE_TRANS = substr($request->kode_trs_titipan,0,$x);
                        $simpantrstitip->SALDO_TRANS = $values->PAJAK_BLN_INI;
                        $simpantrstitip->MY_KODE_TRANS = 475;
                        $simpantrstitip->KUITANSI = 'SYS-BNG';
                        $simpantrstitip->USERID = Auth::id();
                        $simpantrstitip->TOB = substr($request->kode_trs_titipan,$x,$y);
                        $simpantrstitip->POSTED = 0;
                        $simpantrstitip->VALIDATED = 1;
                        $simpantrstitip->save();
                    }
                    // prose simpan bunga masuk pokok 
                    // PROSES KE 1
                    $x=strlen($request->kode_trs_aro)-1;
                    $y=strlen($request->kode_trs_aro);

                    $simpantrstitip = new Deptran();
                    $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                    $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                    $simpantrstitip->KODE_TRANS = substr($request->kode_trs_aro,0,$x);
                    $simpantrstitip->SALDO_TRANS = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $simpantrstitip->MY_KODE_TRANS = 1;
                    $simpantrstitip->KUITANSI = 'SYS-ARO';
                    $simpantrstitip->USERID = Auth::id();
                    $simpantrstitip->TOB = substr($request->kode_trs_aro,$x,$y);
                    $simpantrstitip->POSTED = 0;
                    $simpantrstitip->VALIDATED = 1;
                    $simpantrstitip->save();
                    $linktellerproses1 = $simpantrstitip->DEPTRANS_ID;
                    // PROSES KE 2
                    $simpantrstitip = new Deptran();
                    $simpantrstitip->TGL_TRANS = $request->tgl_trans;
                    $simpantrstitip->NO_REKENING = $values->NO_REKENING;
                    $simpantrstitip->KODE_TRANS = 99;
                    $simpantrstitip->SALDO_TRANS = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $simpantrstitip->MY_KODE_TRANS = 277;
                    $simpantrstitip->KUITANSI = 'SYS-ARO';
                    $simpantrstitip->USERID = Auth::id();
                    $simpantrstitip->TOB = substr($request->kode_trs_aro,$x,$y);
                    $simpantrstitip->POSTED = 1;
                    $simpantrstitip->VALIDATED = 1;
                    $simpantrstitip->save();
                    $linktellerproses2 = $simpantrstitip->DEPTRANS_ID;

                    // PROSES 1 SIMPAN bunga ber bunga di tellertrans
                    $savetellertr = new Tellertran();
                    $savetellertr->modul = 'DEP';
                    $savetellertr->tgl_trans = $request->tgl_trans;
                    $savetellertr->NO_BUKTI = 'SYS-ARO';
                    $savetellertr->uraian = "OB Penerimaan Deposito : #".$values->NO_REKENING."-".str_replace(' ','',$values->nama)." Dari GL";
                    $savetellertr->my_kode_trans = 200;
                    $savetellertr->saldo_trans = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $savetellertr->tob = substr($request->kode_trs_aro,$x,$y);
                    $savetellertr->modul_trans_id = $linktellerproses1;
                    $savetellertr->userid = Auth::id();
                    $savetellertr->VALIDATED = 0;
                    $savetellertr->POSTED = 0;
                    $savetellertr->cab = '001';
                    $savetellertr->save();
                    // PROSES 2 SIMPAN bunga ber bunga di tellertrans
                    $savetellertr = new Tellertran();
                    $savetellertr->modul = 'DEP';
                    $savetellertr->tgl_trans = $request->tgl_trans;
                    $savetellertr->NO_BUKTI = 'SYS-ARO';
                    $savetellertr->uraian = "OB Titipan Bunga Deposito: ".$values->NO_REKENING."-".str_replace(' ','',$values->nama)." ke deposito";
                    $savetellertr->my_kode_trans = 300;
                    $savetellertr->saldo_trans = ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI);
                    $savetellertr->tob = substr($request->kode_trs_aro,$x,$y);
                    $savetellertr->modul_trans_id = $linktellerproses2;
                    $savetellertr->userid = Auth::id();
                    $savetellertr->VALIDATED = 0;
                    $savetellertr->POSTED = 0;
                    $savetellertr->cab = '001';
                    $savetellertr->save();
                    // PROSES UPDATE DEPOSITO 
                    Deposito::where('NO_REKENING',$values->NO_REKENING)->update([
                        'JML_DEPOSITO'=>(($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI)+$values->JML_DEPOSITO),
                        'SALDO_SETORAN'=>(($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI)+$values->SALDO_SETORAN),
                        'SALDO_AKHIR'=>(($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI)+$values->SALDO_AKHIR),
                        'TITIPAN_TAMBAH'=>(($values->BUNGA_BLN_INI+$values->TITIPAN_TAMBAH)),
                        'TITIPAN_AMBIL'=>(($values->BUNGA_BLN_INI+$values->TITIPAN_AMBIL)),
                        'BUNGA_YMH' => ($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI),
                        'BUNGA_BLN_INI' => 0,
                        'PAJAK_BLN_INI' => 0
                    ]);
                }
            }

        }
        return redirect()->route('showformoverbookbunga')->with('alert', 'PROSES OVERBOOK BERHASIL');

    }
    // ADMINISTRATOR DEPOSITO 
    public function bo_dp_ad_produkdeposito()
    {
        $users = User::all();
        $logos = Logo::all();
        $jenisdep = KodeJenisDeposito::all();
        return view('admin.deposito.frmjenisdeposito',['users' => $users, 'logos' => $logos, 'jenisdep' => $jenisdep,'msgstatus'=>'']);
    }
    // Update Jenis Deposito
    public function bo_dp_ad_produkdeposito_put(Request $request)
    {
        $this->validate($request,[
            "kode_jenis_deposito" => "required",
            "deskripsi_jenis_deposito" => "required",
            "suku_bunga_default" => "required|numeric",
            "pph_default" => "required|numeric",
            "jkw_default" => "required|numeric",
            "flag_deposito" => "required",
            "type_suku_bunga" => "required"
        ]);
        KodeJenisDeposito::where('KODE_JENIS_DEPOSITO',$request->kode_jenis_deposito)
                    ->update(
                        [
                            'DESKRIPSI_JENIS_DEPOSITO'=>$request->deskripsi_jenis_deposito,
                            'SUKU_BUNGA_DEFAULT'=>$request->suku_bunga_default,
                            'PPH_DEFAULT'=>$request->pph_default,
                            'JKW_DEFAULT'=>$request->jkw_default,
                            'FLAG_DEPOSITO'=>$request->flag_deposito,
                            'TYPE_SUKU_BUNGA'=>$request->type_suku_bunga
                        ]);
        return redirect()->route('showformprodukdeposito')->with('alert','JENIS DEPOSITO '.$request->deskripsi_jenis_deposito.' BERHASIL DIUPDATE');
    }
    // ADD JENIS DEPOSITO
    public function bo_dp_ad_produkdeposito_add(Request $request)
    {
        $this->validate($request,[
            "kode_jenis_deposito" => "required|unique:kodejenisdeposito",
            "deskripsi_jenis_deposito" => "required",
            "suku_bunga_default" => "required|numeric",
            "pph_default" => "required|numeric",
            "jkw_default" => "required|numeric",
            "flag_deposito" => "required",
            "type_suku_bunga" => "required"
        ]);

        $simpan = new KodeJenisDeposito();
        $simpan->KODE_JENIS_DEPOSITO = $request->kode_jenis_deposito;
        $simpan->DESKRIPSI_JENIS_DEPOSITO = $request->deskripsi_jenis_deposito;
        $simpan->SUKU_BUNGA_DEFAULT = $request->suku_bunga_default;
        $simpan->PPH_DEFAULT = $request->pph_default;
        $simpan->JKW_DEFAULT = $request->jkw_default;
        $simpan->FLAG_DEPOSITO = $request->flag_deposito;
        $simpan->TYPE_SUKU_BUNGA = $request->type_suku_bunga;
        $simpan->save();
        return redirect()->route('showformprodukdeposito')->with('alert','JENIS DEPOSITO '.$request->deskripsi_jenis_deposito.' BERHASIL DITAMBAHKAN');

    }
    // delete kode jenis deposito 
    public function bo_dp_ad_produkdeposito_del(Request $request)
    {
        $rs = Deposito::where('JENIS_DEPOSITO',$request->kode_jenis_dep)->get();
        if(count($rs)>0){
            return redirect()->route('showformprodukdeposito')->with('alert','JENIS DEPOSITO MASIH DIPAKAI DI TABLE DEPOSITO');
        }
        KodeJenisDeposito::where('KODE_JENIS_DEPOSITO',$request->kode_jenis_dep)->delete();
        
        return redirect()->route('showformprodukdeposito')->with('alert','KODE JENIS DEPOSITO BERHASIL DIHAPUS');
    }
    // Show automatic rollover
    public function bo_dp_de_autorollover()
    {
        $users = User::all();
        $logos = Logo::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));

        return view('admin.deposito.frmautorollover',['users' => $users, 'logos' => $logos,'tgllogin'=>$tgllogin,'msgstatus'=>'']);

    }
    // proses automatic roll over
    public function bo_dp_de_autorollover_upd(Request $request)
    {
        // AMBIL TGL LOGIN
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        
        $cek = Deposito::where('STATUS_AKTIF',1)->get();
        if(count($cek)>0)
        {
            return redirect()->route('showhitungbungadep')->with('alert','Masih Terdapat Data Yang Belum AKTIF :'.$cek[0]->NO_REKENING);
        }
        // PROSES ROLL OVER
        $rs = Deposito::all();
        foreach($rs as $values)
        {
            if($values->TGL_JT <=$tgllogin)
            {
                $x = $values->JKW;

                $datetgljt = date('Y-m-d', strtotime("+".$x." months", strtotime($values->TGL_JT)));
                Deposito::where('NO_REKENING',$values->NO_REKENING)->update(
                    [
                        'TGL_REGISTRASI'=>$values->TGL_JT,
                        'TGL_JT'=>$datetgljt,
                    ]
                );
            }
        }
        return redirect()->route('showformrollover')->with('alert','PROSE AUTOMATIC ROLL OVER BERHASIL');
    }
    // FORM MANUAL ROLL OVER
    public function bo_dp_de_manrollover()
    {
        // AMBIL TGL LOGIN
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        
        $cek = Deposito::where('STATUS_AKTIF',1)->get();
        if(count($cek)>0)
        {
            return redirect()->route('showhitungbungadep')->with('alert','Masih Terdapat Data Yang Belum AKTIF :'.$cek[0]->NO_REKENING);
        }
        $users = User::all();
        $logos = Logo::all();

        $deposito = DB::select("select deposito.*,nasabah.nama_nasabah,nasabah.alamat from (deposito inner join nasabah on deposito.nasabah_id = nasabah.nasabah_id) inner join (SELECT NO_REKENING FROM deptrans WHERE MONTH(TGL_TRANS)=".date('m',strtotime($tgllogin))." AND YEAR(TGL_TRANS)=".date('Y',strtotime($tgllogin))." AND (MY_KODE_TRANS LIKE '1%' OR MY_KODE_TRANS LIKE '25%') AND KUITANSI LIKE '%BNG' ORDER BY DEPTRANS_ID) as trans on deposito.no_rekening=trans.NO_REKENING where deposito.tgl_jt<='$tgllogin'");

        return view('admin.deposito.frmmanualrollover',['users' => $users, 'logos' => $logos, 'deposito' =>$deposito,'msgstatus' =>'']);
    }
    // UPDATE MANUAL ROLL OVER
    public function bo_dp_de_manrollover_upd(Request $request)
    {
        Deposito::where('NO_REKENING',$request->no_rekening)->update(
            [
                'TGL_REGISTRASI' =>$request->tgl_registrasi_baru,
                'TGL_JT'=>$request->tgl_jt_baru
            ]
        );
        return redirect()->route('showformmanrollover')->with('alert','DATA DEPOSAN BERHASIL DIPERPANJANG');
    }
    // SHOW FORM SEARCH REPORT NOMINATIF RINCI
    public function bo_dp_rp_nominatifrinci()
    {
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        $users = User::all();
        $logos = Logo::all();
        
        return view('reports.deposito.frmnominatifdep', 
         ['users'=>$users,'logos'=>$logos,'tgllogin'=>$tgllogin]);
    }
    // proses cetak nominatif deposito
    public function bo_dp_rp_nominatifrinci_view(Request $request)
    {
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        $d = date("d",strtotime($request->tgl_nominatif));
        $tglawal=date("Y-m-d",strtotime("-".$d." days",strtotime($request->tgl_nominatif)));

        $users = User::all();
        $logos = Logo::all();
        $nominatif = DB::select("SELECT deposito.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL,Y.JML_BUNGA,Y.JML_PAJAK FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) LEFT JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,SUM(IF(MY_KODE_TRANS='100' OR MY_KODE_TRANS LIKE'25%',SALDO_TRANS,0)) AS JML_BUNGA,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as JML_PAJAK FROM deptrans WHERE (TGL_TRANS>='$tglawal' AND TGL_TRANS<='$request->tgl_nominatif') GROUP BY NO_REKENING) AS Y ON deposito.NO_REKENING=Y.NO_REKENING WHERE X.NOMINAL>0");
        return view('reports.deposito.frmnominatifdep',['users'=>$users,'logos'=>$logos,'tgllogin'=>$tgllogin,'nominatif'=>$nominatif,'tgl_input'=>$request->tgl_nominatif]);
    }
    // Cetak Nominatif Rinci ke PDF
    public function cetaknomindepopdf(Request $request)
    {
        set_time_limit(2000);

        $d = date("d",strtotime($request->tgl_input));
        $tglawal=date("Y-m-d",strtotime("-".$d." days",strtotime($request->tgl_input)));
        $nominatif = DB::select("SELECT deposito.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL,Y.JML_BUNGA,Y.JML_PAJAK FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,SUM(IF(MY_KODE_TRANS='100' OR MY_KODE_TRANS LIKE'25%',SALDO_TRANS,0)) AS JML_BUNGA,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as JML_PAJAK FROM deptrans WHERE (TGL_TRANS>='$tglawal' AND TGL_TRANS<='$request->tgl_input') GROUP BY NO_REKENING) AS Y ON deposito.NO_REKENING=Y.NO_REKENING WHERE X.NOMINAL>0");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();

        $pdf = Pdf::loadview('pdf.deposito.nominatif_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // EXPORT TO EXCEL NOMINATIF
    public function nominatifdepeksport(Request $request)
    {
        $d = date("d",strtotime($request->tgl_nominatif));
        $tglawal=date("Y-m-d",strtotime("-".$d." days",strtotime($request->tgl_nominatif)));
        $nominatif = DB::select("SELECT deposito.*,nasabah.nasabah_id,nasabah.kota_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,kodegroup1deposito.DESKRIPSI_GROUP1,kodegroup2deposito.DESKRIPSI_GROUP2,kodegroup3deposito.DESKRIPSI_GROUP3,X.NOMINAL,Y.JML_BUNGA,Y.JML_PAJAK FROM (((((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,SUM(IF(MY_KODE_TRANS='100' OR MY_KODE_TRANS LIKE'25%',SALDO_TRANS,0)) AS JML_BUNGA,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as JML_PAJAK FROM deptrans WHERE (TGL_TRANS>'$tglawal' AND TGL_TRANS<='$request->tgl_nominatif') GROUP BY NO_REKENING) AS Y ON deposito.NO_REKENING=Y.NO_REKENING) LEFT JOIN kodegroup1deposito ON deposito.KODE_GROUP1=kodegroup1deposito.KODE_GROUP1) LEFT JOIN kodegroup2deposito ON deposito.KODE_GROUP2=kodegroup2deposito.KODE_GROUP2) LEFT JOIN kodegroup3deposito ON deposito.KODE_GROUP3=kodegroup3deposito.KODE_GROUP3 WHERE X.NOMINAL>0");
        return (new ReportNominDepExport($nominatif))->download('nominatifexcel.xlsx');
    }
    // Show FORM LAPORAN DEPOSITO GROUP
    public function bo_dp_rp_nominatifgroup()
    {
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        $users = User::all();
        $logos = Logo::all();
        
        return view('reports.deposito.frmnominatifgroup', 
         ['users'=>$users,'logos'=>$logos,'tgllogin'=>$tgllogin]);
    }
    // Proses tapil hasil pencarian 
    public function bo_dp_rp_nominatifgroup_view(Request $request)
    {
        // dd($request);
        $users = User::all();
        $logos = Logo::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        $d = date("d",strtotime($request->tgl_nominatif));
        $tglawal=date("Y-m-d",strtotime("-".$d." days",strtotime($request->tgl_nominatif)));

        $nominatif = DB::select("SELECT deposito.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL,Y.JML_BUNGA,Y.JML_PAJAK FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,SUM(IF(MY_KODE_TRANS='100' OR MY_KODE_TRANS LIKE'25%',SALDO_TRANS,0)) AS JML_BUNGA,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as JML_PAJAK FROM deptrans WHERE (TGL_TRANS>='$tglawal' AND TGL_TRANS<='$request->tgl_nominatif') GROUP BY NO_REKENING) AS Y ON deposito.NO_REKENING=Y.NO_REKENING WHERE X.NOMINAL>0");
        return view('reports.deposito.frmnominatifgroup',['users'=>$users,'logos'=>$logos,'tgllogin'=>$tgllogin,'nominatif'=>$nominatif,'tgl_input'=>$request->tgl_nominatif]);
    }
    // Cetak PDF Nominatif Group 
    public function cetaknomingroupdeppdf(Request $request)
    {
        $d = date("d",strtotime($request->tgl_input));
        $tglawal=date("Y-m-d",strtotime("-".$d." days",strtotime($request->tgl_input)));
        $nominatif = DB::select("SELECT deposito.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL,Y.JML_BUNGA,Y.JML_PAJAK FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,SUM(IF(MY_KODE_TRANS='100' OR MY_KODE_TRANS LIKE'25%',SALDO_TRANS,0)) AS JML_BUNGA,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as JML_PAJAK FROM deptrans WHERE (TGL_TRANS>='$tglawal' AND TGL_TRANS<='$request->tgl_input') GROUP BY NO_REKENING) AS Y ON deposito.NO_REKENING=Y.NO_REKENING WHERE X.NOMINAL>0");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();

        $pdf = Pdf::loadview('pdf.deposito.nominatifgroup_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','portrait');
        return $pdf->stream();
    }
    // EXPORT NOM GROUP DEPOSITO 
    public function exportnominatifgroupdeposito(Request $request)
    {
        $d = date("d",strtotime($request->tgl_nominatif));
        $tglawal=date("Y-m-d",strtotime("-".$d." days",strtotime($request->tgl_nominatif)));

        $nominatif = DB::select("SELECT deposito.*,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,nasabah.nasabah_id,nasabah.tempatlahir,nasabah.tgllahir,nasabah.no_id,nasabah.npwp,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL,Y.JML_BUNGA,Y.JML_PAJAK FROM (((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,SUM(IF(MY_KODE_TRANS='100' OR MY_KODE_TRANS LIKE'25%',SALDO_TRANS,0)) AS JML_BUNGA,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as JML_PAJAK FROM deptrans WHERE (TGL_TRANS>'$tglawal' AND TGL_TRANS<='$request->tgl_nominatif') GROUP BY NO_REKENING) AS Y ON deposito.NO_REKENING=Y.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JENIS_DEPOSITO,deposito.NO_REKENING");
        return (new ReportNominGroupDepExport($nominatif))->download('nominatifgroupexcel.xlsx');
    }
    // cetak nomingroupdeposito 2 
    public function cetaknomingroupdeppdf2(Request $request)
    {
        $d = date("d",strtotime($request->tgl_input));
        $tglawal=date("Y-m-d",strtotime("-".$d." days",strtotime($request->tgl_input)));
        $nominatif = DB::select("SELECT deposito.*,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,nasabah.nasabah_id,nasabah.tempatlahir,nasabah.tgllahir,nasabah.no_id,nasabah.npwp,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL,Y.JML_BUNGA,Y.JML_PAJAK FROM (((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,SUM(IF(MY_KODE_TRANS='100' OR MY_KODE_TRANS LIKE'25%',SALDO_TRANS,0)) AS JML_BUNGA,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as JML_PAJAK FROM deptrans WHERE (TGL_TRANS>'$tglawal' AND TGL_TRANS<='$request->tgl_input') GROUP BY NO_REKENING) AS Y ON deposito.NO_REKENING=Y.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JENIS_DEPOSITO,deposito.NO_REKENING");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();

        $pdf = Pdf::loadview('pdf.deposito.nominatifgroup_pdf2',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // SHOW FORM NOMINATIF GROUP RINCI
    public function cetaknominatifgrouprinci()
    {
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        $users = User::all();
        $logos = Logo::all();
        return view('reports.deposito.frmnominatifgrouprinci', 
         ['users'=>$users,'logos'=>$logos,'tgllogin'=>$tgllogin,'rekap'=>'']);
    }
    // proses cari
    public function cetaknominatifgrouprinci_view(Request $request)
    {
        // dd($request);
        $users = User::all();
        $logos = Logo::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        $nominatif=array();
        if($request->rekap =='JENIS_DEPOSITO'){
            $nominatif = DB::select("SELECT deposito.JENIS_DEPOSITO,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JENIS_DEPOSITO,deposito.NO_REKENING");
        }
        elseif($request->rekap =='JKW')
        {
            $nominatif = DB::select("SELECT deposito.JKW,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JENIS_DEPOSITO,deposito.NO_REKENING");
        }
        elseif($request->rekap =='SUKU_BUNGA')
        {
            $nominatif = DB::select("SELECT deposito.SUKU_BUNGA,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JENIS_DEPOSITO,deposito.NO_REKENING");
        }
        elseif($request->rekap =='KELOMPOK_SALDO')
        {
            $nominatif = DB::select("SELECT X.NOMINAL,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY X.NOMINAL,deposito.NO_REKENING");
        }
        elseif($request->rekap =='KODE_GROUP1')
        {
            $nominatif = DB::select("SELECT deposito.KODE_GROUP1,kodegroup1deposito.DESKRIPSI_GROUP1,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup1deposito ON deposito.KODE_GROUP1=kodegroup1deposito.KODE_GROUP1 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP1,deposito.NO_REKENING");

        }
        elseif($request->rekap =='KODE_GROUP2')
        {
            $nominatif = DB::select("SELECT deposito.KODE_GROUP2,kodegroup2deposito.DESKRIPSI_GROUP2,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup2deposito ON deposito.KODE_GROUP2=kodegroup2deposito.KODE_GROUP2 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP2,deposito.NO_REKENING");
        }
        elseif($request->rekap =='KODE_GROUP3')
        {
            $nominatif = DB::select("SELECT deposito.KODE_GROUP3,kodegroup3deposito.DESKRIPSI_GROUP3,deposito.JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup3deposito ON deposito.KODE_GROUP3=kodegroup3deposito.KODE_GROUP3 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP3,deposito.NO_REKENING");
        }
        return view('reports.deposito.frmnominatifgrouprinci',['users'=>$users,'logos'=>$logos,'tgllogin'=>$tgllogin,'nominatif'=>$nominatif,'tgl_input'=>$request->tgl_nominatif,'rekap'=>$request->rekap]);
    }
    // CETAK KE PDF NOMINATIF GROUP PERJENIS DEPOSITO
    public function cetaknomingroupdepjnsdep(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.JENIS_DEPOSITO,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JENIS_DEPOSITO,deposito.NO_REKENING");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.nominatifgroupjenis_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();

    }
    public function nominatifdepgroupjeniseksport(Request $request)
    {
        $d = date("d",strtotime($request->tgl_nominatif));
        $tglawal=date("Y-m-d",strtotime("-".$d." days",strtotime($request->tgl_nominatif)));

        $nominatif = DB::select("SELECT deposito.JENIS_DEPOSITO,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,X.NOMINAL,deposito.KODE_BI_PEMILIK,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3 FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO  WHERE X.NOMINAL>0 ORDER BY deposito.JENIS_DEPOSITO,deposito.NO_REKENING");
        return (new ReportNominGrpJnsDepExport($nominatif))->download('nominatifgroupjnsexcel.xlsx');

    }
    // Cetak PDF per JKW Depsoito
    public function bo_dp_rp_cetaknomingroupdjkwdep(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.JKW,deposito.JENIS_DEPOSITO,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JKW,deposito.NO_REKENING");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.nominatifgroupjkw_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // export TO EXCEL nominatof group per JKW
    public function nominatifdepgroupjkweksport(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.JKW,deposito.JENIS_DEPOSITO,kodejenisdeposito.DESKRIPSI_JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,deposito.KODE_BI_PEMILIK,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JKW,deposito.NO_REKENING");
        return (new ReportNominGrpJkwDepExport($nominatif))->download('nominatifgroupjkwexcel.xlsx');
    }
    // Cetak PDF Nominatif per Suku_bunga
    public function bo_dp_rp_cetaknomingroupdepskbngdep(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.SUKU_BUNGA,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.SUKU_BUNGA,deposito.NO_REKENING");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.nominatifgroupskbng_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // EXPORT TO EXCEL PER SUKU_BUNGA
    public function nominatifdepgroupskbngeksport(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.SUKU_BUNGA,deposito.JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,deposito.KODE_BI_PEMILIK,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY deposito.JKW,deposito.NO_REKENING");
        return (new ReportNominGrpSkbngDepExport($nominatif))->download('exceldepositoperskbng.xlsx');
    }
    // Cetak PDF Nominatif per KELOMPOK_SALDO
    public function bo_dp_rp_cetaknomingroupdepKELSALdep(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.SUKU_BUNGA,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY X.NOMINAL,deposito.NO_REKENING");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.nominatifgroupKELSAL_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // EXPORT TO EXCEL PER KELOMPOK_SALDO
    public function nominatifdepgroupKELSALeksport(Request $request)
    {
        $nominatif = DB::select("SELECT X.NOMINAL,deposito.JENIS_DEPOSITO,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,deposito.KODE_BI_PEMILIK,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO WHERE X.NOMINAL>0 ORDER BY X.NOMINAL,deposito.NO_REKENING");
        return (new ReportNominGrpKELSALDepExport($nominatif))->download('exceldepositoperskbng.xlsx');
    }

    // CETAK PDF PERGROUP KODE_GROUP1
    public function bo_dp_rp_cetaknomingroupdepkdgrp1dep(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.KODE_GROUP1,kodegroup1deposito.DESKRIPSI_GROUP1,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup1deposito ON deposito.KODE_GROUP1=kodegroup1deposito.KODE_GROUP1 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP1,deposito.NO_REKENING");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.nominatifgroupkdgrp1_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // EXPORT EXCEL NOMINATOF PERGROUP KODE_GROUP1
    public function nominatifdepgroupKDGRP1eksport(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.KODE_GROUP1,kodegroup1deposito.DESKRIPSI_GROUP1,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,deposito.JENIS_DEPOSITO,deposito.KODE_BI_PEMILIK,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup1deposito ON deposito.KODE_GROUP1=kodegroup1deposito.KODE_GROUP1 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP1,deposito.NO_REKENING");
        return (new ReportNominGrpKDGRP1DepExport($nominatif))->download('exceldepositoperKDGRP1.xlsx');
    }
    // CETAK PDF PERGROUP KODE_GROUP2
    public function bo_dp_rp_cetaknomingroupdepkdgrp2dep(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.KODE_GROUP2,kodegroup2deposito.DESKRIPSI_GROUP2,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup2deposito ON deposito.KODE_GROUP2=kodegroup2deposito.KODE_GROUP2 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP2,deposito.NO_REKENING");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.nominatifgroupkdgrp2_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // EXPORT EXCEL NOMINATOF PERGROUP KODE_GROUP2
    public function nominatifdepgroupKDGRP2eksport(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.KODE_GROUP2,kodegroup2deposito.DESKRIPSI_GROUP2,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,deposito.JENIS_DEPOSITO,deposito.KODE_BI_PEMILIK,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup2deposito ON deposito.KODE_GROUP2=kodegroup2deposito.KODE_GROUP2 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP2,deposito.NO_REKENING");
        return (new ReportNominGrpKDGRP2DepExport($nominatif))->download('exceldepositoperKDGRP2.xlsx');
    }
    // CETAK PDF PERGROUP KODE_GROUP3
    public function bo_dp_rp_cetaknomingroupdepkdgrp3dep(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.KODE_GROUP3,kodegroup3deposito.DESKRIPSI_GROUP3,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_input' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup3deposito ON deposito.KODE_GROUP3=kodegroup3deposito.KODE_GROUP3 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP3,deposito.NO_REKENING");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.nominatifgroupkdgrp3_pdf',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgl_input'=>$request->tgl_input])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // EXPORT EXCEL NOMINATOF PERGROUP KODE_GROUP3
    public function nominatifdepgroupKDGRP3eksport(Request $request)
    {
        $nominatif = DB::select("SELECT deposito.KODE_GROUP3,kodegroup3deposito.DESKRIPSI_GROUP3,deposito.NO_REKENING,nasabah.nasabah_id,nasabah.nama_nasabah,nasabah.alamat,deposito.JKW,deposito.TGL_REGISTRASI,deposito.TGL_MULAI,deposito.TGL_JT,deposito.SUKU_BUNGA,deposito.JENIS_DEPOSITO,deposito.KODE_BI_PEMILIK,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3,X.NOMINAL FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$request->tgl_nominatif' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN kodegroup3deposito ON deposito.KODE_GROUP3=kodegroup3deposito.KODE_GROUP3 WHERE X.NOMINAL>0 ORDER BY deposito.KODE_GROUP3,deposito.NO_REKENING");
        return (new ReportNominGrpKDGRP3DepExport($nominatif))->download('exceldepositoperKDGRP3.xlsx');
    }
    // SHOW FORM CARI REPORT TRANSAKSI
    public function bo_dp_rp_transaksirinci()
    {
        $users = User::all();
        $logos = Logo::all();
        return view('reports.deposito.frmcetakrpttransaksi',['users' => $users, 'logos'=>$logos,'msgstatus'=>'']);
    }
    // PROSES CARI TRANSAKSI DEPOSITO
    public function bo_dp_rp_transaksirinci_view(Request $request)
    {
        $tgltrs1 = date('Y-m-d',strtotime($request->tgl_trans1));
        $tgltrs2 = date('Y-m-d',strtotime($request->tgl_trans2));
        $users = User::all();
        $logos = Logo::all();

        $transaksi = DB::select("SELECT deposito.NO_REKENING,nasabah.nama_nasabah,X.NOMINAL,deposito.SUKU_BUNGA,deptrans.TGL_TRANS,deptrans.MY_KODE_TRANS,deptrans.KODE_TRANS,deptrans.KUITANSI,deptrans.SALDO_TRANS FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$tgltrs2' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING) INNER JOIN deptrans ON deposito.NO_REKENING=deptrans.NO_REKENING WHERE deptrans.TGL_TRANS>='$tgltrs1' AND deptrans.TGL_TRANS<='$tgltrs2' ORDER BY deptrans.TGL_TRANS,deposito.NO_REKENING");
        return view('reports.deposito.frmcetakrpttransaksi',['transaksi' => $transaksi,'tgltrs1'=>$tgltrs1,'tgltrs2'=>$tgltrs2,'users' => $users, 'logos'=>$logos,'msgstatus'=>'']);
    }
    // cetak ke PDF TRANSAKSI RINCI DEPOSITO
    public function bo_dp_rp_pdftransaksideposito(Request $request)
    {
        $tgltrs1 = date('Y-m-d',strtotime($request->tgl_trans1));
        $tgltrs2 = date('Y-m-d',strtotime($request->tgl_trans2));
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $transaksi = DB::select("SELECT deposito.no_rekening,nasabah.nama_nasabah,deposito.suku_bunga,Y.TGL_TRANS,Y.kode_trans,Y.terima_pokok,Y.ambil_bunga,Y.ambil_titipan,Y.ambil_pajak,Y.ambil_pokok,Y.kuitansi,Y.no_teller,Y.userid,Y.my_kode_trans,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3,deposito.MASUK_TITIPAN,deposito.BUNGA_BERBUNGA,Y.tob,Y.no_rek_ob FROM (deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id ) INNER JOIN (SELECT DEPTRANS_ID,NO_REKENING,TGL_TRANS,SUM(IF(MY_KODE_TRANS LIKE '0',SALDO_TRANS,0)) as terima_pokok,SUM(IF(MY_KODE_TRANS LIKE '10%' OR MY_KODE_TRANS LIKE '20%' OR MY_KODE_TRANS LIKE '25%',SALDO_TRANS,0)) as ambil_bunga,SUM(IF(MY_KODE_TRANS LIKE '27%',SALDO_TRANS,0)) as ambil_titipan,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as ambil_pajak,SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0)) as ambil_pokok,IF(MY_KODE_TRANS = '0' OR MY_KODE_TRANS = '100' OR MY_KODE_TRANS ='200' OR MY_KODE_TRANS ='300',KUITANSI,NULL) as kuitansi,no_teller,userapp as userid,IF(MY_KODE_TRANS = '0' OR MY_KODE_TRANS = '100' OR MY_KODE_TRANS ='200' OR MY_KODE_TRANS ='300',MY_KODE_TRANS,NULL) as my_kode_trans,no_rek_ob,tob,kode_trans FROM deptrans WHERE TGL_TRANS>='$tgltrs1' AND TGL_TRANS<='$tgltrs2' GROUP BY NO_REKENING,TGL_TRANS ORDER BY TGL_TRANS) AS Y ON deposito.NO_REKENING=Y.NO_REKENING");
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.transaksi_pdf',['transaksi'=>$transaksi,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgltrs1'=>$tgltrs1,'tgltrs2'=>$tgltrs2])->setPaper('A4','landscape');
        return $pdf->stream();
    }
    // EXPORT TO EXCEL REPORT TRANaksi DEPOSITO
    public function exporttoexceltransaksidep(Request $request)
    {
        $tgltrs1 = date('Y-m-d',strtotime($request->tgl_trans1));
        $tgltrs2 = date('Y-m-d',strtotime($request->tgl_trans2));
        $transaksi = DB::select("SELECT deposito.no_rekening,nasabah.nama_nasabah,deposito.suku_bunga,deposito.jml_deposito,Y.TGL_TRANS,Y.kode_trans,Y.terima_pokok,Y.ambil_bunga,Y.ambil_titipan,Y.ambil_pajak,Y.ambil_pokok,Y.kuitansi,Y.no_teller,Y.userid,Y.my_kode_trans,deposito.KODE_GROUP1,deposito.KODE_GROUP2,deposito.KODE_GROUP3,deposito.MASUK_TITIPAN,deposito.BUNGA_BERBUNGA,Y.tob,Y.no_rek_ob FROM (deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id ) INNER JOIN (SELECT DEPTRANS_ID,NO_REKENING,TGL_TRANS,SUM(IF(MY_KODE_TRANS LIKE '0',SALDO_TRANS,0)) as terima_pokok,SUM(IF(MY_KODE_TRANS LIKE '10%' OR MY_KODE_TRANS LIKE '20%' OR MY_KODE_TRANS LIKE '25%',SALDO_TRANS,0)) as ambil_bunga,SUM(IF(MY_KODE_TRANS LIKE '27%',SALDO_TRANS,0)) as ambil_titipan,SUM(IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0)) as ambil_pajak,SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0)) as ambil_pokok,IF(MY_KODE_TRANS = '0' OR MY_KODE_TRANS = '100' OR MY_KODE_TRANS ='200' OR MY_KODE_TRANS ='300',KUITANSI,NULL) as kuitansi,no_teller,userapp as userid,IF(MY_KODE_TRANS = '0' OR MY_KODE_TRANS = '100' OR MY_KODE_TRANS ='200' OR MY_KODE_TRANS ='300',MY_KODE_TRANS,NULL) as my_kode_trans,no_rek_ob,tob,kode_trans FROM deptrans WHERE TGL_TRANS>='$tgltrs1' AND TGL_TRANS<='$tgltrs2' GROUP BY NO_REKENING,TGL_TRANS ORDER BY TGL_TRANS) AS Y ON deposito.NO_REKENING=Y.NO_REKENING");
        return (new ReportTransaksiDepExport($transaksi))->download('transaksideposito.xlsx');
    }
    // Show form mutasi bunga
    public function bo_dp_rp_mutasibunga()
    {
        $users = User::all();
        $logos = Logo::all();
        $nasabah = DB::select("select deposito.no_rekening,nasabah.nama_nasabah,nasabah.alamat,deposito.jml_deposito from deposito inner join nasabah on deposito.nasabah_id = nasabah.nasabah_id where deposito.status_aktif<>1");
        return view('reports.deposito.frmmutasibunga',['users' => $users, 'logos'=>$logos,'nasabah'=>$nasabah,'msgstatus'=>'']);
    }

    public function bo_dp_rp_mutasibunga_view(Request $request)
    {
        $tgltrs1 = date('Y-m-d',strtotime($request->tgl_trans1));
        $tgltrs2 = date('Y-m-d',strtotime($request->tgl_trans2));
        $users = User::all();
        $logos = Logo::all();

        $nasabah = DB::select("select deposito.no_rekening,nasabah.nama_nasabah,nasabah.alamat,deposito.jml_deposito from deposito inner join nasabah on deposito.nasabah_id = nasabah.nasabah_id where deposito.status_aktif<>1");

        $profnas = DB::select("SELECT deposito.NO_REKENING,nasabah.nama_nasabah,X.NOMINAL,deposito.TGL_REGISTRASI,deposito.TGL_JT,deposito.JKW FROM (deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$tgltrs2' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING WHERE deposito.NO_REKENING='$request->no_rekening'");

        $transaksi = DB::select("SELECT DEPTRANS_ID,NO_REKENING,TGL_TRANS,IF(MY_KODE_TRANS LIKE '0',SALDO_TRANS,0) as terima_pokok,IF(MY_KODE_TRANS LIKE '10%' OR MY_KODE_TRANS LIKE '20%',SALDO_TRANS,0) as ambil_bunga,IF(MY_KODE_TRANS LIKE '27%',SALDO_TRANS,0) as ambil_titipan,IF(MY_KODE_TRANS LIKE '4%',SALDO_TRANS,0) as ambil_pajak,IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0) as ambil_pokok,KUITANSI,IF(MY_KODE_TRANS = '0' OR MY_KODE_TRANS = '100' OR MY_KODE_TRANS ='200' OR MY_KODE_TRANS ='300',MY_KODE_TRANS,NULL) as my_kode_trans,no_rek_ob,tob FROM deptrans WHERE NO_REKENING='$request->no_rekening' AND TGL_TRANS>='$tgltrs1' AND TGL_TRANS<='$tgltrs2' AND MY_KODE_TRANS<>1 ORDER BY DEPTRANS_ID");
        return view('reports.deposito.frmmutasibunga',['transaksi' => $transaksi,'nasabah'=>$nasabah,'profnas'=>$profnas,'tgltrs1'=>$tgltrs1,'tgltrs2'=>$tgltrs2,'users' => $users,'logos'=>$logos,'no_rekening'=>$request->no_rekening,'msgstatus'=>'']);
    }
    // CETAK TO PDF MUTASI BUNGA
    public function bo_dp_rp_cetakmutasibungadep(Request $request)
    {
        $tgltrs1 = date('Y-m-d',strtotime($request->tgl_trans1));
        $tgltrs2 = date('Y-m-d',strtotime($request->tgl_trans2));

        $profnas = DB::select("SELECT deposito.NO_REKENING,nasabah.nama_nasabah,X.NOMINAL,deposito.TGL_REGISTRASI,deposito.TGL_JT,deposito.JKW FROM (deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',SALDO_TRANS,0))) AS NOMINAL FROM deptrans WHERE TGL_TRANS<='$tgltrs2' GROUP BY NO_REKENING) X ON deposito.NO_REKENING=X.NO_REKENING WHERE deposito.NO_REKENING='$request->no_rekening'");

        $transaksi = DB::select("SELECT DEPTRANS_ID,deptrans.NO_REKENING,TGL_TRANS,deposito.MASUK_TITIPAN,deposito.BUNGA_BERBUNGA,IF(MY_KODE_TRANS LIKE '0',SALDO_TRANS,0) as terima_pokok,IF(MY_KODE_TRANS LIKE '10%' OR MY_KODE_TRANS LIKE '20%' OR MY_KODE_TRANS LIKE '25%' OR MY_KODE_TRANS LIKE '45%' OR MY_KODE_TRANS='400',SALDO_TRANS,0) as setor,IF(MY_KODE_TRANS LIKE '27%' OR MY_KODE_TRANS LIKE '4%' OR MY_KODE_TRANS LIKE '3%' OR MY_KODE_TRANS LIKE '25%' OR MY_KODE_TRANS ='200',SALDO_TRANS,0) as ambil,KUITANSI,IF(MY_KODE_TRANS = '0' OR MY_KODE_TRANS = '100' OR MY_KODE_TRANS ='200' OR MY_KODE_TRANS ='300',MY_KODE_TRANS,NULL) as my_kode_trans,no_rek_ob,tob FROM deposito INNER JOIN deptrans ON deposito.NO_REKENING=deptrans.NO_REKENING WHERE deptrans.NO_REKENING='$request->no_rekening' AND TGL_TRANS>='$tgltrs1' AND TGL_TRANS<='$tgltrs2' AND MY_KODE_TRANS<>1 ORDER BY DEPTRANS_ID");
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_DEP%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'NAMA_KOTA')->get();
        $pdf = Pdf::loadview('pdf.deposito.mutasibunga_pdf',['transaksi'=>$transaksi,'profnas'=>$profnas,'lembaga'=>$lembaga,'ttd'=>$ttd,'kota'=>$kota,'tgltrs1'=>$tgltrs1,'tgltrs2'=>$tgltrs2])->setPaper('A4','portrait');
        return $pdf->stream();

    }
    
}