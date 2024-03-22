@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <h5>Pencetakan Mutasi Bunga Deposito</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="bo_dp_rp_mutasibunga" role="search">
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
                <div class="row form-group" style="margin-top: -10px">
                  <div class="mx-auto col-md-3 col-sm-12">
                    <label for="nasabahid">No_rekening</label>
                  <div class="input-group date" data-target-input="nearest">
                    @if(isset($no_rekening))
                    <input type="text" id="pilihnasabah" name="no_rekening" class="form-control" value="{{$no_rekening}}">
                    @else
                    <input type="text" id="pilihnasabah" name="no_rekening" class="form-control">
                    @endif
                    <div class="input-group-append" data-toggle="modal" data-target="#ambildeposito">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
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
          <form method="POST" action="exporttoexcelmutasibngdep" role="search" style="margin-top:-20px;margin-left:180px">
            @csrf
            <input type="text" name="no_rekening" value="{{$no_rekening}}" hidden>
            <input type="text" name="tgl_trans1" value="{{$tgltrs1}}" hidden>
            <input type="text" name="tgl_trans2" value="{{$tgltrs2}}" hidden>

          <div class="row form-group">
            <div class="mx-auto col-md-5 col-sm-12">
              <button type="submit" class="btn btn-success">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil" style="color:white"></i></button>
              <a href="{{ route('cetakmutasibungadep',['tgl_trans1'=>$tgltrs1,'tgl_trans2'=>$tgltrs2,'no_rekening'=>$no_rekening])}}" class="btn btn-md btn-danger"> Cetak PDF</a>
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
                  <th>Tgl_trans</th>
                  <th>Titipan_awal</th>
                  <th>Saldo_trans</th>
                  <th>Setor</th>
                  <th>Ambil</th>
                </tr>
                </thead>
                @if(is_null(Auth::user())==false)
                @if(Auth::user()->privilege=='admin')
                <tbody>
                @foreach($transaksi as $values)
                  <tr>
                    <td>{{ $values->NO_REKENING}}</td>
                    <td>{{ $values->TGL_TRANS}}</td>
                    <td>{{ $values->TITIPAN_AWAL}}</td>
                    <td>{{ $values->SALDO_TRANS}}</td>
                    <td>{{ $values->setor}}</td>
                    <td>{{ $values->ambil}}</td>
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
  {{-- MODAL TAMPIL TABEL NASABAH --}}
  <div class="modal fade bs-modal-nas" id="ambildeposito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="width:700px">
        <div class="modal-header" >
          <h5 class="modal-title" id="ambildeposito">Data Nasabah</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
          <table id="norekdepos" class="display" width="100%">
            <thead>
              <tr>
                  <th>No_rekening</th>
                  <th>Nama_Nasabah</th>
                  <th>Alamat</th>
                  <th>Jml_deposito</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($nasabah as $value)
                <tr>
                <td>{{ $value->no_rekening }}</td>
                <td>{{ $value->nama_nasabah }}</td>
                <td>{{ $value->alamat }}</td>
                <td>{{ number_format($value->jml_deposito,2,".",",") }}</td>
                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu" data-dismiss="modal">
                    <a id="pil1" href="#" class="dropdown-item">
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
