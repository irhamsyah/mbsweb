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
  <h5 style="margin-left: 10px">Perpanjangan Deposito Manual</h5>
  @if($errors->any())
  @foreach($errors->all() as $error)
  <div class="alert alert-danger" role="alert">
    {{$error}}
  </div>
  @endforeach
  @endif

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#modal-add-jnsdeposito" style="float: right;">
                <i class="fa fa-plus"></i>
              </button> --}}
            </div>
            <h3 class="card-title">Data Yang Sudah Tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No.Rekening</th>
                  <th>Nama Nasabah</th>
                  <th>JKW</th>
                  <th>Tgl_Registrasi</th>
                  <th>Tgl_JT</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($deposito as $index => $deposito)

                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($deposito->NO_REKENING) }}</td>
                  <td>{{ $deposito->nama_nasabah }}</td>
                  <td>{{ $deposito->JKW}}</td>
                  <td>{{ $deposito->TGL_REGISTRASI}}</td>
                  <td>{{ $deposito->TGL_JT}}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal"
                        data-target="#modal-update-rollover" data-no_rekening="{{ $deposito->NO_REKENING }}"
                        data-nama_nasabah="{{ $deposito->nama_nasabah }}" data-alamat="{{ $deposito->alamat }}"
                        data-jml_deposito="{{ $deposito->JML_DEPOSITO }}" data-jkw="{{ $deposito->JKW }}"
                        data-suku_bunga="{{ $deposito->SUKU_BUNGA }}" data-persen_pph="{{ $deposito->PERSEN_PPH }}"
                        data-tgl_registrasi="{{ $deposito->TGL_REGISTRASI }}" data-tgl_jt="{{ $deposito->TGL_JT }}">
                        Detail & Edit
                      </a>
                    </div>

                  </td>
                </tr>
                @endforeach
              </tbody>
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
  {{-- MODAL UPDATE ROLLOVER --}}
  <div class="modal fade" id="modal-update-rollover">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <form action="/bo_dp_de_manrollover" id="formeditdeposito" method="POST" enctype="multipart/form-data"
        onmouseover="myTime();">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Perpanjangan Manual Deposito (Cukup Klik Update)</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Baris ke 1 Manual Rolll Over ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">No.Rekening</label>
                  <input type="text" name="no_rekening" class="form-control" readonly>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="enorek">Nama Nasabah</label>
                  <input readonly type="text" name="nama_nasabah" class="form-control" required>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="enorek">Alamat</label>
                  <input type="text" name="alamat" class="form-control" readonly required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">Jumlah Deposito</label>
                  <input type="text" readonly name="jml_deposito" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">Jangka Waktu</label>
                  <input readonly type="text" name="jkw" class="form-control" id="addjkw" required>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">Suku Bunga</label>
                  <input readonly type="text" name="suku_bunga" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">Persen PPH</label>
                  <input readonly type="text" name="persen_pph" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">Tgl Registrasi</label>
                  <input readonly type="text" name="tgl_registrasi" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">Tgl JT</label>
                  <input readonly type="text" name="tgl_jt" class="form-control">
                </div>

                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">Tgl Registrasi Baru</label>
                  <input type="text" name="tgl_registrasi_baru" class="form-control" id="etgl_registrasidepo" readonly>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <label for="einputnasabahid">Tgl JT Baru</label>
                  <input type="text" name="tgl_jt_baru" class="form-control" id="addtgl_jt" readonly>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="_method" value="put" />

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
  </div> {{-- BATAS MODAL UPDATE MANUAL ROLL OVER --}}
</div>
<!-- /.content -->
@endsection