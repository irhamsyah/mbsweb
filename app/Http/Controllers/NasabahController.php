<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Nasabah;
use App\Identitas;
use App\KodeGroup1Nasabah;
use App\Perkawinan;
use App\Negara;
use App\Kota;
use App\Gelar;
use App\Pekerjaan;
use App\HubunganDebitur;
use App\GolonganDebitur;
use App\BidangUsaha;
use App\Kredit;
use App\Tabungan;
use App\Logo;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use App;
use Auth;
use Validator;
use Hash;
use Image;
use Mail;
use PDF;

class NasabahController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Untuk munculkan home setelah register user
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function bo_cs_de_nasabah()
    {
      $logos = Logo::all();
      $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id','ASC')->get();
      $nasabahsearchs = Nasabah::select('nama_nasabah')->orderby('nasabah.nasabah_id','ASC')->get();
      $users = User::all();
      $identitass = Identitas::all();
      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $perkawinans = Perkawinan::all();
      $negaras = Negara::all();
      $kotas = Kota::all();
      $gelars = Gelar::all();
      $pekerjaans = Pekerjaan::all();
      $bidangusahas = BidangUsaha::all();
      $hubungandebiturs = HubunganDebitur::all();
      $golongandebiturs = GolonganDebitur::all();
      $lastnasabahid = Nasabah::max('nasabah_id');

      return view('admin/nasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs,'identitass'=> $identitass,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'perkawinans'=> $perkawinans,'negaras'=> $negaras,'kotas'=> $kotas,'pekerjaans'=> $pekerjaans,'gelars'=> $gelars,
      'bidangusahas'=> $bidangusahas,'hubungandebiturs'=> $hubungandebiturs,'golongandebiturs'=> $golongandebiturs,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> '']);
    }
    public function bo_cs_de_nasabah_cari(Request $request)
    {
      $logos = Logo::all();

      $nasabahs = Nasabah::where('nasabah_id', 'LIKE', '%' . request()->idnasabah1 . '%')
      ->when(request()->namanasabah1, function($query) {
        $query->where('nama_nasabah', 'LIKE', '%' . request()->namanasabah1 . '%');
      })
      ->when(request()->jenisnasabah1, function($query) {
        $query->where('jenis_nasabah', request()->jenisnasabah1);
      })
      ->limit(100)->orderby('nasabah.nasabah_id','ASC')->get();

      $users = User::all();
      $identitass = Identitas::all();
      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $perkawinans = Perkawinan::all();
      $negaras = Negara::all();
      $kotas = Kota::all();
      $gelars = Gelar::all();
      $pekerjaans = Pekerjaan::all();
      $bidangusahas = BidangUsaha::all();
      $hubungandebiturs = HubunganDebitur::all();
      $golongandebiturs = GolonganDebitur::all();
      $lastnasabahid = Nasabah::max('nasabah_id');

      return view('admin/nasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs,'identitass'=> $identitass,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'perkawinans'=> $perkawinans,'negaras'=> $negaras,'kotas'=> $kotas,'pekerjaans'=> $pekerjaans,'gelars'=> $gelars,
      'bidangusahas'=> $bidangusahas,'hubungandebiturs'=> $hubungandebiturs,'golongandebiturs'=> $golongandebiturs,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> '']);
    }

    public function bo_cs_de_nasabah_add(Request $request)
    {
      $logos = Logo::all();
      //cek validasi image
      $this->validate($request, [
        'inputFoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'inputtandatangan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      //upload image to directory
      if ($request->hasFile('inputFoto')) {
          $imagefoto = $request->file('inputFoto');
          $namefoto = 'foto'.time().'.'.$imagefoto->getClientOriginalExtension();
          $destinationPathfoto = $_SERVER['DOCUMENT_ROOT'].'/img/foto';
          $imagefoto->move($destinationPathfoto, $namefoto);
      }
      if ($request->hasFile('inputtandatangan')) {
        $imagettangan = $request->file('inputtandatangan');
        $namettangan = 'ttangan'.time().'.'.$imagettangan->getClientOriginalExtension();
        $destinationPathttangan = $_SERVER['DOCUMENT_ROOT'].'/img/ttangan';
        $imagettangan->move($destinationPathttangan, $namettangan);
      }
      $isChecked = $request->has('inputblacklist');
      $statuskawin = substr($request->inputkawin,1,1);
      $nasabahs = new Nasabah;
      $nasabahs->NO_DIN = $request->inputdin;
      $nasabahs->nasabah_id = trim($request->inputnasabahid);
      $nasabahs->CAB = $request->inputcab;
      $nasabahs->cif = $request->inputnocif;
      $nasabahs->Black_List = $isChecked;
      $nasabahs->nama_nasabah = $request->inputnamanasabah;
      $nasabahs->nama_alias = $request->inputalias;
      $nasabahs->tempatlahir = $request->inputtempatlahir;
      $nasabahs->tgllahir = $request->inputtgllahir;
      $nasabahs->jenis_kelamin = $request->inputjk;
      $nasabahs->IBU_KANDUNG = $request->inputibukandung;
      $nasabahs->npwp = $request->inputnpwp;
      $nasabahs->jenis_id = $request->inputidentitas;
      $nasabahs->no_id = $request->inputnoidentitas;
      $nasabahs->tglid = $request->inputmasaberlaku;
      $nasabahs->NASABAH_GROUP1 = $request->inputagama;
      $nasabahs->status_kawin = $statuskawin;
      $nasabahs->ALAMAT_DOMISILI = $request->inputdomisili;
      $nasabahs->kode_area = $request->inputkodetlp;
      $nasabahs->telpon = $request->inputnotlp;
      $nasabahs->NO_HP = $request->inputnohp;
      $nasabahs->alamat = $request->inputalamat;
      $nasabahs->kelurahan = $request->inputkelurahan;
      $nasabahs->kecamatan = $request->inputkecamatan;
      $nasabahs->kode_pos = $request->inputkodepos;
      $nasabahs->kota_id = $request->inputkota;
      $nasabahs->Kode_Negara = $request->inputnegara;
      $nasabahs->Tempat_Kerja = $request->inputnamaperusahaan;
      $nasabahs->alamat_kantor = $request->inputalamatperusahaan;
      $nasabahs->pekerjaan_id = $request->inputpekerjaan;
      $nasabahs->pekerjaan = $request->inputdetpekerjaan;
      $nasabahs->kode_sumber_penghasilan = $request->inputsumberdana;
      $nasabahs->penghasilan_setahun = $request->inputpenghasilansetahun;
      $nasabahs->gelar_id = $request->inputgelar;
      $nasabahs->KET_GELAR = $request->inputdetgelar;
      $nasabahs->Kode_Bidang_Usaha = $request->inputbidangusahasid;
      $nasabahs->Kode_Hubungan_Debitur = $request->inputhubdebsid;
      $nasabahs->kode_golongan_debitur = $request->inputgoldebsid;
      $nasabahs->nama_pendamping = $request->inputnamapendamping;
      $nasabahs->id_pasangan = $request->inputidpendamping;
      $nasabahs->tgllhr_pasangan = $request->inputtgllahirpendamping;
      $nasabahs->jml_tanggungan = $request->inputjmltanggungan;
      $nasabahs->TUJUAN_PEMBUKAAN_KYC = $request->inputtujuanbukarek;
      $nasabahs->PENGGUNAAN_DANA_KYC = $request->inputpenggunaandana;
      $nasabahs->NAMA_KUASA = $request->inputnamaahliwaris;
      $nasabahs->ALAMAT_KUASA = $request->inputalamatahliwaris;
      $nasabahs->PATH_FOTO = $namefoto;
      $nasabahs->PATH_TTANGAN = $namettangan;
      $nasabahs->save();

      if ($nasabahs){
        $msg='1';
      }else{
        $msg='0';
      }

      $users = User::all();
      $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id','ASC')->get();
      $identitass = Identitas::all();
      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $perkawinans = Perkawinan::all();
      $negaras = Negara::all();
      $kotas = Kota::all();
      $gelars = Gelar::all();
      $pekerjaans = Pekerjaan::all();
      $bidangusahas = BidangUsaha::all();
      $hubungandebiturs = HubunganDebitur::all();
      $golongandebiturs = GolonganDebitur::all();
      $lastnasabahid = Nasabah::max('nasabah_id');

      return view('admin/nasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs,'identitass'=> $identitass,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'perkawinans'=> $perkawinans,'negaras'=> $negaras,'kotas'=> $kotas,'pekerjaans'=> $pekerjaans,'gelars'=> $gelars,
      'bidangusahas'=> $bidangusahas,'hubungandebiturs'=> $hubungandebiturs,'golongandebiturs'=> $golongandebiturs,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> $msg]);
    }

    public function bo_cs_de_nasabah_edit(Request $request)
    {
      $logos = Logo::all();
      if(md5($request->inputnasabahidedit.'Bast90') == $request->inputIdNasabahHashedit){
        if ($request->inputFotoedit!="" OR $request->inputFotoedit!=NULL){
          //cek validasi image
          $this->validate($request, [
            'inputFotoedit' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);
          //upload image to directory
          if ($request->hasFile('inputFotoedit')) {
              $imagefoto = $request->file('inputFotoedit');
              $namefoto = time().'.'.$imagefoto->getClientOriginalExtension();
              $destinationPathfoto = $_SERVER['DOCUMENT_ROOT'].'/img/foto';
              $imagefoto->move($destinationPathfoto, $namefoto);
              //delete file image from directory
              unlink($_SERVER['DOCUMENT_ROOT'].'/img/foto/'.$request->inputFotoeditold);
          }
        }else{
          $namefoto = $request->inputFotoeditold;
        }

        if ($request->inputtandatanganedit!="" OR $request->inputtandatanganedit!=NULL){
          //cek validasi image
          $this->validate($request, [
            'inputtandatanganedit' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);
          //upload image to directory
          if ($request->hasFile('inputtandatanganedit')) {
            $imagettangan = $request->file('inputtandatanganedit');
            $namettangan = time().'.'.$imagettangan->getClientOriginalExtension();
            $destinationPathttangan = $_SERVER['DOCUMENT_ROOT'].'/img/ttangan';
            $imagettangan->move($destinationPathttangan, $namettangan);
            //delete file image from directory
            unlink($_SERVER['DOCUMENT_ROOT'].'/img/ttangan/'.$request->inputtandatanganeditold);
          }
        }else{
          $namettangan = $request->inputtandatanganeditold;
        }

        $isCheckededit = $request->has('inputblacklistedit');
        $statuskawinedit = substr($request->inputkawinedit,1,1);
        //update Nasabah
        // $nasabahs = Nasabah::find($request->inputnasabahidedit);
        $nasabahs = Nasabah::where('nasabah_id', $request->inputnasabahidedit)->first();
        // dd($nasabahs);
        Nasabah::where('nasabah_id', $request->inputnasabahidedit)
            ->update(['NO_DIN' => $request->inputdinedit,
            'CAB' => $request->inputcabedit,
            'cif' => $request->inputnocifedit,
            'Black_List' => $isCheckededit,
            'nama_nasabah' => $request->inputnamanasabahedit,
            'nama_alias' => $request->inputaliasedit,
            'tempatlahir' => $request->inputtempatlahiredit,
            'tgllahir' => $request->inputtgllahiredit,
            'jenis_kelamin' => $request->inputjkedit,
            'IBU_KANDUNG' => $request->inputibukandungedit,
            'npwp' => $request->inputnpwpedit,
            'jenis_id' => $request->inputidentitasedit,
            'no_id' => $request->inputnoidentitasedit,
            'tglid' => $request->inputmasaberlakuedit,
            'NASABAH_GROUP1' => $request->inputagamaedit,
            'status_kawin' => $statuskawinedit,
            'ALAMAT_DOMISILI' => $request->inputdomisiliedit,
            'kode_area' => $request->inputkodetlpedit,
            'telpon' => $request->inputnotlpedit,
            'NO_HP' => $request->inputnohpedit,
            'alamat' => $request->inputalamatedit,
            'kelurahan' => $request->inputkelurahanedit,
            'kecamatan' => $request->inputkecamatanedit,
            'kode_pos' => $request->inputkodeposedit,
            'Kode_Negara' => $request->inputnegaraedit,
            'Tempat_Kerja' => $request->inputnamaperusahaanedit,
            'alamat_kantor' => $request->inputalamatperusahaanedit,
            'pekerjaan_id' => $request->inputpekerjaanedit,
            'pekerjaan' => $request->inputdetpekerjaanedit,
            'kode_sumber_penghasilan' => $request->inputsumberdanaedit,
            'penghasilan_setahun' => $request->inputpenghasilansetahunedit,
            'gelar_id' => $request->inputgelaredit,
            'KET_GELAR' => $request->inputdetgelaredit,
            'Kode_Bidang_Usaha' => $request->inputbidangusahasidedit,
            'Kode_Hubungan_Debitur' => $request->inputhubdebsidedit,
            'kode_golongan_debitur' => $request->inputgoldebsidedit,
            'nama_pendamping' => $request->inputnamapendampingedit,
            'id_pasangan' => $request->inputidpendampingedit,
            'tgllhr_pasangan' => $request->inputtgllahirpendampingedit,
            'jml_tanggungan' => $request->inputjmltanggunganedit,
            'TUJUAN_PEMBUKAAN_KYC' => $request->inputtujuanbukarekedit,
            'PENGGUNAAN_DANA_KYC' => $request->inputpenggunaandanaedit,
            'NAMA_KUASA' => $request->inputnamaahliwarisedit,
            'ALAMAT_KUASA' => $request->inputalamatahliwarisedit,
            'PATH_FOTO' => $namefoto,
            'PATH_TTANGAN' => $namettangan]
            );
        if ($nasabahs){
          $msg='1';
        }else{
          $msg='0';
        }
      }else{
        $msg='0';
      }

      $users = User::all();
      $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id','ASC')->get();
      $identitass = Identitas::all();
      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $perkawinans = Perkawinan::all();
      $negaras = Negara::all();
      $kotas = Kota::all();
      $gelars = Gelar::all();
      $pekerjaans = Pekerjaan::all();
      $bidangusahas = BidangUsaha::all();
      $hubungandebiturs = HubunganDebitur::all();
      $golongandebiturs = GolonganDebitur::all();
      $lastnasabahid = Nasabah::max('nasabah.nasabah_id');

      return view('admin/nasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs,'identitass'=> $identitass,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'perkawinans'=> $perkawinans,'negaras'=> $negaras,'kotas'=> $kotas,'pekerjaans'=> $pekerjaans,'gelars'=> $gelars,
      'bidangusahas'=> $bidangusahas,'hubungandebiturs'=> $hubungandebiturs,'golongandebiturs'=> $golongandebiturs,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> $msg]);
    }
    
    //Direct to Proses Delete Nasabah
    public function bo_cs_de_nasabah_destroy(Request $request)
    {
      if(md5($request->inputIdNasabahdel.'Bast90') == $request->inputIdNasabahdelhash){
        $proses_delete = Nasabah::where('nasabah_id',$request->inputIdNasabahdel)->delete();
        if ($proses_delete){
          $msg='1';
        }else{
          $msg='0';
        }
      }else{
        $msg='0';
      }
      $logos = Logo::all();
      $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id','ASC')->get();
      $users = User::all();
      $identitass = Identitas::all();
      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $perkawinans = Perkawinan::all();
      $negaras = Negara::all();
      $kotas = Kota::all();
      $gelars = Gelar::all();
      $pekerjaans = Pekerjaan::all();
      $bidangusahas = BidangUsaha::all();
      $hubungandebiturs = HubunganDebitur::all();
      $golongandebiturs = GolonganDebitur::all();
      $lastnasabahid = Nasabah::max('nasabah_id');
      
      return view('admin/nasabah', ['logos'=> $logos,'nasabahs'=> $nasabahs,'identitass'=> $identitass,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'perkawinans'=> $perkawinans,'negaras'=> $negaras,'kotas'=> $kotas,'pekerjaans'=> $pekerjaans,'gelars'=> $gelars,
      'bidangusahas'=> $bidangusahas,'hubungandebiturs'=> $hubungandebiturs,'golongandebiturs'=> $golongandebiturs,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> $msg]);
    }

    //Profil Nasabah Page
    public function bo_cs_de_profil()
    {
      $logos = Logo::all();
      $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id','ASC')->get();
      $lastnasabahid = Nasabah::max('nasabah_id');

      return view('admin/profil', ['logos'=> $logos,'nasabahs'=> $nasabahs,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> '']);
    }
    
    public function bo_cs_de_profil_cari(Request $request)
    {
      $logos = Logo::all();

      $nasabahs = Nasabah::where('nasabah_id', 'LIKE', '%' . $request->idnasabah1 . '%')
      ->when($request->namanasabah1, function($query) {
        $query->where('nama_nasabah', 'LIKE', '%' . $request->namanasabah1 . '%');
      })
      ->limit(20)->orderby('nasabah.nasabah_id','ASC')->get();
      $users = User::all();
      $lastnasabahid = Nasabah::max('nasabah_id');

      return view('admin/profil_cari', ['logos'=> $logos,'nasabahs'=> $nasabahs,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> '']);
    }

    public function bo_cs_de_profil_detail(Request $request)
    {
      $logos = Logo::all();
      $users = User::all();
      $lastnasabahid = Nasabah::max('nasabah_id');
      $nasabahs = Nasabah::where('nasabah_id', '=',$request->idnasabah);
      $kredits = Kredit::select('NO_REKENING','JENIS_PINJAMAN','POKOK_SALDO_REALISASI','POKOK_SALDO_AKHIR','DESKRIPSI_JENIS_KREDIT','NASABAH_ID')
      ->leftJoin('kodejeniskredit', function($join) {
        $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
      })
      ->where('kredit.NASABAH_ID', '=', $request->idnasabah)
      ->orderby('kredit.NO_REKENING','ASC')->get();
      if(!$kredits)
        abort('404');

      $tabungans = Tabungan::select('NO_REKENING','JENIS_TABUNGAN','SALDO_AKHIR','DESKRIPSI_JENIS_TABUNGAN','NASABAH_ID')
      ->leftJoin('kodejenistabungan', function($join) {
        $join->on('tabung.JENIS_TABUNGAN', '=', 'kodejenistabungan.KODE_JENIS_TABUNGAN');
      })
      ->where('tabung.NASABAH_ID', '=', $request->idnasabah)
      ->orderby('tabung.NO_REKENING','DESC')->get();
      if(!$tabungans)
      abort('404');

      return view('admin/profil_detail', ['logos'=> $logos,'nasabahs'=> $nasabahs,'kredits'=> $kredits,'tabungans'=> $tabungans,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> '']);
    }

    public function bo_cs_de_profil_kredit(Request $request)
    {
      $logos = Logo::all();
      $users = User::all();
      if($request->jenisprofil=='kredit'){
        $kredits = Kredit::select('kredit.*','kodejeniskredit.DESKRIPSI_JENIS_KREDIT','nasabah.*','kodegroup1kredit.DESKRIPSI_GROUP1',
        'kodegroup2kredit.DESKRIPSI_GROUP2','kodegroup3kredit.DESKRIPSI_GROUP3','kodegroup4kredit.DESKRIPSI_GROUP4','kodesumberdanakredit.DESKRIPSI_SUMBER_DANA',
        'kodetypekredit.DESKRIPSI_TYPE_KREDIT','kodesatuanwaktukredit.DESKRIPSI_SATUAN_WAKTU','kodejenispenggunaankredit.DESKRIPSI_JENIS_PENGGUNAAN','kodegoldebitur.DESKRIPSI_GOL_DEBITUR',
        'kodesektorekonomikredit.DESKRIPSI_SEKTOR_EKONOMI','kodegolpenjaminkredit.DESKRIPSI_GOL_PENJAMIN')
        ->leftJoin('kodejeniskredit', function($join) {
          $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
        })
        ->leftJoin('nasabah', function($join) {
          $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
        })
        ->leftJoin('kodegroup1kredit', function($join) {
          $join->on('kredit.KODE_GROUP1', '=', 'kodegroup1kredit.KODE_GROUP1');
        })
        ->leftJoin('kodegroup2kredit', function($join) {
          $join->on('kredit.KODE_GROUP2', '=', 'kodegroup2kredit.KODE_GROUP2');
        })
        ->leftJoin('kodegroup3kredit', function($join) {
          $join->on('kredit.KODE_GROUP3', '=', 'kodegroup3kredit.KODE_GROUP3');
        })
        ->leftJoin('kodegroup4kredit', function($join) {
          $join->on('kredit.KODE_GROUP4', '=', 'kodegroup4kredit.KODE_GROUP4');
        })
        ->leftJoin('kodesumberdanakredit', function($join) {
          $join->on('kredit.KODE_SUMBER_DANA', '=', 'kodesumberdanakredit.KODE_SUMBER_DANA');
        })
        ->leftJoin('kodesatuanwaktukredit', function($join) {
          $join->on('kredit.SATUAN_WAKTU_ANGSURAN', '=', 'kodesatuanwaktukredit.KODE_SATUAN_WAKTU');
        })
        ->leftJoin('kodetypekredit', function($join) {
          $join->on('kredit.TYPE_PINJAMAN', '=', 'kodetypekredit.KODE_TYPE_KREDIT');
        })
        ->leftJoin('kodejenispenggunaankredit', function($join) {
          $join->on('kredit.BI_JENIS_PENGGUNAAN', '=', 'kodejenispenggunaankredit.KODE_JENIS_PENGGUNAAN');
        })
        ->leftJoin('kodegoldebitur', function($join) {
          $join->on('kredit.BI_GOL_DEBITUR', '=', 'kodegoldebitur.KODE_GOL_DEBITUR');
        })
        ->leftJoin('kodesektorekonomikredit', function($join) {
          $join->on('kredit.BI_SEKTOR_EKONOMI', '=', 'kodesektorekonomikredit.KODE_SEKTOR_EKONOMI');
        })
        ->leftJoin('kodegolpenjaminkredit', function($join) {
          $join->on('kredit.BI_GOL_PENJAMIN', '=', 'kodegolpenjaminkredit.KODE_GOL_PENJAMIN');
        })
        ->where('kredit.NO_REKENING', '=', $request->idkredit)
        ->get();
        if(!$kredits)
          abort('404');
      }else if($request->jenisprofil=='tabungan'){
        $kredits = Tabungan::select('tabung.*','kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN','nasabah.*','kodegroup1tabung.DESKRIPSI_GROUP1',
        'kodegroup2tabung.DESKRIPSI_GROUP2','kodegroup3tabung.DESKRIPSI_GROUP3','kodemetoda.DESKRIPSI_METODA','golongan_pihaklawan.deskripsi_golongan')
        ->leftJoin('kodejenistabungan', function($join) {
          $join->on('tabung.JENIS_TABUNGAN', '=', 'kodejenistabungan.KODE_JENIS_TABUNGAN');
        })
        ->leftJoin('nasabah', function($join) {
          $join->on('tabung.NASABAH_ID', '=', 'nasabah.nasabah_id');
        })
        ->leftJoin('kodegroup1tabung', function($join) {
          $join->on('tabung.KODE_GROUP1', '=', 'kodegroup1tabung.KODE_GROUP1');
        })
        ->leftJoin('kodegroup2tabung', function($join) {
          $join->on('tabung.KODE_GROUP2', '=', 'kodegroup2tabung.KODE_GROUP2');
        })
        ->leftJoin('kodegroup3tabung', function($join) {
          $join->on('tabung.KODE_GROUP3', '=', 'kodegroup3tabung.KODE_GROUP3');
        })
        ->leftJoin('kodemetoda', function($join) {
          $join->on('tabung.KODE_BI_METODA', '=', 'kodemetoda.KODE_METODA');
        })
        ->leftJoin('golongan_pihaklawan', function($join) {
          $join->on('tabung.KODE_BI_PEMILIK', '=', 'golongan_pihaklawan.sandi');
        })
        ->where('tabung.NO_REKENING', '=', $request->idkredit)
        ->get();
        if(!$kredits)
        abort('404');
      }
      $jenisprofil=$request->jenisprofil;
      return view('admin/profil_kredit', ['logos'=> $logos,'kredits'=> $kredits,'jenisprofil'=> $jenisprofil,'msgstatus'=> '']);
    }


    public function bo_cs_de_simulasi()
    {
      $logos = Logo::all();
      $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id','ASC')->get();
      $users = User::all();
      $identitass = Identitas::all();
      $kodegroup1nasabahs = KodeGroup1Nasabah::all();
      $perkawinans = Perkawinan::all();
      $negaras = Negara::all();
      $kotas = Kota::all();
      $gelars = Gelar::all();
      $pekerjaans = Pekerjaan::all();
      $bidangusahas = BidangUsaha::all();
      $hubungandebiturs = HubunganDebitur::all();
      $golongandebiturs = GolonganDebitur::all();
      $lastnasabahid = Nasabah::max('nasabah_id');

      return view('admin/simulasi', ['logos'=> $logos,'nasabahs'=> $nasabahs,'identitass'=> $identitass,'kodegroup1nasabahs'=> $kodegroup1nasabahs,
      'perkawinans'=> $perkawinans,'negaras'=> $negaras,'kotas'=> $kotas,'pekerjaans'=> $pekerjaans,'gelars'=> $gelars,
      'bidangusahas'=> $bidangusahas,'hubungandebiturs'=> $hubungandebiturs,'golongandebiturs'=> $golongandebiturs,'lastnasabahid'=> $lastnasabahid,'msgstatus'=> '']);
    }
}