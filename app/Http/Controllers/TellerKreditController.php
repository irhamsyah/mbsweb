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
        $tglharini = DB::select("SELECT * FROM mysysid WHERE KeyName = 'TANGGALHARIINI'")[0]->Value;
        $kodetranstab = Kodetranstabungan::all();
        $kodecabang = Kodecabang::where('DATA_CAB', '=', 'mydata')->get();
        $kodejeniskredit = Kodejeniskredit::all();
        $kodetranskredit = Kodetranskredit::all();
        $kodetypekredit = KodeTypeKredit::all()->sort();
        $tabungan = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        $kredits = Kredit::select('nasabah.*', 'kredit.*')
            ->leftJoin('kodejeniskredit', function ($join) {
                $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
            })
            ->join('nasabah', function ($join) {
                $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
            })
            ->where(function ($query) {
                $query->where('STATUS_AKTIF', '=', 1);
                // ->orWhere('STATUS_AKTIF', '=', 3)
                // ->orWhere('STATUS_AKTIF', '=', 2);
            })
            ->get();
        $tanggaltransaksi = Mysysid::select('Value')->where('KeyName', '=', 'TANGGALHARIINI')->get();
        $tanggal = $tanggaltransaksi[0]->Value;
        $tabungans = Tabungan::select('tabung.NO_REKENING', 'nasabah.nama_nasabah', 'nasabah.alamat')
            ->leftJoin('nasabah', function ($join) {
                $join->on('nasabah.nasabah_id', '=', 'tabung.NASABAH_ID');
            })
            ->get()->toArray();
        return view('teller/kredit/frmrealisasikredit', ['tabungans' => $tabungans, 'kodetranskredit' => $kodetranskredit, 'tanggaltransaksi' => $tanggal, 'kodetypekredit' => $kodetypekredit, 'kodejeniskredit' => $kodejeniskredit, 'kredits' => $kredits, 'users' => $users, 'logos' => $logos, 'tabungan' => $tabungan, 'kodetranstab' => $kodetranstab, 'kodecabang' => $kodecabang, 'msgstatus' => '','tglharini' => $tglharini]);
    }
    // SIMPAN DATA TRANSAKSI
    public function setrealisasi(Request $request)
    {
        // dd($request);
        $kodekantor = Mysysid::where('KeyName','=','KODE_KANTOR')->get()->toArray()[0]['Value'];

        try {
            DB::beginTransaction();
            // database queries here
            Kredit::where('NO_REKENING', $request->input("no_rekening_kredit"))
                ->update([
                    'STATUS_AKTIF' => 2,
                    'POKOK_SALDO_REALISASI' => preg_replace("/[^0-9]/", "", $request->input("jml_pinjaman")),
                    'POKOK_SALDO_AKHIR' => preg_replace("/[^0-9]/", "", $request->input("jml_pinjaman")),
                    'BUNGA_SALDO_REALISASI' => preg_replace("/[^0-9]/", "", $request->input("jumlah_bunga")),
                    'BUNGA_SALDO_AKHIR' => preg_replace("/[^0-9]/", "", $request->input("jumlah_bunga"))
                ]);

            $newkretrans = new Kretrans();
            $newkretrans->NO_REKENING = $request->input("no_rekening_kredit");
            $newkretrans->norekening2 = $request->input("no_rekening_kredit");
            $newkretrans->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newkretrans->POKOK_TRANS = preg_replace("/[^0-9]/", "", $request->input("jml_pinjaman"));
            $newkretrans->BUNGA_TRANS = preg_replace("/[^0-9]/", "", $request->input("jumlah_bunga"));
            $newkretrans->PROVISI_TRANS = preg_replace("/[^0-9]/", "", $request->input("provisi"));
            $newkretrans->ADM_TRANS = preg_replace("/[^0-9]/", "", $request->input("administrasi"));
            if (is_null($request->input("rekening_overbook")) == false) {
                $newkretrans->NO_REK_TABUNGAN =  $request->input("rekening_overbook");
            }
            $newkretrans->KODE_TRANS = $request->input("kode_transaksi3");
            $newkretrans->MY_KODE_TRANS = 100;
            $newkretrans->KUITANSI =  $request->input("no_bukti");
            $newkretrans->TOB =  $request->input("tipe_transaksi");
            $newkretrans->CAB =  $kodekantor;
            $newkretrans->VALIDATED = 1;
            $newkretrans->save();
            $kretransid = $newkretrans->KRETRANS_ID;

            $newtellertrans = new Tellertran();
            $newtellertrans->modul = "KRE";
            $newtellertrans->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
            $newtellertrans->NO_BUKTI =  $request->input("no_bukti");
            if ($request->input("tipe_transaksi") == "T") {
                $newtellertrans->uraian = "Realisasi Kredit Tunai : #" . $request->input("no_rekening_kredit") . "-" . $request->input("nama_nasabah");
            }
            if ($request->input("tipe_transaksi") == "O") {
                $newtellertrans->uraian = "OB/PB Realisasi Kredit : #" . $request->input("no_rekening_kredit") . "-" . $request->input("nama_nasabah") . " Ke Tabungan: #" . $request->input("rekening_overbook") ;
                
            }
            $newtellertrans->my_kode_trans = "300";
            $newtellertrans->saldo_trans = preg_replace("/[^0-9]/", "", $request->input("jml_pinjaman"));
            $newtellertrans->tob = $request->input("tipe_transaksi");
            $newtellertrans->modul_trans_id = $kretransid;
            $newtellertrans->cab = $kodekantor;
            $newtellertrans->save();

            if ((int)preg_replace("/[^0-9]/", "", $request->input("provisi")) > 0) {
                $newtellertrans2 = new Tellertran();
                $newtellertrans2->modul = "KRE";
                $newtellertrans2->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
                $newtellertrans2->NO_BUKTI =  $request->input("no_bukti");
                $newtellertrans2->uraian = "Provisi Realisasi Kredit : #" . $request->input("no_rekening_kredit") . "-" . $request->input("nama_nasabah");
                $newtellertrans2->my_kode_trans = "200";
                $newtellertrans2->saldo_trans = preg_replace("/[^0-9]/", "", $request->input("provisi"));
                $newtellertrans2->tob = $request->input("tipe_transaksi");
                $newtellertrans2->cab = $kodekantor;
                $newtellertrans2->modul_trans_id = $kretransid;
                $newtellertrans2->save();
            }

            if ((int)preg_replace("/[^0-9]/", "", $request->input("administrasi")) > 0) {
                $newtellertrans3 = new Tellertran();
                $newtellertrans3->modul = "KRE";
                $newtellertrans3->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
                $newtellertrans3->NO_BUKTI =  $request->input("no_bukti");
                $newtellertrans3->uraian = "Administrasi Realisasi Kredit : #" . $request->input("no_rekening_kredit") . "-" . $request->input("nama_nasabah");
                $newtellertrans3->my_kode_trans = "200";
                $newtellertrans3->saldo_trans = $request->input("administrasi");
                $newtellertrans3->tob = $request->input("tipe_transaksi");
                $newtellertrans3->cab = $kodekantor;
                $newtellertrans3->modul_trans_id = $kretransid;
                $newtellertrans3->save();
            }

            if (is_null($request->input("rekening_overbook")) == false ) {
                $newtabtrans = new Tabtran();
                $newtabtrans->LINK_MODUL = "KRE";
                $newtabtrans->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
                $newtabtrans->NO_REKENING = $request->input("rekening_overbook");
                $newtabtrans->KODE_TRANS = $request->kode_transaksi_realisasi;
                $newtabtrans->SALDO_TRANS = preg_replace("/[^0-9]/", "", $request->input("jml_pinjaman"));
                $newtabtrans->MY_KODE_TRANS = "185";
                $newtabtrans->KUITANSI = $request->input("no_bukti");
                $newtabtrans->TOB = $request->input("tipe_transaksi");
                $newtabtrans->POSTED = 1;
                $newtabtrans->VALIDATED = 1;
                $newtabtrans->KETERANGAN = "Realisasi Kredit";
                $newtabtrans->FLAG_CETAK = "N";
                $newtabtrans->CAB = $kodekantor;
                $newtabtrans->LINK_ID = $kretransid;
                $newtabtrans->LINK_REKENING = $request->input("no_rekening_kredit");
                $newtabtrans->save();

                $newtabtrans2 = new Tabtran();
                $newtabtrans2->LINK_MODUL = "KRE";
                $newtabtrans2->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_transaksi"))->format('Y-m-d');
                $newtabtrans2->NO_REKENING = $request->input("rekening_overbook");
                $newtabtrans2->KODE_TRANS = $request->kode_transaksi_biaya;
                $tot = (int)preg_replace("/[^0-9]/", "", $request->input("provisi"))+(int)preg_replace("/[^0-9]/", "", $request->input("administrasi"));
                $newtabtrans2->SALDO_TRANS = $tot;
                $newtabtrans2->MY_KODE_TRANS = "295";
                $newtabtrans2->KUITANSI = $request->input("no_bukti");
                $newtabtrans2->TOB = $request->input("tipe_transaksi");
                $newtabtrans2->POSTED = 1;
                $newtabtrans2->VALIDATED = 1;
                // $newtabtrans2->KETERANGAN = "Realisasi Kredit";
                $newtabtrans2->FLAG_CETAK = "N";
                $newtabtrans2->CAB = $kodekantor;
                $newtabtrans2->LINK_ID = $kretransid;
                $newtabtrans2->LINK_REKENING = $request->input("no_rekening_kredit");
                $newtabtrans2->save();
            }

            DB::commit();
            return redirect()->route('printvalidasirealisasi',
            ['no_rekening'=>$request->no_rekening_kredit,
            'nama_nasabah'=>$request->nama_nasabah,
            'tgl_transaksi'=>$request->tgl_transaksi,
            'no_bukti'=>$request->no_bukti,
            'kode_transaksi'=>$request->kode_transaksi3,
            'jml_pinjaman'=>$request->jml_pinjaman,
            'total_diterima'=>$request->total_diterima,
            'provisi'=>$request->provisi,
            'notariel'=>$request->notariel,
            'premi'=>$request->premi,
            'administrasi'=>$request->administrasi,
            'materai'=>$request->materai,
            'lain2'=>$request->lain2,
            'pokok_materai'=>$request->pokok_materai,
            'biaya_transaksi'=>$request->biaya_transaksi,
            'premi_kendaraan'=>$request->premi_kendaraan,
            'jumlah_hold_dana'=>$request->jumlah_hold_dana,
            'jumlah_premi_asuransi'=>$request->jumlah_premi_asuransi,
            'jumlah_notariel'=>$request->jumlah_notariel,
            'rekening_overbook'=>$request->rekening_overbook
            ])->with('alert', 'Realisasi kredit berhasil!');
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            return redirect()->back()->with('alert', 'Realisasi kredit gagal!');
        }
    }
    // CETAK VALIDAASI
    public function printvalidasirealisasi(Request $request)
    {
        // dd($request);
        return view('pdf.kredit.rptvalidasirealkredit',[
            'no_rekening' => $request->no_rekening,
            'nama_nasabah' => $request->nama_nasabah,
            "tgl_transaksi" => $request->tgl_transaksi,
            'no_bukti' => $request->no_bukti,
            'kode_transaksi' => $request->kode_transaksi,
            'jml_pinjaman' => $request->jml_pinjaman,
            'total_diterima'=>$request->total_diterima,
            "provisi" => $request->provisi,
            "notariel" => $request->notariel,
            "premi" => $request->premi,
            "administrasi" => $request->administrasi,
            "materai" => $request->materai,
            "lain2" => $request->lain2,
            "pokok_materai" => $request->pokok_materai,
            "biaya_transaksi" => $request->biaya_transaksi,
            "premi_kendaraan" => $request->premi_kendaraan,
            "jumlah_hold_dana" => $request->jumlah_hold_dana,
            "jumlah_premi_asuransi" => $request->jumlah_premi_asuransi,
            "jumlah_notariel" => $request->jumlah_notariel,
            "rekening_overbook" => $request->rekening_overbook
      
        ]);
    }
    public function bo_tl_tk_setoranangsuran(Request $request)
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetranstab = Kodetranstabungan::all();
        $kodecabang = Kodecabang::where('DATA_CAB', '=', 'mydata')->get();
        $kodejeniskredit = Kodejeniskredit::all();
        $kodetranskredit = Kodetranskredit::all();
        $kodetypekredit = KodeTypeKredit::all()->sort();
        
        $tabungans = DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,IF(tabtran.saldo_akhir IS NULL,0,tabtran.saldo_akhir) AS saldo_akhir,tabung.SALDO_BLOKIR FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN) LEFT JOIN (SELECT tabung.NO_REKENING, (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as saldo_akhir FROM tabung INNER JOIN tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING GROUP BY tabung.NO_REKENING) as tabtran ON tabung.NO_REKENING=tabtran.NO_REKENING WHERE tabung.STATUS_AKTIF=2");
        // $angsuran = Kretrans::select('kretrans.*')
        //     ->where(function ($query) {
        //         $query->where('MY_KODE_TRANS', '=', 200);
        //     })
        //     ->orderBy('NO_REKENING', 'DESC')
        //     ->get();
        // $cicilan = Kretrans::select('kretrans.*')
        //     ->where(function ($query) {
        //         $query->where('MY_KODE_TRANS', '=', 300);
        //     })
        //     ->orderBy('NO_REKENING', 'DESC')
        //     ->get();
        // $kredits = Kredit::select('nasabah.*', 'kredit.*')
        //     ->leftJoin('kodejeniskredit', function ($join) {
        //         $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
        //     })
        //     ->join('nasabah', function ($join) {
        //         $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
        //     })
        //     ->where(function ($query) {
        //         $query->where('STATUS_AKTIF', '=', 2);
        //         // ->orWhere('STATUS_AKTIF', '=', 3)
        //         // ->orWhere('STATUS_AKTIF', '=', 2);
        //     })
        //     ->orderBy('NO_REKENING', 'DESC')
        //     ->get();
        $tanggaltransaksi = Mysysid::select('Value')->where('KeyName', '=', 'TANGGALHARIINI')->get();
        // echo json_decode($tanggaltransaksi, true)[0]["Value"];
        $a_date = \DateTime::createFromFormat('d/m/Y', json_decode($tanggaltransaksi, true)[0]["Value"])->format('Y-m-d');
        $tglakhirbulan = date("t/m/Y", strtotime($a_date));
        $tglEOF = date("Y-m-t", strtotime($a_date));
        $kredits = DB::select("SELECT kredit.*,nasabah.nama_nasabah,X.ANGSKE,X.SALDO_AKHIR,X.SALDO_BUNGA,X.TAGIHAN_POKOK,X.TAGIHAN_BUNGA,X.TAGIHAN_DENDA FROM 
        (kredit INNER JOIN (SELECT NO_REKENING,(SUM(IF(MY_KODE_TRANS='200',1,0))) as ANGSKE,(SUM(IF(MY_KODE_TRANS='100',POKOK_TRANS,0))-
        SUM(IF(MY_KODE_TRANS LIKE '3%',POKOK_TRANS,0))) AS SALDO_AKHIR,(
        SUM(IF(MY_KODE_TRANS='100',BUNGA_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',BUNGA_TRANS,0))) 
        AS SALDO_BUNGA,(SUM(IF(MY_KODE_TRANS='200',POKOK_TRANS,0))-SUM(IF(MY_KODE_TRANS 
        LIKE '3%',POKOK_TRANS,0))) AS TAGIHAN_POKOK,(SUM(IF(MY_KODE_TRANS='200',BUNGA_TRANS,0))-
        SUM(IF(MY_KODE_TRANS LIKE '3%',BUNGA_TRANS,0))) AS TAGIHAN_BUNGA, (SUM(IF(MY_KODE_TRANS='200',DENDA_TRANS,0))-SUM(IF(MY_KODE_TRANS LIKE '3%',DENDA_TRANS,0))) AS TAGIHAN_DENDA FROM kretrans WHERE TGL_TRANS<= '$tglEOF' GROUP BY NO_REKENING) as X ON kredit.NO_REKENING=X.NO_REKENING) INNER JOIN nasabah ON kredit.NASABAH_ID=nasabah.nasabah_id WHERE kredit.STATUS_AKTIF='2' OR kredit.STATUS_AKTIF='1'");
        $tanggal = $tanggaltransaksi[0]->Value;
        // $tabungans = Tabungan::select('tabung.NO_REKENING', 'nasabah.nama_nasabah', 'nasabah.alamat')
        //     ->leftJoin('nasabah', function ($join) {
        //         $join->on('nasabah.nasabah_id', '=', 'tabung.NASABAH_ID');
        //     })
        //     ->get()->toArray();
        if(isset($request->kuitansi)){
            return view('teller/kredit/frmsetoranangsuran', ['tglakhirbulan' => $tglakhirbulan, 'kodetranskredit' => $kodetranskredit, 'tanggaltransaksi' => $tanggal, 'kodetypekredit' => $kodetypekredit, 'kodejeniskredit' => $kodejeniskredit, 'kredits' => $kredits, 'users' => $users, 'logos' => $logos, 'tabungans' => $tabungans, 'kodetranstab' => $kodetranstab, 'kodecabang' => $kodecabang,'kuitansi'=>$request->kuitansi,'no_rekening'=>$request->no_rekening,'tgl_trans'=>$request->tgl_trans,'msgstatus' => '']);
        }
        elseif(isset($request->kode_transkredit)){
            // dd(substr($request->kode_transkredit,0,3));

            return view('teller/kredit/frmsetoranangsuran', ['tglakhirbulan' => $tglakhirbulan, 'kodetranskredit' => $kodetranskredit, 'tanggaltransaksi' => $tanggal, 'kodetypekredit' => $kodetypekredit, 'kodejeniskredit' => $kodejeniskredit, 'kredits' => $kredits, 'users' => $users, 'logos' => $logos, 'tabungans' => $tabungans, 'kodetranstab' => $kodetranstab, 'kodecabang' => $kodecabang,'kode_transkredit'=>$request->kode_transkredit, 'msgstatus' => '']);
        }
        else{
            return view('teller/kredit/frmsetoranangsuran', ['tglakhirbulan' => $tglakhirbulan, 'kodetranskredit' => $kodetranskredit, 'tanggaltransaksi' => $tanggal, 'kodetypekredit' => $kodetypekredit, 'kodejeniskredit' => $kodejeniskredit, 'kredits' => $kredits, 'users' => $users, 'logos' => $logos, 'tabungans' => $tabungans, 'kodetranstab' => $kodetranstab, 'kodecabang' => $kodecabang, 'msgstatus' => '']);
        }
    }

    public function saveAngsuran(Request $request)
    {
        // dd($request);
        $kodekantor = Mysysid::where('KeyName','=','KODE_KANTOR')->get()->toArray()[0]['Value'];
        if(is_null(Auth::id())){
            return redirect('logout');
        }
        if(is_null($request->rekening_overbook))
        {
        // try {
        DB::beginTransaction();
        // database queries here
        $rs=Kredit::where('NO_REKENING', $request->input("no_rekening_kredit"))->get()->toArray();
        Kredit::where('NO_REKENING', $request->input("no_rekening_kredit"))
            ->update([
                'STATUS_AKTIF' => 2,
                'POKOK_SALDO_AKHIR' => (float)preg_replace("/[^0-9]/", "", $request->input("jml_pinjaman")),
                'BUNGA_SALDO_AKHIR' => (float)preg_replace("/[^0-9]/", "", $request->input("jumlah_bunga")),
                'POKOK_SALDO_SETORAN' => (float)preg_replace("/[^0-9]/", "", $request->input("pokok_pembayaran")),
                'POKOK_TUNGGAKAN_AKHIR' => $rs[0]['POKOK_SALDO_TAGIHAN'] - (float)preg_replace("/[^0-9]/", "", $request->input("pokok_pembayaran")),
                'BUNGA_SALDO_SETORAN' => (float)preg_replace("/[^0-9]/", "", $request->input("bunga_pembayaran")),
                'BUNGA_TUNGGAKAN_AKHIR' => $rs[0]['BUNGA_SALDO_TAGIHAN'] - (float)preg_replace("/[^0-9]/", "", $request->input("jml_pinjaman")),
            ]);

        $newkretrans = new Kretrans();
        $newkretrans->NO_REKENING = $request->input("no_rekening_kredit");
        $newkretrans->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_trans"))->format('Y-m-d');
        $newkretrans->POKOK_TRANS = (float)preg_replace("/[^0-9]/", "", $request->input("pokok_pembayaran"));
        $newkretrans->ANGSURAN_KE = 0;
        $newkretrans->CICILAN_KE = $request->input("cicilan_ke");
        $newkretrans->BUNGA_TRANS = (float)preg_replace("/[^0-9]/", "", $request->input("bunga_pembayaran"));
        $newkretrans->DENDA_TRANS = (float)preg_replace("/[^0-9]/", "", $request->input("denda_pembayaran"));
        $newkretrans->MY_KODE_TRANS = '300';
        $newkretrans->KODE_TRANS = substr($request->input("kode_transkredit"),0,3);
        $newkretrans->KUITANSI =  $request->input("kwitansi");
        $newkretrans->KETERANGAN =  $request->input("keterangan");
        $newkretrans->TOB =  $request->input("tob");
        $newkretrans->VALIDATED = 1;
        $newkretrans->TGL_TRANSAKSI = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_tagihan"))->format('Y-m-d');
        $newkretrans->CAB = $kodekantor;
        $newkretrans->save();
        $modultransid = $newkretrans->KRETRANS_ID;
        // SAVE KE TELLERTRANS
        $newtellertrans = new Tellertran();
        $newtellertrans->modul = 'KRE';
        $newtellertrans->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_trans"))->format('Y-m-d');
        $newtellertrans->NO_BUKTI = $request->input("kwitansi");
        $newtellertrans->uraian = 'Angsuran kredit tunai : #' . $request->input('no_rekening_kredit') . '-' . $request->input('nama_nasabah');
        $newtellertrans->my_kode_trans = '200';
        $newtellertrans->saldo_trans = $request->input("jumlah_setoran");
        $newtellertrans->tob = $request->input("tob");
        $newtellertrans->modul_trans_id = $modultransid;
        $newtellertrans->userid = Auth::id();
        $newtellertrans->POSTED = 0;
        $newtellertrans->VALIDATED = 0;
        $newtellertrans->cab = '001';
        $newtellertrans->save();

        return redirect()->route('validasiangs',['kuitansi'=>$request->kwitansi,'no_rekening'=>$request->no_rekening_kredit,'nama_nasabah'=>$request->nama_nasabah,'tgl_trans'=>$request->tgl_trans,'pokok_pembayaran'=>$request->pokok_pembayaran,'bunga_pembayaran'=>$request->bunga_pembayaran,'denda_pembayaran'=>$request->denda_pembayaran,'baki_debet_pokok'=>$request->baki_debet_pokok,'kode_transkredit'=>$request->kode_transkredit])->with('alert', 'PEMBAYARAN ANGSURAN TUNAI BERHASIL');
        // DB::commit();
        //     $out['message'] = "Bayar angsuran kredit berhasil!";
        //     $out['status'] = 1;
        //     return $out;
        // } catch (\PDOException $e) {
        //     // Woopsy
        //     DB::rollBack();
        //     $out['message'] = "Bayar angsuran kredit gagal!";
        //     $out['status'] = 0;
        //     return $out;
        // }
        }else{
            DB::beginTransaction();
            // database queries here
            $rs=Kredit::where('NO_REKENING', $request->input("no_rekening_kredit"))->get()->toArray();
            Kredit::where('NO_REKENING', $request->input("no_rekening_kredit"))
                ->update([
                    'STATUS_AKTIF' => 2,
                    'POKOK_SALDO_AKHIR' => (float)preg_replace("/[^0-9]/", "", $request->input("jml_pinjaman")),
                    'BUNGA_SALDO_AKHIR' => (float)preg_replace("/[^0-9]/", "", $request->input("jumlah_bunga")),
                    'POKOK_SALDO_SETORAN' => (float)preg_replace("/[^0-9]/", "", $request->input("pokok_pembayaran")),
                    'POKOK_TUNGGAKAN_AKHIR' => $rs[0]['POKOK_SALDO_TAGIHAN'] - (float)preg_replace("/[^0-9]/", "", $request->input("pokok_pembayaran")),
                    'BUNGA_SALDO_SETORAN' => (float)preg_replace("/[^0-9]/", "", $request->input("bunga_pembayaran")),
                    'BUNGA_TUNGGAKAN_AKHIR' => $rs[0]['BUNGA_SALDO_TAGIHAN'] - (float)preg_replace("/[^0-9]/", "", $request->input("bunga_pembayaran")),
                ]);
    
            $newkretrans = new Kretrans();
            $newkretrans->NO_REKENING = $request->input("no_rekening_kredit");
            $newkretrans->TGL_TRANS = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_trans"))->format('Y-m-d');
            $newkretrans->POKOK_TRANS = (float)preg_replace("/[^0-9]/", "", $request->input("pokok_pembayaran"));
            $newkretrans->ANGSURAN_KE = 0;
            $newkretrans->CICILAN_KE = $request->input("cicilan_ke");
            $newkretrans->BUNGA_TRANS = (float)preg_replace("/[^0-9]/", "", $request->input("bunga_pembayaran"));
            $newkretrans->DENDA_TRANS = (float)preg_replace("/[^0-9]/", "", $request->input("denda_pembayaran"));
            $newkretrans->MY_KODE_TRANS = '300';
            $newkretrans->KODE_TRANS = substr($request->input("kode_transkredit"),0,3);
            $newkretrans->KUITANSI =  $request->input("kwitansi");
            $newkretrans->KETERANGAN =  $request->input("keterangan").' PB dr NoRek: '.$request->rekening_overbook.' an:'.$request->nama_nasabah;
            $newkretrans->TOB =  $request->input("tob");
            $newkretrans->VALIDATED = 1;
            $newkretrans->NO_REK_TABUNGAN=$request->rekening_overbook;
            $newkretrans->TGL_TRANSAKSI = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_tagihan"))->format('Y-m-d');
            $newkretrans->CAB = $kodekantor;
            $newkretrans->save();
            $modultransid = $newkretrans->KRETRANS_ID;
            // SAVE KE TABTRANS
            $newtabtrans = new Tabtran();
            $newtabtrans->TGL_TRANS=\DateTime::createFromFormat('d/m/Y', $request->input("tgl_trans"))->format('Y-m-d');
            $newtabtrans->NO_REKENING = $request->rekening_overbook;
            $newtabtrans->KODE_TRANS = substr($request->kode_transtab_overbooking,0,2);
            $newtabtrans->SALDO_TRANS = (float)preg_replace("/[^0-9]/", "", $request->jumlah_setoran);
            $newtabtrans->MY_KODE_TRANS = 265;
            $newtabtrans->KUITANSI = $request->kwitansi;
            $newtabtrans->USERID = Auth::id();
            $newtabtrans->TOB = $request->tob;
            $newtabtrans->VALIDATED = 1;
            $newtabtrans->POSTED = 1;
            $newtabtrans->LINK_ID = $modultransid;
            $newtabtrans->LINK_REKENING = $request->no_rekening_kredit;
            $newtabtrans->CAB = $kodekantor;
            $newtabtrans->save();
            // SAVE KE TELLERTRANS
            $newtellertrans = new Tellertran();
            $newtellertrans->modul = 'KRE';
            $newtellertrans->tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_trans"))->format('Y-m-d');
            $newtellertrans->NO_BUKTI = $request->input("kwitansi");
            $newtellertrans->uraian = 'OB/PB Angsuran kredit: #' . $request->input('no_rekening_kredit') . '-' . $request->input('nama_nasabah').' dari NoRekTab: #' . $request->rekening_overbook.'-'.$request->nama_nasabah;
            $newtellertrans->my_kode_trans = '200';
            $newtellertrans->saldo_trans = (float)preg_replace("/[^0-9]/", "", $request->input("jumlah_setoran"));
            $newtellertrans->tob = $request->input("tob");
            $newtellertrans->modul_trans_id = $modultransid;
            $newtellertrans->userid = Auth::id();
            $newtellertrans->POSTED = 0;
            $newtellertrans->VALIDATED = 0;
            $newtellertrans->cab = $kodekantor;
            $newtellertrans->save();
    
            return redirect()->route('validasiangs',['kuitansi'=>$request->kwitansi,'no_rekening'=>$request->no_rekening_kredit,'nama_nasabah'=>$request->nama_nasabah,'tgl_trans'=>$request->tgl_trans,'pokok_pembayaran'=>$request->pokok_pembayaran,'bunga_pembayaran'=>$request->bunga_pembayaran,'denda_pembayaran'=>$request->denda_pembayaran,'baki_debet_pokok'=>$request->baki_debet_pokok,'rekening_overbook'=>$request->rekening_overbook,'nama_overbook'=>$request->nama_overbook,'kode_transkredit'=>$request->kode_transkredit])->with('alert', 'PEMBAYARAN ANGSURAN VIA OVB BERHASIL');
    
        }
    }
    // CETAK VALIDASI ANGSURAN
    public function validasiangs(Request $request)
    {
        // dd($request);
        if(isset($request->rekening_overbook)){
            return view('pdf.kredit.rptvalidasiangskredit',['request'=>$request]);
        }else{
            return view('pdf.kredit.rptvalidasiangskredittunai',['request'=>$request]);
        }
    }
    public function getAngsuran(Request $request)
    {
        $norek = $request->input("norek");
        // dd($norek);
        $angsuran = Kretrans::select('kretrans.*')
            ->where(function ($query) {
                $query->where('MY_KODE_TRANS', '=', 200);
            })
            ->where('kretrans.NO_REKENING', '=', $norek)
            ->orderBy('ANGSURAN_KE')
            ->get();
        return $angsuran;
    }

    public function getCicilan(Request $request)
    {
        $norek = $request->input("norek");
        // dd($norek);
        $angsuran = Kretrans::select('kretrans.*')
            ->where(function ($query) {
                $query->where('MY_KODE_TRANS', '=', 300);
            })
            ->where('kretrans.NO_REKENING', '=', $norek)
            ->orderBy('CICILAN_KE')
            ->get();
        return $angsuran;
    }

    public function getTanggal(Request $request)
    {
        $tglharini = DB::select("SELECT * FROM mysysid WHERE KeyName = 'TANGGALHARIINI'")[0]->Value;
        $tglharini = \DateTime::createFromFormat('d/m/Y', $tglharini)->format('Y-m-d');
        $rs = Kretrans::where('NO_REKENING', '=',$request->norek)
                        ->where('TGL_TRANS','=', $tglharini)
                        ->where('MY_KODE_TRANS','=', 300)
                        ->orWhere('MY_KODE_TRANS','=', 100)
                        ->get();
                        return $rs;
    }       
    // REPORT TRANSAKSI ANGSURAN
    public function cetaknotaangs(Request $request) 
    {
        // dd($request);
        $this->validate($request,[
            "kuitansi" => "required",
            "no_rekening" => "required",
            "tgl_trans" => "required"
        ]);
        $tgl_trans = \DateTime::createFromFormat('d/m/Y', $request->input("tgl_trans"))->format('Y-m-d');
        $rs = DB::select("select kredit.no_rekening,nasabah.nama_nasabah,nasabah.alamat,kuitansi,pokok_trans,bungar_trans,denda_trans,keterangan,tgl_transaksi from (kredit inner join nasabah on kredit.nasabah_id = nasabah.nasabah_id) inner join kretrans on kredit.no_rekening=kretrans.no_rekening where kuitansi='$request->kuitansi' and no_rekeking='$request->no_rekeking' and tgl_trans='$tgl_trans' ");

    }
}
