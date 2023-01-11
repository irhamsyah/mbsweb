@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Location</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-location">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>City</th>
                <th>Province</th>
                <th>Loading</th>
                <th>Pelayaran</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($locations as $index => $location)
                @if($location->status_loading==0)
                  @php ($status_loading='Inactive')
                @else
                  @php ($status_loading='Active')
                @endif
                @if($location->status_pelayaran==0)
                  @php ($status_pelayaran='Inactive')
                @else
                  @php ($status_pelayaran='Active')
                @endif
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $location->code_city }}</td>
                  <td>{{ $location->name_city }}</td>
                  <td>{{ $location->province_city }}</td>
                  <td>{{ $status_loading }}</td>
                  <td>{{ $status_pelayaran }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-location"
                            data-id="{{ $location->id }}"
                            data-codecity="{{ $location->code_city }}"
                            data-namecity="{{ $location->name_city }}"
                            data-provincecity="{{ $location->province_city }}"
                            data-statusloading="{{ $location->status_loading }}"
                            data-statuspelayaran="{{ $location->status_pelayaran }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_location" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdLocation" value="{{ $location->id }}" class="form-control">
                           <input type="hidden" name="_method" value="DELETE"/>
                           @csrf
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>City</th>
                <th>Province</th>
                <th>Loading</th>
                <th>Pelayaran</th>
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
  <div class="modal fade" id="modal-edit-location">
    <div class="modal-dialog modal-md">
      <form action="/adm_location" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit City</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputCityCode">City Code</label>
                  <input type="text" name="inputCityCode" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputCityName">City Name</label>
                  <input type="text" name="inputCityName" class="form-control">
                </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                <label for="inputProvince">Province City</label>
                <input type="text" name="inputProvince" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputStatusLoading">Select Status Loading</label>
                  <select class="form-control" name="inputStatusLoading">
                    <option value="#" selected="true" disabled="disabled">--- Select Status Loading ---</option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                  </select>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputStatusPelayaran">Select Status Pelayaran</label>
                  <select class="form-control" name="inputStatusPelayaran">
                    <option value="#" selected="true" disabled="disabled">--- Select Status Pelayaran ---</option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdLocation" class="form-control">
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
  <div class="modal fade" id="modal-add-location">
    <div class="modal-dialog modal-md">
      <form action="/adm_location" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add City</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputCityCode">City Code</label>
                  <input type="text" name="inputCityCode" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputCityName">City Name</label>
                  <input type="text" name="inputCityName" class="form-control">
                </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                <label for="inputProvince">Province City</label>
                <input type="text" name="inputProvince" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputStatusLoading">Select Status Loading</label>
                  <select class="form-control" name="inputStatusLoading">
                    <option value="#" selected="true" disabled="disabled">--- Select Status Loading ---</option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                  </select>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputStatusPelayaran">Select Status Pelayaran</label>
                  <select class="form-control" name="inputStatusPelayaran">
                    <option value="#" selected="true" disabled="disabled">--- Select Status Pelayaran ---</option>
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
            </div>
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
