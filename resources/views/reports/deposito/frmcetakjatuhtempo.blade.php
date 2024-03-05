@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <h5>Deposito Jatuh Tempo</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="bo_dp_rp_depositojttmp" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                  <label for="inputDate1">JT Sampai Tanggal</label>
                  <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                    <input type="text" name="tgl_trans1" class="form-control datetimepicker-input"
                      value="<?php if(isset($tgltrs1)){echo($tgltrs1);} ?>" data-target="#idtglnominatif1" />
                    <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-1"></div>
                <div class="mx-auto col-md-3 col-sm-12">
                  <button type="submit" class="btn btn-warning" style="margin-left:40px ">Proses &nbsp;&nbsp;&nbsp;<i
                      class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
          @if(isset($transaksi))
          <form method="POST" action="exportjatuhtempo" role="search" style="margin-top:-40px;margin-left:180px">
            @csrf
            <input type="text" name="tgl_trans1" value="{{$tgltrs1}}" hidden>

            <div class="row form-group">
              <div class="mx-auto col-md-5 col-sm-12">
                <button type="submit" class="btn btn-success">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"
                    style="color:white"></i></button>
                <a href="{{ route('cetakjatuhtempo',['tgl_trans1'=>$tgltrs1])}}" class="btn btn-md btn-danger"> Cetak
                  PDF</a>
              </div>
            </div>
          </form>
        </div>
        <div class="card">
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
                <tr>
                  <th>No_Rekening</th>
                  <th>Nama_Nasabah</th>
                  <th>Alamat</th>
                  <th>Tgl_Registrasi</th>
                  <th>Jkw</th>
                  <th>Tgl_jt</th>
                  <th>Suku_bunga</th>
                  <th>Jenis_deposito</th>
                  <th>Jml_deposito</th>
                </tr>
              </thead>
              @if(is_null(Auth::user())==false)
              @if(Auth::user()->privilege=='admin')
              <tbody>
                @foreach($transaksi as $values)
                <tr>
                  <td>{{ $values->NO_REKENING}}</td>
                  <td>{{ $values->nama_nasabah}}</td>
                  <td>{{ $values->alamat}}</td>
                  <td>{{ $values->TGL_REGISTRASI}}</td>
                  <td>{{ $values->JKW}}</td>
                  <td>{{ $values->TGL_JT}}</td>
                  <td>{{ $values->SUKU_BUNGA}}</td>
                  <td>{{ $values->JENIS_DEPOSITO}}</td>
                  <td>{{ number_format($values->nominal,2,",",".")}}</td>
                </tr>
                @endforeach
              </tbody>
              @endif
              @else
              <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @endif

            </table>
          </div>
        </div>
        @endif
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

</div>
<!-- /.content -->
@endsection