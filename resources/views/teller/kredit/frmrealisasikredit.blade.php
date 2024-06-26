@extends('layouts.admin_main')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

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
        <div class="card-header">
          <h3 class="card-title">Realisasi Kredit</h3>
        </div>
        @if(isset($tglharini))
        <input type="text" name="tglloginmysysid" id="tglloginmysysid" hidden value="{{$tglharini}}">
        @endif
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form autocomplete="off" method="POST" action="/bo_tl_tk_realisasikredit/setrealisasi" role="search">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="nasabahid">No Rekening</label>
                    <div class="input-group mb-2 autocomplete">
                      <input id="no_rekening_kredit" type="text" name="no_rekening_kredit" class="form-control">
                      <div class="input-group-prepend">
                        <div class="input-group-append" data-toggle="modal" data-target="#ambildatakredit">
                          <div class="input-group-text"><i class="fa fa-user"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputopendate">.</label>
                    <select class="form-control" name="kode_transaksi" id="kode_transaksi" readonly>
                      <option value="kredit">{{'Kredit'}}</option>
                    </select>
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputopendate">ID Nasabah</label>
                    <input readonly id="id_nasabah" type="text" name="id_nasabah" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputnasabahid">Nama</label>
                    <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-group row">
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputnocif">Jml Kredit</label>
                    <input type="text" name="jml_pinjaman" class="form-control" id="jml_pinjaman">
                  </div>
                  <div class="col-lg-2 col-sm-12">
                    <label for="inputDate1">Tgl Realisasi</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="tgl_realisasi" id="tgl_realisasi"
                        class="form-control datetimepicker-input" required>
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-8">
                    <div class="row">
                      <label for="inputnocif">Jkw</label>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-sm-12">
                        <input type="text" name="jangka_waktu" class="form-control" id="jangka_waktu">
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <label for="inputDate1">Bulan</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-8">
                    <div class="row">
                      <label for="inputnocif">Jml Angsuran</label>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-sm-12">
                        <input type="text" name="jumlah_angsuran" class="form-control" id="jumlah_angsuran">
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <label for="inputDate1">X</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputnocif">Jatuh Tempo</label>
                    <input type="text" name="jatuh_tempo" class="form-control" id="jatuh_tempo">
                  </div>
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputnocif">Jenis & Type</label>
                    <select class="form-control" name="inputjeniskredit" id="inputjeniskredit">
                      @foreach($kodejeniskredit as $kodejeniskredit)
                      <option value="{{ $kodejeniskredit->KODE_JENIS_KREDIT }}">{{ $kodejeniskredit->KODE_JENIS_KREDIT.'
                        - '.$kodejeniskredit->DESKRIPSI_JENIS_KREDIT }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputnocif">Jml Bunga</label>
                    <input type="text" name="jumlah_bunga" class="form-control" id="jumlah_bunga">
                  </div>
                  <div class="col-lg-2 col-sm-8">
                    <div class="row">
                      <label for="inputnocif">Bunga</label>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-sm-12">
                        <input type="text" name="persen_bunga" class="form-control" id="persen_bunga">
                      </div>
                      <div class="col-lg-2 col-sm-12">
                        <label for="inputDate1">%</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-8">
                    <div class="col-lg-12 col-sm-12">
                      <label for="inputstatus">Status</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_kredit" checked="true">
                        <label class="form-check-label" style="margin-right:30px;">Belum Aktif</label>
                        <input class="form-check-input" type="radio" name="status_kredit">
                        <label class="form-check-label" style="margin-right:30px;">Aktif</label>
                        <input class="form-check-input" type="radio" name="status_kredit" <?php
                          //if($kredits[0]->STATUS_AKTIF=="3"){echo 'checked';}?>>
                        <label class="form-check-label">Lunas</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-8">
                    <br>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="dropping_bertahap" >
                      <label class="form-check-label" style="margin-right:30px;">Dropping Bertahap</label>
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-8">
                    <select class="form-control" name="inputtipepinjaman" id="inputtipepinjaman">
                      @foreach($kodetypekredit as $kodetypekredit)
                      <option value="{{ $kodetypekredit->KODE_TYPE_KREDIT }}">{{ $kodetypekredit->KODE_TYPE_KREDIT.' -
                        '.$kodetypekredit->DESKRIPSI_TYPE_KREDIT }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12 col-sm-12">
                  <div class="bottomlinesolid">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-2">
                  <br>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Tab Hold Dana</span>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Tab Premi Asuransi</span>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Tab Notariel</span>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Setoran Angsuran Awal</span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-2">
                  <span class="labeljudulright">Rek.

                  </span>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="rekening_hold_dana" >
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="rekening_premi_asuransi">
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="rekening_notariel" >
                  </div>
                </div>
                <div class="col-lg-4 col-sm-8">
                  <select class="form-control" name="kode_transaksi2" id="kode_transaksi2">
                    @php($i=0)
                    @while ($i<count($kodetranskredit) ) <option value="{{$kodetranskredit[$i]->KODE_TRANS}}">
                      {{$kodetranskredit[$i]->KODE_TRANS}}-{{$kodetranskredit[$i]->DESKRIPSI_TRANS}}</option>
                      @php($i++)
                      @endwhile
                  </select>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="potong_angsuran">
                    <label class="form-check-label" style="margin-right:30px;">Potong Angsuran</label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-2">
                  <span class="labeljudulright">Jumlah</span>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="jumlah_hold_dana" value="0">
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="jumlah_premi_asuransi" value="0">
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="jumlah_notariel" value="0">
                  </div>
                </div>
                <div class="col-lg-4 col-sm-8">
                  <div class="form-check">
                    <div class="row">
                      <div class="col-lg-5 col-sm-8">
                        <label class="form-check-label" style="margin-right:30px;">Angs. Pokok</label>
                      </div>
                      <div class="col-lg-7 input-group mb-2">
                        <input type="text" class="form-control" name="angsuran_pokok">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-2">
                  <span class="labeljudulright">Nama</span>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="nama_hold_dana">
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="nama_premi_aruransi">
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="nama_notariel">
                  </div>
                </div>
                <div class="col-lg-4 col-sm-8">
                  <div class="form-check">
                    <div class="row">
                      <div class="col-lg-5 col-sm-8">
                        <label class="form-check-label" style="margin-right:30px;">Angs. Bunga</label>
                      </div>
                      <div class="col-lg-7 input-group mb-2">
                        <input type="text" class="form-control" name="angsuran_bunga">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-2">
                  <span class="labeljudulright">Kode Transaksi</span>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <select class="form-control" name="kode_transaksi_hold_dana" id="kode_transaksi_hold_dana">
                    @php($i=0)
                    @while ($i<count($kodetranstab) ) <option
                      value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">
                      {{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                      @php($i++)
                      @endwhile
                  </select>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <select class="form-control" name="kode_transaksi_premi_asuransi" id="kode_transaksi_premi_asuransi">
                    @php($i=0)
                    @while ($i<count($kodetranstab) ) <option
                      value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">
                      {{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                      @php($i++)
                      @endwhile
                  </select>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <select class="form-control" name="kode_transaksi_notariel" id="kode_transaksi_notariel">
                    @php($i=0)
                    @while ($i<count($kodetranstab) ) <option
                      value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">
                      {{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                      @php($i++)
                      @endwhile
                  </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                  <div class="form-check">
                    <div class="row">
                      <div class="col-lg-5 col-sm-8">
                        <label class="form-check-label" style="margin-right:30px;">Angs. Admin</label>
                      </div>
                      <div class="col-lg-7 input-group mb-2">
                        <input type="text" class="form-control" name="angsuran_admin">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-8">
                  <span class="labeljudulright"> </span>
                </div>
                <div class="col-lg-4 col-sm-8">
                  <div class="form-check">
                    <div class="row">
                      <div class="col-lg-5 col-sm-8">
                        <label class="form-check-label" style="margin-right:30px;">Angs. Lain</label>
                      </div>
                      <div class="col-lg-7 input-group mb-2">
                        <input type="text" class="form-control" name="angsuran_lain">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12 col-sm-12">
                  <div class="bottomlinesolid">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-1 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Provisi</span>
                  </div>
                </div>
                <div class="col-lg-1 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Notariel</span>
                  </div>
                </div>
                <div class="col-lg-1 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Premi</span>
                  </div>
                </div>
                <div class="col-lg-9 col-sm-12">
                  <div class="row">
                    <div class="col-lg-2 col-sm-12">
                      <div class="bottomlinesolid">
                        <span class="judulOrange">Administrasi</span>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <div class="bottomlinesolid">
                            <span class="judulOrange">Materai</span>
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                          <div class="bottomlinesolid">
                            <span class="judulOrange">Lain-lain</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <div class="bottomlinesolid">
                        <span class="judulOrange">Pokok Materai</span>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <div class="bottomlinesolid">
                        <span class="judulOrange">Premi Kendaraan</span>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <div class="bottomlinesolid">
                        <span class="judulOrange">Biaya Transaksi</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-1 col-sm-12">
                  <input type="text" class="form-control" name="provisi" id="idprovisi">
                </div>
                <div class="col-lg-1 col-sm-12">
                  <input type="text" class="form-control" name="notariel" value="0">
                </div>
                <div class="col-lg-1 col-sm-12">
                  <input type="text" class="form-control" name="premi" value="0">
                </div>
                <div class="col-lg-9 col-sm-12">
                  <div class="row">
                    <div class="col-lg-2 col-sm-12">
                      <input type="text" class="form-control" name="administrasi" id="idadministrasi">
                    </div>
                    <div class="col-lg-3">
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <input type="text" class="form-control" name="materai" value="0">
                        </div>
                        <div class="col-lg-6 col-sm-12">
                          <input type="text" class="form-control" name="lain2" value="0">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <input type="text" class="form-control" name="pokok_materai" value="0">
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <input type="text" class="form-control" name="premi_kendaraan" value="0">
                    </div>
                    <div class="col-lg-2 col-sm-12">
                      <input type="text" class="form-control" name="biaya_transaksi" value="0">
                    </div>
                    <div class="col-lg-8 col-sm-12">
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="transaksi_ditanggung_debitur">
                      <label class="form-check-label" style="margin-right:30px;">Biaya transaksi ditanggung
                        debitur</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-2 col-sm-12">
                  <label for="inputnocif">Tgl Transaksi</label>
                  <input type="text" class="form-control" value='{{ $tanggaltransaksi }}' name="tgl_transaksi"
                    id="tgl_transaksi">
                </div>
                <div class="col-lg-2 col-sm-12">
                  <label for="inputnocif">No. Bukti</label>
                  <input type="text" class="form-control" name="no_bukti" required>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <label for="inputnocif">Kode Transaksi</label>
                  <select class="form-control" name="kode_transaksi3" id="kode_transaksi3" onchange="setTOB()">
                    @php($i=0)
                    @while ($i<count($kodetranskredit) ) 
                    @if($kodetranskredit[$i]->KODE_TRANS=="004")
                    <option value="{{$kodetranskredit[$i]->KODE_TRANS}}-{{$kodetranskredit[$i]->TOB}}" selected>
                      {{$kodetranskredit[$i]->KODE_TRANS}}-{{$kodetranskredit[$i]->DESKRIPSI_TRANS}}</option>
                    @else
                    <option value="{{$kodetranskredit[$i]->KODE_TRANS}}-{{$kodetranskredit[$i]->TOB}}">
                      {{$kodetranskredit[$i]->KODE_TRANS}}-{{$kodetranskredit[$i]->DESKRIPSI_TRANS}}</option>
                    @endif
                      @php($i++)
                      @endwhile
                  </select>
                </div>
                <div class="col-lg-1 col-sm-12">
                  <label for="inputnocif">Type</label>
                  <input type="text" value="O" class="form-control" name="tipe_transaksi" id="tipe_transaksi">
                </div>
                <div class="col-lg-2 col-sm-12">
                  <label for="inputnocif">Total Diterima</label>
                  <input type="text" class="form-control" name="total_diterima" id="idtotalditerima">
                </div>
                <div class="col-lg-2 col-sm-12">
                  <label for="inputnocif">Proyeksi Akrual</label>
                  <input type="text" class="form-control" name="proyeksi_akrual">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12 col-sm-12">
                  <div class="bottomlinesolid">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Overbook ke
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-3 col-sm-12">
                  <label for="inputnocif">Kode Transaksi
                    - Realisasi</label>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <select class="form-control" name="kode_transaksi_realisasi" id="kode_transaksi_realisasi">
                    @php($i=0)
                    @while ($i<count($kodetranstab) ) <option value="{{$kodetranstab[$i]->KODE_TRANS}}" <?php
                      if($kodetranstab[$i]->KODE_TRANS=='35'){echo
                      'selected';}?>>{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                      @php($i++)
                      @endwhile
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-3 col-sm-12">
                  <label for="inputnocif">Kode Transaksi
                    - Biaya</label>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <select class="form-control" name="kode_transaksi_biaya" id="kode_transaksi_biaya">
                    @php($i=0)
                    @while ($i<count($kodetranstab) ) <option value="{{$kodetranstab[$i]->KODE_TRANS}}" <?php
                      if($kodetranstab[$i]->KODE_TRANS=='36'){echo
                      'selected';}?>>{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                      @php($i++)
                      @endwhile
                  </select>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="row">
                    <div class="col-lg-4 col-sm-6">
                      <label for="nasabahid">OB - ke Rek.
                      </label>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                      <div class="input-group mb-2 autocomplete">
                        <input id="rekening_overbook" type="text" name="rekening_overbook" class="form-control">

                        <div class="input-group-append" data-toggle="modal" data-target="#ambildatatabunganteller
                          "> 
                        <div class="input-group-text"><i class="fa fa-search"></i></div>
                        
                      </div>
                      <input id="nama_overbook" type="text" name="nama_overbook" class="form-control">

                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-3 col-sm-12">
                  <label for="inputnocif">Kode Transaksi
                    - Lain2</label>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <select class="form-control" name="kode_transaksi_lain2" id="kode_transaksi_lain2">
                    <!-- @php($i=0)
                      @while ($i<count($kodetranstab) )
                      <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                          @php($i++)
                      @endwhile -->
                  </select>
                </div>
                <div class="col-lg-6 col-sm-6">
                  <div class="row">
                    <div class="col-lg-4 col-sm-6">
                    </div>
                    <div class="col-lg-6 col-sm-6">
                      <input id="nama_overbook" type="text" name="nama_overbook" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12 col-sm-12">
                  <div class="bottomlinesolid">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12 col-sm-12">
                  <div class="bottomlinesolid">
                    <span class="judulOrange">Kredit Channeling</span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-2 col-sm-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="channeling" <?php //
                      if($kredits[0]->STATUS_AKTIF=="1"){echo 'checked';}?>>
                    <label class="form-check-label" style="margin-right:30px;">Channeling</label>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-8">
                  <div class="col-lg-12 col-sm-12">
                    <label for="inputstatus">Jenis Titipan</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="jenis_titipan" checked="true">
                      <label class="form-check-label" style="margin-right:30px;">GL</label>
                      <input class="form-check-input" type="radio" name="jenis_titipan">
                      <label class="form-check-label" style="margin-right:30px;">
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-8">
                  <div class="col-lg-12 col-sm-12">
                    <label for="inputstatus">Kode Trans.

                    </label>
                    <select class="form-control" name="kode_transaksi_channeling" id="kode_transaksi_channeling">
                      @php($i=0)
                      @while ($i<count($kodetranstab) ) <option
                        value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">
                        {{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                        @php($i++)
                        @endwhile
                    </select>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="col-lg-12 col-sm-6">
                    <label for="nasabahid">No Rekening

                    </label>
                    <div class="input-group date" data-target-input="nearest">
                      <input id="no_rekening_channeling" type="text" name="no_rekening_channeling" class="form-control">

                      <div class="input-group-append" data-toggle="modal" data-target="#ambildata
                          ">
                        <div class="input-group-text"><i class="fa fa-search"></i></div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="col-lg-12 col-sm-6">
                    <input id="nama_chaneling" type="text" name="nama_chaneling" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-lg-12 col-sm-12">
                <div class="bottomlinesolid">
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
              <button name="btn_realisasi" type="submit" class="btn btn-outline-primary">Realisasi</button>
            </div>
        </div>
        <!-- /.card-body -->
        </form>
      </div>
      <!-- /.card -->
      <div class="card">
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
</div>
{{-- MODAL TAMPIL TABEL KREDIT --}}
<div class="modal fade bs-modal-nas" id="ambildatakredit" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ambildatakredit">Data Nasabah</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body">
        <table id="kreditdata" class="display" width="100%">
          <thead>
            <tr>
              <th>No_rekening</th>
              <th>Nasabah Id</th>
              <th>Nama Nasabah</th>
              <th>Plafond</th>
              <th>Jml_Bunga</th>
              <th>JKW</th>
              <th>SukuBunga</th>
              <th style="display: none">tgl_realisasi</th>
              <th style="display: none">tgl_jt</th>
              <th style="display: none">jenis_pinj</th>
              <th style="display: none">type_pinj</th>
              <th style="display: none">provisi</th>
              <th style="display: none">admin</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($kredits as $value)
            <tr>
              <td>{{ $value->NO_REKENING }}</td>
              <td>{{ $value->NASABAH_ID }}</td>
              <td>{{ $value->nama_nasabah }}</td>
              <td>{{ $value->JML_PINJAMAN }}</td>
              <td>{{ $value->JML_BUNGA_PINJAMAN }}</td>
              <td>{{ $value->JML_ANGSURAN }}</td>
              <td>{{ $value->SUKU_BUNGA_PER_ANGSURAN }}</td>
              <td style="display:none">{{ $value->TGL_REALISASI }}</td>
              <td style="display: none">{{ $value->TGL_JATUH_TEMPO }}</td>
              <td style="display:none">{{ $value->JENIS_PINJAMAN }}</td>
              <td style="display: none">{{ $value->TYPE_PINJAMAN }}</td>
              <td style="display: none">{{ $value->PROVISI }}</td>
              <td style="display: none">{{ $value->ADM }}</td>
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

<!-- /.content -->

@endsection
  {{-- MODAL TAMPIL TABEL TABUNGAN --}}
  <div class="modal fade bs-modal-tab" id="ambildatatabunganteller" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ambildatatabunganteller">Data Tabungan</h5>
        </div>
        <div class="modal-body">
          <table id="datatabunganteller" class="display tablemodal" width="100%">
            <thead>
              <tr>
                <th>No_Rekening</th>
                <th>Nama Nasabah</th>
                <th style="display:none">Alamat Nasabah</th>
                <th style="display:none">Jenis Tabungan</th>
                <th>Saldo Akhir</th>
                <th style="display:none">saldo blokir</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tabungan as $value)
              <tr>
                <td>{{ $value->NO_REKENING }}</td>
                <td>{{ $value->nama_nasabah }}</td>
                <td style="display:none">{{ $value->alamat}}</td>
                <td style="display:none">{{ $value->JENIS_TABUNGAN}}</td>
                <td>{{ $value->saldo_akhir }}</td>
                <td style="display:none">{{ $value->SALDO_BLOKIR }}</td>
                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu">
                    <a id="kliktabungan" href="#" class="dropdown-item" data-dismiss="modal">
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

  <script>
  function setTOB(){
    var gettob = document.getElementById('kode_transaksi3').value;
    var puttob = gettob.substr(4,1);
    document.getElementsByName("tipe_transaksi")[0].value = puttob;
  }
  // function autocomplete(inp, arr, nama, alamat,s) {
  // /*the autocomplete function takes two arguments,
  // the text field element and an array of possible autocompleted values:*/
  // var currentFocus;
  // /*execute a function when someone writes in the text field:*/
  // inp.addEventListener("input", function(e) {
  //     var a, b, i, val = this.value;
  //     /*close any already open lists of autocompleted values*/
  //     closeAllLists();
  //     if (!val) { return false;}
  //     currentFocus = -1;
  //     /*create a DIV element that will contain the items (values):*/
  //     a = document.createElement("DIV");
  //     a.setAttribute("id", this.id + "autocomplete-list");
  //     a.setAttribute("class", "autocomplete-items");
  //     /*append the DIV element as a child of the autocomplete container:*/
  //     this.parentNode.appendChild(a);
  //     /*for each item in the array...*/
  //     for (i = 0; i < arr.length; i++) {
  //       /*check if the item starts with the same letters as the text field value:*/
  //       if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
  //         /*create a DIV element for each matching element:*/
  //         b = document.createElement("DIV");
  //         /*make the matching letters bold:*/
  //         b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
  //         b.innerHTML += arr[i].substr(val.length) + ' - ' + nama[i];
  //         /*insert a input field that will hold the current array item's value:*/
  //         b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
  //         /*execute a function when someone clicks on the item value (DIV element):*/
  //         b.addEventListener("click", function(e) {
  //             /*insert the value for the autocomplete text field:*/
  //             inp.value = this.getElementsByTagName("input")[0].value.trim();  
  //             kredits.forEach(findIndex);
  //             function findIndex(value, index, array) {
  //               if(value.NO_REKENING.trim()==inp.value.trim()){
  //                setKredit(index);
  //               } 
  //             }  
  //             /*close the list of autocompleted values,
  //             (or any other open lists of autocompleted values:*/
  //             closeAllLists();
  //         });
  //         a.appendChild(b);
  //       }
  //     }
  // });
  // /*execute a function presses a key on the keyboard:*/
  // inp.addEventListener("keydown", function(e) {
  //     var x = document.getElementById(this.id + "autocomplete-list");      
  //     if (x) x = x.getElementsByTagName("div");
  //     if (e.keyCode == 40) {
  //       /*If the arrow DOWN key is pressed,
  //       increase the currentFocus variable:*/
  //       currentFocus++;
  //       /*and and make the current item more visible:*/
  //       addActive(x);
  //     } else if (e.keyCode == 38) { //up
  //       /*If the arrow UP key is pressed,
  //       decrease the currentFocus variable:*/
  //       currentFocus--;
  //       /*and and make the current item more visible:*/
  //       addActive(x);
  //     } else if (e.keyCode == 13) {
  //       /*If the ENTER key is pressed, prevent the form from being submitted,*/
  //       e.preventDefault();
  //       if (currentFocus > -1) {
  //         /*and simulate a click on the "active" item:*/
  //         if (x) x[currentFocus].click();
  //         // inpnama.value=nama[currentFocus];
  //         // inpalamat.value=alamat[currentFocus];
  //       }
  //     }
  // });
  // function addActive(x) {
  //   /*a function to classify an item as "active":*/
  //   if (!x) return false;
  //   /*start by removing the "active" class on all items:*/
  //   removeActive(x);
  //   if (currentFocus >= x.length) currentFocus = 0;
  //   if (currentFocus < 0) currentFocus = (x.length - 1);
  //   /*add class "autocomplete-active":*/
  //   x[currentFocus].classList.add("autocomplete-active"); 
  // }
  // function removeActive(x) {
  //   /*a function to remove the "active" class from all autocomplete items:*/
  //   for (var i = 0; i < x.length; i++) {
  //     x[i].classList.remove("autocomplete-active");
  //   }
  // }
  // function closeAllLists(elmnt) {
  //   /*close all autocomplete lists in the document,
  //   except the one passed as an argument:*/
  //   var x = document.getElementsByClassName("autocomplete-items");
  //   for (var i = 0; i < x.length; i++) {
  //     if (elmnt != x[i] && elmnt != inp) {
  //       x[i].parentNode.removeChild(x[i]);
  //     }
  //   }
  // }
  // /*execute a function when someone clicks in the document:*/
  // document.addEventListener("click", function (e) {  
  //   closeAllLists(e.target);
  // });
  // }

    // var kredits = {!! json_encode($kredits) !!};

    // var rekening=[];
    // var  nasabahnama=[];
    // var nasabahalamat=[];
    // kredits.forEach(splitData);
    // function splitData(value, index, array) {
    //   rekening.push(value.NO_REKENING);
    //   nasabahnama.push(value.nama_nasabah);
    //   nasabahalamat.push(value.alamat);  
    // }
    // window.onload = function(e){ 

    //   autocomplete(document.getElementsByName("no_rekening_kredit")[0], rekening, nasabahnama, nasabahalamat, kredits);
    //   autocomplete2(document.getElementsByName("rekening_overbook")[0],document.getElementsByName("nama_overbook")[0], rekening2, nasabahnama2, nasabahalamat2, tabungans);

    // }

    // function selectElement(id, valueToSelect) { 
    //     let element = document.getElementsByName(id)[0];
    //     element.value = valueToSelect;
    // }


    // function setKredit(index){
    //   document.getElementsByName("id_nasabah")[0].value=kredits[index].nasabah_id;
    //   document.getElementsByName("nama_nasabah")[0].value=kredits[index].nama_nasabah; 
    //   document.getElementsByName("jml_pinjaman")[0].value=kredits[index].JML_PINJAMAN;
    //   var parts = kredits[index].TGL_REALISASI.split('-');
    //   var mydate = parts[2] + '/' + parts[1] + '/' + parts[0];
    //   document.getElementsByName("tgl_realisasi")[0].value=mydate;
    //   document.getElementsByName("jangka_waktu")[0].value=kredits[index].BI_JANGKA_WAKTU; 
    //   document.getElementsByName("jumlah_angsuran")[0].value=kredits[index].JML_ANGSURAN;
    //   parts = kredits[index].TGL_JATUH_TEMPO.split('-');
    //   mydate = parts[2] + '/' + parts[1] + '/' + parts[0];
    //   document.getElementsByName("jatuh_tempo")[0].value=mydate;
    //   document.getElementsByName("jumlah_bunga")[0].value=kredits[index].JML_BUNGA_PINJAMAN; 
    //   document.getElementsByName("persen_bunga")[0].value=kredits[index].SUKU_BUNGA_PER_TAHUN;
    //   selectElement('inputjeniskredit', kredits[index].JENIS_PINJAMAN);
    //   selectElement('inputtipepinjaman', kredits[index].TYPE_PINJAMAN);    
    //   document.getElementsByName("angsuran_pokok")[0].value=kredits[index].angsuran_pokok;
    //   document.getElementsByName("angsuran_bunga")[0].value=kredits[index].angsuran_bunga;
    //   document.getElementsByName("provisi")[0].value=kredits[index].PROVISI;
    //   document.getElementsByName("administrasi")[0].value=kredits[index].ADM;
    //   document.getElementsByName("total_diterima")[0].value=kredits[index].JML_PINJAMAN-kredits[index].PROVISI;
    //   parts = document.getElementsByName("tgl_transaksi")[0].value.split('/');
    //   const x = new Date(parts[2]+'-'+parts[1]+'-'+parts[0]);
    //   const y = new Date(kredits[index].TGL_REALISASI);
    //   if(y>x){
    //     alert("Belum bisa realisasi kredit");
    //   }else{
    //     // alert("sudah bisa realisasi")
    //     document.getElementsByName("btn_realisasi")[0].disabled=false;
    //   }
    // }

    // function autocomplete2(inp,inpnama, arr, nama, alamat, tabungans) {
    //     /*the autocomplete function takes two arguments,
    //     the text field element and an array of possible autocompleted values:*/
    //     var currentFocus;
    //     /*execute a function when someone writes in the text field:*/
    //     inp.addEventListener("input", function(e) {
    //         var a, b, i, val = this.value;
    //         /*close any already open lists of autocompleted values*/
    //         closeAllLists();
    //         if (!val) { return false;}
    //         currentFocus = -1;
    //         /*create a DIV element that will contain the items (values):*/
    //         a = document.createElement("DIV");
    //         a.setAttribute("id", this.id + "autocomplete-list");
    //         a.setAttribute("class", "autocomplete-items");
    //         /*append the DIV element as a child of the autocomplete container:*/
    //         this.parentNode.appendChild(a);
    //         /*for each item in the array...*/
    //         for (i = 0; i < arr.length; i++) {
    //           /*check if the item starts with the same letters as the text field value:*/
    //           if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
    //             /*create a DIV element for each matching element:*/
    //             b = document.createElement("DIV");
    //             /*make the matching letters bold:*/
    //             b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
    //             b.innerHTML += arr[i].substr(val.length) + ' - ' + nama[i];
    //             /*insert a input field that will hold the current array item's value:*/
    //             b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
    //             /*execute a function when someone clicks on the item value (DIV element):*/
    //             b.addEventListener("click", function(e) {
    //                 /*insert the value for the autocomplete text field:*/
    //                 inp.value = this.getElementsByTagName("input")[0].value.trim();  
    //                 tabungans.forEach(findIndex);
    //                 function findIndex(value, index, array) {
    //                   if(value.NO_REKENING.trim()==inp.value.trim()){
    //                     inpnama.value=nama[index];
    //                     // inpalamat.value=alamat[index]; 
    //                   } 
    //                 }  
    //                 /*close the list of autocompleted values,
    //                 (or any other open lists of autocompleted values:*/
    //                 closeAllLists();
    //             });
    //             a.appendChild(b);
    //           }
    //         }
    //     });
    //     /*execute a function presses a key on the keyboard:*/
    //     inp.addEventListener("keydown", function(e) {
    //         var x = document.getElementById(this.id + "autocomplete-list");      
    //         if (x) x = x.getElementsByTagName("div");
    //         if (e.keyCode == 40) {
    //           /*If the arrow DOWN key is pressed,
    //           increase the currentFocus variable:*/
    //           currentFocus++;
    //           /*and and make the current item more visible:*/
    //           addActive(x);
    //         } else if (e.keyCode == 38) { //up
    //           /*If the arrow UP key is pressed,
    //           decrease the currentFocus variable:*/
    //           currentFocus--;
    //           /*and and make the current item more visible:*/
    //           addActive(x);
    //         } else if (e.keyCode == 13) {
    //           /*If the ENTER key is pressed, prevent the form from being submitted,*/
    //           e.preventDefault();
    //           if (currentFocus > -1) {
    //             /*and simulate a click on the "active" item:*/
    //             if (x) x[currentFocus].click();
    //             inpnama.value=nama[currentFocus];
    //             // inpalamat.value=alamat[currentFocus];
    //           }
    //         }
    //     });
    //     function addActive(x) {
    //       /*a function to classify an item as "active":*/
    //       if (!x) return false;
    //       /*start by removing the "active" class on all items:*/
    //       removeActive(x);
    //       if (currentFocus >= x.length) currentFocus = 0;
    //       if (currentFocus < 0) currentFocus = (x.length - 1);
    //       /*add class "autocomplete-active":*/
    //       x[currentFocus].classList.add("autocomplete-active"); 
    //     }
    //     function removeActive(x) {
    //       /*a function to remove the "active" class from all autocomplete items:*/
    //       for (var i = 0; i < x.length; i++) {
    //         x[i].classList.remove("autocomplete-active");
    //       }
    //     }
    //     function closeAllLists(elmnt) {
    //       /*close all autocomplete lists in the document,
    //       except the one passed as an argument:*/
    //       var x = document.getElementsByClassName("autocomplete-items");
    //       for (var i = 0; i < x.length; i++) {
    //         if (elmnt != x[i] && elmnt != inp) {
    //           x[i].parentNode.removeChild(x[i]);
    //         }
    //       }
    //     }
    //     /*execute a function when someone clicks in the document:*/
    //     document.addEventListener("click", function (e) {  
    //       closeAllLists(e.target);
    //     });
    //   }

    //   var tabungans = {!! json_encode($tabungans) !!};

    //   var rekening2=[];
    //   var  nasabahnama2=[];
    //   var nasabahalamat2=[];
    //   tabungans.forEach(splitData2);
    //   function splitData2(value, index, array) {
    //     rekening2.push(value.NO_REKENING);
    //     nasabahnama2.push(value.nama_nasabah);
    //     nasabahalamat2.push(value.alamat);  
    //   }
  

</script>

<style>
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