@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tb_rpt_nominatifview" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Nominatif per Tanggal</label>
                    <div class="input-group date" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="tgl_nominatif" class="form-control datetimepicker-input" value={{$inputantgl}} data-target="#inputDate1"/>
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
          <form method="POST" action="nominatifeksport/{{$inputantgl}}" role="search">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$inputantgl}} class="form-control datetimepicker-input"/>

            <div class="col-3"></div>
            <div class="mx-auto col-md-5 col-sm-12">
              <button type="submit" class="btn btn-warning">Export &nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{ route('cetaknomtabungan',['tgl_nominatif'=>$inputantgl])}}" class="btn btn-md btn-danger"> Cetak PDF</a>

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
                  <th>Saldo Effektif</th>
                  <th>Saldo Nominatif</th>
                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$index}}</td>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->SALDO_EFEKTIF_BLN_INI}}</td>
                      <td>{{$nominatifs->saldo_nominatif}}</td>
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
