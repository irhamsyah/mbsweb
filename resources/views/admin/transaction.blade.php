@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Transaction</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-transaction" style="display:none;">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Trans No</th>
                <th>Resi No</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>From City</th>
                <th>To City</th>
                <th>Vessel</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($transactions as $index => $transaction)
                  @if($transaction->status==0)
                    @php ($status='Process')
                  @elseif($transaction->status==1)
                    @php ($status='Success')
                  @else
                    @php ($status='Canceled')
                  @endif
                  @if($transaction->loading_date==NULL)
                    @php ($loading_date='')
                  @else
                    @php ($loading_date=$transaction->loading_date->format('d/m/Y'))
                  @endif
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($transaction->trans_no) }}</td>
                  <td>{{ $transaction->resi_no }}</td>
                  <td>{{ strtoupper($transaction->code_customer.' - '.$transaction->name_customer) }}</td>
                  <td>{{ $loading_date }}</td>
                  <td>{{ $transaction->location_from }}</td>
                  <td>{{ $transaction->location_to }}</td>
                  <td>{{ $transaction->name_pelayaran.' - '.$transaction->alias }}</td>
                  <td>{{ $status }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <form action="/adm_transaction_detail" method="post">
                           <button type="submit" class="btn btn-block bg-gradient-primary btn-sm">
                              <i class="fa fa-eye" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdTransaction" value="{{ $transaction->id }}" class="form-control">
                           @csrf
                        </form>
                      </div>
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-transaction"
                            data-id="{{ $transaction->id }}"
                            data-trans_no="{{ $transaction->trans_no }}"
                            data-name_customer="{{ $transaction->name_customer }}"
                            data-customer_id="{{ $transaction->customer_id }}"
                            data-shipping_no="{{ $transaction->shipping_no }}"
                            data-loading_date="{{ $transaction->loading_date }}"
                            data-agent_id="{{ $transaction->agent_id }}"
                            data-vendor_id="{{ $transaction->vendor_truck_id }}"
                            data-pelayaran_id="{{ $transaction->pelayaran_id }}"
                            data-location_id="{{ $transaction->location_id }}"
                            data-resi_no="{{ $transaction->resi_no }}"
                            data-location_from="{{ $transaction->location_from }}"
                            data-location_to="{{ $transaction->location_to }}"
                            data-status="{{ $transaction->status }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_transaction" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" style="display:none;">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdTransaction" value="{{ $transaction->id }}" class="form-control">
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
                <th>Trans No</th>
                <th>Resi No</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>From City</th>
                <th>To City</th>
                <th>Vessel</th>
                <th>Status</th>
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
  <div class="modal fade" id="modal-edit-transaction">
    <div class="modal-dialog modal-xl">
      <form action="/adm_transaction" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Transaction</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTransactionNo">Transaction No</label>
                  <input type="text" name="inputTransactionNo" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputResi">Resi No</label>
                  <input type="text" name="inputResi" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputCustomerName">Customer Name</label>
                  <input type="text" name="inputCustomerName" readonly class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                <label for="inputDate">Date</label>
                  <div class="input-group date" id="inputDate3" data-target-input="nearest">
                      <input type="text" name="inputDate3" class="form-control datetimepicker-input" data-target="#inputDate3"/>
                      <div class="input-group-append" data-target="#inputDate3" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputFromCity">From City</label>
                  <input type="text" name="inputFromCity" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputToCity">To City</label>
                  <input type="text" name="inputToCity" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                <label for="inputPelayaran">Vessel</label>
                  <select class="form-control" name="inputPelayaran">
                    <option value="#" selected="true" disabled="disabled">--- Select Vessel ---</option>
                    @foreach($pelayarans as $pelayaran)
                    <option value="{{ $pelayaran->id }}">{{ $pelayaran->code_pelayaran.' - '.$pelayaran->name_pelayaran.', '.$pelayaran->alias }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-9 col-sm-12"></div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="inputStatus">
                    <option value="#" selected="true" disabled="disabled">--- Select Status ---</option>
                    <option value="0">Process</option>
                    <option value="1">Success</option>
                    <option value="9">Canceled</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
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
  <div class="modal fade" id="modal-add-transaction">
    <div class="modal-dialog modal-xl">
      <form action="/adm_transaction" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Transaction</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTransactionNo">Transaction No</label>
                  <input type="text" name="inputTransactionNo" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputResi">Resi No</label>
                  <input type="text" name="inputResi" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputCustomerName">Customer Name</label>
                  <input type="text" name="inputCustomerName" readonly class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                <label for="inputDate">Date</label>
                  <div class="input-group date" id="inputDate3" data-target-input="nearest">
                      <input type="text" name="inputDate3" class="form-control datetimepicker-input" data-target="#inputDate3"/>
                      <div class="input-group-append" data-target="#inputDate3" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputFromCity">From City</label>
                  <input type="text" name="inputFromCity" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputToCity">To City</label>
                  <input type="text" name="inputToCity" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                <label for="inputPelayaran">Vessel</label>
                  <select class="form-control" name="inputPelayaran">
                    <option value="#" selected="true" disabled="disabled">--- Select Vessel ---</option>
                    @foreach($pelayarans as $pelayaran)
                    <option value="{{ $pelayaran->id }}">{{ $pelayaran->code_pelayaran.' - '.$pelayaran->name_pelayaran.', '.$pelayaran->alias }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-9 col-sm-12"></div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="inputStatus">
                    <option value="#" selected="true" disabled="disabled">--- Select Status ---</option>
                    <option value="0">Process</option>
                    <option value="1">Success</option>
                    <option value="9">Canceled</option>
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
