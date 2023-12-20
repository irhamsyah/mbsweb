@extends('layouts.admin_main')

@section('content')

@if($msgstatus!=''){
  @if($msgstatus=='1'){
    @php $statusmsg='success'; $titlemsg='Successfully'; @endphp;
  }
  @else{
    @php $statusmsg='error'; $titlemsg='Error!'; @endphp;
  }
  @endif
    
  <script>
    Swal.fire(
      '{{ $titlemsg }}',
      '{{ $msgview }}',
      '{{ $statusmsg }}'
    )
  </script>
}
@endif

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form for Search Exsisting Saving Customer -->
          <form method="POST" action="/bo_dp_de_deposito/cari" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="idnasabah1">NO_REKENING</label> 
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnasabah1" name="norekcari" placeholder="Masukkan No Rek Deposito">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">NAMA NASABAH</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabahcari" placeholder="Masukkan Nama Deposito">
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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-deposito" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Yang Sudah Tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>No Rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>Tgl Registrasi</th>
                <th>Tgl JT</th>
                <th>Jml Deposito</th>
                <th>Saldo Akhir</th>
                <th>No Rek Tabungan</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($depositos as $index => $deposito)
                  @if($deposito->STATUS_AKTIF==2)
                    @php ($status='Aktif')
                  @elseif($deposito->STATUS_AKTIF==1)
                    @php ($status='Baru')
                  @else
                    @php ($status='Tutup')
                  @endif

                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($deposito->NO_REKENING) }}</td>
                  <td>{{ $deposito->nama_nasabah }}</td>
                  <td>{{ $deposito->alamat}}</td>
                  <td>{{ $deposito->TGL_REGISTRASI}}</td>
                  <td>{{ $deposito->TGL_JT}}</td>
                  <td>{{ number_format($deposito->NILAI_DEPOSITO,2)}}</td>
                  <td>{{ number_format($deposito->SALDO_AKHIR,2) }}</td>
                  <td>{{ $deposito->NO_REK_TABUNGAN }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-deposito"
                        data-no_rekening="{{ $deposito->NO_REKENING }}"
                        data-no_rekeninghash="{{ md5($deposito->NO_REKENING.'Bast90') }}"
                        data-no_alternatif="{{ $deposito->NO_ALTERNATIF }}"
                        data-nasabah_id="{{ $deposito->NASABAH_ID }}"
                        data-qq="{{ $deposito->QQ }}"
                        data-kode_bi_pemilik="{{ $deposito->KODE_BI_PEMILIK }}"
                        data-kode_bi_hubungan="{{ $deposito->KODE_BI_HUBUNGAN }}"
                        data-kode_bi_metoda="{{ $deposito->KODE_BI_METODA }}"
                        data-jenis_deposito="{{ $deposito->JENIS_DEPOSITO }}"
                        data-jml_deposito="{{ $deposito->JML_DEPOSITO }}"
                        data-suku_bunga="{{ $deposito->SUKU_BUNGA }}"
                        data-persen_pph="{{ $deposito->PERSEN_PPH }}"
                        data-tgl_registrasi="{{ $deposito->TGL_REGISTRASI }}"
                        data-jkw="{{ $deposito->JKW }}"
                        data-tgl_jt="{{ $deposito->TGL_JT }}"
                        data-status_aktif="{{ $deposito->STATUS_AKTIF }}"
                        data-kode_group1="{{ $deposito->KODE_GROUP1 }}"
                        data-kode_group2="{{ $deposito->KODE_GROUP2 }}"
                        data-kode_group3="{{ $deposito->KODE_GROUP3 }}"
                        data-status_bunga="{{ $deposito->STATUS_BUNGA }}"
                        data-aro="{{ $deposito->ARO }}"
                        data-no_rek_tabungan="{{ $deposito->NO_REK_TABUNGAN }}"
                        data-bunga_berbunga="{{ $deposito->BUNGA_BERBUNGA }}"
                        data-masuk_titipan="{{ $deposito->MASUK_TITIPAN }}"
                        data-abp="{{ $deposito->ABP }}"
                        data-type_suku_bunga="{{ $deposito->TYPE_SUKU_BUNGA }}"
                        data-tgl_valuta="{{ $deposito->TGL_VALUTA }}"
                        data-provisi="{{ $deposito->PROVISI }}"
                        data-adm="{{ $deposito->ADM }}"
                        data-tgl_mulai="{{ $deposito->TGL_MULAI }}"
                        data-blokir="{{ $deposito->BLOKIR }}"
                        data-akad="{{ $deposito->AKAD }}"
                        data-gol_nasabah="{{ $deposito->gol_nasabah }}"
                        data-keterangan="{{ $deposito->KETERANGAN }}"
                        data-cab="{{ $deposito->KODE_CAB }}"
                        data-nama_nasabah="{{ $deposito->nama_nasabah }}"
                        data-alamat="{{ $deposito->alamat }}"
                        >
                          Detail & Edit
                      </a>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>No Rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>Tgl Registrasi</th>
                <th>Tgl JT</th>
                <th>Jml Deposito</th>
                <th>Saldo Akhir</th>
                <th>No Rekening</th>
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
  {{-- MODAL EDIT DEPOSITO --}}
  <div class="modal fade" id="modal-edit-deposito">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <form action="/bo_dp_de_deposito" id="formeditdeposito" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Deposito</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Baris ke 1 ADD deposito ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="einputstatus">Status</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" id="einputstatus1" name="einputstatus" value="1">
                    <label class="form-check-label" style="margin-right:30px;">Baru</label>
                    <input class="form-check-input" type="radio" id="einputstatus2" name="einputstatus" value="2">
                    <label class="form-check-label" style="margin-right:30px;">Aktif</label>
                    <input class="form-check-input" type="radio" id="einputstatus3" name="einputstatus" value="3">
                    <label class="form-check-label">Tutup</label>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="einputnasabahid">Cabang</label>
                    @foreach($kodecabang as $value)
                    <input type="text" name="ecab" readonly class="form-control" value="{{$value->kode_cab}}">{{$value->nama_cab}}
                    @endforeach
                  </div>
              </div>
              
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <label for="einputjenisdeposito">Jenis Deposito</label>
                    <select class="form-control" name="ejenis_deposito" id="elistjenisdeposito" required>
                      <option value="" selected></option>
                      @foreach($kodejenisdeposito as $value)
                      <option value="{{ $value->KODE_JENIS_DEPOSITO}}" data-ebunga="{{$value->SUKU_BUNGA_DEFAULT}}" data-epph="{{$value->PPH_DEFAULT}}" data-ejkw="{{$value->JKW_DEFAULT}}" data-eflagdep="{{$value->FLAG_DEPOSITO}}" data-etypesukubunga="{{$value->TYPE_SUKU_BUNGA}}" data-eprovisi="{{$value->PROSEN_PROVISI}}" data-eadm="{{$value->PROSEN_ADM}}">{{ $value->KODE_JENIS_DEPOSITO.'-'.$value->DESKRIPSI_JENIS_DEPOSITO}}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="enorek">No.Rekening</label>
                  <input id="enorek" type="text" name="eno_rekening" class="form-control" readonly required>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="eno_bilyet">No. Bilyet</label>
                  <input id="eno_bilyet" type="text" name="eno_bilyet" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="editidnasabah">Nasabah / Anggota ID</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input id="editidnasabah" type="text" name="enasabah_id" readonly class="form-control" required>

                    <div class="input-group-append" data-toggle="modal" data-target="#ambildatanasabah">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>

                  </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="editnamanasabah">Nama</label>
                  <input type="text" id="editnamanasabah" name="enama_nasabah" readonly class="form-control">
                </div>
                <div class="col-lg-2 col-sm-12">
                  <label for="eqq">QQ</label>
                  <input type="text" id="einputqq" name="eqq" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="editalamatnasabah">Alamat</label>
                  <input type="text" id="editalamatnasabah" name="ealamat" readonly class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="ejmldeposito">Jumlah Deposito</label>
                  <input type="text" name="ejml_deposito" class="form-control" id="ejmldeposito" required>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="eblokir">.</label>
                  <div class="row">
                    <div class="form-check">
                      <input id="eblokir" type="checkbox" name="eblokir" class="form-check-input">
                      <label for="eblokir">Blokir</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-'6'">
                  <label for="etype_bunga">Tipe Bunga</label>
                  <select class="form-control" name="etype_bunga" id="etype_bunga">
                    <option value="" selected></option>
                    <option value=1>BUNGA REGULER</option>
                    <option value=2>BUNGA SBI</option>
                  </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="esuku_bunga">Bunga per Tahun(%)</label>
                  <input type="text" name="esuku_bunga" class="form-control" id="esuku_bunga" required>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="epersen_pph">PPH per Bulan (%)</label>
                  <input type="text" name="epersen_pph"  class="form-control" id="epersen_pph">
                </div>
              </div>            
            </div>
            <div class="bottomlinesolid">
              <span class="judulOrange">Overbooking Bunga Deposito</span>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="inputDate4">Tgl Registrasi</label>
                  <input type="text" name="etgl_registrasi" id="etgl_registrasidepo" class="form-control" value="{{ date('Y-m-d') }}" placeholder="yyyy-mm-dd" required/>
                  <!-- <div class="input-group date" id="inputDate4" data-target-input="nearest">
                    <input type="text" name="etgl_registrasi" class="form-control datetimepicker-input" data-target="#inputDate4"/>
                      <div class="input-group-append" data-target="#inputDate4" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div> -->
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="ejkw">JW</label>
                  <input type="text" name="ejkw" class="form-control" id="ejkw" required>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputDate5">Tgl JT</label>
                  <div class="input-group date" id="inputDate5" data-target-input="nearest">
                    <input type="text" name="etgl_jt" class="form-control datetimepicker-input" data-target="#inputDate5" value="{{ date('Y-m-d') }}" readonly/>
                      <div class="input-group-append" data-target="#inputDate5" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="emasuktitipan">.</label>
                  <div class="row">
                    <div class="form-check col-lg-6 col-sm-12">
                      <input id="emasuktitipan" type="checkbox" name="emasuktitipan" class="form-check-input">
                      <label for="emasuktitipan">Masuk ke Titipan</label>
                    </div>
                    <div class="form-check col-lg-6 col-sm-12">
                      <input id="ebungaberbunga" type="checkbox" name="ebungaberbunga" class="form-check-input">
                      <label for="ebungaberbunga">Bunga Berbunga</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="editkerekeningtab">Ke Rekening Tab</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input id="editkerekeningtab" type="text" name="ekerekeningtab" readonly class="form-control" required>

                    <div class="input-group-append" data-toggle="modal" data-target="#ambildatarektab">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputDate6">Tgl Penampatan</label>
                  <div class="input-group date" id="inputDate6" data-target-input="nearest">
                    <input type="text" name="etgl_penempatan" class="form-control datetimepicker-input" data-target="#inputDate6" value="{{ date('Y-m-d') }}" readonly/>
                      <div class="input-group-append" data-target="#inputDate6" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-1 col-sm-6">
                  <label for="etgl_valuta">Tgl Valuta</label>
                  <input type="text" name="etgl_valuta" class="form-control" id="etgl_valuta" value="{{ date('d') }}" required readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="earo">.</label>
                  <div class="row">
                    <div class="form-check">
                      <input id="earo" type="checkbox" name="earo" class="form-check-input">
                      <label for="earo">ARO (Update Tagl Registrasi & SBI)</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <label for="ecatatanaro">Catatan</label>
                  <input type="text" name="ecatatanaro" class="form-control" id="ecatatanaro">
                </div>
              </div>
            </div>
            <div class="bottomlinesolid"></div>
            <!--Baris ke 3 ADD deposito ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-sm-6">
                <label for="eidkodegroup1">Kode Group 1</label>
                  <select class="form-control" name="ekode_group1">
                    <option id="eidkodegroup1" selected></option>
                    @foreach($kodegroup1deposito as $value)
                    <option value="{{$value->KODE_GROUP1}}">{{$value->KODE_GROUP1.'-'.$value->DESKRIPSI_GROUP1}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="eidkodegroup2">Kode Group 2</label>
                    <select class="form-control" name="ekode_group2">
                      <option id="eidkodegroup2" selected></option>
                      @foreach($kodegroup2deposito as $value)
                      <option value="{{$value->KODE_GROUP2}}">{{$value->KODE_GROUP2.'-'.$value->DESKRIPSI_GROUP2}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="eidkodegroup3">Kode Group 3</label>
                  <select class="form-control" name="ekode_group3">
                    <option id="eidkodegroup3" selected></option>
                    @foreach($kodegroup3deposito as $value)
                    <option value="{{$value->KODE_GROUP3}}">{{$value->KODE_GROUP3.'-'.$value->DESKRIPSI_GROUP3}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="eidkodebi">Gol. pihak lawan</label>
                  <select class="form-control" name="ekode_bi_pemilik">
                    <option id="eidkodebi" selected></option>
                    @foreach($golonganpihaklawan as $value)
                    <option value="{{$value->sandi}}">{{$value->sandi}}-{{$value->deskripsi_golongan}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="eidbihubungan">Sandi pihak terkait</label>
                    <select class="form-control" name="ekode_bi_hubungan">
                      <option id="eidbihubungan" selected></option>
                      @foreach($kodeketerkaitanlapbul as $value)
                      <option value="{{$value->SANDI}}">{{$value->SANDI.'-'.$value->DESKRIPSI_SANDI}}</option>
                      @endforeach
                    </select>
                </div>
              </div>   
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                <label for="etipe_deposito">Tipe Deposito</label>
                  <select class="form-control" id="etipe_deposito" name="etipe_deposito">
                    <option value="" selected></option>
                    <option value="1">Deposito</option>
                    <option value="2">AB-PASIVA</option>
                    <option value="3">AB-AKTIVA</option>
                  </select>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="emetoda">Metoda</label>
                    <select class="form-control" name="emetoda">
                      <option id="emetoda" selected></option>
                      @foreach($kodemetoda as $value)
                      <option value="{{$value->KODE_METODA}}">{{$value->KODE_METODA.'-'.$value->DESKRIPSI_METODA}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="eketerangan">Keterangan</label>
                  <input type="text" name="eketerangan" class="form-control" id="eketerangan">
                </div>
              </div>          
            </div>
            <div class="bottomlinesolid">
              <span class="judulOrange">Antar Bank Aktiva</span>
            </div>
            <!--Baris ke 4 ADD deposito ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="eprovisi">Provisi</label>
                  <input type="text" name="eprovisi" class="form-control" value="{{ number_format(0,2) }}" id="eprovisi" readonly>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="eadministrasi">Administrasi</label>
                  <input type="text" name="eadministrasi" class="form-control" value="{{ number_format(0,2) }}" id="eadministrasi" readonly>
                  <input type="hidden" name="eno_rekeningHashedit"  class="form-control"/>
                  <input type="hidden" name="_method" value="PUT"/>
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
  </div>   {{-- BATAS MODAL EDIT DEPOSITO --}}

  {{-- MODAL UNTUK MENAMPILKAN TAMBAH DATA DEPOSITO --}}
  <div class="modal fade bs-modal-deposito" id="modal-add-deposito">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <form action="/bo_dp_de_deposito" method="post" enctype="multipart/form-data" id="formadddeposito">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Data Entry Deposito</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Baris ke 1 ADD deposito ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="inputstatus">Status</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputstatus" value="1" checked>
                    <label class="form-check-label" style="margin-right:30px;">Baru</label>
                    <input class="form-check-input" type="radio" name="inputstatus" value="2" disabled>
                    <label class="form-check-label" style="margin-right:30px;">Aktif</label>
                    <input class="form-check-input" type="radio" name="inputstatus" value="3" disabled>
                    <label class="form-check-label">Tutup</label>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="inputnasabahid">Cabang</label>
                    @foreach($kodecabang as $value)
                    <input type="text" name="cab" readonly class="form-control" value="{{$value->kode_cab}}">{{$value->nama_cab}}
                    @endforeach
                  </div>
              </div>
              
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <label for="inputjenisdeposito">Jenis Deposito</label>
                    <select class="form-control" name="jenis_deposito" id="listjenisdeposito" required>
                      <option value="" selected></option>
                      @foreach($kodejenisdeposito as $value)
                      <option value="{{ $value->KODE_JENIS_DEPOSITO}}" data-ebunga="{{$value->SUKU_BUNGA_DEFAULT}}" data-epph="{{$value->PPH_DEFAULT}}" data-ejkw="{{$value->JKW_DEFAULT}}" data-eflagdep="{{$value->FLAG_DEPOSITO}}" data-etypesukubunga="{{$value->TYPE_SUKU_BUNGA}}" data-eprovisi="{{$value->PROSEN_PROVISI}}" data-eadm="{{$value->PROSEN_ADM}}">{{ $value->KODE_JENIS_DEPOSITO.'-'.$value->DESKRIPSI_JENIS_DEPOSITO}}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="norek">No.Rekening</label>
                  <input id="norekadd" type="text" name="no_rekening" class="form-control" required>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="bilyet">No. Bilyet</label>
                  <input id="no_bilyet" type="text" name="no_bilyet" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="nasabahid">Nasabah / Anggota ID</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input id="inputNasabahIdadd" type="text" name="nasabah_id" readonly class="form-control" required>

                    <div class="input-group-append" data-toggle="modal" data-target="#ambildatanasabah">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>

                  </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputnocif">Nama</label>
                  <input type="text" id="inputNamaNasabahadd" name="nama_nasabah" readonly class="form-control">
                </div>
                <div class="col-lg-2 col-sm-12">
                  <label for="qq">QQ</label>
                  <input type="text" id="inputqqadd" name="qq" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputnocif">Alamat</label>
                  <input type="text" id="inputalamatadd" name="alamat" readonly class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="jmldeposito">Jumlah Deposito</label>
                  <input type="text" name="jml_deposito" class="form-control" id="jmldeposito" required>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="blokir">.</label>
                  <div class="row">
                    <div class="form-check">
                      <input id="blokir" type="checkbox" name="blokir" class="form-check-input" disabled>
                      <label for="blokir">Blokir</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-'6'">
                  <label for="inputtipe">Tipe Bunga</label>
                  <select class="form-control" name="type_bunga" id="type_bunga">
                    <option value="" selected></option>
                    <option value=1>BUNGA REGULER</option>
                    <option value=2>BUNGA SBI</option>
                  </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputnocif">Bunga per Tahun(%)</label>
                  <input type="text" name="suku_bunga" class="form-control" id="bunga" required>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputnocif">PPH per Bulan (%)</label>
                  <input type="text" name="persen_pph"  class="form-control" id="pph">
                </div>
              </div>            
            </div>
            <div class="bottomlinesolid">
              <span class="judulOrange">Overbooking Bunga Deposito</span>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="inputDate1">Tgl Registrasi</label>
                  <input type="text" name="tgl_registrasi" id="tgl_registrasidepo" class="form-control" value="{{ date('Y-m-d') }}" placeholder="yyyy-mm-dd" required/>
                  <!-- <div class="input-group date" id="inputDate1" data-target-input="nearest">
                    <input type="text" name="tgl_registrasi" id="tgl_registrasidepo" class="form-control datetimepicker-input" data-target="#inputDate1"/>
                      <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div> -->
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="jkw">JW</label>
                  <input type="text" name="jkw" onchange="myTime();" class="form-control" id="addjkw" required>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputDate2">Tgl JT</label>
                  <div class="input-group date" id="inputDate2" data-target-input="nearest">
                    <input type="text" id="addtgl_jt" name="tgl_jt" class="form-control datetimepicker-input" data-target="#inputDate2" readonly/>
                      <div class="input-group-append" data-target="#inputDate2" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="masuktitipan">.</label>
                  <div class="row">
                    <div class="form-check col-lg-6 col-sm-12">
                      <input id="masuktitipan" type="checkbox" name="masuktitipan" class="form-check-input">
                      <label for="masuktitipan">Masuk ke Titipan</label>
                    </div>
                    <div class="form-check col-lg-6 col-sm-12">
                      <input id="bungaberbunga" type="checkbox" name="bungaberbunga" class="form-check-input">
                      <label for="bungaberbunga">Bunga Berbunga</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="kerekeningtab">Ke Rekening Tab</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input id="inputkerekeningtabadd" type="text" name="kerekeningtab" readonly class="form-control" required>

                    <div class="input-group-append" data-toggle="modal" data-target="#ambildatarektab">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputDate3">Tgl Penampatan</label>
                  <div class="input-group date" id="inputDate3" data-target-input="nearest">
                    <input type="text" name="tgl_penempatan" class="form-control datetimepicker-input" data-target="#inputDate3" value="{{ date('Y-m-d') }}" readonly/>
                      <div class="input-group-append" data-target="#inputDate3" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-1 col-sm-6">
                  <label for="tgl_valuta">Tgl Valuta</label>
                  <input type="text" name="tgl_valuta" class="form-control" id="tgl_valuta" value="{{ date('d') }}" required readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="aro">.</label>
                  <div class="row">
                    <div class="form-check">
                      <input id="aro" type="checkbox" name="aro" class="form-check-input" checked>
                      <label for="aro">ARO (Update Tagl Registrasi & SBI)</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <label for="catatanaro">Catatan</label>
                  <input type="text" name="catatanaro" class="form-control" id="catatanaro">
                </div>
              </div>
            </div>
            <div class="bottomlinesolid"></div>
            <!--Baris ke 3 ADD deposito ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-sm-6">
                <label for="inputjk">Kode Group 1</label>
                  <select class="form-control" name="kode_group1">
                    <option id="idkodegroup1" selected></option>
                    @foreach($kodegroup1deposito as $value)
                    <option value="{{$value->KODE_GROUP1}}">{{$value->KODE_GROUP1.'-'.$value->DESKRIPSI_GROUP1}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputjk">Kode Group 2</label>
                    <select class="form-control" name="kode_group2">
                      <option id="idkodegroup2" selected></option>
                      @foreach($kodegroup2deposito as $value)
                      <option value="{{$value->KODE_GROUP2}}">{{$value->KODE_GROUP2.'-'.$value->DESKRIPSI_GROUP2}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-sm-6">
                  <label for="inputjk">Kode Group 3</label>
                  <select class="form-control" name="kode_group3">
                    <option id="idkodegroup3" selected></option>
                    @foreach($kodegroup3deposito as $value)
                    <option value="{{$value->KODE_GROUP3}}">{{$value->KODE_GROUP3.'-'.$value->DESKRIPSI_GROUP3}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputjk">Gol. pihak lawan</label>
                  <select class="form-control" name="kode_bi_pemilik" required>
                    <option id="idkodebi" selected></option>
                    @foreach($golonganpihaklawan as $value)
                    <option value="{{$value->sandi}}">{{$value->sandi}}-{{$value->deskripsi_golongan}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputjk">Sandi pihak terkait</label>
                    <select class="form-control" name="kode_bi_hubungan" required>
                      <option id="idbihubungan" selected></option>
                      @foreach($kodeketerkaitanlapbul as $value)
                      <option value="{{$value->SANDI}}">{{$value->SANDI.'-'.$value->DESKRIPSI_SANDI}}</option>
                      @endforeach
                    </select>
                </div>
              </div>   
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                <label for="tipe_deposito">Tipe Deposito</label>
                  <select class="form-control" id="tipe_deposito" name="tipe_deposito">
                    <option value="" selected></option>
                    <option value="1">Deposito</option>
                    <option value="2">AB-PASIVA</option>
                    <option value="3">AB-AKTIVA</option>
                  </select>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="metoda">Metoda</label>
                    <select class="form-control" name="metoda" required>
                      <option id="metoda" selected></option>
                      @foreach($kodemetoda as $value)
                      <option value="{{$value->KODE_METODA}}">{{$value->KODE_METODA.'-'.$value->DESKRIPSI_METODA}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" name="keterangan" class="form-control" id="keterangan">
                </div>
              </div>          
            </div>
            <div class="bottomlinesolid">
              <span class="judulOrange">Antar Bank Aktiva</span>
            </div>
            <!--Baris ke 4 ADD deposito ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="inputnpwp">Provisi</label>
                  <input type="text" name="provisi" class="form-control" value="{{ number_format(0,2) }}" id="provisi" readonly>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="inputidentitas">Administrasi</label>
                  <input type="text" name="administrasi" class="form-control" value="{{ number_format(0,2) }}" id="adm" readonly>
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
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
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
                  <div class="dropdown-menu">
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

  {{-- MODAL TAMPIL TABEL NO REKENING --}}
  <div class="modal fade bs-modal-tab" id="ambildatarektab" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ambildatarektab">Data Rekening Tabungan</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
          <table id="rektabungandata" class="display" width="100%">
            <thead>
              <tr>
                  <th>No Rekening Tabungan</th>
                  <th>Nama Nasabah</th>
                  <th>Alamat Nasabah</th>
                  <th>Jenis Tabungan</th>
                  <th>Saldo Akhir</th>

                  <th>Action</th>

              </tr>
            </thead>
            <tbody>
                @foreach($tabungan as $value)
                <tr>
                <td>{{ $value->NASABAH_ID }}</td>
                <td>{{ $value->nama_nasabah }}</td>
                <td>{{ $value->alamat }}</td>
                <td>{{ $value->JENIS_TABUNGAN }}</td>
                <td>{{ $value->SALDO_AKHIR }}</td>

                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu">
                    <a id="tes2" href="#" class="dropdown-item">
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
