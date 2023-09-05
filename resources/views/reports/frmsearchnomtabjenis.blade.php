@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <h4 style="margin-left:20px">Laporan Nominatif Tabungan Perjenis</h4>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tb_rpt_nominatifperjenisview" role="search">
          @csrf
            <div class="card-body">
              <div class="form-group-list">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate13">Nominatif per Tanggal</label>
                    <div class="input-group date" id="inputDate13" data-target-input="nearest">
                      <input type="text" name="tgl_nominatif" class="form-control datetimepicker-input" data-target="#inputDate13"/>
                        <div class="input-group-append" data-target="#inputDate13" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="form-group-list">
                <div style="left: 370px" class="max-auto col-md-3 col-sm-12">
                  <label for="optiojenis">Berdasarkan Tabungan</label>
                  <select name="jenis_tabungan" id="idjenistab" class="form-control">
                      <option selected></option>
                      @foreach($kodejenis as $value)
                      <option value="{{$value->KODE_JENIS_TABUNGAN."-".$value->DESKRIPSI_JENIS_TABUNGAN}}">{{$value->KODE_JENIS_TABUNGAN}}-{{$value->DESKRIPSI_JENIS_TABUNGAN}}</option>
                      @endforeach

                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-1"></div>
                <div style="margin-top:10px;" class="mx-auto col-md-3 col-sm-12">
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
