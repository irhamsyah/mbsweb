@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <h5 style="margin-left:10px ">Pencetakan Neraca Konsol</h5>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_ak_carineracakonsol" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Neraca Tanggal</label>
                    <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                      <input type="text" name="tgl_trans" class="form-control datetimepicker-input" data-target="#idtglnominatif1"/>
                        <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
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
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>
<!-- /.content -->
@endsection
