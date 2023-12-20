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
  <h3 style="margin-left:20px">Laporan Jurnal Transaksi</h3>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_ak_lp_carijurnal" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                  <label for="inputDate1">Dari Tanggal</label>
                  <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                    <input type="text" name="tgl_trans1" class="form-control datetimepicker-input" data-target="#idtglnominatif1"/>
                      <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                      <div class="input-group-text">
                          <i class="fa fa-calendar"></i>
                      </div>
                      </div>
                  </div>
                </div>
                <div class="mx-auto col-md-3 col-sm-12">
                  <label for="inputDate1">hingga Tanggal</label>
                  <div class="input-group date" id="idtglnominatif2" data-target-input="nearest">
                    <input type="text" name="tgl_trans2" class="form-control datetimepicker-input" data-target="#idtglnominatif2"/>
                      <div class="input-group-append" data-target="#idtglnominatif2" data-toggle="datetimepicker">
                      <div class="input-group-text">
                          <i class="fa fa-calendar"></i>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-4" style="margin-left:450px">
                  <button type="submit" class="btn btn-lg btn-warning"><i class="fa fa-search" style="color:white">Cari</i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Jurnal Transaksi</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if(isset($jurnal))
            <table id="example1" class="display" width="100">
              <thead>
              <tr>
                <th>No</th>
                <th>Trans_id</th>
                <th>Tgl_trans</th>
                <th>Kode_jurnal</th>
                <th>No_bukti</th>
                <th>Nama_perk</th>
                <th>Uraian</th>
                <th>Debet</th>
                <th>Kredit</th>
              </tr>
              </thead>
              @if(is_null(Auth::user())==false)
              <tbody>
              @php($index=0)
              @foreach($jurnal as $values)
              @php($index++)
                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ $values->trans_id }}</td>
                  <td>{{ $values->tgl_trans }}</td>
                  <td>{{ $values->kode_jurnal}}</td>
                  <td>{{ $values->no_bukti}}</td>
                  <td>{{ $values->nama_perk}}</td>
                  <td>{{ $values->URAIAN}}</td>
                  <td>{{ $values->debet}}</td>
                  <td>{{ $values->kredit}}</td>
                </tr>
              @endforeach
              </tbody>
              @else
              <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @endif

            </table>
            @endif
          </div>
          <div class="card-body">
            <div class="form-group">
                <form method="post" action="bo_ak_lp_cetakjurnal">
                    @csrf
                    <button class="btn btn-danger" style="float:right">Cetak</button>
                    @if(isset($jurnal))
                      <input type="text" hidden name="tgl_trans1" value="{{$tgl_trans1}}">
                      <input type="text" hidden name="tgl_trans2" value="{{$tgl_trans2}}">
                      <a href="{{route('exportjurnaltransaksi',['tgl_trans1'=>$tgl_trans1,'tgl_trans2'=>$tgl_trans2])}}" class="btn btn-primary" style="float: right;margin-right:10px">Export</a>
                    @else
                    <a href="#" class="btn btn-primary" style="float: right;margin-right:10px">Export</a>
                    @endif

                </form>
            </div>
          </div>

        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  
</div>
<!-- /.content -->
@endsection
