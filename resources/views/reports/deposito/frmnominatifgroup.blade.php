@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <h5>Nominatif Group</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_dp_rp_nominatifgroup" role="search" style="margin-bottom: -10px">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Nominatif per Tanggal</label>
                    <div class="input-group date" id="inputDate1" data-target-input="nearest">
                      @if(isset($tgl_input))
                      <input type="text" name="tgl_nominatif" class="form-control datetimepicker-input" value={{$tgl_input}} data-target="#inputDate1"/>
                      @else
                      <input type="text" name="tgl_nominatif" class="form-control datetimepicker-input" value={{$tgllogin}} data-target="#inputDate1"/>
                      @endif
                        <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar" onclick="nonAktif()"></i></div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="row form-group">
                <div class="col-1"></div>
                <div class="mx-auto col-md-2 col-sm-12">
                  <button type="submit" class="btn btn-warning">Proses &nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>    
            </div>
            <!-- /.card-body -->
          </form>
          @if(isset($nominatif))
          <form method="POST" action="nominatifdepgroupeksport" role="search" style="margin-top: -5px;margin-left:35px">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$tgl_input}} class="form-control datetimepicker-input"/>
            {{-- <div class="col-3"></div> --}}
            @if(isset($tgl_input))
            <div class="mx-auto col-md-4 col-sm-12">
              <button id="but1" type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{route('cetaknomingroupdep',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF</a>
              <a href="{{route('cetaknomingroupdep2',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF 2</a>
            </div>
            @endif
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
                  <th>Jumlah Deposito</th>
                  <th>Bunga</th>
                  <th>Pajak</th>
                  <th>Jangka Waktu</th>
                  <th>Tgl Registrasi</th>
                  <th>Tgl Jt Tempo</th>
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
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{number_format( $nominatifs->NOMINAL,2,".",",")}}</td>
                      <td>{{number_format($nominatifs->JML_BUNGA,2,".",",")}}</td>
                      <td>{{number_format($nominatifs->JML_PAJAK,2,".",",")}}</td>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>
                      <td>{{$nominatifs->TGL_JT}}</td>
                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
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
