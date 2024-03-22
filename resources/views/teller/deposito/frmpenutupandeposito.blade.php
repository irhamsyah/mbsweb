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

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card-header">
          <h3 class="card-title">Pengambailan / Penutupan Deposito</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tl_td_penutupandeposito">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputDate1">Tanggal Transaksi</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="tgl_trans" class="form-control datetimepicker-input" readonly
                        value="{{$tgllogin}}" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
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
                    <label for="putalternatif">No Alternatif</label>
                    <input readonly id="putalternatif" type="text" name="no_alternatif" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputnmnasabah">Nama Nasabah</label>
                    <input readonly id="putnamanasabah" type="text" name="nama_nasabah" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputkodepemilik">Kode Pemilik</label>
                    <select class="form-control" id="putkodepemilik" name="kode_bi_pemilik" readonly>
                      <option value="" selected disabled></option>
                      @foreach($golonganpihaklawan as $value)
                      <option value="{{$value->sandi}}">{{$value->sandi}}-{{$value->deskripsi_golongan}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <label for="inputalamat">Alamat</label>
                    <input type="text" id="putalamat" name="alamat" readonly class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate2">Tgl Registrasi</label>
                    <div class="input-group date" id="inputDate2" data-target-input="nearest">
                      <input type="text" id="puttglregistrasi" name="tgl_registrasi"
                        class="form-control datetimepicker-input" data-target="#inputDate2" readonly />
                      <div class="input-group-append" data-target="#inputDate2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate3">Tgl JT</label>
                    <div class="input-group date" id="inputDate3" data-target-input="nearest">
                      <input type="text" id="puttgljt" name="tgl_jt" class="form-control datetimepicker-input"
                        data-target="#inputDate3" readonly />
                      <div class="input-group-append" data-target="#inputDate3" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-1 col-sm-6">
                    <label for="inputjkw">Jangka Wkt</label>
                    <input type="text" id="putjkw" name="jkw" readonly class="form-control" required>
                  </div>
                  <div class="col-lg-1 col-sm-6">
                    <label for="inputbunga">Bunga</label>
                    <input type="text" id="putbunga" name="bunga" readonly class="form-control" required>
                  </div>
                  <div class="col-lg-1 col-sm-6">
                    <label for="inputpph">PPH</label>
                    <input type="text" id="putpph" name="pph" readonly class="form-control" required>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputnominal">Nominal</label>
                    <input type="text" id="putnominal" name="nominal" readonly class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-9 col-sm-6"></div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputpinalti">Pinalti</label>
                    <input type="text" id="putpinalti" name="pinalti" readonly value="0" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-9 col-sm-6"></div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputtotalterima">Total Diterima</label>
                    <input type="text" id="puttotalterima" name="totalditerima" readonly class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="bottomlinesolid"></div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputkuitansi">Kuitansi</label>
                    <input type="text" name="kuitansi" class="form-control" id="kuitansi" required>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputkodetransdep">Kode Transaksi</label>
                    <select class="form-control" name="kode_trans" id="putkodetrans" onclick="ambilkodetrans()">
                      @php($i=0)
                      @while ($i<count($kodetransdep) ) @if($kodetransdep[$i]->KODE_TRANS=='006')
                        <option value="{{$kodetransdep[$i]->KODE_TRANS}}-{{$kodetransdep[$i]->TOB}}" selected>
                          {{$kodetransdep[$i]->KODE_TRANS}}-{{$kodetransdep[$i]->DESKRIPSI_TRANS}}</option>
                        @else
                        <option value="{{$kodetransdep[$i]->KODE_TRANS}}-{{$kodetransdep[$i]->TOB}}">
                          {{$kodetransdep[$i]->KODE_TRANS}}-{{$kodetransdep[$i]->DESKRIPSI_TRANS}}</option>
                        @endif
                        @php($i++)
                        @endwhile
                    </select>
                  </div>
                  <div class="col-lg-2 com-sm-6">
                    <label for="inputkodetransdep">&nbsp;</label>
                    <input type="text" readonly name="textkodetrans" class="form-control" id="textkodetrans" value="O">
                  </div>
                  <input hidden type="text" name="cab" value={{$kodecabang[0]->kode_cab}}>
                </div>
              </div>
              <div class="bottomlinesolid">
                <span class="judulOrange">Overbooking dari Tabungan</span>
              </div>
              <div class="form-group" id="123">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputkodetranstab">Kode Transaksi Tabungan</label>
                    <select class="form-control" name="kode_trans_tab" id="putkodetranstab">
                      @php($i=0)
                      @while ($i<count($kodetranstab) ) @if($kodetranstab[$i]->KODE_TRANS==31)
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
                  <div class="col-lg-3 col-sm-6">
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
                    <a href="{{ route('cetakkuitansicls',['no_rekening' => $no_rekening, 'no_alternatif' => $no_alternatif, 'nama_nasabah' => $nama_nasabah, 'totalditerima' => $totalditerima,'pinalti'=>$pinalti])}}"
                      class="btn btn-md btn-danger" style="float:left;margin-top:15px;"><i class="fa fa-print"
                        aria-hidden="true"></i> Cetak
                    </a>
                  </div>
                  <div class="col-lg-2">
                    <a href="{{ route('cetakvalidasiclsdep',['no_rekening' => $no_rekening, 'nama_nasabah' => $nama_nasabah, 'totalditerima' => $totalditerima,'kode_trans' => $kode_trans, 'kuitansi' => $kuitansi, 'tgl_trans' => $tgl_trans, 'no_rekening_tab' => $no_rekening_tab, 'nama_nasabah_tab' => $nama_nasabah_tab,'pinalti'=>$pinalti])}}"
                      class="btn btn-md btn-danger" style="float:left;margin-top:15px;"><i class="fa fa-book"
                        aria-hidden="true"></i> Validasi
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
          <table id="clsdepositoteller" class="display" width="100%">
            <thead>
              <tr>
                <th>No_Rekening</th>
                <th>No_Alternatif</th>
                <th>Nama Nasabah</th>
                <th>Alamat Nasabah</th>
                <th>Bunga</th>
                <th>Pph</th>
                <th>Jml Deposito</th>
                <th>Bunga Bln Ini</th>
                <th>Saldo Titipan</th>
                <th style="display:none;">jkw</th>
                <th style="display:none;">kodeBIpemilik</th>
                <th style="display:none;">tgl_registrasi</th>
                <th style="display:none;">tgl_jt</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($depositos as $value)
              <tr>
                <td>{{ $value->NO_REKENING }}</td>
                <td>{{ $value->NO_ALTERNATIF }}</td>
                <td>{{ $value->nama_nasabah }}</td>
                <td>{{ $value->alamat}}</td>
                <td>{{ $value->SUKU_BUNGA}}</td>
                <td>{{ $value->PERSEN_PPH}}</td>
                <td>{{ $value->nominal}}</td>
                <td>{{ $value->BUNGA_BLN_INI}}</td>
                <td>{{ $value->saldo_titipan }}</td>
                <td style="display:none">{{ $value->JKW }}</td>
                <td style="display:none">{{ $value->KODE_BI_PEMILIK }}</td>
                <td style="display:none">{{ $value->TGL_REGISTRASI }}</td>
                <td style="display:none">{{ $value->TGL_JT }}</td>
                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu">
                    <a id="klikdepositottp" href="#" class="dropdown-item" data-dismiss="modal">
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