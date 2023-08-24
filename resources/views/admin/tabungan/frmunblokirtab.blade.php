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
        {{-- <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="GET" action="/bo_tabungan_transaksi_cari" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Tanggal</label>
                    <div class="input-group date" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="tgl_trans" class="form-control datetimepicker-input" data-target="#inputDate1"/>
                        <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-4" style="margin-left:450px">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search" style="color:white">Cari</i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div> --}}
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Bunga Tabungan dan Pajak</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
              <tr>
                <th>No</th>
                <th>No Rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>Jenis Tabungan</th> 
                <th>Saldo Blokir</th>
                <th>Tanggal Blokir</th>
                <th>Action</th>
              </tr>
              </thead>
              @if(is_null(Auth::user())==false)
              @if(Auth::user()->privilege=='admin')
              <tbody>
              @php($index=0)
              @foreach($tabungan as $values)
              @php($index++)
                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ $values->NO_REKENING }}</td>
                  <td>{{ $values->nama_nasabah }}</td>
                  <td>{{ $values->alamat}}</td>
                  <td>{{ $values->DESKRIPSI_JENIS_TABUNGAN}}</td>
                  <td>{{ $values->SALDO_BLOKIR}}</td>
                  <td>{{ $values->TGL_BLOKIR}}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-unblokir"
                      data-no_rekening="{{ $values->NO_REKENING}}"
                      data-nama_nasabah="{{$values->nama_nasabah}}"
                      data-saldo_blokir="{{$values->SALDO_BLOKIR}}"
                      data-tgl_blokir="{{$values->TGL_BLOKIR}}"
                      >
                          Unblokir
                      </a>
                    </div>
                  </td>                
                </tr>
              @endforeach
              </tbody>
              @endif
              @else
                  <h1>Login Expired, Silahkan Login Ulang</h1>
              @endif
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
      {{-- MODAL EDIT/UPDATE DATA tabungan --}}
      <div class="modal fade" id="modal-unblokir">
        <div class="modal-dialog modal-xl">
          <form action="/bo_adm_update_unblokir" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Unblokir Tabungan</h4>
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
                      <label for="inputnasabahid">Saldo Blokir</label>
                      <input type="text" name="saldo_blokir" class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="nasabahid">Tanggal Blokir</label>
                        <input type="text" name="tgl_blokir" class="form-control">
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
s