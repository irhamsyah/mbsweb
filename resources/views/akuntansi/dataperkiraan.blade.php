@extends('layouts.admin_main')

@section('content')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          {{-- <form method="POST" action="/bo_cs_de_nelayan/cari" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="idnasabah1">No KTP</label> 
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnasabah1" name="nik" placeholder="Masukkan KTP">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">Nama Nelayan</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah1" name="nama_nelayan" placeholder="Masukkan Nama Nelayan">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-3"></div>
                <div class="col-3">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form> --}}
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-perkiraan" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Perkiraan yang sudah tercatat</h3>        
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example11" class="table table-striped" style="font-size:13px">
              <thead>
              <tr>
                <th>Kode Perkiraan</th>
                <th>Nama Perkiraan </th>
                <th>Perkiraan Induk</th>
                <th>Type</th>
                <th>Debet/Kredit</th>
                <th>Saldo Awal</th>
                <th>Saldo Debet</th>
                <th>Saldo Kredit</th>
                <th>Saldo Akhir</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($perkiraan as $values)
                <tr>
                  <td>{{ $values->kode_perk }}</td>
                  <td>{{ strtoupper($values->nama_perk) }}</td>
                  <td>{{ $values->kode_induk }}</td>
                  <td>{{ $values->type }}</td>
                  <td>{{ $values->dk }}</td>
                  <td>{{ $values->saldo_awal }}</td>
                  <td>{{ $values->saldo_debet }}</td>
                  <td>{{ $values->saldo_kredit }}</td>
                  <td>{{ $values->saldo_akhir }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-perkiraan"
                      data-kode_perk="{{ $values->kode_perk}}"
                      data-nama_perk="{{$values->nama_perk}}"
                      >
                          Update
                      </a>
                      <form action="/bo_ak_de_delperkiraan" method="post" style="margin-bottom: 0;" onclick="return confirm('Apakah anda yakin akan menghapus perkiraan ini?')">
                          <button type="submit" tabindex="-1" class="dropdown-item">
                            Delete
                          </button>
                          <input type="hidden" name="kode_perk" value="{{ $values->kode_perk }}" class="form-control">
                          <input type="hidden" name="kode_induk" value="{{ $values->kode_induk }}" class="form-control">

                          <input type="hidden" name="saldo_akhir" value="{{ $values->saldo_akhir }}" class="form-control">
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
    {{-- MODAL EDIT DATA NELAYAN --}}
    <div class="modal fade" id="modal-edit-perkiraan">
        <div class="modal-dialog modal-xl">
          <form action="/bo_ak_de_updateperkiraan" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Kode Perkiraan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Baris ke 1 EDIT tabungan ----->
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-sm-6">
                      <label for="norek">Kode Perkiraan</label>
                        <input type="text" name="kode_perk" class="form-control" readonly>
                        <input hidden type="text" name="kode_perk_cari" class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="inputopendate">Nama Perkiraan</label>
                      <input type="text" name="nama_perk" class="form-control" id="editidnasabah">
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
  {{-- MODAL UNTUK TAMBAH DATA --}}
  <div class="modal fade bs-modal-perkiraan" id="modal-add-perkiraan">
    <div class="modal-dialog modal-xl">
        <form action="/bo_ak_de_addperkiraan" method="post" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pencatatan Data Perkiraan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!--Baris ke 1 ADD PERKIRAAN ----->
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="addperkiraanid">Sub perkiraan dari</label>
                    <div class="input-group date" data-target-input="nearest">
                      <input type="text" id="addperkiraanid" name="kode_perk_add" class="form-control">
  
                      <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraan">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    <input readonly type="text" id="addperkiraannamelabel" name="nama_perk_label" class="form-control">
                    <input readonly type="text" id="addperkiraaninduk" name="kode_induk_label" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="addkodeperkiraan">Kode Perkiraan</label>
                    <input type="text" id="addkodeperkiraan" name="kode_perk" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="addkodeinduk">Kode Induk</label>
                    <input id="addkodeinduk" type="text" name="kode_induk" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="nasabahid">Nama Perkiraan</label>
                      <input type="text" name="nama_perk" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="nasabahid">Type</label>
                    <input readonly id="addtype" type="text" name="type" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="nasabahid">Debet/Kredit</label>
                    <input readonly id="adddk" type="text" name="dk" class="form-control">
                  </div>

                </div>            
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
          </div>
          <!-- /.modal-content -->
          @csrf
        </form>
      </div>
  </div>   {{-- BATASA MODAL UNTUK MENAMPILKAN TAMBAH DATA --}}

  {{-- MODAL TAMPIL TABEL PERKIRAAN --}}
  <div class="modal fade bs-modal-nas" id="ambildataperkiraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ambildataperkiraan">Data Perkiraan</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
          <table id="perkiraandata" class="display" width="100%">
            <thead>
              <tr>
                  <th>Kode Perk</th>
                  <th>Nama Perkiraan</th>
                  <th>Kode Induk</th>
                  <th>Type</th>
                  <th>Debet/Kredit</th>
                  <th style="display:none;">Kode MAX</th>
                  <th style="display:none;">saldoakhir</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($perkiraan as $value)
                <tr>
                <td>{{ $value->kode_perk }}</td>
                <td>{{ $value->nama_perk }}</td>
                <td>{{ $value->kode_induk }}</td>
                <td>{{ $value->type }}</td>
                <td>{{ $value->dk }}</td>
                <td style="display:none;">{{ $value->kode_perk_d_max}}</td>
                <td style="display:none;">{{ $value->saldo_akhir}}</td>

                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu">
                    <a id="tes1" href="#" class="dropdown-item">
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
