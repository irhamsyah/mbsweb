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
    <h5>Pencatatan Kode Jurnal</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-kodejurnal" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Kode Jurnal yang sudah tercatat</h3>        
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="perkiraandata" class="display" width="100%">
              <thead>
              <tr>
                <th>Kode Jurnal</th>
                <th>Nama Jurnal </th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($kodejur as $values)
                <tr>
                  <td>{{ $values->kode_jurnal }}</td>
                  <td>{{ $values->nama_jurnal }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" style="width: 25%" data-toggle="dropdown" href="#">
                      Action
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-kodejurnal"
                      data-kode_jurnal="{{ $values->kode_jurnal}}"
                      data-nama_jurnal="{{$values->nama_jurnal}}"
                      >
                          Update
                      </a>
                      <form action="/bo_ak_de_delkodejurnaltrans" method="post" style="margin-bottom: 0;" onclick="return confirm('Apakah anda yakin akan menghapus perkiraan ini?')">
                          <button type="submit" tabindex="-1" class="dropdown-item">
                            Delete
                          </button>
                          <input type="hidden" name="kode_jurnal" value="{{ $values->kode_jurnal }}" class="form-control">
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
    <div class="modal fade" id="modal-edit-kodejurnal">
        <div class="modal-dialog modal-xl">
          <form action="/bo_ak_de_updatekodejurnal" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Kode Jurnal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Baris ke 1 EDIT tabungan ----->
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-sm-6">
                      <label for="norek">Kode Jurnal</label>
                        <input type="text" name="kode_jurnal" class="form-control" >
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="inputopendate">Nama Jurnal</label>
                      <input type="text" name="nama_jurnal" class="form-control" id="editidnasabah">
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
  <div class="modal fade bs-modal-perkiraan" id="modal-add-kodejurnal">
    <div class="modal-dialog modal-xl">
        <form action="/bo_ak_de_addkodejurnal" method="post" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pencatatan Kode Jurnal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!--Baris ke 1 ADD PERKIRAAN ----->
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="addkodeperkiraan">Kode Jurnal</label>
                    <input type="text" id="addkodeperkiraan" name="kode_jurnal" class="form-control">
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="addkodeinduk">Nama Jurnal</label>
                    <input id="addkodeinduk" type="text" name="nama_jurnal" class="form-control">
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
</div>
<!-- /.content -->
@endsection
