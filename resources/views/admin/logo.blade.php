@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Logo Bahtera Setia Group</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <th>No</th>
                <th>Image Logo</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach($logos as $index => $logo)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td><img src="{{ asset('/img/logo/'.$logo->logo_name) }}" style="max-height:100px;"/></td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-logonew"
                            data-id="{{ $logo->id }}"
                            data-name="{{ $logo->logo_name }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Image</th>
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
  <div class="modal fade" id="modal-edit-logonew">
    <div class="modal-dialog modal-md">
      <form action="/adm_logo" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Logo Bahtera Setia Group</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label for="inputImage">Upload Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="inputImage" id="inputImage">
                    <label class="custom-file-label" for="inputImage">Choose Image</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputLogoOld" class="form-control">
              <input type="hidden" name="inputIdLogo" class="form-control">
              <input type="hidden" name="_method" value="PUT"/>
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
  <!-- /.modal -->
</div>
<!-- /.content -->
@endsection
