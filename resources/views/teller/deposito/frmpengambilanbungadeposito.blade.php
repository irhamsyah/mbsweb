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
          <h3 class="card-title">Pengambilan Bunga Deposito</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tl_td_pengambilanbungadeposito">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputDate1">Tanggal Transaksi</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="tgl_trans" class="form-control datetimepicker-input" readonly
                        value="<?php echo($tgllogin) ?>" />
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="norekeningdep">No Rekening</label>
                    <div class="input-group date" data-target-input="nearest">
                      <input id="putnorekening" type="text" name="no_rekening" readonly class="form-control" required>

                      <div class="input-group-append" data-toggle="modal" data-target="#ambildatadepositoteller">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputjmldeposito">Nama Nasabah</label>
                    <input readonly id="putnamanasabah" type="text" name="nama_nasabah" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputjmldeposito">Jumlah Deposito (Rp)</label>
                    <input readonly id="putjmldeposito" type="text" name="inputjmldeposito" class="form-control">
                  </div>
                </div>
              </div>
              <div class="bottomlinesolid"></div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputkuitansi">Kuitansi</label>
                    <input type="text" name="kuitansi" class="form-control" id="kuitansi" required
                      onclick="bandingkan()" onchange=" bandingkan()">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputkodetransdep">Kode Transaksi</label>
                    <select class="form-control" name="kode_trans" id="putkodetrans" onchange="ambilvalueselect()">
                      @php($i=0)
                      @while ($i<count($kodetransdep) ) <option
                        value="{{$kodetransdep[$i]->KODE_TRANS}}-{{$kodetransdep[$i]->TOB}}">
                        {{$kodetransdep[$i]->KODE_TRANS}}-{{$kodetransdep[$i]->DESKRIPSI_TRANS}}</option>
                        @php($i++)
                        @endwhile
                    </select>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputtypetrans">Type Trans</label>
                    <input readonly id="inputtypetrans" type="text" name="type_trans" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputsukubunga">Suku Bunga</label>
                    <input readonly id="inputsukubunga" type="text" name="suku_bunga" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputbungaakrual">Bunga Akrual</label>
                    <input readonly id="inputbungaakrual" type="text" name="bunga_akrual" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputsisabungaakrual">Sisa Bunga Akrual</label>
                    <input readonly id="inputsisabungaakrual" type="text" name="sisa_bunga_akrual" class="form-control">
                  </div>
                </div>
              </div>
              <div class="bottomlinesolid">
                <span class="judulOrange">Bunga Bulan Ini / Tanpa Proses Overbooking</span>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputbungablnini">Bunga</label>
                    <input readonly id="inputbungablnini" type="text" name="bunga_bln_ini" class="form-control"
                      value="0">
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputpajak">Pajak</label>
                    <input readonly id="inputpajakblnini" type="text" name="inputpajak" class="form-control" value="0">
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputbunganetto">Bunga Netto</label>
                    <input readonly id="inputbunganetto" type="text" name="bunga_netto" class="form-control">
                  </div>
                </div>
              </div>
              <div class="bottomlinesolid">
                <span class="judulOrange">Akumulasi bunga s/d Bulan Lalu (TITIPAN) / Melalui proses Overbooking</span>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputtotaltiitpanbunga">Total Jml Titipan Bunga</label>
                    <input readonly id="inputtotaltitipanbunga" type="text" name="titipan_bunga" class="form-control"
                      value="0">
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputtitipandiambil">Jml Titipan yang diambil</label>
                    <input id="inputtitipandiambil" type="text" name="titipan_ambil" class="form-control" value="0"
                      onclick="bandingkan()" onchange=" bandingkan()">
                    <label for="crot">*Wajib Tekan Tab Untuk Melihat Total</label>
                  </div>
                  <div class="col-lg-4 col-sm-6">
                    <label for="inputtotalbungadiambil">Total Bunga yang diambil (Bunga bln ini + Titipan)</label>
                    <input readonly id="inputtotalbungadiambil" type="text" name="total_bunga_diambil" value="0"
                      class="form-control">
                  </div>
                </div>
              </div>
              <div class="bottomlinesolid">
                <span class="judulOrange">Overbooking Ke Tabungan</span>
              </div>
              <div class="form-group" id="123">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputkodetranstab">Kode Transaksi Tabungan</label>
                    <select class="form-control" name="kode_trans_tab" id="putkodetranstab">
                      @php($i=0)
                      @while ($i<count($kodetranstab) ) @if($kodetranstab[$i]->KODE_TRANS==33)
                        <option
                          value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}"
                          selected>
                          {{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                        @else
                        <option
                          value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">
                          {{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                        @endif
                        @php($i++)
                        @endwhile
                    </select>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputkodetranstab">Kode Penarikan Pajak</label>
                    <select class="form-control" name="kode_trans_pajak" id="putkodetranstab">
                      @php($i=0)
                      @while ($i<count($kodetranstab) ) @if($kodetranstab[$i]->KODE_TRANS==4)
                        <option
                          value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}"
                          selected>
                          {{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                        @else
                        <option
                          value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">
                          {{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                        @endif @php($i++)
                        @endwhile
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="norekeningtab">No Rekening Tabungan</label>
                    <div class="input-group date" data-target-input="nearest">
                      <input id="putnorekeningtab" type="text" name="no_rekening_tab" readonly class="form-control"
                        required>

                      <div class="input-group-append" data-toggle="modal" data-target="#ambildatatabunganteller">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputnmnasabahtab">Nama Nasabah</label>
                    <input readonly id="putnamanasabahtab" type="text" name="nama_nasabah_tab" class="form-control">
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputsaldoakhirtab">Saldo Akhir</label>
                    <input readonly id="putsaldoakhirtab" type="text" name="saldo_akhir_tab" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  {{-- <div class="col-lg-10">
                  </div> --}}
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary" style="float:left;margin-top:15px;"><i
                        class="fa fa-check" aria-hidden="true"></i> Simpan</button>
                  </div>
                  @if(isset($nama_nasabah))
                  <div class="col-lg-2">
                    <a href="{{ route('cetakkuitansi',['no_rekening' => $no_rekening,
                      'kuitansi' => $kuitansi,
                      'nama_nasabah' => $nama_nasabah,
                      'jml_deposito' => $jml_deposito,
                      'tob' => $tob,
                      'total_bunga_diambil' => $total_bunga_diambil,
                      'bunga_bln_ini' => $bunga_bln_ini,
                      'pajak_bln_ini' => $pajak_bln_ini,
                      'titipan_ambil' => $titipan_ambil,
                      'no_rekening_tab'=>$no_rekening_tab,
                      'tgl_trans' => $tgl_trans])}}" class="btn btn-md btn-danger"
                      style="float:left;margin-top:15px;"><i class="fa fa-print" aria-hidden="true"></i> Cetak
                    </a>
                  </div>
                  <div class="col-lg-2">
                    <a href="{{ route('cetakvalidasi',['no_rekening' => $no_rekening,
                      'kuitansi' => $kuitansi,
                      'nama_nasabah' => $nama_nasabah,
                      'jml_deposito' => $jml_deposito,
                      'tob' => $tob,
                      'total_bunga_diambil' => $total_bunga_diambil,
                      'bunga_bln_ini' => $bunga_bln_ini,
                      'pajak_bln_ini' => $pajak_bln_ini,
                      'titipan_ambil' => $titipan_ambil,
                      'no_rekening_tab'=>$no_rekening_tab,
                      'kode_trans'=>$kode_trans,
                      'total_bunga_diambil'=>$total_bunga_diambil,
                      'tgl_trans' => $tgl_trans])}}" class="btn btn-md btn-danger"
                      style="float:left;margin-top:15px;"><i class="fa fa-book" aria-hidden="true"></i> Validasi
                    </a>
                  </div>
                  @endif
                </div>
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
  {{-- MODAL TAMPIL TABEL DEPOSITO --}}
  <div class="modal fade bs-modal-dep" id="ambildatadepositoteller" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ambildatadepositoteller">Data Deposito</h5>
        </div>
        <div class="modal-body">
          <table id="datadepositoteller" class="display" width="100%">
            <thead>
              <tr>
                <th>No_Rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat Nasabah</th>
                <th>Bunga Bulan Ini</th>
                <th>Pajak Bulan Ini</th>
                <th>Jml Deposito</th>
                <th>Saldo Titipan</th>
                <th>No Rek Tabungan</th>
                <th style="display:none;">jkw</th>
                <th style="display:none;">pph</th>
                <th style="display:none;">bunga</th>
                <th style="display:none;">alternatif</th>
                <th style="display:none;">kodeBIpemilik</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($depositos as $value)
              <tr>
                <td>{{ $value->NO_REKENING }}</td>
                <td>{{ $value->nama_nasabah }}</td>
                <td>{{ $value->alamat}}</td>
                <td>{{ $value->BUNGA_BLN_INI}}</td>
                <td>{{ $value->PAJAK_BLN_INI}}</td>
                <td>{{ $value->nominal}}</td>
                <td>{{ $value->saldo_titipan }}</td>
                <td>{{ $value->NO_REK_TABUNGAN }}</td>
                <td style="display:none">{{ $value->JKW }}</td>
                <td style="display:none">{{ $value->PERSEN_PPH }}</td>
                <td style="display:none">{{ $value->SUKU_BUNGA }}</td>
                <td style="display:none">{{ $value->NO_ALTERNATIF }}</td>
                <td style="display:none">{{ $value->KODE_BI_PEMILIK }}</td>
                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu">
                    <a id="klikdeposito" href="#" class="dropdown-item" data-dismiss="modal">
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
              @foreach($tabungans as $value)
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
                    <a id="kliktabungan" href="#" class="dropdown-item">
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