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
    $nasabahall = Nasabah::select('nasabah_id', 'nama_nasabah', 'alamat', 'no_id')->get();
    $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id', 'ASC')->get();
    $nasabahsearchs = Nasabah::select('nama_nasabah')->orderby('nasabah.nasabah_id', 'ASC')->get();
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

    return view('admin/nasabah', [
      'logos' => $logos, 'nasabahs' => $nasabahs, 'identitass' => $identitass, 'kodegroup1nasabahs' => $kodegroup1nasabahs,
      'perkawinans' => $perkawinans, 'negaras' => $negaras, 'kotas' => $kotas, 'pekerjaans' => $pekerjaans, 'gelars' => $gelars, 'nasabahall' => $nasabahall,
      'bidangusahas' => $bidangusahas, 'hubungandebiturs' => $hubungandebiturs, 'golongandebiturs' => $golongandebiturs, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => '', 'msgview' => ''
    ]);
  }
  public function bo_cs_de_nasabah_cari(Request $request)
  {
    $logos = Logo::all();

    $nasabahs = Nasabah::where('nasabah_id', 'LIKE', '%' . request()->idnasabah1 . '%')
      ->when(request()->namanasabah1, function ($query) {
        $query->where('nama_nasabah', 'LIKE', '%' . request()->namanasabah1 . '%');
      })
      ->when(request()->noktp1, function ($query) {
        $query->where('no_id', 'LIKE', '%' . request()->noktp1 . '%');
      })
      ->limit(100)->orderby('nasabah.nasabah_id', 'ASC')->get();

    $users = User::all();
    $nasabahall = Nasabah::select('nasabah_id', 'nama_nasabah', 'alamat', 'no_id')->get();
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

    return view('admin/nasabah', [
      'logos' => $logos, 'nasabahs' => $nasabahs, 'identitass' => $identitass, 'kodegroup1nasabahs' => $kodegroup1nasabahs,
      'perkawinans' => $perkawinans, 'negaras' => $negaras, 'kotas' => $kotas, 'pekerjaans' => $pekerjaans, 'gelars' => $gelars, 'nasabahall' => $nasabahall,
      'bidangusahas' => $bidangusahas, 'hubungandebiturs' => $hubungandebiturs, 'golongandebiturs' => $golongandebiturs, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => '', 'msgview' => ''
    ]);
  }

  public function bo_cs_de_nasabah_add(Request $request)
  {
    $logos = Logo::all();
    //cek validasi image
    $this->validate($request, [
      'inputFoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'inputtandatangan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);
    // dd($detkota);

    if (
      $request->inputnasabahid != '' && $request->inputnamanasabah != '' && $request->inputalias != '' && $request->inputalias != ''
      && $request->inputcab != '' && $request->inputnocif != '' && $request->inputtempatlahir != '' && $request->inputtgllahir != ''
      && $request->inputjk != '' && $request->inputibukandung != '' && $request->inputnpwp != '' && $request->inputidentitas != ''
      && $request->inputnoidentitas != '' && $request->inputagama != '' && $request->inputkawin != '' && $request->inputdomisili != ''
      && $request->inputalamat != '' && $request->inputnohp != '' && $request->inputalamat != '' && $request->inputkelurahan != ''
      && $request->inputkecamatan != '' && $request->inputkodepos != '' && $request->inputkota != '' && $request->inputnegara != ''
      && $request->inputnamaperusahaan != '' && $request->inputalamatperusahaan != '' && $request->inputpekerjaan != '' && $request->inputdetpekerjaan != ''
      && $request->inputsumberdana != '' && $request->inputpenghasilansetahun != '' && $request->inputgelar != '' && $request->inputdetgelar != ''
      && $request->inputbidangusahasid != '' && $request->inputhubdebsid != '' && $request->inputgoldebsid != '' && $request->inputnamapendamping != ''
      && $request->inputidpendamping != '' && $request->inputtgllahirpendamping != '' && $request->inputjmltanggungan != '' && $request->inputtujuanbukarek != ''
      && $request->inputpenggunaandana != '' && $request->inputnamaahliwaris != '' && $request->inputalamatahliwaris != '' && $request->inputhubahliwaris != ''
    ) {

      //upload image to directory
      if ($request->hasFile('inputFoto')) {
        $imagefoto = $request->file('inputFoto');
        $namefoto = 'foto' . time() . '.' . $imagefoto->getClientOriginalExtension();
        $destinationPathfoto = $_SERVER['DOCUMENT_ROOT'] . '/img/foto';
        $imagefoto->move($destinationPathfoto, $namefoto);
      }
      if ($request->hasFile('inputtandatangan')) {
        $imagettangan = $request->file('inputtandatangan');
        $namettangan = 'ttangan' . time() . '.' . $imagettangan->getClientOriginalExtension();
        $destinationPathttangan = $_SERVER['DOCUMENT_ROOT'] . '/img/ttangan';
        $imagettangan->move($destinationPathttangan, $namettangan);
      }
      $isChecked = $request->has('inputblacklist');
      $statuskawin = substr($request->inputkawin, 1, 1);

      //pecah id kota dan deskripsi kota
      $pecahKota = explode('|', $request->inputkota);
      $idkota = $pecahKota[0];
      $detkota = $pecahKota[1];

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
      if ($request->seumurhidup == "on") {
        $nasabahs->tglid = '3000-12-12';
      } else {
        $nasabahs->tglid = $request->inputmasaberlaku;
      }
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
      $nasabahs->kota_id = $idkota;
      $nasabahs->KOTA = $detkota;
      $nasabahs->Kode_Negara = $request->inputnegara;
      $nasabahs->Tempat_Kerja = $request->inputnamaperusahaan;
      $nasabahs->alamat_kantor = $request->inputalamatperusahaan;
      $nasabahs->pekerjaan_id = $request->inputpekerjaan;
      $nasabahs->pekerjaan = $request->inputdetpekerjaan;
      $nasabahs->KET_PEKERJAAN = $request->inputdetpekerjaan;
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
      $nasabahs->hub_ahli_waris = $request->inputhubahliwaris;
      $nasabahs->PATH_FOTO = $namefoto;
      $nasabahs->PATH_TTANGAN = $namettangan;
      $nasabahs->save();

      if ($nasabahs) {
        $msg = '1';
        $msgdetail = 'Proses Berhasil';
      } else {
        $msg = '0';
        $msgdetail = 'Proses Simpan Data Gagal!';
      }
    } else {
      $msg = '0';
      $msgdetail = 'Proses Gagal, Harap mengisi data dengan lengkap!';
    }


    $users = User::all();
    $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id', 'ASC')->get();
    $nasabahall = Nasabah::select('nasabah_id', 'nama_nasabah', 'alamat', 'no_id')->get();
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

    return view('admin/nasabah', [
      'logos' => $logos, 'nasabahs' => $nasabahs, 'identitass' => $identitass, 'kodegroup1nasabahs' => $kodegroup1nasabahs,
      'perkawinans' => $perkawinans, 'negaras' => $negaras, 'kotas' => $kotas, 'pekerjaans' => $pekerjaans, 'gelars' => $gelars, 'nasabahall' => $nasabahall,
      'bidangusahas' => $bidangusahas, 'hubungandebiturs' => $hubungandebiturs, 'golongandebiturs' => $golongandebiturs, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => $msg, 'msgview' => $msgdetail
    ]);
  }

  public function bo_cs_de_nasabah_edit(Request $request)
  {
    $logos = Logo::all();
    // dd(md5($request->inputnasabahidedit.'Bast90').'--'.$request->inputIdNasabahHashedit.'---'.md5('000001Bast90'));
    if (md5($request->inputnasabahidedit . 'Bast90') == $request->inputIdNasabahHashedit) {

      //update Nasabah
      // $nasabahs = Nasabah::find($request->inputnasabahidedit);
      $nasabahs = Nasabah::where('nasabah_id', $request->inputnasabahidedit)->first();
      // dd($request->inputkotaedit);
      if (
        $request->inputnamanasabahedit != '' && $request->inputaliasedit != '' && $request->inputpenggunaandanaedit != ''
        && $request->inputtempatlahiredit != '' && $request->inputtgllahiredit != '' && $request->inputjkedit != ''
        && $request->inputibukandungedit != '' && $request->inputnamaahliwarisedit != '' && $request->inputkawinedit != ''
        && $request->inputnpwpedit != '' && $request->inputidentitasedit != '' && $request->inputnoidentitasedit != ''
        && $request->inputmasaberlakuedit != '' && $request->inputagamaedit != '' && $request->inputkotaedit != ''
        && $request->inputdomisiliedit != '' && $request->inputnohpedit != '' && $request->inputalamatedit != ''
        && $request->inputkelurahanedit != '' && $request->inputkecamatanedit != '' && $request->inputkodeposedit != ''
        && $request->inputnegaraedit != '' && $request->inputnamaperusahaanedit != '' && $request->inputalamatperusahaanedit != ''
        && $request->inputpekerjaanedit != '' && $request->inputdetpekerjaanedit != '' && $request->inputsumberdanaedit != ''
        && $request->inputpenghasilansetahunedit != '' && $request->inputgelaredit != '' && $request->inputdetgelaredit != ''
        && $request->inputbidangusahasidedit != '' && $request->inputhubdebsidedit != '' && $request->inputgoldebsidedit != ''
        && $request->inputnamapendampingedit != '' && $request->inputidpendampingedit != '' && $request->inputtgllahirpendampingedit != ''
        && $request->inputjmltanggunganedit != '' && $request->inputtujuanbukarekedit != '' && $request->inputalamatahliwarisedit != ''
        && $request->inputhubahliwarisedit != ''
      ) {

        if ($request->inputFotoedit != "" or $request->inputFotoedit != NULL) {
          //cek validasi image
          $this->validate($request, [
            'inputFotoedit' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);
          //upload image to directory
          if ($request->hasFile('inputFotoedit')) {
            $imagefoto = $request->file('inputFotoedit');
            $namefoto = 'foto' . time() . '.' . $imagefoto->getClientOriginalExtension();
            $destinationPathfoto = $_SERVER['DOCUMENT_ROOT'] . '/img/foto';
            $imagefoto->move($destinationPathfoto, $namefoto);
            //delete file image from directory
            if ($request->inputFotoeditold != NULL) {
              unlink($_SERVER['DOCUMENT_ROOT'] . '/img/foto/' . $request->inputFotoeditold);
            }
          }
        } else {
          $namefoto = $request->inputFotoeditold;
        }

        if ($request->inputtandatanganedit != "" or $request->inputtandatanganedit != NULL) {
          //cek validasi image
          $this->validate($request, [
            'inputtandatanganedit' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);
          //upload image to directory
          if ($request->hasFile('inputtandatanganedit')) {
            $imagettangan = $request->file('inputtandatanganedit');
            $namettangan = 'ttangan' . time() . '.' . $imagettangan->getClientOriginalExtension();
            $destinationPathttangan = $_SERVER['DOCUMENT_ROOT'] . '/img/ttangan';
            $imagettangan->move($destinationPathttangan, $namettangan);
            //delete file image from directory
            if ($request->inputtandatanganeditold != NULL) {
              unlink($_SERVER['DOCUMENT_ROOT'] . '/img/ttangan/' . $request->inputtandatanganeditold);
            }
          }
        } else {
          $namettangan = $request->inputtandatanganeditold;
        }

        $isCheckededit = $request->has('inputblacklistedit');
        $statuskawinedit = substr($request->inputkawinedit, 1, 1);

        //pecah id kota dan deskripsi kota
        $pecahKotaedit = explode('|', $request->inputkotaedit);
        $idkotaedit = $pecahKotaedit[0];
        $detkotaedit = $pecahKotaedit[1];

        Nasabah::where('nasabah_id', $request->inputnasabahidedit)
          ->update(
            [
              'NO_DIN' => $request->inputdinedit,
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
              'kota_id' => $idkotaedit,
              'KOTA' => $detkotaedit,
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
              'hub_ahli_waris' => $request->inputhubahliwarisedit,
              'PATH_FOTO' => $namefoto,
              'PATH_TTANGAN' => $namettangan
            ]
          );
        if ($nasabahs) {
          $msg = '1';
          $msgdetail = 'Proses Berhasil';
        } else {
          $msg = '0';
          $msgdetail = 'Proses Simpan Data Gagal!';
        }
      } else {
        $msg = '0';
        $msgdetail = 'Proses Gagal, Harap mengisi data dengan lengkap!';
      }
    } else {
      $msg = '0';
      $msgdetail = 'Proses Gagal, Nasabah ID tidak dapat diganti.';
    }

    $users = User::all();
    $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id', 'ASC')->get();
    $nasabahall = Nasabah::select('nasabah_id', 'nama_nasabah', 'alamat', 'no_id')->get();
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

    return view('admin/nasabah', [
      'logos' => $logos, 'nasabahs' => $nasabahs, 'identitass' => $identitass, 'kodegroup1nasabahs' => $kodegroup1nasabahs,
      'perkawinans' => $perkawinans, 'negaras' => $negaras, 'kotas' => $kotas, 'pekerjaans' => $pekerjaans, 'gelars' => $gelars, 'nasabahall' => $nasabahall,
      'bidangusahas' => $bidangusahas, 'hubungandebiturs' => $hubungandebiturs, 'golongandebiturs' => $golongandebiturs, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => $msg, 'msgview' => $msgdetail
    ]);
  }

  //Direct to Proses Delete Nasabah
  public function bo_cs_de_nasabah_destroy(Request $request)
  {
    if (md5($request->inputIdNasabahdel . 'Bast90') == $request->inputIdNasabahdelhash) {
      $proses_delete = Nasabah::where('nasabah_id', $request->inputIdNasabahdel)->delete();
      if ($proses_delete) {
        $msg = '1';
        $msgdetail = 'Proses Berhasil!';
      } else {
        $msg = '0';
        $msgdetail = 'Proses Gagal, Harap mengisi data dengan lengkap!';
      }
    } else {
      $msg = '0';
      $msgdetail = 'Proses Gagal, ID Nasabah tidak dapat diubah!';
    }

    $logos = Logo::all();
    $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id', 'ASC')->get();
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
    $nasabahall = Nasabah::all();


    return view('admin/nasabah', [
      'logos' => $logos, 'nasabahs' => $nasabahs, 'identitass' => $identitass, 'kodegroup1nasabahs' => $kodegroup1nasabahs,
      'perkawinans' => $perkawinans, 'negaras' => $negaras, 'kotas' => $kotas, 'pekerjaans' => $pekerjaans, 'gelars' => $gelars, 'nasabahall' => $nasabahall,
      'bidangusahas' => $bidangusahas, 'hubungandebiturs' => $hubungandebiturs, 'golongandebiturs' => $golongandebiturs, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => $msg, 'msgview' => $msgdetail
    ]);
  }

  //Profil Nasabah Page
  public function bo_cs_de_profil()
  {
    $logos = Logo::all();
    $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id', 'ASC')->get();
    $lastnasabahid = Nasabah::max('nasabah_id');

    return view('admin/profil', ['logos' => $logos, 'nasabahs' => $nasabahs, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => '']);
  }

  public function bo_cs_de_profil_cari(Request $request)
  {
    $logos = Logo::all();
    $nasabahs = Nasabah::where('nasabah_id', 'LIKE', '%' . request()->idnasabah1 . '%')
      ->when(request()->namanasabah1, function ($query) {
        $query->where('nama_nasabah', 'LIKE', '%' . request()->namanasabah1 . '%');
      })
      ->limit(100)->orderby('nasabah.nasabah_id', 'ASC')->get();

    $users = User::all();
    $lastnasabahid = Nasabah::max('nasabah_id');

    return view('admin/profil_cari', ['logos' => $logos, 'nasabahs' => $nasabahs, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => '']);
  }

  public function bo_cs_de_profil_detail(Request $request)
  {
    $logos = Logo::all();
    $users = User::all();
    $lastnasabahid = Nasabah::max('nasabah_id');
    $nasabahs = Nasabah::where('nasabah_id', '=', $request->idnasabah);
    $kredits = Kredit::select('NO_REKENING', 'JENIS_PINJAMAN', 'POKOK_SALDO_REALISASI', 'POKOK_SALDO_AKHIR', 'DESKRIPSI_JENIS_KREDIT', 'NASABAH_ID')
      ->leftJoin('kodejeniskredit', function ($join) {
        $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
      })
      ->where('kredit.NASABAH_ID', '=', $request->idnasabah)
      ->orderby('kredit.NO_REKENING', 'ASC')->get();
    if (!$kredits)
      abort('404');

    $tabungans = Tabungan::select('NO_REKENING', 'JENIS_TABUNGAN', 'SALDO_AKHIR', 'DESKRIPSI_JENIS_TABUNGAN', 'NASABAH_ID')
      ->leftJoin('kodejenistabungan', function ($join) {
        $join->on('tabung.JENIS_TABUNGAN', '=', 'kodejenistabungan.KODE_JENIS_TABUNGAN');
      })
      ->where('tabung.NASABAH_ID', '=', $request->idnasabah)
      ->orderby('tabung.NO_REKENING', 'DESC')->get();
    if (!$tabungans)
      abort('404');

    return view('admin/profil_detail', ['logos' => $logos, 'nasabahs' => $nasabahs, 'kredits' => $kredits, 'tabungans' => $tabungans, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => '']);
  }

  public function bo_cs_de_profil_kredit(Request $request)
  {
    dd($request);
    $logos = Logo::all();
    $users = User::all();
    if ($request->jenisprofil == 'kredit') {
      $kredits = Kredit::select(
        'kredit.*',
        'kodejeniskredit.DESKRIPSI_JENIS_KREDIT',
        'nasabah.*',
        'kodegroup1kredit.DESKRIPSI_GROUP1',
        'kodegroup2kredit.DESKRIPSI_GROUP2',
        'kodegroup3kredit.DESKRIPSI_GROUP3',
        'kodegroup4kredit.DESKRIPSI_GROUP4',
        'kodesumberdanakredit.DESKRIPSI_SUMBER_DANA',
        'kodetypekredit.DESKRIPSI_TYPE_KREDIT',
        'kodesatuanwaktukredit.DESKRIPSI_SATUAN_WAKTU',
        'kodejenispenggunaankredit.DESKRIPSI_JENIS_PENGGUNAAN',
        'kodegoldebitur.DESKRIPSI_GOL_DEBITUR',
        'kodesektorekonomikredit.DESKRIPSI_SEKTOR_EKONOMI',
        'kodegolpenjaminkredit.DESKRIPSI_GOL_PENJAMIN'
      )
        ->leftJoin('kodejeniskredit', function ($join) {
          $join->on('kredit.JENIS_PINJAMAN', '=', 'kodejeniskredit.KODE_JENIS_KREDIT');
        })
        ->leftJoin('nasabah', function ($join) {
          $join->on('kredit.NASABAH_ID', '=', 'nasabah.nasabah_id');
        })
        ->leftJoin('kodegroup1kredit', function ($join) {
          $join->on('kredit.KODE_GROUP1', '=', 'kodegroup1kredit.KODE_GROUP1');
        })
        ->leftJoin('kodegroup2kredit', function ($join) {
          $join->on('kredit.KODE_GROUP2', '=', 'kodegroup2kredit.KODE_GROUP2');
        })
        ->leftJoin('kodegroup3kredit', function ($join) {
          $join->on('kredit.KODE_GROUP3', '=', 'kodegroup3kredit.KODE_GROUP3');
        })
        ->leftJoin('kodegroup4kredit', function ($join) {
          $join->on('kredit.KODE_GROUP4', '=', 'kodegroup4kredit.KODE_GROUP4');
        })
        ->leftJoin('kodesumberdanakredit', function ($join) {
          $join->on('kredit.KODE_SUMBER_DANA', '=', 'kodesumberdanakredit.KODE_SUMBER_DANA');
        })
        ->leftJoin('kodesatuanwaktukredit', function ($join) {
          $join->on('kredit.SATUAN_WAKTU_ANGSURAN', '=', 'kodesatuanwaktukredit.KODE_SATUAN_WAKTU');
        })
        ->leftJoin('kodetypekredit', function ($join) {
          $join->on('kredit.TYPE_PINJAMAN', '=', 'kodetypekredit.KODE_TYPE_KREDIT');
        })
        ->leftJoin('kodejenispenggunaankredit', function ($join) {
          $join->on('kredit.BI_JENIS_PENGGUNAAN', '=', 'kodejenispenggunaankredit.KODE_JENIS_PENGGUNAAN');
        })
        ->leftJoin('kodegoldebitur', function ($join) {
          $join->on('kredit.BI_GOL_DEBITUR', '=', 'kodegoldebitur.KODE_GOL_DEBITUR');
        })
        ->leftJoin('kodesektorekonomikredit', function ($join) {
          $join->on('kredit.BI_SEKTOR_EKONOMI', '=', 'kodesektorekonomikredit.KODE_SEKTOR_EKONOMI');
        })
        ->leftJoin('kodegolpenjaminkredit', function ($join) {
          $join->on('kredit.BI_GOL_PENJAMIN', '=', 'kodegolpenjaminkredit.KODE_GOL_PENJAMIN');
        })
        ->where('kredit.NO_REKENING', '=', $request->idkredit)
        ->get();
      if (!$kredits)
        abort('404');
    } else if ($request->jenisprofil == 'tabungan') {
      $kredits = Tabungan::select(
        'tabung.*',
        'kodejenistabungan.DESKRIPSI_JENIS_TABUNGAN',
        'nasabah.*',
        'kodegroup1tabung.DESKRIPSI_GROUP1',
        'kodegroup2tabung.DESKRIPSI_GROUP2',
        'kodegroup3tabung.DESKRIPSI_GROUP3',
        'kodemetoda.DESKRIPSI_METODA',
        'golongan_pihaklawan.deskripsi_golongan'
      )
        ->leftJoin('kodejenistabungan', function ($join) {
          $join->on('tabung.JENIS_TABUNGAN', '=', 'kodejenistabungan.KODE_JENIS_TABUNGAN');
        })
        ->leftJoin('nasabah', function ($join) {
          $join->on('tabung.NASABAH_ID', '=', 'nasabah.nasabah_id');
        })
        ->leftJoin('kodegroup1tabung', function ($join) {
          $join->on('tabung.KODE_GROUP1', '=', 'kodegroup1tabung.KODE_GROUP1');
        })
        ->leftJoin('kodegroup2tabung', function ($join) {
          $join->on('tabung.KODE_GROUP2', '=', 'kodegroup2tabung.KODE_GROUP2');
        })
        ->leftJoin('kodegroup3tabung', function ($join) {
          $join->on('tabung.KODE_GROUP3', '=', 'kodegroup3tabung.KODE_GROUP3');
        })
        ->leftJoin('kodemetoda', function ($join) {
          $join->on('tabung.KODE_BI_METODA', '=', 'kodemetoda.KODE_METODA');
        })
        ->leftJoin('golongan_pihaklawan', function ($join) {
          $join->on('tabung.KODE_BI_PEMILIK', '=', 'golongan_pihaklawan.sandi');
        })
        ->where('tabung.NO_REKENING', '=', $request->idkredit)
        ->get();
      if (!$kredits)
        abort('404');
    }
    $jenisprofil = $request->jenisprofil;
    return view('admin/profil_kredit', ['logos' => $logos, 'kredits' => $kredits, 'jenisprofil' => $jenisprofil, 'msgstatus' => '']);
  }

  public function bo_cs_de_profil_rppdf(Request $request)
  {
    $filternasabahid = request()->printprofilnasabah;
    $sqlnas = "SELECT
        nasabah_id,nama_nasabah
        FROM nasabah 
        WHERE nasabah_id = '$filternasabahid'
        ";
    $profilnasabah = DB::select($sqlnas);
    $sqltab = "SELECT
        a.nasabah_id as nasId,a.nama_nasabah as nasNama,b.NO_REKENING as tabNoRek,c.DESKRIPSI_JENIS_TABUNGAN as tabJenis,b.SALDO_AWAL as tabSaldoAwal,b.SALDO_AKHIR as tabSaldoAkhir
        FROM nasabah a LEFT JOIN tabung b ON a.nasabah_id=b.NASABAH_ID LEFT JOIN kodejenistabungan c ON b.JENIS_TABUNGAN=c.KODE_JENIS_TABUNGAN
        WHERE a.nasabah_id = '$filternasabahid' ORDER BY b.JENIS_TABUNGAN
        ";
    $profilnasabahtab = DB::select($sqltab);
    $sqldep = "SELECT
        a.nasabah_id as nasId,a.nama_nasabah as nasNama,b.NO_REKENING as depNoRek,c.DESKRIPSI_JENIS_DEPOSITO as depJenis,b.SALDO_AWAL as depSaldoAwal,b.SALDO_AKHIR as depSaldoAkhir
        FROM nasabah a LEFT JOIN deposito b ON a.nasabah_id=b.NASABAH_ID LEFT JOIN kodejenisdeposito c ON b.JENIS_DEPOSITO=c.KODE_JENIS_DEPOSITO
        WHERE a.nasabah_id = '$filternasabahid' ORDER BY b.JENIS_DEPOSITO,b.NO_REKENING
        ";
    $profilnasabahdep = DB::select($sqldep);
    $sqlkre = "SELECT
        a.nasabah_id as nasId,a.nama_nasabah as nasNama,b.NO_REKENING as kreNoRek,c.DESKRIPSI_JENIS_KREDIT as kreJenis,b.JML_PINJAMAN as kreSaldoAwal,b.SALDO_AKHIR as kreSaldoAkhir
        FROM nasabah a LEFT JOIN kredit b ON a.nasabah_id=b.NASABAH_ID LEFT JOIN kodejeniskredit c ON b.JENIS_PINJAMAN=c.KODE_JENIS_KREDIT
        WHERE a.nasabah_id = '$filternasabahid' ORDER BY b.JENIS_PINJAMAN,b.NO_REKENING
        ";
    $profilnasabahkre = DB::select($sqlkre);
    $sqltabcount = "SELECT
        COUNT(b.JENIS_TABUNGAN) as countJenistab,c.DESKRIPSI_JENIS_TABUNGAN as tabJenis,SUM(b.SALDO_AWAL) as sumtabSaldoAwal,SUM(b.SALDO_AKHIR) as sumtabSaldoAkhir
        FROM nasabah a LEFT JOIN tabung b ON a.nasabah_id=b.NASABAH_ID LEFT JOIN kodejenistabungan c ON b.JENIS_TABUNGAN=c.KODE_JENIS_TABUNGAN
        WHERE a.nasabah_id = '$filternasabahid' GROUP BY b.JENIS_TABUNGAN ORDER BY b.JENIS_TABUNGAN
        ";
    $profilnasabahtabcount = DB::select($sqltabcount);
    $sqldepcount = "SELECT
        COUNT(b.JENIS_DEPOSITO) as countJenisdep,c.DESKRIPSI_JENIS_DEPOSITO as depJenis,SUM(b.SALDO_AWAL) as sumdepSaldoAwal,SUM(b.SALDO_AKHIR) as sumdepSaldoAkhir
        FROM nasabah a LEFT JOIN deposito b ON a.nasabah_id=b.NASABAH_ID LEFT JOIN kodejenisdeposito c ON b.JENIS_DEPOSITO=c.KODE_JENIS_DEPOSITO
        WHERE a.nasabah_id = '$filternasabahid' GROUP BY b.JENIS_DEPOSITO ORDER BY b.JENIS_DEPOSITO,b.NO_REKENING
        ";
    $profilnasabahdepcount = DB::select($sqldepcount);
    $sqlkrecount = "SELECT
        COUNT(b.JENIS_PINJAMAN) as countJeniskre,c.DESKRIPSI_JENIS_KREDIT as kreJenis,SUM(b.JML_PINJAMAN) as sumkreSaldoAwal,SUM(b.SALDO_AKHIR) as sumkreSaldoAkhir
        FROM nasabah a LEFT JOIN kredit b ON a.nasabah_id=b.NASABAH_ID LEFT JOIN kodejeniskredit c ON b.JENIS_PINJAMAN=c.KODE_JENIS_KREDIT
        WHERE a.nasabah_id = '$filternasabahid' GROUP BY b.JENIS_PINJAMAN ORDER BY b.JENIS_PINJAMAN,b.NO_REKENING
        ";
    $profilnasabahkrecount = DB::select($sqlkrecount);
    // dd($profilnasabahtab);
    return view('pdf.cetakprofilnasabah', [
      'profilnasabah' => $profilnasabah, 'profilnasabahtab' => $profilnasabahtab, 'profilnasabahdep' => $profilnasabahdep, 'profilnasabahkre' => $profilnasabahkre, 'profilnasabahtabcount' => $profilnasabahtabcount, 'profilnasabahdepcount' => $profilnasabahdepcount, 'profilnasabahkrecount' => $profilnasabahkrecount
    ]);
  }

  public function bo_cs_de_spicemen_rppdf(Request $request)
  {
    $ttd = DB::table('mysysid')->select('KeyName', 'Value')->where('KeyName', 'like', 'TTD_TAB' . '%' . 'NAMA')->get();
    $filternorekening = request()->printnorekening;
    $sql = "SELECT
        a.no_rekening,
        b.nasabah_id,
        b.ibu_kandung,
        b.no_id,
        b.cif,
        b.nama_nasabah,
        b.alamat,
        b.telpon,
        b.tgllahir
        FROM tabung a LEFT JOIN nasabah b ON a.NASABAH_ID = b.nasabah_id
        WHERE a.NO_REKENING = '$filternorekening' 
        ";
    $tabungan = DB::select($sql);
    // dd($tabungan);
    return view('pdf.cetakspicemen', ['tabungan' => $tabungan, 'ttd' => $ttd]);
  }


  public function bo_cs_de_simulasi()
  {
    $logos = Logo::all();
    $nasabahs = Nasabah::select('*')->limit(20)->orderby('nasabah.nasabah_id', 'ASC')->get();
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

    return view('admin/simulasi', [
      'logos' => $logos, 'nasabahs' => $nasabahs, 'identitass' => $identitass, 'kodegroup1nasabahs' => $kodegroup1nasabahs,
      'perkawinans' => $perkawinans, 'negaras' => $negaras, 'kotas' => $kotas, 'pekerjaans' => $pekerjaans, 'gelars' => $gelars,
      'bidangusahas' => $bidangusahas, 'hubungandebiturs' => $hubungandebiturs, 'golongandebiturs' => $golongandebiturs, 'lastnasabahid' => $lastnasabahid, 'msgstatus' => ''
    ]);
  }
}
