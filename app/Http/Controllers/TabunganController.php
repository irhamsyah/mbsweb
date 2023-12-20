<?php

namespace App\Http\Controllers;
use App\Golonganpihaklawan;
use App\KodeGroup1Tabung;
use App\KodeGroup2Tabung;
use App\KodeGroup3Tabung;
use App\Kodejenistabungan;
use App\Kodeketerkaitanlapbul;
use App\Kodemetoda;
use App\Kodecabang;
use App\Kodetranstabungan;
use Illuminate\Http\Request;
use App\Tabungan;
use App\Logo;
use App\Mysysid;
use App\Nasabah;
use App\User;
use App\Tabtran;
use App\Tellertran;
use Illuminate\Support\Facades\DB;
use App\Exports\ReporttabunganExport;
use App\Exports\ReporttabunganrekapExport;
use App\Exports\ReporttabunganexpressExport;
use App\Exports\ReporttabunganpasifExport;
use App\Exports\ReporttransaksitabunganExport;
use App\Exports\ReporttabunganblokirExport;
use App\Exports\ReportbungapajakExport;
use App\Exports\ReporttabunganperjenisExport;

use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function bo_tb_de_tabungan()
    {
        $logos = Logo::all();
        $nasabah=Nasabah::select('nasabah_id','nama_nasabah','alamat')->get();
        $tabungan=DB::select('select tabung.*,kodejenistabungan.deskripsi_jenis_tabungan,nasabah.nama_nasabah,nasabah.alamat,kodegroup1tabung.DESKRIPSI_GROUP1,kodegroup2tabung.DESKRIPSI_GROUP2,kodegroup3tabung.DESKRIPSI_GROUP3,golongan_pihaklawan.deskripsi_golongan,kodemetoda.DESKRIPSI_METODA,kode_keterkaitan_lapbul.DESKRIPSI_SANDI from (((((((tabung inner join nasabah on tabung.nasabah_id=nasabah.nasabah_id) inner join kodejenistabungan on tabung.jenis_tabungan=kodejenistabungan.kode_jenis_tabungan) left join kodegroup1tabung on tabung.KODE_GROUP1=kodegroup1tabung.KODE_GROUP1) left join kodegroup2tabung on tabung.KODE_GROUP2=kodegroup2tabung.KODE_GROUP2) left join kodegroup3tabung on tabung.KODE_GROUP3=kodegroup3tabung.KODE_GROUP3) left join golongan_pihaklawan on tabung.KODE_BI_PEMILIK=golongan_pihaklawan.sandi) left join kodemetoda on tabung.KODE_BI_METODA=kodemetoda.KODE_METODA) left join kode_keterkaitan_lapbul on tabung.KODE_BI_HUBUNGAN=kode_keterkaitan_lapbul.SANDI order by tabung.no_rekening limit 25');
        $users = User::all();
        $kodecabang=Kodecabang::where('DATA_CAB','=','mydata')->get();
        $kodegrou1tabungan = KodeGroup1Tabung::all();
        $kodegrou2tabungan = KodeGroup2Tabung::all();
        $kodegrou3tabungan = KodeGroup3Tabung::all();
        $kodejenistabungan = Kodejenistabungan::select('KODE_JENIS_TABUNGAN','DESKRIPSI_JENIS_TABUNGAN','SUKU_BUNGA_DEFAULT','ADM_PER_BLN_DEFAULT','MINIMUM_DEFAULT','PPH_DEFAULT','SETORAN_MINIMUM_DEFAULT','SETORAN_PER_BLN_DEFAULT','FLAG_RESTRICTED')->get();
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
        $simpantabung->no_alternatif = $request->no_alternatif;
        $simpantabung->status_aktif = 1;
        $simpantabung->cab = $request->cab;
        $simpantabung->nasabah_id = $request->nasabah_id;
        $simpantabung->type_tabungan = $request->type_tabungan;
        $simpantabung->suku_bunga = $request->suku_bunga;
        $simpantabung->persen_pph = $request->persen_pph;
        $simpantabung->tgl_bunga = date('Y-m-d',strtotime($request->tgl_bunga));
        $simpantabung->tgl_registrasi = date('Y-m-d',strtotime($request->tgl_bunga));
        $simpantabung->blokir = 0;
        $simpantabung->jkw = 0;
        $simpantabung->saldo_blokir = 0;
        if(is_null($request->kode_group1)==false)
        {
            $simpantabung->kode_group1 = $request->kode_group1;
        }
        if(is_null($request->kode_group2)==false){
            $simpantabung->kode_group2 = $request->kode_group2;
        }
        if(is_null($request->kode_group3)==false){
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
            $opsi ="nasabah.nama_nasabah like '%".$request->namanasabahcari."%'";
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
        a.no_id AS no_id1,
        a.npwp,
        a.suku_bunga,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) +
        IF
            ( ISNULL( a.saldokreditblnlalu ), 0, a.saldokreditblnlalu ) -
        IF
            ( ISNULL( a.saldodebetblnlalu ), 0, a.saldodebetblnlalu ) 
        ) AS saldo_bln_lalu,
        a.SALDO_EFEKTIF_BLN_INI,
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
            ( ISNULL( a.adminbln ), 0, a.adminbln ) +
        IF
            ( ISNULL( a.pajakblnini ), 0, a.pajakblnini ) 
        ) AS saldo_sbl_bunga,
    IF
        ( ISNULL( a.bungabln ), 0, a.bungabln ) AS bunga_bln_ini,
    IF
        ( ISNULL( a.pajakblnini ), 0, a.pajakblnini ) AS pajak_bln_ini,
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
        a.BLOKIR,
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
            tabung.BLOKIR,
            tabung.SALDO_BLOKIR,
            tabung.SALDO_EFEKTIF_BLN_INI,
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
            tabung.BUNGA_BLN_INI AS bungabln,
            tabung.PAJAK_BLN_INI AS pajakblnini,
            tabung.ADM_BLN_INI AS adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu 
        FROM
            (((((((
                                        tabung
                                        INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
                                        )
                                    INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
                                    )
                                INNER JOIN (
                                SELECT
                                    NO_REKENING,
                                    sum( saldo_trans ) AS saldokredit 
                                FROM
                                    tabtrans 
                                WHERE
                                    MY_KODE_TRANS LIKE '1%' 
                                    AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                GROUP BY
                                    tabtrans.NO_REKENING 
                                ) x ON tabung.NO_REKENING = x.NO_REKENING 
                                )
                            LEFT JOIN (
                            SELECT
                                NO_REKENING,
                                sum( saldo_trans ) AS saldodebet 
                            FROM
                                tabtrans 
                            WHERE
                                MY_KODE_TRANS LIKE '2%' 
                                AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                            GROUP BY
                                tabtrans.NO_REKENING 
                            ) y ON tabung.NO_REKENING = y.NO_REKENING 
                            )
                        LEFT JOIN (
                        SELECT
                            NO_REKENING,
                            sum( saldo_trans ) AS saldokreditblnlalu 
                        FROM
                            tabtrans 
                        WHERE
                            MY_KODE_TRANS LIKE '1%' 
                            AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                        GROUP BY
                            tabtrans.NO_REKENING 
                        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
                        )
                    LEFT JOIN (
                    SELECT
                        NO_REKENING,
                        sum( saldo_trans ) AS saldodebetblnlalu 
                    FROM
                        tabtrans 
                    WHERE
                        MY_KODE_TRANS LIKE '2%' 
                        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    GROUP BY
                        tabtrans.NO_REKENING 
                    ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
                    )
                LEFT JOIN (
                SELECT
                    NO_REKENING,
                    sum( saldo_trans ) AS mutasi_kredit 
                FROM
                    tabtrans 
                WHERE
                    MY_KODE_TRANS LIKE '1%' 
                    AND (
                        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
                GROUP BY
                    tabtrans.NO_REKENING 
                ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
            )
            LEFT JOIN (
            SELECT
                NO_REKENING,
                sum( saldo_trans ) AS mutasi_debet 
            FROM
                tabtrans 
            WHERE
                MY_KODE_TRANS LIKE '2%' 
                AND (
                    tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
            GROUP BY
                tabtrans.NO_REKENING 
            ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        
        WHERE
            tabung.STATUS_AKTIF <> 1 
            AND (
            IF
            ( ISNULL( tabung.SALDO_AWAL ), 0, tabung.SALDO_AWAL ) + x.saldokredit -
        IF
            ( ISNULL( y.saldodebet ), 0, y.saldodebet ) 
        )>0
        ) a";
        $nominatif=DB::select($sql);
        return view ('reports.rptnominatiftab', 
['nominatif'=>$nominatif,'logos'=>$logos,'users'=>$users,'tgllogin'=>$tgllogin,'sql'=>$sql,'inputantgl'=>$inputantgl]);
    }
    // EXPORT NOMINATIF KE EXCEL
    public function exportnominatiftabungan(Request $request)
    {
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));

        $sql="SELECT
        a.NO_REKENING,
        a.nasabah_id,
        a.no_id,
        a.cif,
        a.nama_nasabah,
        a.alamat,
        a.kota_id,
        a.tempatlahir,
        a.tgllahir,
        a.no_id AS no_id1,
        a.npwp,
        a.suku_bunga,(
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) +
        IF
            ( ISNULL( a.saldokreditblnlalu ), 0, a.saldokreditblnlalu ) -
        IF
            ( ISNULL( a.saldodebetblnlalu ), 0, a.saldodebetblnlalu ) 
        ) AS saldo_bln_lalu,
        a.SALDO_EFEKTIF_BLN_INI,
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
            ( ISNULL( a.adminbln ), 0, a.adminbln ) +
        IF
            ( ISNULL( a.pajakblnini ), 0, a.pajakblnini ) 
        ) AS saldo_sbl_bunga,
    IF
        ( ISNULL( a.bungabln ), 0, a.bungabln ) AS bunga_bln_ini,
    IF
        ( ISNULL( a.pajakblnini ), 0, a.pajakblnini ) AS pajak_bln_ini,
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
        a.BLOKIR,
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
            nasabah.cif,
            nasabah.nama_nasabah,
            nasabah.alamat,
            nasabah.kota_id,
            nasabah.tempatlahir,
            nasabah.tgllahir,
            nasabah.npwp,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.BLOKIR,
            tabung.SALDO_BLOKIR,
            tabung.SALDO_EFEKTIF_BLN_INI,
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
            tabung.BUNGA_BLN_INI AS bungabln,
            tabung.PAJAK_BLN_INI AS pajakblnini,
            tabung.ADM_BLN_INI AS adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu 
        FROM
            (((((((
                                        tabung
                                        INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
                                        )
                                    INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
                                    )
                                INNER JOIN (
                                SELECT
                                    NO_REKENING,
                                    sum( saldo_trans ) AS saldokredit 
                                FROM
                                    tabtrans 
                                WHERE
                                    MY_KODE_TRANS LIKE '1%' 
                                    AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                GROUP BY
                                    tabtrans.NO_REKENING 
                                ) x ON tabung.NO_REKENING = x.NO_REKENING 
                                )
                            LEFT JOIN (
                            SELECT
                                NO_REKENING,
                                sum( saldo_trans ) AS saldodebet 
                            FROM
                                tabtrans 
                            WHERE
                                MY_KODE_TRANS LIKE '2%' 
                                AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                            GROUP BY
                                tabtrans.NO_REKENING 
                            ) y ON tabung.NO_REKENING = y.NO_REKENING 
                            )
                        LEFT JOIN (
                        SELECT
                            NO_REKENING,
                            sum( saldo_trans ) AS saldokreditblnlalu 
                        FROM
                            tabtrans 
                        WHERE
                            MY_KODE_TRANS LIKE '1%' 
                            AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                        GROUP BY
                            tabtrans.NO_REKENING 
                        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
                        )
                    LEFT JOIN (
                    SELECT
                        NO_REKENING,
                        sum( saldo_trans ) AS saldodebetblnlalu 
                    FROM
                        tabtrans 
                    WHERE
                        MY_KODE_TRANS LIKE '2%' 
                        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    GROUP BY
                        tabtrans.NO_REKENING 
                    ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
                    )
                LEFT JOIN (
                SELECT
                    NO_REKENING,
                    sum( saldo_trans ) AS mutasi_kredit 
                FROM
                    tabtrans 
                WHERE
                    MY_KODE_TRANS LIKE '1%' 
                    AND (
                        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
                GROUP BY
                    tabtrans.NO_REKENING 
                ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
            )
            LEFT JOIN (
            SELECT
                NO_REKENING,
                sum( saldo_trans ) AS mutasi_debet 
            FROM
                tabtrans 
            WHERE
                MY_KODE_TRANS LIKE '2%' 
                AND (
                    tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
            GROUP BY
                tabtrans.NO_REKENING 
            ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        
        WHERE
            tabung.STATUS_AKTIF <> 1 
            AND (
            IF
            ( ISNULL( tabung.SALDO_AWAL ), 0, tabung.SALDO_AWAL ) + x.saldokredit -
        IF
            ( ISNULL( y.saldodebet ), 0, y.saldodebet ) 
        )>0
        ) a";
        $nominatif=DB::select($sql);        
        return (new ReporttabunganExport($nominatif))->download('nominatif.xlsx');
    }
    public function bo_tb_rpt_pdfnominatif(Request $request)
    {
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_TAB'.'%'.'NAMA')->get();
        $sql="SELECT
        a.NO_REKENING,
        a.nama_nasabah,
        a.alamat,
        (
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) +
        IF
        ( ISNULL( a.saldokreditblnlalu ), 0, a.saldokreditblnlalu ) -
        IF
        ( ISNULL( a.saldodebetblnlalu ), 0, a.saldodebetblnlalu ) 
        ) AS saldo_bln_lalu,
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
        ( ISNULL( a.adminbln ), 0, a.adminbln ) +
        IF
        ( ISNULL( a.pajakblnini ), 0, a.pajakblnini ) 
        ) AS saldo_sbl_bunga,
        IF
        ( ISNULL( a.bungabln ), 0, a.bungabln ) AS bunga_bln_ini,
        IF
        ( ISNULL( a.pajakblnini ), 0, a.pajakblnini ) AS pajak_bln_ini,
        IF
        ( ISNULL( a.adminbln ), 0, a.adminbln ) AS admin_bln_ini,
        (
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
        ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif
        FROM
        (
        SELECT
        tabung.NO_REKENING,
        nasabah.nama_nasabah,
        nasabah.alamat,
        tabung.SALDO_AWAL,
        tabung.BLOKIR,
        tabung.SALDO_BLOKIR,
        tabung.SALDO_EFEKTIF_BLN_INI,
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
        tabung.BUNGA_BLN_INI AS bungabln,
        tabung.PAJAK_BLN_INI AS pajakblnini,
        tabung.ADM_BLN_INI AS adminbln,
        mutasikredit.mutasi_kredit,
        mutasidebet.mutasi_debet,
        sldkrdblnlalu.saldokreditblnlalu,
        slddbtblnlalu.saldodebetblnlalu 
        FROM
        (((((((
        tabung
        INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
        )
        INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
        )
        INNER JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) x ON tabung.NO_REKENING = x.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) y ON tabung.NO_REKENING = y.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokreditblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebetblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_kredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_debet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF <> 1 
        AND (
        IF
        ( ISNULL( tabung.SALDO_AWAL ), 0, tabung.SALDO_AWAL ) + x.saldokredit -
        IF
        ( ISNULL( y.saldodebet ), 0, y.saldodebet ) 
        )>0
        ) a";
        $count=DB::select('select count(*) as aggregate from('.$sql.') aa');
        $count=$count[0]->aggregate;
        // dd($count);
        $nominatif=DB::select($sql);
        return view('pdf.cetaknominatif',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd]);         
    }

    public function bo_tb_rpt_nominatifrekap()
    {
        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        return view('reports.frmsearchnomrekap',['users'=>$users,'logos'=>$logos]);
    }
    public function bo_tb_rpt_nominatifrekapview(Request $request)
    {
        $this->validate($request,
        ['rekap'=>'required','tgl_nominatif'=>'required']);
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        $logos = Logo::all();
        $users = User::all();
        // $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $rekap=$request->rekap;
        $query="";
        if($rekap=='JENIS_TABUNGAN')
        {
            $query="a.JENIS_TABUNGAN as kode,a.DESKRIPSI_JENIS_TABUNGAN as deskripsi,";
        }elseif($rekap=='KODE_GROUP1')
        {
            $query="a.KODE_GROUP1 as kode,a.DESKRIPSI_GROUP1 as deskripsi,";
        }elseif($rekap=='KODE_GROUP2')
        {
            $query="a.KODE_GROUP2 as kode,a.DESKRIPSI_GROUP2 as deskripsi,";
        }else{
            $query="a.KODE_GROUP3 as kode,a.DESKRIPSI_GROUP3 as deskripsi,";
        }
        $sql="SELECT ".$query.
        "a.NO_REKENING,
        a.nama_nasabah,
        (
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
        ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.KODE_BI_PEMILIK as kode_bi_pemilik,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.TGL_REGISTRASI as tgl_registrasi,
        a.DESKRIPSI_JENIS_TABUNGAN as jenis_tabungan,
        a.SUKU_BUNGA as suku_bunga
        FROM
        (
        SELECT
        tabung.NO_REKENING,
        nasabah.nama_nasabah,
        tabung.suku_bunga,
        tabung.SALDO_AWAL,
        tabung.KODE_BI_PEMILIK,
        tabung.KODE_GROUP1,
        kodegroup1tabung.DESKRIPSI_GROUP1,
        tabung.KODE_GROUP2,
        kodegroup2tabung.DESKRIPSI_GROUP2,
        tabung.KODE_GROUP3,
        kodegroup3tabung.DESKRIPSI_GROUP3,
        tabung.TGL_REGISTRASI,
        tabung.JENIS_TABUNGAN,
        kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
        x.saldokredit,
        y.saldodebet,
        tabung.BUNGA_BLN_INI AS bungabln,
        tabung.PAJAK_BLN_INI AS pajakblnini,
        tabung.ADM_BLN_INI AS adminbln,
        mutasikredit.mutasi_kredit,
        mutasidebet.mutasi_debet,
        sldkrdblnlalu.saldokreditblnlalu,
        slddbtblnlalu.saldodebetblnlalu 
        FROM
        ((((((((((
        tabung
        INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
        )
        INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
        )
        INNER JOIN kodegroup1tabung ON tabung.KODE_GROUP1=kodegroup1tabung.KODE_GROUP1
        )
        INNER JOIN kodegroup2tabung ON tabung.KODE_GROUP2=kodegroup2tabung.KODE_GROUP2
        )
        INNER JOIN kodegroup3tabung ON tabung.KODE_GROUP3=kodegroup3tabung.KODE_GROUP3
        )
        INNER JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) x ON tabung.NO_REKENING = x.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) y ON tabung.NO_REKENING = y.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokreditblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebetblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_kredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_debet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF <> 1 
        AND (
        IF
        ( ISNULL( tabung.SALDO_AWAL ), 0, tabung.SALDO_AWAL ) + x.saldokredit -
        IF
        ( ISNULL( y.saldodebet ), 0, y.saldodebet ) 
        )>0
        ) a";
        $nominatif=DB::select($sql);
        return view('reports.rptnominatifrekaptab',['nominatif'=>$nominatif,'inputantgl'=>$inputantgl,'logos'=>$logos,'users'=>$users,'rekap'=>$rekap]);
    }
    public function exportnominatiftabunganrekap(Request $request) 
    {
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        $rekap=$request->rekap;
        $query="";
        if($rekap=='JENIS_TABUNGAN')
        {
            $query="a.JENIS_TABUNGAN as kode,a.DESKRIPSI_JENIS_TABUNGAN as deskripsi,";
        }elseif($rekap=='KODE_GROUP1')
        {
            $query="a.KODE_GROUP1 as kode,a.DESKRIPSI_GROUP1 as deskripsi,";
        }elseif($rekap=='KODE_GROUP2')
        {
            $query="a.KODE_GROUP2 as kode,a.DESKRIPSI_GROUP2 as deskripsi,";
        }else{
            $query="a.KODE_GROUP3 as kode,a.DESKRIPSI_GROUP3 as deskripsi,";
        }
        $sql="SELECT ".$query.
        "a.NO_REKENING,
        a.nama_nasabah,
        (
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
        ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.KODE_BI_PEMILIK as kode_bi_pemilik,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.TGL_REGISTRASI as tgl_registrasi,
        a.DESKRIPSI_JENIS_TABUNGAN as jenis_tabungan,
        a.SUKU_BUNGA as suku_bunga
        FROM
        (
        SELECT
        tabung.NO_REKENING,
        nasabah.nama_nasabah,
        tabung.suku_bunga,
        tabung.SALDO_AWAL,
        tabung.KODE_BI_PEMILIK,
        tabung.KODE_GROUP1,
        kodegroup1tabung.DESKRIPSI_GROUP1,
        tabung.KODE_GROUP2,
        kodegroup2tabung.DESKRIPSI_GROUP2,
        tabung.KODE_GROUP3,
        kodegroup3tabung.DESKRIPSI_GROUP3,
        tabung.TGL_REGISTRASI,
        tabung.JENIS_TABUNGAN,
        kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
        x.saldokredit,
        y.saldodebet,
        tabung.BUNGA_BLN_INI AS bungabln,
        tabung.PAJAK_BLN_INI AS pajakblnini,
        tabung.ADM_BLN_INI AS adminbln,
        mutasikredit.mutasi_kredit,
        mutasidebet.mutasi_debet,
        sldkrdblnlalu.saldokreditblnlalu,
        slddbtblnlalu.saldodebetblnlalu 
        FROM
        ((((((((((
        tabung
        INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
        )
        INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
        )
        INNER JOIN kodegroup1tabung ON tabung.KODE_GROUP1=kodegroup1tabung.KODE_GROUP1
        )
        INNER JOIN kodegroup2tabung ON tabung.KODE_GROUP2=kodegroup2tabung.KODE_GROUP2
        )
        INNER JOIN kodegroup3tabung ON tabung.KODE_GROUP3=kodegroup3tabung.KODE_GROUP3
        )
        INNER JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) x ON tabung.NO_REKENING = x.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) y ON tabung.NO_REKENING = y.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokreditblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebetblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_kredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_debet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF <> 1 
        AND (
        IF
        ( ISNULL( tabung.SALDO_AWAL ), 0, tabung.SALDO_AWAL ) + x.saldokredit -
        IF
        ( ISNULL( y.saldodebet ), 0, y.saldodebet ) 
        )>0
        ) a";
        $nominatif=DB::select($sql);
        return (new ReporttabunganrekapExport($nominatif))->download('nominatifrekap.xlsx');
    }

    public function bo_tb_rpt_pdfnominatifrekap(Request $request)
    {   
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        $rekap=$request->rekap;
        $query="";
        $groupby="";
        if($rekap=='JENIS_TABUNGAN')
        {
            $query="a.JENIS_TABUNGAN as kode,a.DESKRIPSI_JENIS_TABUNGAN as deskripsi,count(*) as aggregate,";
            $groupby="a.JENIS_TABUNGAN,a.DESKRIPSI_JENIS_TABUNGAN";
        }elseif($rekap=='KODE_GROUP1')
        {
            $query="a.KODE_GROUP1 as kode,a.DESKRIPSI_GROUP1 as deskripsi,count(*) as aggregate,";
            $groupby="a.KODE_GROUP1,a.DESKRIPSI_GROUP1";
        }elseif($rekap=='KODE_GROUP2')
        {
            $query="a.KODE_GROUP2 as kode,a.DESKRIPSI_GROUP2 as deskripsi,count(*) as aggregate,";
            $groupby="a.KODE_GROUP2,a.DESKRIPSI_GROUP2";
        }else{
            $query="a.KODE_GROUP3 as kode,a.DESKRIPSI_GROUP3 as deskripsi,count(*) as aggregate,";
            $groupby="a.KODE_GROUP3,a.DESKRIPSI_GROUP3";
        }
        $sql="SELECT ".$query.
        " SUM(
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
        ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        '100%' as persennisbah,
        '100%' as persensaldo
        FROM
        (
        SELECT
        tabung.NO_REKENING,
        nasabah.nama_nasabah,
        tabung.suku_bunga,
        tabung.SALDO_AWAL,
        tabung.KODE_BI_PEMILIK,
        tabung.KODE_GROUP1,
        kodegroup1tabung.DESKRIPSI_GROUP1,
        tabung.KODE_GROUP2,
        kodegroup2tabung.DESKRIPSI_GROUP2,
        tabung.KODE_GROUP3,
        kodegroup3tabung.DESKRIPSI_GROUP3,
        tabung.TGL_REGISTRASI,
        tabung.JENIS_TABUNGAN,
        kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
        x.saldokredit,
        y.saldodebet,
        tabung.BUNGA_BLN_INI AS bungabln,
        tabung.PAJAK_BLN_INI AS pajakblnini,
        tabung.ADM_BLN_INI AS adminbln,
        mutasikredit.mutasi_kredit,
        mutasidebet.mutasi_debet,
        sldkrdblnlalu.saldokreditblnlalu,
        slddbtblnlalu.saldodebetblnlalu 
        FROM
        ((((((((((
        tabung
        INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
        )
        INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
        )
        INNER JOIN kodegroup1tabung ON tabung.KODE_GROUP1=kodegroup1tabung.KODE_GROUP1
        )
        INNER JOIN kodegroup2tabung ON tabung.KODE_GROUP2=kodegroup2tabung.KODE_GROUP2
        )
        INNER JOIN kodegroup3tabung ON tabung.KODE_GROUP3=kodegroup3tabung.KODE_GROUP3
        )
        INNER JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) x ON tabung.NO_REKENING = x.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) y ON tabung.NO_REKENING = y.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokreditblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebetblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_kredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_debet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF <> 1 
        AND (
        IF
        ( ISNULL( tabung.SALDO_AWAL ), 0, tabung.SALDO_AWAL ) + x.saldokredit -
        IF
        ( ISNULL( y.saldodebet ), 0, y.saldodebet ) 
        )>0
        ) a GROUP BY ".$groupby;
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_KOTA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_TAB'.'%'.'NAMA')->get();
        $nominatif=DB::select($sql);
        return view('pdf.cetaknominatifrekap',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'kota'=>$kota,'ttd'=>$ttd,'inputantgl'=>$inputantgl]);
    }

    public function bo_tb_rpt_nominatifexpress()
    {
        $logos = Logo::all();
        $users = User::all();
        // $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        return view('reports.frmsearchnomexpress',['users'=>$users,'logos'=>$logos]);
    }

    public function bo_tb_rpt_nominatifexpressview(Request $request)
    {
        $this->validate($request,[
            'tgl_nominatif'=>'required'
        ]);

        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        $sql="SELECT
        a.nasabah_id,
        a.NO_REKENING,
        a.nama_nasabah,
        a.alamat,
        a.AKAD as akad,
        a.NISBAH as nisbah,
        (
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.TGL_MULAI,
        a.JKW,
        a.TGL_JT,
        a.tgl_akhir_trans,
        a.suku_bunga,
        a.KODE_BI_PEMILIK,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.TGL_REGISTRASI,
        a.JENIS_TABUNGAN,
        a.KODE_BI_HUBUNGAN
    FROM
        (
        SELECT
            tabung.NO_REKENING,
            nasabah.nasabah_id,
            nasabah.nama_nasabah,
            nasabah.alamat,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.KODE_BI_PEMILIK,
            tabung.KODE_GROUP1,
            tabung.KODE_GROUP2,
            tabung.KODE_GROUP3,
            tabung.TGL_REGISTRASI,
            tabung.JENIS_TABUNGAN,
            kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
            tabung.TGL_MULAI,
            tabung.JKW,
            tabung.TGL_JT,
            tabung.AKAD,
            tabung.NISBAH,
            tabung.KODE_BI_HUBUNGAN,
            x.saldokredit,
            y.saldodebet,
            z.adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu,
            u.bungabln,
            tglakhirtrans.tgl_akhir_trans
        FROM
            ((((((((((
                                                tabung
                                                INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
                                                )
                                            INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
                                            )
                                        INNER JOIN (
                                        SELECT
                                            NO_REKENING,
                                            sum( saldo_trans ) AS saldokredit 
                                        FROM
                                            tabtrans 
                                        WHERE
                                            MY_KODE_TRANS LIKE '1%' 
                                            AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                        GROUP BY
                                            tabtrans.NO_REKENING 
                                        ) x ON tabung.NO_REKENING = x.NO_REKENING 
                                        )
                                    LEFT JOIN (
                                    SELECT
                                        NO_REKENING,
                                        sum( saldo_trans ) AS saldodebet 
                                    FROM
                                        tabtrans 
                                    WHERE
                                        MY_KODE_TRANS LIKE '2%' 
                                        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                    GROUP BY
                                        tabtrans.NO_REKENING 
                                    ) y ON tabung.NO_REKENING = y.NO_REKENING 
                                    )
                                LEFT JOIN (
                                SELECT
                                    tabtrans.tabtrans_id,
                                    tabtrans.no_rekening,
                                    tabtrans.saldo_trans AS adminbln 
                                FROM
                                    tabtrans
                                    INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-a%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) yy ON tabtrans.TABTRANS_ID = yy.tabid 
                                ) z ON tabung.NO_REKENING = z.NO_REKENING 
                                )
                            LEFT JOIN (
                            SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.saldo_trans AS bungabln 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-b%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) xx ON tabtrans.TABTRANS_ID = xx.tabid 
                            ) u ON tabung.NO_REKENING = u.NO_REKENING 
                            )
                        LEFT JOIN (
                        SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.TGL_TRANS AS tgl_akhir_trans 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) vv ON tabtrans.TABTRANS_ID = vv.tabid
                        ) tglakhirtrans ON tabung.NO_REKENING = tglakhirtrans.NO_REKENING
                        )
                        LEFT JOIN
                         (
                        SELECT
                            NO_REKENING,
                            sum( saldo_trans ) AS saldokreditblnlalu 
                        FROM
                            tabtrans 
                        WHERE
                            MY_KODE_TRANS LIKE '1%' 
                            AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                        GROUP BY
                            tabtrans.NO_REKENING 
                        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
                        )
                    LEFT JOIN (
                    SELECT
                        NO_REKENING,
                        sum( saldo_trans ) AS saldodebetblnlalu 
                    FROM
                        tabtrans 
                    WHERE
                        MY_KODE_TRANS LIKE '2%' 
                        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    GROUP BY
                        tabtrans.NO_REKENING 
                    ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
                    )
                LEFT JOIN (
                SELECT
                    NO_REKENING,
                    sum( saldo_trans ) AS mutasi_kredit 
                FROM
                    tabtrans 
                WHERE
                    MY_KODE_TRANS LIKE '1%' 
                    AND (
                        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
                GROUP BY
                    tabtrans.NO_REKENING 
                ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
            )
            LEFT JOIN (
            SELECT
                NO_REKENING,
                sum( saldo_trans ) AS mutasi_debet 
            FROM
                tabtrans 
            WHERE
                MY_KODE_TRANS LIKE '2%' 
                AND (
                    tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
            GROUP BY
                tabtrans.NO_REKENING 
            ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF = 2 
        ) a";
        $nominatif=DB::select($sql);
        return view('reports.rptnominatifexpresstab',['nominatif'=>$nominatif,'logos'=>$logos,'users'=>$users,'inputantgl'=>$inputantgl]);
    }
    public function nominatifexpresseksport($id)
    {
        $inputantgl=$id;
        $sql="SELECT
        a.nasabah_id,
        a.NO_REKENING,
        a.nama_nasabah,
        a.alamat,
        a.AKAD as akad,
        a.NISBAH as nisbah,
        (
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.TGL_MULAI,
        a.JKW,
        a.TGL_JT,
        a.tgl_akhir_trans,
        a.suku_bunga,
        a.KODE_BI_PEMILIK,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.TGL_REGISTRASI,
        a.JENIS_TABUNGAN,
        a.KODE_BI_HUBUNGAN
    FROM
        (
        SELECT
            tabung.NO_REKENING,
            nasabah.nasabah_id,
            nasabah.nama_nasabah,
            nasabah.alamat,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.KODE_BI_PEMILIK,
            tabung.KODE_GROUP1,
            tabung.KODE_GROUP2,
            tabung.KODE_GROUP3,
            tabung.TGL_REGISTRASI,
            tabung.JENIS_TABUNGAN,
            kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
            tabung.TGL_MULAI,
            tabung.JKW,
            tabung.TGL_JT,
            tabung.AKAD,
            tabung.NISBAH,
            tabung.KODE_BI_HUBUNGAN,
            x.saldokredit,
            y.saldodebet,
            z.adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu,
            u.bungabln,
            tglakhirtrans.tgl_akhir_trans
        FROM
            ((((((((((
                                                tabung
                                                INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
                                                )
                                            INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
                                            )
                                        INNER JOIN (
                                        SELECT
                                            NO_REKENING,
                                            sum( saldo_trans ) AS saldokredit 
                                        FROM
                                            tabtrans 
                                        WHERE
                                            MY_KODE_TRANS LIKE '1%' 
                                            AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                        GROUP BY
                                            tabtrans.NO_REKENING 
                                        ) x ON tabung.NO_REKENING = x.NO_REKENING 
                                        )
                                    LEFT JOIN (
                                    SELECT
                                        NO_REKENING,
                                        sum( saldo_trans ) AS saldodebet 
                                    FROM
                                        tabtrans 
                                    WHERE
                                        MY_KODE_TRANS LIKE '2%' 
                                        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                    GROUP BY
                                        tabtrans.NO_REKENING 
                                    ) y ON tabung.NO_REKENING = y.NO_REKENING 
                                    )
                                LEFT JOIN (
                                SELECT
                                    tabtrans.tabtrans_id,
                                    tabtrans.no_rekening,
                                    tabtrans.saldo_trans AS adminbln 
                                FROM
                                    tabtrans
                                    INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-a%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) yy ON tabtrans.TABTRANS_ID = yy.tabid 
                                ) z ON tabung.NO_REKENING = z.NO_REKENING 
                                )
                            LEFT JOIN (
                            SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.saldo_trans AS bungabln 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-b%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) xx ON tabtrans.TABTRANS_ID = xx.tabid 
                            ) u ON tabung.NO_REKENING = u.NO_REKENING 
                            )
                        LEFT JOIN (
                        SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.TGL_TRANS AS tgl_akhir_trans 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) vv ON tabtrans.TABTRANS_ID = vv.tabid
                        ) tglakhirtrans ON tabung.NO_REKENING = tglakhirtrans.NO_REKENING
                        )
                        LEFT JOIN
                         (
                        SELECT
                            NO_REKENING,
                            sum( saldo_trans ) AS saldokreditblnlalu 
                        FROM
                            tabtrans 
                        WHERE
                            MY_KODE_TRANS LIKE '1%' 
                            AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                        GROUP BY
                            tabtrans.NO_REKENING 
                        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
                        )
                    LEFT JOIN (
                    SELECT
                        NO_REKENING,
                        sum( saldo_trans ) AS saldodebetblnlalu 
                    FROM
                        tabtrans 
                    WHERE
                        MY_KODE_TRANS LIKE '2%' 
                        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    GROUP BY
                        tabtrans.NO_REKENING 
                    ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
                    )
                LEFT JOIN (
                SELECT
                    NO_REKENING,
                    sum( saldo_trans ) AS mutasi_kredit 
                FROM
                    tabtrans 
                WHERE
                    MY_KODE_TRANS LIKE '1%' 
                    AND (
                        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
                GROUP BY
                    tabtrans.NO_REKENING 
                ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
            )
            LEFT JOIN (
            SELECT
                NO_REKENING,
                sum( saldo_trans ) AS mutasi_debet 
            FROM
                tabtrans 
            WHERE
                MY_KODE_TRANS LIKE '2%' 
                AND (
                    tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
            GROUP BY
                tabtrans.NO_REKENING 
            ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF = 2 
        ) a";
            $nominatif=DB::select($sql);
            return (new ReporttabunganexpressExport($nominatif))->download('nominatifexpress.xlsx');
    }

    public function bo_tb_rpt_pdfnominatifexpress(Request $request)
    {   
        $inputantgl=$request->tgl_nominatif;
        $sql="SELECT
        a.nasabah_id,
        a.NO_REKENING,
        a.nama_nasabah,
        a.alamat,
        a.AKAD as akad,
        a.NISBAH as nisbah,
        (
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.TGL_MULAI,
        a.JKW,
        a.TGL_JT,
        a.tgl_akhir_trans,
        a.suku_bunga,
        a.KODE_BI_PEMILIK,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.TGL_REGISTRASI,
        a.JENIS_TABUNGAN,
        a.KODE_BI_HUBUNGAN
    FROM
        (
        SELECT
            tabung.NO_REKENING,
            nasabah.nasabah_id,
            nasabah.nama_nasabah,
            nasabah.alamat,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.KODE_BI_PEMILIK,
            tabung.KODE_GROUP1,
            tabung.KODE_GROUP2,
            tabung.KODE_GROUP3,
            tabung.TGL_REGISTRASI,
            tabung.JENIS_TABUNGAN,
            kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
            tabung.TGL_MULAI,
            tabung.JKW,
            tabung.TGL_JT,
            tabung.AKAD,
            tabung.NISBAH,
            tabung.KODE_BI_HUBUNGAN,
            x.saldokredit,
            y.saldodebet,
            z.adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu,
            u.bungabln,
            tglakhirtrans.tgl_akhir_trans
        FROM
            ((((((((((
                                                tabung
                                                INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
                                                )
                                            INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
                                            )
                                        INNER JOIN (
                                        SELECT
                                            NO_REKENING,
                                            sum( saldo_trans ) AS saldokredit 
                                        FROM
                                            tabtrans 
                                        WHERE
                                            MY_KODE_TRANS LIKE '1%' 
                                            AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                        GROUP BY
                                            tabtrans.NO_REKENING 
                                        ) x ON tabung.NO_REKENING = x.NO_REKENING 
                                        )
                                    LEFT JOIN (
                                    SELECT
                                        NO_REKENING,
                                        sum( saldo_trans ) AS saldodebet 
                                    FROM
                                        tabtrans 
                                    WHERE
                                        MY_KODE_TRANS LIKE '2%' 
                                        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                    GROUP BY
                                        tabtrans.NO_REKENING 
                                    ) y ON tabung.NO_REKENING = y.NO_REKENING 
                                    )
                                LEFT JOIN (
                                SELECT
                                    tabtrans.tabtrans_id,
                                    tabtrans.no_rekening,
                                    tabtrans.saldo_trans AS adminbln 
                                FROM
                                    tabtrans
                                    INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-a%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) yy ON tabtrans.TABTRANS_ID = yy.tabid 
                                ) z ON tabung.NO_REKENING = z.NO_REKENING 
                                )
                            LEFT JOIN (
                            SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.saldo_trans AS bungabln 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-b%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) xx ON tabtrans.TABTRANS_ID = xx.tabid 
                            ) u ON tabung.NO_REKENING = u.NO_REKENING 
                            )
                        LEFT JOIN (
                        SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.TGL_TRANS AS tgl_akhir_trans 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) vv ON tabtrans.TABTRANS_ID = vv.tabid
                        ) tglakhirtrans ON tabung.NO_REKENING = tglakhirtrans.NO_REKENING
                        )
                        LEFT JOIN
                         (
                        SELECT
                            NO_REKENING,
                            sum( saldo_trans ) AS saldokreditblnlalu 
                        FROM
                            tabtrans 
                        WHERE
                            MY_KODE_TRANS LIKE '1%' 
                            AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                        GROUP BY
                            tabtrans.NO_REKENING 
                        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
                        )
                    LEFT JOIN (
                    SELECT
                        NO_REKENING,
                        sum( saldo_trans ) AS saldodebetblnlalu 
                    FROM
                        tabtrans 
                    WHERE
                        MY_KODE_TRANS LIKE '2%' 
                        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    GROUP BY
                        tabtrans.NO_REKENING 
                    ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
                    )
                LEFT JOIN (
                SELECT
                    NO_REKENING,
                    sum( saldo_trans ) AS mutasi_kredit 
                FROM
                    tabtrans 
                WHERE
                    MY_KODE_TRANS LIKE '1%' 
                    AND (
                        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
                GROUP BY
                    tabtrans.NO_REKENING 
                ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
            )
            LEFT JOIN (
            SELECT
                NO_REKENING,
                sum( saldo_trans ) AS mutasi_debet 
            FROM
                tabtrans 
            WHERE
                MY_KODE_TRANS LIKE '2%' 
                AND (
                    tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
            GROUP BY
                tabtrans.NO_REKENING 
            ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF = 2 
        ) a";
            $nominatif=DB::select($sql);
            $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
            $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_TAB'.'%'.'NAMA')->get();
            $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_KOTA'.'%')->get();
            return view('pdf.cetaknominatifexpress',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'kota'=>$kota,'ttd'=>$ttd,'inputantgl'=>$inputantgl]);
    }

    public function bo_tb_de_frmhapustransaksi(Request $request)
    {
        $logos = Logo::all();

        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tabtran = Tabtran::with('nasabah')->where('TGL_TRANS','=',date('Y-m-d',strtotime(substr($tgllogin[0]->Value,3,2).'/'.substr($tgllogin[0]->Value,0,2).'/'.substr($tgllogin[0]->Value,6,4))))->get();
        for($i=0;$i<count($tabtran);$i++)
        {
            //UPDATE NO_REKENING yang terdapat SPASI di table TABUNG
            if(count($tabtran[$i]->nasabah)==0)
            {
                DB::select('update tabung set NO_REKENING=REPLACE(NO_REKENING," ","") where NO_REKENING='."'".$tabtran[$i]->NO_REKENING."'");
            }
        }
        $tabtran = Tabtran::with('nasabah')->where('TGL_TRANS','=',date('Y-m-d',strtotime(substr($tgllogin[0]->Value,3,2).'/'.substr($tgllogin[0]->Value,0,2).'/'.substr($tgllogin[0]->Value,6,4))))->get();

        return view('admin.tabungan.frmhapustransaksitabungan',['logos'=>$logos,'tgllogin'=>$tgllogin,'tabtran'=>$tabtran]);
    }

    public function bo_tab_del_trs(Request $request)
    {
        $deltabtrans=Tabtran::where(
            [
                'KUITANSI'=>$request->no_bukti,
                'NO_REKENING'=>$request->no_rekening
            ])->delete();
        $deltellertrans=Tellertran::where(
            [
                'NO_BUKTI'=>$request->no_bukti,
            ])->delete();
        return redirect()->route('bo_tb_de_frmhapustransaksi')->with('message','Transaksi dengan Kuitansi : '.$request->no_bukti.' berhasil di hapus');
    }
    public function bo_tabungan_transaksi_cari(Request $request)
    {
        $logos = Logo::all();
        $tgl=date('Y-m-d',strtotime($request->tgl_trans));
        $tabtran = Tabtran::with('nasabah')->where('TGL_TRANS','=',date('Y-m-d',strtotime($tgl)))->get();
        // dd($tabtran);
        return view('admin.tabungan.frmhapustransaksitabungan',['logos'=>$logos,'tgllogin'=>$tgl,'tabtran'=>$tabtran]);
    }
    public function bo_tb_rpt_nominatifpasif()
    {
        $logos = Logo::all();
        $users = User::all();
        return view('reports.frmsearchnompasif',['users'=>$users,'logos'=>$logos]);
    }

    public function bo_tb_rpt_nominatifpasifview(Request $request)
    {
        $this->validate($request,[
            'tgl_nominatif'=>'required'
        ]);

        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        // menghitung tanggal 6 Bulan kebelakang
        $inputantgl6bln = date('Y-m-d', strtotime("-6 months", strtotime($request->tgl_nominatif)));
        
        $sql="SELECT
        a.nasabah_id,
        a.NO_REKENING,
        a.nama_nasabah,
        a.alamat,
        a.AKAD as akad,
        a.NISBAH as nisbah,
        (
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.TGL_MULAI,
        a.JKW,
        a.TGL_JT,
        a.tgl_akhir_trans,
        a.suku_bunga,
        a.KODE_BI_PEMILIK,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.TGL_REGISTRASI,
        a.JENIS_TABUNGAN,
        a.KODE_BI_HUBUNGAN
    FROM
        (
        SELECT
            tabung.NO_REKENING,
            nasabah.nasabah_id,
            nasabah.nama_nasabah,
            nasabah.alamat,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.KODE_BI_PEMILIK,
            tabung.KODE_GROUP1,
            tabung.KODE_GROUP2,
            tabung.KODE_GROUP3,
            tabung.TGL_REGISTRASI,
            tabung.JENIS_TABUNGAN,
            kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
            tabung.TGL_MULAI,
            tabung.JKW,
            tabung.TGL_JT,
            tabung.AKAD,
            tabung.NISBAH,
            tabung.KODE_BI_HUBUNGAN,
            x.saldokredit,
            y.saldodebet,
            z.adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu,
            u.bungabln,
            tglakhirtrans.tgl_akhir_trans
        FROM
            ((((((((((
                                                tabung
                                                INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
                                                )
                                            INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
                                            )
                                        INNER JOIN (
                                        SELECT
                                            NO_REKENING,
                                            sum( saldo_trans ) AS saldokredit 
                                        FROM
                                            tabtrans 
                                        WHERE
                                            MY_KODE_TRANS LIKE '1%' 
                                            AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                        GROUP BY
                                            tabtrans.NO_REKENING 
                                        ) x ON tabung.NO_REKENING = x.NO_REKENING 
                                        )
                                    LEFT JOIN (
                                    SELECT
                                        NO_REKENING,
                                        sum( saldo_trans ) AS saldodebet 
                                    FROM
                                        tabtrans 
                                    WHERE
                                        MY_KODE_TRANS LIKE '2%' 
                                        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                    GROUP BY
                                        tabtrans.NO_REKENING 
                                    ) y ON tabung.NO_REKENING = y.NO_REKENING 
                                    )
                                LEFT JOIN (
                                SELECT
                                    tabtrans.tabtrans_id,
                                    tabtrans.no_rekening,
                                    tabtrans.saldo_trans AS adminbln 
                                FROM
                                    tabtrans
                                    INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-a%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) yy ON tabtrans.TABTRANS_ID = yy.tabid 
                                ) z ON tabung.NO_REKENING = z.NO_REKENING 
                                )
                            LEFT JOIN (
                            SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.saldo_trans AS bungabln 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-b%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) xx ON tabtrans.TABTRANS_ID = xx.tabid 
                            ) u ON tabung.NO_REKENING = u.NO_REKENING 
                            )
                        LEFT JOIN (
                        SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.TGL_TRANS AS tgl_akhir_trans 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) vv ON tabtrans.TABTRANS_ID = vv.tabid
                        ) tglakhirtrans ON tabung.NO_REKENING = tglakhirtrans.NO_REKENING
                        )
                        LEFT JOIN
                         (
                        SELECT
                            NO_REKENING,
                            sum( saldo_trans ) AS saldokreditblnlalu 
                        FROM
                            tabtrans 
                        WHERE
                            MY_KODE_TRANS LIKE '1%' 
                            AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                        GROUP BY
                            tabtrans.NO_REKENING 
                        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
                        )
                    LEFT JOIN (
                    SELECT
                        NO_REKENING,
                        sum( saldo_trans ) AS saldodebetblnlalu 
                    FROM
                        tabtrans 
                    WHERE
                        MY_KODE_TRANS LIKE '2%' 
                        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    GROUP BY
                        tabtrans.NO_REKENING 
                    ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
                    )
                LEFT JOIN (
                SELECT
                    NO_REKENING,
                    sum( saldo_trans ) AS mutasi_kredit 
                FROM
                    tabtrans 
                WHERE
                    MY_KODE_TRANS LIKE '1%' 
                    AND (
                        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
                GROUP BY
                    tabtrans.NO_REKENING 
                ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
            )
            LEFT JOIN (
            SELECT
                NO_REKENING,
                sum( saldo_trans ) AS mutasi_debet 
            FROM
                tabtrans 
            WHERE
                MY_KODE_TRANS LIKE '2%' 
                AND (
                    tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
            GROUP BY
                tabtrans.NO_REKENING 
            ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF = 2 
        ) a INNER JOIN (
            SELECT tabung.NO_REKENING,nasabah.nama_nasabah FROM (tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) LEFT JOIN 
(SELECT NO_REKENING FROM tabtrans WHERE TGL_TRANS>=date('$inputantgl6bln') AND TGL_TRANS<=date('$inputantgl') AND (KODE_TRANS<>'03' AND KODE_TRANS<>'04' AND KODE_TRANS<>'05') GROUP BY NO_REKENING) as x ON tabung.NO_REKENING=x.NO_REKENING WHERE x.NO_REKENING IS NULL AND tabung.STATUS_AKTIF='2') pasif ON a.NO_REKENING=pasif.NO_REKENING";
        $nominatif=DB::select($sql);
        return view('reports.rptnominatifpasif',['nominatif'=>$nominatif,'logos'=>$logos,'users'=>$users,'inputantgl'=>$inputantgl]);
    }
    public function nominatifpasifeksport(Request $request)
    {
        $this->validate($request,[
            'tgl_nominatif'=>'required'
        ]);

        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        // menghitung tanggal 6 Bulan kebelakang
        $inputantgl6bln = date('Y-m-d', strtotime("-6 months", strtotime($request->tgl_nominatif)));

        $sql="SELECT
        a.nasabah_id,
        a.NO_REKENING,
        a.nama_nasabah,
        a.alamat,
        a.AKAD as akad,
        a.NISBAH as nisbah,
        (
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.TGL_MULAI,
        a.JKW,
        a.TGL_JT,
        a.tgl_akhir_trans,
        a.suku_bunga,
        a.KODE_BI_PEMILIK,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.TGL_REGISTRASI,
        a.JENIS_TABUNGAN,
        a.KODE_BI_HUBUNGAN
    FROM
        (
        SELECT
            tabung.NO_REKENING,
            nasabah.nasabah_id,
            nasabah.nama_nasabah,
            nasabah.alamat,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.KODE_BI_PEMILIK,
            tabung.KODE_GROUP1,
            tabung.KODE_GROUP2,
            tabung.KODE_GROUP3,
            tabung.TGL_REGISTRASI,
            tabung.JENIS_TABUNGAN,
            kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
            tabung.TGL_MULAI,
            tabung.JKW,
            tabung.TGL_JT,
            tabung.AKAD,
            tabung.NISBAH,
            tabung.KODE_BI_HUBUNGAN,
            x.saldokredit,
            y.saldodebet,
            z.adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu,
            u.bungabln,
            tglakhirtrans.tgl_akhir_trans
        FROM
            ((((((((((
                                                tabung
                                                INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
                                                )
                                            INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
                                            )
                                        INNER JOIN (
                                        SELECT
                                            NO_REKENING,
                                            sum( saldo_trans ) AS saldokredit 
                                        FROM
                                            tabtrans 
                                        WHERE
                                            MY_KODE_TRANS LIKE '1%' 
                                            AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                        GROUP BY
                                            tabtrans.NO_REKENING 
                                        ) x ON tabung.NO_REKENING = x.NO_REKENING 
                                        )
                                    LEFT JOIN (
                                    SELECT
                                        NO_REKENING,
                                        sum( saldo_trans ) AS saldodebet 
                                    FROM
                                        tabtrans 
                                    WHERE
                                        MY_KODE_TRANS LIKE '2%' 
                                        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                    GROUP BY
                                        tabtrans.NO_REKENING 
                                    ) y ON tabung.NO_REKENING = y.NO_REKENING 
                                    )
                                LEFT JOIN (
                                SELECT
                                    tabtrans.tabtrans_id,
                                    tabtrans.no_rekening,
                                    tabtrans.saldo_trans AS adminbln 
                                FROM
                                    tabtrans
                                    INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-a%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) yy ON tabtrans.TABTRANS_ID = yy.tabid 
                                ) z ON tabung.NO_REKENING = z.NO_REKENING 
                                )
                            LEFT JOIN (
                            SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.saldo_trans AS bungabln 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-b%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) xx ON tabtrans.TABTRANS_ID = xx.tabid 
                            ) u ON tabung.NO_REKENING = u.NO_REKENING 
                            )
                        LEFT JOIN (
                        SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.TGL_TRANS AS tgl_akhir_trans 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) vv ON tabtrans.TABTRANS_ID = vv.tabid
                        ) tglakhirtrans ON tabung.NO_REKENING = tglakhirtrans.NO_REKENING
                        )
                        LEFT JOIN
                         (
                        SELECT
                            NO_REKENING,
                            sum( saldo_trans ) AS saldokreditblnlalu 
                        FROM
                            tabtrans 
                        WHERE
                            MY_KODE_TRANS LIKE '1%' 
                            AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                        GROUP BY
                            tabtrans.NO_REKENING 
                        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
                        )
                    LEFT JOIN (
                    SELECT
                        NO_REKENING,
                        sum( saldo_trans ) AS saldodebetblnlalu 
                    FROM
                        tabtrans 
                    WHERE
                        MY_KODE_TRANS LIKE '2%' 
                        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    GROUP BY
                        tabtrans.NO_REKENING 
                    ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
                    )
                LEFT JOIN (
                SELECT
                    NO_REKENING,
                    sum( saldo_trans ) AS mutasi_kredit 
                FROM
                    tabtrans 
                WHERE
                    MY_KODE_TRANS LIKE '1%' 
                    AND (
                        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
                GROUP BY
                    tabtrans.NO_REKENING 
                ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
            )
            LEFT JOIN (
            SELECT
                NO_REKENING,
                sum( saldo_trans ) AS mutasi_debet 
            FROM
                tabtrans 
            WHERE
                MY_KODE_TRANS LIKE '2%' 
                AND (
                    tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
            GROUP BY
                tabtrans.NO_REKENING 
            ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF = '2' 
        ) a INNER JOIN (
            SELECT tabung.NO_REKENING,nasabah.nama_nasabah FROM (tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) LEFT JOIN 
(SELECT NO_REKENING FROM tabtrans WHERE TGL_TRANS>=date('$inputantgl6bln') AND TGL_TRANS<=date('$inputantgl') AND (KODE_TRANS<>'03' AND KODE_TRANS<>'04' AND KODE_TRANS<>'05') GROUP BY NO_REKENING) as x ON tabung.NO_REKENING=x.NO_REKENING WHERE x.NO_REKENING IS NULL AND tabung.STATUS_AKTIF='2') pasif ON a.NO_REKENING=pasif.NO_REKENING";
        $nominatif=DB::select($sql);
        return (new ReporttabunganpasifExport($nominatif))->download('nominatiftabpasif.xlsx');

    }
    public function bo_tb_rpt_pdfnominatifpasif(Request $request)
    {
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        // menghitung tanggal 6 Bulan kebelakang
        $inputantgl6bln = date('Y-m-d', strtotime("-6 months", strtotime($request->tgl_nominatif)));

        $sql="SELECT
        a.nasabah_id,
        a.NO_REKENING,
        a.nama_nasabah,
        a.alamat,
        a.AKAD as akad,
        a.NISBAH as nisbah,
        (
        IF
            ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
            ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        a.TGL_MULAI,
        a.JKW,
        a.TGL_JT,
        a.tgl_akhir_trans,
        a.suku_bunga,
        a.KODE_BI_PEMILIK,
        a.KODE_GROUP1,
        a.KODE_GROUP2,
        a.KODE_GROUP3,
        a.TGL_REGISTRASI,
        a.JENIS_TABUNGAN,
        a.KODE_BI_HUBUNGAN
    FROM
        (
        SELECT
            tabung.NO_REKENING,
            nasabah.nasabah_id,
            nasabah.nama_nasabah,
            nasabah.alamat,
            tabung.suku_bunga,
            tabung.SALDO_AWAL,
            tabung.KODE_BI_PEMILIK,
            tabung.KODE_GROUP1,
            tabung.KODE_GROUP2,
            tabung.KODE_GROUP3,
            tabung.TGL_REGISTRASI,
            tabung.JENIS_TABUNGAN,
            kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,
            tabung.TGL_MULAI,
            tabung.JKW,
            tabung.TGL_JT,
            tabung.AKAD,
            tabung.NISBAH,
            tabung.KODE_BI_HUBUNGAN,
            x.saldokredit,
            y.saldodebet,
            z.adminbln,
            mutasikredit.mutasi_kredit,
            mutasidebet.mutasi_debet,
            sldkrdblnlalu.saldokreditblnlalu,
            slddbtblnlalu.saldodebetblnlalu,
            u.bungabln,
            tglakhirtrans.tgl_akhir_trans
        FROM
            ((((((((((
                                                tabung
                                                INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
                                                )
                                            INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
                                            )
                                        INNER JOIN (
                                        SELECT
                                            NO_REKENING,
                                            sum( saldo_trans ) AS saldokredit 
                                        FROM
                                            tabtrans 
                                        WHERE
                                            MY_KODE_TRANS LIKE '1%' 
                                            AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                        GROUP BY
                                            tabtrans.NO_REKENING 
                                        ) x ON tabung.NO_REKENING = x.NO_REKENING 
                                        )
                                    LEFT JOIN (
                                    SELECT
                                        NO_REKENING,
                                        sum( saldo_trans ) AS saldodebet 
                                    FROM
                                        tabtrans 
                                    WHERE
                                        MY_KODE_TRANS LIKE '2%' 
                                        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
                                    GROUP BY
                                        tabtrans.NO_REKENING 
                                    ) y ON tabung.NO_REKENING = y.NO_REKENING 
                                    )
                                LEFT JOIN (
                                SELECT
                                    tabtrans.tabtrans_id,
                                    tabtrans.no_rekening,
                                    tabtrans.saldo_trans AS adminbln 
                                FROM
                                    tabtrans
                                    INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-a%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) yy ON tabtrans.TABTRANS_ID = yy.tabid 
                                ) z ON tabung.NO_REKENING = z.NO_REKENING 
                                )
                            LEFT JOIN (
                            SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.saldo_trans AS bungabln 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE KUITANSI LIKE '%sys-b%' AND TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) xx ON tabtrans.TABTRANS_ID = xx.tabid 
                            ) u ON tabung.NO_REKENING = u.NO_REKENING 
                            )
                        LEFT JOIN (
                        SELECT
                                tabtrans.tabtrans_id,
                                tabtrans.no_rekening,
                                tabtrans.TGL_TRANS AS tgl_akhir_trans 
                            FROM
                                tabtrans
                                INNER JOIN ( SELECT MAX( TABTRANS_ID ) AS tabid, NO_REKENING FROM tabtrans WHERE TGL_TRANS <= date( '$inputantgl' ) GROUP BY NO_REKENING ) vv ON tabtrans.TABTRANS_ID = vv.tabid
                        ) tglakhirtrans ON tabung.NO_REKENING = tglakhirtrans.NO_REKENING
                        )
                        LEFT JOIN
                         (
                        SELECT
                            NO_REKENING,
                            sum( saldo_trans ) AS saldokreditblnlalu 
                        FROM
                            tabtrans 
                        WHERE
                            MY_KODE_TRANS LIKE '1%' 
                            AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                        GROUP BY
                            tabtrans.NO_REKENING 
                        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
                        )
                    LEFT JOIN (
                    SELECT
                        NO_REKENING,
                        sum( saldo_trans ) AS saldodebetblnlalu 
                    FROM
                        tabtrans 
                    WHERE
                        MY_KODE_TRANS LIKE '2%' 
                        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    GROUP BY
                        tabtrans.NO_REKENING 
                    ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
                    )
                LEFT JOIN (
                SELECT
                    NO_REKENING,
                    sum( saldo_trans ) AS mutasi_kredit 
                FROM
                    tabtrans 
                WHERE
                    MY_KODE_TRANS LIKE '1%' 
                    AND (
                        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                    AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
                GROUP BY
                    tabtrans.NO_REKENING 
                ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
            )
            LEFT JOIN (
            SELECT
                NO_REKENING,
                sum( saldo_trans ) AS mutasi_debet 
            FROM
                tabtrans 
            WHERE
                MY_KODE_TRANS LIKE '2%' 
                AND (
                    tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
                AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
            GROUP BY
                tabtrans.NO_REKENING 
            ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF = '2' 
        ) a INNER JOIN (
            SELECT tabung.NO_REKENING,nasabah.nama_nasabah FROM (tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) LEFT JOIN 
(SELECT NO_REKENING FROM tabtrans WHERE TGL_TRANS>=date('$inputantgl6bln') AND TGL_TRANS<=date('$inputantgl') AND (KODE_TRANS<>'03' AND KODE_TRANS<>'04' AND KODE_TRANS<>'05') GROUP BY NO_REKENING) as x ON tabung.NO_REKENING=x.NO_REKENING WHERE x.NO_REKENING IS NULL AND tabung.STATUS_AKTIF='2') pasif ON a.NO_REKENING=pasif.NO_REKENING";

        $nominatif=DB::select($sql);
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_TAB'.'%'.'NAMA')->get();
        $kota=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_KOTA'.'%')->get();
        return view('pdf.cetaknominatifpasif',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'kota'=>$kota,'ttd'=>$ttd,'inputantgl'=>$inputantgl]);
    }
    // FORM HITUNG TABUNGAN
    public function bo_tb_de_frmhitungbungatab()
    {
        $logos = Logo::all();
        return view('admin.tabungan.frmhitungbungatab',['logos'=>$logos]);
    }
    // Modul proses Hitung Tabungan
    public function bo_tb_de_hitungbungatab(Request $request)
    {
        $tgl1 = date('Y-m-d',strtotime($request->tgl_awal));
        $tgl2 = date('Y-m-d',strtotime($request->tgl_akhir));

        $cari = Tabtran::where('TGL_TRANS','>=',$tgl1)
        ->where('TGL_TRANS','<=',$tgl2)
        ->where('KUITANSI','LIKE','SYS%')->get();
        // MENGHINDARI DI PROSES HITUNG BUNGA SETELAH OOVERBOOK BUNGA
        if(count($cari)>0 AND is_null($request->koreksi)==true){
return redirect()->back()->with('alert','SUDAH PERNAH DILAKUKAN PERHITUNGAN');
}

        $tglakhir=date('Y-m-d',strtotime($request->tgl_akhir));
        // Pengecekan Syarat2 pada Konfigurasi Tabungan / Table MYSYSID
        $mysysid = Mysysid::where('KeyName','LIKE','tab%pajak%')
        ->orWhere('KeyName','LIKE','tab%hari%')
        ->orWhere('KeyName','LIKE','tab%minimal%')
        ->orWhere('KeyName','LIKE','tab%koma%')
        ->get();
        // Cek KONFIGURASI TABUNGAN
        // TAB_HITUNG_PAJAK_BERDASARKAN - TAB_SALDO_HITUNG_PAJAK_TABUNGAN
        $syarat=$mysysid[9]->Value.'-'.$mysysid[8]->Value;
        // TAB_SALDO_MINIMAL_KENA_PPH
        $syaratsaldominimalkenapajak=$mysysid[2]->Value;
        // dd($syaratsaldominimalkenapajak);
        // TAB_JUMLAH_DIGIT_KOMA
        $tabdigitkoma= $mysysid[7]->Value;
        // TAB_JML_HARI_SETAHUN
        $jmlsetahun=(int)$mysysid[10]->Value;

        DB::select("update tabung set NO_REKENING=REPLACE(NO_REKENING,' ','')");
        // Looping pada Tabel TABUNG 
        $sqltabungan = DB::select("SELECT tabung.*,kodejenistabungan.SALDO_MIN_BUNGA FROM tabung INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN WHERE tabung.STATUS_AKTIF=2");
        for($i=0;$i<count($sqltabungan);$i++)
        {   

            // Ambil data Norekening
            $norekpegangan[]=$sqltabungan[$i]->NO_REKENING;
            // Amabil data Nasabah_id 
            $nasabahid[]=$sqltabungan[$i]->NASABAH_ID;
            // Amabil data PersenPPH 
            $persenpph[]=$sqltabungan[$i]->PERSEN_PPH;
            // Suku Bunga
            $sukubunga[]=$sqltabungan[$i]->SUKU_BUNGA;
            // SALDO AWAL
            $saldoawal[]=$sqltabungan[$i]->SALDO_AWAL;
            // SALDO_MINIMIN TERKENA BUNGA
            $saldominbunga[]=$sqltabungan[$i]->SALDO_MIN_BUNGA;


            // Hitung saldo nominatif no_rekening[$i] BULAN LALU
            $sqlstr="SELECT (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))) AS saldonom FROM tabung INNER JOIN tabtrans ON tabung.NO_REKENING=tabtrans.NO_REKENING where (tabung.NO_REKENING='$norekpegangan[$i]') GROUP BY tabung.NO_REKENING";
            
            // VARIABLE-VARIABLE
            $tgltrans=[];$selisihhari=0;$saldo=[];$mykodetran=[];$saldoakhir=[];$tottrans=0;
            $saldonominatif = DB::select($sqlstr);
            // SALDO AKHIR AWAL BULAN
            if(count($saldonominatif)>0){
                $tottrans=$saldonominatif[0]->saldonom;
            }else{
                $tottrans=0;
            }
            // -----------------------
            $saldoeffektif=0;$bunga=0;$saldotrans=[];
        // KONDISI KOREKSI TERCENTANG
        if($request->koreksi=="on")
        {
            $sqltab = Tabungan::with(['tabtrans'=>fn($query)=>$query->where('NO_REKENING',$norekpegangan[$i])->where('TGL_TRANS','>=',$request->tgl_awal)->where('TGL_TRANS','<=',$request->tgl_akhir)->where('KUITANSI','NOT LIKE','SYS%')->orderBy('NO_REKENING')->orderBy('TGL_TRANS'),'kodetranstab'])
            ->whereHas('tabtrans',fn($query)=>
                $query->where('NO_REKENING',$norekpegangan[$i])->where('TGL_TRANS','>=',$request->tgl_awal)->where('TGL_TRANS','<=',$request->tgl_akhir)->where('KUITANSI','NOT LIKE','SYS%')->orderBy('NO_REKENING')->orderBy('TGL_TRANS')
            )->get();
        }
        //KONDISI BUKAN DIKOREKSI PERHITUNGAN
        else{
            $sqltab = Tabungan::with(['tabtrans'=>fn($query)=>$query->where('NO_REKENING',$norekpegangan[$i])->where('TGL_TRANS','>=',$request->tgl_awal)->where('TGL_TRANS','<=',$request->tgl_akhir)->orderBy('NO_REKENING')->orderBy('TGL_TRANS'),'kodetranstab'])
            ->whereHas('tabtrans',fn($query)=>
                $query->where('NO_REKENING',$norekpegangan[$i])->where('TGL_TRANS','>=',$request->tgl_awal)->where('TGL_TRANS','<=',$request->tgl_akhir)->orderBy('NO_REKENING')->orderBy('TGL_TRANS')
            )->get();
        }

            $hari = date('d',strtotime($request->tgl_akhir));
        // Jika tidak ada transaksi selama range tgl
        if(count($sqltab)==0)
        {   
            // PROSES KOREKSI
            if($request->koreksi=="on"){
                $sqlbng="SELECT (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))+SUM(if(MY_KODE_TRANS LIKE '1%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0)))*$sukubunga[$i]*1/100*1/$jmlsetahun*$hari as debet,(tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))+SUM(if(MY_KODE_TRANS LIKE '1%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))) AS saldonom FROM tabung INNER JOIN tabtrans ON tabung.NO_REKENING=tabtrans.NO_REKENING where (tabung.NO_REKENING='$norekpegangan[$i]') GROUP BY tabung.NO_REKENING";
                $sqltabpdep = "SELECT nasabah.nasabah_id,tabtran.saldotab,deposito.SALDO_AKHIR as saldodep FROM nasabah LEFT JOIN tabung ON nasabah.nasabah_id = tabung.NASABAH_ID LEFT JOIN (SELECT NO_REKENING,(SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))+SUM(if(MY_KODE_TRANS LIKE '1%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))) AS saldotab FROM tabtrans WHERE TGL_TRANS <='$tgl2' GROUP BY NO_REKENING) AS tabtran ON tabung.NO_REKENING = tabtran.NO_REKENING LEFT JOIN deposito ON nasabah.nasabah_id = deposito.NASABAH_ID LEFT JOIN (SELECT no_rekening,tgl_trans,my_kode_trans,saldo_trans FROM deptrans WHERE TGL_TRANS <= '$tgl1') AS deptran ON deposito.NO_REKENING = deptran.no_rekening WHERE nasabah.nasabah_id='$nasabahid[$i]'";
            }else{
                // bukan proses koreksi
                $sqlbng="SELECT ((tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0)))*$sukubunga[$i]*1/100*1/$jmlsetahun*$hari) as debet,((tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0)))) as saldonom FROM tabung INNER JOIN tabtrans ON tabung.NO_REKENING=tabtrans.NO_REKENING where (tabung.NO_REKENING='$norekpegangan[$i]' AND tabtrans.TGL_TRANS<='$tgl2') GROUP BY tabung.NO_REKENING";
                $sqltabpdep = "SELECT nasabah.nasabah_id,tabtran.saldotab,deposito.SALDO_AKHIR as saldodep FROM nasabah LEFT JOIN tabung ON nasabah.nasabah_id = tabung.NASABAH_ID LEFT JOIN (SELECT NO_REKENING,(SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) AS saldotab FROM tabtrans WHERE TGL_TRANS <='$tgl2' GROUP BY NO_REKENING) AS tabtran ON tabung.NO_REKENING = tabtran.NO_REKENING LEFT JOIN deposito ON nasabah.nasabah_id = deposito.NASABAH_ID LEFT JOIN (SELECT no_rekening,tgl_trans,my_kode_trans,saldo_trans FROM deptrans WHERE TGL_TRANS <= '$tgl2') AS deptran ON deposito.NO_REKENING = deptran.no_rekening WHERE nasabah.nasabah_id='$nasabahid[$i]'";
            }
                $jmlpajak=0;
                $rshitbunga=DB::select($sqlbng);
                $cektabdep=DB::select($sqltabpdep);
                if(count($rshitbunga)==0)
                {
                    dd($norekpegangan[$i]);
                }
                if(($rshitbunga[0]->saldonom)>=$syaratsaldominimalkenapajak)
                {
                    $jmlpajak = ($rshitbunga[0]->debet)*$persenpph[$i]/100;
                }elseif(($cektabdep[0]->saldotab+$cektabdep[0]->saldodep)>=$syaratsaldominimalkenapajak){
                    $jmlpajak = ($rshitbunga[0]->debet)*$persenpph[$i]/100;
                }
                if((int)$rshitbunga[0]->debet<=0){
                    $bngblnini=0;
                }else{
                    $bngblnini=(int)$rshitbunga[0]->debet;
                }
                $sql="UPDATE tabung SET ADM_BLN_INI=ADM_PER_BLN,BUNGA_BLN_INI=".round((int)$bngblnini,(int)$tabdigitkoma).",SALDO_AKHIR=".(int)$rshitbunga[0]->saldonom.",SALDO_NOMINATIF=".(int)$rshitbunga[0]->saldonom.",PAJAK_BLN_INI=".round($jmlpajak,(int)$tabdigitkoma).",SALDO_HITUNG_PAJAK=".(int)$rshitbunga[0]->saldonom.",SALDO_EFEKTIF_BLN_INI=".(int)$rshitbunga[0]->saldonom." where NO_REKENING='$norekpegangan[$i]'";
                // dd($sql);
            DB::select("UPDATE tabung SET ADM_BLN_INI=ADM_PER_BLN,BUNGA_BLN_INI=".round((int)$bngblnini,(int)$tabdigitkoma).",SALDO_AKHIR=".(int)$rshitbunga[0]->saldonom.",SALDO_NOMINATIF=".(int)$rshitbunga[0]->saldonom.",PAJAK_BLN_INI=".round($jmlpajak,(int)$tabdigitkoma).",SALDO_HITUNG_PAJAK=".(int)$rshitbunga[0]->saldonom.",SALDO_EFEKTIF_BLN_INI=".(int)$rshitbunga[0]->saldonom." where NO_REKENING='$norekpegangan[$i]'");

        }
    // JKA RECORD TRANSAKSI TABTRANS ADA
    else{
            // UPDATE SALDO_NOMINATIF,SALDO_SETORAN,SALDO_PENARIKAN
            if($request->koreksi=="on")
            {

                $sldnomi=DB::select("SELECT (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))+SUM(if(MY_KODE_TRANS LIKE '1%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))) as debet FROM tabung inner join tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING where (tabung.NO_REKENING='$norekpegangan[$i]') GROUP BY tabung.NO_REKENING")[0]->debet;
                $sldsetor=DB::select("SELECT (SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))+SUM(if(MY_KODE_TRANS LIKE '1%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))) as debet FROM tabtrans where (NO_REKENING='$norekpegangan[$i]') GROUP BY NO_REKENING")[0]->debet;
                $sldtarik=DB::select("SELECT (SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<'$tgl1',SALDO_TRANS,0))+SUM(if(MY_KODE_TRANS LIKE '2%' AND KUITANSI NOT LIKE 'SYS%' AND TGL_TRANS>='$tgl1' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))) as debet FROM tabtrans where (NO_REKENING='$norekpegangan[$i]') GROUP BY NO_REKENING")[0]->debet;
                $sqlupdtbg="UPDATE tabung SET tabung.ADM_BLN_INI=tabung.ADM_PER_BLN,tabung.SALDO_NOMINATIF=$sldnomi,tabung.SALDO_SETORAN=$sldsetor,tabung.SALDO_PENARIKAN=$sldtarik where tabung.NO_REKENING='$norekpegangan[$i]'";
            }else{
                $sldnomi=DB::select("SELECT (tabung.SALDO_AWAL+SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) as debet FROM tabung inner join tabtrans on tabung.NO_REKENING=tabtrans.NO_REKENING where (tabung.NO_REKENING='$norekpegangan[$i]' AND tabtrans.TGL_TRANS<='$tgl2') GROUP BY tabung.NO_REKENING)")[0]->debet;
                $sldsetor=DB::select("SELECT (SUM(if(MY_KODE_TRANS LIKE '1%' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))) as debet FROM tabtrans where (NO_REKENING='$norekpegangan[$i]') GROUP BY NO_REKENING")[0]->debet;
                $sldtarik=DB::select("SELECT (SUM(if(MY_KODE_TRANS LIKE '2%' AND TGL_TRANS<='$tgl2',SALDO_TRANS,0))) as debet FROM tabtrans where (NO_REKENING='$norekpegangan[$i]') GROUP BY NO_REKENING")[0]->debet;
                $sqlupdtbg="UPDATE tabung SET tabung.ADM_BLN_INI=tabung.ADM_PER_BLN,tabung.SALDO_NOMINATIF=$sldnomi,tabung.SALDO_SETORAN=$sldsetor,tabung.SALDO_PENARIKAN=$sldtarik where tabung.NO_REKENING='$norekpegangan[$i]'";

            }
            DB::select($sqlupdtbg);
            //Looping pada tabel Tabtrans untuk menghitung Bunga
            for($j=0;$j<count($sqltab[0]->tabtrans->where('TGL_TRANS','>=',$request->tgl_awal)->where('TGL_TRANS','<=',$request->tgl_akhir));$j++)
            {   
                $saldoakhir[]=$tottrans;
                // Ambil tgl tgt_trans
                $tgltrans[]=$sqltab[0]->tabtrans[$j]->TGL_TRANS;
                //ambil saldo_trans
                $saldo[]=$sqltab[0]->tabtrans[$j]->SALDO_TRANS;
                // mencatat kode transaksi
                $mykodetran[]=$sqltab[0]->tabtrans[$j]->MY_KODE_TRANS;
                if($j==0){
                // Untuk mengambil selisih hari jika pembukaan Rek diakhir bulan
                if($j==(count($sqltab[0]->tabtrans)-1)){
                $bunga=$bunga+ ($tottrans+$saldo[$j])*((strtotime($tgl2)-strtotime($tgltrans[$j]))*1/60*1/60*1/24+1)*($sukubunga[$i])/100*1/$jmlsetahun;
                //Hitung saldo Efektif    
                $saldoeffektif = $saldoeffektif+($tottrans+$saldo[$j])*((strtotime($tgl2)-strtotime($tgltrans[$j]))*1/60*1/60*1/24+1)/date('d',strtotime($tgl2));
                    // Update bunga_bln_ini dan saldo_efektif_bln_ini Tabung
                    DB::select('UPDATE tabung set BUNGA_BLN_INI='.round($bunga,(int) $tabdigitkoma).',SALDO_EFEKTIF_BLN_INI='.round($saldoeffektif,(int) $tabdigitkoma).' where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }
                    if($saldoakhir[$j]>0)
                    {   
                        $selisihhari=(strtotime($tgltrans[$j])-strtotime($tgl1))*1/60*1/60*1/24;
                        // Hitung bunga
                    $bunga=$bunga+ ($saldoakhir[$j])*($selisihhari)*($sukubunga[$i])/100*1/$jmlsetahun;
                        // Hitung saldo efektif
                    $saldoeffektif=$saldoeffektif + ($saldoakhir[$j])*($selisihhari)*1/date('d',strtotime($tgl2));
                        // Update Saldobunga Tabung dan saldo efektif
                    DB::select('update tabung set BUNGA_BLN_INI='.round($bunga,(int)$tabdigitkoma).',SALDO_EFEKTIF_BLN_INI='.round($saldoeffektif,(int)$tabdigitkoma).' where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    } 

                }elseif($j>0){
                // Untuk Menghitung Bunga dan Saldo Efektif jika sudah punya saldo awal bulan
                    $selisihhari=(strtotime($tgltrans[$j])-strtotime($tgltrans[($j-1)]))*1/60*1/60*1/24;
                    // Hitung bunga
                    $bunga=$bunga+ ($tottrans)*($selisihhari)*($sqltab[0]->SUKU_BUNGA)/100*1/$jmlsetahun;
                    // Hitung saldo efektif
                    $saldoeffektif=$saldoeffektif+ ($tottrans)*($selisihhari)*1/date('d',strtotime($request->tgl_akhir));
                    // Update bunga dan saldo efektif Tabung
                    DB::select('update tabung set BUNGA_BLN_INI='.round($bunga,(int)$tabdigitkoma).',SALDO_EFEKTIF_BLN_INI='.round($saldoeffektif,(int) $tabdigitkoma).' where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                // Mengambil data Selisih hari dimasukan kedalam Array $trs
                    $trs[]=$selisihhari;
                    // Jika sudah LOOPING TERAKHIR 
                    if($j==(count($sqltab[0]->tabtrans)-1))
                    {
                        if(substr($mykodetran[$j],0,1)=='1')
                        {
                            $tottrans=$tottrans+$saldo[$j];
                        }elseif(substr($mykodetran[$j],0,1)=='2')
                        {
                            $tottrans=$tottrans-$saldo[$j];
                        }
                        $saldotrans[]=$tottrans;
                        $selisihhari=(strtotime($request->tgl_akhir)-strtotime($tgltrans[$j]))*1/60*1/60*1/24+1;
                        // hitung bunga
                        $bunga=$bunga+ ($tottrans)*($selisihhari)*($sqltab[0]->SUKU_BUNGA)/100*1/$jmlsetahun;
                        // Hitung saldo efektif
                        $saldoeffektif=$saldoeffektif+ ($tottrans)*($selisihhari)*1/date('d',strtotime($request->tgl_akhir));
                        // update bunga bln ini dan saldo efektif
                        DB::select('update tabung set BUNGA_BLN_INI='.round($bunga,(int) $tabdigitkoma).',SALDO_EFEKTIF_BLN_INI='.round($saldoeffektif,(int) $tabdigitkoma).' where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    } 
                }
                // PENCATATAN SALDO TRANSAKSI
                if(substr($mykodetran[$j],0,1)=='1')
                {
                    $tottrans=$tottrans+$saldo[$j];
                }elseif(substr($mykodetran[$j],0,1)=='2')
                {
                    $tottrans=$tottrans-$saldo[$j];
                }
                if($j<(count($sqltab[0]->tabtrans)-1))
                {
                    $saldotrans[]=$tottrans;
                }elseif(count($sqltab[0]->tabtrans)-1==0){
                    $saldotrans[]=$tottrans;
                }
            }
    // -------------------BATAS LOOPING HITUNG BUNGA TABUNGAN-------------------

// PROSES UPDATE SETELAH MELIHAT KONFIGURASI TABUNGAN dan SETELAH PROSES HIT BUNGA
            // dd(count($saldotrans));
            switch($syarat)
                {
                case 'NASABAH_ID-SALDO_TERBESAR' :
                    // syarat 1 Cek Apakah Memiliki 2 Saldo di Deposito dan Tabungan
                    $sqltxt="SELECT nasabah.nasabah_id,(tabtran.debet+tabung.SALDO_AWAL) AS debet,deposito.SALDO_AKHIR FROM (((nasabah LEFT JOIN tabung ON nasabah.nasabah_id = tabung.NASABAH_ID) LEFT JOIN (SELECT NO_REKENING,(SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) AS debet FROM tabtrans WHERE TGL_TRANS <='$tgl2' GROUP BY NO_REKENING) AS tabtran ON tabung.NO_REKENING = tabtran.NO_REKENING) LEFT JOIN deposito ON nasabah.nasabah_id = deposito.NASABAH_ID) LEFT JOIN (SELECT no_rekening,tgl_trans,my_kode_trans,saldo_trans FROM deptrans WHERE TGL_TRANS <= '$tgl2') AS deptran ON deposito.NO_REKENING = deptran.no_rekening WHERE nasabah.nasabah_id='$nasabahid[$i]'";
                    $rscheck = DB::select($sqltxt);
                    // mengurutkan Saldo Transaksi dari Besar Ke Kecil
                    rsort($saldotrans);
                    $pajakpph = $bunga*$persenpph[$i]/100;
                    //JIKA Belum Punya Deposito
                    if(count($rscheck)==0){
                        $saldodep=0;
                    }else{
                        $saldodep=$rscheck[0]->SALDO_AKHIR;
                    }
                    if(is_null($rscheck[0]->SALDO_AKHIR) AND ($saldodep + $saldotrans[0])>(int)$syaratsaldominimalkenapajak)
                    {   
                        // Update Saldo_Hitung_Pajak
                        DB::select('update tabung set SALDO_HITUNG_PAJAK='.(round($saldotrans[0],(int) $tabdigitkoma)+$rscheck[0]->SALDO_AKHIR).',PAJAK_BLN_INI='.round($pajakpph,(int) $tabdigitkoma).',ADM_BLN_INI=ADM_PER_BLN where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }
                    //JIKA Punya Deposito
                    elseif($rscheck[0]->SALDO_AKHIR <> null AND ($saldoeffektif+$rscheck[0]->SALDO_AKHIR)>=(int)$syaratsaldominimalkenapajak){
                        $saldopjk=$saldoeffektif+$rscheck[0]->SALDO_AKHIR;

                        DB::select('update tabung set SALDO_HITUNG_PAJAK='.round($saldopjk,(int) $tabdigitkoma).',PAJAK_BLN_INI='.round($pajakpph,(int) $tabdigitkoma).',ADM_BLN_INI=ADM_PER_BLN where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }else{

                        DB::select('update tabung set SALDO_HITUNG_PAJAK='.(round($saldotrans[0],(int) $tabdigitkoma)+$rscheck[0]->SALDO_AKHIR).',ADM_BLN_INI=ADM_PER_BLN where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }
                    break;
                case 'NASABAH_ID-NORMAL' :
                    // syarat 1 Cek Apakah Memiliki 2 Saldo di Deposito dan Tabungan
                    $sqltxt="SELECT nasabah.nasabah_id,(tabtran.debet+tabung.SALDO_AWAL) AS debet,deposito.SALDO_AKHIR FROM (((nasabah LEFT JOIN tabung ON nasabah.nasabah_id = tabung.NASABAH_ID) LEFT JOIN (SELECT NO_REKENING,(SUM(if(MY_KODE_TRANS LIKE '1%',SALDO_TRANS,0))-SUM(if(MY_KODE_TRANS LIKE '2%',SALDO_TRANS,0))) AS debet FROM tabtrans WHERE TGL_TRANS <='$tgl2' GROUP BY NO_REKENING) AS tabtran ON tabung.NO_REKENING = tabtran.NO_REKENING) LEFT JOIN deposito ON nasabah.nasabah_id = deposito.NASABAH_ID) LEFT JOIN (SELECT no_rekening,tgl_trans,my_kode_trans,saldo_trans FROM deptrans WHERE TGL_TRANS <= '$tgl2') AS deptran ON deposito.NO_REKENING = deptran.no_rekening WHERE nasabah.nasabah_id='$nasabahid[$i]'";
                    $rscheck = DB::select($sqltxt);
                    // mengurutkan Saldo Transaksi dari Besar Ke Kecil
                    rsort($saldotrans);
                    $pajakpph = $bunga*$persenpph[$i]/100;
                    //JIKA Belum Punya Deposito
                    if(count($rscheck)==0){
                        $saldodep=0;
                    }else{
                        $saldodep=$rscheck[0]->SALDO_AKHIR;
                    }
                    if(is_null($rscheck[0]->SALDO_AKHIR) AND ($saldodep + $sldnomi)>(int)$syaratsaldominimalkenapajak)
                    {   
                        // Update Saldo_Hitung_Pajak
                        DB::select('update tabung set SALDO_HITUNG_PAJAK='.(round($sldnomi,(int) $tabdigitkoma)+$rscheck[0]->SALDO_AKHIR).',PAJAK_BLN_INI='.round($pajakpph,(int) $tabdigitkoma).',ADM_BLN_INI=ADM_PER_BLN where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }
                    //JIKA Punya Deposito SALDO HITUNG PAJAK = SALDO EFF + SALDO DEPOSITO
                    elseif($rscheck[0]->SALDO_AKHIR <> null AND ($saldoeffektif+$rscheck[0]->SALDO_AKHIR)>=(int)$syaratsaldominimalkenapajak){
                        $saldopjk=$saldoeffektif+$rscheck[0]->SALDO_AKHIR;

                        DB::select('update tabung set SALDO_HITUNG_PAJAK='.round($saldopjk,(int) $tabdigitkoma).',PAJAK_BLN_INI='.round($pajakpph,(int) $tabdigitkoma).',ADM_BLN_INI=ADM_PER_BLN where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }else{
                        DB::select('update tabung set SALDO_HITUNG_PAJAK='.(round($saldotrans[0],(int) $tabdigitkoma)+$rscheck[0]->SALDO_AKHIR).',ADM_BLN_INI=ADM_PER_BLN where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }
                    break;
                case 'NO_REKENING-SALDO_TERBESAR' :
                    // syarat 1 Cek Apakah Memiliki 2 Saldo di Deposito dan Tabungan
                    rsort($saldotrans);
                    $pajakpph = $bunga*$persenpph[$i]/100;
                    // Update Saldo_Hitung_Pajak
                    if($saldotrans[0]>$syaratsaldominimalkenapajak)
                    {
                        DB::select('update tabung set SALDO_HITUNG_PAJAK='.$saldotrans[0].',ADM_BLN_INI=ADM_PER_BLN,PAJAK_BLN_INI='.round($pajakpph,(int) $tabdigitkoma).' where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }else{
                        DB::select('update tabung set SALDO_HITUNG_PAJAK='.$saldotrans[0].',ADM_BLN_INI=ADM_PER_BLN where NO_REKENING='."'".$sqltab[0]->NO_REKENING."'");
                    }
                }

            } //batas looping ada Transaksi di Tabtrans dalam range 
            DB::select("update tabung set bunga_bln_ini=0,pajak_bln_ini=0 where no_rekening='$norekpegangan[$i]' AND saldo_nominatif<$saldominbunga[$i]");

            DB::select("update tabung set saldo_akhir=(saldo_nominatif+bunga_bln_ini-pajak_bln_ini-adm_bln_ini) where no_rekening='$norekpegangan[$i]'");

        } // BATAS Looping pada Tabel TABUNG 

        return redirect()->back() ->with('alert', 'PERHITUNGAN BUNGA, PAJAK DAN ADMIN SELESAI!');
    }
    // MUNCULKAN FORM BROWSE BUNGA TABUNAN
    public function bo_tb_de_frmbrowsebungapajak()
    {
        $users = User::all();
        $logos=Logo::all();
        // $ceknasabah = Tabungan::with('nasabah')->select('no_rekening','NASABAH_ID')->where('STATUS_AKTIF','=',2)->get();

            DB::select('update nasabah set nasabah_id=REPLACE(nasabah_id," ","")');
            DB::select('update tabung set NASABAH_ID=REPLACE(NASABAH_ID," ","")');

        $brwsebngpjk = Tabungan::with('nasabah')->select('no_rekening','NASABAH_ID','saldo_efektif_bln_ini','bunga_bln_ini','pajak_bln_ini','adm_bln_ini','saldo_hitung_pajak','saldo_nominatif','saldo_akhir')->where('STATUS_AKTIF','=',2)->get();

        return view('admin.tabungan.frmbrowsebunga',['logos'=>$logos,'brwsebngpjk'=>$brwsebngpjk,'users'=>$users,'msgstatus'=>'']);
    }   
    // Update Bunga & Pajak leat form udapte
    public function bo_adm_update_bngpjk(Request $request)
    {
        // dd($request);
        $logos = Logo::all();
        $rs=Tabungan::where('no_rekening',$request->no_rekening)
                ->update(
                    [
                        'bunga_bln_ini'=>$request->bunga_bln_ini,
                        'pajak_bln_ini'=>$request->pajak_bln_ini,
                        'adm_bln_ini'=>$request->adm_bln_ini
                    ]
                );
        if($rs){$msg='1';}else{$msg='0';}
        $brwsebngpjk = Tabungan::with('nasabah')
                        ->select('no_rekening','NASABAH_ID','saldo_efektif_bln_ini','bunga_bln_ini','pajak_bln_ini','adm_bln_ini','saldo_hitung_pajak','saldo_nominatif','saldo_akhir')->where('STATUS_AKTIF','=',2)->get();
        return view('admin.tabungan.frmbrowsebunga',    ['logos'=>$logos,'brwsebngpjk'=>$brwsebngpjk,'msgstatus'=>$msg]);
    }
    // tampilkaan form overbook tabungan
    public function bo_tb_de_frmoverbooktabungan()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodetranstab = Kodetranstabungan::all();
        return view('admin/tabungan/frmoverbooktab',['users'=>$users,'logos'=>$logos,'kodetranstab'=>$kodetranstab,'msgstatus'=>'']);
    }
    // Proses update tabung dan tabtrans saat proses overbook
    public function bo_tab_overbook(Request $request)
    {   
        $tgl = date('Y-m-d',strtotime($request->inputtgloverbook));
        $logos = Logo::all();
        $users = User::all();
        $kodetranstab = Kodetranstabungan::all();
        if(is_null($request->inputtgloverbook)){
            return redirect()->back()->with('alert','TANGGGAL BELOM DIISI');
        }
        $cari = Tabtran::where('TGL_TRANS','=',$tgl)
                        ->where('KUITANSI','LIKE','SYS%')->get();

        if(count($cari)>0 AND $request->koreksi<>'on'){
            return redirect()->back()->with('alert','SUDAH PERNAH DILAKUKAN OVERBOOK');
        }elseif(count($cari)>0 AND $request->koreksi=='on'){
            // dd($request->koreksi);
            // DB::select('UPDATE tabung SET SALDO_SETORAN=(SALDO_SETORAN+0),SALDO_PENARIKAN=(SALDO_PENARIKAN+0+0),SALDO_AKHIR=(SALDO_AKHIR+0-0-0) where STATUS_AKTIF=2');
            DB::select('UPDATE tabung SET SALDO_SETORAN=(SALDO_SETORAN+BUNGA_BLN_INI),SALDO_PENARIKAN=(SALDO_PENARIKAN+ADM_BLN_INI+PAJAK_BLN_INI),SALDO_AKHIR=(SALDO_AKHIR+BUNGA_BLN_INI-ADM_BLN_INI-PAJAK_BLN_INI) where STATUS_AKTIF=2');

            DB::select("delete from tabtrans where TGL_TRANS='$request->inputtgloverbook' AND KUITANSI LIKE 'SYS%'");
            $brwsebngpjk = Tabungan::with('nasabah')
            ->select('NO_REKENING','NASABAH_ID','saldo_efektif_bln_ini','bunga_bln_ini','pajak_bln_ini','adm_bln_ini','saldo_hitung_pajak','saldo_nominatif','saldo_akhir')->where('STATUS_AKTIF','=',2)->get();
            // dd(Auth::id());
            for($i=0;$i<count($brwsebngpjk);$i++){
                // Insert Bunga
                $tabtrans = new Tabtran;
                $tabtrans->TGL_TRANS=$request->inputtgloverbook;
                $tabtrans->NO_REKENING=$brwsebngpjk[$i]->NO_REKENING;
                $tabtrans->KODE_TRANS=$request->kode_trans_bunga;
                $tabtrans->SALDO_TRANS=$brwsebngpjk[$i]->bunga_bln_ini;
                $tabtrans->MY_KODE_TRANS='110';
                $tabtrans->USERID=Auth::id();
                $tabtrans->KUITANSI='SYS-BUNGA';
                $tabtrans->TOB = 'O';
                $tabtrans->POSTED = '0';
                $tabtrans->VALIDATED = '1';
                $tabtrans->save();
                // Insert admin
                if($brwsebngpjk[$i]->adm_bln_ini>0){
                    $tabtrans = new Tabtran;
                    $tabtrans->TGL_TRANS=$request->inputtgloverbook;
                    $tabtrans->NO_REKENING=$brwsebngpjk[$i]->NO_REKENING;
                    $tabtrans->KODE_TRANS=$request->kode_trans_adm;
                    $tabtrans->SALDO_TRANS=$brwsebngpjk[$i]->adm_bln_ini;
                    $tabtrans->MY_KODE_TRANS='275';
                    $tabtrans->USERID=Auth::id();
                    $tabtrans->KUITANSI='SYS-ADM';
                    $tabtrans->TOB = 'O';
                    $tabtrans->POSTED = '0';
                    $tabtrans->VALIDATED = '1';
                    $tabtrans->save();    
                }
                // Insert pajak
                if($brwsebngpjk[$i]->pajak_bln_ini>0){
                    $tabtrans = new Tabtran;
                    $tabtrans->TGL_TRANS=$request->inputtgloverbook;
                    $tabtrans->NO_REKENING=$brwsebngpjk[$i]->NO_REKENING;
                    $tabtrans->KODE_TRANS=$request->kode_trans_pajak;
                    $tabtrans->SALDO_TRANS=$brwsebngpjk[$i]->pajak_bln_ini;
                    $tabtrans->MY_KODE_TRANS='210';
                    $tabtrans->USERID=Auth::id();
                    $tabtrans->KUITANSI='SYS-PAJAK';
                    $tabtrans->TOB = 'O';
                    $tabtrans->POSTED = '0';
                    $tabtrans->VALIDATED = '1';
                    $tabtrans->save();
                    // untuk nentuin msg
                    $xx = $tabtrans->save();
                }
            }
            if($xx){
                $msg='1';
            }else{$msg='0';}
            return redirect()->back()->with('alert','OVER BOOK BERHASIL');

        }
        else{
            DB::select('UPDATE tabung SET SALDO_SETORAN=(SALDO_SETORAN+BUNGA_BLN_INI),SALDO_PENARIKAN=(SALDO_PENARIKAN+ADM_BLN_INI+PAJAK_BLN_INI),SALDO_AKHIR=(SALDO_AKHIR+BUNGA_BLN_INI-ADM_BLN_INI-PAJAK_BLN_INI) where STATUS_AKTIF=2');

            // Insert BUNGA,ADMIN DAN PAJAK KE TABTRANS
            $brwsebngpjk = Tabungan::with('nasabah')
            ->select('NO_REKENING','NASABAH_ID','saldo_efektif_bln_ini','bunga_bln_ini','pajak_bln_ini','adm_bln_ini','saldo_hitung_pajak','saldo_nominatif','saldo_akhir')->where('STATUS_AKTIF','=',2)->get();
            // dd(Auth::id());
            for($i=0;$i<count($brwsebngpjk);$i++){
                // Insert Bunga
                $tabtrans = new Tabtran;
                $tabtrans->TGL_TRANS=$request->inputtgloverbook;
                $tabtrans->NO_REKENING=$brwsebngpjk[$i]->NO_REKENING;
                $tabtrans->KODE_TRANS=$request->kode_trans_bunga;
                $tabtrans->SALDO_TRANS=$brwsebngpjk[$i]->bunga_bln_ini;
                $tabtrans->MY_KODE_TRANS='110';
                $tabtrans->USERID=Auth::id();
                $tabtrans->KUITANSI='SYS-BUNGA';
                $tabtrans->TOB = 'O';
                $tabtrans->POSTED = '0';
                $tabtrans->VALIDATED = '1';
                $tabtrans->save();
                // Insert admin
                if($brwsebngpjk[$i]->adm_bln_ini>0){
                    $tabtrans = new Tabtran;
                    $tabtrans->TGL_TRANS=$request->inputtgloverbook;
                    $tabtrans->NO_REKENING=$brwsebngpjk[$i]->NO_REKENING;
                    $tabtrans->KODE_TRANS=$request->kode_trans_adm;
                    $tabtrans->SALDO_TRANS=$brwsebngpjk[$i]->adm_bln_ini;
                    $tabtrans->MY_KODE_TRANS='275';
                    $tabtrans->USERID=Auth::id();
                    $tabtrans->KUITANSI='SYS-ADM';
                    $tabtrans->TOB = 'O';
                    $tabtrans->POSTED = '0';
                    $tabtrans->VALIDATED = '1';
                    $tabtrans->save();    
                }
                // Insert pajak
                if($brwsebngpjk[$i]->pajak_bln_ini>0){
                    $tabtrans = new Tabtran;
                    $tabtrans->TGL_TRANS=$request->inputtgloverbook;
                    $tabtrans->NO_REKENING=$brwsebngpjk[$i]->NO_REKENING;
                    $tabtrans->KODE_TRANS=$request->kode_trans_pajak;
                    $tabtrans->SALDO_TRANS=$brwsebngpjk[$i]->pajak_bln_ini;
                    $tabtrans->MY_KODE_TRANS='210';
                    $tabtrans->USERID=Auth::id();
                    $tabtrans->KUITANSI='SYS-PAJAK';
                    $tabtrans->TOB = 'O';
                    $tabtrans->POSTED = '0';
                    $tabtrans->VALIDATED = '1';
                    $tabtrans->save();
                    // untuk nentuin msg
                    $xx = $tabtrans->save();
                }
            }

            if($xx){
                $msg='1';
            }else{$msg='0';}
            return redirect()->back()->with('alert','OVER BOOK BERHASIL');
        }
    }
    public function bo_tb_de_showfrmblokir()
    {
        $users = User::all();
        $logos = Logo::all();
        $tabungan=DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,tabung.SALDO_AKHIR,tabung.BLOKIR,tabung.SALDO_BLOKIR,tabung.TGL_BLOKIR,tabung.TGL_UNBLOKIR FROM (tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN");

        return view('admin.tabungan.frmblokirtab',['users'=>$users,'logos'=>$logos,'tabungan'=>$tabungan,'msgstatus'=>'']);
    }
    // Simpan Blokir
    public function bo_tb_de_simpanblokirtab(Request $request)
    {
        // dd($request);
        $users = User::all();
        $logos = Logo::all();
        $simpan = Tabungan::where('NO_REKENING','=',$request->no_rekening)
                    ->update(
                        [
                            'SALDO_BLOKIR'=>(float)preg_replace("/[^0-9]/", "", $request->jml_blokir),
                            'TGL_BLOKIR'=>$request->inputtglblokir,
                            'BLOKIR'=>1
                        ]
                    );
                    // dd($simpan);
        if($simpan){
            $msg='1';
        }
        else{
            $msg='0';
        }
        $tabungan=DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,tabung.SALDO_AKHIR,tabung.BLOKIR,tabung.SALDO_BLOKIR,tabung.TGL_BLOKIR,tabung.TGL_UNBLOKIR FROM (tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN limit 25");

        return view('admin.tabungan.frmblokirtab',['users'=>$users,'logos'=>$logos,'tabungan'=>$tabungan,'msgstatus'=>$msg]);
    }
    // munculin form unblokir dgn listnya
    public function bo_tb_de_showfrmunblokir()
    {
        $users = User::all();
        $logos = Logo::all();
        $tabungan=DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,tabung.SALDO_AKHIR,tabung.BLOKIR,tabung.SALDO_BLOKIR,tabung.TGL_BLOKIR FROM (tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN where tabung.BLOKIR=1");

        return view('admin.tabungan.frmunblokirtab',['users'=>$users,'logos'=>$logos,'tabungan'=>$tabungan,'msgstatus'=>'']);

    }
    public function bo_adm_update_unblokir(Request $request)
    {
        $logos = Logo::all();
        $users = User::all();
        $updunblokir = Tabungan::where('NO_REKENING',$request->no_rekening)
        ->update([
            'BLOKIR'=>'0',
            'TGL_UNBLOKIR'=>date('Y-m-d'),
            'TGL_BLOKIR'=>'0000-00-00',
            'SALDO_BLOKIR'=>0,

        ]);
        if($updunblokir){
            $msg='1';
        }else{
            $msg='0';
        }
        $tabungan=DB::select("SELECT tabung.NO_REKENING,nasabah.nama_nasabah,nasabah.alamat,tabung.JENIS_TABUNGAN,kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN,tabung.SALDO_AKHIR,tabung.BLOKIR,tabung.SALDO_BLOKIR,tabung.TGL_BLOKIR FROM (tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN=kodejenistabungan.KODE_JENIS_TABUNGAN where tabung.BLOKIR=1");

        return view('admin.tabungan.frmunblokirtab',['logos'=>$logos,'users'=>$users,'tabungan'=>$tabungan,'msgstatus'=>$msg]);
    }

    public function bo_tb_rpt_tabunganblokir()
    {
        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        return view('reports.frmsearchblokir',['users'=>$users,'logos'=>$logos]);
    }
    public function bo_tb_rpt_tabunganblokirview(Request $request)
    {
        // dd($request);
        $logos = Logo::all();
        $users = User::all();
        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();

        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        $this->validate($request,[
            'tgl_nominatif'=>'required'
        ]);
        $nomblokir=Tabungan::with('nasabah')
        ->where('STATUS_AKTIF','=',2)
        ->where('BLOKIR',1)
        ->where('TGL_BLOKIR','<=',$inputantgl)
        ->get();

        // $nomblokir=DB::select($sql);
        return view ('reports.rpttabblokir',['nominatif'=>$nomblokir,'logos'=>$logos,'users'=>$users,'tgllogin'=>$tgllogin,'inputantgl'=>$inputantgl]);

    }
    // munculin halaman unutk cetak nasabah yang diblokir tabungannya
    public function bo_tb_rpt_pdftabblokir(Request $request)
    {
        $inputantgl=date('Y-m-d',strtotime($request->tgl_nominatif));
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_TAB'.'%'.'NAMA')->get();
        $sql="SELECT
        a.NO_REKENING,
        a.nama_nasabah,
        a.alamat,
        a.TGL_BLOKIR,
        a.SALDO_BLOKIR,
        (
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) +
        IF
        ( ISNULL( a.saldokreditblnlalu ), 0, a.saldokreditblnlalu ) -
        IF
        ( ISNULL( a.saldodebetblnlalu ), 0, a.saldodebetblnlalu ) 
        ) AS saldo_bln_lalu,
        IF
        ( ISNULL( a.mutasi_debet ), 0, a.mutasi_debet ) AS mutasi_debet,
        IF
        ( ISNULL( a.mutasi_kredit ), 0, a.mutasi_kredit ) AS mutasi_kredit,(
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
        ( ISNULL( a.saldodebet ), 0, a.saldodebet )) AS saldo_sbl_bunga,
        IF
        ( ISNULL( a.bungabln ), 0, a.bungabln ) AS bunga_bln_ini,
        IF
        ( ISNULL( a.pajakblnini ), 0, a.pajakblnini ) AS pajak_bln_ini,
        IF
        ( ISNULL( a.adminbln ), 0, a.adminbln ) AS admin_bln_ini,
        (
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
        ( ISNULL( a.saldodebet ), 0, a.saldodebet ) 
        ) AS saldo_nominatif,
        (
        IF
        ( ISNULL( a.SALDO_AWAL ), 0, a.SALDO_AWAL ) + a.saldokredit -
        IF
        ( ISNULL( a.saldodebet ), 0, a.saldodebet ) + IF
        ( ISNULL( a.bungabln ), 0, a.bungabln ) - IF
        ( ISNULL( a.adminbln ), 0, a.adminbln )- IF
        ( ISNULL( a.pajakblnini ), 0, a.pajakblnini )
        ) AS saldo_akhir
        FROM
        (
        SELECT
        tabung.NO_REKENING,
        nasabah.nama_nasabah,
        nasabah.alamat,
        tabung.SALDO_AWAL,
        tabung.BLOKIR,
        tabung.SALDO_BLOKIR,
        tabung.TGL_BLOKIR,
        tabung.SALDO_EFEKTIF_BLN_INI,
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
        tabung.BUNGA_BLN_INI AS bungabln,
        tabung.PAJAK_BLN_INI AS pajakblnini,
        tabung.ADM_BLN_INI AS adminbln,
        mutasikredit.mutasi_kredit,
        mutasidebet.mutasi_debet,
        sldkrdblnlalu.saldokreditblnlalu,
        slddbtblnlalu.saldodebetblnlalu 
        FROM
        (((((((
        tabung
        INNER JOIN nasabah ON tabung.NASABAH_ID = nasabah.nasabah_id 
        )
        INNER JOIN kodejenistabungan ON tabung.JENIS_TABUNGAN = kodejenistabungan.KODE_JENIS_TABUNGAN 
        )
        INNER JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) x ON tabung.NO_REKENING = x.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= date( '$inputantgl' ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) y ON tabung.NO_REKENING = y.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldokreditblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) sldkrdblnlalu ON tabung.NO_REKENING = sldkrdblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS saldodebetblnlalu 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND tabtrans.tgl_trans <= DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) slddbtblnlalu ON tabung.NO_REKENING = slddbtblnlalu.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_kredit 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '1%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasikredit ON tabung.NO_REKENING = mutasikredit.NO_REKENING 
        )
        LEFT JOIN (
        SELECT
        NO_REKENING,
        sum( saldo_trans ) AS mutasi_debet 
        FROM
        tabtrans 
        WHERE
        MY_KODE_TRANS LIKE '2%' 
        AND (
        tabtrans.tgl_trans > DATE_ADD( '$inputantgl', INTERVAL - DAY ( date( '$inputantgl' )) DAY ) 
        AND tabtrans.tgl_trans <= date( '$inputantgl' )) 
        GROUP BY
        tabtrans.NO_REKENING 
        ) mutasidebet ON tabung.NO_REKENING = mutasidebet.NO_REKENING 
        WHERE
        tabung.STATUS_AKTIF <> 1 
        AND (
        IF
        ( ISNULL( tabung.SALDO_AWAL ), 0, tabung.SALDO_AWAL ) + x.saldokredit -
        IF
        ( ISNULL( y.saldodebet ), 0, y.saldodebet ) 
        )>0
        ) a WHERE a.BLOKIR=1 AND a.TGL_BLOKIR<='$inputantgl'";
        $count=DB::select('select count(*) as aggregate from('.$sql.') aa');
        $count=$count[0]->aggregate;
        // dd($count);
        $nominatif=DB::select($sql);
        return view('pdf.cetaktabungandiblokir',['nominatif'=>$nominatif,'lembaga'=>$lembaga,'ttd'=>$ttd]);         

    }

    public function bo_tb_rpt_frmtransaksi()
    {
        $logos = Logo::all();

        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $tabtran = Tabtran::with('nasabah')->where('TGL_TRANS','=',date('Y-m-d',strtotime(substr($tgllogin[0]->Value,3,2).'/'.substr($tgllogin[0]->Value,0,2).'/'.substr($tgllogin[0]->Value,6,4))))->get();
        for($i=0;$i<count($tabtran);$i++)
        {
            //UPDATE NO_REKENING yang terdapat SPASI di table TABUNG
            if(count($tabtran[$i]->nasabah)==0)
            {
                DB::select('update tabung set NO_REKENING=REPLACE(NO_REKENING," ","") where NO_REKENING='."'".$tabtran[$i]->NO_REKENING."'");
            }
        }
        $tabtran = Tabtran::with('nasabah')->where('TGL_TRANS','=',date('Y-m-d',strtotime(substr($tgllogin[0]->Value,3,2).'/'.substr($tgllogin[0]->Value,0,2).'/'.substr($tgllogin[0]->Value,6,4))))->get();

        return view('reports.frmrpttransaksi',['logos'=>$logos,'tgllogin'=>$tgllogin,'tabtran'=>$tabtran]);

    }
    public function bo_tb_rpt_caritransaksi(Request $request)
    {
        $logos = Logo::all();
        $inputantgl1=date('Y-m-d',strtotime($request->tgl_trans1));
        $inputantgl2=date('Y-m-d',strtotime($request->tgl_trans2));

        $tgllogin=Mysysid::where('KeyName','=','TANGGALHARIINI')->get();
        $nominatif = Tabtran::with('nasabah')->where('TGL_TRANS','>=',$request->tgl_trans1)->where('TGL_TRANS','<=',$request->tgl_trans2)->get();
        for($i=0;$i<count($nominatif);$i++)
        {
            //UPDATE NO_REKENING yang terdapat SPASI di table TABUNG
            if(count($nominatif[$i]->nasabah)==0)
            {
                DB::select('update tabung set NO_REKENING=REPLACE(NO_REKENING," ","") where NO_REKENING='."'".$nominatif[$i]->NO_REKENING."'");
            }
        }
        $nominatif = Tabtran::with('nasabah')->where('TGL_TRANS','>=',$request->tgl_trans1)->where('TGL_TRANS','<=',$request->tgl_trans2)->get();

        return view('reports.frmcetakrpttransaksi',['logos'=>$logos,'tgllogin'=>$tgllogin,'nominatif'=>$nominatif,'inputantgl1'=>$inputantgl1,'inputantgl2'=>$inputantgl2,]);
    }
    // Cetak PDF Transaksi
    public function bo_tb_rpt_pdftransaksi(Request $request)
    {
        // dd($request);
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_TAB'.'%'.'NAMA')->get();
        $logos = Logo::all();
        $users = User::all();
        $nominatif = Tabtran::with('nasabah')->where('TGL_TRANS','>=',$request->tgl_trans1)->where('TGL_TRANS','<=',$request->tgl_trans2)->get();

        return view('pdf.cetaktransaksitabungan',['users'=>$users,'logos'=>$logos,'nominatif'=>$nominatif,'ttd'=>$ttd,'lembaga'=>$lembaga]);
    }
    // export transaksi tabungan ke excel
    public function exporttoexceltransaksitab(Request $request)
    {
        $tgl1 = date('Y-m-d',strtotime($request->query('tgl_transx1')));
        $tgl2 = date('Y-m-d',strtotime($request->query('tgl_transx2')));
        $sql ="select tabung.no_rekening,nasabah.nama_nasabah,tabung.jenis_tabungan,tabung.kode_group1,tabung.kode_group2,tabung.kode_group3,tabtrans.tabtrans_id,tabtrans.tgl_trans,tabtrans.saldo_trans,tabtrans.kode_trans,tabtrans.kuitansi,tabtrans.my_kode_trans,tabtrans.tob,tabtrans.posted,tabtrans.validated from (tabung inner join tabtrans on tabung.no_rekening=tabtrans.no_rekening) inner join nasabah on tabung.nasabah_id=nasabah.nasabah_id where tabtrans.tgl_trans>='$tgl1' AND tabtrans.tgl_trans<='$tgl2'";
        $nominatif = DB::select($sql);
        return (new ReporttransaksitabunganExport($nominatif))->download('transaksitabungan.xlsx');

    }
    // export tabunganblokir ke excel
    public function exporttoexceltabblokir(Request $request)
    {
        $tgl = date('Y-m-d',strtotime($request->query('tgl_transx')));
        $sql="select tabung.no_rekening,nasabah.nama_nasabah,tabung.jenis_tabungan,tabung.kode_group1,tabung.kode_group2,tabung.kode_group3,tabung.saldo_blokir,tabung.tgl_blokir from tabung inner join nasabah on tabung.nasabah_id=nasabah.nasabah_id where tabung.blokir=1 AND tabung.tgl_blokir<='$tgl'";
        $nominatif = DB::select($sql);
        return (new ReporttabunganblokirExport($nominatif))->download('tabunganblokir.xlsx');
    }
    // Export to excel browse bunga pajak
    public function exporttoexcelbungapajaktabungan(Request $request)
    {
        $sql="select tabung.no_rekening,nasabah.nama_nasabah,tabung.jenis_tabungan,tabung.bunga_bln_ini,tabung.adm_bln_ini,tabung.pajak_bln_ini,tabung.saldo_efektif_bln_ini,tabung.saldo_hitung_pajak,tabung.saldo_nominatif,tabung.saldo_akhir from tabung inner join nasabah on tabung.nasabah_id=nasabah.nasabah_id where tabung.status_aktif=2";

        $brwsebngpjk = DB::select($sql);
        return (new ReportbungapajakExport($brwsebngpjk))->download('bungadanpajaktabungan.xlsx');
    }
// Form search nominatif per jenis
    public function bo_tb_rpt_nominatijenis()
    {
        $users = User::all();
        $logos = Logo::all();
        $kodejenis = Kodejenistabungan::all();
        return view('reports.frmsearchnomtabjenis',['users'=>$users,'logos'=>$logos,'kodejenis'=>$kodejenis]);
    }
    public function bo_tb_rpt_nominatifperjenisview(Request $request)
    {   
        $logos=Logo::all();
        $users = User::all();
        $jenistab = substr($request->jenis_tabungan,0,2);
        $deskripsijenis = $request->jenis_tabungan;
        $tgl_nom = $request->tgl_nominatif;
        $sql = "SELECT tabung.no_rekening,nasabah.nama_nasabah,nasabah.alamat,tabung.TGL_REGISTRASI,tabung.SUKU_BUNGA,saldo.SALDO_AKHIR,maxtgl.tgl_terakhir_trans FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT tabung.no_rekening,(tabung.SALDO_AWAL+SUM(if(tabtrans.MY_KODE_TRANS LIKE '1%' AND tabtrans.TGL_TRANS<='$tgl_nom',tabtrans.SALDO_TRANS,0))-SUM(if(tabtrans.MY_KODE_TRANS LIKE '2%' AND tabtrans.TGL_TRANS<='$tgl_nom',tabtrans.SALDO_TRANS,0))) as SALDO_AKHIR FROM tabung INNER JOIN tabtrans ON tabung.NO_REKENING=tabtrans.NO_REKENING WHERE tabung.STATUS_AKTIF=2 GROUP BY tabung.NO_REKENING) as saldo ON tabung.NO_REKENING=saldo.no_rekening) INNER JOIN(select NO_REKENING,MAX(tgl_trans) as tgl_terakhir_trans from tabtrans where (MY_KODE_TRANS=100 OR MY_KODE_TRANS=200) GROUP BY NO_REKENING) as maxtgl ON tabung.NO_REKENING=maxtgl.NO_REKENING WHERE tabung.STATUS_AKTIF=2 AND tabung.JENIS_TABUNGAN='$jenistab' AND tabung.TGL_MULAI<='$tgl_nom'";
        // dd($sql);
        $nominatif = DB::select($sql);
        
        return view('reports.rptnominatifjenistab',['logos'=>$logos,'users'=>$users,'nominatif'=>$nominatif,'tgl_nom'=>$tgl_nom,'jenistab'=>$jenistab,'deskripsijenis'=>$deskripsijenis]);
    }

    public function cetaknomtabunganperjenis(Request $request)
    {
        $tgl_nom = $request->tgl_nominatif;
        $jenistab = $request->jenistab;
        $desc = $request->desc;
        $lembaga=DB::table('mysysid')->select('KeyName','Value')->where('KeyName','like','NAMA_LEMBAGA'.'%')->get();
        $ttd=DB::table('mysysid')->select('KeyName','Value')->where('KeyName', 'like','TTD_TAB'.'%'.'NAMA')->get();

        $sql = "SELECT tabung.no_rekening,nasabah.nama_nasabah,nasabah.alamat,tabung.TGL_REGISTRASI,tabung.SUKU_BUNGA,saldo.SALDO_AKHIR FROM (tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT tabung.no_rekening,(tabung.SALDO_AWAL+SUM(if(tabtrans.MY_KODE_TRANS LIKE '1%' AND tabtrans.TGL_TRANS<='$tgl_nom',tabtrans.SALDO_TRANS,0))-SUM(if(tabtrans.MY_KODE_TRANS LIKE '2%' AND tabtrans.TGL_TRANS<='$tgl_nom',tabtrans.SALDO_TRANS,0))) as SALDO_AKHIR FROM tabung INNER JOIN tabtrans ON tabung.NO_REKENING=tabtrans.NO_REKENING WHERE tabung.STATUS_AKTIF=2 GROUP BY tabung.NO_REKENING) as saldo ON tabung.NO_REKENING=saldo.no_rekening WHERE tabung.STATUS_AKTIF=2 AND tabung.JENIS_TABUNGAN='$jenistab' AND tabung.TGL_MULAI<='$tgl_nom'";
        $nominatif=DB::select($sql);
        return view('pdf.cetaknomperjenistab',['nominatif'=>$nominatif,'tgl_nom'=>$tgl_nom,'desc'=>$desc,'lembaga'=>$lembaga,'ttd'=>$ttd]);
    }
    // EXPORT NOMINATIF PERJENI KE EXCEL
    public function nominatifperjeniseksport(Request $request)
    {   
        $jenistab = substr($request->jenis_tabungan,0,2);
        $tgl_nom = $request->tgl_nominatif;
        $sql = "SELECT tabung.no_rekening,nasabah.nama_nasabah,nasabah.alamat,tabung.TGL_REGISTRASI,tabung.SUKU_BUNGA,saldo.SALDO_AKHIR,maxtgl.tgl_terakhir_trans FROM ((tabung INNER JOIN nasabah ON tabung.NASABAH_ID=nasabah.nasabah_id) INNER JOIN (SELECT tabung.no_rekening,(tabung.SALDO_AWAL+SUM(if(tabtrans.MY_KODE_TRANS LIKE '1%' AND tabtrans.TGL_TRANS<='$tgl_nom',tabtrans.SALDO_TRANS,0))-SUM(if(tabtrans.MY_KODE_TRANS LIKE '2%' AND tabtrans.TGL_TRANS<='$tgl_nom',tabtrans.SALDO_TRANS,0))) as SALDO_AKHIR FROM tabung INNER JOIN tabtrans ON tabung.NO_REKENING=tabtrans.NO_REKENING WHERE tabung.STATUS_AKTIF=2 GROUP BY tabung.NO_REKENING) as saldo ON tabung.NO_REKENING=saldo.no_rekening) INNER JOIN(select NO_REKENING,MAX(tgl_trans) as tgl_terakhir_trans from tabtrans where (MY_KODE_TRANS=100 OR MY_KODE_TRANS=200) GROUP BY NO_REKENING) as maxtgl ON tabung.NO_REKENING=maxtgl.NO_REKENING WHERE tabung.STATUS_AKTIF=2 AND tabung.JENIS_TABUNGAN='$jenistab' AND tabung.TGL_MULAI<='$tgl_nom'";
        $nominatif = DB::select($sql);
        return (new ReporttabunganperjenisExport($nominatif))->download('nominatiftabperjenis.xlsx');
    }
}