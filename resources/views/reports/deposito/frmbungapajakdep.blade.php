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
    <h6>Hitung Bunga Deposito per Bulan</h6>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_dp_rp_bungapajakdep" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                  <div class="input-group date" id="inputDate5" data-target-input="nearest">
                    <label for="inputDate1" style="font-size:12pt">Bulan</label>
                    <select name="bulan" id="idbulan" style="font-size:12pt">
                      @if(isset($bulan)==true)
                      <option value="{{$bulanX}}" selected>{{$bulan}}</option>
                      <option value="0331">Maret</option>
                      <option value="0430">April</option>
                      <option value="0531">Mei</option>
                      <option value="0630">Juni</option>
                      <option value="0731">Juli</option>
                      <option value="0831">Agustus</option>
                      <option value="0930">September</option>
                      <option value="1031">Oktober</option>
                      <option value="1130">Nopember</option>
                      <option value="1231">Desember</option>

                      @else
                      <option value="0131">Januari</option>
                      <option value="02{{cal_days_in_month(CAL_GREGORIAN,2,date('Y'))}}">Februari</option>
                      <option value="0331">Maret</option>
                      <option value="0430">April</option>
                      <option value="0531">Mei</option>
                      <option value="0630">Juni</option>
                      <option value="0731">Juli</option>
                      <option value="0831">Agustus</option>
                      <option value="0930">September</option>
                      <option value="1031">Oktober</option>
                      <option value="1130">Nopember</option>
                      <option value="1231">Desember</option>
                      @endif
                    </select>
                    <label for="inputdate2" style="font-size:12pt">Tahun</label>
                    <select name="tahun" id="idtahun" style="font-size:12pt">
                      <option value="{{(date('Y')-1)}}">{{(date('Y')-1)}}</option>
                      <option value="{{date('Y')}}">{{date('Y')}}</option>
                      <option value="{{(date('Y')+1)}}">{{(date('Y')+1)}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-1 col-sm-12">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search"
                      style="color:white">Proses</i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
          {{--AWAL--}}
          @if(isset($transaksi))
          <form method="POST" action="exportbungapajakdep" role="search" style="margin-top:-40px;margin-left:180px">
            @csrf
            <input type="text" name="tgl_trans1" value="{{$tgltrs1}}" hidden>
            <input type="text" name="tgl_trans2" value="{{$tgltrs2}}" hidden>

            <div class="row form-group">
              <div class="mx-auto col-md-5 col-sm-12">
                <button type="submit" class="btn btn-success">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"
                    style="color:white"></i></button>
                <a href="{{ route('cetakbngpjkdeposito',['tgl_trans1'=>$tgltrs1,'tgl_trans2'=>$tgltrs2])}}"
                  class="btn btn-md btn-danger"> Cetak PDF</a>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
                <tr>
                  <th>No_Rekening</th>
                  <th>Nama_Nasabah</th>
                  <th>Jml_Deposito</th>
                  <th>Tgl_registrasi</th>
                  <th>Titipan</th>
                  <th>Bunga</th>
                  <th>Pajak</th>
                </tr>
              </thead>
              @if(is_null(Auth::user())==false)
              @if(Auth::user()->privilege=='admin')
              <tbody>
                @foreach($transaksi as $values)
                <tr>
                  <td>{{ $values->no_rekening}}</td>
                  <td>{{ $values->nama_nasabah}}</td>
                  <td>{{ number_format($values->jml_deposito,2,",",".")}}</td>
                  <td>{{ $values->tgl_registrasi}}</td>
                  <td>{{ $values->titipan}}</td>
                  <td>{{ $values->bunga}}</td>
                  <td>{{ $values->pajak}}</td>
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
        {{--AKHIR--}}
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>
<!-- /.content -->
@endsection