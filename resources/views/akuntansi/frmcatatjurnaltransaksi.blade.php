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
          <h3 class="card-title">Pencatatan Jurnal Transaksi</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tb_de_simpanjurnalmemorial" role="search">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <label for="inputDate1">Tanggal</label>
                            <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                <input type="text" name="inputtgljurnal" class="form-control datetimepicker-input" readonly value="<?php echo(date("Y-m-d")) ?>"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="ref">#Ref</label>
                            <input type="text" class="form-control" name="no_bukti">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="kodejurnal">Kode Jurnal</label>
                            <select class="form-control" name="kode_jurnal" id="">
                                @foreach($kodejurnal as $kode)
                                <option value="{{$kode->kode_jurnal}}">{{$kode->nama_jurnal}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <label for="nasabahid">Kode Perkiraan</label>
                            <div class="input-group date" data-target-input="nearest">
                              <input id="idKodePerkadd" type="text" name="kode_perk" readonly class="form-control" required>
                                <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraan">
                                    <div class="input-group-text"><i class="fa fa-book"></i></div>
                                </div>
  
                            </div>
                                <input type="text" name="nama_perk" id="idNamaPerkadd" readonly>

                        </div>
                        <div class="col-lg-2 col-sm-8">
                            <label for="inputnocif">Debet</label>
                            <input type="number" id="inputNamaNasabahadd" name="debet" class="form-control" value=0 required>
                        </div>
                        <div class="col-lg-2 col-sm-8">
                            <label for="inputnocif">Kredit</label>
                            <input type="number" id="inputalamatadd" name="kredit" class="form-control" value=0 required>
                        </div>
                        <div class="col-lg-2 col-sm-8">
                            <label for="inputnocif">Keterangan</label>
                            <textarea name="keterangan" id="ket" cols="40" rows="5"></textarea>
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
                <table>
                    <thead>
                        <tr>
                            <th>Kode Perkiraan</th>
                            <th>Nama Perkiraan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Uraian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    </tbody>
                </table>
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
          <div class="modal fade" id="ambildataperkiraan" tabindex="-1" role="dialog" aria-labelledby="ambildataperkiraanTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ambildataperkiraan">Data Perkiraan</h5>
                  {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> --}}
                </div>
                <div class="modal-body">
                  <table id="idperkiraanxx" class="display" width="100%">
                    <thead>
                      <tr>
                          <th>Kode_perk</th>
                          <th>Nama_Perk</th>
                          <th>kode_induk</th>
                          <th>Level</th>
                          <th>Type</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($perkiraan as $value)
                        <tr>
                        <td>{{ $value->kode_perk }}</td>
                        <td>{{ $value->nama_perk }}</td>
                        <td>{{ $value->kode_induk }}</td>
                        <td>{{ $value->level }}</td>
                        <td>{{ $value->type }}</td>
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
