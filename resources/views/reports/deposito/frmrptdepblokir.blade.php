@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <h5>Pencetakan Deposito Blokir</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="bo_dp_rp_depositoblokir" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Laporan per Tanggal</label>
                    <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                      <input type="text" name="tgl_trans1" class="form-control datetimepicker-input" value="<?php if(isset($tgltrs)){echo($tgltrs);} ?>" data-target="#idtglnominatif1"/>
                        <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                 </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="row form-group" style="margin-top: -20px">
              <div class="col-1"></div>
              <div class="mx-auto col-md-3 col-sm-12">
                <button type="submit" class="btn btn-warning" style="margin-left:40px ">Proses &nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              </div>
            </div>    
          </form>
          {{-- TAMPILKAN TOMBOL CETAK DAN EXPROT --}}
          @if(isset($blokirdep))
          <form method="POST" action="exportdepositoblokir" role="search" style="margin-top:-20px;margin-left:180px">
            @csrf
            <input type="text" name="tgl_trans1" value="{{$tgltrs}}" hidden>
          <div class="row form-group">
            <div class="mx-auto col-md-5 col-sm-12">
              <button type="submit" class="btn btn-success">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil" style="color:white"></i></button>
              <a href="{{ route('cetakdepositoblokir',['tgl_trans1'=>$tgltrs])}}" class="btn btn-md btn-danger"> Cetak PDF</a>
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
                  <th>Nama_nasabah</th>
                  <th>Alamat</th>
                  <th>Jml_deposito</th>
                  <th>Tgl_registrasi</th>
                  <th>Tgl_jt</th>
                  <th>Tgl_blokir</th>
                </tr>
                </thead>
                @if(is_null(Auth::user())==false)
                @if(Auth::user()->privilege=='admin')
                <tbody>
                @foreach($blokirdep as $values)
                  <tr>
                    <td>{{ $values->NO_REKENING}}</td>
                    <td>{{ $values->nama_nasabah}}</td>
                    <td>{{ $values->alamat}}</td>
                    <td>{{ $values->jml_deposito}}</td>
                    <td>{{ $values->TGL_REGISTRASI}}</td>
                    <td>{{ $values->TGL_JT}}</td>
                    <td>{{ $values->TGL_BLOKIR}}</td>
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
        {{-- AKHIR TAMPILIN TOMBOL CETAK --}}
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  
</div>
<!-- /.content -->
@endsection
