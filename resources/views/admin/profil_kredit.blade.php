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
            <!-- KREDIT VIEW -->
            @foreach($kredits as $index => $kredit)
            @if($jenisprofil=='kredit')
              @php ($saldoawal='POKOK_SALDO_REALISASI')
              @php ($saldoakhir='POKOK_SALDO_AKHIR')
              @php ($deskripsi='DESKRIPSI_JENIS_KREDIT')
              <div class="form-group row">
                <div class="col-lg-4">
                  <div class="row">
                    <div class="col-lg-12 col-sm-12">
                      <label for="inputjenis">Jenis {{ ucwords($jenisprofil) }}</label>
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
                    <div class="col-lg-12 col-sm-12">
                        <label for="inputnorekening">No Rekening</label>
                        <input type="text" name="inputnorekening" value="{{ $kredit->NO_REKENING }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="inputnopklama">No PK Lama</label>
                        <input type="text" name="inputnopklama" value="{{ $kredit->NO_PK_LAMA }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="inputtglpklama">Tgl PK Lama</label>
                        <input type="text" name="inputtglpklama" value="{{ $kredit->TGL_PK_LAMA }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-4 col-sm-8">
                        <label for="inputreviewbunga">Review Bunga</label>
                        <input type="text" name="inputreviewbunga" value="{{ $kredit->REVIEW_BUNGA }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-4">
                        <label for="inputblnreviewbunga">.</label>
                        <input type="text" name="inputblnreviewbunga" value="bln" readonly class="form-control">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                      <label for="inputstatus">Status</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="inputstatus" <?php if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                        <label class="form-check-label" style="margin-right:30px;">Baru</label>
                        <input class="form-check-input" type="radio" name="inputstatus" <?php if($kredit->STATUS_AKTIF=="2"){echo 'checked';}?>>
                        <label class="form-check-label" style="margin-right:30px;">Aktif</label>
                        <input class="form-check-input" type="radio" name="inputstatus" <?php if($kredit->STATUS_AKTIF=="3"){echo 'checked';}?>>
                        <label class="form-check-label">Lunas</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <label for="inputnasabahid">Nasabah ID</label>
                        <input type="text" name="inputnasabahid" value="{{ $kredit->NASABAH_ID }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="inputnasabahnama">Nama Nasabah</label>
                        <input type="text" name="inputnasabahnama" value="{{ $kredit->nama_nasabah }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="inputnasabahalamat">Alamat</label>
                        <input type="text" name="inputnasabahalamat" value="{{ $kredit->alamat }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <label for="inputnopkbaru">No PK Baru</label>
                        <input type="text" name="inputnopkbaru" value="{{ $kredit->NO_PK_BARU }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                      <label for="inputreschedule">.</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="inputreschedule" <?php if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                        <label class="form-check-label" style="margin-right:30px;">Re-Schedule</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                      <label for="inputwo">.</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="inputwo" <?php if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                        <label class="form-check-label" style="margin-right:30px;">Write-off</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="row">
                    <div class="col-lg-12 col-sm-12">
                      <label for="inputkodegorup1">Kode Group 1</label>
                      <select class="form-control" name="inputkodegorup1" readonly>
                        <option value="{{ $kredit->KODE_GROUP1 }}">{{ $kredit->KODE_GROUP1.' - '.$kredit->DESKRIPSI_GROUP1 }}</option>
                      </select>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                      <label for="inputkodegorup2">Kode Group 2</label>
                      <select class="form-control" name="inputkodegorup2" readonly>
                        <option value="{{ $kredit->KODE_GROUP2 }}">{{ $kredit->KODE_GROUP2.' - '.$kredit->DESKRIPSI_GROUP2 }}</option>
                      </select>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                      <label for="inputkodegorup3">Kode Group 3</label>
                      <select class="form-control" name="inputkodegorup3" readonly>
                        <option value="{{ $kredit->KODE_GROUP3 }}">{{ $kredit->KODE_GROUP3.' - '.$kredit->DESKRIPSI_GROUP3 }}</option>
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
                      <select class="form-control" name="inputsumberdana" readonly>
                        <option value="{{ $kredit->KODE_SUMBER_DANA }}">{{ $kredit->KODE_SUMBER_DANA.' - '.$kredit->DESKRIPSI_SUMBER_DANA }}</option>
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
                      <select class="form-control" name="inputtipepinjaman" readonly>
                        <option value="{{ $kredit->TYPE_PINJAMAN }}">{{ $kredit->TYPE_PINJAMAN.' - '.$kredit->DESKRIPSI_TYPE_KREDIT }}</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-9">
                  <div class="row">
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputtanggal">Tanggal</label>
                      <input type="text" name="inputtanggal" value="{{ $kredit->TGL_PENGAJUAN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputtanggalrealisasi">Tgl Realisasi</label>
                      <input type="text" name="inputtanggalrealisasi" value="{{ $kredit->TGL_REALISASI }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                      <label for="inputjumlahpinjaman">Jumlah</label>
                      <input type="text" name="inputjumlahpinjaman" value="{{ $kredit->JML_PINJAMAN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                      <label for="inputjumlahbungapinjaman">Margin</label>
                      <input type="text" name="inputjumlahbungapinjaman" value="{{ $kredit->JML_BUNGA_PINJAMAN }}" readonly class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputjmlangsuran">Jml. Angsuran</label>
                      <input type="text" name="inputjmlangsuran" value="{{ $kredit->JML_ANGSURAN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputsatuanwaktuangsuran">.</label>
                      <select class="form-control" name="inputsatuanwaktuangsuran" readonly>
                        <option value="{{ $kredit->SATUAN_WAKTU_ANGSURAN }}">{{ $kredit->SATUAN_WAKTU_ANGSURAN.' - '. $kredit->DESKRIPSI_SATUAN_WAKTU }}</option>
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
                      <input type="text" name="inputbungaperthn" value="{{ $kredit->SUKU_BUNGA_PER_TAHUN }}" readonly class="form-control">
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
                      <input type="text" name="inputbyadmin" value="{{ $kredit->ADM_PER_BLN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputbybonus">Bonus</label>
                      <input type="text" name="inputbybonus" value="{{ $kredit->BUNGA_EFEKTIF_THN_INI }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputfaktoanuitas">Faktor Anuitas</label>
                      <input type="text" name="inputfaktoanuitas" value="{{ $kredit->FAKTOR_ANUITAS }}" readonly class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputterminpokok">Termin Pokok</label>
                      <input type="text" name="inputterminpokok" value="{{ $kredit->PERIODE_ANGSURAN_POKOK }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputterminbunga">Termin Bunga</label>
                      <input type="text" name="inputterminbunga" value="{{ $kredit->PERIODE_ANGSURAN_BUNGA }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputgppokok">Grace Period Pokok</label>
                      <input type="text" name="inputgppokok" value="{{ $kredit->GRACE_PERIOD_POKOK }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputgpbunga">Grace Period Bunga</label>
                      <input type="text" name="inputgpbunga" value="{{ $kredit->GRACE_PERIOD_BUNGA }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputangsuranblnpersen">Angsuran per Bulan</label>
                      <input type="text" name="inputangsuranblnpersen" value="{{ $kredit->JML_ANGSURAN_PER_BULAN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputangsuranbln">Angsuran</label>
                      <input type="text" name="inputangsuranbln" value="{{ $kredit->angsuran_total }}" readonly class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputbungaekiv">Bunga Ekiv.</label>
                      <input type="text" name="inputbungaekiv" value="{{ $kredit->SUKU_BUNGA_EKIVALEN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputbungaekivbln">.</label>
                      <input type="text" name="inputbungaekivbln" value="{{ ($kredit->SUKU_BUNGA_EKIVALEN)/12 }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputangsuranfee1">Angs. Fee I</label>
                      <input type="text" name="inputangsuranfee1" value="{{ $kredit->FEE_BUNGA_1_PER_TAHUN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputangsuranfee1rp">Rp.</label>
                      <input type="text" name="inputangsuranfee1rp" value="{{ $kredit->FEE_BUNGA_1_PER_TAHUN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputangsuranfee2">Angs. Fee II</label>
                      <input type="text" name="inputangsuranfee2" value="{{ $kredit->FEE_BUNGA_2_PER_TAHUN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputangsuranfee2rp">Rp.</label>
                      <input type="text" name="inputangsuranfee2rp" value="{{ ($kredit->FEE_BUNGA_2_PER_TAHUN)*(($kredit->SUKU_BUNGA_EKIVALEN)/12) }}" readonly class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputdendaharian">Denda</label>
                      <input type="text" name="inputdendaharian" value="{{ $kredit->denda_per_hari }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputdendajtharian">Denda JT</label>
                      <input type="text" name="inputdendajtharian" value="{{ $kredit->TAGIHAN_JT }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputgphari">Grace Period</label>
                      <input type="text" name="inputgphari" value="{{ $kredit->GRACE_PERIOD }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputbyadminpersen">Adm</label>
                      <input type="text" name="inputbyadminpersen" value="{{ $kredit->ADM_PER_BLN }}" readonly class="form-control">
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
                      <input type="text" name="inputprovisi" value="{{ $kredit->PERSEN_PROVISI }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-5 col-sm-12">
                      <label for="inputprovisirp">.</label>
                      <input type="text" name="inputprovisirp" value="{{ $kredit->PROVISI }}" readonly class="form-control">
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
                      <input type="text" name="inputadmfinal" value="{{ $kredit->PERSEN_ADM }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-5 col-sm-12">
                      <label for="inputadmfinalrp">.</label>
                      <input type="text" name="inputadmfinalrp" value="{{ $kredit->ADM }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputamortisasiadm">.</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="inputamortisasiadm" <?php if($kredit->amortisasi_adm=="1"){echo 'checked';}?>>
                        <label class="form-check-label" style="margin-right:30px;">Amortisasi</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-sm-12">
                      <label for="inputbytrans">By. Trans</label>
                      <input type="text" name="inputbytrans" value="{{ $kredit->PERSEN_BIAYA_TRANSAKSI }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-5 col-sm-12">
                      <label for="inputbytransrp">.</label>
                      <input type="text" name="inputbytransrp" value="{{ $kredit->biaya_transaksi }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputamortisasibytrans">.</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="inputamortisasibytrans" <?php if($kredit->amortisasi_biaya_transaksi=="1"){echo 'checked';}?>>
                        <label class="form-check-label" style="margin-right:30px;">Amortisasi</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputpremi">Premi</label>
                      <input type="text" name="inputpremi" value="{{ $kredit->PREMI }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputnotariel">Notariel</label>
                      <input type="text" name="inputnotariel" value="{{ $kredit->NOTARIEL }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputmaterai">Materai</label>
                      <input type="text" name="inputmaterai" value="{{ $kredit->MATERAI }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputpkmaterai">Pokok Materai</label>
                      <input type="text" name="inputpkmaterai" value="{{ $kredit->POKOK_MATERAI }}" readonly class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputlainlain">Lain-lain</label>
                      <input type="text" name="inputlainlain" value="{{ $kredit->ANGSURAN_ADMIN }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-1 col-sm-12">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputangsuranpremi">Angs. Premi</label>
                      <input type="text" name="inputangsuranpremi" value="{{ $kredit->JKW_PREMI }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputangsuranpremirp">.</label>
                      <input type="text" name="inputangsuranpremirp" value="{{ $kredit->ANGSURAN_PREMI }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="inputtotalpremi">Total Premi</label>
                      <input type="text" name="inputtotalpremi" value="{{ $kredit->TOTAL_PREMI }}" readonly class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 col-sm-12">
                      <label for="inputditanggungcheck">.</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="inputditanggungcheck" <?php if($kredit->amortisasi_biaya_transaksi=="1"){echo 'checked';}?>>
                        <label class="form-check-label" style="margin-right:30px;">Ditanggung</label>
                      </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                      <label for="inputditanggung">Ditanggung</label>
                      <input type="text" name="inputditanggung" value="{{ $kredit->PERSEKOT }}" readonly class="form-control">
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
            @elseif($jenisprofil=='tabungan')
            <!-- TABUNGAN VIEW -->
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
