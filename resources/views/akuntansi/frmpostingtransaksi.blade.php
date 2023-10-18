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
    <h5 style="margin-left: 10px">Form Posting Validasi </h5>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_ak_tr_postingtransaksi" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Tanggal Awal</label>
                    <div class="input-group date" id="inputDate5" data-target-input="nearest">
                      <input type="text" name="tgl_awal" class="form-control datetimepicker-input" data-target="#inputDate5"/>
                        <div class="input-group-append" data-target="#inputDate5" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Tanggal Akhir</label>
                    <div class="input-group date" id="idtglnominatif" data-target-input="nearest">
                      <input type="text" name="tgl_akhir" class="form-control datetimepicker-input" data-target="#idtglnominatif"/>
                        <div class="input-group-append" data-target="#idtglnominatif" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-4" style="margin-left:450px">
                  <button type="submit" class="btn btn-lg btn-warning"><i class="fa fa-search" style="color:white">Proses</i></button>
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
