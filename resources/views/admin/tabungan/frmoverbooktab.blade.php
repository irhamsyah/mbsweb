@extends('layouts.admin_main')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

@section('content')
@if($msgstatus!=''){
  @if($msgstatus=='1'){
    @php $statusmsg='success'; $titlemsg='Successfully'; $msgview='Proses Berhasil' @endphp;
  }
  @else{
    @php $statusmsg='error'; $titlemsg='Error!'; $msgview='Proses Gagal!' @endphp;
  }
  @endif
    
  <script>
    Swal.fire(
      '{{ $titlemsg }}',
      '{{ $msgview }}',
      '{{ $statusmsg }}'
    )
  </script>
}
@endif

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card-header">
          <h3 class="card-title">Option Overboooking Tabungan</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="GET" action="/bo_tab_overbook" role="search">
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                  <label for="inputDate1">Tanggal Overbook</label>
                  <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="inputtgloverbook" class="form-control datetimepicker-input" data-target="#inputDate1"/>
                      <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>

                </div>
              </div>
              <div class="row form-group">
                  <div class="mx-auto col-md-5 col-sm-12">
                    <label>Kode Transaksi Bunga</label>
                    <select name="kode_trans_bunga" class="form-control">
                      {{-- <option id="idSelect" selected></option> --}}
                      @foreach($kodetranstab as $values)
                        @if($values->DESKRIPSI_TRANS=="Bunga")
                        <option value="{{$values->KODE_TRANS}}" selected>{{$values->KODE_TRANS}}|{{$values->DESKRIPSI_TRANS}}</option>
                        @else
                        <option value="{{$values->KODE_TRANS}}">{{$values->KODE_TRANS}}|{{$values->DESKRIPSI_TRANS}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                  <label>Kode Transaksi Pajak</label>
                  <select name="kode_trans_pajak" class="form-control">
                    {{-- <option id="idSelect" selected></option> --}}
                    @foreach($kodetranstab as $values)
                      @if($values->DESKRIPSI_TRANS=="Pajak")
                      <option value="{{$values->KODE_TRANS}}" selected>{{$values->KODE_TRANS}}|{{$values->DESKRIPSI_TRANS}}</option>
                      @else
                      <option value="{{$values->KODE_TRANS}}">{{$values->KODE_TRANS}}|{{$values->DESKRIPSI_TRANS}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                  <label>Kode Transaksi Adm</label>
                  <select name="kode_trans_adm" class="form-control">
                    {{-- <option id="idSelect" selected></option> --}}
                    @foreach($kodetranstab as $values)
                      @if($values->DESKRIPSI_TRANS=="Adm")
                      <option value="{{$values->KODE_TRANS}}" selected>{{$values->KODE_TRANS}}|{{$values->DESKRIPSI_TRANS}}</option>
                      @else
                      <option value="{{$values->KODE_TRANS}}">{{$values->KODE_TRANS}}|{{$values->DESKRIPSI_TRANS}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
            </div>
              <div class="row form-group">
              <div class="mx-auto col-md-5 col-sm-12">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Koreksi Overbook
                </label>
          
              </div>
              </div>

              <div class="row form-group">
                <div class="col-4" style="margin-left:450px">
                  <button type="submit" class="btn-lg btn-success"><i class="fa fa-check" style="color:white">Proses</i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->
        <div class="card">
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
      {{-- MODAL EDIT/UPDATE DATA tabungan --}}
      <div class="modal fade" id="modal-update-bungpajaktab">
        <div class="modal-dialog modal-xl">
          <form action="/bo_adm_update_bngpjk" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Bunga dan pajak</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Baris ke 1 EDIT kodetrans ----->
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-sm-6">
                      <label for="norek">No Rekening</label>
                        <input readonly type="text" name="no_rekening" class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="inputopendate">Nama Nasabah</label>
                      <input type="text" name="nama_nasabah" class="form-control" id="editidnasabah">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="inputnasabahid">Bunga Bulan Ini</label>
                      <input type="text" name="bunga_bln_ini" class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="nasabahid">Pajak Bukan ini</label>
                        <input type="text" name="pajak_bln_ini" class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="nasabahid">Admin Bukan ini</label>
                        <input type="text" name="adm_bln_ini" class="form-control">
                    </div>
                  </div>            
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
            <!-- /.modal-content -->
            @csrf
          </form>
        </div>
        <!-- /.modal-dialog -->
    </div>        

</div>
<!-- /.content -->
@endsection
