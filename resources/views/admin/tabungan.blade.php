@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tabungan/cari" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="idnasabah1">no_rekening</label> 
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnasabah1" name="idnasabah1" placeholder="Masukkan No Rek Tabungan">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">nama_nasabah</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabah1" placeholder="Masukkan Nama Nasabah">
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
          </form>
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
            <table id="example1" class="table table-bordered table-hover">
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
              @foreach(array_chunk($tabungan->all(),1) as $index=>$values)
              @php($index++)
                @foreach ($values as $kunci=>$tabungans)

                    @if($tabungans->status_aktif==1)
                      @php ($status='Baru')
                    @elseif($tabungans->status_aktif==2)
                      @php ($status='Aktif')
                    @else
                      @php ($status='Tutup')
                    @endif

                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ strtoupper($tabungans->no_rekening) }}</td>
                  <td>{{ $tabungans->nama_nasabah }}</td>
                  <td>{{ $tabungans->alamat}}</td>
                  <td>{{ $tabungans->jenis_tabungan}}</td>
                  <td>{{ $tabungans->saldo_akhir }}</td>
                  <td>
                    <!-- <form action="#" method="post">
                       <button type="submit" class="btn btn-block bg-gradient-gray btn-sm">
                        Action
                       <i class="right fas fa-angle-down"></i>
                       </button>
                    </form> -->
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <form action="/prof_tab_detail" method="post" style="margin-bottom: 0;">
                          <button type="submit" tabindex="-1" class="dropdown-item">
                            Detail
                          </button>
                          <input type="hidden" name="inputIdTransaction" value="{{ $tabungans->no_rekening }}" class="form-control">
                          @csrf
                      </form>
                      <a href="{{'edittab/'.$tabungans->no_rekening}}" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-transaction">
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
  <div class="modal fade" id="modal-edit-transaction">
    <div class="modal-dialog modal-xl">
      <form action="/bo_cs_de_nasabah" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Nasabah</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTransactionNo">Transaction No</label>
                  <input type="text" name="inputTransactionNo" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputResi">Resi No</label>
                  <input type="text" name="inputResi" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputCustomerName">Customer Name</label>
                  <input type="text" name="inputCustomerName" readonly class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                <label for="inputDate">Date</label>
                  <div class="input-group date" id="inputDate3" data-target-input="nearest">
                      <input type="text" name="inputDate3" class="form-control datetimepicker-input" data-target="#inputDate3"/>
                      <div class="input-group-append" data-target="#inputDate3" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputFromCity">From City</label>
                  <input type="text" name="inputFromCity" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputToCity">To City</label>
                  <input type="text" name="inputToCity" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                <label for="inputPelayaran">Vessel</label>
                  <select class="form-control" name="inputPelayaran">
                    <option value="#" selected="true" disabled="disabled">--- Select Vessel ---</option>
                    <?php /*@foreach($pelayarans as $pelayaran)
                    <option value="{{ $pelayaran->id }}">{{ $pelayaran->code_pelayaran.' - '.$pelayaran->name_pelayaran.', '.$pelayaran->alias }}</option>
                    @endforeach*/?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-9 col-sm-12"></div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="inputStatus">
                    <option value="#" selected="true" disabled="disabled">--- Select Status ---</option>
                    <option value="0">Process</option>
                    <option value="1">Success</option>
                    <option value="9">Canceled</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdTransaction" class="form-control">
              <input type="hidden" name="_method" value="PUT"/>
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
  <div class="modal fade" id="modal-add-tabungan">
    <div class="modal-dialog modal-xl">
      <form action="/bo_cs_de_nasabah" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Data Entry Tabungan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">     
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <ul class="nav nav-pills p-2">
                  <li class="nav-item"><a class="nav-link active" href="#form_add_tab" data-toggle="tab">Form</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- TAB PANE ISIAN FORM ENTRY DATA TABUNGAN -->
                  <div class="tab-pane active" id="form_add_tab">
                    <!--Baris 1 entry tabungan ----->
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-2 col-sm-6">
                            <label for="inputidentitas">Jenis Tabungan</label>
                            <select class="form-control" name="jenis_tabungan">
                              <option value="#" selected="true" disabled="disabled">--- Jenis Tabungan ---</option>
                              @foreach($kodejenistabungan as $value)
                              <option value="{{ $value->kode_jenis_tabungan }}">{{ $value->deskripsi_jenis_tabungan }}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="norek">No.Rekening</label>
                          <input type="text" name="no_rekening" class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputopendate">No.Series</label>
                          <input type="text" name="no_alternatif" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-8">
                          <label for="inputnasabahid">Cabang</label>
                          <input type="text" name="cab" readonly class="form-control" value="{{$kodecabang}}">
                        </div>
                        <div class="col-lg-1 col-sm-4">
                          <label for="nasabahid">Nasabah / Anggota ID</label>
                          <input type="text" name="nasabah_id" readonly class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-8">
                          <label for="inputnocif">Nama</label>
                          <input type="text" name="nama" readonly class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-8">
                          <label for="inputnocif">Alamat</label>
                          <input type="text" name="alamat" readonly class="form-control">
                        </div>
                        <select class="form-control" name="tipe">
                          <option value="#" selected="true" disabled="disabled">--- Jenis Tabungan ---</option>
                          <option value="normal">Normal</option>
                          <option value="kepala instansi">Kepala Instansi</option>
                          <option value="juru bayar">Juru Bayar</option>
                        </select>
                        <div class="col-lg-2 col-sm-8">
                          <label for="inputnocif">Bunga per Tahun(%)</label>
                          <input type="text" name="suku_bunga"  class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-8">
                          <label for="inputnocif">PPH (%)</label>
                          <input type="text" name="persen_pph"  class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputnamanasabah">Tgl Terhitung Bunga</label>
                          @foreach($tgllogin as $tgllogin)
                          <input type="text" name="tgl_bunga" value="{{$tgllogin->Value}}" class="form-control">
                          @endforeach
                        </div>
                        <div class="col-lg-1 col-sm-4">
                          <input type="checkbox" name="inputblokir" class="form-checkbox">
                          <label for="inputblokir">Blokir</label>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputnamanasabah">Saldo Blokir</label>
                          <input type="text" name="saldo_blokir" value="0" class="form-control">
                        </div>

                    </div>
                    <!--Batas Baris 1 entry tabungan ----->

                    <!--Baris 2 entry tabungan ----->
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-2 col-sm-6">
                        <label for="inputjk">Kode Group 1</label>
                          <select class="form-control" name="kode_group1">
                            <option value="" selected="true" disabled="disabled">--- Pilih Group 1 ---</option>
                            @foreach($kodegrou1tabungan as $value)
                            <option value="{{$value->kode_group1}}">{{$value->deskripsi_group1}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputjk">Kode Group 2</label>
                            <select class="form-control" name="kode_group2">
                              <option value="" selected="true" disabled="disabled">--- Pilih Group 2 ---</option>
                              @foreach($kodegrou2tabungan as $value)
                              <option value="{{$value->kode_group2}}">{{$value->deskripsi_group2}}</option>
                              @endforeach
                            </select>
                        </div>
                            <div class="col-lg-2 col-sm-6">
                              <label for="inputjk">Kode Group 3</label>
                              <select class="form-control" name="kode_group3">
                                <option value="" selected="true" disabled="disabled">--- Pilih Group 3 ---</option>
                                @foreach($kodegrou3tabungan as $value)
                                <option value="{{$value->kode_group3}}">{{$value->deskripsi_group3}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                              <label for="inputjk">Gol. pihak lawan</label>
                                <select class="form-control" name="kode_bi_pemilik">
                                  <option value="" selected="true" disabled="disabled">--- Pilih ---</option>
                                  @foreach($golonganpihaklawan as $value)
                                  <option value="{{$value->sandi}}">{{$value->deskripsi_golongan}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-lg-2 col-sm-6">
                                <label for="inputjk">Metoda</label>
                                  <select class="form-control" name="kode_bi_metoda">
                                    <option value="" selected="true" disabled="disabled">--- Pilih Metoda ---</option>
                                    @foreach($kodemetoda as $value)
                                    <option value="{{$value->kode_metoda}}">{{$value->deskripsi_metoda}}</option>
                                    @endforeach
                                  </select>
                              </div>
                                <div class="col-lg-2 col-sm-6">
                                  <label for="inputjk">Sandi pihak terkait</label>
                                    <select class="form-control" name="kode_bi_hubungan">
                                      <option value="" selected="true" disabled="disabled">--- Pilih terkait ---</option>
                                      @foreach($kodeketerkaitanlapbul as $value)
                                      <option value="{{$value->sandi}}">{{$value->deskripsi_sandi}}</option>
                                      @endforeach
                                    </select>
                                </div>
                        </div>
                    </div>
                    <!--Batas Baris 2 entry tabungan ----->

                    <!--Baris ke 3 entry tabungan ----->
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputibukandung">Restricted</label>
                          <select class="form-control" name="flag_restricted">
                            <option value="" selected="true" disabled="disabled">--- Pilih ---</option>
                            <option value="UNRESTRICTED">UNRESTRICTED</option>
                            <option value="RESTRICTED">RESTRICTED</option>
                          </select>
              </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputnpwp">Saldo Minimal</label>
                          <input type="text" name="minimum" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputidentitas">Setoran Minimal</label>
                          <input type="text" name="setoran_minimum" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputnoidentitas">Setoran Wajib</label>
                          <input type="text" name="setoran_per_bln" class="form-control" value=0.00>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputDate2">Tipe Tab</label>
                          <select class="form-control" name="abp" >
                            <option value="1" selected="true" >Tabungan</option>
                            <option value="2">AB-PASIVA</option>
                            <option value="3">AB-AKTIVA</option>
                            <option value="4">Modal</option>
                            <option value="5">Kewajiban</option>
                          </select>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label>Biaya Adm</label>
                          <input type="text" name="adm_per_bln" class="form-control" value=0.00>
                          <input type="hidden" name="periode_adm" class="form-control" value=1>
                        </div>
                      </div>
                    </div>
                    <!--Batas Baris ke 3 entry tabungan ----->
                  </div>
                  <!-- BATAS TAB PANE ISIAN FORM ENTRY DATA TABUNGAN -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
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
</div>
<!-- /.content -->
@endsection
