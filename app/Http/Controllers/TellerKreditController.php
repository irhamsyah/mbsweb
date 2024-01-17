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
use App\Kodetranskredit;
use App\Kretrans;
use App\Mysysid;
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
        $kodetranskredit=Kodetranskredit::all();
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
            $query->where('STATUS_AKTIF', '=', 1);
            // ->orWhere('STATUS_AKTIF', '=', 3)
            // ->orWhere('STATUS_AKTIF', '=', 2);
            })  
            ->get();
        $tanggaltransaksi = Mysysid::select('Value')->where('KeyName','=','TANGGALHARIINI')->get();
        $tanggal = $tanggaltransaksi[0]->Value;
        return view('teller/kredit/frmrealisasikredit',['kodetranskredit'=>$kodetranskredit,'tanggaltransaksi'=>$tanggal, 'kodetypekredit'=>$kodetypekredit,'kodejeniskredit'=>$kodejeniskredit,'kredits'=>$kredits, 'users'=>$users, 'logos'=>$logos,'tabungan'=>$tabungan,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=>'']);
    }
    // SIMPAN DATA TRANSAKSI
    public function setrealisasi(Request $request)
    {          
        try {
            DB::beginTransaction();
            // database queries here
            Kredit::where('NO_REKENING',$request->input("no_rekening_kredit"))
                ->update([
                    'STATUS_AKTIF' => 2,
                    'POKOK_SALDO_REALISASI' => $request->input("jml_pinjaman"),
                    'POKOK_SALDO_AKHIR' => $request->input("total_diterima")
                ]);

            $newkretrans = New Kretrans();
            $newkretrans->NO_REKENING = $request->input("no_rekening_kredit");
            $newkretrans->norekening2 = $request->input("no_rekening_kredit");
            $newkretrans->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newkretrans->POKOK_TRANS = $request->input("jml_pinjaman");
            $newkretrans->BUNGA_TRANS = $request->input("jumlah_bunga");
            $newkretrans->PROVISI_TRANS = $request->input("provisi");
            $newkretrans->ADM_TRANS = $request->input("administrasi");
            $newkretrans->MY_KODE_TRANS = '100';
            $newkretrans->KODE_TRANS = $request->input("kode_transaksi3");
            $newkretrans->KUITANSI =  $request->input("no_bukti");
            $newkretrans->VALIDATED = 1;
            $newkretrans->save();
            
            $newtellertrans = New Tellertran();
            $newtellertrans->modul = "KRE";
            $newtellertrans->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newtellertrans->NO_BUKTI =  $request->input("no_bukti");
            $newtellertrans->uraian = "Realisasi Kredit Tunai : #". $request->input("no_rekening_kredit")."-".$request->input("nama_nasabah");
            $newtellertrans->my_kode_trans = "300";
            $newtellertrans->saldo_trans = $request->input("jml_pinjaman");
            $newtellertrans->tob = "T";
            $newtellertrans->cab = "001";
            $newtellertrans->save();

            $newtellertrans2 = New Tellertran();
            $newtellertrans2->modul = "KRE";
            $newtellertrans2->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newtellertrans2->NO_BUKTI =  $request->input("no_bukti");
            $newtellertrans2->uraian = "Provisi Realisasi Kredit : #". $request->input("no_rekening_kredit")."-".$request->input("nama_nasabah");
            $newtellertrans2->my_kode_trans = "200";
            $newtellertrans2->saldo_trans = $request->input("provisi");
            $newtellertrans2->tob = "T";
            $newtellertrans2->cab = "001";
            $newtellertrans2->save();

            $newtellertrans3 = New Tellertran();
            $newtellertrans3->modul = "KRE";
            $newtellertrans3->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newtellertrans3->NO_BUKTI =  $request->input("no_bukti");
            $newtellertrans3->uraian = "Administrasi Realisasi Kredit : #". $request->input("no_rekening_kredit")."-".$request->input("nama_nasabah");
            $newtellertrans3->my_kode_trans = "200";
            $newtellertrans3->saldo_trans = $request->input("administrasi");
            $newtellertrans3->tob = "T";
            $newtellertrans3->cab = "001";
            $newtellertrans3->save();

            DB::commit();
            return redirect()->back() ->with('alert', 'Realisasi kredit berhasil!');
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            return redirect()->back() ->with('alert', 'Realisasi kredit gagal!');
        }         
    }
}
