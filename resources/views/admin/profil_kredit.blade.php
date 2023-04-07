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
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Data {{ ucwords($jenisprofil) }} Nasabah</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @foreach($kredits as $index => $kredit)
            @if($jenisprofil=='kredit')
              @php ($saldoawal='POKOK_SALDO_REALISASI')
              @php ($saldoakhir='POKOK_SALDO_AKHIR')
              @php ($deskripsi='DESKRIPSI_JENIS_KREDIT')
            @elseif($jenisprofil=='tabung')
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-12">
                    <label for="inputjenistabungan">Jenis {{ ucwords($jenisprofil) }}</label>
                    <select class="form-control" name="inputjenistabungan" readonly>
                      <option value="{{ $kredit->JENIS_TABUNGAN }}">{{ $kredit->JENIS_TABUNGAN.' - '.$kredit->DESKRIPSI_JENIS_TABUNGAN }}</option>
                    </select>
                  </div>
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnorekening">No Rekening</label>
                      <input type="text" name="inputnorekening" value="{{ $kredit->NO_REKENING }}" readonly class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnoseries">No Series</label>
                      <input type="text" name="inputnoseries" value="" readonly class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-12">
                    <label for="inputstatus">Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="inputstatus" <?php if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                      <label class="form-check-label" style="margin-right:30px;">Baru</label>
                      <input class="form-check-input" type="radio" name="inputstatus" <?php if($kredit->STATUS_AKTIF=="2"){echo 'checked';}?>>
                      <label class="form-check-label" style="margin-right:30px;">Aktif</label>
                      <input class="form-check-input" type="radio" name="inputstatus" <?php if($kredit->STATUS_AKTIF=="3"){echo 'checked';}?>>
                      <label class="form-check-label">Tutup</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                      <label for="inputnasabahid">Nasabah ID</label>
                      <input type="text" name="inputnasabahid" value="{{ $kredit->NASABAH_ID }}" class="form-control">
                  </div>
                  <div class="col-lg-4 col-sm-6">
                  </div>
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputcabang">Cabang</label>
                      <input type="text" name="inputcabang" value="{{ $kredit->CAB }}" readonly class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-5 col-sm-6">
                      <label for="inputnasabahnama">Nama</label>
                      <input type="text" name="inputnasabahnama" value="{{ $kredit->nama_nasabah }}" class="form-control">
                  </div>
                  <div class="col-lg-4 col-sm-6">
                      <label for="inputnasabahnamaalias">AND / OR / QQ</label>
                      <input type="text" name="inputnasabahnamaalias" value="{{ $kredit->nama_alias }}" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-9 col-sm-12">
                      <label for="inputnasabahalamat">Alamat</label>
                      <input type="text" name="inputnasabahalamat" value="{{ $kredit->alamat }}" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-sm-12">
                    <label for="inputtipe">Tipe</label>
                    <select class="form-control" name="inputtipe" readonly>
                      <option value="">Normal</option>
                    </select>
                  </div>
                  <div class="col-lg-3 col-sm-12">
                    
                  </div>
                  <div class="col-lg-2 col-sm-12">
                    <label for="inputbungaperthn">Bunga per Tahun</label>
                    <input type="text" name="inputbungaperthn" value="{{ $kredit->SUKU_BUNGA }} %" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-12">
                    <label for="inputpph">PPH</label>
                    <input type="text" name="inputpph" value="{{ $kredit->PERSEN_PPH }} % per Bulan" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputDatebunga">Tanggal Lahir</label>
                    <div class="input-group dateYMD" id="inputDatebunga" data-target-input="nearest">
                        <input type="text" name="inputDatebunga" value="{{ $kredit->TGL_BUNGA }}" class="form-control datetimepicker-input" data-target="#inputDatebunga"/>
                        <div class="input-group-append" data-target="#inputDatebunga" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                  </div>
                  <div class="col-lg-1 col-sm-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="inputblokir" <?php if($kredit->BLOKIR=="1"){echo 'checked';}?>>
                      <label class="form-check-label" style="margin-right:30px;">Blokir</label>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12">
                    <label for="inputsaldoblokir">Saldo Blokir</label>
                    <input type="text" name="inputsaldoblokir" value="{{ $kredit->SALDO_BLOKIR }}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="bottomlinesolid">
                <span class="judulOrange">Data Kode Group</span>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-12">
                      <label for="inputkodegorup1">Kode Group 1</label>
                      <select class="form-control" name="inputkodegorup1" readonly>
                        <option value="{{ $kredit->KODE_GROUP1 }}">{{ $kredit->KODE_GROUP1.' - '.$kredit->DESKRIPSI_GROUP1 }}</option>
                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputkodegorup2">Kode Group 2</label>
                      <select class="form-control" name="inputkodegorup2" readonly>
                        <option value="{{ $kredit->KODE_GROUP2 }}">{{ $kredit->KODE_GROUP2.' - '.$kredit->DESKRIPSI_GROUP2 }}</option>
                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputkodegorup3">Kode Group 3</label>
                      <select class="form-control" name="inputkodegorup3" readonly>
                        <option value="{{ $kredit->KODE_GROUP3 }}">{{ $kredit->KODE_GROUP3.' - '.$kredit->DESKRIPSI_GROUP3 }}</option>
                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-12"></div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputgolpihaklawan">Gol. Pihak Lawan</label>
                      <select class="form-control" name="inputgolpihaklawan" readonly>
                        <option value="{{ $kredit->KODE_BI_PEMILIK }}">{{ $kredit->KODE_BI_PEMILIK.' - '.$kredit->deskripsi_golongan }}</option>
                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputmetoda">Metoda</label>
                      <select class="form-control" name="inputmetoda" readonly>
                        <option value="{{ $kredit->KODE_BI_METODA }}">{{ $kredit->KODE_BI_METODA.' - '.$kredit->DESKRIPSI_METODA }}</option>
                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputsandipihakterkait">Sandi Pihak Terkait</label>
                      <select class="form-control" name="inputsandipihakterkait" readonly>
                        <option value=""></option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="bottomlinesolid"></div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-12">
                    <label for="inputrestricted">Restricted</label>
                    <select class="form-control" name="inputrestricted" readonly>
                      <option value="{{ $kredit->FLAG_RESTRICTED }}">{{ $kredit->FLAG_RESTRICTED }}</option>
                    </select>
                  </div>
                  <div class="col-lg-2 col-sm-12"></div>
                  <div class="col-lg-3 col-sm-12">
                    <label for="inputtipetab">Tipe Tabungan</label>
                    <select class="form-control" name="inputtipetab" readonly>
                      <option value="">TABUNGAN</option>
                    </select>
                  </div>
                  <div class="col-lg-2 col-sm-12"></div>
                  <div class="col-lg-3 col-sm-12">
                    <label for="inputsaldominimal">Saldo Minimal</label>
                    <input type="text" name="inputsaldominimal" value="{{ $kredit->MINIMUM }}" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-12"></div>
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputbyadmin">Biaya Administrasi</label>
                    <input type="text" name="inputbyadmin" value="{{ $kredit->ADM_PER_BLN }}" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-4">
                    <label for="inputperiodebyadmin">.</label>
                    <select class="form-control" name="inputperiodebyadmin" readonly>
                      <option value="bln">per Bulan</option>
                    </select>
                  </div>
                  <div class="col-lg-2 col-sm-12"></div>
                  <div class="col-lg-3 col-sm-12">
                    <label for="inputsetoranminimal">Setoran Minimal</label>
                    <input type="text" name="inputsetoranminimal" value="{{ $kredit->SETORAN_MINIMUM }}" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-12"></div>
                  <div class="col-lg-3 col-sm-8">
                    <label for="inputestimasibunga">Estimasi Bunga</label>
                    <input type="text" name="inputestimasibunga" value="{{ $kredit->SUKU_BUNGA_ESTIMASI }}" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-12"></div>
                  <div class="col-lg-3 col-sm-12">
                    <label for="inputsetoranwajib">Setoran Wajib</label>
                    <input type="text" name="inputsetoranwajib" value="{{ $kredit->SETORAN_PER_BLN }}" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-12"></div>
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputjw">Jangka Waktu</label>
                    <input type="text" name="inputjw" value="{{ $kredit->JKW }}" class="form-control">
                  </div>
                  <div class="col-lg-1 col-sm-8">
                    <label for="inputperiodejw">.</label>
                    <input type="text" name="inputperiodejw" value="Bulan" readonly class="form-control">
                  </div>
                </div>
              </div>
              <div class="bottomlinesolid"></div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-8">
                    <label for="inputfuturevalue">Future Value</label>
                    <input type="text" name="inputfuturevalue" value="{{ $kredit->SALDO_AKAN_DATANG }}" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-12"></div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDateregistrasi">Tanggal Registrasi / Mulai</label>
                    <div class="input-group dateYMD" id="inputDateregistrasi" data-target-input="nearest">
                        <input type="text" name="inputDateregistrasi" value="{{ $kredit->TGL_REGISTRASI }}" class="form-control datetimepicker-input" data-target="#inputDateregistrasi"/>
                        <div class="input-group-append" data-target="#inputDateregistrasi" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-5 col-sm-12"></div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDatejthtempo">Tanggal Jatuh Tempo</label>
                    <div class="input-group dateYMD" id="inputDatejthtempo" data-target-input="nearest">
                        <input type="text" name="inputDatejthtempo" value="{{ $kredit->TGL_JT }}" class="form-control datetimepicker-input" data-target="#inputDatejthtempo"/>
                        <div class="input-group-append" data-target="#inputDatejthtempo" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-8 col-sm-12"></div>
                  <div class="col-lg-3 col-sm-8">
                    <label for="inputsaldosaatini">Saldo Saat Ini</label>
                    <input type="text" name="inputsaldosaatini" value="{{ $kredit->SALDO_AKHIR }}" class="form-control">
                  </div>
                </div>
              </div>
            @endif
            @endforeach
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>
<!-- /.content -->

@endsection
