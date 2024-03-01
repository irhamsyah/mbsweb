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
use App\Tabungan;
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
        $tabungans = Tabungan::select('tabung.NO_REKENING','nasabah.nama_nasabah','nasabah.alamat')
                      ->leftJoin('nasabah', function($join) {
                        $join->on('nasabah.nasabah_id', '=', 'tabung.NASABAH_ID');
                        })
                      ->get()->toArray();
        return view('teller/kredit/frmrealisasikredit',['tabungans'=>$tabungans,'kodetranskredit'=>$kodetranskredit,'tanggaltransaksi'=>$tanggal, 'kodetypekredit'=>$kodetypekredit,'kodejeniskredit'=>$kodejeniskredit,'kredits'=>$kredits, 'users'=>$users, 'logos'=>$logos,'tabungan'=>$tabungan,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=>'']);
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
                    'POKOK_SALDO_AKHIR' => $request->input("jml_pinjaman"),
                    'BUNGA_SALDO_REALISASI' => $request->input("jumlah_bunga"),
                    'BUNGA_SALDO_AKHIR' => $request->input("jumlah_bunga")
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
            $newkretrans->TOB =  $request->input("tipe_transaksi");
            $newkretrans->VALIDATED = 1;
            $newkretrans->save();
            
            $newtellertrans = New Tellertran();
            $newtellertrans->modul = "KRE";
            $newtellertrans->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newtellertrans->NO_BUKTI =  $request->input("no_bukti");
            if($request->input("tipe_transaksi")=="T"){
                $newtellertrans->uraian = "Realisasi Kredit Tunai : #". $request->input("no_rekening_kredit")."-".$request->input("nama_nasabah");
            }
            if($request->input("tipe_transaksi")=="O"){
                $newtellertrans->uraian = "OB/PB Realisasi Kredit : #". $request->input("no_rekening_kredit")."-".$request->input("nama_nasabah")." Ke Tabungan: #".$request->input("rekening_overbook")."-".$request->input("nama_overbook");
            }
            
            $newtellertrans->my_kode_trans = "300";
            $newtellertrans->saldo_trans = $request->input("jml_pinjaman");
            $newtellertrans->tob = $request->input("tipe_transaksi");
            $newtellertrans->cab = "001";
            $newtellertrans->save();

            $newtellertrans2 = New Tellertran();
            $newtellertrans2->modul = "KRE";
            $newtellertrans2->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newtellertrans2->NO_BUKTI =  $request->input("no_bukti");
            $newtellertrans2->uraian = "Provisi Realisasi Kredit : #". $request->input("no_rekening_kredit")."-".$request->input("nama_nasabah");
            $newtellertrans2->my_kode_trans = "200";
            $newtellertrans2->saldo_trans = $request->input("provisi");
            $newtellertrans2->tob = $request->input("tipe_transaksi");
            $newtellertrans2->cab = "001";
            $newtellertrans2->save();

            $newtellertrans3 = New Tellertran();
            $newtellertrans3->modul = "KRE";
            $newtellertrans3->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newtellertrans3->NO_BUKTI =  $request->input("no_bukti");
            $newtellertrans3->uraian = "Administrasi Realisasi Kredit : #". $request->input("no_rekening_kredit")."-".$request->input("nama_nasabah");
            $newtellertrans3->my_kode_trans = "200";
            $newtellertrans3->saldo_trans = $request->input("administrasi");
            $newtellertrans3->tob = $request->input("tipe_transaksi");
            $newtellertrans3->cab = "001";
            $newtellertrans3->save();

            if($request->input("tipe_transaksi")=="O"){
                $newtabtrans = New Tabtran();
                $newtabtrans->LINK_MODUL = "KRE";
                $newtabtrans->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
                $newtabtrans->NO_REKENING = $request->input("rekening_overbook");
                $newtabtrans->KODE_TRANS = "08";
                $newtabtrans->SALDO_TRANS = $request->input("jml_pinjaman");
                $newtabtrans->MY_KODE_TRANS = "185";
                $newtabtrans->KUITANSI = $request->input("no_bukti");
                $newtabtrans->TOB = $request->input("tipe_transaksi");
                $newtabtrans->POSTED = 1;
                $newtabtrans->VALIDATED = 1;
                $newtabtrans->KETERANGAN = "Realisasi Kredit";
                $newtabtrans->FLAG_CETAK = "N";
                $newtabtrans->CAB = "001";
                $newtabtrans->LINK_REKENING = $request->input("no_rekening_kredit");
                $newtabtrans->save();

                $newtabtrans2 = New Tabtran();
                $newtabtrans2->LINK_MODUL = "KRE";
                $newtabtrans2->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
                $newtabtrans2->NO_REKENING = $request->input("rekening_overbook");
                $newtabtrans2->KODE_TRANS = "04";
                $newtabtrans2->SALDO_TRANS = $request->input("provisi")+$request->input("administrasi");
                $newtabtrans2->MY_KODE_TRANS = "295";
                $newtabtrans2->KUITANSI = $request->input("no_bukti");
                $newtabtrans2->TOB = $request->input("tipe_transaksi");
                $newtabtrans2->POSTED = 1;
                $newtabtrans2->VALIDATED = 1;
                // $newtabtrans2->KETERANGAN = "Realisasi Kredit";
                $newtabtrans2->FLAG_CETAK = "N";
                $newtabtrans2->CAB = "001";
                $newtabtrans2->LINK_REKENING = $request->input("no_rekening_kredit");
                $newtabtrans2->save();
            }

            DB::commit();
            return redirect()->back() ->with('alert', 'Realisasi kredit berhasil!');
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            return redirect()->back() ->with('alert', 'Realisasi kredit gagal!');
        }         
    }
    public function bo_tl_tk_setoranangsuran()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetranstab = Kodetranstabungan::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodejeniskredit=Kodejeniskredit::all();
        $kodetranskredit=Kodetranskredit::all();
        $kodetypekredit = KodeTypeKredit::all()->sort();
        $tabungan = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        $angsuran = Kretrans::select('kretrans.*')
                    ->where(function ($query){
                        $query->where('MY_KODE_TRANS', '=', 200);
                        })  
                    ->orderBy('NO_REKENING','DESC')
                    ->get();
        $cicilan = Kretrans::select('kretrans.*')
                    ->where(function ($query){
                        $query->where('MY_KODE_TRANS', '=', 300);
                        })  
                    ->orderBy('NO_REKENING','DESC')
                    ->get();
        $kredits = Kredit::select('nasabah.*','kredit.*')
          ->leftJoin('kodejeniskredit', function($join) {
          $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
          })
          ->join('nasabah', function($join) {
              $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
            })
          ->where(function ($query){
            $query->where('STATUS_AKTIF', '=', 2);
            // ->orWhere('STATUS_AKTIF', '=', 3)
            // ->orWhere('STATUS_AKTIF', '=', 2);
            })  
            ->orderBy('NO_REKENING','DESC')
            ->get();
        $tanggaltransaksi = Mysysid::select('Value')->where('KeyName','=','TANGGALHARIINI')->get();
        // echo json_decode($tanggaltransaksi, true)[0]["Value"];
        $a_date = \DateTime::createFromFormat('d/m/Y', json_decode($tanggaltransaksi, true)[0]["Value"])->format('Y-m-d');
        $tglakhirbulan = date("t/m/Y", strtotime($a_date));
        $tanggal = $tanggaltransaksi[0]->Value;
        $tabungans = Tabungan::select('tabung.NO_REKENING','nasabah.nama_nasabah','nasabah.alamat')
                      ->leftJoin('nasabah', function($join) {
                        $join->on('nasabah.nasabah_id', '=', 'tabung.NASABAH_ID');
                        })
                      ->get()->toArray();
        return view('teller/kredit/frmsetoranangsuran',['tglakhirbulan'=>$tglakhirbulan,'tabungans'=>$tabungans,'kodetranskredit'=>$kodetranskredit,'tanggaltransaksi'=>$tanggal, 'kodetypekredit'=>$kodetypekredit,'kodejeniskredit'=>$kodejeniskredit,'kredits'=>$kredits, 'users'=>$users, 'logos'=>$logos,'tabungan'=>$tabungan,'kodetranstab'=>$kodetranstab,'kodecabang'=>$kodecabang,'msgstatus'=>'']);
    }

    public function saveAngsuran(Request $request)
    {          
        try {
            DB::beginTransaction();
            // database queries here
            Kredit::where('NO_REKENING',$request->input("no_rekening_kredit"))
                ->update([
                    'STATUS_AKTIF' => 2,
                    'POKOK_SALDO_AKHIR' => $request->input("jml_pinjaman"),
                    'BUNGA_SALDO_AKHIR' => $request->input("jumlah_bunga"),
                    'POKOK_SALDO_SETORAN' => $request->input("pokok_pembayaran"),
                    'POKOK_TUNGGAKAN_AKHIR' => 0 - $request->input("pokok_pembayaran"),
                    'BUNGA_SALDO_SETORAN' => $request->input("bunga_pembayaran"),
                    'BUNGA_TUNGGAKAN_AKHIR' => 0 - $request->input("bunga_pembayaran"),
                ]);
                
            $newkretrans = New Kretrans();
            $newkretrans->NO_REKENING = $request->input("no_rekening_kredit");
            $newkretrans->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_trans"))->format('Y-m-d');
            $newkretrans->POKOK_TRANS = $request->input("pokok_pembayaran");
            $newkretrans->ANGSURAN_KE = 0;
            $newkretrans->BUNGA_TRANS = $request->input("bunga_pembayaran");
            // $newkretrans->PROVISI_TRANS = $request->input("provisi");
            // $newkretrans->ADM_TRANS = $request->input("administrasi");
            $newkretrans->MY_KODE_TRANS = '300';
            $newkretrans->KODE_TRANS = $request->input("kode_transkredit");
            $newkretrans->KUITANSI =  $request->input("kwitansi");
            $newkretrans->KETERANGAN =  $request->input("keterangan");
            $newkretrans->TOB =  $request->input("tob");
            $newkretrans->VALIDATED = 1;
            $newkretrans->save();
            DB::commit();
            $out['message']= "Bayar angsuran kredit berhasil!";
            $out['status']=1;
            return $out;
            
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            $out['message']= "Bayar angsuran kredit gagal!";
            $out['status']=0;
            return $out;
            
        }   
    }

    public function getAngsuran(Request $request){
        $norek = $request->input("norek");
        // dd($norek);
        $angsuran = Kretrans::select('kretrans.*')
                    ->where(function ($query){
                        $query->where('MY_KODE_TRANS', '=', 200);
                        })
                    ->where('kretrans.NO_REKENING', '=', $norek) 
                    ->orderBy('ANGSURAN_KE')
                    ->get();
         return $angsuran;           

    }

    public function getCicilan(Request $request){
        $norek = $request->input("norek");
        // dd($norek);
        $angsuran = Kretrans::select('kretrans.*')
                    ->where(function ($query){
                        $query->where('MY_KODE_TRANS', '=', 300);
                        })
                    ->where('kretrans.NO_REKENING', '=', $norek) 
                    ->orderBy('CICILAN_KE')
                    ->get();
         return $angsuran;           

    }
}
