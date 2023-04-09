@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="GET" action="/bo_tb_rpt_nominatifexpress" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-1"></div>
                <div class="mx-auto col-md-3 col-sm-12">
                  <button type="submit" class="btn btn-warning">Home &nbsp;&nbsp;&nbsp;<i class="fa fa-home" style="color:white"></i></button>
                </div>
              </div>    
            </div>
            <!-- /.card-body -->
          </form>
          <form method="POST" action="nominatifexpresseksport/{{$inputantgl}}" role="search">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$inputantgl}} class="form-control datetimepicker-input"/>
            {{-- <input hidden name="rekap" value={{$rekap}} class="form-control datetimepicker-input"/> --}}

            <div class="col-3"></div>
            <div class="mx-auto col-md-5 col-sm-12">
              <button type="submit" class="btn btn-warning">Ekspor Excel&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{ route('cetaknomtabunganexpress',['tgl_nominatif'=>$inputantgl])}}" class="btn btn-md btn-danger"> Cetak Nominatif</a>
            </div>
          </div>
        </form>
        </div>
        <div class="card">
          <div class="card-body">
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>No Rekening</th>
                  <th>Nama Nasabah</th>
                  <th>Saldo Nominatif</th>
                  <th>Jenis Tabungan</th>
                  <th>Tgl terakhir Transaksi</th>
                </tr>
              </thead>
              <tbody>
                  @foreach(array_chunk($nominatif,1) as $values)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->saldo_nominatif}}</td>
                      <td>{{$nominatifs->JENIS_TABUNGAN}}</td>
                      <td>{{$nominatifs->tgl_akhir_trans}}</td>
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
