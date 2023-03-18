<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function bo_cs_de_tabungan()
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

}
