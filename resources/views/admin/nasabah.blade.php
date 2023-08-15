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
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabah1" data-action="getProfileNasabah.php" placeholder="Masukkan Nama Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="noktp1">No KTP</label>
                </div>
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="noktp1" name="noktp1" placeholder="Masukkan No KTP">
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
            <h3 class="card-title">Data Nasabah yang sudah tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nasabah ID</th>
                <th>No Identitas</th>
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
                  <td>{{ $nasabah->nasabah_id }}</td>
                  <td>{{ $nasabah->no_id }}</td>
                  <td>{{ $nasabah->nama_nasabah }}</td>
                  <td>{{ strtoupper($nasabah->alamat.' '.$nasabah->kelurahan.' '.$nasabah->kecamatan) }}</td>
                  <td>{{ $nasabah->tempatlahir.', '.$tgllahir }}</td>
                  <td>{{ $nasabah->jenis_kelamin }}</td>
                  <td>{{ $nasabah->IBU_KANDUNG }}</td>
                  <td>{{ $status }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-nasabah"
                      data-no_din="{{ $nasabah->NO_DIN }}"
                      data-no_nasabah="{{ $nasabah->nasabah_id }}"
                      data-cab="{{ $nasabah->CAB }}"
                      data-cif="{{ $nasabah->cif }}"
                      data-blacklist="{{ $nasabah->Black_List }}"
                      data-nama_nasabah="{{ $nasabah->nama_nasabah }}"
                      data-nama_alias="{{ $nasabah->nama_alias }}"
                      data-tempatlahir="{{ $nasabah->tempatlahir }}"
                      data-tgllahir="{{ $nasabah->tgllahir }}"
                      data-jenis_kelamin="{{ $nasabah->jenis_kelamin }}"
                      data-ibu_kandung="{{ $nasabah->IBU_KANDUNG }}"
                      data-npwp="{{ $nasabah->npwp }}"
                      data-jenis_id="{{ $nasabah->jenis_id }}"
                      data-no_id="{{ $nasabah->no_id }}"
                      data-tglid="{{ $nasabah->tglid }}"
                      data-nasabah_kodegroup1="{{ $nasabah->NASABAH_GROUP1 }}"
                      data-status_kawin="{{ $nasabah->status_kawin }}"
                      data-alamat_domisili="{{$nasabah->ALAMAT_DOMISILI }}"
                      data-kode_area="{{ $nasabah->kode_area }}"
                      data-telpon="{{ $nasabah->telpon }}"
                      data-no_hp="{{ $nasabah->NO_HP }}"
                      data-alamat="{{ $nasabah->alamat }}"
                      data-kelurahan="{{ $nasabah->kelurahan }}"
                      data-kecamatan="{{ $nasabah->kecamatan }}"
                      data-kode_pos="{{ $nasabah->kode_pos }}"
                      data-kota_id="{{ $nasabah->kota_id.'|'.$nasabah->KOTA }}"
                      data-Kode_Negara="{{ trim($nasabah->Kode_Negara) }}"
                      data-Tempat_Kerja="{{ $nasabah->Tempat_Kerja }}"
                      data-alamat_kantor="{{ $nasabah->alamat_kantor }}"
                      data-pekerjaan_id="{{ $nasabah->pekerjaan_id }}"
                      data-pekerjaan="{{ $nasabah->pekerjaan }}"
                      data-kode_sumber_penghasilan="{{ $nasabah->kode_sumber_penghasilan }}"
                      data-penghasilan_setahun="{{ $nasabah->penghasilan_setahun }}"
                      data-gelar_id="{{ $nasabah->gelar_id }}"
                      data-Ket_Gelar="{{ $nasabah->KET_GELAR }}"
                      data-Kode_Bidang_Usaha="{{ $nasabah->Kode_Bidang_Usaha }}"
                      data-Kode_Hubungan_Debitur="{{ $nasabah->Kode_Hubungan_Debitur }}"
                      data-kode_golongan_debitur="{{ $nasabah->kode_golongan_debitur }}"
                      data-nama_pendamping="{{ $nasabah->nama_pendamping }}"
                      data-id_pasangan="{{ $nasabah->id_pasangan }}"
                      data-tgllhr_pasangan="{{ $nasabah->tgllhr_pasangan }}"
                      data-jml_tanggungan="{{ $nasabah->jml_tanggungan }}"
                      data-Tujuan_Pembukaan_KYC="{{ $nasabah->TUJUAN_PEMBUKAAN_KYC }}"
                      data-penggunaan_dana_KYC="{{ $nasabah->PENGGUNAAN_DANA_KYC }}"
                      data-Nama_Kuasa="{{ $nasabah->NAMA_KUASA }}"
                      data-Alamat_KUASA="{{ $nasabah->ALAMAT_KUASA }}"
                      data-hub_Kuasa="{{ $nasabah->hub_ahli_waris }}"
                      data-Path_FOTO="{{ $nasabah->PATH_FOTO }}"
                      data-Path_TTANGAN="{{ $nasabah->PATH_TTANGAN }}"
                      data-nasabah_idhash="{{ md5(trim($nasabah->nasabah_id).'Bast90') }}"
                      data-Path_FOTO_show="{{ asset('img/foto/'.$nasabah->PATH_FOTO) }}"
                      data-Path_TTANGAN_show="{{ asset('img/ttangan/'.$nasabah->PATH_TTANGAN) }}"
                      >
                          Detail & Edit
                      </a>
                      <form action="/bo_cs_de_nasabah" method="post"  style="margin-bottom: 0;" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                          <button type="submit" tabindex="-1" class="dropdown-item">
                            Delete
                          </button>
                          <input type="hidden" name="inputIdNasabahdel" value="{{ $nasabah->nasabah_id }}" class="form-control">
                          <input type="hidden" name="inputIdNasabahdelhash" value="{{ md5($nasabah->nasabah_id.'Bast90') }}" class="form-control">
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
                <th>No Identitas</th>
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
  <div class="modal fade" id="modal-edit-nasabah">
    <div class="modal-dialog modal-xl">
      <form action="/bo_cs_de_nasabah" id="formeditnasabah" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Data Nasabah</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <ul class="nav nav-pills p-2">
                  <li class="nav-item"><a class="nav-link active" href="#informasi_pribadiedit" data-toggle="tab">Informasi Pribadi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#kontak_alamatedit" data-toggle="tab">Kontak & Alamat</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pekerjaan_pendidikanedit" data-toggle="tab">Pekerjaan & Pendidikan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#lainnyaedit" data-toggle="tab">Lainnya</a></li>
                  <li class="nav-item"><a class="nav-link" href="#specimenedit" data-toggle="tab">Specimen</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="informasi_pribadiedit">
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputdinedit">D.I.N - BI</label>
                          <input type="text" name="inputdinedit" readonly class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputopendateedit">Open Date</label>
                          <input type="text" name="inputopendateedit" value="{{ date('Y-m-d') }}" readonly class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-8">
                        <div class="form-group-lbl">
                          <label for="inputnasabahidedit">Nasabah ID</label>
                          <input type="text" name="inputnasabahidedit" readonly class="inputnasabahidedit form-control">
                        </div>
                      </div>
                      <div class="col-lg-1 col-sm-4">
                        <div class="form-group-lbl">
                          <label for="inputcabedit">Cab</label>
                          <input type="text" name="inputcabedit" readonly class="inputcabedit form-control">
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-8">
                        <div class="form-group-lbl">
                          <label for="inputnocifedit">No CIF</label>
                          <input type="text" name="inputnocifedit" readonly class="inputnocifedit form-control">
                        </div>
                      </div>
                      <div class="col-lg-1 col-sm-4">
                        <div class="form-group-lbl">
                          <input type="checkbox" name="inputblacklistedit" class="form-checkbox">
                          <label for="inputblacklistedit">Blacklist</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnamanasabahedit">Nama Nasabah</label>
                          <input type="text" name="inputnamanasabahedit" id="inputnamanasabahedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputaliasedit">Alias</label>
                          <input type="text" name="inputaliasedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputtempatlahiredit">Tempat Lahir</label>
                          <input type="text" name="inputtempatlahiredit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputDate4">Tanggal Lahir</label>
                          <div class="input-group dateYMD" id="inputDate4" data-target-input="nearest">
                              <input type="text" name="inputtgllahiredit" class="form-control datetimepicker-input" data-target="#inputDate4" required>
                              <div class="input-group-append" data-target="#inputDate4" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputjk">Jenis Kelamin</label>
                          <select class="form-control" name="inputjkedit" required>
                            <option value="" selected="true" disabled="disabled">--- Pilih L/P ---</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputibukandungedit">Nama Ibu Kandung</label>
                          <input type="text" name="inputibukandungedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnpwpedit">NPWP</label>
                          <input type="text" name="inputnpwpedit" class="form-control" maxlength="16" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputidentitasedit">Jenis Identitas</label>
                          <select class="form-control" name="inputidentitasedit" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Identitas ---</option>
                            @foreach($identitass as $identitas)
                            <option value="{{ $identitas->jenis_id }}">{{ $identitas->nama_identitas }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnoidentitasedit">No. Identitas</label>
                          <input type="text" name="inputnoidentitasedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputDate5">Masa Berlaku</label>
                          <div class="input-group dateYMD" id="inputDate5" data-target-input="nearest">
                              <input type="text" name="inputmasaberlakuedit" class="form-control datetimepicker-input" data-target="#inputDate5" required>
                              <div class="input-group-append" data-target="#inputDate5" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputagamaedit">Agama</label>
                          <select class="form-control" name="inputagamaedit" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Agama ---</option>
                            @foreach($kodegroup1nasabahs as $kodegroup1nasabah)
                            <option value="{{ $kodegroup1nasabah->NASABAH_GROUP1 }}">{{ $kodegroup1nasabah->DESKRIPSI_GROUP1 }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputkawinedit">Status Kawin</label>
                          <select class="form-control" name="inputkawinedit" required>
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
                  <div class="tab-pane" id="kontak_alamatedit">
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputdomisiliedit">Alamat Domisili</label>
                          <input type="text" name="inputdomisiliedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-1 col-sm-2">
                        <div class="form-group-lbl">
                          <label for="inputkodetlpedit">Kode Telp</label>
                          <input type="text" name="inputkodetlpedit" placeholder="031" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-4">
                        <div class="form-group-lbl">
                          <label for="inputnotlpedit">No Telp</label>
                          <input type="text" name="inputnotlpedit" placeholder="7217201" class="form-control numberonly" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnohpedit">No HP</label>
                          <input type="text" name="inputnohpedit" placeholder="081xxxxxxxxx" class="form-control numberonly" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputalamatedit">Alamat KTP</label>
                          <input type="text" name="inputalamatedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputkelurahanedit">Kelurahan</label>
                          <input type="text" name="inputkelurahanedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputkecamatanedit">Kecamatan</label>
                          <input type="text" name="inputkecamatanedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputkodeposedit">Kode Pos</label>
                          <input type="text" name="inputkodeposedit" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputkotaedit">Kota</label>
                          <select class="form-control" name="inputkotaedit" required>
                            <option value="#" disabled="disabled">--- Pilih Kota ---</option>
                            @foreach($kotas as $kota)
                            <option value="{{ $kota->Kota_id.'|'.$kota->Deskripsi_Kota }}">{{ $kota->Kota_id.' - '.$kota->Deskripsi_Kota }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnegaraedit">Domisili Negara</label>
                          <select class="form-control" name="inputnegaraedit" required>
                            <option value="#" disabled="disabled">--- Pilih Negara ---</option>
                            @foreach($negaras as $negara)
                            <option value="{{ $negara->KODE_NEGARA }}">{{ $negara->KODE_NEGARA.' - '.$negara->DESKRIPSI_NEGARA }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="pekerjaan_pendidikanedit">
                    <div class="row">
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputnamaperusahaanedit">Nama Perusahaan</label>
                          <input type="text" name="inputnamaperusahaanedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-9 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputalamatperusahaanedit">Alamat Perusahaan</label>
                          <input type="text" name="inputalamatperusahaanedit"  class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputpekerjaanedit">Pekerjaan</label>
                          <select class="form-control" name="inputpekerjaanedit" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Pekerjaan ---</option>
                            @foreach($pekerjaans as $pekerjaan)
                            <option value="{{ $pekerjaan->Pekerjaan_id }}">{{ $pekerjaan->Pekerjaan_id.' - '.$pekerjaan->Desktripsi_Pekerjaan }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputdetpekerjaanedit">Ket Pekerjaan</label>
                          <input type="text" name="inputdetpekerjaanedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputsumberdanaedit">Sumber Dana</label>
                          <select class="form-control" name="inputsumberdanaedit" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Sumber Dana ---</option>
                            <option value="1">Gaji</option>
                            <option value="2">Usaha</option>
                            <option value="3">Lainnya</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputpenghasilansetahunedit">Penghasilan Setahun</label>
                          <input type="number" name="inputpenghasilansetahunedit" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputgelaredit">Status/Gelar</label>
                          <select class="form-control" name="inputgelaredit" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Status / Gelar ---</option>
                            @foreach($gelars as $gelar)
                            <option value="{{ $gelar->Gelar_ID }}">{{ $gelar->Gelar_ID.' - '.$gelar->Deskripsi_Gelar }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputdetgelaredit">Ket Status/Gelar</label>
                          <input type="text" name="inputdetgelaredit" class="form-control" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="lainnyaedit">
                    <div class="row">
                      <div class="col-lg-4 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputbidangusahasidedit">Bidang Usaha SID</label>
                          <select class="form-control" name="inputbidangusahasidedit" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Bidang Usaha SID ---</option>
                            @foreach($bidangusahas as $bidangusaha)
                            <option value="{{ $bidangusaha->KODE_BIDANG_USAHA }}">{{ $bidangusaha->KODE_BIDANG_USAHA.' - '.$bidangusaha->DESKRIPSI_BIDANG_USAHA }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputhubdebsidedit">Hubungan Debitur Dgn Bank SID</label>
                          <select class="form-control" name="inputhubdebsidedit" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Hubungan Debitur Dgn Bank SID ---</option>
                            @foreach($hubungandebiturs as $hubungandebitur)
                            <option value="{{ $hubungandebitur->KODE_HUBUNGAN }}">{{ $hubungandebitur->KODE_HUBUNGAN.' - '.$hubungandebitur->DESKRIPSI_HUBUNGAN }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputgoldebsidedit">Golongan Debitur SID</label>
                          <select class="form-control" name="inputgoldebsidedit" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Golongan Debitur SID ---</option>
                            @foreach($golongandebiturs as $golongandebitur)
                            <option value="{{ $golongandebitur->KODE_GOL_DEBITUR }}">{{ $golongandebitur->KODE_GOL_DEBITUR.' - '.$golongandebitur->DESKRIPSI_GOL_DEBITUR }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputnamapendampingedit">Nama Pendamping</label>
                          <input type="text" name="inputnamapendampingedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputidpendampingedit">ID Pendamping</label>
                          <input type="text" name="inputidpendampingedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputDate6">Tanggal Lahir Pendamping</label>
                          <div class="input-group dateYMD" id="inputDate6" data-target-input="nearest">
                              <input type="text" name="inputtgllahirpendampingedit" class="form-control datetimepicker-input" data-target="#inputDate6" required>
                              <div class="input-group-append" data-target="#inputDate6" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputjmltanggunganedit">Jumlah Tanggungan</label>
                          <input type="number" name="inputjmltanggunganedit" placeholder="(Jumlah Orang)" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputtujuanbukarekedit">Tujuan Pembukaan Rek</label>
                          <input type="text" name="inputtujuanbukarekedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputpenggunaandanaedit">Penggunaan Dana</label>
                          <input type="text" name="inputpenggunaandanaedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputnamaahliwarisedit">Nama Ahli Waris</label>
                          <input type="text" name="inputnamaahliwarisedit" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputalamatahliwarisedit">Alamat Ahli Waris</label>
                          <input type="text" name="inputalamatahliwarisedit"class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                          <div class="form-group">
                            <label for="inputhubahliwarisedit">Hub Ahli Waris</label>
                            <select class="form-control" name="inputhubahliwarisedit" required>
                              <option value="#" disabled="disabled">--- Pilih Hub Ahli Waris ---</option>
                              <option value="Suami">Suami</option>
                              <option value="Istri">Istri</option>
                              <option value="Anak">Anak</option>
                              <option value="Orang Tua">Orang Tua</option>
                              <option value="Saudara Kandung">Saudara Kandung</option>
                              <option value="Lainnya">Lainnya</option>
                            </select>
                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="specimenedit">
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group-lbl">
                          <img id="path_foto_show" src="" style="max-width:100%; max-height:200px;"/>
                        </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group-lbl">
                          <img id="path_ttangan_show" src="" style="max-width:100%; max-height:200px;"/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputFotoedit">Ambil Foto</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputFotoedit" name="inputFotoedit">
                              <input type="hidden" class="custom-file-input" name="inputFotoeditold">
                              <label class="custom-file-label" for="inputisiFotoedit"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputtandatanganedit">Ambil Tanda Tangan</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputtandatanganedit" name="inputtandatanganedit">
                              <input type="hidden" class="custom-file-input" name="inputtandatanganeditold">
                              <label class="custom-file-label" for="inputisitandatanganedit"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="inputIdNasabahHashedit" class="form-control">
                      <input type="hidden" name="_method" value="PUT"/>
                    </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.modal-body -->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div><!-- /.modal-content -->
        @csrf
      </form>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <div class="modal fade" id="modal-add-nasabah">
    <div class="modal-dialog modal-xl">
      <form action="/bo_cs_de_nasabah" method="post" enctype="multipart/form-data" id="formaddnasabah">
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
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputdin">D.I.N - BI</label>
                          <input type="text" name="inputdin" readonly class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputopendate">Open Date</label>
                          <input type="text" name="inputopendate" value="{{ date('Y-m-d') }}" readonly class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-8">
                        <div class="form-group-lbl">
                          <label for="inputnasabahid">Nasabah ID</label>
                          <input type="text" id="inputnasabahid" name="inputnasabahid" value="{{ $lastnasabahid }}" class="form-control"  required>
                        </div>
                      </div>
                      <div class="col-lg-1 col-sm-4">
                        <div class="form-group-lbl">
                          <label for="inputnocif">Cab</label>
                          <input type="text" id="inputcab" name="inputcab" readonly value="001" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-8">
                        <div class="form-group-lbl">
                          <label for="inputnocif">No CIF</label>
                          <input type="text" id="inputnocif" name="inputnocif" value="{{ '001'.$lastnasabahid }}" readonly class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-1 col-sm-4" style="display:none;">
                        <div class="form-group-lbl">
                          <input type="checkbox" name="inputblacklist" value="1" class="form-checkbox">
                          <label for="inputblacklist">Blacklist</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <label for="inputnamanasabah">Nama Nasabah / Anggota</label>
                        <div class="input-group date" data-target-input="nearest">
                          <input id="inputnamanasabah" type="text" name="inputnamanasabah" class="form-control" required>

                          {{-- <div class="input-group-append" data-toggle="modal" data-target="#modal-getnasabah">
                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                        </div> --}}

                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputalias">Alias</label>
                          <input type="text" name="inputalias" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputtempatlahir">Tempat Lahir</label>
                          <input type="text" name="inputtempatlahir" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputDate1">Tanggal Lahir</label>
                          <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                              <input type="text" name="inputtgllahir" class="form-control datetimepicker-input" data-target="#inputDate1"  required>
                              <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputjk">Jenis Kelamin</label>
                          <select class="form-control" name="inputjk" required>
                            <option value="" selected="true" disabled="disabled">--- Pilih L/P ---</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputibukandung">Nama Ibu Kandung</label>
                          <input type="text" name="inputibukandung" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnpwp">NPWP</label>
                          <input type="text" name="inputnpwp" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputidentitas">Jenis Identitas</label>
                          <select class="form-control" name="inputidentitas" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Identitas ---</option>
                            @foreach($identitass as $identitas)
                            <option value="{{ $identitas->jenis_id }}">{{ $identitas->nama_identitas }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnoidentitas">No. Identitas</label>
                          <input type="text" id="inputnoidentitas" name="inputnoidentitas" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputDate2">Masa Berlaku</label>
                          <div class="input-group dateYMD" id="inputDate2" data-target-input="nearest">
                              <input type="text" name="inputmasaberlaku" class="form-control datetimepicker-input"  value="9999-12-31" data-target="#inputDate2" id="xx" required>
                              <div class="input-group-append" data-target="#inputDate2" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <input onclick="MyFunctDisDate(this.checked,'xx')" class="form-check-input" type="checkbox" name="seumurhidup" id="pncorbyr">
                        <label class="form-check-label" for="flexCheckDefault">
                          Seumur Hidup
                        </label>
        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputagama">Agama</label>
                          <select class="form-control" name="inputagama" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Agama ---</option>
                            @foreach($kodegroup1nasabahs as $kodegroup1nasabah)
                            <option value="{{ $kodegroup1nasabah->NASABAH_GROUP1 }}">{{ $kodegroup1nasabah->DESKRIPSI_GROUP1 }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputkawin">Status Kawin</label>
                          <select class="form-control" name="inputkawin" required>
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
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputdomisili">Alamat Domisili</label>
                          <input type="text" id="inputdomisili" name="inputdomisili" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-1 col-sm-2">
                        <div class="form-group-lbl">
                          <label for="inputkodetlp">Kode Telp</label>
                          <input type="text" name="inputkodetlp" placeholder="031" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-4">
                        <div class="form-group-lbl">
                          <label for="inputnotlp">No Telp</label>
                          <input type="text" name="inputnotlp" placeholder="7217201" class="form-control numberonly" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnohp">No HP</label>
                          <input type="text" name="inputnohp" placeholder="081xxxxxxxxx" class="form-control numberonly" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputalamat">Alamat KTP</label>
                          <input type="text" id="inputalamat" name="inputalamat" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputkelurahan">Kelurahan</label>
                          <input type="text" name="inputkelurahan" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputkecamatan">Kecamatan</label>
                          <input type="text" name="inputkecamatan" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputkodepos">Kode Pos</label>
                          <input type="text" name="inputkodepos" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputkota">Kota</label>
                          <select class="form-control select2" name="inputkota" required>
                            <option value="#" disabled="disabled">--- Pilih Kota ---</option>
                            @foreach($kotas as $kota)
                            <option value="{{ $kota->Kota_id.'|'.$kota->Deskripsi_Kota }}" <?php if($kota->Kota_id=='1202'){echo 'selected';} ?> >{{ $kota->Kota_id.' - '.$kota->Deskripsi_Kota }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="form-group-lbl">
                          <label for="inputnegara">Domisili Negara</label>
                          <select class="form-control select2" name="inputnegara" required>
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
                    <div class="row">
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputnamaperusahaan">Nama Perusahaan</label>
                          <input type="text" name="inputnamaperusahaan" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-9 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputalamatperusahaan">Alamat Perusahaan</label>
                          <input type="text" name="inputalamatperusahaan" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputpekerjaan">Pekerjaan</label>
                          <select class="form-control select2" name="inputpekerjaan" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Pekerjaan ---</option>
                            @foreach($pekerjaans as $pekerjaan)
                            <option value="{{ $pekerjaan->Pekerjaan_id }}">{{ $pekerjaan->Pekerjaan_id.' - '.$pekerjaan->Desktripsi_Pekerjaan }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputdetpekerjaan">Ket Pekerjaan</label>
                          <input type="text" name="inputdetpekerjaan" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputsumberdana">Sumber Dana</label>
                          <select class="form-control" name="inputsumberdana" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Sumber Dana ---</option>
                            <option value="1">Gaji</option>
                            <option value="2">Usaha</option>
                            <option value="3">Lainnya</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputpenghasilansetahun">Penghasilan Setahun</label>
                          <input type="number" name="inputpenghasilansetahun" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputgelar">Status/Gelar</label>
                          <select class="form-control" name="inputgelar" required>
                            <option value="#" selected="true" disabled="disabled">--- Pilih Status / Gelar ---</option>
                            @foreach($gelars as $gelar)
                            <option value="{{ $gelar->Gelar_ID }}">{{ $gelar->Gelar_ID.' - '.$gelar->Deskripsi_Gelar }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <div class="form-group-lbl">
                          <label for="inputdetgelar">Ket Status/Gelar</label>
                          <input type="text" name="inputdetgelar" class="form-control" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="lainnya">
                      <div class="row">
                        <div class="col-lg-4 col-sm-12">
                          <div class="form-group-lbl">
                            <label for="inputbidangusahasid">Bidang Usaha SID</label>
                            <select class="form-control select2" name="inputbidangusahasid" required>
                              <option value="#" selected="true" disabled="disabled">--- Pilih Bidang Usaha SID ---</option>
                              @foreach($bidangusahas as $bidangusaha)
                              <option value="{{ $bidangusaha->KODE_BIDANG_USAHA }}">{{ $bidangusaha->KODE_BIDANG_USAHA.' - '.$bidangusaha->DESKRIPSI_BIDANG_USAHA }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                          <div class="form-group-lbl">
                            <label for="inputhubdebsid">Hubungan Debitur Dgn Bank SID</label>
                            <select class="form-control select2" name="inputhubdebsid" required>
                              <option value="#" selected="true" disabled="disabled">--- Pilih Hubungan Debitur Dgn Bank SID ---</option>
                              @foreach($hubungandebiturs as $hubungandebitur)
                              <option value="{{ $hubungandebitur->KODE_HUBUNGAN }}">{{ $hubungandebitur->KODE_HUBUNGAN.' - '.$hubungandebitur->DESKRIPSI_HUBUNGAN }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                          <div class="form-group-lbl">
                            <label for="inputgoldebsid">Golongan Debitur SID</label>
                            <select class="form-control select2" name="inputgoldebsid" required>
                              <option value="#" selected="true" disabled="disabled">--- Pilih Golongan Debitur SID ---</option>
                              @foreach($golongandebiturs as $golongandebitur)
                              <option value="{{ $golongandebitur->KODE_GOL_DEBITUR }}">{{ $golongandebitur->KODE_GOL_DEBITUR.' - '.$golongandebitur->DESKRIPSI_GOL_DEBITUR }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-sm-12">
                          <div class="form-group-lbl">
                            <label for="inputnamapendamping">Nama Pendamping</label>
                            <input type="text" name="inputnamapendamping" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <div class="form-group-lbl">
                            <label for="inputidpendamping">ID Pendamping</label>
                            <input type="text" name="inputidpendamping" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                          <div class="form-group-lbl">
                            <label for="inputDate3">Tanggal Lahir Pendamping</label>
                            <div class="input-group dateYMD" id="inputDate3" data-target-input="nearest">
                                <input type="text" name="inputtgllahirpendamping" class="form-control datetimepicker-input" data-target="#inputDate3" required>
                                <div class="input-group-append" data-target="#inputDate3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <div class="form-group">
                            <label for="inputjmltanggungan">Jumlah Tanggungan</label>
                            <input type="number" name="inputjmltanggungan" placeholder="(Jumlah Orang)" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-2 col-sm-12">
                          <div class="form-group">
                            <label for="inputtujuanbukarek">Tujuan Pembukaan Rek</label>
                            <input type="text" name="inputtujuanbukarek" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                          <div class="form-group">
                            <label for="inputpenggunaandana">Penggunaan Dana</label>
                            <input type="text" name="inputpenggunaandana" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-lg-2 col-sm-12">
                          <div class="form-group">
                            <label for="inputnamaahliwaris">Nama Ahli Waris</label>
                            <input type="text" name="inputnamaahliwaris" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <div class="form-group">
                            <label for="inputalamatahliwaris">Alamat Ahli Waris</label>
                            <input type="text" name="inputalamatahliwaris" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <div class="form-group">
                            <label for="inputhubahliwaris">Hub Ahli Waris</label>
                            <select class="form-control" name="inputhubahliwaris" required>
                              <option value="#" selected="true" disabled="disabled">--- Pilih Hub Ahli Waris ---</option>
                              <option value="Suami">Suami</option>
                              <option value="Istri">Istri</option>
                              <option value="Anak">Anak</option>
                              <option value="Orang Tua">Orang Tua</option>
                              <option value="Saudara Kandung">Saudara Kandung</option>
                              <option value="Lainnya">Lainnya</option>
                            </select>
                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="specimen">
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <div class="form-group">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSh8kwBqclxTYXO2_5U7-LzGCL42efVyWRUKg3hWMSo&s" style="height:200px;"/>
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                          <div class="form-group">
                            <img src="https://t4.ftcdn.net/jpg/00/00/42/95/360_F_429547_YJTlwk2Ld5kYDAbtCUwFgzmatgUHEg.jpg" style="height:200px;"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <div class="form-group">
                            <label for="inputFoto">Ambil Foto</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputFoto"  name="inputFoto" required>
                                <label class="custom-file-label" for="inputisiFoto"></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                          <div class="form-group">
                            <label for="inputtandatangan">Ambil Tanda Tangan</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputtandatangan" name="inputtandatangan" required>
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
  {{-- MODAL TAMPIL TABEL NASABAH --}}
  <div class="modal fade bs-modal-nas" id="modal-getnasabah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="judulmodalnasabah">Data Nasabah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table id="nasabahdataget" class="table table-bordered " width="100%">
            <thead>
              <tr>
                  <th>Nasabah Id</th>
                  <th>Nama Nasabah</th>
                  <th>Alamat Nasabah</th>
                  <th>No Identitas</th>
                  <th>Action</th>

              </tr>
            </thead>
            <tbody>
                @foreach($nasabahall as $value)
                <tr>
                  <td>{{ $value->nasabah_id }}</td>
                  <td>{{ $value->nama_nasabah }}</td>
                  <td>{{ $value->alamat }}</td>
                  <td>{{ $value->no_id }}</td>
                  <td>
                    <a id="selectednasabah" href="#" class="btn btn-block bg-gradient-primary btn-sm">
                      pilih
                    </a>
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
