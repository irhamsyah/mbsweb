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
          <form method="POST" action="/bo_tb_de_hitungbungadep" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <div class="input-group date" id="inputDate5" data-target-input="nearest">
                      <label for="inputDate1">Bulan</label>
                      <select name="bulan" id="idbulan">
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
                      </select>
                      <label for="inputdate2">Tahun</label>
                      <select name="tahun" id="idtahun">
                        <option value="{{(date('Y')-1)}}">{{(date('Y')-1)}}</option>
                        <option value="{{date('Y')}}">{{date('Y')}}</option>
                        <option value="{{(date('Y')+1)}}">{{(date('Y')+1)}}</option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-4" style="margin-left:450px">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search" style="color:white">Proses</i></button>
                </div>  
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  
</div>
<!-- /.content -->
@endsection
