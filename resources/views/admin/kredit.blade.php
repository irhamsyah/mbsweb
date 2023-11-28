@extends('layouts.admin_main')

@section('content')

@if($msgstatus!=''){
@if($msgstatus=='1'){
@php $statusmsg='success'; $titlemsg='Successfully'; $msgview='Proses Berhasil' @endphp;
}
@else{
@php $statusmsg='error'; $titlemsg='Error!'; $msgview='Proses Gagal!' @endphp;
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
          <form method="POST" action="/bo_kr_de_kredit/add" role="search">
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
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-kredit" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Kredit yang sudah tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example3" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Nasabah</th>
                  <th>Produk</th>
                  <th>No Rekening</th>
                  <th>Saldo Awal</th>
                  <th>Saldo Saat Ini</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach($kredits as $index => $kredit)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $kredit->nama_nasabah }}</td>
                  <td>{{ strtoupper($kredit->DESKRIPSI_JENIS_KREDIT) }}</td>
                  <td>{{ $kredit->NO_REKENING }}</td>
                  <td>{{ $kredit->POKOK_SALDO_REALISASI }}</td>
                  <td>{{ $kredit->POKOK_SALDO_AKHIR }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <form method="post" action="/bo_cs_de_profil/kredit">
                        @csrf
                        <input type="hidden" name="jenisprofil" value="kredit" class="form-control">
                        <input type="hidden" name="idkredit" value="{{ trim($kredit->NO_REKENING) }}" class="form-control">
                        <input type="hidden" name="idnasabah" value="{{ trim($kredit->NASABAH_ID) }}" class="form-control">
                        <button type="submit" tabindex="-1" class="dropdown-item">
                          Detail Kredit
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
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

  <div class="modal fade" id="modal-add-kredit">
    <div class="modal-dialog modal-xl">
      <form autocomplete="off" action="/bo_kr_de_kredit/add" method="post" enctype="multipart/form-data" id="formaddkredit">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Data Entry Kredit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <ul class="nav nav-pills p-2">
                  <li class="nav-item"><a class="nav-link active" href="#form_master_kredit" data-toggle="tab">Form 1 [Master]</a></li>
                  <li class="nav-item"><a class="nav-link" href="#form_jadwal_kredit" data-toggle="tab">Form 2 [Jadwal]</a></li>
                  <li class="nav-item"><a class="nav-link" href="#form_lapbul" data-toggle="tab">Form 3 [Lapbul/SLIK]</a></li>
                  <li class="nav-item"><a class="nav-link" href="#form_agunan" data-toggle="tab">Form 4 [Agunan]</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="form_master_kredit">
                      <div class="form-group row">
                        <div class="col-lg-4">
                          <div class="row">                            
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputjeniskredit">Jenis Kredit</label>
                              <select class="form-control" name="inputjeniskredit">
                                @foreach($kodejeniskredit as $kodejeniskredit)
                                  <option value="{{ $kodejeniskredit->KODE_JENIS_KREDIT }}">{{ $kodejeniskredit->KODE_JENIS_KREDIT.' - '.$kodejeniskredit->DESKRIPSI_JENIS_KREDIT }}</option>
                                @endforeach                                
                              </select>                               
                            </div>                            
                            <div class="col-lg-8 col-sm-12">
                                <label for="inputtipe">Tipe</label>
                                <input type="text" name="inputtipe" value="KREDIT" readonly class="form-control">
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <label for="inputcabang">Cabang</label>
                                <input type="text" name="inputcabang" value="001" readonly class="form-control">
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="inputnorekening">No Rekening</label>
                                <input type="text" name="inputnorekening" class="form-control">
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="inputnopklama">No PK Lama</label>
                                <input type="text" name="inputnopklama" class="form-control">
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="inputtglpklama">Tgl PK Lama</label>
                                <input type="text" name="inputtglpklama" class="form-control">
                            </div>
                            <div class="col-lg-6 col-sm-8">
                                <label for="inputreviewbunga">Review Bunga</label>
                                <div class="input-group mb-2 autocomplete"> 
                                  <input type="text" name="inputreviewbunga" class="form-control">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text"><span class="input-group-addon">
                                        Bln
                                        </span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputstatus">Status</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="inputstatus" checked="true">
                                <label class="form-check-label" style="margin-right:30px;">Baru</label>
                                <input class="form-check-input" type="radio" name="inputstatus">
                                <label class="form-check-label" style="margin-right:30px;">Aktif</label>
                                <input class="form-check-input" type="radio" name="inputstatus" <?php //if($kredit->STATUS_AKTIF=="3"){echo 'checked';}?>>
                                <label class="form-check-label">Lunas</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <label for="inputnasabahid">Nasabah ID</label>                                
                            </div>
                            <div class="col-lg-12 col-sm-12">        
                                <div class="input-group mb-2 autocomplete">                                  
                                  <input type="text" class="form-control" name="inputnasabahid">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="input-group-addon">
                                      <i class="fa fa-search"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>                              
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="inputnasabahnama">Nama Nasabah</label>
                                <input type="text" name="inputnasabahnama" readonly class="form-control">
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="inputnasabahalamat">Alamat</label>
                                <input type="text" name="inputnasabahalamat" readonly class="form-control">
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <label for="inputnopkbaru">No PK Baru</label>
                                <input type="text" name="inputnopkbaru" class="form-control">
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <label for="inputreschedule">.</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="inputreschedule" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                                <label class="form-check-label" style="margin-right:30px;">Re-Schedule</label>
                              </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <label for="inputwo">.</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="inputwo" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                                <label class="form-check-label" style="margin-right:30px;">Write-off</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="row">
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputkodegorup1">Kode Group 1</label>
                              <select class="form-control" name="inputkodegorup1">
                                @foreach($kodegroup1kredit as $kodegroup1kredit)
                                  <option value="{{ $kodegroup1kredit->KODE_GROUP1 }}">{{ $kodegroup1kredit->KODE_GROUP1.' - '.$kodegroup1kredit->DESKRIPSI_GROUP1 }}</option>
                                @endforeach                                  
                              </select>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputkodegorup2">Kode Group 2</label>
                              <select class="form-control" name="inputkodegorup2">
                                @foreach($kodegroup2kredit as $kodegroup2kredit)
                                  <option value="{{ $kodegroup2kredit->KODE_GROUP2 }}">{{ $kodegroup2kredit->KODE_GROUP2.' - '.$kodegroup2kredit->DESKRIPSI_GROUP2 }}</option>
                                @endforeach 
                              </select>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputkodegorup3">Kode Group 3</label>
                              <select class="form-control" name="inputkodegorup3">
                                @foreach($kodegroup3kredit as $kodegroup3kredit)
                                  <option value="{{ $kodegroup3kredit->KODE_GROUP3 }}">{{ $kodegroup3kredit->KODE_GROUP3.' - '.$kodegroup3kredit->DESKRIPSI_GROUP3 }}</option>
                                @endforeach 
                              </select>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputkodegorup4">Kode Group 4</label>
                              <select class="form-control" name="inputkodegorup4" readonly>
                                <option value="{{ $kredit->KODE_GROUP4 }}">{{ $kredit->KODE_GROUP4.' - '.$kredit->DESKRIPSI_GROUP4 }}</option>
                              </select>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputsumberdana">Sumber Dana</label>
                              <select class="form-control" name="inputsumberdana">
                                @foreach($kodesumberdanakredit as $kodesumberdanakredit)
                                  <option value="{{ $kodesumberdanakredit->KODE_SUMBER_DANA }}">{{ $kodesumberdanakredit->KODE_SUMBER_DANA.' - '.$kodesumberdanakredit->DESKRIPSI_SUMBER_DANA }}</option>
                                @endforeach 
                              </select>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputdana">Dana</label>
                              <select class="form-control" name="inputdana" readonly>
                                <option value="">SUMBER DANA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="bottomlinesolid">
                        <span class="judulOrange">Angsuran</span>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-3">
                          <div class="row">
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputtipepinjaman">Tipe Pinjaman</label>
                              <select class="form-control" name="inputtipepinjaman">
                                @foreach($kodetypekredit as $kodetypekredit)
                                  <option value="{{ $kodetypekredit->KODE_TYPE_KREDIT }}">{{ $kodetypekredit->KODE_TYPE_KREDIT.' - '.$kodetypekredit->DESKRIPSI_TYPE_KREDIT }}</option>
                                @endforeach 
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-9">
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputtanggal">Tanggal</label>
                              <input type="text" name="inputtanggalpengajuan" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputtanggalrealisasi">Tgl Realisasi</label>
                              <input type="text" name="inputtanggalrealisasi" class="form-control">
                            </div>
                            <div class="col-lg-4 col-sm-12">
                              <label for="inputjumlahpinjaman">Jumlah</label>
                              <input type="text" name="inputjumlahpinjaman" class="form-control">
                            </div>
                            <div class="col-lg-4 col-sm-12">
                              <label for="inputjumlahbungapinjaman">Margin</label>
                              <input type="text" name="inputjumlahbungapinjaman" readonly class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputjmlangsuran">Jml. Angsuran</label>
                              <input type="text" name="inputjmlangsuran" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputsatuanwaktuangsuran">.</label>
                              <select class="form-control" name="inputsatuanwaktuangsuran">
                              @foreach($kodesatuanwaktuangsuran as $kodesatuanwaktuangsuran)
                                  <option value="{{ $kodesatuanwaktuangsuran->KODE_SATUAN_WAKTU }}">{{ $kodesatuanwaktuangsuran->KODE_SATUAN_WAKTU.' - '.$kodesatuanwaktuangsuran->DESKRIPSI_SATUAN_WAKTU }}</option>
                                @endforeach 
                              </select>
                            </div>
                            <div class="col-lg-1 col-sm-12">
                              <label for="inputjw">Jk Wktu</label>
                              <input type="text" name="inputjw" value="{{ $kredit->BI_JANGKA_WAKTU }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-1 col-sm-12">
                              <label for="inputjwbln">.</label>
                              <input type="text" name="inputjwbln" value="bln" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputtanggaljttempo">Tanggal Jt Tempo</label>
                              <input type="text" name="inputtanggaljttempo" value="{{ $kredit->TGL_JATUH_TEMPO }}" readonly class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbungaperthn">Bunga</label>
                              <input type="text" name="inputbungaperthn" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbungaeffperthn">Bunga Eff.</label>
                              <input type="text" name="inputbungaeffperthn" value="{{ $kredit->suku_bunga_eff_per_tahun }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputsukubunga">Suku Bunga</label>
                              <input type="text" name="inputsukubunga" value="{{ $kredit->SUKU_BUNGA_PER_ANGSURAN }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbyadmin">Admin</label>
                              <input type="text" name="inputbyadmin" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbybonus">Bonus</label>
                              <input type="text" name="inputbybonus" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputfaktoanuitas">Faktor Anuitas</label>
                              <input type="text" name="inputfaktoanuitas" class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputterminpokok">Termin Pokok</label>
                              <input type="text" name="inputterminpokok" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputterminbunga">Termin Bunga</label>
                              <input type="text" name="inputterminbunga" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputgppokok">Grace Period Pokok</label>
                              <input type="text" name="inputgppokok" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputgpbunga">Grace Period Bunga</label>
                              <input type="text" name="inputgpbunga" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputangsuranblnpersen">Angsuran per Bulan</label>
                              <input type="text" name="inputangsuranblnpersen" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputangsuranbln">Angsuran</label>
                              <input type="text" name="inputangsuranbln" readonly class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbungaekiv">Bunga Ekiv.</label>
                              <input type="text" name="inputbungaekiv" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbungaekivbln">.</label>
                              <input type="text" name="inputbungaekivbln" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputangsuranfee1">Angs. Fee I</label>
                              <input type="text" name="inputangsuranfee1" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputangsuranfee1rp">Rp.</label>
                              <input type="text" name="inputangsuranfee1rp" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputangsuranfee2">Angs. Fee II</label>
                              <input type="text" name="inputangsuranfee2" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputangsuranfee2rp">Rp.</label>
                              <input type="text" name="inputangsuranfee2rp" class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputdendaharian">Denda</label>
                              <input type="text" name="inputdendaharian" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputdendajtharian">Denda JT</label>
                              <input type="text" name="inputdendajtharian" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputgphari">Grace Period</label>
                              <input type="text" name="inputgphari"class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbyadminpersen">Adm</label>
                              <input type="text" name="inputbyadminpersen" class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputtotaldenda">.</label>
                              <input type="text" name="inputtotaldenda" value="0.00" readonly class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="bottomlinesolid">
                        <span class="judulOrange">Biaya & Potongan Pinjaman</span>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-4">
                          <div class="row">
                            <div class="col-lg-4 col-sm-12">
                              <label for="inputprovisi">Provisi</label>
                              <input type="text" name="inputprovisi" class="form-control">
                            </div>
                            <div class="col-lg-5 col-sm-12">
                              <label for="inputprovisirp">.</label>
                              <input type="text" name="inputprovisirp" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputamortisasiprovisi">.</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="inputamortisasiprovisi" <?php if($kredit->AMORTISASI_PROVISI=="1"){echo 'checked';}?>>
                                <label class="form-check-label" style="margin-right:30px;">Amortisasi</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-4 col-sm-12">
                              <label for="inputadmfinal">Adm</label>
                              <input type="text" name="inputadmfinal" class="form-control">
                            </div>
                            <div class="col-lg-5 col-sm-12">
                              <label for="inputadmfinalrp">.</label>
                              <input type="text" name="inputadmfinalrp" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputamortisasiadm">.</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="inputamortisasiadm" <?php //if($kredit->amortisasi_adm=="1"){echo 'checked';}?>>
                                <label class="form-check-label" style="margin-right:30px;">Amortisasi</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-4 col-sm-12">
                              <label for="inputbytrans">By. Trans</label>
                              <input type="text" name="inputbytrans" class="form-control">
                            </div>
                            <div class="col-lg-5 col-sm-12">
                              <label for="inputbytransrp">.</label>
                              <input type="text" name="inputbytransrp" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputamortisasibytrans">.</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="inputamortisasibytrans" <?php //if($kredit->amortisasi_biaya_transaksi=="1"){echo 'checked';}?>>
                                <label class="form-check-label" style="margin-right:30px;">Amortisasi</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-8">
                          <div class="row">
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputpremi">Premi</label>
                              <input type="text" name="inputpremi" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputnotariel">Notariel</label>
                              <input type="text" name="inputnotariel" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputmaterai">Materai</label>
                              <input type="text" name="inputmaterai" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputpkmaterai">Pokok Materai</label>
                              <input type="text" name="inputpkmaterai" class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputlainlain">Lain-lain</label>
                              <input type="text" name="inputlainlain" class="form-control">
                            </div>
                            <div class="col-lg-1 col-sm-12">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputangsuranpremi">Angs. Premi</label>
                              <input type="text" name="inputangsuranpremi" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputangsuranpremirp">.</label>
                              <input type="text" name="inputangsuranpremirp" class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputtotalpremi">Total Premi</label>
                              <input type="text" name="inputtotalpremi" class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputditanggungcheck">.</label>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="inputditanggungcheck" <?php //if($kredit->amortisasi_biaya_transaksi=="1"){echo 'checked';}?>>
                                <label class="form-check-label" style="margin-right:30px;">Ditanggung</label>
                              </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                              <label for="inputditanggung">Ditanggung</label>
                              <input type="text" name="inputditanggung" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="bottomlinesolid">
                        <span class="judulOrange">Saldo & Kolektibilitas</span>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-9">
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputpokoksaw">Saldo Awal Pokok</label>
                              <input type="text" name="inputpokoksaw" value="{{ $kredit->POKOK_SALDO_AWAL }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputpokokdb">Debet Pokok</label>
                              <input type="text" name="inputpokokdb" value="{{ $kredit->POKOK_SALDO_REALISASI }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputpokokkr">Kredit Pokok</label>
                              <input type="text" name="inputpokokkr" value="{{ $kredit->POKOK_SALDO_SETORAN }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputpokokdc">Discount Pokok</label>
                              <input type="text" name="inputpokokdc" value="{{ $kredit->POKOK_SALDO_DISC }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputpokoksak">Saldo Akhir Pokok</label>
                              <input type="text" name="inputpokoksak" value="{{ $kredit->POKOK_SALDO_AKHIR }}" readonly class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbungasaw">Saldo Awal Bunga</label>
                              <input type="text" name="inputbungasaw" value="{{ $kredit->BUNGA_SALDO_AWAL }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbungadb">Debet Bunga</label>
                              <input type="text" name="inputbungadb" value="{{ $kredit->BUNGA_SALDO_REALISASI }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbungakr">Kredit Bunga</label>
                              <input type="text" name="inputbungakr" value="{{ $kredit->BUNGA_SALDO_SETORAN }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-2 col-sm-12">
                              <label for="inputbungadc">Discount Bunga</label>
                              <input type="text" name="inputbungadc" value="{{ $kredit->BUNGA_SALDO_DISC }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputbungasak">Saldo Akhir Bunga</label>
                              <input type="text" name="inputbungasak" value="{{ $kredit->BUNGA_SALDO_AKHIR }}" readonly class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-8 col-sm-12">
                            </div>
                            <div class="col-lg-3 col-sm-12">
                              <label for="inputsaldohapusbuku">Saldo Hapus Buku</label>
                              <input type="text" name="inputsaldohapusbuku" value="{{ $kredit->SALDO_AKHIR_ACCRUAL }}" readonly class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="row">
                            <div class="col-lg-6 col-sm-12">
                              <label for="inputkol">Kolektibilitas</label>
                              <input type="text" name="inputkol" value="{{ $kredit->KOLEK }}" readonly class="form-control">
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <label for="inputreschedule">Rescheduling</label>
                              <input type="text" name="inputreschedule" value="{{ $kredit->KOLEKTIBILITAS_RSC }}" readonly class="form-control">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputkonfig">Konfigurasi</label>
                              <select class="form-control" name="inputkonfig" readonly>
                                <option value="">OTOMATIS</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>                                                                                        
                    </div>                
                    <div class="tab-pane" id="form_jadwal_kredit">
                      <div class="form-group row">
                        <div class="col-lg-4">
                          <div class="row">
                            <div class="col-lg-12 col-sm-12">
                              <label for="inputjenis">JADWAL KREDIT</label>
                              <select class="form-control" name="inputjenis" readonly>
                                <option value="{{ $kredit->JENIS_PINJAMAN }}">{{ $kredit->JENIS_PINJAMAN.' - '.$kredit->DESKRIPSI_JENIS_KREDIT }}</option>
                              </select>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                              <label for="inputtipe">Tipe</label>
                              <input type="text" name="inputtipe" value="KREDIT" readonly class="form-control">
                            </div>
                            <div class="col-lg-4 col-sm-12">
                              <label for="inputcabang">Cabang</label>
                              <input type="text" name="inputcabang" value="{{ $kredit->CAB }}" readonly class="form-control">
                            </div>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
               </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- /.content -->

<script>
function autocomplete(inp, inpnama, inpalamat, arr, nama, alamat, nasabahs) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value.trim();  
              nasabahs.forEach(findIndex);
              function findIndex(value, index, array) {
                if(value.nasabah_id.trim()==inp.value.trim()){
                  inpnama.value=nama[index];
                  inpalamat.value=alamat[index]; 
                } 
              }  
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");      
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
          inpnama.value=nama[currentFocus];
          inpalamat.value=alamat[currentFocus];
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active"); 
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {  
    closeAllLists(e.target);
  });
}

var nasabahs = {!! json_encode($nasabahs) !!};

var nasabahid=[];
var  nasabahnama=[];
var nasabahalamat=[];
nasabahs.forEach(splitData);
function splitData(value, index, array) {
  nasabahid.push(value.nasabah_id);
  nasabahnama.push(value.nama_nasabah);
  nasabahalamat.push(value.alamat);  
}

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementsByName("inputnasabahid")[0], document.getElementsByName("inputnasabahnama")[0], document.getElementsByName("inputnasabahalamat")[0], nasabahid, nasabahnama, nasabahalamat, nasabahs);

</script>

<style>
/* * {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
} */

/*the container must be positioned relative:*/
/* .autocomplete {
  position: relative;
  display: inline-block;
} */

/* input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
} */

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

@endsection