<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Logo;
use App\Kodetransdeposito;
use App\Kodetranstabungan;
use App\Deposito;
use App\Tabung;
use App\Mysysid;
use App\Kodecabang;
use App\Deptran;
use App\Tabtran;
use App\Golonganpihaklawan;
use App\Tellertran;
use Illuminate\Support\Facades\Auth;

class TellerDepositoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function bo_tl_td_setorandeposito()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetransdep = Kodetransdeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodecabang = Kodecabang::where('DATA_CAB', '=', 'mydata')->get();
        $tgllogin = Mysysid::where('KeyName', '=', 'TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d', strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        // memfilter hanya deposito yang belum diaktifkan saja
        $depositos = DB::select("select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito INNER JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id WHERE deposito.STATUS_AKTIF=1 AND TGL_REGISTRASI<='$tgllogin'");
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        return view('teller/deposito/frmsetorandeposito', ['users' => $users, 'logos' => $logos, 'tabungans' => $tabungans, 'depositos' => $depositos, 'golonganpihaklawan' => $golonganpihaklawan, 'kodetransdep' => $kodetransdep, 'kodetranstab' => $kodetranstab, 'kodecabang' => $kodecabang, 'tgllogin' => $tgllogin, 'msgstatus' => '', 'msgview' => '']);
    }
    //SIMPAN SETORAN DEPOSITO TELLER
    public function bo_tl_td_setorandeposito_add(Request $request)
    {

        $this->validate(
            $request,
            [
                'no_rekening' => 'unique:deptrans',
                'kuitansi' => 'unique:tellertrans,NO_BUKTI',
                'jumlah_setoran' => 'required|numeric|min:0|not_in:0'
            ]
        );
        $tgl_trans = date('Y-m-d', strtotime($request->tgl_trans));
        if (is_null($request->no_rekening_tab) == false) {
            $sldtab = DB::select("SELECT SUM(IF(MY_KODE_TRANS like '1%',SALDO_TRANS,0)-IF(MY_KODE_TRANS like '2%',SALDO_TRANS,0)) as saldoakhir from tabtrans WHERE NO_REKENING='$request->no_rekening_tab' AND TGL_TRANS<='$tgl_trans'");

            // cek saldo tabungan 
            if ((float)$request->jumlah_setoran > (float)$sldtab[0]->saldoakhir) {
                return redirect()->route('showsetorandeposito')->with('alert', 'SALDO TIDAK CUKUP');
            }
        }
        $maxId = DB::select("SELECT MAX(DEPTRANS_ID)+1 AS maxIdDeptran FROM deptrans")[0]->maxIdDeptran;
        $setorandep = new Deptran();
        $setorandep->DEPTRANS_ID = $request->maxId;
        $setorandep->TGL_TRANS = $tgl_trans;
        $setorandep->NO_REKENING = $request->no_rekening;
        $setorandep->KODE_TRANS = substr($request->kode_trans, 0, 3);
        $setorandep->SALDO_SEBELUM = '0,00';
        $setorandep->SALDO_TRANS = $request->jumlah_setoran;
        $setorandep->SALDO_SETELAH = '0,00';
        $setorandep->KUITANSI = $request->kuitansi;
        $setorandep->NO_TELLER = 0;
        $setorandep->USERID = Auth::id();
        $setorandep->TOB = substr($request->kode_trans, 4, 1);
        $setorandep->POSTED = 0;
        $setorandep->VALIDATED = 1;
        $setorandep->TGL_INPUT = NULL;
        $setorandep->NO_REK_OB = $request->no_rekening_tab;
        $setorandep->KODE_PERK_TABUNGAN = '';
        $setorandep->KODE_PERK_GL = '';
        $setorandep->CAB = $request->cab;
        $setorandep->USERAPP = 0;
        $setorandep->FLAG_PAJAK = 0;
        $setorandep->tob_rak = NULL;
        $setorandep->ACR_TRANS = '0,00';
        $setorandep->MY_KODE_TRANS = 0;
        $setorandep->save();
        $modultransid = $setorandep->DEPTRANS_ID;

        // INSERT DATA KE TABLE TELLERTRANS
        $insertteller = new Tellertran();
        $insertteller->modul = 'DEP';
        $insertteller->tgl_trans = $tgl_trans;
        $insertteller->NO_BUKTI = $request->kuitansi;
        if (substr($request->kode_trans, 4, 1) == "T") {
            $insertteller->uraian = 'Penerimaan Deposito Tunai : ' . $request->no_rekening . "-" . $request->nama_nasabah;
            $insertteller->my_kode_trans = 200;
            $insertteller->tob = 'T';
        } elseif (substr($request->kode_trans, 4, 1) == "O") {
            $insertteller->uraian = 'OB Penerimaan Deposito : ' . $request->no_rekening . "-" . $request->nama_nasabah . " dari GL";
            $insertteller->my_kode_trans = 200;
            $insertteller->tob = 'O';
        } elseif (is_null($request->no_rekening_tab) == false) {
            $insertteller->uraian = 'Setoran Deposito OVB : ' . $request->no_rekening . "-" . $request->nama_nasabah . " Via NoRek Tab #:" . $request->no_rekening_tab;
            $insertteller->my_kode_trans = 200;
            $insertteller->tob = 'O';
        }
        $insertteller->saldo_trans = $request->nominal;
        $insertteller->modul_trans_id = $modultransid;
        $insertteller->userid = Auth::id();
        $insertteller->VALIDATED = 0;
        $insertteller->POSTED = 0;
        $insertteller->cab = $request->cab;
        $insertteller->save();

        // UPDATE DEPOSITO
        $norekeningdep = $request->no_rekening;
        $tgl = $request->tgl_trans;
        $jmlsetoran = $request->jumlah_setoran;
        $sqlupdatedep = "UPDATE deposito SET deposito.STATUS_AKTIF=2,deposito.SALDO_AKHIR=$jmlsetoran,deposito.SALDO_SETORAN=$jmlsetoran where deposito.NO_REKENING='$norekeningdep'";
        DB::select($sqlupdatedep);
        // --------------
        // UPDATE KE TABLES TABTRANS
        if (is_null($request->no_rekening_tab) == false) {
            $maxIdTab = DB::select("SELECT MAX(TABTRANS_ID)+1 AS maxIdTabtran FROM tabtrans")[0]->maxIdTabtran;
            $tabtrans = new Tabtran();
            $tabtrans->TABTRANS_ID = $maxIdTab;
            $tabtrans->TGL_TRANS = $request->tgl_trans;
            $tabtrans->NO_REKENING = $request->no_rekening_tab;
            $tabtrans->KODE_TRANS = substr($request->kode_trans_tab, 0, 2);
            $tabtrans->SALDO_TRANS = $request->jumlah_setoran;
            $tabtrans->KUITANSI = $request->kuitansi;
            $tabtrans->NO_TELLER = 0;
            $tabtrans->USERID = Auth::id();
            $tabtrans->TOB = substr($request->kode_trans, 4, 1);
            $tabtrans->POSTED = 1;
            $tabtrans->VALIDATED = 1;
            $tabtrans->NO_REK_OB = $request->no_rekening;
            $tabtrans->SALDO_AWAL_HARI = 0;
            $tabtrans->TGL_INPUT = NULL;
            $tabtrans->CAB = $request->cab;
            $tabtrans->LINK_MODUL = 'DEP';
            $tabtrans->LINK_ID = $modultransid;
            $tabtrans->LINK_REKENING = $request->no_rekening;
            $tabtrans->USERAPP = 0;
            $tabtrans->FLAG_CETAK = 'N';
            $tabtrans->MY_KODE_TRANS = 270;
            $tabtrans->save();

            // UPDATE TABUNG
            $sldtab = DB::select("SELECT SUM(IF(MY_KODE_TRANS like '1%',SALDO_TRANS,0)) as saldotrsetor,SUM(IF(MY_KODE_TRANS like '2%',SALDO_TRANS,0)) as saldotrtarik,SUM(IF(MY_KODE_TRANS like '1%',SALDO_TRANS,0)-IF(MY_KODE_TRANS like '2%',SALDO_TRANS,0)) as saldoakhir from tabtrans WHERE NO_REKENING='$request->no_rekening_tab' AND TGL_TRANS<='$tgl_trans'");
            $saldotrsetor = $sldtab[0]->saldotrsetor;
            $saldotrtarik = $sldtab[0]->saldotrtarik;
            $saldoakhir = $sldtab[0]->saldoakhir;
            $norekeningtab = $request->no_rekening_tab;
            $sqlupdatetab = "UPDATE tabung SET SALDO_SETORAN=$saldotrsetor,SALDO_PENARIKAN=$saldotrtarik,SALDO_AKHIR=$saldoakhir where tabung.NO_REKENING='$norekeningtab'";
            DB::select($sqlupdatetab);
        }

        if ($setorandep->exists) {
            $msg = '1';
            $msgdetail = 'Proses Berhasil';
        } else {
            $msg = '0';
            $msgdetail = 'Proses Simpan Data Gagal!';
        }
        $lembaga = DB::table('mysysid')->select('KeyName', 'Value')->where('KeyName', 'like', 'NAMA_LEMBAGA' . '%')->get();
        $jbt = Mysysid::where('KeyName', '=', 'TTD_DEP_R_NIP')->get();
        $ttd = Mysysid::where('KeyName', '=', 'TTD_DEP_R_NAMA')->get();

        $depositos = DB::select("select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito INNER JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id WHERE deposito.NO_REKENING = '$request->no_rekening'");

        return view('pdf.deposito.rptvalidasitrs', ['depositos' => $depositos, 'lembaga' => $lembaga, 'jbt' => $jbt, 'ttd' => $ttd, 'nama_nasabah' => $request->nama_nasabah, 'no_rekening' => $request->no_rekening, 'tgl_transaksi' => $request->tgl_transaksi, 'kode_trans' => $request->kode_trans, 'nominal' => $request->nominal, 'kuitansi' => $request->kuitansi]);
    }
    // Cetak Tanda Terima Buka Deposito
    public function bo_tl_td_cetakbukadep(Request $request)
    {
        // dd($request);
        return view('pdf.deposito.rptbukadeposito', ['depositos' => $request->depositos, 'lembaga' => $request->lembaga, 'jbt' => $request->jbt, 'ttd' => $request->ttd]);
    }

    //PENGAMBILAN BUNGA DEPOSITO
    public function bo_tl_td_pengambilanbungadeposito()
    {
        $users = User::all();
        $logos = Logo::all();
        $tgllogin = Mysysid::where('KeyName', '=', 'TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d', strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        $kodetransdep = Kodetransdeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodecabang = Kodecabang::where('DATA_CAB', '=', 'mydata')->get();
        // $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id');
        $depositos = DB::select("SELECT deposito.*,nasabah.nama_nasabah,nasabah.alamat,X.nominal,Y.saldo_titipan FROM ((deposito INNER JOIN nasabah ON deposito.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS=0 OR MY_KODE_TRANS=1,SALDO_TRANS,0))-SUM(IF(MY_KODE_TRANS=300,SALDO_TRANS,0))) AS nominal FROM deptrans WHERE TGL_TRANS<='$tgllogin' GROUP BY NO_REKENING) AS X ON deposito.NO_REKENING=X.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS LIKE '10%' AND TGL_TRANS<='$tgllogin',SALDO_TRANS,0))-SUM(IF((MY_KODE_TRANS LIKE '27%' OR MY_KODE_TRANS LIKE '47%') AND (TGL_TRANS<='$tgllogin'),SALDO_TRANS,0))) as saldo_titipan FROM deptrans GROUP BY NO_REKENING) as Y ON deposito.NO_REKENING=Y.NO_REKENING WHERE X.nominal>0 ORDER BY deposito.TGL_VALUTA");
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        return view('teller.deposito.frmpengambilanbungadeposito', ['users' => $users, 'logos' => $logos, 'tabungans' => $tabungans, 'depositos' => $depositos, 'golonganpihaklawan' => $golonganpihaklawan, 'kodetransdep' => $kodetransdep, 'kodetranstab' => $kodetranstab, 'kodecabang' => $kodecabang, 'tgllogin' => $tgllogin, 'msgstatus' => '', 'msgview' => '']);
    }
    //SIMPAN PENGAMBILAN BUNGA DEPOSITO TELLER
    public function bo_tl_td_pengambilanbungadeposito_add(Request $request)
    {
        // dd($request);
        $cab = DB::select("SELECT * FROM mysysid WHERE KeyName = 'LOGINCABANG'");
        $maxId = DB::select("SELECT MAX(DEPTRANS_ID)+1 AS maxIdDeptran FROM deptrans")[0]->maxIdDeptran;
        // tahap inout data transaksi BUNGA
        $setorandep = new Deptran();
        $setorandep->DEPTRANS_ID = $maxId;
        $setorandep->TGL_TRANS = $request->tgl_trans;
        $setorandep->NO_REKENING = $request->no_rekening;
        $setorandep->KODE_TRANS = substr($request->kode_trans, 0, 3);
        $setorandep->SALDO_SEBELUM = '0,00';
        $setorandep->SALDO_TRANS = $request->bunga_bln_ini;
        $setorandep->SALDO_SETELAH = '0,00';
        $setorandep->KUITANSI = $request->kuitansi;
        $setorandep->NO_TELLER = 0;
        $setorandep->USERID = Auth::id();
        $setorandep->TOB = substr($request->kode_trans, 4, 1);
        $setorandep->POSTED = 0;
        $setorandep->VALIDATED = 1;
        $setorandep->TGL_INPUT = NULL;
        if (is_null($request->no_rekening_tab) == false) {
            $setorandep->NO_REK_OB = $request->no_rekening_tab;
            $setorandep->MY_KODE_TRANS = 200;
        }
        $setorandep->KODE_PERK_TABUNGAN = '';
        $setorandep->KODE_PERK_GL = '';
        $setorandep->CAB = $cab[0]->Value;
        $setorandep->USERAPP = 0;
        $setorandep->FLAG_PAJAK = 0;
        $setorandep->tob_rak = NULL;
        $setorandep->ACR_TRANS = $request->total_bunga_diambil;
        $setorandep->save();
        $linkbng = $setorandep->DEPTRANS_ID;
        // tahap inout data transaksi PAJAK
        $setorandep = new Deptran();
        $setorandep->DEPTRANS_ID = $maxId + 1;
        $setorandep->TGL_TRANS = $request->tgl_trans;
        $setorandep->NO_REKENING = $request->no_rekening;
        $setorandep->KODE_TRANS = substr($request->kode_trans, 0, 3);
        $setorandep->SALDO_SEBELUM = '0,00';
        $setorandep->SALDO_TRANS = $request->inputpajak;
        $setorandep->SALDO_SETELAH = '0,00';
        $setorandep->KUITANSI = $request->kuitansi;
        $setorandep->NO_TELLER = 0;
        $setorandep->USERID = Auth::id();
        $setorandep->TOB = substr($request->kode_trans, 4, 1);
        $setorandep->POSTED = 0;
        $setorandep->VALIDATED = 1;
        $setorandep->TGL_INPUT = NULL;
        if (is_null($request->no_rekening_tab) == false) {
            $setorandep->NO_REK_OB = $request->no_rekening_tab;
            $setorandep->MY_KODE_TRANS = 400;
        }
        $setorandep->KODE_PERK_TABUNGAN = '';
        $setorandep->KODE_PERK_GL = '';
        $setorandep->CAB = $cab[0]->Value;
        $setorandep->USERAPP = 0;
        $setorandep->FLAG_PAJAK = 0;
        $setorandep->tob_rak = NULL;
        $setorandep->ACR_TRANS = '0';
        $setorandep->save();
        $linkpjk = $setorandep->DEPTRANS_ID;

        // tahap inout data transaksi TARIKAN TITIPAN
        $setorandep = new Deptran();
        $setorandep->DEPTRANS_ID = $maxId + 2;
        $setorandep->TGL_TRANS = $request->tgl_trans;
        $setorandep->NO_REKENING = $request->no_rekening;
        $setorandep->KODE_TRANS = substr($request->kode_trans, 0, 3);
        $setorandep->SALDO_SEBELUM = '0,00';
        $setorandep->SALDO_TRANS = $request->titipan_ambil;
        $setorandep->SALDO_SETELAH = '0,00';
        $setorandep->KUITANSI = $request->kuitansi;
        $setorandep->NO_TELLER = 0;
        $setorandep->USERID = Auth::id();
        $setorandep->TOB = substr($request->kode_trans, 4, 1);
        $setorandep->POSTED = 0;
        $setorandep->VALIDATED = 1;
        $setorandep->TGL_INPUT = NULL;
        if (is_null($request->no_rekening_tab) == false) {
            $setorandep->NO_REK_OB = $request->no_rekening_tab;
            $setorandep->MY_KODE_TRANS = 275;
        }
        $setorandep->KODE_PERK_TABUNGAN = '';
        $setorandep->KODE_PERK_GL = '';
        $setorandep->CAB = $cab[0]->Value;
        $setorandep->USERAPP = 0;
        $setorandep->FLAG_PAJAK = 0;
        $setorandep->tob_rak = NULL;
        $setorandep->ACR_TRANS = '0';
        $setorandep->save();
        $linkttp = $setorandep->DEPTRANS_ID;

        // UPDATE DEPOSITO
        $norekeningdep = $request->no_rekening;
        $tgl = $request->tgl_trans;
        $jmlsetoran = $request->jumlah_setoran;
        $sqlupdatedep = "UPDATE deposito SET TITIPAN_AMBIL=(TITIPAN_AMBIL+$request->titipan_ambil),TITIPAN_AKHIR=TITIPAN_TAMBAH-(TITIPAN_AMBIL+$request->titipan_ambil),BUNGA_YMH=$request->bunga_netto,BUNGA_BLN_INI='0',PAJAK_BLN_INI='0' where deposito.NO_REKENING='$norekeningdep'";
        DB::select($sqlupdatedep);
        // --------------

        // UPDATE KE TABLE TABTRANS JIKA TRANSAKSI LEWAT TABUNGAN
        if (is_null($request->no_rekening_tab) == false) {
            $maxIdTab = DB::select("SELECT MAX(TABTRANS_ID)+1 AS maxIdTabtran FROM tabtrans")[0]->maxIdTabtran;

            // PROSES SIMPAN BUNGA
            $tabtrans = new Tabtran();
            $tabtrans->TABTRANS_ID = $maxIdTab;
            $tabtrans->TGL_TRANS = $request->tgl_trans;
            $tabtrans->NO_REKENING = $request->no_rekening_tab;
            $tabtrans->KODE_TRANS = substr($request->kode_trans_tab, 0, 2);
            $tabtrans->SALDO_TRANS = $request->bunga_bln_ini;
            $tabtrans->KUITANSI = $request->kuitansi;
            $tabtrans->NO_TELLER = 0;
            $tabtrans->USERID = Auth::id();
            $tabtrans->TOB = substr($request->kode_trans_tab, 3, 1);
            $tabtrans->POSTED = 1;
            $tabtrans->VALIDATED = 1;
            $tabtrans->SALDO_AWAL_HARI = 0;
            $tabtrans->TGL_INPUT = NULL;
            $tabtrans->CAB = $cab[0]->Value;
            $tabtrans->LINK_MODUL = 'DEP';
            $tabtrans->LINK_ID = $linkbng;
            $tabtrans->LINK_REKENING = $request->no_rekening;
            $tabtrans->USERAPP = 0;
            $tabtrans->FLAG_CETAK = 'N';
            $tabtrans->MY_KODE_TRANS = 176;
            $tabtrans->save();
            // //SIMPAN PAJAK 
            $tabtrans = new Tabtran();
            $tabtrans->TABTRANS_ID = $maxIdTab + 2;
            $tabtrans->TGL_TRANS = $request->tgl_trans;
            $tabtrans->NO_REKENING = $request->no_rekening_tab;
            $tabtrans->KODE_TRANS = substr($request->kode_trans_pajak, 0, 2);
            $tabtrans->SALDO_TRANS = $request->inputpajak;
            $tabtrans->KUITANSI = $request->kuitansi;
            $tabtrans->NO_TELLER = 0;
            $tabtrans->USERID = Auth::id();
            $tabtrans->TOB = substr($request->kode_trans_tab, 3, 1);
            $tabtrans->POSTED = 1;
            $tabtrans->VALIDATED = 1;
            $tabtrans->SALDO_AWAL_HARI = 0;
            $tabtrans->TGL_INPUT = NULL;
            $tabtrans->CAB = $cab[0]->Value;
            $tabtrans->LINK_MODUL = 'DEP';
            $tabtrans->LINK_ID = $linkpjk;
            $tabtrans->LINK_REKENING = $request->no_rekening;
            $tabtrans->USERAPP = 0;
            $tabtrans->FLAG_CETAK = 'N';
            $tabtrans->MY_KODE_TRANS = 276;
            $tabtrans->save();
            // //SIMPAN AMBIL TITIPAN 
            $tabtrans = new Tabtran();
            $tabtrans->TABTRANS_ID = $maxIdTab + 1;
            $tabtrans->TGL_TRANS = $request->tgl_trans;
            $tabtrans->NO_REKENING = $request->no_rekening_tab;
            $tabtrans->KODE_TRANS = substr($request->kode_trans_tab, 0, 2);
            $tabtrans->SALDO_TRANS = $request->titipan_ambil;
            $tabtrans->KUITANSI = $request->kuitansi;
            $tabtrans->NO_TELLER = 0;
            $tabtrans->USERID = Auth::id();
            $tabtrans->TOB = substr($request->kode_trans_tab, 3, 1);
            $tabtrans->POSTED = 1;
            $tabtrans->VALIDATED = 1;
            $tabtrans->SALDO_AWAL_HARI = 0;
            $tabtrans->TGL_INPUT = NULL;
            $tabtrans->CAB = $cab[0]->Value;
            $tabtrans->LINK_MODUL = 'DEP';
            $tabtrans->LINK_ID = $linkttp;
            $tabtrans->LINK_REKENING = $request->no_rekening;
            $tabtrans->USERAPP = 0;
            $tabtrans->FLAG_CETAK = 'N';
            $tabtrans->MY_KODE_TRANS = 176;
            $tabtrans->save();

            // UPDATE TABUNG
            $norekeningtab = $request->no_rekening_tab;
            $jmlsetoran = 0;
            $jmltarikan = 0;
            if (is_null($request->total_bunga_diambil)) {
                $jmlsetoran = 0;
            } else {
                $jmlsetoran = $request->total_bunga_diambil;
            }
            if (is_null($request->inputpajak)) {
                $jmltarikan = 0;
            } else {
                $jmltarikan = $request->inputpajak;
            }

            $sqlupdatetab = "UPDATE tabung SET tabung.SALDO_SETORAN=(tabung.SALDO_SETORAN+$jmlsetoran),tabung.SALDO_PENARIKAN=(tabung.SALDO_PENARIKAN+$jmltarikan),tabung.SALDO_AKHIR=tabung.SALDO_AKHIR+($jmlsetoran-$jmltarikan) where tabung.NO_REKENING='$norekeningtab'";
            DB::select($sqlupdatetab);
            // INSERT Ke TELLERTRANS
            $maxIdTran = DB::select("SELECT MAX(TRANS_ID)+1 AS maxIdTran FROM tellertrans")[0]->maxIdTran;
            // INSERT RECORD BUNGA
            $simpanteller = new Tellertran();
            $simpanteller->trans_id = $maxIdTran;
            $simpanteller->modul = 'DEP';
            $simpanteller->tgl_trans = $request->tgl_trans;
            $simpanteller->NO_BUKTI = $request->kuitansi;
            $simpanteller->uraian = 'OB/PB Pengambilan bunga deposito :#' . $request->no_rekening . '-' . $request->nama_nasabah . ' ke Tabungan :#' . $request->no_rekening_tab;
            $simpanteller->my_kode_trans = 300;
            $simpanteller->saldo_trans = $request->bunga_bln_ini;
            $simpanteller->tob = substr($request->kode_trans, 4, 1);
            $simpanteller->modul_trans_id = $linkbng;
            $simpanteller->userid = Auth::id();
            $simpanteller->VALIDATED = 0;
            $simpanteller->POSTED = 0;
            $simpanteller->cab = $cab[0]->Value;
            $simpanteller->USERAPP = 0;
            $simpanteller->save();
            // INSERT RECORD PAJAK
            $simpanteller = new Tellertran();
            $simpanteller->trans_id = $maxIdTran + 1;
            $simpanteller->modul = 'DEP';
            $simpanteller->tgl_trans = $request->tgl_trans;
            $simpanteller->NO_BUKTI = $request->kuitansi;
            $simpanteller->uraian = 'Pajak bunga deposito :#' . $request->no_rekening . '-' . $request->nama_nasabah;
            $simpanteller->my_kode_trans = 200;
            $simpanteller->saldo_trans = $request->inputpajak;
            $simpanteller->tob = substr($request->kode_trans, 4, 1);
            $simpanteller->modul_trans_id = $linkpjk;
            $simpanteller->userid = Auth::id();
            $simpanteller->VALIDATED = 0;
            $simpanteller->POSTED = 0;
            $simpanteller->cab = $cab[0]->Value;
            $simpanteller->USERAPP = 0;
            $simpanteller->save();

            // INSERT RECORD TITIPAN
            $simpanteller = new Tellertran();
            $simpanteller->trans_id = $maxIdTran + 2;
            $simpanteller->modul = 'DEP';
            $simpanteller->tgl_trans = $request->tgl_trans;
            $simpanteller->NO_BUKTI = $request->kuitansi;
            $simpanteller->uraian = 'OB/PB Pengambilan Titipan Bunga Deposito :#' . $request->no_rekening . '-' . $request->nama_nasabah . ' Ke Tabungan :#' . $request->no_rekening_tab;
            $simpanteller->my_kode_trans = 300;
            $simpanteller->saldo_trans = $request->titipan_ambil;
            $simpanteller->tob = substr($request->kode_trans, 4, 1);
            $simpanteller->modul_trans_id = $linkttp;
            $simpanteller->userid = Auth::id();
            $simpanteller->VALIDATED = 0;
            $simpanteller->POSTED = 0;
            $simpanteller->cab = $cab[0]->Value;
            $simpanteller->USERAPP = 0;
            $simpanteller->save();
        } //--------BATAS TRANSAKSI TABUNGAN

        if ($setorandep->exists) {
            $msg = '1';
            $msgdetail = 'Proses Berhasil';
        } else {
            $msg = '0';
            $msgdetail = 'Proses Simpan Data Gagal!';
        }

        return redirect()->route('showpengambilanbungadeposito')->with('alert', 'Transaksi Pengambilan Bunga Deposito Selesai');
    }
    //PENUTUPAN DEPOSITO
    public function bo_tl_td_penutupandeposito()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetransdep = Kodetransdeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodecabang = Kodecabang::where('DATA_CAB', '=', 'mydata')->get();
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id');
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        return view('teller/deposito/frmpenutupandeposito', ['users' => $users, 'logos' => $logos, 'tabungans' => $tabungans, 'depositos' => $depositos, 'golonganpihaklawan' => $golonganpihaklawan, 'kodetransdep' => $kodetransdep, 'kodetranstab' => $kodetranstab, 'kodecabang' => $kodecabang, 'msgstatus' => '', 'msgview' => '']);
    }
}
