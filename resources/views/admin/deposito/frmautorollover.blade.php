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
    <h6>Form ARO Deposito</h6>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_dp_de_autorollover" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group" style="width: 10%;margin-left:450px" >

                <label for="tgl">Tanggal</label>
                <input type="text" class="form-control" name="tgl_trans" readonly value="{{$tgllogin}}">
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
