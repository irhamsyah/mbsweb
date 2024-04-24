<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Logo;
use App\Kodetranstabungan;
use App\Kodecabang;
use App\Mysysid;
use App\Tabtran;
use App\Tellertran;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TellertabunganController extends Controller
{
    public function bo_tl_tt_setoranpenarikantabungan()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetranstab = Kodetranstabungan::all();
        $tgl = Mysysid::where('KeyName', '=', 'TANGGALHARIINI')->get();
        $tglharini = str_replace('/', '-', $tgl[0]->Value);
        $kodecabang = Kodecabang::where('DATA_CAB', '=', 'mydata')->get();
        $tabungan = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2 OR tabung.STATUS_AKTIF=1");
        return view('teller/tabungan/frmsetoranpenarikan', ['users' => $users, 'logos' => $logos, 'tabungan' => $tabungan, 'kodetranstab' => $kodetranstab, 'kodecabang' => $kodecabang, 'tglharini' => $tglharini, 'msgstatus' => '']);
    }
    // GET TRANSAKSI 
    public function getTransaksi(Request $request)
    {
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get()->toArray()[0]['Value'];
        $tgllogin=date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin)));
        $norek = $request->norek;
        $transaksi = Tabtran::where('NO_REKENING', '=',$norek)
                                ->where('TGL_TRANS', '=',$tgllogin)
                                ->get();
                    return $transaksi;
    }
    // SIMPAN DATA TRANSAKSI
    public function bo_tl_tt_simpantrstabungan(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'no_rekening' => 'required',
            'tgl_trans' => 'required',
            'kode_trans' => 'required',
            'pembayaran' => 'required',
            'kuitansi' => 'required',
        ]);
        // SIMPAN TABTRANS
        $transaksi = new Tabtran();
        $transaksi->TGL_TRANS = $request->tgl_trans;
        $transaksi->NO_REKENING = $request->no_rekening;
        $transaksi->KODE_TRANS = substr($request->kode_trans, 0, 2);
        $transaksi->SALDO_TRANS = (float)preg_replace("/[^0-9]/", "", $request->pembayaran);
        if (substr($request->kode_trans, 5, 1) == 'K') {
            $transaksi->MY_KODE_TRANS = 100;
        } elseif (substr($request->kode_trans, 5, 1) == 'D') {
            $transaksi->MY_KODE_TRANS = 200;
        }
        $transaksi->KUITANSI = $request->kuitansi;
        $transaksi->USERID = Auth::id();
        $transaksi->TOB = substr($request->kode_trans, 3, 1);
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
        $sldnomi = DB::select("SELECT (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as debet FROM tabung inner join tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING where (tabung.NO_REKENING='$norekpegangan' AND tabtrans.TGL_TRANS<='$tgl') GROUP BY tabung.NO_REKENING")[0]->debet;
        $sldsetor = DB::select("SELECT (SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<='$tgl',SALDO_TRANS,0))) as debet FROM tabtrans where (NO_REKENING='$norekpegangan') GROUP BY NO_REKENING")[0]->debet;
        $sldtarik = DB::select("SELECT (SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<='$tgl',SALDO_TRANS,0))) as debet FROM tabtrans where (NO_REKENING='$norekpegangan') GROUP BY NO_REKENING")[0]->debet;
        $sqlupdate = "UPDATE tabung SET tabung.ADM_BLN_INI=tabung.ADM_PER_BLN,tabung.SALDO_AKHIR=$sldnomi,tabung.SALDO_SETORAN=$sldsetor,tabung.SALDO_PENARIKAN=$sldtarik,tabung.STATUS_AKTIF=2 where tabung.NO_REKENING='$norekpegangan'";
        DB::select($sqlupdate);
        // --------------
        // UPDATE KE TABLES TELLERTRANS
        $sql = DB::select("SELECT * FROM tabtrans WHERE KUITANSI ='$request->kuitansi' AND TGL_TRANS='$request->tgl_trans'");
        for ($i = 0; $i < count($sql); $i++) {
            if (substr($request->kode_trans, 5, 1) == 'K') {
                $inputtellertran = new Tellertran();
                $inputtellertran->modul = 'TAB';
                $inputtellertran->tgl_trans = $request->tgl_trans;
                $inputtellertran->NO_BUKTI = $request->kuitansi;
                $inputtellertran->uraian = 'Setoran tabungan: ' . $request->no_rekening . '-' . $request->nama_nasabah;
                $inputtellertran->my_kode_trans = '200';
                $inputtellertran->saldo_trans = (float)preg_replace("/[^0-9]/", "", $request->pembayaran);
                $inputtellertran->tob = $transaksi->TOB;
                $inputtellertran->tob_RAK = 'T';
                $inputtellertran->modul_trans_id = $sql[$i]->TABTRANS_ID;
                $inputtellertran->userid = Auth::id();
                $inputtellertran->VALIDATED = 0;
                $inputtellertran->POSTED = 0;
                $inputtellertran->cab = $request->cab;
                $msgbox = $inputtellertran->save();
            } else {
                $inputtellertran = new Tellertran();
                $inputtellertran->modul = 'TAB';
                $inputtellertran->tgl_trans = $request->tgl_trans;
                $inputtellertran->NO_BUKTI = $request->kuitansi;
                $inputtellertran->uraian = 'Penarikan tabungan: ' . $request->no_rekening . '-' . $request->nama_nasabah;
                $inputtellertran->my_kode_trans = '300';
                $inputtellertran->saldo_trans = (float)preg_replace("/[^0-9]/", "", $request->pembayaran);
                $inputtellertran->tob = $transaksi->TOB;
                $inputtellertran->tob_RAK = 'T';
                $inputtellertran->modul_trans_id = $sql[$i]->TABTRANS_ID;
                $inputtellertran->userid = Auth::id();
                $inputtellertran->VALIDATED = 0;
                $inputtellertran->POSTED = 0;
                $inputtellertran->cab = $request->cab;
                $msgbox = $inputtellertran->save();
            }
        }
        // return redirect()->back() ->with('alert', 'Transaksi berhasil ditambahkan!');
        $saldo_trans = (float)preg_replace("/[^0-9]/", "", $request->pembayaran);

        return view('pdf.tabungan.rptvalidasitrtabungan', ['tgl_trans' => $request->tgl_trans, 'no_rekening' => $request->no_rekening, 'nama_nasabah' => $request->nama_nasabah, 'kuitansi' => $request->kuitansi, 'saldo' => $sldnomi, 'setorambil' => $saldo_trans, 'kode_trans' => $request->kode_trans]);
    }
    // CETAK BUKU TABUNGAN
    public function bo_tl_tt_cetakbukutab(Request $request)
    {
        $rs = DB::select("select * from tabtrans where no_rekening='$request->no_rekening'");
        $sldak = 0;
        $saldo = DB::select("SELECT (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as debet FROM tabung inner join tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING where (tabung.NO_REKENING='$request->no_rekening' AND tabtrans.TGL_TRANS<'$$request->tgl_trans') GROUP BY tabung.NO_REKENING");
        if (count($saldo) > 0) {
            $sldak = $saldo[0]->debet;
        } else {
            $sldak = 0;
        }
        $pdf = Pdf::loadview('pdf.tabungan.rptbukutabungan', ['rs' => $rs, 'saldo' => $sldak])->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
    // TRANSAKSI TUTUP TABUNGAN 
    public function bo_tl_tt_penutupantabungan(Request $request)
    {
        $tgllogin = Mysysid::where('KeyName', '=', 'TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d', strtotime(str_replace('/', '-', $tgllogin[0]->Value)));
        $users = User::all();
        $logos = Logo::all();
        $tabungan = DB::select("select tabung.no_rekening,tabung.adm_bln_ini,nasabah.nama_nasabah,nasabah.alamat,X.saldo_akhir from (tabung inner join (SELECT tabung.NO_REKENING,(tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung inner join tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING where tabtrans.TGL_TRANS<='$tgllogin' GROUP BY tabung.NO_REKENING) as X on tabung.no_rekening=X.NO_REKENING) inner join nasabah on tabung.nasabah_id = nasabah.nasabah_id where tabung.status_aktif='2'");
        $kodetrstab = DB::select("select * from kodetranstabungan");
        $kodecabang = Kodecabang::where('DATA_CAB', '=', 'mydata')->get();
        if (isset($request->kuitansi)) {
            return view('teller.tabungan.frmtutuptabungan', ['users' => $users, 'logos' => $logos, 'tabungan' => $tabungan, 'kodetrstab' => $kodetrstab, 'tgllogin' => $tgllogin, 'cab' => $kodecabang[0]->kode_cab, 'msgstatus' => '', 'kuitansi' => $request->kuitansi, 'no_rekening' => $request->no_rekening, 'nama_nasabah' => $request->nama_nasabah, 'saldo' => $request->saldo, 'byadmin' => $request->byadmin, 'jml_transaksi' => $request->jml_transaksi, 'tgl_trans' => $request->tgl_trans]);
        } else {
            return view('teller.tabungan.frmtutuptabungan', ['users' => $users, 'logos' => $logos, 'tabungan' => $tabungan, 'kodetrstab' => $kodetrstab, 'tgllogin' => $tgllogin, 'cab' => $kodecabang[0]->kode_cab, 'msgstatus' => '']);
        }
    }
    // SIMPAN TRANSAKSI TUTUP TABUNGAN
    public function bo_tl_tt_penutupantabungan_add(Request $request)
    {
        $this->validate($request, [
            'byadmin' => 'required|numeric'
        ]);
        $maxId = DB::select("SELECT MAX(TABTRANS_ID)+1 AS maxIdTabtran FROM tabtrans")[0]->maxIdTabtran;
        // SIMPAN JML TARIKAN
        $savetabtrans = new Tabtran();
        $savetabtrans->TABTRANS_ID = $maxId;
        $savetabtrans->TGL_TRANS = $request->tgl_trans;
        $savetabtrans->NO_REKENING = $request->no_rekening;
        $savetabtrans->KODE_TRANS = substr($request->kode_trans, 0, 2);
        $savetabtrans->SALDO_TRANS = $request->jml_transaksi;
        $savetabtrans->MY_KODE_TRANS = 200;
        $savetabtrans->KUITANSI = $request->kuitansi;
        $savetabtrans->NO_TELLER = 0;
        $savetabtrans->USERID = Auth::id();
        $savetabtrans->TOB = $request->typetrans;
        $savetabtrans->POSTED = 0;
        $savetabtrans->VALIDATED = 1;
        $savetabtrans->KETERANGAN = $request->keterangan;
        $savetabtrans->CAB = $request->cab;
        $savetabtrans->tob_RAK = 'T';
        $savetabtrans->save();
        $modid1 = $savetabtrans->TABTRANS_ID;
        // SIMPAN JML ADMIN
        $savetabtrans = new Tabtran();
        $savetabtrans->TABTRANS_ID = $maxId + 1;
        $savetabtrans->TGL_TRANS = $request->tgl_trans;
        $savetabtrans->NO_REKENING = $request->no_rekening;
        $savetabtrans->KODE_TRANS = substr($request->kode_trans_adm, 0, 2);
        $savetabtrans->SALDO_TRANS = $request->byadmin;
        $savetabtrans->MY_KODE_TRANS = 259;
        $savetabtrans->KUITANSI = $request->kuitansi;
        $savetabtrans->NO_TELLER = 0;
        $savetabtrans->USERID = Auth::id();
        $savetabtrans->TOB = substr($request->kode_trans_adm, 5, 1);
        $savetabtrans->POSTED = 0;
        $savetabtrans->VALIDATED = 1;
        $savetabtrans->KETERANGAN = $request->keterangan;
        $savetabtrans->CAB = $request->cab;
        $savetabtrans->tob_RAK = 'T';
        $savetabtrans->save();
        $modid2 = $savetabtrans->TABTRANS_ID;

        // SIMPAN TELLERTRANS
        // ----TABUNGAN YG DIAMBIL
        $saveteller = new Tellertran();
        $maxId = DB::select("SELECT MAX(trans_id)+1 AS maxIdtran FROM tellertrans")[0]->maxIdtran;
        $saveteller->trans_id = $maxId;
        $saveteller->modul  = 'TAB';
        $saveteller->tgl_trans = $request->tgl_trans;
        $saveteller->NO_BUKTI = $request->kuitansi;
        $saveteller->uraian = 'Penarikan tabungan : ' . $request->no_rekening . '-' . $request->nama_nasabah;
        $saveteller->my_kode_trans = 300;
        $saveteller->saldo_trans = $request->jml_transaksi;
        $saveteller->tob = $request->typetrans;
        $saveteller->tob_RAK = 'T';
        $saveteller->modul_trans_id = $modid1;
        $saveteller->userid = Auth::id();
        $saveteller->VALIDATED = 0;
        $saveteller->POSTED = 0;
        $saveteller->cab = $request->cab;
        $saveteller->save();
        // ----BY YG ADMIN
        $saveteller = new Tellertran();
        $saveteller->trans_id = $maxId + 1;
        $saveteller->modul  = 'TAB';
        $saveteller->tgl_trans = $request->tgl_trans;
        $saveteller->NO_BUKTI = $request->kuitansi;
        $saveteller->uraian = 'Penarikan tabungan : ' . $request->no_rekening . '-' . $request->nama_nasabah;
        $saveteller->my_kode_trans = 300;
        $saveteller->saldo_trans = $request->byadmin;
        $saveteller->tob = substr($request->kode_trans_adm, 5, 1);
        $saveteller->tob_RAK = 'T';
        $saveteller->modul_trans_id = $modid2;
        $saveteller->userid = Auth::id();
        $saveteller->VALIDATED = 0;
        $saveteller->POSTED = 0;
        $saveteller->cab = $request->cab;
        $saveteller->save();
        // UPDATE TABLE TABUNG
        $sldak = DB::select("SELECT tabung.NO_REKENING,SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0)) as saldo_setoran,SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0)) as saldo_penarikan,(tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung inner join tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING where tabtrans.TGL_TRANS<='$request->tgl_trans' AND tabtrans.NO_REKENING='$request->no_rekening' GROUP BY tabung.NO_REKENING");
        $saldosetoran = $sldak[0]->saldo_setoran;
        $saldopenarikan = $sldak[0]->saldo_penarikan;
        $saldoakhir = $sldak[0]->saldo_akhir;
        DB::select("update tabung set saldo_setoran='$saldosetoran',saldo_penarikan='$saldopenarikan',saldo_akhir='$saldoakhir',status_aktif=3 where no_rekening='$request->no_rekening'");
        return redirect()->route('penutupantabungan', ['kuitansi' => $request->kuitansi, 'no_rekening' => $request->no_rekening, 'nama_nasabah' => $request->nama_nasabah, 'saldo' => $request->saldo, 'byadmin' => $request->byadmin, 'jml_transaksi' => $request->jml_transaksi, 'tgl_trans' => $request->tgl_trans])->with('alert', 'TRANSAKSI PENUTUPAN TABUNGAN ' . $request->no_rekening . ' BERHASIL');
    }
    // CETAK KUITANSI PENUTUPAN TABUNGAN
    public function bo_tl_rp_cetakkuitansiclstab(Request $request)
    {
        $kota = DB::table('mysysid')->select('KeyName', 'Value')->where('KeyName', 'NAMA_KOTA')->get();

        $pdf = Pdf::loadview('pdf.tabungan.kuitansiclstab_pdf', ['request' => $request, 'kota' => $kota[0]->Value])->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
    // Cetak Validasi penutupan tabungan
    public function bo_tl_rp_cetakvalidasiclstab(Request $request)
    {
        $pdf = Pdf::loadview('pdf.tabungan.cetakvalidasiclstab_pdf', ['request' => $request])->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
    // get test2
    public function test2()
    {
        $logos = Logo::all();
        $users = User::all();
        return view('test2', ['logos' => $logos, 'users' => $users, 'msgstatus' => '']);
    }
    // post test2
    public function test2_add(Request $request)
    {
        dd($request);
    }
}
