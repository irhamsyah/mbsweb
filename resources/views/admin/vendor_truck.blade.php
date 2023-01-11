@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Vendor Truck</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-vendor">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>Name Vendor</th>
                <th>Trucking Type</th>
                <th>Telp</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($vendor_trucks as $index => $vendor_truck)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($vendor_truck->code_vendor) }}</td>
                  <td>{{ strtoupper($vendor_truck->name_vendor) }}</td>
                  <td>{{ $vendor_truck->name_trucking }}</td>
                  <td>{{ $vendor_truck->telp }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-vendor"
                            data-id="{{ $vendor_truck->id }}"
                            data-codevendor="{{ $vendor_truck->code_vendor }}"
                            data-namevendor="{{ $vendor_truck->name_vendor }}"
                            data-address="{{ $vendor_truck->address }}"
                            data-telp="{{ $vendor_truck->telp }}"
                            data-payment="{{ $vendor_truck->payment_term }}"
                            data-truckingtypeid="{{ $vendor_truck->trucking_type_id }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_vendor_truck" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdVendorTruck" value="{{ $vendor_truck->id }}" class="form-control">
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
                <th>Name Vendor</th>
                <th>Trucking Type</th>
                <th>Telp</th>
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
  <div class="modal fade" id="modal-edit-vendor">
    <div class="modal-dialog modal-lg">
      <form action="/adm_vendor_truck" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Vendor</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputVendorCode">Vendor Code</label>
                  <input type="text" name="inputVendorCode" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputVendorName">Vendor Name</label>
                  <input type="text" name="inputVendorName" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <label for="inputAddress">Address</label>
                  <textarea class="form-control" id="inputAddress" rows="3" name="inputAddress"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputIdTruckingType">Select Trucking Type</label>
                  <select class="form-control" name="inputIdTruckingType">
                    <option value="#" selected="true" disabled="disabled">--- Select Trucking Type ---</option>
                    @foreach($truckings as $trucking)
                    <option value="{{ $trucking->trucking_id }}">{{ $trucking->name_trucking }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTelp">Telp</label>
                  <input type="text" name="inputTelp" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTOP">Payment Term (TOP)</label>
                  <input type="text" name="inputTOP" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdVendorTruck" class="form-control">
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
  <div class="modal fade" id="modal-add-vendor">
    <div class="modal-dialog modal-lg">
      <form action="/adm_vendor_truck" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Vendor</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputVendorCode">Vendor Code</label>
                  <input type="text" name="inputVendorCode" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputVendorName">Vendor Name</label>
                  <input type="text" name="inputVendorName" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <label for="inputAddress">Address</label>
                  <textarea class="form-control" id="inputAddress" rows="3" name="inputAddress"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputIdTruckingType">Select Trucking Type</label>
                  <select class="form-control" name="inputIdTruckingType">
                    <option value="#" selected="true" disabled="disabled">--- Select Trucking Type ---</option>
                    @foreach($truckings as $trucking)
                    <option value="{{ $trucking->trucking_id }}">{{ $trucking->name_trucking }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTelp">Telp</label>
                  <input type="text" name="inputTelp" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTOP">Payment Term (TOP)</label>
                  <input type="text" name="inputTOP" class="form-control">
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
