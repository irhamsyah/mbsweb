@extends('layouts.admin_main')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <h3 style="margin-left:20px" class="card-title">Entry Tabungan</h3>

      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form for Search Exsisting Saving Customer -->
          <form method="POST" action="/bo_tabungan_edit_cari" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="idnasabah1">NO_REKENING</label> 
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnasabah1" name="norekcari" placeholder="Masukkan No Rek Tabungan">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">NAMA NASABAH</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabahcari" placeholder="Masukkan Nama Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-3"></div>
                <div class="col-3">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form> <!-- /Batas Form Search ---->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-tabungan" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Yang Sudah Tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
              <tr>
                <th>No</th>
                <th>No_Rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>Jenis Tabungan</th>
                <th>Saldo Akhir</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              {{-- @foreach($tabungan->chunk(100) as $index => $values) --}}
              @php($index=0)
              @foreach(array_chunk($tabungan,1) as $values)
              @php($index++)
                @foreach ($values as $kunci=>$tabungans)

                    @if($tabungans->STATUS_AKTIF==1)
                      @php ($status='Baru')
                    @elseif($tabungans->STATUS_AKTIF==2)
                      @php ($status='Aktif')
                    @else
                      @php ($status='Tutup')
                    @endif

                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ strtoupper($tabungans->NO_REKENING) }}</td>
                  <td>{{ $tabungans->nama_nasabah }}</td>
                  <td>{{ $tabungans->alamat}}</td>
                  <td>{{ $tabungans->JENIS_TABUNGAN}}</td>
                  <td>{{ $tabungans->SALDO_AKHIR }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <form action="/prof_tab_detail" method="post" style="margin-bottom: 0;">
                          <input type="hidden" name="inputIdTransaction" value="{{ $tabungans->NO_REKENING }}" class="form-control">
                          @csrf
                      </form>
                      <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-tabungan"
                        data-no_rekening="{{ $tabungans->NO_REKENING}}"
                        data-hidden_jenis_tabungan="{{$tabungans->JENIS_TABUNGAN}}"
                        data-jenis_tabungan="{{$tabungans->deskripsi_jenis_tabungan}}"
                        data-no_alternatif="{{$tabungans->NO_ALTERNATIF}}"
                        data-cab="{{$tabungans->CAB}}"
                        data-nasabah_id="{{$tabungans->NASABAH_ID}}"
                        data-nama_nasabah="{{$tabungans->nama_nasabah}}"
                        data-alamat="{{$tabungans->alamat}}"
                        data-type_tabungan="{{$tabungans->TYPE_TABUNGAN}}"
                        data-suku_bunga="{{$tabungans->SUKU_BUNGA}}"
                        data-persen_pph="{{$tabungans->PERSEN_PPH}}"
                        data-tgl_bunga="{{$tabungans->TGL_BUNGA}}"
                        {{-- data-blokir="{{$tabungans->BLOKIR}}"
                        data-saldo_blokir="{{$tabungans->SALDO_BLOKIR}}" --}}
                        data-kode_group1="{{$tabungans->KODE_GROUP1}}"
                        data-desc_group1="{{$tabungans->DESKRIPSI_GROUP1}}"
                        data-kode_group2="{{$tabungans->KODE_GROUP2}}"
                        data-desc_group2="{{$tabungans->DESKRIPSI_GROUP2}}"
                        data-kode_group3="{{$tabungans->KODE_GROUP3}}"
                        data-desc_group3="{{$tabungans->DESKRIPSI_GROUP3}}"
                        data-status_aktif="{{$tabungans->STATUS_AKTIF}}"
                        data-kode_bi_pemilik="{{$tabungans->KODE_BI_PEMILIK}}"
                        data-deskripsi_golongan="{{$tabungans->deskripsi_golongan}}"
                        data-kode_bi_metoda="{{$tabungans->KODE_BI_METODA}}"
                        data-deskripsi_metoda="{{$tabungans->DESKRIPSI_METODA}}"
                        data-kode_bi_hubungan="{{$tabungans->KODE_BI_HUBUNGAN}}"
                        data-deskripsi_sandi="{{$tabungans->DESKRIPSI_SANDI}}"
                        data-flag_restricted="{{$tabungans->FLAG_RESTRICTED}}"
                        data-minimum="{{$tabungans->MINIMUM}}"
                        data-setoran_minimum="{{$tabungans->SETORAN_MINIMUM}}"
                        data-setoran_per_bln="{{$tabungans->SETORAN_PER_BLN}}"
                        data-abp="{{$tabungans->ABP}}"
                        data-adm_per_bln="{{$tabungans->ADM_PER_BLN}}"
                        >
                          Edit
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>No_Rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>Jenis Tabungan</th>
                <th>Saldo Akhir</th>
                <th>Action</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  {{-- MODAL EDIT TABUNGAN --}}
  <div class="modal fade" id="modal-edit-tabungan">
    <div class="modal-dialog modal-xl">
      <form action="/bo_tab_edit_tabungan" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Tabungan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Baris ke 1 EDIT tabungan ----->
            <div class="form-group">
              <div class="row">
                <div class="form-check p-3">
                  <input id="inputbaru" disabled type="checkbox" name="baru" class="form-check-input">
                  <label for="inputbaru">Baru</label>
                </div>
                <div class="form-check p-3">
                  <input id="inputaktif" disabled type="checkbox" name="aktif" class="form-check-input">
                  <label for="inputaktif">Aktif</label>
                </div>
                <div class="form-check p-3">
                  <input id="inputtutup" disabled type="checkbox" name="tutup" class="form-check-input">
                  <label for="inputtutup">Tutup</label>
                </div>

              </div>
            </div>
            <!--Baris ke 2 EDIT tabungan ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-sm-6">
                    <label for="inputidentitas">Jenis Tabungan</label>
                    <select class="form-control" name="jenis_tabungan" id="editlist">
                      <option id="idSelect" selected></option>
                      @foreach($kodejenistabungan as $value)
                      <option value="{{ $value->kode_jenis_tabungan}}" data-ebunga="{{$value->SUKU_BUNGA_DEFAULT}}" data-eadm="{{$value->ADM_PER_BLN_DEFAULT}}" data-epph="{{$value->PPH_DEFAULT}}" data-esalmin="{{$value->MINIMUM_DEFAULT}}" data-esetmin="{{$value->SETORAN_MINIMUM_DEFAULT}}" data-esetwajib={{$value->SETORAN_PER_BLN_DEFAULT}} data-erestricted={{$value->FLAG_RESTRICTED}}>{{ $value->DESKRIPSI_JENIS_TABUNGAN}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="norek">No.Rekening</label>
                  <input type="text" name="no_rekening" class="form-control" required >
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputopendate">No.Series</label>
                  <input type="text" name="no_alternatif" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputnasabahid">Cabang</label>
                  @foreach($kodecabang as $value)
                  <input type="text" name="cab" readonly class="form-control" value="{{$value->kode_cab}}">{{$value->nama_cab}}
                  @endforeach
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="nasabahid">Nasabah / Anggota ID</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input type="text" id="editidnasabah" name="nasabah_id" class="form-control">

                    <div class="input-group-append" data-toggle="modal" data-target="#ambildatanasabah">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>

                  </div>

                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputnocif">Nama</label>
                  <input type="text" id="editnamanasabah" name="nama_nasabah" readonly class="form-control">
                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputnocif">Alamat</label>
                  <input type="text" id="editalamatnasabah" name="alamat" readonly class="form-control">
                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputtipe">Tipe</label>
                  <select class="form-control" name="type_tabungan">
                    <option id="idSelect2" selected></option>
                    <option value=1>Normal</option>
                    <option value=2>Kepala Instansi</option>
                    <option value=3>Juru Bayar</option>
                  </select>
                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputnocif">Bunga per Tahun(%)</label>
                  <input type="text" name="suku_bunga" class="form-control" id="ebungga">
                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputnocif">PPH (%)</label>
                  <input type="text" name="persen_pph" class="form-control" id="epph">
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputDate1">Tgl hitung Bunga</label>
                  <div class="input-group date" id="inputDate1" data-target-input="nearest">
                    <input type="text" name="tgl_bunga" class="form-control datetimepicker-input" data-target="#inputDate1"/>
                      <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                {{-- <div class="form-check">
                  <input id="inputblokir" disabled type="checkbox" name="blokir" class="form-check-input">
                  <label for="inputblokir">Blokir</label>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputnamanasabah">Saldo Blokir</label>
                  <input type="text" name="saldo_blokir" value="0" class="form-control">
                </div> --}}
              </div>            
            </div>
            <!--Baris ke 3 EDIT tabungan ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-sm-6">
                <label for="inputjk">Kode Group 1</label>
                  <select class="form-control" name="kode_group1">
                    <option id="idkodegroup1" selected></option>
                    @foreach($kodegrou1tabungan as $value)
                    <option value="{{$value->KODE_GROUP1}}">{{$value->DESKRIPSI_GROUP1}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputjk">Kode Group 2</label>
                    <select class="form-control" name="kode_group2">
                      <option id="idkodegroup2" selected></option>
                      @foreach($kodegrou2tabungan as $value)
                      <option value="{{$value->KODE_GROUP2}}">{{$value->DESKRIPSI_GROUP2}}</option>
                      @endforeach
                    </select>
                </div>
                    <div class="col-lg-2 col-sm-6">
                      <label for="inputjk">Kode Group 3</label>
                      <select class="form-control" name="kode_group3">
                        <option id="idkodegroup3" selected></option>
                        @foreach($kodegrou3tabungan as $value)
                        <option value="{{$value->KODE_GROUP3}}">{{$value->DESKRIPSI_GROUP3}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                      <label for="inputjk">Gol. pihak lawan</label>
                        <select class="form-control" name="kode_bi_pemilik">
                          <option id="idkodebi" selected></option>
                          @foreach($golonganpihaklawan as $value)
                          <option value="{{$value->sandi}}">{{$value->sandi}}-{{$value->deskripsi_golongan}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <label for="inputjk">Metoda</label>
                          <select class="form-control" name="kode_bi_metoda">
                            <option selected="true" id="idmetoda" ></option>
                            @foreach($kodemetoda as $value)
                            <option value="{{$value->KODE_METODA}}">{{$value->DESKRIPSI_METODA}}</option>
                            @endforeach
                          </select>
                      </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputjk">Sandi pihak terkait</label>
                            <select class="form-control" name="kode_bi_hubungan">
                              <option id="idbihubungan" selected></option>
                              @foreach($kodeketerkaitanlapbul as $value)
                              <option value="{{$value->SANDI}}">{{$value->DESKRIPSI_SANDI}}</option>
                              @endforeach
                            </select>
                        </div>
              </div>            
            </div>
            <!--Baris ke 4 EDIT tabungan ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="inputibukandung">Restricted</label>
                  <select class="form-control" name="flag_restricted">
                    <option selected id="idrestricted"></option>
                    <option value="UNRESTRICTED">UNRESTRICTED</option>
                    <option value="RESTRICTED">RESTRICTED</option>
                  </select>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputnpwp">Saldo Minimal</label>
                  <input type="text" name="minimum" class="form-control" id="esalmin">
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputidentitas">Setoran Minimal</label>
                  <input type="text" name="setoran_minimum" class="form-control" id="esetmin">
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputnoidentitas">Setoran Wajib</label>
                  <input type="text" name="setoran_per_bln" class="form-control" id="esetwajib">
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputDate2">Tipe Tab</label>
                  <select class="form-control" name="abp" id="idabp">
                    <option value="1">TABUNGAN</option>
                    <option value="2">AB-PASIVA</option>
                    <option value="3">AB-AKTIVA</option>
                    <option value="4">MODAL</option>
                    <option value="5">KEWAJIBAN</option>
                  </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label>Biaya Adm</label>
                  <input type="text" name="adm_per_bln" class="form-control" id="eadm">
                  <input type="hidden" name="periode_adm" class="form-control" value=1>
                </div>
              </div>            
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
        <!-- /.modal-content -->
      @csrf
      </form>
    </div>
    <!-- /.modal-dialog -->
  </div>   {{-- BATAS MODAL EDIT TABUNGAN --}}

  {{-- MODAL UNTUK MENAMPILKAN TAMBAH DATA --}}
  <div class="modal fade bs-modal-tabung" id="modal-add-tabungan">
    <div class="modal-dialog modal-xl">
      <form action="/bo_tab_add_tabung" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Data Entry Tabungan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Baris ke 1 ADD tabungan ----->
            <div class="form-group">
              <div class="row">
                <div class="form-check p-3">
                  <input id="inputbaru" disabled type="checkbox" checked name="baru" class="form-check-input">
                  <label for="inputbaru">Baru</label>
                </div>
                <div class="form-check p-3">
                  <input id="inputaktif" disabled type="checkbox" name="aktif" class="form-check-input">
                  <label for="inputaktif">Aktif</label>
                </div>
                <div class="form-check p-3">
                  <input id="inputtutup" disabled type="checkbox" name="tutup" class="form-check-input">
                  <label for="inputtutup">Tutup</label>
                </div>
              </div>
            </div>
            <!--Baris ke 2 ADD tabungan ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-sm-6">
                    <label for="inputidentitas">Jenis Tabungan</label>
                    <select class="form-control" name="jenis_tabungan" id="listItem">
                      <option id="idSelect" selected></option>
                      @foreach($kodejenistabungan as $value)
                      <option value="{{ $value->KODE_JENIS_TABUNGAN}}" data-bunga="{{$value->SUKU_BUNGA_DEFAULT}}" data-adm="{{$value->ADM_PER_BLN_DEFAULT}}" data-pph="{{$value->PPH_DEFAULT}}" data-salmin="{{$value->MINIMUM_DEFAULT}}" data-setmin="{{$value->SETORAN_MINIMUM_DEFAULT}}" data-setwajib={{$value->SETORAN_PER_BLN_DEFAULT}} data-restricted={{$value->FLAG_RESTRICTED}}>{{ $value->DESKRIPSI_JENIS_TABUNGAN}}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="norek">No.Rekening</label>
                  <input id="norekadd" type="text" onchange="" name="no_rekening" class="form-control" required>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputopendate">No.Series</label>
                  <input id="noaltadd" type="text" name="no_alternatif" class="form-control">
                </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputnasabahid">Cabang</label>
                    @foreach($kodecabang as $value)
                    <input type="text" name="cab" readonly class="form-control" value="{{$value->kode_cab}}">{{$value->nama_cab}}
                    @endforeach
                  </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="nasabahid">Nasabah / Anggota ID</label>
                          <div class="input-group date" data-target-input="nearest">
                            <input id="inputNasabahIdadd" type="text" name="nasabah_id" readonly class="form-control" required>

                            <div class="input-group-append" data-toggle="modal" data-target="#ambildatanasabah">
                              <div class="input-group-text"><i class="fa fa-user"></i></div>
                          </div>
                          </div>
                        </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputnocif">Nama</label>
                  <input type="text" id="inputNamaNasabahadd" name="nama_nasabah" readonly class="form-control">
                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputnocif">Alamat</label>
                  <input type="text" id="inputalamatadd" name="alamat" readonly class="form-control" required>
                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputtipe">Tipe</label>
                  <select class="form-control" name="type_tabungan" required>
                    <option value=1 selected>Normal</option>
                    <option value=2>Kepala Instansi</option>
                    <option value=3>Juru Bayar</option>
                  </select>
                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputnocif">Bunga per Tahun(%)</label>
                  <input type="text" name="suku_bunga" class="form-control" id="bunga" required>
                </div>
                <div class="col-lg-2 col-sm-8">
                  <label for="inputnocif">PPH (%)</label>
                  <input type="text" name="persen_pph"  class="form-control" id="pph">
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputDate1">Tgl hitung Bunga</label>
                  <div class="input-group date" id="inputDate2" data-target-input="nearest">
                    <input type="text" name="tgl_bunga" class="form-control datetimepicker-input" value="{{date('Y-m-d',strtotime(str_replace('/', '-', $tgllogin[0]->Value)))}}" data-target="#inputDate2"/>
                      <div class="input-group-append" data-target="#inputDate2" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
              </div>            
            </div>
            <!--Baris ke 3 ADD tabungan ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-sm-6">
                <label for="inputjk">Kode Group 1</label>
                  <select class="form-control" name="kode_group1">
                    <option id="idkodegroup1" selected></option>
                    @foreach($kodegrou1tabungan as $value)
                    <option value="{{$value->KODE_GROUP1}}">{{$value->DESKRIPSI_GROUP1}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputjk">Kode Group 2</label>
                    <select class="form-control" name="kode_group2">
                      <option id="idkodegroup2" selected></option>
                      @foreach($kodegrou2tabungan as $value)
                      <option value="{{$value->KODE_GROUP2}}">{{$value->DESKRIPSI_GROUP2}}</option>
                      @endforeach
                    </select>
                </div>
                    <div class="col-lg-2 col-sm-6">
                      <label for="inputjk">Kode Group 3</label>
                      <select class="form-control" name="kode_group3">
                        <option id="idkodegroup3" selected></option>
                        @foreach($kodegrou3tabungan as $value)
                        <option value="{{$value->KODE_GROUP3}}">{{$value->DESKRIPSI_GROUP3}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                      <label for="inputjk">Gol. pihak lawan</label>
                        <select class="form-control" name="kode_bi_pemilik">
                          @foreach($golonganpihaklawan as $value)
                          @if($value->sandi=='875')
                          <option value="{{$value->sandi}}" selected>{{$value->sandi}}-{{$value->deskripsi_golongan}}</option>
                          @else
                          <option value="{{$value->sandi}}" selected>{{$value->sandi}}-{{$value->deskripsi_golongan}}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <label for="inputjk">Metoda</label>
                          <select class="form-control" name="kode_bi_metoda" required>
                            @foreach($kodemetoda as $value)
                            @if($value->DESKRIPSI_METODA=='Non Profit Sharing')
                            <option selected="true" value="{{$value->KODE_METODA}}">{{$value->DESKRIPSI_METODA}}</option>
                            @else
                            <option value="{{$value->KODE_METODA}}">{{$value->DESKRIPSI_METODA}}</option>
                            @endif
                            @endforeach
                          </select>
                      </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputjk">Sandi pihak terkait</label>
                            <select class="form-control" name="kode_bi_hubungan">
                              @foreach($kodeketerkaitanlapbul as $value)
                              @if($value->DESKRIPSI_SANDI=='Tidak Terkait')
                              <option value="{{$value->SANDI}}" selected>{{$value->DESKRIPSI_SANDI}}</option>
                              @else
                              <option value="{{$value->SANDI}}">{{$value->DESKRIPSI_SANDI}}</option>
                              @endif
                              @endforeach
                            </select>
                        </div>
              </div>            
            </div>
            <!--Baris ke 4 ADD tabungan ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="inputibukandung">Restricted</label>
                  <select class="form-control" name="flag_restricted">
                    <option value="UNRESTRICTED" selected>UNRESTRICTED</option>
                    <option value="RESTRICTED">RESTRICTED</option>
                  </select>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputnpwp">Saldo Minimal</label>
                  <input type="text" name="minimum" class="form-control" id="salmin">
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputidentitas">Setoran Minimal</label>
                  <input type="text" name="setoran_minimum" class="form-control" id="setmin">
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputnoidentitas">Setoran Wajib</label>
                  <input type="text" name="setoran_per_bln" class="form-control" id="setwajib">
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputDate2">Tipe Tab</label>
                  <select class="form-control" name="abp" id="idabp">
                    <option value="1">TABUNGAN</option>
                    <option value="2">AB-PASIVA</option>
                    <option value="3">AB-AKTIVA</option>
                    <option value="4">MODAL</option>
                    <option value="5">KEWAJIBAN</option>
                  </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label>Biaya Adm</label>
                  <input type="text" name="adm_per_bln" class="form-control" id="adm">
                  <input type="hidden" name="periode_adm" class="form-control" value=1>
                </div>
              </div>            
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      @csrf
    </form>
    </div>
    <!-- /.modal-dialog -->
  </div>   {{-- BATASA MODAL UNTUK MENAMPILKAN TAMBAH DATA --}}

  {{-- MODAL TAMPIL TABEL NASABAH --}}
  <div class="modal fade bs-modal-nas" id="ambildatanasabah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ambildatanasabah">Data Nasabah</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
          <table id="nasabahdata" class="display" width="100%">
            <thead>
              <tr>
                  <th>Nasabah Id</th>
                  <th>Nama Nasabah</th>
                  <th>Alamat Nasabah</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($nasabah as $value)
                <tr>
                <td>{{ $value->nasabah_id }}</td>
                <td>{{ $value->nama_nasabah }}</td>
                <td>{{ $value->alamat }}</td>
                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu" data-dismiss="modal">
                    <a id="tes1" href="#" class="dropdown-item">
                      pilih
                    </a>
                  </div>
                </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection