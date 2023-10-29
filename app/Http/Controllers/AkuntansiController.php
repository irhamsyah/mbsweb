<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Logo;
use App\Kodetranstabungan;
use App\Kodecabang;
use App\KodeJurnal;
use App\Perkiraan;
use App\Tabtran;
use App\Trans_detail;
use App\Trans_master;
use App\Trans_master_buffer;
use App\Trans_detail_buffer;
use App\Exports\ReportdaftarperkiraanExport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Prophecy\Call\Call;
use Symfony\Component\Console\Input\InputOption;

class AkuntansiController extends Controller
{
    // show form posting transaction
    public function bo_ak_tt_postingdatatransaksi()
    {   
        $users = User::all();
        $logos = Logo::all();
        return view('akuntansi/frmpostingtransaksi',['users'=>$users, 'logos'=>$logos]);
    }

    public function bo_ak_tr_postingtransaksi(Request $request)
    {
        $this->validate($request,[
            'tgl_awal' =>'required',
            'tgl_akhir' =>'required',
        ]);
        // PROSES POSTING TABUNGAN 
        $sqlposttab = "SELECT tabtrans.TABTRANS_ID,tabtrans.TGL_TRANS   ,tabtrans.NO_REKENING,tabtrans.SALDO_TRANS,tabtrans.KODE_TRANS,tabtrans.MY_KODE_TRANS,tabtrans.POSTED,tabtrans.KUITANSI,tabtrans.TOB,kodetranstabungan.GL_TRANS,kodetranstabungan.TYPE_TRANS,kodejenistabungan.KODE_PERK,kodejenistabungan.KODE_PERK_BIAYA,kodejenistabungan.KODE_PERK_ADM FROM ((tabtrans INNER JOIN kodetranstabungan ON tabtrans.KODE_TRANS=kodetranstabungan.KODE_TRANS) INNER JOIN tabung ON tabtrans.NO_REKENING=tabung.NO_REKENING) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN WHERE tabtrans.POSTED=0 AND (tabtrans.TGL_TRANS>='$request->tgl_awal' AND tabtrans.TGL_TRANS<='$request->tgl_akhir')";
        $kodeperkteller = DB::select("SELECT * FROM mysysid WHERE KeyName like '%kas%teller'");
        $kodeperkpajaktab = DB::select("SELECT * FROM mysysid WHERE KeyName LIKE '%Integrasi%Pajak%tabung%'");

        $postingtab = DB::select($sqlposttab);

        for($i=0;$i<count($postingtab);$i++){
            $inputtransmasterbuff = new Trans_master_buffer();
            // SIMPAN DATA PADA TRANS_MASTER_BUFFER
            if(substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='100'){
                $inputtransmasterbuff->tgl_trans=$postingtab[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='KM';
                $inputtransmasterbuff->no_bukti=$postingtab[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingtab[$i]->SALDO_TRANS;
                $inputtransmasterbuff->keterangan='Setoran Tabungan:'.$postingtab[$i]->NO_REKENING;
            }elseif(substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='200'){
                $inputtransmasterbuff->tgl_trans=$postingtab[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='KK';
                $inputtransmasterbuff->no_bukti=$postingtab[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingtab[$i]->SALDO_TRANS;
                $inputtransmasterbuff->keterangan='Penarikan Tabungan:'.$postingtab[$i]->NO_REKENING;
            }elseif(substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='110'){
                $inputtransmasterbuff->tgl_trans=$postingtab[$i]->TGL_TRANS;
                $inputtransmasterbuff->no_bukti=$postingtab[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingtab[$i]->SALDO_TRANS;
                $inputtransmasterbuff->keterangan='Overbook Bunga Tabungan:'.$postingtab[$i]->NO_REKENING;
            }elseif(substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='275'){
                $inputtransmasterbuff->tgl_trans=$postingtab[$i]->TGL_TRANS;
                $inputtransmasterbuff->no_bukti=$postingtab[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingtab[$i]->SALDO_TRANS;
                $inputtransmasterbuff->keterangan='Overbook biaya Adm Tabungan:'.$postingtab[$i]->NO_REKENING;
            }elseif(substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='210'){
                $inputtransmasterbuff->tgl_trans=$postingtab[$i]->TGL_TRANS;
                $inputtransmasterbuff->no_bukti=$postingtab[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingtab[$i]->SALDO_TRANS;
                $inputtransmasterbuff->keterangan='Overbook Pajak Tabungan:'.$postingtab[$i]->NO_REKENING;
            }
            $inputtransmasterbuff->save();
            // SIMPAN DATA TRANS_DETAIL_BUFFER
            $kuitansi=$postingtab[$i]->KUITANSI;
            $tgl=$postingtab[$i]->TGL_TRANS;
            $norek=$postingtab[$i]->NO_REKENING;

            $cari=DB::select("select * from trans_master_buffer where trans_id='$inputtransmasterbuff->trans_id'");
            if($postingtab[$i]->TOB=='T' AND $postingtab[$i]->TYPE_TRANS=='K' AND substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='100'){
                // Input perk teller
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Setoran Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$kodeperkteller[0]->Value;
                $inputtransdetailbuff->debet=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Setoran Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingtab[$i]->KODE_PERK;
                $inputtransdetailbuff->kredit=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
            }elseif($postingtab[$i]->TOB=='T' AND $postingtab[$i]->TYPE_TRANS=='D' AND substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='200'){
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Penarikan Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$kodeperkteller[0]->Value;
                $inputtransdetailbuff->kredit=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Penarikan Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingtab[$i]->KODE_PERK;
                $inputtransdetailbuff->debet=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
            }elseif($postingtab[$i]->TOB=='O' AND $postingtab[$i]->TYPE_TRANS=='K' AND substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='110'){
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OVB Bunga Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingtab[$i]->KODE_PERK_BIAYA;
                $inputtransdetailbuff->debet=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OVB Bunga Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingtab[$i]->KODE_PERK;
                $inputtransdetailbuff->kredit=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
            }elseif($postingtab[$i]->TOB=='O' AND $postingtab[$i]->TYPE_TRANS=='D' AND substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='275'){
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OVB By Adm Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingtab[$i]->KODE_PERK_ADM;
                $inputtransdetailbuff->kredit=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OVB By Adm Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingtab[$i]->KODE_PERK;
                $inputtransdetailbuff->debet=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
            }elseif($postingtab[$i]->TOB=='O' AND $postingtab[$i]->TYPE_TRANS=='D' AND substr($postingtab[$i]->MY_KODE_TRANS,0,3)=='210'){
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OVB Pajak Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$kodeperkpajaktab[0]->Value;
                $inputtransdetailbuff->kredit=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OVB Pajak Tabungan:'.$postingtab[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingtab[$i]->KODE_PERK;
                $inputtransdetailbuff->debet=$postingtab[$i]->SALDO_TRANS;
                $inputtransdetailbuff->save();
            }
            $tabtransid=$postingtab[$i]->TABTRANS_ID;
            DB::select("update tabtrans set posted=1 where tabtrans_id=$tabtransid");
        }

        // PROSES POSTING DEPOSITO 
        $sqlpostdep = "SELECT deptrans.DEPTRANS_ID,deptrans.TGL_TRANS,deptrans.NO_REKENING,deptrans.SALDO_TRANS,deptrans.KODE_TRANS,deptrans.MY_KODE_TRANS,kodetransdeposito.TYPE_TRANS,deptrans.KUITANSI,kodetransdeposito.GL_TRANS,kodejenisdeposito.KODE_PERK,kodejenisdeposito.KODE_PERK_BIAYA,kodejenisdeposito.KODE_PERK_TITIPAN,deposito.MASUK_TITIPAN,deposito.NO_REK_TABUNGAN,deptrans.NO_REK_OB,kodejenistabungan.KODE_PERK as PERK_TAB,deposito.BUNGA_BERBUNGA FROM ((((deptrans INNER JOIN kodetransdeposito ON deptrans.KODE_TRANS=kodetransdeposito.KODE_TRANS) INNER JOIN deposito ON deptrans.NO_REKENING=deposito.NO_REKENING) INNER JOIN kodejenisdeposito ON deposito.JENIS_DEPOSITO=kodejenisdeposito.KODE_JENIS_DEPOSITO) LEFT JOIN tabung ON deptrans.NO_REK_OB=tabung.NO_REKENING) LEFT JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN WHERE deptrans.POSTED=0 AND (deptrans.TGL_TRANS>='$request->tgl_awal' AND deptrans.TGL_TRANS<='$request->tgl_akhir') ORDER BY deptrans.DEPTRANS_ID";
        $kodeperkpajakdep = DB::select("SELECT * FROM mysysid WHERE KeyName LIKE '%Integrasi%Pajak%depo%'");

        $postingdep = DB::select($sqlpostdep);
        $saldotrans=[];$norek=[];$ambiltrans_id=[];

        for ($i = 0; $i < count($postingdep); $i++)
        {
            $inputtransmasterbuff = new Trans_master_buffer();
            // SIMPAN DATA PADA TRANS_MASTER_BUFFER
            $saldotrans[]=$postingdep[$i]->SALDO_TRANS;
            $norek[]=$postingdep[$i]->NO_REKENING;
            // PEMBUKAAN DEPOSITO TUNAI 
            if($postingdep[$i]->MY_KODE_TRANS==0 AND empty($postingdep[$i]->NO_REK_OB)==true){
                $inputtransmasterbuff->tgl_trans=$postingdep[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='KM';
                $inputtransmasterbuff->no_bukti=$postingdep[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$saldotrans[$i];
                $inputtransmasterbuff->keterangan='Tunai Setoran Deposito:'.$norek[$i];
                $inputtransmasterbuff->save();
            }
            // PEMBUKAAN DEPOSITO LEWAT TABUNGAN 
            elseif($postingdep[$i]->MY_KODE_TRANS==0 AND empty($postingdep[$i]->NO_REK_OB)==false){
                $inputtransmasterbuff->tgl_trans=$postingdep[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='KM';
                $inputtransmasterbuff->no_bukti=$postingdep[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$saldotrans[$i];
                $inputtransmasterbuff->keterangan='Setoran Deposito via Tab:'.$norek[$i];
                $inputtransmasterbuff->save();

            }
            // POSTING TRANS_MASTER_BUFFER SYS-BNG MASUK TITIPAN
            elseif($i>0 AND substr($postingdep[$i-1]->KUITANSI,0,7)=='SYS-BNG' AND substr($postingdep[$i]->KUITANSI,0,7)=='SYS-BNG' AND $postingdep[$i]->MASUK_TITIPAN==1 AND $postingdep[$i-1]->MASUK_TITIPAN==1 AND ($postingdep[$i]->NO_REKENING==$postingdep[$i-1]->NO_REKENING)){
                $inputtransmasterbuff->tgl_trans=$postingdep[$i-1]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='PB';
                $inputtransmasterbuff->no_bukti=$postingdep[$i-1]->KUITANSI;
                $inputtransmasterbuff->nominal=$saldotrans[$i-1];
                $inputtransmasterbuff->keterangan='OB BUNGA DEPOSITO #Rek'.$norek[$i-1].'ke Titipan';
                $inputtransmasterbuff->save();
            }
            // POSTING TRANS_MASTER_BUFFER SYS-BNG MASUK TABUNGAN
            elseif($i>0 AND substr($postingdep[$i]->KUITANSI,0,7)=='SYS-BNG' AND substr($postingdep[$i-1]->KUITANSI,0,7)=='SYS-BNG' AND $postingdep[$i]->MASUK_TITIPAN==0 AND $postingdep[$i-1]->MASUK_TITIPAN==0 AND empty($postingdep[$i]->NO_REK_OB)==false AND empty($postingdep[$i-1]->NO_REK_OB)==false AND ($postingdep[$i]->NO_REKENING==$postingdep[$i-1]->NO_REKENING)){
                $inputtransmasterbuff->tgl_trans=$postingdep[$i-1]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='PB';
                $inputtransmasterbuff->no_bukti=$postingdep[$i-1]->KUITANSI;
                $inputtransmasterbuff->nominal=$saldotrans[$i-1];
                $inputtransmasterbuff->keterangan='OB BUNGA DEPOSITO #Rek'.$norek[$i-1].'ke Tabungan #rek'.$postingdep[$i-1]->NO_REK_OB;
                $inputtransmasterbuff->save();
            }
            // POSTING BUNGA BER BUNGA
            elseif($i>0 AND substr($postingdep[$i]->KUITANSI,0,7)=='SYS-BNG' AND substr($postingdep[$i-1]->KUITANSI,0,7)=='SYS-BNG' AND $postingdep[$i]->MASUK_TITIPAN==0 AND $postingdep[$i-1]->MASUK_TITIPAN==0 AND $postingdep[$i]->BUNGA_BERBUNGA==1 AND $postingdep[$i-1]->BUNGA_BERBUNGA==1 AND ($postingdep[$i]->NO_REKENING==$postingdep[$i-1]->NO_REKENING)){
                $inputtransmasterbuff->tgl_trans=$postingdep[$i-1]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='PB';
                $inputtransmasterbuff->no_bukti=$postingdep[$i-1]->KUITANSI;
                $inputtransmasterbuff->nominal=$saldotrans[$i-1];
                $inputtransmasterbuff->keterangan='OB BUNGA DEPOSITO #Rek'.$norek[$i-1] .'ke Titpan';
                $inputtransmasterbuff->save();
            }
            // POSTING ARO BUNGA BER BUNGA
            elseif(substr($postingdep[$i]->KUITANSI,0,7)=='SYS-ARO'){
                $inputtransmasterbuff->tgl_trans=$postingdep[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='PB';
                $inputtransmasterbuff->no_bukti=$postingdep[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingdep[$i]->SALDO_TRANS;
                $inputtransmasterbuff->keterangan='PENARIKAN TITIPAN OB KE DEP #Rek'.$postingdep[$i]->NO_REKENING;
                $inputtransmasterbuff->save();
            }elseif($postingdep[$i]->MY_KODE_TRANS=='275' AND empty($postingdep[$i]->NO_REK_OB)==true){
                $inputtransmasterbuff->tgl_trans=$postingdep[$i]->TGL_TRANS;
                $inputtransmasterbuff->no_bukti=$postingdep[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingdep[$i]->SALDO_TRANS;
                $inputtransmasterbuff->keterangan='OB/TUNAI PENARIKAN  TITIPAN DEPOSITO #REK '.$postingdep[$i]->NO_REKENING;
                $inputtransmasterbuff->save();

            }elseif($postingdep[$i]->MY_KODE_TRANS=='275' AND empty($postingdep[$i]->NO_REK_OB)==false){
                $inputtransmasterbuff->tgl_trans=$postingdep[$i]->TGL_TRANS;
                $inputtransmasterbuff->no_bukti=$postingdep[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingdep[$i]->SALDO_TRANS;
                $inputtransmasterbuff->keterangan='Tarik Titipan Deposito #REK'.$postingdep[$i]->NO_REKENING.'ke tab#rek'.$postingdep[$i]->NO_REK_OB;
                $inputtransmasterbuff->save();
            }
// --------------------------------------------------------------------------------------------
            // SIMPAN DATA TRANS_DETAIL_BUFFER
            $ambiltrans_id[]=$inputtransmasterbuff->trans_id;
            // PEMBUKAAN DEPOSITO TUNAI
            if(empty($inputtransmasterbuff->trans_id)==false AND $postingdep[$i]->MY_KODE_TRANS=='0' AND empty($postingdep[$i]->NO_REK_OB)==true)
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Buka Deposito Tunai #REK'.$norek[$i];
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->GL_TRANS;
                $inputtransdetailbuff->debet=$saldotrans[$i];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Buka Deposito Tunai #REK'.$norek[$i];
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->KODE_PERK;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
            }
            // PEMBUKAAN DEPOSITO VIA TABUNGAN 
            if(empty($inputtransmasterbuff->trans_id)==false AND $postingdep[$i]->MY_KODE_TRANS=='0' AND empty($postingdep[$i]->NO_REK_OB)==false)
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Buka Deposito #REK'.$norek[$i].'via Tabungan #Rek '.$postingdep[$i]->NO_REK_OB;
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->GL_TRANS;
                $inputtransdetailbuff->debet=$saldotrans[$i];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Buka Deposito #REK'.$norek[$i].'via Tabungan #Rek '.$postingdep[$i]->NO_REK_OB;
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->KODE_PERK;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
            }
            // AMBIL TITIPAN 
            $ambiltrans_id[]=$inputtransmasterbuff->trans_id;
            if(empty($inputtransmasterbuff->trans_id)==false AND substr($postingdep[$i]->KUITANSI,0,3)<>"SYS" AND $postingdep[$i]->TYPE_TRANS=='D' AND $postingdep[$i]->MASUK_TITIPAN==1 AND empty($postingdep[$i]->NO_REK_OB)==true)
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB/Tunai Penarikan Titipan Deposito #REK'.$norek[$i];
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->KODE_PERK_TITIPAN;
                $inputtransdetailbuff->debet=$saldotrans[$i];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB/Tunai Penarikan Titipan Deposito #REK'.$norek[$i];
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->GL_TRANS;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
            }
            // AMBIL TITIPAN LEWAT TABUNGAN
            elseif(empty($inputtransmasterbuff->trans_id)==false AND substr($postingdep[$i]->KUITANSI,0,3)<>"SYS" AND $postingdep[$i]->TYPE_TRANS=='D' AND $postingdep[$i]->MASUK_TITIPAN==1 AND empty($postingdep[$i]->NO_REK_OB)==false)
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Penarikan Titipan Deposito #REK'.$norek[$i].'KE TABUNGAN';
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->KODE_PERK_TITIPAN;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Penarikan Titipan Deposito #REK'.$norek[$i].'KE TABUNGAN';
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->GL_TRANS;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
            }
            // POSTING OVB BUNGA DEPOSITO KE TABUNGAN
            elseif($i>0 AND empty($inputtransmasterbuff->trans_id)==false AND substr($postingdep[$i]->KUITANSI,0,7)=='SYS-BNG' AND substr($postingdep[$i-1]->KUITANSI,0,7)=='SYS-BNG' AND empty($postingdep[$i]->NO_REK_OB)==false AND ($norek[$i]==$norek[$i-1]) ){
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Tabungan#REK'.$postingdep[$i-1]->NO_REK_OB;
                $inputtransdetailbuff->kode_perk=$postingdep[$i-1]->KODE_PERK_BIAYA;
                $inputtransdetailbuff->debet=$saldotrans[$i-1];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Tabungan#REK'.$postingdep[$i-1]->NO_REK_OB;
                $inputtransdetailbuff->kode_perk=$kodeperkpajakdep[0]->Value;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Tabungan#REK'.$postingdep[$i-1]->NO_REK_OB;
                $inputtransdetailbuff->kode_perk=$postingdep[$i-1]->PERK_TAB;
                $inputtransdetailbuff->kredit=$saldotrans[$i-1]-$saldotrans[$i];
                $inputtransdetailbuff->save();
            }
            // POSTING OVB BUNGA KETITIPAN
            elseif($i>0 AND empty($inputtransmasterbuff->trans_id)==false AND substr($postingdep[$i]->KUITANSI,0,7)=='SYS-BNG' AND substr($postingdep[$i-1]->KUITANSI,0,7)=='SYS-BNG' AND $postingdep[$i]->MASUK_TITIPAN==1 AND ($norek[$i]==$norek[$i-1]))
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Titipan';
                $inputtransdetailbuff->kode_perk=$postingdep[$i-1]->KODE_PERK_BIAYA;
                $inputtransdetailbuff->debet=$saldotrans[$i-1];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Titipan';
                $inputtransdetailbuff->kode_perk=$postingdep[$i-1]->KODE_PERK_TITIPAN;
                $inputtransdetailbuff->kredit=$saldotrans[$i-1]-$saldotrans[$i];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Titipan';
                $inputtransdetailbuff->kode_perk=$kodeperkpajakdep[0]->Value;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
            }
            // POSTING OVB BUNGA BER BUNGA -> MASUK KETITIPAN DAHULU
            elseif($i>0 and empty($inputtransmasterbuff->trans_id)==false AND substr($postingdep[$i]->KUITANSI,0,7)=='SYS-BNG' AND substr($postingdep[$i-1]->KUITANSI,0,7)=='SYS-BNG' AND $postingdep[$i]->BUNGA_BERBUNGA==1 AND ($norek[$i]==$norek[$i-1]))
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Titipan';
                $inputtransdetailbuff->kode_perk=$postingdep[$i-1]->KODE_PERK_BIAYA;
                $inputtransdetailbuff->debet=$saldotrans[$i-1];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Titipan';
                $inputtransdetailbuff->kode_perk=$postingdep[$i-1]->KODE_PERK_TITIPAN;
                $inputtransdetailbuff->kredit=$saldotrans[$i-1]-$saldotrans[$i];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i-1].' Ke Titipan';
                $inputtransdetailbuff->kode_perk=$kodeperkpajakdep[0]->Value;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
            }
            elseif($i>0 and empty($inputtransmasterbuff->trans_id)==false AND substr($postingdep[$i]->KUITANSI,0,7)=='SYS-ARO' AND $postingdep[$i]->BUNGA_BERBUNGA==1)
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i].' Ke Titipan';
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->KODE_PERK_TITIPAN;
                $inputtransdetailbuff->debet=$saldotrans[$i];
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='OB Bng Deposito #REK '.$norek[$i].' Ke Titipan';
                $inputtransdetailbuff->kode_perk=$postingdep[$i]->KODE_PERK;
                $inputtransdetailbuff->kredit=$saldotrans[$i];
                $inputtransdetailbuff->save();
            }
            DB::select("update deptrans set posted='1' where deptrans_id=".$postingdep[$i]->DEPTRANS_ID);
        }
        // PROSE POSTING TRANSAKSI KREDIT
        $sqlpostkre = "SELECT kretrans.*,nasabah.nama_nasabah,kodejenistabungan.KODE_PERK,kodejeniskredit.KODE_PERK_KREDIT,kodejeniskredit.KODE_PERK_BUNGA,kodejeniskredit.KODE_PERK_DENDA,kodejeniskredit.KODE_PERK_ADM,kodejeniskredit.KODE_PERK_PROVISI,kodejeniskredit.KODE_PERK_PPAP,kodejeniskredit.kode_perk_biaya_transaksi,kodejeniskredit.KODE_PERK_PENDPTAN_BYTRANS,kodejeniskredit.kode_perk_ttp_provisi,kodejeniskredit.KODE_PERK_TTP_ADM,kodejeniskredit.KODE_PERK_KOREKSI_PBYAD,kodejeniskredit.PENDPTAN_BUNGA_YAD FROM ((((kretrans INNER JOIN kredit ON kretrans.NO_REKENING=kredit.NO_REKENING) INNER JOIN kodejeniskredit ON kredit.JENIS_PINJAMAN=kodejeniskredit.KODE_JENIS_KREDIT) INNER JOIN nasabah ON kredit.NASABAH_ID=nasabah.nasabah_id) LEFT JOIN tabung ON kretrans.NO_REK_TABUNGAN=tabung.NO_REKENING) LEFT JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN WHERE (kretrans.MY_KODE_TRANS like '1%' OR kretrans.MY_KODE_TRANS like '3%') AND (kretrans.TGL_TRANS>='$request->tgl_awal' AND kretrans.TGL_TRANS<='$request->tgl_akhir') AND kretrans.POSTED=0 ORDER BY KRETRANS_ID;
        ";

        $postingkre = DB::select($sqlpostkre);
        for($i=0;$i<count($postingkre);$i++)
        {
            $inputtransmasterbuff = new Trans_master_buffer();
            if(substr($postingkre[$i]->MY_KODE_TRANS,0,1)=='1' AND empty($postingkre[$i]->NO_REK_TABUNGAN)==true)
            {
                $inputtransmasterbuff->tgl_trans=$postingkre[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='KM';
                $inputtransmasterbuff->no_bukti=$postingkre[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingkre[$i]->POKOK_TRANS;
                $inputtransmasterbuff->keterangan='REALISASI TUNAI #REK:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
            }
            // PNC VIA TABUNGAN
            elseif(substr($postingkre[$i]->MY_KODE_TRANS,0,1)=='1' AND empty($postingkre[$i]->NO_REK_TABUNGAN)==false)
            {
                $inputtransmasterbuff->tgl_trans=$postingkre[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='KM';
                $inputtransmasterbuff->no_bukti=$postingkre[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingkre[$i]->POKOK_TRANS;
                $inputtransmasterbuff->keterangan='REALISASI TUNAI #REK:'.$postingkre[$i]->NO_REKENING;
            }
            // posting angsuran tunai ke trans_master_buffer transaksi 
            elseif(substr($postingkre[$i]->MY_KODE_TRANS,0,1)=='3' AND empty($postingkre[$i]->NO_REK_TABUNGAN)==true)
            {
                $inputtransmasterbuff->tgl_trans=$postingkre[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='KM';
                $inputtransmasterbuff->no_bukti=$postingkre[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingkre[$i]->POKOK_TRANS+$postingkre[$i]->BUNGA_TRANS+$postingkre[$i]->DENDA_TRANS;
                $inputtransmasterbuff->keterangan='Angsuran Kredit #Rek: '.$postingkre[$i]->NO_REKENING.'-'.trim($postingkre[$i]->nama_nasabah).'-TUNAI/OB';
            }
            // posting ke trans_master_buffer transaksi angsuran via tabungan
            elseif(substr($postingkre[$i]->MY_KODE_TRANS,0,1)=='3' AND empty($postingkre[$i]->NO_REK_TABUNGAN)==false)
            {
                $inputtransmasterbuff->tgl_trans=$postingkre[$i]->TGL_TRANS;
                $inputtransmasterbuff->kode_jurnal='KM';
                $inputtransmasterbuff->no_bukti=$postingkre[$i]->KUITANSI;
                $inputtransmasterbuff->nominal=$postingkre[$i]->POKOK_TRANS+$postingkre[$i]->BUNGA_TRANS+$postingkre[$i]->DENDA_TRANS;
                $inputtransmasterbuff->keterangan='Angsuran Kredit #Rek: '.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah.'-via Tabungan Rek '.$postingkre[$i]->NO_REK_TABUNGAN;
            }

            $inputtransmasterbuff->save();
            // INPUT TRANS_DETAIL_BUFFER
            // POSTING TRANSAKSI PNC TUNAI ke TRANS_DETAIL_BUFFER
            if(empty($inputtransmasterbuff->trans_id)==false AND substr($postingkre[$i]->MY_KODE_TRANS,0,1)=='1' AND empty($postingkre[$i]->NO_REK_TABUNGAN)==true AND $postingkre[$i]->TOB='T')
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_KREDIT;
                $inputtransdetailbuff->debet=$postingkre[$i]->POKOK_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$kodeperkteller[0]->Value;
                $inputtransdetailbuff->kredit=$postingkre[$i]->POKOK_TRANS;
                $inputtransdetailbuff->save();
                if($postingkre[$i]->PROVISI_TRANS>0)
                {
                    $inputtransdetailbuff=new Trans_detail_buffer();
                    $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                    $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                    $inputtransdetailbuff->kode_perk=$kodeperkteller[0]->Value;
                    $inputtransdetailbuff->debet=$postingkre[$i]->PROVISI_TRANS;
                    $inputtransdetailbuff->save();
                    $inputtransdetailbuff=new Trans_detail_buffer();
                    $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                    $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                    $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_PROVISI;
                    $inputtransdetailbuff->kredit=$postingkre[$i]->PROVISI_TRANS;
                    $inputtransdetailbuff->save();
                }
                if($postingkre[$i]->ADMIN_TRANS>0)
                {
                    $inputtransdetailbuff=new Trans_detail_buffer();
                    $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                    $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                    $inputtransdetailbuff->kode_perk=$kodeperkteller[0]->Value;
                    $inputtransdetailbuff->debet=$postingkre[$i]->ADMIN_TRANS;
                    $inputtransdetailbuff->save();
                    $inputtransdetailbuff=new Trans_detail_buffer();
                    $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                    $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                    $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_ADM;
                    $inputtransdetailbuff->kredit=$postingkre[$i]->ADMIN_TRANS;
                    $inputtransdetailbuff->save();
                }

            }
            // POSTING PNC VIA TABUNGAN ke TRANS_DETAIL_BUFFER
            if(empty($inputtransmasterbuff->trans_id)==false AND substr($postingkre[$i]->MY_KODE_TRANS,0,1)=='1' AND empty($postingkre[$i]->NO_REK_TABUNGAN)==false AND $postingkre[$i]->TOB='O')
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_KREDIT;
                $inputtransdetailbuff->debet=$postingkre[$i]->POKOK_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK;
                $inputtransdetailbuff->kredit=$postingkre[$i]->POKOK_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK;
                $inputtransdetailbuff->debet=$postingkre[$i]->PROVISI_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Realissai Kredit #Rek:'.$postingkre[$i]->NO_REKENING;
                $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_PROVISI;
                $inputtransdetailbuff->kredit=$postingkre[$i]->PROVISI_TRANS;
                $inputtransdetailbuff->save();
            }
            // POSTING ANGSURAN TUNAI ke TRANS_DETAIL_BUFFER
            if(empty($inputtransmasterbuff->trans_id)==false AND substr($postingkre[$i]->MY_KODE_TRANS,0,1)=='3' AND empty($postingkre[$i]->NO_REK_TABUNGAN)==true AND $postingkre[$i]->TOB='T')
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Angsuran Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                $inputtransdetailbuff->kode_perk=$kodeperkteller[0]->Value;
                $inputtransdetailbuff->debet=$postingkre[$i]->POKOK_TRANS+$postingkre[$i]->BUNGA_TRANS+$postingkre[$i]->DENDA_TRANS ;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Angsuran Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_KREDIT;
                $inputtransdetailbuff->kredit=$postingkre[$i]->POKOK_TRANS;
                $inputtransdetailbuff->save();

                if($postingkre[$i]->BUNGA_TRANS>0)
                {
                    $inputtransdetailbuff=new Trans_detail_buffer();
                    $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                    $inputtransdetailbuff->URAIAN='Angsuran Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                    $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_BUNGA;
                    $inputtransdetailbuff->kredit=$postingkre[$i]->BUNGA_TRANS;
                    $inputtransdetailbuff->save();
                }
                if($postingkre[$i]->DENDA_TRANS>0)
                {
                    $inputtransdetailbuff=new Trans_detail_buffer();
                    $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                    $inputtransdetailbuff->URAIAN='Angsuran Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                    $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_DENDA;
                    $inputtransdetailbuff->kredit=$postingkre[$i]->DENDA_TRANS;
                    $inputtransdetailbuff->save();
                }
            }
            // POSTING ANGSURAN VIA TABUNGAN KE TRANS_DETAIL_BUFFER
            if(empty($inputtransmasterbuff->trans_id)==false AND substr($postingkre[$i]->MY_KODE_TRANS,0,1)=='3' AND empty($postingkre[$i]->NO_REK_TABUNGAN)==false AND $postingkre[$i]->TOB='T')
            {
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Angsuran Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK;
                $inputtransdetailbuff->debet=$postingkre[$i]->POKOK_TRANS+$postingkre[$i]->BUNGA_TRANS+$postingkre[$i]->DENDA_TRANS;
                $inputtransdetailbuff->save();
                $inputtransdetailbuff=new Trans_detail_buffer();
                $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                $inputtransdetailbuff->URAIAN='Angsuran Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_KREDIT;
                $inputtransdetailbuff->kredit=$postingkre[$i]->POKOK_TRANS;
                $inputtransdetailbuff->save();

                if($postingkre[$i]->BUNGA_TRANS>0)
                {
                    $inputtransdetailbuff=new Trans_detail_buffer();
                    $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                    $inputtransdetailbuff->URAIAN='Angsuran Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                    $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_BUNGA;
                    $inputtransdetailbuff->kredit=$postingkre[$i]->BUNGA_TRANS;
                    $inputtransdetailbuff->save();
                }
                if($postingkre[$i]->DENDA_TRANS>0)
                {
                    $inputtransdetailbuff=new Trans_detail_buffer();
                    $inputtransdetailbuff->master_id=$inputtransmasterbuff->trans_id;
                    $inputtransdetailbuff->URAIAN='Angsuran Kredit #Rek:'.$postingkre[$i]->NO_REKENING.'-'.$postingkre[$i]->nama_nasabah;
                    $inputtransdetailbuff->kode_perk=$postingkre[$i]->KODE_PERK_DENDA;
                    $inputtransdetailbuff->kredit=$postingkre[$i]->DENDA_TRANS;
                    $inputtransdetailbuff->save();
                }
            }
            DB::select("update kretrans set posted='1' where KRETRANS_ID=".$postingkre[$i]->KRETRANS_ID);

        }

        return redirect()->back()->with('alert','POSTING TRANSAKSI SELESAI');
    }
    // Show form validation 
    public function bo_ak_tt_validasidatatransaksi()
    {
        $users = User::all();
        $logos = Logo::all();
        $brwsetransmasterbuff = Trans_master_buffer::with(['transdetailbuffer','perkiraan'])->get();
        return view('akuntansi.frmvalidasitransaksi',['users'=>$users, 'logos'=>$logos,'brwsetransmasterbuff'=>$brwsetransmasterbuff,'msgstatus'=>'']);
    }
    public function bo_ak_tt_caridatatransaksi(Request $request)
    {
        $users = User::all();
        $logos = Logo::all();
        $master_id2=$request->trans_id;
        $detail = Trans_detail_buffer::with('perkiraan')->where('master_id',$request->trans_id)->orderBy('trans_id')->get();
        $perkiraan = Perkiraan::orderBy('kode_perk')->get();
        return view('akuntansi.frmtransdetail',['users'=>$users, 'logos'=>$logos,'detail'=>$detail,'perkiraan'=>$perkiraan,'master_id2'=>$master_id2,'msgstatus'=>'']);
    }
    // Simpan perubahan trans_detail_buffer
    public function bo_ak_tt_simpanupdvalidasi(Request $request)
    {
        $users = User::all();
        $logos = Logo::all();
        $this->validate($request,[
            'trans_id'=>'required',
            'uraian'=>'required',
            'kode_perk'=>'required',
            'nama_perk'=>'required',
        ]);
        Trans_detail_buffer::where('trans_id',$request->trans_id)
                            ->update(
                                [
                                    'URAIAN'=>$request->uraian,
                                    'kode_perk'=>$request->kode_perk
                                ]);
        return redirect()->route('showformvalidasidatatransaksi');
    }
    public function bo_ak_tt_addrecvalidasi(Request $request)
    {
        // dd($request);
        $users = User::all();
        $logos = Logo::all();
        $this->validate($request,[
            'master_id2'=>'required',
            'uraian'=>'required',
            'kode_perk'=>'required',
            'nama_perk'=>'required',
            'type'=>'required|regex:/[D]/'
        ]);
        $simpan = new Trans_detail_buffer();
        $simpan->master_id=$request->master_id2;
        $simpan->uraian=$request->uraian;
        $simpan->kode_perk=$request->kode_perk;
        $simpan->debet=$request->debet;
        $simpan->kredit=$request->kredit;
        $simpan->save();
        return redirect()->route('caritrans',['trans_id'=>$request->master_id2]);
    }
    // Hapus data detail_trans_buffer
    public function bo_ak_tt_deltransdetailbuff(Request $request)
    {
        $users = User::all();
        $logos = Logo::all();
        $this->validate($request,[
            'trans_id'=>'required',
            'master_id'=>'required',
        ]);
        Trans_detail_buffer::where('trans_id',$request->trans_id)->delete();
        return redirect()->route('caritrans',['trans_id'=>$request->master_id]);
    }
    public function bo_ak_tt_simpanjurnal(Request $request)
    {
        $buffermst = Trans_master_buffer::where('trans_id',$request->master_id)->get();
        for ($i=0; $i<count($buffermst); $i++)
        {
            $simpantrms=new Trans_master();
            $simpantrms->tgl_trans = $buffermst[$i]->tgl_trans;
            $simpantrms->kode_jurnal = $buffermst[$i]->kode_jurnal;
            $simpantrms->no_bukti = $buffermst[$i]->no_bukti;
            $simpantrms->src = 'TL';
            $simpantrms->NOMINAL = $buffermst[$i]->nominal;
            $simpantrms->KETERANGAN = $buffermst[$i]->keterangan;
            $simpantrms->save();
        }
        $masteridbaru=$simpantrms->trans_id;
        Trans_detail_buffer::where('master_id',$request->master_id)
                                    ->update([
                                        'master_id' => $masteridbaru
                                    ]);
        $buffer = Trans_detail_buffer::where('master_id',$masteridbaru)->get();
        for ($i=0; $i<count($buffer); $i++)
        {
            $simpantrdt=new Trans_detail();
            $simpantrdt->master_id = $buffer[$i]->master_id;
            $simpantrdt->URAIAN = $buffer[$i]->URAIAN;
            $simpantrdt->kode_perk = $buffer[$i]->kode_perk;
            $simpantrdt->debet = $buffer[$i]->debet;
            $simpantrdt->kredit = $buffer[$i]->kredit;
            $simpantrdt->save();
        }
        Trans_detail_buffer::where('master_id',$masteridbaru)->delete();    
        Trans_master_buffer::where('trans_id',$request->master_id)->delete();
        return redirect()->route('showformvalidasidatatransaksi')->with('alert','SIMPAN POSTING TRANSAKSI SELESAI');
    }
    // SHOW FORM CREATE JOURNAL TRANSACTION 
    public function bo_ak_tt_showfrmctttransaksi()
    {
        $users = User::all();
        $logos = Logo::all();
        $hasil =[];
        $kodejurnal=KodeJurnal::all();
        $perkiraan= Perkiraan::orderBy('kode_perk', 'ASC')->get();
        Trans_detail_buffer::where('master_id','<=',10)->delete();
        $hasil = Trans_detail_buffer::with('perkiraan')->where('master_id','<=',10)->get();
        return view('akuntansi.frmcatatjurnaltransaksi',['logos'=>$logos,'users'=>$users,'perkiraan'=>$perkiraan,'kodejurnal'=>$kodejurnal,'hasil'=>$hasil,'masterid'=>'','msgstatus'=>'']);

    }
    // Simpan Jurnal Sementara sebelum di simpan ke Trans_master dan trans_detail
    public function bo_tb_de_savetempjurnalmemorial(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'kode_perk'=>'required'
        ]);

        $simpan = new Trans_detail_buffer();
        if(is_null($request->masterid)) {
            $simpan->master_id = rand(1,10);
        }else{
            $simpan->master_id = $request->masterid;
        }
        // BUAT SIMPAN TRANSAKSI JURNAL MEMORIAL
        $tgl_trans=$request->inputtgljurnal;
        $kode_jurnal = $request->kode_jurnal;
        $no_bukti = $request->no_bukti;
        $keterangan = $request->keterangan;
        // --------------------------------
        $simpan->URAIAN = $request->keterangan;
        $simpan->kode_perk = $request->kode_perk;
        $simpan->debet =$request->debet;
        $simpan->kredit =$request->kredit;
        $simpan->save();
        $masterid = $simpan->master_id;
        $jml=DB::select('SELECT SUM(debet) as jml from trans_detail_buffer WHERE master_id='.$masterid);
        $total =$jml[0]->jml;
        $users = User::all();
        $logos = Logo::all();
        $kodejurnal=KodeJurnal::all();
        $perkiraan= Perkiraan::orderBy('kode_perk', 'ASC')->get();
        $hasil = Trans_detail_buffer::with('perkiraan')->where('master_id',$simpan->master_id)->orderBy('trans_id')->get();
        return view('akuntansi.frmcatatjurnaltransaksi',['logos'=>$logos,'users'=>$users,'perkiraan'=>$perkiraan,'kodejurnal'=>$kodejurnal,'hasil'=>$hasil,'masterid'=>$masterid,'tgl_trans'=>$tgl_trans,'kode_jurnal'=>$kode_jurnal,'no_bukti'=>$no_bukti,'keterangan'=>$keterangan,'total'=>$total,'msgstatus'=>'']);
    }
    public function bo_ak_tt_delcatatjurnaldetail(Request $request)
    {
        // dd($request);
        if(is_null($request->master_id)) {
            $master_id = rand(1,10);
        }else{
            $master_id = $request->master_id;
        }
        Trans_detail_buffer::where('trans_id',$request->trans_id)->delete();
        $users = User::all();
        $logos = Logo::all();
        $kodejurnal=KodeJurnal::all();
        $perkiraan= Perkiraan::orderBy('kode_perk', 'ASC')->get();
        $hasil = Trans_detail_buffer::with('perkiraan')->where('master_id',$master_id)->orderBy('trans_id')->get();
        // BUAT SIMPAN TRANSAKSI JURNAL MEMORIAL
        $tgl_trans=$request->tgl_transx;
        $kode_jurnal = $request->kode_jurnalx;
        $no_bukti = $request->no_buktix;
        $keterangan = $request->keteranganx;
        $jml=DB::select('SELECT SUM(debet) as jml from trans_detail_buffer WHERE master_id='.$master_id);
        $total =$jml[0]->jml;

        return view('akuntansi.frmcatatjurnaltransaksi',['logos'=>$logos,'users'=>$users,'perkiraan'=>$perkiraan,'kodejurnal'=>$kodejurnal,'hasil'=>$hasil,'masterid'=>$master_id,'tgl_trans'=>$tgl_trans,'kode_jurnal'=>$kode_jurnal,'no_bukti'=>$no_bukti,'keterangan'=>$keterangan,'total'=>$total,'msgstatus'=>'']);
    }
    // SIMPAN PENCATATAN JURNAL MEMORIAL/TRANSAKSI  
    public function bo_ak_tt_simpancatatjurnal(Request $request)
    {
        // dd($request);
        $simpanmstr = new Trans_master();
        $simpanmstr->tgl_trans = $request->tgl_trans;
        $simpanmstr->kode_jurnal = $request->kode_jurnal;
        $simpanmstr->no_bukti = $request->no_bukti;
        $simpanmstr->src = 'GL';
        $simpanmstr->NOMINAL = $request->total;
        $simpanmstr->KETERANGAN = $request->keterangan;
        $simpanmstr->save();

        $rs = Trans_detail_buffer::where('master_id', $request->master_idx)->get();
        foreach($rs as $value){
            $simpan = new Trans_detail();
            $simpan->master_id = $request->master_idx;
            $simpan->URAIAN = $value->URAIAN;
            $simpan->kode_perk = $value->kode_perk;
            $simpan->debet =$value->debet;
            $simpan->kredit =$value->kredit;
            $simpan->save();
        }
        Trans_detail::where('master_id', $request->master_idx)
                            ->update(
                                [
                                    'master_id' => $simpanmstr->trans_id
                                ]);
        // HAPUS TRANS_DETAIL_BUFFFER
        Trans_detail_buffer::where('master_id',$request->master_idx)->delete();
        return  redirect()->route('showformcatattransaksi')->with('alert', 'JURNAL TRANSAKSI BERHASIL DI SIMPAN');
    }
    // UPDATE KODE_PERK SAAT MERUBAH DATA PADA PENCATATAN JURNAL TRANSAKSI
    public function bo_ak_tt_updatecatatjurnal(Request $request)
    {
        // BUAT SIMPAN TRANSAKSI JURNAL MEMORIAL
        if(is_null($request->master_id)) {
            $master_id = rand(1,10);
        }else{
            $master_id = $request->master_id;
        }
        $tgl_trans=$request->tgl_transupd;
        $kode_jurnal = $request->kode_jurnalupd;
        $no_bukti = $request->no_buktiupd;
        $keterangan = $request->keteranganupd;
        $jml=DB::select('SELECT SUM(debet) as jml from trans_detail_buffer WHERE master_id='.$master_id);
        $total =$jml[0]->jml;
        Trans_detail_buffer::where('trans_id',$request->trans_id)
                            ->update(
                            [
                                'kode_perk'=>$request->kode_perk,
                                'debet'=>$request->debet,
                                'kredit'=>$request->kredit
                            ]
                            );
        $users = User::all();
        $logos = Logo::all();
        $kodejurnal=KodeJurnal::all();
        $perkiraan= Perkiraan::orderBy('kode_perk', 'ASC')->get();
        $hasil = Trans_detail_buffer::with('perkiraan')->where('master_id',$master_id)->orderBy('trans_id')->get();
        return view('akuntansi.frmcatatjurnaltransaksi',['logos'=>$logos,'users'=>$users,'perkiraan'=>$perkiraan,'kodejurnal'=>$kodejurnal,'hasil'=>$hasil,'masterid'=>$master_id,'tgl_trans'=>$tgl_trans,'kode_jurnal'=>$kode_jurnal,'no_bukti'=>$no_bukti,'keterangan'=>$keterangan,'total'=>$total,'msgstatus'=>'']);
    }
    // Show hsitory Pencatatan Jurnal 
    public function bo_ak_tt_historycatatjurnal()
    {
        $users = User::all();
        $logos = Logo::all();
        $history =[];
        $perkiraan= Perkiraan::orderBy('kode_perk', 'ASC')->get();

        return view('akuntansi.frmhistorycatatjurnal',['users'=>$users,'logos'=>$logos,'history'=>$history,'perkiraan'=>$perkiraan,'msgstatus'=>'']);
    }
    // Cari Pencatatan Jurnal 
    public function bo_ak_tt_carihistorycatatjurnal(Request $request)
    {
        $this->validate($request,[
            'no_bukti'=>'required'
        ]);
        if(is_null($request->keterangan))
        {
            $history = Trans_master::with(['perkiraan','transdetail'])->where('no_bukti','LIKE','%'.$request->no_bukti.'%')->get();
        }else{
            $history = Trans_master::with(['perkiraan','transdetail'])->where('no_bukti','LIKE','%'.$request->no_bukti.'%')->orWhere('KETERANGAN','LIKE','%'.$request->keterangan.'%')->get();
        }
        $users = User::all();
        $logos = Logo::all();
        $perkiraan= Perkiraan::orderBy('kode_perk', 'ASC')->get();

        return view('akuntansi.frmhistorycatatjurnal',['users'=>$users,'logos'=>$logos,'history'=>$history,'perkiraan'=>$perkiraan,'msgstatus'=>'']);

    }
    // SHOW detail perk pencatatan jurnal
    public function bo_ak_tt_detailhistorycatatjurnal($id)
    {
        $rs = Trans_detail::with('perkiraan')->where('master_id',$id)->get();
        $users = User::all();
        $logos = Logo::all();
        $perkiraan= Perkiraan::orderBy('kode_perk', 'ASC')->get();
        $history = [];
        return view('akuntansi.frmhistorycatatjurnal',['users'=>$users,'logos'=>$logos,'history'=>$history,'cari'=>$rs,'perkiraan'=>$perkiraan,'msgstatus'=>'']);
    }
    // SImpan perubahan history pencatatan jurnal
    public function bo_ak_tt_updatehistorycatatjurnal(Request $request)
    {
        Trans_detail::where('trans_id',$request->trans_id)->update(
            [
                'kode_perk'=>$request->kode_perk,
                'debet'=>$request->debet,
                'kredit'=>$request->kredit
            ]
        );
        return redirect()->route('historycatatjurnal',['id'=>$request->master_id])->with('alert','Update Berhasil');
    }
    public function bo_ak_tt_deletehistorycatatjurnal(Request $request)
    {
        Trans_master::where('trans_id',$request->trans_id)->delete();
        Trans_detail::where('master_id',$request->trans_id)->delete();;
        
        // $trd->delete();
        return redirect()->route('historycatatjurnal',['id'=>$request->trans_id])->with('alert','Delete master_id : '.$request->trans_id.' Berhasil');
    }
    // show form data admin perkiraan 
    public function bo_ak_de_showformdataperkiraan()
    {
        $perk=DB::table('perkiraan')->orderBy('kode_perk','asc')->get();
        $logos = Logo::all();
        $users = User::all();
        
        return view('akuntansi/dataperkiraan',['users'=>$users,'perkiraan'=>$perk,'logos'=>$logos,'msgstatus'=>'']);
    }
    // ADD Perkiraan
    public function bo_ak_de_addperkiraan(Request $request)
    {
        $validasi=$request->validate([
            'kode_perk' => 'required|unique:perkiraan',
            'kode_induk' => 'required',
            'nama_perk' => 'required|unique:perkiraan',
            'type' => 'required',
            'dk' => 'required',
        ]);
        $savekodeperk=DB::table('perkiraan')->insert(
            [
                'kode_perk'=>$request->kode_perk,
                'nama_perk'=>$request->nama_perk,
                'kode_induk'=>$request->kode_induk,
                'type'=>'D',
                'dk'=>$request->dk
            ]);
            DB::table('perkiraan')
                        ->where('kode_perk',$request->kode_induk)
                        ->update([
                            'kode_perk_d_max'=>$request->kode_perk,
                            'type'=>'G'
                        ]);
        return redirect()->route('showformperkiraan')->with('alert','Data Perkiraan '.$request->kode_perk.' Berhasil iupdate');
    }
    // Delete perkiraan
    public function bo_ak_de_delperkiraan(Request $request)
    {   
        // dd($request);
        $validasi=$request->validate([
            'saldo_akhir'=>'numeric|max:0'
        ]);
        $hapus=DB::table('perkiraan')->where('kode_perk',$request->kode_perk)->delete();

        if($hapus){$msg='1';}else{$msg='0';}
        $cekkodeperk=Perkiraan::where('kode_induk',$request->kode_induk)->get();
        if(count($cekkodeperk)==0)
        {
            Perkiraan::where('kode_perk',$request->kode_induk)->update(['type'=>'D','kode_perk_d_max'=>NULL]);
        }
        return redirect()->route('showformperkiraan')->with('alert','Data Perkiraan '.$request->kode_perk.' Berhasil Dihapus');
    }
        // Update Perkiraan
    public function bo_ak_de_updateperkiraan(Request $request)
    {
                DB::table('perkiraan')
                ->where('kode_perk',$request->kode_perk)
                ->update(
                    [
                        'kode_perk'=>$request->kode_perk,
                        'nama_perk'=>$request->nama_perk
                    ]);
            return redirect()->route('showformperkiraan')->with('alert','Data Perkiraan '.$request->kode_perk.' Berhasil DiUpdate');
    }
        // Show form pencatatan kode jurnal transaksi
    public function bo_ak_de_showfrmkodetransaksi()
    {
        $kode=DB::table('kodejurnal')->get();
        $logos = Logo::all();
        $users = User::all();
        
        return view('akuntansi/frmkodejurnal',['users'=>$users,'kodejur'=>$kode,'logos'=>$logos,'msgstatus'=>'']);
    }
    // add Kode Jurnal
    public function bo_ak_de_addkodejurnal(Request $request)
    {
        $this->validate($request,[
            'kode_jurnal'=>'required|unique:kodejurnal',
            'nama_jurnal'=>'required'
        ]);
        $simpan = new KodeJurnal();
        $simpan->kode_jurnal = $request->kode_jurnal;
        $simpan->nama_jurnal = $request->nama_jurnal;
        $simpan->save();
        return redirect()->route('showfrmkodetransaksi')->with('alert','Kode Jurnal Berhasil Ditambahkan');
    }

    public function bo_ak_de_updatekodejurnal(Request $request)
    {
        KodeJurnal::where('kode_jurnal',$request->kode_jurnal)->update([
                'kode_jurnal'=>$request->kode_jurnal,
                'nama_jurnal'=>$request->nama_jurnal,
        ]);
        return redirect()->route('showfrmkodetransaksi')->with('alert','Kode Jurnal Berhasil iupdate');
    }
    // delete kode jurnal
    public function bo_ak_de_delkodejurnaltrans(Request $request)
    {
        KodeJurnal::where('kode_jurnal',$request->kode_jurnal)->delete();
        return redirect()->route('showfrmkodetransaksi')->with('alert','Kode Jurnal Berhasil iupdate');
    }
    // form tampilan laporan
    public function bo_ak_lp_showfrnrptdaftarperkiraan()
    {
        $users = User::all();
        $logos = Logo::all();
        $perkiraan = Perkiraan::orderBy('kode_perk')->get();
        return view('reports.akuntansi.frmrptperkiraan',['users' => $users, 'logos' => $logos, 'perkiraan'=>$perkiraan,'msgstatus'=>'']);
    }
    // munculkan preview cetak daftar perkiraan
    public function bo_pr_perkiraan()
    {
        $perkiraan = Perkiraan::orderBy('kode_perk')->get();
        return view('pdf.akuntansi.cetakperkiraan',['perkiraan'=>$perkiraan]);
    }
    // export daftar perkiraan
    public function bo_ex_daftarperkiraan()
    {
        $perkiraan = DB::select("select * from perkiraan order by kode_perk");
        return (new ReportdaftarperkiraanExport($perkiraan))->download('perkiraan.xlsx');
    }
    // show form report of transactions jurnal
    public function showfrmrptjurnaltransaksi()
    {
        $users = User::all();
        $logos = Logo::all();
        return view('reports.akuntansi.frmrptjurnaltrans',['users' => $users, 'logos' => $logos]);
    }
    public function bo_ak_lp_carijurnal(Request $request)
    {
        $this->validate($request,[
            'tgl_trans1'=>'required',
            'tgl_trans2'=>'required'
        ]);
        $users = User::all();
        $logos = Logo::all();
        $sql = "SELECT * FROM (trans_master INNER JOIN trans_detail ON trans_master.trans_id=trans_detail.master_id) INNER JOIN perkiraan ON trans_detail.kode_perk=perkiraan.kode_perk WHERE trans_master.tgl_trans>='$request->tgl_trans1' AND trans_master.tgl_trans<='$request->tgl_trans2'";
        $rs = DB::select($sql);
        return view('reports.akuntansi.frmrptjurnaltrans',['users' => $users,'logos' => $logos,'jurnal'=>$rs,'tgl_trans1'=>$request->tgl_trans1,'tgl_trans2'=>$request->tgl_trans2]);
    }
    public function bo_ak_lp_cetakjurnal(Request $request)
    {
        $this->validate($request,[
            'tgl_trans1'=>'required',
            'tgl_trans2'=>'required'
        ]);
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_GL'.'%'.'N'.'%')->get();

        $sql = "SELECT * FROM (trans_master INNER JOIN trans_detail ON trans_master.trans_id=trans_detail.master_id) INNER JOIN perkiraan ON trans_detail.kode_perk=perkiraan.kode_perk WHERE trans_master.tgl_trans>='$request->tgl_trans1' AND trans_master.tgl_trans<='$request->tgl_trans2' order by trans_detail.master_id, trans_detail.debet DESC";
        $rs = DB::select($sql);

        return view('pdf.akuntansi.cetakjurnaltrans',['jurnal' => $rs,'lembaga'=>$lembaga,'ttd' =>$ttd]);          
    }
}
