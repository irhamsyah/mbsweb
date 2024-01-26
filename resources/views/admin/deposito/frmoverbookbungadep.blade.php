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
    <h6>Overbook Bunga Deposito</h6>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_dp_de_overbookbngdep" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group" style="width: 10%;margin-left:300px" >
                <label for="tgl">Tanggal</label>
                <input type="text" class="form-control" name="tgl_trans" readonly value="{{$tgllogin}}">
              </div>
              <div class="row form-group" style="width: 50%;margin-left:300px;margin-bottom:0px" >
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Overbook Bunga Yg Belum Jatuh Tempo</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" name="yatidak">
                    <option value="Tidak">Tidak</option>
                    <option value="Ya">Ya</option>
                  </select>
                </div>
              </div>
              <div class="row form-group" style="width: 50%;margin-left:300px;margin-bottom:0px" >
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Kode Trans.Deposito</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" name="kode_trs_titipan">
                    @foreach($kodetransdep as $values)
                      @if($values->KODE_TRANS=='005')
                        <option value="{{$values->KODE_TRANS.$values->TOB}}" selected>{{$values->KODE_TRANS."-".$values->DESKRIPSI_TRANS}}</option>
                      @else
                      <option value="{{$values->KODE_TRANS.$values->TOB}}">{{$values->KODE_TRANS."-".$values->DESKRIPSI_TRANS}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group" style="width: 50%;margin-left:300px;margin-bottom:0px" >
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Kode Trans.ARO Dep(Masuk Pokok)</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" name="kode_trs_aro">
                    @foreach($kodetransdep as $values)
                      @if($values->KODE_TRANS=='009')
                    <option value="{{$values->KODE_TRANS.$values->TOB}}" selected>{{$values->KODE_TRANS."-".$values->DESKRIPSI_TRANS}}</option>
                      @else
                      <option value="{{$values->KODE_TRANS.$values->TOB}}">{{$values->KODE_TRANS."-".$values->DESKRIPSI_TRANS}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>              
              <div class="row form-group" style="width: 50%;margin-left:300px;margin-bottom:0px" >
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Kode Trans.Tabungan</label>
                  </div>
                  <select class="custom-select" id="inputGroupSelect01" name="kode_trs_tab">
                    @foreach($kodetranstab as $values)
                      @if($values->KODE_TRANS=='33')
                    <option value="{{$values->KODE_TRANS.$values->TOB}}" selected>{{$values->KODE_TRANS."-".$values->DESKRIPSI_TRANS}}</option>
                      @else
                      <option value="{{$values->KODE_TRANS.$values->TOB}}">{{$values->KODE_TRANS."-".$values->DESKRIPSI_TRANS}}</option>
                      @endif
                    @endforeach
                  </select>
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
