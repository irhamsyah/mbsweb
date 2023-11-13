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
use App\Kodecabang;
use App\Deptran;
use App\Tabtran;
use App\Golonganpihaklawan;
use Illuminate\Support\Facades\Auth;

class TellerDepositoController extends Controller
{
    public function bo_tl_td_setorandeposito()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetransdep = Kodetransdeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id');
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        return view('teller/deposito/frmsetorandeposito',['users'=>$users, 'logos'=>$logos,'tabungans'=>$tabungans,'depositos'=>$depositos,'golonganpihaklawan'=>$golonganpihaklawan,'kodetransdep'=>$kodetransdep,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=> '','msgview'=> '']);
    }
    //SIMPAN SETORAN DEPOSITO TELLER
    public function bo_tl_td_setorandeposito_add(Request $request)
    {
        $maxId=DB::select("SELECT MAX(DEPTRANS_ID)+1 AS maxIdDeptran FROM deptrans")[0]->maxIdDeptran;
        // dd($maxId);
        $setorandep = new Deptran();
        $setorandep->DEPTRANS_ID = $request->maxId;
        $setorandep->TGL_TRANS = $request->tgl_trans;
        $setorandep->NO_REKENING = $request->no_rekening;
        $setorandep->KODE_TRANS = substr($request->kode_trans,0,3);
        $setorandep->SALDO_SEBELUM = '0,00';
        $setorandep->SALDO_TRANS = $request->jumlah_setoran;
        $setorandep->SALDO_SETELAH = '0,00';
        $setorandep->KUITANSI = $request->kuitansi;
        $setorandep->NO_TELLER = 0;
        $setorandep->USERID=Auth::id();
        $setorandep->TOB = substr($request->kode_trans,4,1);
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
        
        // UPDATE DEPOSITO
        $norekeningdep = $request->no_rekening;
        $tgl = $request->tgl_trans;
        $jmlsetoran = $request->jumlah_setoran;
        $sqlupdatedep="UPDATE deposito SET deposito.STATUS_AKTIF=2,deposito.SALDO_AKHIR=$jmlsetoran,deposito.SALDO_SETORAN=$jmlsetoran where deposito.NO_REKENING='$norekeningdep'";
        DB::select($sqlupdatedep);
        // --------------
        // UPDATE KE TABLES DEPTRANS TELLER
        $maxIdTab=DB::select("SELECT MAX(TABTRANS_ID)+1 AS maxIdTabtran FROM tabtrans")[0]->maxIdTabtran;
        $tabtrans = new Tabtran();
        $tabtrans->TABTRANS_ID = $maxIdTab;
        $tabtrans->TGL_TRANS = $request->tgl_trans;
        $tabtrans->NO_REKENING = $request->no_rekening_tab;
        $tabtrans->KODE_TRANS = substr($request->kode_trans_tab,0,2);
        $tabtrans->SALDO_TRANS = $request->jumlah_setoran;
        $tabtrans->KUITANSI = $request->kuitansi;
        $tabtrans->NO_TELLER = 0;
        $tabtrans->USERID=Auth::id();
        $tabtrans->TOB =substr($request->kode_trans,4,1);
        $tabtrans->POSTED = 1;
        $tabtrans->VALIDATED = 1;
        $tabtrans->NO_REK_OB = $request->no_rekening;
        $tabtrans->SALDO_AWAL_HARI = 0;
        $tabtrans->TGL_INPUT = NULL;
        $tabtrans->CAB = $request->cab;
        $tabtrans->LINK_MODUL = 'DEP';
        $tabtrans->LINK_ID = $maxId;
        $tabtrans->LINK_REKENING = $request->no_rekening;
        $tabtrans->USERAPP = 0;
        $tabtrans->FLAG_CETAK = 'N';
        $tabtrans->MY_KODE_TRANS = 270;
        $tabtrans->save();

        // UPDATE TABUNG
        if($norekeningtab!=""){
            $norekeningtab = $request->no_rekening_tab;
            $jmlsetoran = $request->jumlah_setoran;
            $sqlupdatetab="UPDATE tabung SET tabung.SALDO_PENARIKAN=tabung.SALDO_PENARIKAN-$jmlsetoran,tabung.SALDO_AKHIR=tabung.SALDO_AKHIR-$jmlsetoran where tabung.NO_REKENING='$norekeningtab'";
            DB::select($sqlupdatetab);
        }

        if ($setorandep->exists){
            $msg='1';
            $msgdetail='Proses Berhasil';
        }else{
            $msg='0';
            $msgdetail='Proses Simpan Data Gagal!';
        }

        $users = User::all();
        $logos = Logo::all();
        $kodetransdep = Kodetransdeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id');
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        return view('teller/deposito/frmsetorandeposito',['users'=>$users, 'logos'=>$logos,'tabungans'=>$tabungans,'depositos'=>$depositos,'golonganpihaklawan'=>$golonganpihaklawan,'kodetransdep'=>$kodetransdep,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=> '','msgview'=> '']);
    
    }

    //PENGAMBILAN BUNGA DEPOSITO
    public function bo_tl_td_pengambilanbungadeposito()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetransdep = Kodetransdeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id');
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        return view('teller/deposito/frmpengambilanbungadeposito',['users'=>$users, 'logos'=>$logos,'tabungans'=>$tabungans,'depositos'=>$depositos,'golonganpihaklawan'=>$golonganpihaklawan,'kodetransdep'=>$kodetransdep,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=> '','msgview'=> '']);
    }
    //SIMPAN PENGAMBILAN BUNGA DEPOSITO TELLER
    public function bo_tl_td_pengambilanbungadeposito_add(Request $request)
    {
        $maxId=DB::select("SELECT MAX(DEPTRANS_ID)+1 AS maxIdDeptran FROM deptrans")[0]->maxIdDeptran;
        // dd($maxId);
        $setorandep = new Deptran();
        $setorandep->DEPTRANS_ID = $request->maxId;
        $setorandep->TGL_TRANS = $request->tgl_trans;
        $setorandep->NO_REKENING = $request->no_rekening;
        $setorandep->KODE_TRANS = substr($request->kode_trans,0,3);
        $setorandep->SALDO_SEBELUM = '0,00';
        $setorandep->SALDO_TRANS = $request->jumlah_setoran;
        $setorandep->SALDO_SETELAH = '0,00';
        $setorandep->KUITANSI = $request->kuitansi;
        $setorandep->NO_TELLER = 0;
        $setorandep->USERID=Auth::id();
        $setorandep->TOB = substr($request->kode_trans,4,1);
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
        
        // UPDATE DEPOSITO
        $norekeningdep = $request->no_rekening;
        $tgl = $request->tgl_trans;
        $jmlsetoran = $request->jumlah_setoran;
        $sqlupdatedep="UPDATE deposito SET deposito.STATUS_AKTIF=2,deposito.SALDO_AKHIR=$jmlsetoran,deposito.SALDO_SETORAN=$jmlsetoran where deposito.NO_REKENING='$norekeningdep'";
        DB::select($sqlupdatedep);
        // --------------
        // UPDATE KE TABLES DEPTRANS TELLER
        $maxIdTab=DB::select("SELECT MAX(TABTRANS_ID)+1 AS maxIdTabtran FROM tabtrans")[0]->maxIdTabtran;
        $tabtrans = new Tabtran();
        $tabtrans->TABTRANS_ID = $maxIdTab;
        $tabtrans->TGL_TRANS = $request->tgl_trans;
        $tabtrans->NO_REKENING = $request->no_rekening_tab;
        $tabtrans->KODE_TRANS = substr($request->kode_trans_tab,0,2);
        $tabtrans->SALDO_TRANS = $request->jumlah_setoran;
        $tabtrans->KUITANSI = $request->kuitansi;
        $tabtrans->NO_TELLER = 0;
        $tabtrans->USERID=Auth::id();
        $tabtrans->TOB =substr($request->kode_trans,4,1);
        $tabtrans->POSTED = 1;
        $tabtrans->VALIDATED = 1;
        $tabtrans->NO_REK_OB = $request->no_rekening;
        $tabtrans->SALDO_AWAL_HARI = 0;
        $tabtrans->TGL_INPUT = NULL;
        $tabtrans->CAB = $request->cab;
        $tabtrans->LINK_MODUL = 'DEP';
        $tabtrans->LINK_ID = $maxId;
        $tabtrans->LINK_REKENING = $request->no_rekening;
        $tabtrans->USERAPP = 0;
        $tabtrans->FLAG_CETAK = 'N';
        $tabtrans->MY_KODE_TRANS = 270;
        $tabtrans->save();

        // UPDATE TABUNG
        if($norekeningtab!=""){
            $norekeningtab = $request->no_rekening_tab;
            $jmlsetoran = $request->jumlah_setoran;
            $sqlupdatetab="UPDATE tabung SET tabung.SALDO_PENARIKAN=tabung.SALDO_PENARIKAN-$jmlsetoran,tabung.SALDO_AKHIR=tabung.SALDO_AKHIR-$jmlsetoran where tabung.NO_REKENING='$norekeningtab'";
            DB::select($sqlupdatetab);
        }

        if ($setorandep->exists){
            $msg='1';
            $msgdetail='Proses Berhasil';
        }else{
            $msg='0';
            $msgdetail='Proses Simpan Data Gagal!';
        }

        $users = User::all();
        $logos = Logo::all();
        $kodetransdep = Kodetransdeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id');
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        return view('teller/deposito/frmpengambilanbungadeposito',['users'=>$users, 'logos'=>$logos,'tabungans'=>$tabungans,'depositos'=>$depositos,'golonganpihaklawan'=>$golonganpihaklawan,'kodetransdep'=>$kodetransdep,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=> '','msgview'=> '']);
    
    }
    //PENUTUPAN DEPOSITO
    public function bo_tl_td_penutupandeposito()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetransdep = Kodetransdeposito::all();
        $kodetranstab = Kodetranstabungan::all();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $depositos = DB::select('select deposito.*,nasabah.nama_nasabah,nasabah.alamat FROM deposito LEFT JOIN nasabah ON deposito.NASABAH_ID = nasabah.nasabah_id');
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        return view('teller/deposito/frmpenutupandeposito',['users'=>$users, 'logos'=>$logos,'tabungans'=>$tabungans,'depositos'=>$depositos,'golonganpihaklawan'=>$golonganpihaklawan,'kodetransdep'=>$kodetransdep,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=> '','msgview'=> '']);
    }
}
