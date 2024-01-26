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
  <h5 style="margin-left: 10px">Jenis DEPOSITO</h5>
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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-jnsdeposito" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Yang Sudah Tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Kode Jenis Deposito</th>
                <th>Deskripsi</th>
                <th>Suku bunga</th>
                <th>PPH</th>
                <th>JKW Default</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($jenisdep as $index => $deposito)

                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($deposito->KODE_JENIS_DEPOSITO) }}</td>
                  <td>{{ $deposito->DESKRIPSI_JENIS_DEPOSITO }}</td>
                  <td>{{ $deposito->SUKU_BUNGA_DEFAULT}}</td>
                  <td>{{ $deposito->PPH_DEFAULT}}</td>
                  <td>{{ $deposito->JKW_DEFAULT}}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-jnsdeposito"
                        data-kode_jenis_deposito="{{ $deposito->KODE_JENIS_DEPOSITO }}"
                        data-deskripsi_jenis_deposito="{{ $deposito->DESKRIPSI_JENIS_DEPOSITO }}"
                        data-suku_bunga_default="{{ $deposito->SUKU_BUNGA_DEFAULT }}"
                        data-pph_default="{{ $deposito->PPH_DEFAULT }}"
                        data-jkw_default="{{ $deposito->JKW_DEFAULT }}"
                        data-flag_deposito="{{ $deposito->FLAG_DEPOSITO }}"
                        data-type_suku_bunga="{{ $deposito->TYPE_SUKU_BUNGA }}"
                        >
                          Detail & Edit
                      </a>
                      <form action="/bo_dp_ad_produkdeposito" method="post"  style="margin-bottom: 0;" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                        <button type="submit" tabindex="-1" class="dropdown-item">
                          Delete
                        </button>
                        <input type="hidden" name="kode_jenis_dep" value="{{ $deposito->KODE_JENIS_DEPOSITO}}" class="form-control">
                        <input type="hidden" name="_method" value="DELETE"/>
                        @csrf
                    </form>
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
  {{-- MODAL EDIT DEPOSITO --}}
  <div class="modal fade" id="modal-edit-jnsdeposito">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <form action="/bo_dp_ad_produkdeposito" id="formeditdeposito" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update Jenis Deposito</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Baris ke 1 EDIT Jenis Deposito ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <label for="einputnasabahid">Kode Jenis Deposito</label>
                    <input type="text" name="kode_jenis_deposito" class="form-control" readonly>                   
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="enorek">Deskripsi</label>
                    <input type="text" name="deskripsi_jenis_deposito" class="form-control" required>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="enorek">Suku Bng Default</label>
                    <input type="text" name="suku_bunga_default" class="form-control"  required>
                </div>
              </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <label for="einputnasabahid">PPH Default</label>
                        <input type="text" name="pph_default" class="form-control">                   
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <label for="einputnasabahid">JKW Default</label>
                        <input type="text" name="jkw_default" class="form-control">                   
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <label for="einputnasabahid">Flag Deposito</label>
                        <select name="flag_deposito" class="form-control" id="idflagdep">
                            <option value="1">Deposito</option>
                            <option value="2">AB-Pasiva</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <label for="einputnasabahid">Type Suku Bng</label>
                        <select name="type_suku_bunga" class="form-control" id="idtypebgdep">
                            <option value="1">BUNGA REGULER</option>
                            <option value="2">BUNGA SBI</option>
                        </select>
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
  </div>   {{-- BATAS MODAL EDIT DEPOSITO --}}
  {{-- MODAL ADD DEPOSITO --}}
  <div class="modal fade" id="modal-add-jnsdeposito">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <form action="/bo_dp_ad_produkdeposito" id="formeditdeposito" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update Jenis Deposito</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--Baris ke 1 ADD Jenis Deposito ----->
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <label for="einputnasabahid">Kode Jenis Deposito</label>
                    <input type="text" name="kode_jenis_deposito" class="form-control" required>                   
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="enorek">Deskripsi</label>
                    <input type="text" name="deskripsi_jenis_deposito" class="form-control"  required>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="enorek">Suku Bng Default</label>
                    <input type="text" name="suku_bunga_default" class="form-control"  required>
                </div>
              </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <label for="einputnasabahid">PPH Default</label>
                        <input type="text" name="pph_default" class="form-control" required>                   
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <label for="einputnasabahid">JKW Default</label>
                        <input type="text" name="jkw_default" class="form-control" required>                   
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <label for="einputnasabahid">Flag Deposito</label>
                        <select name="flag_deposito" class="form-control" id="idflagdep">
                            <option value="1">Deposito</option>
                            <option value="2">AB-Pasiva</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <label for="einputnasabahid">Type Suku Bng</label>
                        <select name="type_suku_bunga" class="form-control" id="idtypebgdep">
                            <option value="1">BUNGA REGULER</option>
                            <option value="2">BUNGA SBI</option>
                        </select>
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
  </div>   {{-- BATAS MODAL ADD DEPOSITO --}}

</div>
<!-- /.content -->
@endsection
