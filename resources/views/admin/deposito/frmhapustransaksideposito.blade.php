@extends('layouts.admin_main')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="GET" action="/bo_deposito_transaksi_cari" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                  <label for="inputDate1">Tanggal Transaksi</label>
                  <div class="input-group date" id="idtglnominatif" data-target-input="nearest">
                    <input type="text" name="tgl_trans" class="form-control datetimepicker-input" data-target="#idtglnominatif"/>
                      <div class="input-group-append" data-target="#idtglnominatif" data-toggle="datetimepicker">
                      <div class="input-group-text">
                          <i class="fa fa-calendar"></i>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-4" style="margin-left:450px">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search" style="color:white">Cari</i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Transaksi Deposito</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
              <tr>
                <th>No</th>
                <th>Trans_id</th>
                <th>Tgl_trans</th>
                <th>Kuitansi</th>
                <th>No Rekening</th>
                <th>Nama Nasabah</th>
                <th>Jumlah</th>
                <th>Kode Trans</th>
                <th>No Rek Tab</th>
                <th>Action</th>
              </tr>
              </thead>
              @if(is_null(Auth::user())==false)
              @if(Auth::user()->privilege=='admin')
              <tbody>
              @php($index=0)
              @foreach($deptrans as $values)
              @php($index++)
                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ strtoupper($values->DEPTRANS_ID) }}</td>
                  <td>{{ $values->TGL_TRANS }}</td>
                  <td>{{ $values->KUITANSI }}</td>
                  <td>{{ $values->NO_REKENING}}</td>
                  <td>{{ $values->nama_nasabah}}</td>
                  <td>{{ $values->SALDO_TRANS}}</td>
                  <td>{{ $values->KODE_TRANS}}</td>
                  <td>{{ $values->NO_REK_OB}}</td>
                  <td>
                      <form action="/bo_dep_del_trs" method="post" style="margin-bottom: 0;">
                          <input type="hidden" name="no_rekening" value="{{ $values->NO_REKENING }}">
                          <input type="hidden" name="deptrans_id" value="{{ $values->DEPTRANS_ID }}">
                          <input type="hidden" name="no_bukti" value="{{ $values->KUITANSI }}" class="form-control">
                          <input type="hidden" name="no_rekening_tab" value="{{ $values->NO_REK_OB }}">
                          <input type="hidden" name="bunga_berbunga" value="{{ $values->bunga_berbunga }}">
                          <input type="hidden" name="masuk_titipan" value="{{ $values->masuk_titipan }}">
                          <input type="hidden" name="saldo_trans" value="{{ $values->SALDO_TRANS }}">
                          <input type="hidden" name="tgl_trans" value="{{ $values->TGL_TRANS }}">
                          <input type="hidden" name="my_kode_trans" value="{{ $values->MY_KODE_TRANS }}">
                          @csrf
                          <input type="hidden" name="_method" value="DELETE"/>
                          @if($values->POSTED==1)
                          <button type="submit" onclick="return confirm('Jadi Hapus Data Transaksi Yang Sudah Di POSTING ?')"class="btn btn-sm btn-danger" style="float: right;">
                          @else
                          <button type="submit" onclick="return confirm('Jadi Hapus Data Transaksi yang Belum di POSTING')"class="btn btn-sm btn-danger" style="float: right;">
                          @endif
                            <i class="fa fa-trash"></i>
                          </button>
                      </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
                @endif
              @else
              <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @endif
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
  
</div>
<!-- /.content -->
@endsection
