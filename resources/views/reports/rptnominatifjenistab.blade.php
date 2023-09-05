@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
    <h4 style="margin-left:20px">Laporan Nominatif Tabungan Perjenis</h4>
    <div class="row" style="margin-left:20px">{{$deskripsijenis}}</div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tb_rpt_nominatifperjenisview" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Nominatif per Tanggal</label>
                    <div class="input-group date" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="tgl_nominatif" class="form-control datetimepicker-input" value={{$tgl_nom}} data-target="#inputDate1"/>
                      <input hidden name="jenis_tabungan" value="{{$deskripsijenis}}">

                        <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="row form-group">
                <div class="col-1"></div>
                <div class="mx-auto col-md-3 col-sm-12">
                  <button type="submit" class="btn btn-warning">Proses &nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>    
            </div>
            <!-- /.card-body -->
          </form>
          <form method="POST" action="nominatifperjeniseksport" role="search">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" class="form-control datetimepicker-input" value={{$tgl_nom}} data-target="#inputDate1"/>
            <input hidden name="jenis_tabungan" value="{{$deskripsijenis}}">
  <div class="col-3"></div>
            <div class="mx-auto col-md-5 col-sm-12">
              <button type="submit" class="btn btn-warning">Export &nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{ route('cetaknomtabunganperjenis',['tgl_nominatif'=>$tgl_nom,'jenistab'=>$jenistab,'desc'=>$deskripsijenis])}}" class="btn btn-md btn-danger"> Cetak PDF</a>

            </div>
          </div>
        </form>
        </div>
        <div class="card">
          <div class="card-body">
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Rekening</th>
                  <th>Nama Nasabah</th>
                  <th>Alamat</th>
                  <th>Saldo Akhir</th>
                  <th>Tgl Mulai</th>

                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$index}}</td>
                      <td>{{$nominatifs->no_rekening}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{$nominatifs->SALDO_AKHIR}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>

                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  
</div>
<!-- /.content -->
@endsection
