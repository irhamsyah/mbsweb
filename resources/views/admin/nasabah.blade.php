@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_cs_de_nasabah/cari" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="idnasabah1">Id Nasabah</label> 
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnasabah1" name="idnasabah1" placeholder="Masukkan ID Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">Nama Nasabah</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabah1" placeholder="Masukkan Nama Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="jenisnasabah1">Jenis Nasabah</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="jenisnasabah1" name="jenisnasabah1" placeholder="Masukkan Jenis Nasabah">
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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-nasabah" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Nasabah</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nasabah ID</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>TTL</th>
                <th>Jenis Kelamin</th>
                <th>Ibu Kandung</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($nasabahs as $index => $nasabah)
                  @if($nasabah->Black_List==0)
                    @php ($status='Aktif')
                  @elseif($nasabah->Black_List==1)
                    @php ($status='Blokir')
                  @else
                    @php ($status='Tidak Aktif')
                  @endif
                  @if($nasabah->tgllahir==NULL)
                    @php ($tgllahir='')
                  @else
                    @php ($tgllahir=$nasabah->tgllahir->format('d/m/Y'))
                  @endif
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($nasabah->nasabah_id) }}</td>
                  <td>{{ $nasabah->nama_nasabah }}</td>
                  <td>{{ strtoupper($nasabah->alamat.' '.$nasabah->kelurahan.' '.$nasabah->kecamatan) }}</td>
                  <td>{{ $nasabah->tempatlahir.', '.$tgllahir }}</td>
                  <td>{{ $nasabah->jenis_kelamin }}</td>
                  <td>{{ $nasabah->ibu_kandung }}</td>
                  <td>{{ $status }}</td>
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
                      <form action="/adm_nasabah_detail" method="post" style="margin-bottom: 0;">
                          <button type="submit" tabindex="-1" class="dropdown-item">
                            Detail
                          </button>
                          <input type="hidden" name="inputIdTransaction" value="{{ $nasabah->nasabah_id }}" class="form-control">
                          @csrf
                      </form>
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-transaction">
                          Edit
                      </a>
                      <form action="/adm_transaction" method="post"  style="margin-bottom: 0;" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                          <button type="submit" tabindex="-1" class="dropdown-item">
                            Delete
                          </button>
                          <input type="hidden" name="inputIdTransaction" value="{{ $nasabah->nasabah_id }}" class="form-control">
                          <input type="hidden" name="_method" value="DELETE"/>
                          @csrf
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Nasabah ID</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>TTL</th>
                <th>Jenis Kelamin</th>
                <th>Ibu Kandung</th>
                <th>Status</th>
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
  </div>
  <div class="modal fade" id="modal-add-nasabah">
    <div class="modal-dialog modal-xl">
      <form action="/bo_cs_de_nasabah" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Data Entry Nasabah</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <ul class="nav nav-pills p-2">
                  <li class="nav-item"><a class="nav-link active" href="#informasi_pribadi" data-toggle="tab">Informasi Pribadi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#kontak_alamat" data-toggle="tab">Kontak & Alamat</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pekerjaan_pendidikan" data-toggle="tab">Pekerjaan & Pendidikan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#lainnya" data-toggle="tab">Lainnya</a></li>
                  <li class="nav-item"><a class="nav-link" href="#specimen" data-toggle="tab">Specimen</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="informasi_pribadi">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputdin">D.I.N - BI</label>
                          <input type="text" name="inputdin" readonly class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputopendate">Open Date</label>
                          <input type="text" name="inputopendate" readonly class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-8">
                          <label for="inputnasabahid">Nasabah ID</label>
                          <input type="text" name="inputnasabahid" class="form-control">
                        </div>
                        <div class="col-lg-1 col-sm-4">
                          <label for="inputnocif">Cab</label>
                          <input type="text" name="inputcab" readonly value="001" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-8">
                          <label for="inputnocif">No CIF</label>
                          <input type="text" name="inputnocif" readonly class="form-control">
                        </div>
                        <div class="col-lg-1 col-sm-4">
                          <input type="checkbox" name="inputblacklist" class="form-checkbox">
                          <label for="inputblacklist">Blacklist</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputnamanasabah">Nama Nasabah</label>
                          <input type="text" name="inputnamanasabah" class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputalias">Alias</label>
                          <input type="text" name="inputalias" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputtempatlahir">Tempat Lahir</label>
                          <input type="text" name="inputtempatlahir" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputDate1">Tanggal Lahir</label>
                          <div class="input-group date" id="inputDate1" data-target-input="nearest">
                              <input type="text" name="inputtgllahir" class="form-control datetimepicker-input" data-target="#inputDate3"/>
                              <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                        <label for="inputjk">Jenis Kelamin</label>
                          <select class="form-control" name="inputjk">
                            <option value="" selected="true" disabled="disabled">--- Pilih L/P ---</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputibukandung">Nama Ibu Kandung</label>
                          <input type="text" name="inputibukandung" class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputnpwp">NPWP</label>
                          <input type="text" name="inputnpwp" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputidentitas">Jenis Identitas</label>
                          <select class="form-control" name="inputidentitas">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Identitas ---</option>
                            @foreach($identitass as $identitas)
                            <option value="{{ $identitas->jenis_id }}">{{ $identitas->nama_identitas }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputnoidentitas">No. Identitas</label>
                          <input type="text" name="inputnoidentitas" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-6">
                          <label for="inputDate2">Masa Berlaku</label>
                          <div class="input-group date" id="inputDate2" data-target-input="nearest">
                              <input type="text" name="inputmasaberlaku" class="form-control datetimepicker-input" data-target="#inputDate3"/>
                              <div class="input-group-append" data-target="#inputDate2" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputagama">Agama</label>
                          <select class="form-control" name="inputagama">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Agama ---</option>
                            @foreach($kodegroup1nasabahs as $kodegroup1nasabah)
                            <option value="{{ $kodegroup1nasabah->NASABAH_GROUP1 }}">{{ $kodegroup1nasabah->DESKRIPSI_GROUP1 }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputkawin">Status Kawin</label>
                          <select class="form-control" name="inputkawin">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Status Kawin ---</option>
                            @foreach($perkawinans as $perkawinan)
                            <option value="{{ $perkawinan->kode_perkawinan }}">{{ $perkawinan->Deskripsi }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="kontak_alamat">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <label for="inputdomisili">Alamat Domisili</label>
                          <input type="text" name="inputdomisili" class="form-control">
                        </div>
                        <div class="col-lg-1 col-sm-2">
                          <label for="inputkodetlp">Kode Telp</label>
                          <input type="number" name="inputkodetlp" placeholder="031" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                          <label for="inputnotlp">No Telp</label>
                          <input type="number" name="inputnotlp" placeholder="7217201" class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputnohp">No HP</label>
                          <input type="number" name="inputnohp" placeholder="081xxxxxxxxx" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <label for="inputalamat">Alamat KTP</label>
                          <input type="text" name="inputalamat" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-12">
                          <label for="inputkelurahan">Kelurahan</label>
                          <input type="text" name="inputkelurahan" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-12">
                          <label for="inputkecamatan">Kecamatan</label>
                          <input type="text" name="inputkecamatan" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-12">
                          <label for="inputkodepos">Kode Pos</label>
                          <input type="text" name="inputkodepos" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputkota">Kota</label>
                          <select class="form-control select2" name="inputkota">
                            <option value="#" disabled="disabled">--- Pilih Kota ---</option>
                            @foreach($kotas as $kota)
                            <option value="{{ $kota->Kota_id }}" <?php if($kota->Kota_id=='1202'){echo 'selected';} ?> >{{ $kota->Kota_id.' - '.$kota->Deskripsi_Kota }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputnegara">Domisili Negara</label>
                          <select class="form-control select2" name="inputnegara">
                            <option value="#" disabled="disabled">--- Pilih Negara ---</option>
                            @foreach($negaras as $negara)
                            <option value="{{ $negara->KODE_NEGARA }}" <?php if($negara->KODE_NEGARA=='ID'){echo 'selected';} ?>>{{ $negara->KODE_NEGARA.' - '.$negara->DESKRIPSI_NEGARA }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="pekerjaan_pendidikan">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputnamaperusahaan">Nama Perusahaan</label>
                          <input type="text" name="inputnamaperusahaan" class="form-control">
                        </div>
                        <div class="col-lg-9 col-sm-12">
                          <label for="inputalamatperusahaan">Alamat Perusahaan</label>
                          <input type="text" name="inputalamatperusahaan" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputsumberdana">Sumber Dana</label>
                          <select class="form-control" name="inputsumberdana">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Sumber Dana ---</option>
                            <option value="1">Gaji</option>
                            <option value="2">Usaha</option>
                            <option value="3">Lainnya</option>
                          </select>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputpenghasilansetahun">Penghasilan Setahun</label>
                          <input type="number" name="inputpenghasilansetahun" class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputpekerjaan">Pekerjaan</label>
                          <select class="form-control select2" name="inputpekerjaan">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Pekerjaan ---</option>
                            @foreach($pekerjaans as $pekerjaan)
                            <option value="{{ $pekerjaan->Pekerjaan_id }}">{{ $pekerjaan->Pekerjaan_id.' - '.$pekerjaan->Desktripsi_Pekerjaan }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputgelar">Status / Gelar</label>
                          <select class="form-control" name="inputgelar">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Status / Gelar ---</option>
                            @foreach($gelars as $gelar)
                            <option value="{{ $gelar->Gelar_ID }}">{{ $gelar->Gelar_ID.' - '.$gelar->Deskripsi_Gelar }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="lainnya">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-4 col-sm-12">
                          <label for="inputbidangusahasid">Bidang Usaha SID</label>
                          <select class="form-control select2" name="inputbidangusahasid">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Bidang Usaha SID ---</option>
                            @foreach($bidangusahas as $bidangusaha)
                            <option value="{{ $bidangusaha->KODE_BIDANG_USAHA }}">{{ $bidangusaha->KODE_BIDANG_USAHA.' - '.$bidangusaha->DESKRIPSI_BIDANG_USAHA }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                          <label for="inputhubdebsid">Hubungan Debitur Dgn Bank SID</label>
                          <select class="form-control select2" name="inputhubdebsid">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Hubungan Debitur Dgn Bank SID ---</option>
                            @foreach($hubungandebiturs as $hubungandebitur)
                            <option value="{{ $hubungandebitur->KODE_HUBUNGAN }}">{{ $hubungandebitur->KODE_HUBUNGAN.' - '.$hubungandebitur->DESKRIPSI_HUBUNGAN }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                          <label for="inputgoldebsid">Golongan Debitur SID</label>
                          <select class="form-control select2" name="inputgoldebsid">
                            <option value="#" selected="true" disabled="disabled">--- Pilih Golongan Debitur SID ---</option>
                            @foreach($golongandebiturs as $golongandebitur)
                            <option value="{{ $golongandebitur->KODE_GOL_DEBITUR }}">{{ $golongandebitur->KODE_GOL_DEBITUR.' - '.$golongandebitur->DESKRIPSI_GOL_DEBITUR }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputnamapendamping">Nama Pendamping</label>
                          <input type="text" name="inputnamapendamping" class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputidpendamping">ID Pendamping</label>
                          <input type="text" name="inputidpendamping" class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <label for="inputDate3">Tanggal Lahir Pendamping</label>
                          <div class="input-group date" id="inputDate3" data-target-input="nearest">
                              <input type="text" name="inputtgllahirpendamping" class="form-control datetimepicker-input" data-target="#inputDate3"/>
                              <div class="input-group-append" data-target="#inputDate3" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputjmltanggungan">Jumlah Tanggungan</label>
                          <input type="number" name="inputjmltanggungan" placeholder="(Jumlah Orang)" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-3 col-sm-12">
                          <label for="inputtujuanbukarek">Tujuan Pembukaan Rek</label>
                          <input type="text" name="inputtujuanbukarek" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-12">
                          <label for="inputpenggunaandana">Penggunaan Dana</label>
                          <input type="text" name="inputpenggunaandana" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-12">
                          <label for="inputnamaahliwaris">Nama Ahli Waris</label>
                          <input type="number" name="inputnamaahliwaris" class="form-control">
                        </div>
                        <div class="col-lg-5 col-sm-12">
                          <label for="inputalamatahliwaris">Alamat Ahli Waris</label>
                          <input type="number" name="inputalamatahliwaris" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="specimen">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSh8kwBqclxTYXO2_5U7-LzGCL42efVyWRUKg3hWMSo&s" style="height:200px;"/>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                          <img src="https://t4.ftcdn.net/jpg/00/00/42/95/360_F_429547_YJTlwk2Ld5kYDAbtCUwFgzmatgUHEg.jpg" style="height:200px;"/>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <label for="inputFoto">Ambil Foto</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputFoto">
                              <label class="custom-file-label" for="inputisiFoto"></label>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                          <label for="inputtandatangan">Ambil Tanda Tangan</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputtandatangan">
                              <label class="custom-file-label" for="inputisitandatangan"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
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
  </div>
  <!-- /.modal -->
</div>
<!-- /.content -->
@endsection
