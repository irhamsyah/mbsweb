<?php

namespace App\Http\Controllers;
use App\Golonganpihaklawan;
use App\KodeGroup1Nasabah;
use App\KodeGroup1Tabung;
use App\KodeGroup2Tabung;
use App\KodeGroup3Tabung;
use App\Kodejenistabungan;
use App\Kodeketerkaitanlapbul;
use App\Kodemetoda;
use App\Kodecabang;
use Illuminate\Http\Request;
use App\Tabungan;
use App\Logo;
use App\Mysysid;
use App\Nasabah;
use App\User;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Tests;
use App\Exports\ReporttabunganExport;
class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function bo_tb_de_tabungan()
    {
        $logos = Logo::all();
        $nasabah=Nasabah::select('nasabah_id','nama_nasabah','alamat')->get();
        $tabungan=DB::select('select tabung.*,kodejenistabungan.deskripsi_jenis_tabungan,nasabah.nama_nasabah,nasabah.alamat,kodegroup1tabung.DESKRIPSI_GROUP1,kodegroup2tabung.DESKRIPSI_GROUP2,kodegroup3tabung.DESKRIPSI_GROUP3,golongan_pihaklawan.deskripsi_golongan,kodemetoda.DESKRIPSI_METODA,kode_keterkaitan_lapbul.DESKRIPSI_SANDI from (((((((tabung inner join nasabah on tabung.nasabah_id=nasabah.nasabah_id) inner join kodejenistabungan on tabung.jenis_tabungan=kodejenistabungan.kode_jenis_tabungan) left join kodegroup1tabung on tabung.KODE_GROUP1=kodegroup1tabung.KODE_GROUP1) left join kodegroup2tabung on tabung.KODE_GROUP2=kodegroup2tabung.KODE_GROUP2) left join kodegroup3tabung on tabung.KODE_GROUP3=kodegroup3tabung.KODE_GROUP3) inner join golongan_pihaklawan on tabung.KODE_BI_PEMILIK=golongan_pihaklawan.sandi) inner join kodemetoda on tabung.KODE_BI_METODA=kodemetoda.KODE_METODA) inner join kode_keterkaitan_lapbul on tabung.KODE_BI_HUBUNGAN=kode_keterkaitan_lapbul.SANDI order by tabung.no_rekening limit 100');
        $users = User::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodegrou1tabungan = KodeGroup1Tabung::all();
        $kodegrou2tabungan = KodeGroup2Tabung::all();
        $kodegrou3tabungan = KodeGroup3Tabung::all();
        $kodejenistabungan = Kodejenistabungan::select('kode_jenis_tabungan','DESKRIPSI_JENIS_TABUNGAN')->get();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodeketerkaitanlapbul = Kodeketerkaitanlapbul::all();
        $kodemetoda = Kodemetoda::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        return view('admin.tabungan', ['users'=>$users,'nasabah'=>$nasabah,'logos'=> $logos,'tabungan'=> $tabungan,'kodegrou1tabungan'=> $kodegrou1tabungan,'kodegrou2tabungan'=> $kodegrou2tabungan,'kodegrou3tabungan'=>$kodegrou3tabungan,'kodejenistabungan'=> $kodejenistabungan,'golonganpihaklawan'=>$golonganpihaklawan,'kodeketerkaitanlapbul'=>$kodeketerkaitanlapbul,'kodemetoda'=>$kodemetoda,'kodecabang'=>$kodecabang,'tgllogin'=>$tgllogin,'tgl_login'=>$tgllogin]);
        }

    public function bo_tab_edit_tabungan(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'jenis_tabungan'=>'required',
            'no_rekening'=>'required',
            'nasabah_id'=>'required',
            'type_tabungan'=>'required',
            'suku_bunga'=>'required',
        ]);
        $nilai=0;
        if($request->saldo_blokir>0){
            $nilai=1;
        }
        Tabungan::where('NO_REKENING',$request->no_rekening)
        ->update(['nasabah_id' => $request->nasabah_id,
                    'jenis_tabungan' => $request->jenis_tabungan,
                    'no_rekening' => $request->no_rekening,
                    'no_alternatif' => $request->no_alternatif,
                    'cab' => $request->cab,
                    'type_tabungan' => $request->type_tabungan,
                    'suku_bunga' => $request->suku_bunga,
                    'persen_pph' => $request->persen_pph,
                    'tgl_bunga' => date('Y-m-d',strtotime($request->tgl_bunga)),
                    'saldo_blokir' => $request->saldo_blokir,
                    'blokir' => $nilai,
                    'kode_group1' => $request->kode_group1,
                    'kode_group2' => $request->kode_group2,
                    'kode_group3' => $request->kode_group3,
                    'kode_bi_pemilik' => $request->kode_bi_pemilik,
                    'kode_bi_metoda' => $request->kode_bi_metoda,
                    'kode_bi_hubungan' => $request->kode_bi_hubungan,
                    'flag_restricted' => $request->flag_restricted,
                    'minimum' => $request->minimum,
                    'setoran_minimum' => $request->setoran_minimum,
                    'setoran_per_bln' => $request->setoran_per_bln,
                    'abp' => $request->abp,
                    'adm_per_bln' => $request->adm_per_bln,
                    'periode_adm' => $request->periode_adm
              
                ]);

                return redirect()->back() ->with('alert', 'Data berhasil diupdate!');
            }

    public function bo_tab_add_tabung(Request $request)
    {
        // dd($request);
        $this->validate($request,
        [
            'jenis_tabungan'=>'required',
            'no_rekening'=>'required',
            'nasabah_id'=>'required',
            'tgl_bunga'=>'required',
            'type_tabungan'=>'required',
            'suku_bunga'=>'required',
            'persen_pph'=>'required',
        ]);
        $simpantabung = new Tabungan();

        $simpantabung->jenis_tabungan = $request->jenis_tabungan;
        $simpantabung->no_rekening = $request->no_rekening;
        $simpantabung->status_aktif = 1;
        $simpantabung->cab = $request->cab;
        $simpantabung->nasabah_id = $request->nasabah_id;
        $simpantabung->type_tabungan = $request->type_tabungan;
        $simpantabung->suku_bunga = $request->suku_bunga;
        $simpantabung->persen_pph = $request->persen_pph;
        $simpantabung->tgl_bunga = date('Y-m-d',strtotime($request->tgl_bunga));
        $simpantabung->tgl_registrasi = date('Y-m-d',strtotime($request->tgl_bunga));
        if($request->blokir=="on")
        {
            $simpantabung->blokir = 1;
        }else{
            $simpantabung->blokir = 0;
        }
        $simpantabung->jkw = 0;
        $simpantabung->saldo_blokir = $request->saldo_blokir;
        $simpantabung->kode_group1 = $request->kode_group1;
        $simpantabung->kode_group2 = $request->kode_group2;
        if(is_null($request->kode_group3)!=true){
            $simpantabung->kode_group3 = $request->kode_group3;
        }
        $simpantabung->kode_bi_pemilik = $request->kode_bi_pemilik;
        $simpantabung->kode_bi_metoda = $request->kode_bi_metoda;
        $simpantabung->kode_bi_hubungan = $request->kode_bi_hubungan;
        $simpantabung->flag_restricted = $request->flag_restricted;
        $simpantabung->minimum = $request->minimum;
        $simpantabung->setoran_minimum = $request->setoran_minimum;
        $simpantabung->setoran_per_bln = $request->setoran_per_bln;
        $simpantabung->abp = $request->abp;
        $simpantabung->adm_per_bln = $request->adm_per_bln;
        $simpantabung->periode_adm = 1;
        $simpantabung->save();

            return redirect()->back() ->with('alert', 'Data Berhasil Ditambahkan!');
    }

    public function cariprofiletab(Request $request) 
    {
        if(is_null($request->namanasabahcari)==true)
        {
            $opsi ="tabung.no_rekening like '%".$request->norekcari."%'";
        }elseif(is_null($request->norekcari)==true){
            $opsi ="naasabah.nama_nasabah like '%".$request->namanasabahcari."%'";
        }else{
            return redirect()->route('showtabungan');
        }

        $sql="select tabung.*,kodejenistabungan.deskripsi_jenis_tabungan,nasabah.nama_nasabah,nasabah.alamat,kodegroup1tabung.DESKRIPSI_GROUP1,kodegroup2tabung.DESKRIPSI_GROUP2,kodegroup3tabung.DESKRIPSI_GROUP3,golongan_pihaklawan.deskripsi_golongan,kodemetoda.DESKRIPSI_METODA,kode_keterkaitan_lapbul.DESKRIPSI_SANDI from (((((((tabung inner join nasabah on tabung.nasabah_id=nasabah.nasabah_id) inner join kodejenistabungan on tabung.jenis_tabungan=kodejenistabungan.kode_jenis_tabungan) left join kodegroup1tabung on tabung.KODE_GROUP1=kodegroup1tabung.KODE_GROUP1) left join kodegroup2tabung on tabung.KODE_GROUP2=kodegroup2tabung.KODE_GROUP2) left join kodegroup3tabung on tabung.KODE_GROUP3=kodegroup3tabung.KODE_GROUP3) inner join golongan_pihaklawan on tabung.KODE_BI_PEMILIK=golongan_pihaklawan.sandi) inner join kodemetoda on tabung.KODE_BI_METODA=kodemetoda.KODE_METODA) inner join kode_keterkaitan_lapbul on tabung.KODE_BI_HUBUNGAN=kode_keterkaitan_lapbul.SANDI where ".$opsi;
        $logos = Logo::all();
        $nasabah=Nasabah::select('nasabah_id','nama_nasabah','alamat')->get();
        $tabungan=DB::select($sql);
        $users = User::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodegrou1tabungan = KodeGroup1Tabung::all();
        $kodegrou2tabungan = KodeGroup2Tabung::all();
        $kodegrou3tabungan = KodeGroup3Tabung::all();
        $kodejenistabungan = Kodejenistabungan::select('kode_jenis_tabungan','DESKRIPSI_JENIS_TABUNGAN')->get();
        $golonganpihaklawan = Golonganpihaklawan::all();
        $kodeketerkaitanlapbul = Kodeketerkaitanlapbul::all();
        $kodemetoda = Kodemetoda::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        return view('admin.tabungancari', ['users'=>$users,'nasabah'=>$nasabah,'logos'=> $logos,'tabungan'=> $tabungan,'kodegrou1tabungan'=> $kodegrou1tabungan,'kodegrou2tabungan'=> $kodegrou2tabungan,'kodegrou3tabungan'=>$kodegrou3tabungan,'kodejenistabungan'=> $kodejenistabungan,'golonganpihaklawan'=>$golonganpihaklawan,'kodeketerkaitanlapbul'=>$kodeketerkaitanlapbul,'kodemetoda'=>$kodemetoda,'kodecabang'=>$kodecabang,'tgllogin'=>$tgllogin,'tgl_login'=>$tgllogin]);
    }

    public function bo_tb_rpt_nominatif()
    {
        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        return view('reports.frmsearchnom',['users'=>$users,'logos'=>$logos]);
    }

    public function bo_tb_rpt_nominatifview(Request $request) 
    {
        // dd(date('Y-m-d',strtotime($request->tgl_nominatif)));
        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        $this->validate($request,[
            'tgl_nominatif'=>'required'
        ]);
        $sql="SELECT
        a.NO_REKENING,
        a.nasabah_id,
        a.no_id,
        a.nama_nasabah,
        a.alamat,
        a.tempatlahir,
        a.tgllahir,
        a.npwp,
        a.suku_bunga,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) +
        IF
            ( ISNULL( a.saldokreditblnlalu ), 0, a.saldokreditblnlalu ) -
        IF
            ( ISNULL( a.saldodebetblnlalu ), 0, a.saldodebetblnlalu ) 
            ) AS saldo_bln_lalu,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) +
        IF
            ( ISNULL( a.saldokreditblnlalu ), 0, a.saldokreditblnlalu ) -
        IF
            ( ISNULL( a.saldodebetblnlalu ), 0, a.saldodebetblnlalu ) -
        IF
            ( ISNULL( a.bungabln ), 0, a.bungabln ) +
        IF
            ( ISNULL( a.adminbln ), 0, a.adminbln ) 
        ) AS saldo_eff_bln_ini,
    IF
        ( ISNULL( a.mutasi_debet ), 0, a.mutasi_debet ) AS mutasi_debet,
    IF
        ( ISNULL( a.mutasi_kredit ), 0, a.mutasi_kredit ) AS mutasi_kredit,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) -
        IF
            ( ISNULL( a.bungabln ), 0, a.bungabln ) +
        IF
            ( ISNULL( a.adminbln ), 0, a.adminbln ) 
        ) AS saldo_sbl_bunga,
    IF
        ( ISNULL( a.bungabln ), 0, a.bungabln ) AS bunga_bln_ini,
        0 AS pajak_bln_ini,
    IF
        ( ISNULL( a.adminbln ), 0, a.adminbln ) AS admin_bln_ini,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_stl_bunga,
        0 AS kupon,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.SALDO_BLOKIR,
        a.KODE_BI_PEMILIK,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.CAB AS kode_cab,
        a.TGL_REGISTRASI,
        a.JENIS_TABUNGAN,
        a.DESKRIPSI_JENIS_TABUNGAN,
        a.SETORAN_PER_BLN,
        a.TGL_MULAI,
        a.JKW,
        a.TGL_JT,
        a.NISBAH,
        a.KODE_BI_HUBUNGAN 
    FROM
        (
        SELECT
            tabung.NO_REKENING,
            nasabah.nasabah_id,
            nasabah.no_id,
            nasabah.nama_nasabah,
            nasabah.alamat,
            nasabah.tempatlahir,
            nasabah.tgllahir,
            nasabah.npwp,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.SALDO_BLOKIR,
            tabung.KODE_BI_PEMILIK,
            tabung.KODE_GROUP1,
            tabung.KODE_GROUP2,
            tabung.KODE_GROUP3,
            tabung.CAB,
            tabung.TGL_REGISTRASI,
            tabung.JENIS_TABUNGAN,
            kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
            tabung.SETORAN_PER_BLN,
            tabung.TGL_MULAI,
            tabung.JKW,
            tabung.TGL_JT,
            tabung.NISBAH,
            tabung.KODE_BI_HUBUNGAN,
            x.saldokredit,
            y.saldodebet,
            z.adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu,
            u.bungabln 
        FROM ((((((((( tabung INNER JOIN nasabah ON tabung.NASABAH_ID = 
        nasabah.nasabah_id ) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = 
        kodejenistabungan.KODE_JENIS_TABUNGAN) INNER JOIN (SELECT NO_REKENING,sum( 
        saldo_trans ) AS saldokredit FROM tabtrans WHERE MY_KODE_TRANS LIKE '1%' AND 
        tabtrans.tgl_trans <= '$inputantgl' GROUP BY tabtrans.NO_REKENING) x 
        ON tabung.NO_REKENING = x.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,sum( 
        saldo_trans ) AS saldodebet FROM tabtrans WHERE MY_KODE_TRANS LIKE '2%' AND 
        tabtrans.tgl_trans <= '$inputantgl' GROUP BY tabtrans.NO_REKENING) 
        y ON tabung.NO_REKENING = y.NO_REKENING) LEFT JOIN (SELECT 
        tabtrans.tabtrans_id,tabtrans.no_rekening,tabtrans.saldo_trans AS adminbln 
        FROM tabtrans INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING 
        FROM tabtrans WHERE KUITANSI LIKE '%sys-a%' AND TGL_TRANS <='$inputantgl' GROUP BY NO_REKENING ) yy ON tabtrans.TABTRANS_ID = 
        yy.tabid) z ON tabung.NO_REKENING = z.NO_REKENING) LEFT JOIN (SELECT 
        tabtrans.tabtrans_id,tabtrans.no_rekening, tabtrans.saldo_trans AS bungabln 
        FROM tabtrans INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING 
        FROM tabtrans WHERE KUITANSI LIKE '%sys-b%' AND TGL_TRANS <='$inputantgl' GROUP BY NO_REKENING ) xx ON tabtrans.TABTRANS_ID = 
        xx.tabid) u ON tabung.NO_REKENING = u.NO_REKENING) LEFT JOIN (SELECT 
        NO_REKENING,sum( saldo_trans ) AS saldokreditblnlalu FROM tabtrans WHERE 
        MY_KODE_TRANS LIKE '1%' AND tabtrans.tgl_trans <= DATE_ADD('$inputantgl', 
        INTERVAL - DAY ( DATE('$inputantgl')) DAY ) GROUP BY 
        tabtrans.NO_REKENING) sldkrdblnlalu ON tabung.NO_REKENING = 
        sldkrdblnlalu.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,sum( saldo_trans ) 
        AS saldodebetblnlalu FROM tabtrans WHERE MY_KODE_TRANS LIKE '2%' AND 
        tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( 
        '$inputantgl' )) DAY ) GROUP BY tabtrans.NO_REKENING) slddbtblnlalu ON 
        tabung.NO_REKENING = slddbtblnlalu.NO_REKENING) LEFT JOIN (SELECT 
        NO_REKENING,sum( saldo_trans ) AS mutasi_kredit FROM tabtrans WHERE 
        MY_KODE_TRANS LIKE '1%' AND (tabtrans.tgl_trans > DATE_ADD('$inputantgl', 
        INTERVAL - DAY ( date('$inputantgl')) DAY ) AND tabtrans.tgl_trans <= 
        date('$inputantgl')) GROUP BY tabtrans.NO_REKENING) mutasikredit ON 
        tabung.NO_REKENING = mutasikredit.NO_REKENING) LEFT JOIN (SELECT NO_REKENING, 
        sum( saldo_trans ) AS mutasi_debet FROM tabtrans WHERE MY_KODE_TRANS LIKE 
        '2%' AND (tabtrans.tgl_trans > DATE_ADD('$inputantgl', INTERVAL - DAY ( 
        date('$inputantgl')) DAY) AND tabtrans.tgl_trans <= date('$inputantgl' 
        )) GROUP BY tabtrans.NO_REKENING) mutasidebet ON tabung.NO_REKENING = 
        mutasidebet.NO_REKENING WHERE tabung.STATUS_AKTIF = 2 
        ) a";
        $nominatif=DB::select($sql);
        return view ('reports.rptnominatiftab', 
['nominatif'=>$nominatif,'logos'=>$logos,'users'=>$users,'tgllogin'=>$tgllogin,'sql'=>$sql,'inputantgl'=>$inputantgl]);
    }

    public function exportnominatiftabungan(Request $request)
    {
        // dd($request);
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));

        $sql="SELECT
        a.NO_REKENING,
        a.nasabah_id,
        a.no_id,
        a.nama_nasabah,
        a.alamat,
        a.tempatlahir,
        a.tgllahir,
        a.npwp,
        a.suku_bunga,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) +
        IF
            ( ISNULL( a.saldokreditblnlalu ), 0, a.saldokreditblnlalu ) -
        IF
            ( ISNULL( a.saldodebetblnlalu ), 0, a.saldodebetblnlalu ) 
            ) AS saldo_bln_lalu,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) +
        IF
            ( ISNULL( a.saldokreditblnlalu ), 0, a.saldokreditblnlalu ) -
        IF
            ( ISNULL( a.saldodebetblnlalu ), 0, a.saldodebetblnlalu ) -
        IF
            ( ISNULL( a.bungabln ), 0, a.bungabln ) +
        IF
            ( ISNULL( a.adminbln ), 0, a.adminbln ) 
        ) AS saldo_eff_bln_ini,
    IF
        ( ISNULL( a.mutasi_debet ), 0, a.mutasi_debet ) AS mutasi_debet,
    IF
        ( ISNULL( a.mutasi_kredit ), 0, a.mutasi_kredit ) AS mutasi_kredit,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) -
        IF
            ( ISNULL( a.bungabln ), 0, a.bungabln ) +
        IF
            ( ISNULL( a.adminbln ), 0, a.adminbln ) 
        ) AS saldo_sbl_bunga,
    IF
        ( ISNULL( a.bungabln ), 0, a.bungabln ) AS bunga_bln_ini,
        0 AS pajak_bln_ini,
    IF
        ( ISNULL( a.adminbln ), 0, a.adminbln ) AS admin_bln_ini,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_stl_bunga,
        0 AS kupon,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.SALDO_BLOKIR,
        a.KODE_BI_PEMILIK,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.CAB AS kode_cab,
        a.TGL_REGISTRASI,
        a.JENIS_TABUNGAN,
        a.DESKRIPSI_JENIS_TABUNGAN,
        a.SETORAN_PER_BLN,
        a.TGL_MULAI,
        a.JKW,
        a.TGL_JT,
        a.NISBAH,
        a.KODE_BI_HUBUNGAN 
    FROM
        (
        SELECT
            tabung.NO_REKENING,
            nasabah.nasabah_id,
            nasabah.no_id,
            nasabah.nama_nasabah,
            nasabah.alamat,
            nasabah.tempatlahir,
            nasabah.tgllahir,
            nasabah.npwp,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.SALDO_BLOKIR,
            tabung.KODE_BI_PEMILIK,
            tabung.KODE_GROUP1,
            tabung.KODE_GROUP2,
            tabung.KODE_GROUP3,
            tabung.CAB,
            tabung.TGL_REGISTRASI,
            tabung.JENIS_TABUNGAN,
            kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
            tabung.SETORAN_PER_BLN,
            tabung.TGL_MULAI,
            tabung.JKW,
            tabung.TGL_JT,
            tabung.NISBAH,
            tabung.KODE_BI_HUBUNGAN,
            x.saldokredit,
            y.saldodebet,
            z.adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu,
            u.bungabln 
        FROM ((((((((( tabung INNER JOIN nasabah ON tabung.NASABAH_ID = 
        nasabah.nasabah_id ) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = 
        kodejenistabungan.KODE_JENIS_TABUNGAN) INNER JOIN (SELECT NO_REKENING,sum( 
        saldo_trans ) AS saldokredit FROM tabtrans WHERE MY_KODE_TRANS LIKE '1%' AND 
        tabtrans.tgl_trans <= '$inputantgl' GROUP BY tabtrans.NO_REKENING) x 
        ON tabung.NO_REKENING = x.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,sum( 
        saldo_trans ) AS saldodebet FROM tabtrans WHERE MY_KODE_TRANS LIKE '2%' AND 
        tabtrans.tgl_trans <= '$inputantgl' GROUP BY tabtrans.NO_REKENING) 
        y ON tabung.NO_REKENING = y.NO_REKENING) LEFT JOIN (SELECT 
        tabtrans.tabtrans_id,tabtrans.no_rekening,tabtrans.saldo_trans AS adminbln 
        FROM tabtrans INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING 
        FROM tabtrans WHERE KUITANSI LIKE '%sys-a%' AND TGL_TRANS <='$inputantgl' GROUP BY NO_REKENING ) yy ON tabtrans.TABTRANS_ID = 
        yy.tabid) z ON tabung.NO_REKENING = z.NO_REKENING) LEFT JOIN (SELECT 
        tabtrans.tabtrans_id,tabtrans.no_rekening, tabtrans.saldo_trans AS bungabln 
        FROM tabtrans INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING 
        FROM tabtrans WHERE KUITANSI LIKE '%sys-b%' AND TGL_TRANS <='$inputantgl' GROUP BY NO_REKENING ) xx ON tabtrans.TABTRANS_ID = 
        xx.tabid) u ON tabung.NO_REKENING = u.NO_REKENING) LEFT JOIN (SELECT 
        NO_REKENING,sum( saldo_trans ) AS saldokreditblnlalu FROM tabtrans WHERE 
        MY_KODE_TRANS LIKE '1%' AND tabtrans.tgl_trans <= DATE_ADD('$inputantgl', 
        INTERVAL - DAY ( DATE('$inputantgl')) DAY ) GROUP BY 
        tabtrans.NO_REKENING) sldkrdblnlalu ON tabung.NO_REKENING = 
        sldkrdblnlalu.NO_REKENING) LEFT JOIN (SELECT NO_REKENING,sum( saldo_trans ) 
        AS saldodebetblnlalu FROM tabtrans WHERE MY_KODE_TRANS LIKE '2%' AND 
        tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( 
        '$inputantgl' )) DAY ) GROUP BY tabtrans.NO_REKENING) slddbtblnlalu ON 
        tabung.NO_REKENING = slddbtblnlalu.NO_REKENING) LEFT JOIN (SELECT 
        NO_REKENING,sum( saldo_trans ) AS mutasi_kredit FROM tabtrans WHERE 
        MY_KODE_TRANS LIKE '1%' AND (tabtrans.tgl_trans > DATE_ADD('$inputantgl', 
        INTERVAL - DAY ( date('$inputantgl')) DAY ) AND tabtrans.tgl_trans <= 
        date('$inputantgl')) GROUP BY tabtrans.NO_REKENING) mutasikredit ON 
        tabung.NO_REKENING = mutasikredit.NO_REKENING) LEFT JOIN (SELECT NO_REKENING, 
        sum( saldo_trans ) AS mutasi_debet FROM tabtrans WHERE MY_KODE_TRANS LIKE 
        '2%' AND (tabtrans.tgl_trans > DATE_ADD('$inputantgl', INTERVAL - DAY ( 
        date('$inputantgl')) DAY) AND tabtrans.tgl_trans <= date('$inputantgl' 
        )) GROUP BY tabtrans.NO_REKENING) mutasidebet ON tabung.NO_REKENING = 
        mutasidebet.NO_REKENING WHERE tabung.STATUS_AKTIF = 2 
        ) a";
        $nominatif=DB::select($sql);        
        // dd($nominatif);
        return (new ReporttabunganExport($nominatif))->download('nominatif.xlsx');
    }
}
