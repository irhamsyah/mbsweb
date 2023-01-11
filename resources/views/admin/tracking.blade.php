@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Tracking</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-tracking">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Trans No</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($trackings as $index => $tracking)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($tracking->trans_no) }}</td>
                  <td>{{ strtoupper($tracking->code_customer.' - '.$tracking->name_customer) }}</td>
                  <td>{{ $tracking->date->format('d M Y H:i:s') }}</td>
                  <td>{{ $tracking->latitude.', '.$tracking->longitude }}</td>
                  <td>{{ $tracking->description }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-tracking"
                            data-id="{{ $tracking->id }}"
                            data-latitude="{{ $tracking->latitude }}"
                            data-longitude="{{ $tracking->longitude }}"
                            data-description="{{ $tracking->description }}"
                            data-date="{{ $tracking->date }}"
                            data-customer_id="{{ $tracking->customer_id }}"
                            data-name_customer="{{ $tracking->name_customer }}"
                            data-trans_no="{{ $tracking->trans_no }}"
                            data-transaction_id="{{ $tracking->transaction_id }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_tracking" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdTracking" value="{{ $tracking->id }}" class="form-control">
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
                <th>Trans Code</th>
                <th>Trans Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Description</th>
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
  <div class="modal fade" id="modal-edit-tracking">
    <div class="modal-dialog modal-xl">
      <form action="/adm_tracking" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Tracking</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputTransactionNo">Transaction No</label>
                  <input type="text" name="inputTransactionNo" readonly class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputCustomerName">Customer Name</label>
                  <input type="text" name="inputCustomerName" readonly class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                <label for="inputDate">Date</label>
                  <div class="input-group date" id="inputDate3" data-target-input="nearest">
                      <input type="text" name="inputDate3" class="form-control datetimepicker-input" data-target="#inputDate3"/>
                      <div class="input-group-append" data-target="#inputDate3" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLatitude">Latitude</label>
                  <input type="text" name="inputLatitude" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLongitude">Longitude</label>
                  <input type="text" name="inputLongitude" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <label for="inputDesc">Description</label>
                  <textarea class="form-control" id="inputDesc" rows="3" name="inputDesc"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdTracking" class="form-control">
              <input type="hidden" name="inputIdTransaction" class="form-control">
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
  <div class="modal fade" id="modal-add-tracking">
    <div class="modal-dialog modal-xl">
      <form action="/adm_tracking" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Tracking</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <label for="inputTransactionNo">Transaction No</label>
                  <select class="form-control select2" name="inputTransactionNo">
                    <option value="#" selected="true" disabled="disabled">--- Select Transaction ---</option>
                    @foreach($transactions as $transaction)
                    <option value="{{ $transaction->id }}">{{ $transaction->name_customer.' - '.$transaction->trans_no.' - '.$transaction->resi_no }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputDate">Date</label>
                  <div class="input-group date" id="inputDate4" data-target-input="nearest">
                      <input type="text" name="inputDate4" class="form-control datetimepicker-input" data-target="#inputDate4"/>
                      <div class="input-group-append" data-target="#inputDate4" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLatitude">Latitude</label>
                  <input type="text" name="inputLatitude" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLongitude">Longitude</label>
                  <input type="text" name="inputLongitude" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <label for="inputDesc">Description</label>
                  <textarea class="form-control" id="inputDesc" rows="3" name="inputDesc"></textarea>
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
