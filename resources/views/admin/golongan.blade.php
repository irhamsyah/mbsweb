@extends('layouts.admin_main')

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
        <!-- /.card -->
        <div class="card w-100">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-golongan" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Golongan Debitur</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Kode Golongan</th>
                <th>Deskripsi Golongan</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($hubunganbanks as $index => $hubunganbank)
                <tr>
                  <td>{{ $hubunganbank->KODE_HUBUNGAN }}</td>
                  <td>{{ $hubunganbank->DESKRIPSI_HUBUNGAN }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-golongan_{{ md5($hubunganbank->KODE_HUBUNGAN.'Bast90') }}">
                          Detail & Edit
                      </a>
                      <form action="/bo_cs_ad_golongan" method="post"  style="margin-bottom: 0;" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                          <button type="submit" tabindex="-1" class="dropdown-item">
                            Delete
                          </button>
                          <input type="hidden" name="inputIdgoldel" value="{{ $hubunganbank->KODE_HUBUNGAN }}" class="form-control">
                          <input type="hidden" name="inputIdgoldelhash" value="{{ md5($hubunganbank->KODE_HUBUNGAN.'Bast90') }}" class="form-control">
                          <input type="hidden" name="_method" value="DELETE"/>
                          @csrf
                      </form>
                    </div>
                  </td>
                </tr>
                <div class="modal fade" id="modal-edit-golongan_{{ md5($hubunganbank->KODE_HUBUNGAN.'Bast90') }}">
                  <div class="modal-dialog modal-md">
                    <form action="/bo_cs_ad_golongan" method="post" enctype="multipart/form-data">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data Hubungan Debitur</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- Custom Tabs -->
                          <div class="card">
                            <div class="card-header d-flex p-0">
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12">
                                        <label for="inputidgoledit">Kode Golongan</label>
                                        <input type="text" name="inputidgoledit" value="{{ $hubunganbank->KODE_HUBUNGAN }}" readonly class="form-control">
                                        <input type="hidden" name="inputIdgoledithash" value="{{ md5($hubunganbank->KODE_HUBUNGAN.'Bast90') }}" class="form-control">
                                        </div>
                                        <div class="col-lg-8 col-sm-12">
                                        <label for="inputdescgoledit">Deskripsi Golongan Debitur</label>
                                        <input type="text" name="inputdescgoledit" value="{{ $hubunganbank->DESKRIPSI_HUBUNGAN }}" class="form-control">
                                        <input type="hidden" name="_method" value="PUT"/>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                          </div>
                          <!-- ./card -->
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
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>Kode Golongan</th>
                <th>Deskripsi Golongan</th>
                <th>Action</th>
              </tr>
              </tfoot>
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
  <div class="modal fade" id="modal-add-golongan">
    <div class="modal-dialog modal-md">
      <form action="/bo_cs_ad_golongan" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Data Entry Golongan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                        <label for="inputidgoledit">Kode Golongan</label>
                        <input type="text" name="inputidgoledit" value="{{ $lastgolonganid+1 }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-8 col-sm-12">
                        <label for="inputdescgoledit">Deskripsi Golongan</label>
                        <input type="text" name="inputdescgoledit" value="" class="form-control">
                        </div>
                    </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      @csrf
    </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- /.content -->
@endsection
