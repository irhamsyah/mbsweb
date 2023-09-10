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
          <h3 class="card-title">Blokir Tabungan</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tb_de_simpanblokirtab" role="search">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="mx-auto col-md-5 col-sm-12">
                      <label for="inputDate1">Tanggal Blokir</label>
                      <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="inputtglblokir" class="form-control datetimepicker-input" readonly value="<?php echo(date("Y-m-d")) ?>"/>
                      </div>
    
                    </div>
                  </div>              
                  <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                  <label for="inputDate1">No_Rekening</label>
                  <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="no_rekening" id="inputnorekening" class="form-control datetimepicker-input" readonly/>
                      <div class="input-group-append" data-target="#ambildatataabungan" data-toggle="modal">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                    <label for="inputDate1">Nama Nasabah</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                        <input type="text" name="nama_nasabah" id="inputnamanasabah" class="form-control datetimepicker-input" readonly/>
                    </div>
                  </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                    <label for="inputDate1">Alamat Nasabah</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                        <input type="text" name="alamat" id="inputalamat" class="form-control datetimepicker-input" readonly/>
                    </div>
                  </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                    <label for="inputDate1">Jenis Tabungan</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                        <input type="text" name="jenis_tabungan" id="inputjenistabungan" class="form-control datetimepicker-input" readonly/>
                    </div>
                  </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                    <label for="inputDate1">Saldo Akhir</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                        <input type="text" name="saldo_akhir" id="inputsaldoakhir" class="form-control datetimepicker-input" readonly/>
                    </div>
                  </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                    <label for="inputDate1">Saldo Blokir</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                        <input type="text" name="saldo_blokir" id="inputsaldoblokir" class="form-control datetimepicker-input" readonly/>
                    </div>
                  </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                    <label for="inputDate1">Jumlah Blokir</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                        <input type="text" name="jml_blokir" id="inputjmlsaldoblokir" class="form-control datetimepicker-input" />
                    </div>
                  </div>
              </div>
              <div class="row form-group">
                <div class="col-4" style="margin-left:450px">
                  <button type="submit" class="btn-lg btn-success"><i class="fa fa-check" style="color:white">Simpan</i></button>
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
          {{-- MODAL TAMPIL TABEL TABUNGNAN --}}
          <div class="modal fade bs-modal-nas" id="ambildatataabungan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ambildatataabungan">Data Tabungan</h5>
                  {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> --}}
                </div>
                <div class="modal-body">
                  <table id="datatabunganx" class="display" width="100%">
                    <thead>
                      <tr>
                          <th>No_Rekening</th>
                          <th>Nama Nasabah</th>
                          <th style="display:none">Alamat Nasabah</th>
                          <th>Jenis Tabungan</th>
                          <th>Saldo Akhir</th>
                          <th style="display:none">saldo blokir</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($tabungan as $value)
                        <tr>
                        <td>{{ $value->NO_REKENING }}</td>
                        <td>{{ $value->nama_nasabah }}</td>
                        <td style="display:none">{{ $value->alamat }}</td>
                        <td>{{ $value->JENIS_TABUNGAN }}</td>
                        <td>{{ $value->SALDO_AKHIR }}</td>
                        <td style="display:none">{{ $value->SALDO_BLOKIR }}</td>
                        <td>
                          <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu">
                            <a id="klik" href="#" class="dropdown-item">
                            pilih
                          </a>
                          </div>
        
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        

</div>
<!-- /.content -->
@endsection
