<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Perkiraan;
use App\Mysysid;
use App\User;
use App\Logo;
use App\Teller_kodetrans;
use App\Tellertran;
use App\Trans_detail_buffer;
use App\Trans_master;
use App\Trans_master_buffer;
use App\Exports\ReportkasrinciExport;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TellerKasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // SHOW FORM KAS UMUM
    public function bo_tl_ku_transaksikasumum()
    {
        $users = User::all();
        $logos = Logo::all();
        $tellerkode = Teller_kodetrans::all();
        $perkiraan = Perkiraan::all();
        // $datakas = DB::select("select * from detailkas");
        $tgllogin = Mysysid::where('KeyName', '=', 'TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d', strtotime(str_replace('/', '-', $tgllogin[0]->Value)));

        return view('teller.kasumum.frmkasumum', ['tgllogin' => $tgllogin, 'perkiraan' => $perkiraan, 'tellerkode' => $tellerkode, 'users' => $users, 'logos' => $logos, 'msgstatus' => '']);
    }
    public function bo_tl_ku_transaksikasumum_add(Request $request)
    {
        // dd($request);
        $jumlaharray=[];$uraianarray=[];
        $this->validate($request, [
            'kuitansi' => 'required',
            'uraian_umum' => 'required',
            'kode_perk' => 'required'
        ]);
        if (isset($request->pilihmultiple) == false) {
            // PORSES SIMPAN DATA KE TELLERTRANS
            $maxTrsId = DB::select("SELECT MAX(trans_id) as maxTrsId FROM tellertrans")[0]->maxTrsId;
            $simmpankas = new Tellertran();
            $simmpankas->trans_id = $maxTrsId + 1;
            $simmpankas->modul = 'PC';
            $simmpankas->tgl_trans = $request->tgl_trans;
            $simmpankas->kode_jurnal = substr($request->kode, 0, 2);
            $simmpankas->no_bukti = $request->kuitansi;
            $simmpankas->uraian = $request->uraian_umum;
            if (substr($request->kode, 3, 1) == 'D') {
                $simmpankas->my_kode_trans = '200';
            } else {
                $simmpankas->my_kode_trans = '300';
            }
            $simmpankas->saldo_trans = (float)preg_replace("/[^0-9]/", "", $request->jumlah);
            $simmpankas->tob = 'T';
            $simmpankas->userid = Auth::id();
            $simmpankas->VALIDATED = '0';
            $simmpankas->POSTED = '1';
            $simmpankas->save();
            // ----------------------Batas Tellertrans ------------------------
            // SIMPAN KE TRANS_MASTER_BUFFER
            $simpantrsmstrbfr = new Trans_master_buffer();
            $simpantrsmstrbfr->tgl_trans = $request->tgl_trans;
            $simpantrsmstrbfr->kode_jurnal = substr($request->kode, 0, 2);
            $simpantrsmstrbfr->no_bukti = $request->kuitansi;
            $simpantrsmstrbfr->nominal = (float)preg_replace("/[^0-9]/", "", $request->jumlah);
            $simpantrsmstrbfr->keterangan = $request->uraian_umum;
            $simpantrsmstrbfr->save();
            $masterid = $simpantrsmstrbfr->trans_id;

            // SIMPAN KE TRANS_DETAIL_BUFFER -> kode_perk kas
            $simpantrsdtlbfr = new Trans_detail_buffer();
            $simpantrsdtlbfr->master_id = $masterid;
            $simpantrsdtlbfr->URAIAN = $request->uraian_umum;
            $pjgchr = strlen($request->kode);
            $simpantrsdtlbfr->kode_perk = substr($request->kode, 5, $pjgchr);
            if (substr($request->kode, 3, 1) == 'K') {
                $simpantrsdtlbfr->kredit = (float)preg_replace("/[^0-9]/", "", $request->jumlah);
            } else {
                $simpantrsdtlbfr->debet = (float)preg_replace("/[^0-9]/", "", $request->jumlah);
            }
            $simpantrsdtlbfr->save();
            // simpan ke transe_detail_buffer ke 2 (GL_PENYEIMBANG)
            $simpantrsdtlbfr = new Trans_detail_buffer();
            $simpantrsdtlbfr->master_id = $masterid;
            $simpantrsdtlbfr->URAIAN = $request->uraian_umum;
            $pjgchr = strlen($request->kode);
            $simpantrsdtlbfr->kode_perk = substr($request->kode, 5, $pjgchr);
            if (substr($request->kode, 3, 1) == 'K') {
                $simpantrsdtlbfr->debet = (float)preg_replace("/[^0-9]/", "", $request->jumlah);;
            } else {
                $simpantrsdtlbfr->kredit = (float)preg_replace("/[^0-9]/", "", $request->jumlah);;
            }
            $simpantrsdtlbfr->save();
        }
        // JIKA MULTIPLE SELECT DI PILIH
        else {
            // SIMPAN DI TELLERTANS
            $maxTrsId = DB::select("SELECT MAX(trans_id) as maxTrsId FROM tellertrans")[0]->maxTrsId;
            $simmpankas = new Tellertran();
            $simmpankas->trans_id = $maxTrsId + 1;
            $simmpankas->modul = 'PC';
            $simmpankas->tgl_trans = $request->tgl_trans;
            $simmpankas->kode_jurnal = substr($request->kode, 0, 2);
            $simmpankas->no_bukti = $request->kuitansi;
            $simmpankas->uraian = $request->uraian_umum;
            if (substr($request->kode, 3, 1) == 'D') {
                $simmpankas->my_kode_trans = '200';
            } else {
                $simmpankas->my_kode_trans = '300';
            }
            $simmpankas->saldo_trans = (float)preg_replace("/[^0-9]/", "", $request->totaljumlah);
            $simmpankas->tob = 'T';
            $simmpankas->userid = Auth::id();
            $simmpankas->VALIDATED = '0';
            $simmpankas->POSTED = '1';
            $simmpankas->save();
            // ---------------------------------------------------
            // SIMPAN KE TRANS_MASTER_BUFFER
            $simpantrsmstrbfr = new Trans_master_buffer();
            $simpantrsmstrbfr->tgl_trans = $request->tgl_trans;
            $simpantrsmstrbfr->kode_jurnal = substr($request->kode, 0, 2);
            $simpantrsmstrbfr->no_bukti = $request->kuitansi;
            $simpantrsmstrbfr->nominal = (float)preg_replace("/[^0-9]/", "", $request->totaljumlah);
            $simpantrsmstrbfr->keterangan = $request->uraian_umum;
            $simpantrsmstrbfr->save();
            $masterid = $simpantrsmstrbfr->trans_id;

            // SIMPAN KE TRANS_DETAIL_BUFFER -> kode_perk KAS 
            $simpantrsdtlbfr = new Trans_detail_buffer();
            $simpantrsdtlbfr->master_id = $masterid;
            $simpantrsdtlbfr->URAIAN = $request->uraian_umum;
            $pjgchr = strlen($request->kode);
            $simpantrsdtlbfr->kode_perk = substr($request->kode, 5, $pjgchr);
            if (substr($request->kode, 3, 1) == 'K') {
                $simpantrsdtlbfr->kredit = (float)preg_replace("/[^0-9]/", "", $request->totaljumlah);
            } else {
                $simpantrsdtlbfr->debet = (float)preg_replace("/[^0-9]/", "", $request->totaljumlah);
            }
            $simpantrsdtlbfr->save();
            // simpan ke transe_detail_buffer GL_PENYEIMBANG
            for ($i = 0; $i < (int)$request->jmlelement; $i++) {
                $simpantrsdtlbfr = new Trans_detail_buffer();
                $simpantrsdtlbfr->master_id = $masterid;
                $simpantrsdtlbfr->URAIAN = $request['uraian' . ($i + 1)];
                $pjgchr = strlen($request->kode);
                $simpantrsdtlbfr->kode_perk = $request['kode_perk' . ($i + 1)];
                if (substr($request->kode, 3, 1) == 'K') {
                    $simpantrsdtlbfr->debet = (float)preg_replace("/[^0-9]/", "", $request['jumlah' . ($i + 1)]);
                } else {
                    $simpantrsdtlbfr->kredit = (float)preg_replace("/[^0-9]/", "", $request['jumlah' . ($i + 1)]);
                }
                $simpantrsdtlbfr->save();
                array_push($uraianarray,$request['uraian' . ($i + 1)]);
                array_push($jumlaharray,(float)preg_replace("/[^0-9]/", "", $request['jumlah' . ($i + 1)]));
            }
        }
            if(isset($request->pilihmultiple))
            {
                return redirect()->route('validasikasumum',
                [
                    'pilihmultiple'=>$request->pilihmultiple,
                    'jmlelement' => $request->jmlelement,
                    'uraianarray'=>$uraianarray,
                    'jumlaharray'=>$jumlaharray,
                    'tgl_trans' => $request->tgl_trans,
                    'kode' => $request->kode,
                    'kuitansi' => $request->kuitansi,
                    'uraian_umum' => $request->uraian_umum,
                    'totaljumlah'=>$request->totaljumlah
                ])->with('alert', 'TRANSAKSI KAS BERHASIL DI SIMPAN');
            }else{
                return redirect()->route('validasikasumum',
                [
                    'tgl_trans' => $request->tgl_trans,
                    'kode' => $request->kode,
                    'kuitansi' => $request->kuitansi,
                    'uraian_umum' => $request->uraian_umum,
                    'uraian_' => $request->uraian,
                    'jumlah'=>$request->jumlah
                ])->with('alert', 'TRANSAKSI KAS BERHASIL DI SIMPAN');

            }
    }
    // Cetak Validasi KAS Umum
    public function validasikasumum(Request $request)
    {
        // dd($request);
        if(isset($request->pilihmultiple))
        {
            return view('pdf.teller.rptvalidasikasmulti',
            [
                'jmlelement' => $request->jmlelement,
                'uraianarray'=>$request->uraianarray,
                'jumlaharray'=>$request->jumlaharray,
                'tgl_trans' => $request->tgl_trans,
                'kode' => $request->kode,
                'kuitansi' => $request->kuitansi,
                'uraian_umum' => $request->uraian_umum,
                'jumlah'=>'Rp. '.number_format($request->totaljumlah,2,",",".")
            ]);
        }else{
            return view('pdf.teller.rptvalidasikas',
            [
                'tgl_trans' => $request->tgl_trans,
                'kode' => $request->kode,
                'kuitansi' => $request->kuitansi,
                'uraian_umum' => $request->uraian_umum,
                'uraian_' => $request->uraian,
                'jumlah'=>$request->jumlah
            ]);
        }
        
    }
    // Show Form Delete Transaksi Kas 
    public function bo_tl_ku_hapustransaksikas()
    {
        $users = User::all();
        $logos = Logo::all();
        $tgllogin = Mysysid::where('KeyName', '=', 'TANGGALHARIINI')->get();
        $tgllogin = date('Y-m-d', strtotime(str_replace('/', '-', $tgllogin[0]->Value)));

        $trskas = Tellertran::where('tgl_trans', '=', $tgllogin)->get();
        return view('teller.kasumum.frmhapustransaksi', ['users' => $users, 'logos' => $logos, 'tgllogin' => $tgllogin, 'trskas' => $trskas, 'msgstatus' => '']);
    }
    // Delete Transaksi
    public function bo_tl_ku_hapustransaksikas_del(Request $request)
    {
        Tellertran::where('trans_id', $request->trans_id)->delete();
        return redirect()->route('hapustransaksikas')->with('alert', 'Transaksi Kas Berhasil dihapus');
    }
    // SHOW FORM LAPORAN KAS RINCI
    public function bo_tl_lp_transaksikasrinci()
    {
        $users = User::all();
        $logos = Logo::all();
        return view('reports.teller.frmkasrinci', ['users' => $users, 'logos' => $logos, 'msgstatus' => '']);
    }
    // Cari Posisi Kas Rinci
    public function bo_tl_lp_caritransaksikas(Request $request)
    {
        $users = User::all();
        $logos = Logo::all();
        $tgl_trans1 = date("Y-m-d", strtotime($request->tgl_trans1));
        $tgl_trans2 = date("Y-m-d", strtotime($request->tgl_trans2));

        $saldoawalkas = DB::select("SELECT (SUM(IF(my_kode_trans='200',saldo_trans,0))-SUM(IF(my_kode_trans='300',saldo_trans,0))) as saldo_awal FROM tellertrans WHERE tob='T' AND tgl_trans<'$tgl_trans1'")[0]->saldo_awal;
        $trskas = Tellertran::where('tgl_trans', '>=', $tgl_trans1)
            ->where('tgl_trans', '<=', $tgl_trans2)
            ->get();
        return view('reports.teller.frmkasrinci', ['users' => $users, 'logos' => $logos, 'saldoawalkas' => $saldoawalkas, 'trskas' => $trskas, 'tgl_trans1' => $tgl_trans1, 'tgl_trans2' => $tgl_trans2, 'msgstatus' => '']);
    }
    // Print to PDF Laporan KAS
    public function bo_tl_lp_pdftransaksikasrinci(Request $request)
    {
        $tgl_trans1 = $request->tgl_trans1;
        $tgl_trans2 = $request->tgl_trans2;
        $ttd = DB::table('mysysid')->select('KeyName', 'Value')->where('KeyName', 'like', 'TTD_KAS%')->get();
        $trskas = DB::select("SELECT * FROM tellertrans WHERE (tgl_trans>='$tgl_trans1' AND tgl_trans<='$tgl_trans2') ORDER BY tob DESC,trans_id");
        $saldoawalkas = $request->saldoawalkas;
        $pdf = Pdf::loadview('pdf.teller.posisikas_pdf', ['trskas' => $trskas, 'ttd' => $ttd, 'saldoawalkas' => $saldoawalkas])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
    // EXPORT KAS RINCI
    public function bo_tl_ex_exportkasrinci(Request $request)
    {
        $tgl_trans1 = $request->tgl_trans1;
        $tgl_trans2 = $request->tgl_trans2;
        $trskas = DB::select("SELECT * FROM tellertrans WHERE (tgl_trans>='$tgl_trans1' AND tgl_trans<='$tgl_trans2') ORDER BY tob DESC,trans_id");
        return (new ReportkasrinciExport($trskas))->download('exportkasrinci.xlsx');
    }
}
