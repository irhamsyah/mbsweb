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
          <h3 class="card-title">Setoran & Penarikan Tabungan</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_tl_tt_simpantrstabungan" role="search">
            @csrf
            <div class="card-body">
                  <div class="form-group">
                    <div class="col-lg-2 col-sm-8">
                      <label for="inputDate1">Tanggal Transaksi</label>
                      <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="tgl_trans" class="form-control datetimepicker-input" readonly value="<?php echo(date("Y-m-d")) ?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <label for="nasabahid">No Rekening</label>
                        <div class="input-group date" data-target-input="nearest">
                          <input id="putnorekening" type="text" name="no_rekening" readonly class="form-control" required>

                          <div class="input-group-append" data-toggle="modal" data-target="#ambildatatabungan">
                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                        </div>
                        </div>
                      </div>                      
                      <div class="col-lg-3 col-sm-6">
                        <label for="inputopendate">Nama Nasabah</label>
                        <input readonly id="putnamanasabah" type="text" name="nama_nasabah" class="form-control">
                      </div>
                      <div class="col-lg-3 col-sm-6">
                          <label for="inputnasabahid">Alamat</label>
                          <input type="text" id="putalamat" name="alamat" readonly class="form-control" >
                      </div>
                      <div class="col-lg-2 col-sm-8">
                        <label for="inputnocif">Jenis Tabungan</label>
                        <input type="text" id="putjenistab" name="jenis_tabungan" readonly class="form-control">
                      </div>
                      <div class="col-lg-2 col-sm-8">
                        <label for="putsaldoakhir">Saldo Blokr</label>
                        <input type="text" id="putsaldoblokir" name="saldo_akhir" readonly class="form-control" required>
                      </div>
                      <div class="row-lg-2 col-sm-5">
                        <label for="putsaldoakhir">Saldo Akhir</label>
                        <input type="text" id="putsaldoakhir" name="saldo_blokir" readonly class="form-control" required>
                      </div>
                    </div>
                  </div>            
                    <div class="form-group">
                      <div class="row">
                      <div class="col-lg-2 col-sm-8">
                        <label for="inputnocif">Kuitansi</label>
                        <input type="text" name="kuitansi" class="form-control" id="bunga" required>
                      </div>
                      <div class="col-lg-2 col-sm-8">
                        <label for="inputnocif">Kode Transaksi</label>
                        <select class="form-control" name="kode_trans" id="putkodetrans">
                          @php($i=0)
                          @while ($i<count($kodetranstab) )
                          <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                              @php($i++)
                          @endwhile
                        </select>
                      </div>
                      <input hidden type="text" name="cab" value={{$kodecabang[0]->kode_cab}}>
                      <div class="col-md-5 col-sm-12">
                        <label for="inputDate1">Jumlah</label>
                        <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                            <input type="text" name="pembayaran" id="inputjmlsaldoblokir" class="form-control datetimepicker-input" />
                        </div>
                      </div>
                      <div class="col-lg-2 col-sm-8">
                        <label for="inputnocif">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="bunga" required>
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
          <div class="modal fade bs-modal-nas" id="ambildatatabungan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ambildatatabungan">Data Tabungan</h5>
                </div>
                <div class="modal-body">
                  <table id="datatabungan" class="display" width="100%">
                    <thead>
                      <tr>
                          <th>No_Rekening</th>
                          <th>Nama Nasabah</th>
                          <th style="display:none">Alamat Nasabah</th>
                          <th style="display:none">Jenis Tabungan</th>

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
                        <td style="display:none">{{ $value->alamat}}</td>
                        <td style="display:none">{{ $value->JENIS_TABUNGAN}}</td>
                        <td>{{ $value->saldo_akhir }}</td>
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
