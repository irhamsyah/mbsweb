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
        {{-- MUNCULKAN ERROR SAAT VALIDATE LARAVEL --}}
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
          {{$error}}
        </div>
        @endforeach
        @endif
        <div class="card-header">
          <h3 class="card-title">Penutupan Tabungan</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tl_tt_penutupantabungan">
            @csrf
            <div class="card-body">
              {{-- FORM GROUP 1 --}}
              <div class="form-group">
                {{-- BARIS 1 --}}
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
              {{-- FORM GROUP 2 --}}
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="norekeningdep">No Rekening</label>
                    <div class="input-group date" data-target-input="nearest">
                      <input id="putnorekeningtab" type="text" name="no_rekening" readonly class="form-control"
                        required>
                      <div class="input-group-append" data-toggle="modal" data-target="#ambildatatabunganteller">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputnmnasabah">Nama Nasabah</label>
                    <input readonly id="putnamanasabahtab" type="text" name="nama_nasabah" class="form-control">
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <label for="inputalamat">Alamat</label>
                    <input type="text" id="putalamat" name="alamat" readonly class="form-control">
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <label for="inputalamat">Saldo Saat Ini</label>
                    <input type="text" id="putsaldoakhirtabcls" name="saldo" readonly class="form-control">
                  </div>
                </div>
              </div>
              {{-- FORM GROUP 3 --}}
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputkuitansi">Kuitansi</label>
                    <input type="text" name="kuitansi" class="form-control" id="putkuitansi" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputkuitansi">Type Trans</label>
                    <select class="form-control" name="typetrans" id="puttypetrans">
                      <option value="T">Tunai</option>
                      <option value="O">Overbooking</option>
                    </select>
                  </div>
                </div>
                <input type="text" hidden name="cab" value="{{$cab}}">
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputkuitansi">By Administrasi</label>
                    <input type="text" name="byadmin" class="form-control" id="putbyadmin" value=0
                      onchange="jmlpengambilan()" required>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputkodetransdep">Kode Transaksi</label>
                    <select class="form-control" name="kode_trans_adm" id="putkodetransadm">
                      @php($i=0)
                      @while ($i<count($kodetrstab) ) @if($kodetrstab[$i]->KODE_TRANS=='09')
                        <option
                          value="{{$kodetrstab[$i]->KODE_TRANS}}-{{$kodetrstab[$i]->TYPE_TRANS}}-{{$kodetrstab[$i]->TOB}}"
                          selected>
                          {{$kodetrstab[$i]->KODE_TRANS}}-{{$kodetrstab[$i]->DESKRIPSI_TRANS}}</option>
                        @else
                        <option
                          value="{{$kodetrstab[$i]->KODE_TRANS}}-{{$kodetrstab[$i]->TYPE_TRANS}}-{{$kodetrstab[$i]->TOB}}">
                          {{$kodetrstab[$i]->KODE_TRANS}}-{{$kodetrstab[$i]->DESKRIPSI_TRANS}}</option>
                        @endif
                        @php($i++)
                        @endwhile
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputkuitansi">Jml Pengambilan</label>
                    <input type="text" name="jml_transaksi" class="form-control" id="putjmltransaksi" readonly required>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputkodetransdep">Kode Transaksi</label>
                    <select class="form-control" name="kode_trans" id="putkodetrans">
                      @php($i=0)
                      @while ($i<count($kodetrstab) ) @if($kodetrstab[$i]->KODE_TRANS=='09')
                        <option
                          value="{{$kodetrstab[$i]->KODE_TRANS}}-{{$kodetrstab[$i]->TYPE_TRANS}}-{{$kodetrstab[$i]->TOB}}"
                          selected>
                          {{$kodetrstab[$i]->KODE_TRANS}}-{{$kodetrstab[$i]->DESKRIPSI_TRANS}}</option>
                        @else
                        <option
                          value="{{$kodetrstab[$i]->KODE_TRANS}}-{{$kodetrstab[$i]->TYPE_TRANS}}-{{$kodetrstab[$i]->TOB}}">
                          {{$kodetrstab[$i]->KODE_TRANS}}-{{$kodetrstab[$i]->DESKRIPSI_TRANS}}</option>
                        @endif
                        @php($i++)
                        @endwhile
                    </select>
                  </div>
                  <div class="col-lg-3 col-sm-8">
                    <label for="inputkodetransdep">Kode Transaksi</label>
                    <textarea name="keterangan" id="putketerangan" cols="30" rows="4"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary" style="float:right;margin-top:15px"><i
                        class="fa fa-check" aria-hidden="true"></i> Simpan</button>
                    @if(isset($kuitansi))
                    <a href="{{ route('cetakkuitansiclstab',['no_rekening' => $no_rekening, 'nama_nasabah' => $nama_nasabah, 'saldo' => $saldo,'byadmin'=>$byadmin,'jml_transaksi'=>$jml_transaksi])}}"
                      class="btn btn-md btn-danger" style="float:right;margin-top:15px;margin-right:15px"><i
                        class="fa fa-print" aria-hidden="true"></i> Cetak Kuitansi</a>
                    <a href="{{ route('cetakvalidasiclstab',['kuitansi'=>$kuitansi,'no_rekening' => $no_rekening, 'nama_nasabah' => $nama_nasabah, 'saldo' => $saldo,'byadmin'=>$byadmin,'jml_transaksi'=>$jml_transaksi,'tgl_trans'=>$tgl_trans])}}"
                      class="btn btn-md btn-success" style="float:right;margin-top:15px;margin-right:15px"><i
                        class="fa fa-print" aria-hidden="true"></i> Cetak Validasi</a>
                    @endif
                  </div>
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
                <th>Alamat Nasabah</th>
                <th>Saldo Akhir</th>
                <th>Admin</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tabungan as $value)
              <tr>
                <td>{{ $value->no_rekening }}</td>
                <td>{{ $value->nama_nasabah }}</td>
                <td>{{ $value->alamat}}</td>
                <td>{{ $value->saldo_akhir }}</td>
                <td>{{ $value->adm_bln_ini }}</td>
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