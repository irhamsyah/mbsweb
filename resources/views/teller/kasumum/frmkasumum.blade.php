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
          <h3 class="card-title">Transaksi Kas Umum</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="bo_tl_ku_transaksikasumum">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputDate1">No.Transaksi</label>
                    <input value="0" type="text" class="form-control" name="notrans" id="IdNotrans" readonly>
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputDate1">Tanggal Transaksi</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="tgl_trans" class="form-control datetimepicker-input" readonly
                        value="<?php echo($tgllogin) ?>" />
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="norekeningdep">Kode</label>
                    <div class="input-group date" data-target-input="nearest">
                      <select name="kode" id="idKode" class="form-control">
                        @foreach($tellerkode as $values)
                        <option value="{{$values->KODE_TRANS.'-'.$values->TYPE_TRANS.'-'.$values->GL_ASAL}}">
                          {{$values->KODE_TRANS.'|'.$values->DESKRIPSI_TRANS}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputjmldeposito">Kuitansi</label>
                    <input id="idKuitansi" type="text" name="kuitansi" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputjmldeposito">Uraian Umum</label>
                    <input id="idUraian" type="text" name="uraian_umum" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="idenabledtmbhtrs" name="pilihmultiple">
                <label class="form-check-label" for="idenabledtmbhtrs">
                  Multiple Entry
                </label>
              </div>
              <div class="bottomlinesolid"></div>
              <div class="form-group" id="idisianmulti">
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputkuitansi">Uraian</label>
                    <input type="text" name="uraian" class="form-control" id="iduraian" >
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputtypetrans">Jumlah</label>
                    <input id="inputjmltransaksi" type="text" name="jumlah" class="form-control">
                    <label for="jumlah">* Jangan di ENTER , Klik Tambah Jika Multiple Transaksi atau SIMPAN Jika mau Simpan</label>
                  </div>
                </div>
              </div>
              <div class="bottomlinesolid">
                <span class="judulOrange">GL Balance</span>
              </div>
              <div class="form-group">
                <div class="col-lg-3 col-sm-6">
                  <label for="nasabahid">Kode Perkiraan</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input id="idKodePerkadd" type="text" name="kode_perk" readonly class="form-control" data-toggle="modal" data-target="#ambildataperkiraan" required>
                    <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraan">
                      <div class="input-group-text"><i class="fa fa-book"></i></div>
                    </div>

                  </div>
                  <input type="text" name="nama_perk" id="idNamaPerkadd" class="form-control" readonly
                    style="width: 400px;border : 0px;background-color:rgb(249, 249, 250)">
                </div>
                <div class="col-lg-3 col-sm-6">
                  <button type="button" class="btn-sm btn-danger" id="btn2">Tambah Transaksi</button>
                </div>
              </div>
              {{-- bagian table untuk tampil data detail multiple input --}}
              <div class="bottomlinesolid">
                <span class="judulOrange">Record Tercatat</span>
              </div>
              <div class="form-group" id="iddetailkas">
              </div>
              <div class="form-group">
                <div class="row">
                  {{-- <div class="col-lg-10">
                  </div> --}}
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary" style="float:left;margin-top:15px;"><i
                        class="fa fa-check" aria-hidden="true"></i> Simpan</button>
                  </div>
                </div>
              </div>
            </div>
            <input hidden type="text" id="idJmltrans" name="totaljumlah">
            <input hidden type="text" id="idCntElmnt" name="jmlelement">
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
{{-- MODAL TAMPIL TABEL PERKIRAAN --}}
<div class="modal fade" id="ambildataperkiraan" tabindex="-1" role="dialog" aria-labelledby="ambildataperkiraanTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ambildataperkiraan">Data Perkiraan</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body">
        <table id="idperkiraanxx" class="display" width="100%">
          <thead>
            <tr>
              <th>Kode_perk</th>
              <th>Nama_Perk</th>
              <th>kode_induk</th>
              <th>Level</th>
              <th>Type</th>
              <th>Saldo_akhir</th>
              <th style="display: none">Saldo_awal</th>
              <th style="display: none">DK</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($perkiraan as $value)
            <tr>
              <td>{{ $value->kode_perk }}</td>
              <td>{{ $value->nama_perk }}</td>
              <td>{{ $value->kode_induk }}</td>
              <td>{{ $value->level }}</td>
              <td>{{ $value->type }}</td>
              <td>{{ number_format($value->saldo_akhir,2,",",".") }}</td>
              <td style="display: none">{{ $value->saldo_awal }}</td>
              <td style="display: none">{{ $value->dk }}</td>
              <td>
                <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                  Action <span class="caret"></span>
                </a>
                <div class="dropdown-menu" data-dismiss="modal">
                  <a id="klik" href="#" class="dropdown-item">
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