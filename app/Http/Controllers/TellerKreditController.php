<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Logo;
use App\Kodetranstabungan;
use App\Kodecabang;
use App\Tabtran;
use App\Tellertran;
use App\Kredit;
use App\Kodejeniskredit;
use App\KodeTypeKredit;
use Illuminate\Support\Facades\Auth;

class TellerKreditController extends Controller
{
    public function bo_tl_tk_realisasikredit()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetranstab = Kodetranstabungan::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodejeniskredit=Kodejeniskredit::all();
        $kodetypekredit = KodeTypeKredit::all()->sort();
        $tabungan = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        $kredits = Kredit::select('nasabah.*','kredit.*')
          ->leftJoin('kodejeniskredit', function($join) {
          $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
          })
          ->join('nasabah', function($join) {
              $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
            })
          ->where(function ($query){
            $query->where('STATUS_AKTIF', '=', 2)
            ->orWhere('STATUS_AKTIF', '=', 3)
            ->orWhere('STATUS_AKTIF', '=', 1);
            })  
            ->get();
        return view('teller/kredit/frmrealisasikredit',['kodetypekredit'=>$kodetypekredit,'kodejeniskredit'=>$kodejeniskredit,'kredits'=>$kredits, 'users'=>$users, 'logos'=>$logos,'tabungan'=>$tabungan,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=>'']);
    }
    // SIMPAN DATA TRANSAKSI
    public function bo_tl_tt_simpantrstabungan(Request $request)
    {   
        $this->validate($request,[
            'no_rekening'=>'required',
            'tgl_trans'=>'required',
            'kode_trans'=>'required',
            'pembayaran'=>'required',
            'kuitansi'=>'required',
        ]);
        $transaksi = new Tabtran();
        $transaksi->TGL_TRANS = $request->tgl_trans;
        $transaksi->NO_REKENING = $request->no_rekening;
        $transaksi->KODE_TRANS = substr($request->kode_trans,0,2);
        $transaksi->SALDO_TRANS = (float)preg_replace("/[^0-9]/", "", $request->pembayaran);
        if(substr($request->kode_trans,5,1)=='K'){
            $transaksi->MY_KODE_TRANS = 100;
        }elseif(substr($request->kode_trans,5,1)=='D'){
            $transaksi->MY_KODE_TRANS = 200;
        }
        $transaksi->KUITANSI = $request->kuitansi;
        $transaksi->USERID=Auth::id();
        $transaksi->TOB = substr($request->kode_trans,3,1);
        $transaksi->POSTED = 0;
        $transaksi->VALIDATED = 1;
        $transaksi->KETERANGAN = $request->keterangan;
        $transaksi->TGL_INPUT = $request->tgl_trans;
        $transaksi->CAB = $request->cab;
        $transaksi->tob_RAK = 'T';
        $transaksi->save();
        // UPDATE TABUNG
        $norekpegangan = $request->no_rekening;
        $tgl = $request->tgl_trans;
        $sldnomi=DB::select("SELECT (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as debet FROM tabung inner join tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING where (tabung.NO_REKENING='$norekpegangan' AND tabtrans.TGL_TRANS<='$tgl') GROUP BY tabung.NO_REKENING")[0]->debet;
        $sldsetor=DB::select("SELECT (SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<='$tgl',SALDO_TRANS,0))) as debet FROM tabtrans where (NO_REKENING='$norekpegangan') GROUP BY NO_REKENING")[0]->debet;
        $sldtarik=DB::select("SELECT (SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<='$tgl',SALDO_TRANS,0))) as debet FROM tabtrans where (NO_REKENING='$norekpegangan') GROUP BY NO_REKENING")[0]->debet;
        $sqlupdate="UPDATE tabung SET tabung.ADM_BLN_INI=tabung.ADM_PER_BLN,tabung.SALDO_AKHIR=$sldnomi,tabung.SALDO_SETORAN=$sldsetor,tabung.SALDO_PENARIKAN=$sldtarik where tabung.NO_REKENING='$norekpegangan'";
        DB::select($sqlupdate);
        // --------------
        // UPDATE KE TABLES TELLERTRANS
        $sql=DB::select("SELECT * FROM tabtrans WHERE KUITANSI ='$request->kuitansi' AND TGL_TRANS='$request->tgl_trans'");
        for($i=0;$i<count($sql);$i++){
            if(substr($request->kode_trans,5,1)=='K'){
                $inputtellertran=new Tellertran();
                $inputtellertran->modul = 'TAB';
                $inputtellertran->tgl_trans = $request->tgl_trans;
                $inputtellertran->NO_BUKTI=$request->kuitansi;
                $inputtellertran->uraian='Setoran tabungan: '.$request->no_rekening.'-'. $request->nama_nasabah;
                $inputtellertran->my_kode_trans='200';
                $inputtellertran->saldo_trans= (float)preg_replace("/[^0-9]/", "", $request->pembayaran);
                $inputtellertran->tob=$transaksi->TOB;
                $inputtellertran->tob_RAK='T';
                $inputtellertran->modul_trans_id=$sql[$i]->TABTRANS_ID;
                $inputtellertran->userid=Auth::id();
                $inputtellertran->VALIDATED=0;
                $inputtellertran->POSTED=0;
                $inputtellertran->cab=$request->cab;
                $msgbox=$inputtellertran->save();

            }else{
                $inputtellertran=new Tellertran();
                $inputtellertran->modul = 'TAB';
                $inputtellertran->tgl_trans = $request->tgl_trans;
                $inputtellertran->NO_BUKTI=$request->kuitansi;
                $inputtellertran->uraian='Penarikan tabungan: '.$request->no_rekening.'-'. $request->nama_nasabah;
                $inputtellertran->my_kode_trans='300';
                $inputtellertran->saldo_trans= (float)preg_replace("/[^0-9]/", "", $request->pembayaran);
                $inputtellertran->tob=$transaksi->TOB;
                $inputtellertran->tob_RAK='T';
                $inputtellertran->modul_trans_id=$sql[$i]->TABTRANS_ID;
                $inputtellertran->userid=Auth::id();
                $inputtellertran->VALIDATED=0;
                $inputtellertran->POSTED=0;
                $inputtellertran->cab=$request->cab;
                $msgbox=$inputtellertran->save();

            }
        }
        return redirect()->back() ->with('alert', 'Transaksi berhasil ditambahkan!');

    }
}
