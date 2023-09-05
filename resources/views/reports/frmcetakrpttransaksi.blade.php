@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tb_rpt_caritransaksi" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Tanggal 1</label>
                    <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                      <input type="text" name="tgl_trans1" value={{$inputantgl1}} class="form-control datetimepicker-input" data-target="#idtglnominatif1"/>
                        <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <label for="inputDate1">Tanggal 2</label>
                    <div class="input-group date" id="idtglnominatif2" data-target-input="nearest">
                        <input type="text" name="tgl_trans2" value={{$inputantgl2}} class="form-control datetimepicker-input" data-target="#idtglnominatif2"/>
                          <div class="input-group-append" data-target="#idtglnominatif2" data-toggle="datetimepicker">
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
          <form method="POST" action="{{route('exporttoexceltransaksitab',['tgl_transx1'=>$inputantgl1,'tgl_transx2'=>$inputantgl2])}}" role="search">
            @csrf
          <div class="row form-group">
            <div class="col-3"></div>
            <div class="mx-auto col-md-5 col-sm-12">
              <button type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{ route('cetaktransaksitabungan',['tgl_trans1'=>$inputantgl1,'tgl_trans2'=>$inputantgl2])}}" class="btn btn-md btn-danger"> Cetak PDF</a>

            </div>
          </div>
        </form>
        </div>
        <div class="card">
          <div class="card-body">
            <table id="example1" class="display" width="100">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Trans_id</th>
                  <th>Kuitansi</th>
                  <th>TOB</th>
                  <th>No Rekening</th>
                  <th>Nama Nasabah</th>
                  <th>Jumlah</th>
                  <th>Kode Transaksi</th>
                  <th>My Kode Trans</th>
                </tr>
                </thead>
                @if(is_null(Auth::user())==false)
                @if(Auth::user()->privilege=='admin')
                <tbody>
                @php($index=0)
                @foreach($nominatif as $values)
                @php($index++)
                  <tr>
                    <td>{{ $index}}</td>
                    <td>{{ strtoupper($values->TABTRANS_ID) }}</td>
                    <td>{{ $values->KUITANSI }}</td>
                    <td>{{ $values->TOB}}</td>
                    <td>{{ $values->NO_REKENING}}</td>
                    <td>{{ $values->nasabah[0]->nama_nasabah}}</td>
                    <td>{{ number_format($values->SALDO_TRANS)}}</td>
                    <td>{{ $values->KODE_TRANS}}</td>
                    <td>{{ $values->MY_KODE_TRANS}}</td>
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
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  
</div>
<!-- /.content -->
@endsection
