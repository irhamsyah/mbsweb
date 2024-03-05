@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <h5>Pencetakan OB Bunga Ke Titipan</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="bo_dp_rp_obbungaketitipan" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Mulai Tanggal</label>
                    <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                      <input type="text" name="tgl_trans1" class="form-control datetimepicker-input" value="<?php if(isset($tgltrs1)){echo($tgltrs1);} ?>" data-target="#idtglnominatif1"/>
                        <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <label for="inputDate1">Sampai Tanggal</label>
                    <div class="input-group date" id="idtglnominatif2" data-target-input="nearest">
                        <input type="text" name="tgl_trans2" class="form-control datetimepicker-input" value="<?php if(isset($tgltrs2)){echo($tgltrs2);} ?>" data-target="#idtglnominatif2"/>
                          <div class="input-group-append" data-target="#idtglnominatif2" data-toggle="datetimepicker">
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
          @if(isset($transaksi))
          <form method="POST" action="exportobbngtotitipan" role="search" style="margin-top:-20px;margin-left:180px">
            @csrf
            <input type="text" name="tgl_trans1" value="{{$tgltrs1}}" hidden>
            <input type="text" name="tgl_trans2" value="{{$tgltrs2}}" hidden>

          <div class="row form-group">
            <div class="mx-auto col-md-5 col-sm-12">
              <button type="submit" class="btn btn-success">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil" style="color:white"></i></button>
              <a href="{{ route('cetakobbungaketitipan',['tgl_trans1'=>$tgltrs1,'tgl_trans2'=>$tgltrs2])}}" class="btn btn-md btn-danger"> Cetak PDF</a>
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
                  <th>Tgl_Trans</th>
                  <th>Kode_Trans</th>
                  <th>OB_Bunga</th>
                  <th>OB_Pajak</th>
                </tr>
                </thead>
                @if(is_null(Auth::user())==false)
                @if(Auth::user()->privilege=='admin')
                <tbody>
                @foreach($transaksi as $values)
                  <tr>
                    <td>{{ $values->no_rekening}}</td>
                    <td>{{ $values->nama_nasabah}}</td>
                    <td>{{ $values->TGL_TRANS}}</td>
                    <td>{{ $values->kode_trans}}</td>
                    <td>{{ $values->ob_bunga}}</td>
                    <td>{{ $values->ob_pajak}}</td>
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
