@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Customer</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-customer">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>Name Customer</th>
                <th>Location</th>
                <th>Telp</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($customers as $index => $customer)
                @if($customer->status==0)
                  @php ($status='Inactive')
                @else
                  @php ($status='Active')
                @endif

                @if($customer->entity_name=='PERORANGAN')
                  @php ($name_customer=$customer->name_customer)
                @else
                  @php ($name_customer=$customer->name_customer.', '.$customer->entity_name)
                @endif

                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($customer->code_customer) }}</td>
                  <td>{{ strtoupper($name_customer) }}</td>
                  <td>{{ $customer->city.' - '.$customer->province }}</td>
                  <td>{{ $customer->telp }}</td>
                  <td>{{ $status }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-customer"
                            data-id="{{ $customer->id }}"
                            data-codecust="{{ $customer->code_customer }}"
                            data-namecust="{{ $customer->name_customer }}"
                            data-addressinv="{{ $customer->address_invoice }}"
                            data-address="{{ $customer->address }}"
                            data-city="{{ $customer->city }}"
                            data-province="{{ $customer->province }}"
                            data-postal="{{ $customer->postal }}"
                            data-telp="{{ $customer->telp }}"
                            data-fax="{{ $customer->fax }}"
                            data-npwp="{{ $customer->npwp }}"
                            data-pkpno="{{ $customer->pkp_no }}"
                            data-desccustomer="{{ $customer->desc_customer }}"
                            data-payment="{{ $customer->payment_term }}"
                            data-username="{{ $customer->username }}"
                            data-password="{{ $customer->password }}"
                            data-entity="{{ $customer->entity_id }}"
                            data-entityname="{{ $customer->entity_name }}"
                            data-status="{{ $customer->status }}"
                            data-nameperson="{{ $customer->name_person }}"
                            data-phoneperson="{{ $customer->phone_person }}"
                            data-emailperson="{{ $customer->email_person }}"
                            data-faxperson="{{ $customer->fax_person }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_customer" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdCustomer" value="{{ $customer->id }}" class="form-control">
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
                <th>Name Customer</th>
                <th>Location</th>
                <th>Telp</th>
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
  <div class="modal fade" id="modal-edit-customer">
    <div class="modal-dialog modal-xl">
      <form action="/adm_customer" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Customer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Customer Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputUsername">Username</label>
                  <input type="text" name="inputUsername" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPassword">Password</label>
                  <input type="password" name="inputPassword" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputConfPassword">Confirm Password</label>
                  <input type="password" name="inputConfPassword" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                  <label for="inputCostumerCode">Costumer Code</label>
                  <input type="text" name="inputCostumerCode" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputEntity">Entity</label>
                  <select class="form-control" name="inputEntity" id="inputEntity_edit">
                    <option value="#" selected="true" disabled="disabled">--- Select Entity ---</option>
                    @foreach($entitys as $entity)
                    <option value="{{ $entity->id }}">{{ $entity->entity_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputCostumerName">Company Name</label>
                  <input type="text" name="inputCostumerName" id="inputCostumerName_edit" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputAccountName">Account Name</label>
                  <input type="text" name="inputAccountName" id="inputAccountName_edit" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAddressInvoice">Address Invoice</label>
                  <textarea class="form-control" id="inputAddressInvoice" rows="3" name="inputAddressInvoice"></textarea>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAddress">Address</label>
                  <textarea class="form-control" id="inputAddress" rows="3" name="inputAddress"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                  <label for="inputCity">City</label>
                  <input type="text" name="inputCity" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputProvince">Province</label>
                  <input type="text" name="inputProvince" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputPostal">Postal Code</label>
                  <input type="text" name="inputPostal" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputTelp">Telp</label>
                  <input type="text" name="inputTelp" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputFax">Fax</label>
                  <input type="text" name="inputFax" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputNPWP">Tax Reg / NPWP</label>
                  <input type="text" name="inputNPWP" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPkp">PKP Number</label>
                  <input type="text" name="inputPkp" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputCustomerDesc">Customer Description</label>
                  <textarea class="form-control" id="inputCustomerDesc" rows="3" name="inputCustomerDesc"></textarea>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputTOP">Payment Term (TOP)</label>
                  <input type="text" name="inputTOP" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="inputStatus">
                    <option value="0">Inactive</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
            </div>
            <h4 class="bg-gray-dark color-palette"><center>Contact Person</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputPersonName">Name</label>
                  <input type="text" name="inputPersonName" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputPersonEmail">Email</label>
                  <input type="text" name="inputPersonEmail" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputPersonPhone">Phone</label>
                  <input type="text" name="inputPersonPhone" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputPersonFax">Fax</label>
                  <input type="text" name="inputPersonFax" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdCustomer" class="form-control">
              <input type="hidden" name="inputPasswordOld" class="form-control">
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
  <div class="modal fade" id="modal-add-customer">
    <div class="modal-dialog modal-xl">
      <form action="/adm_customer" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Customer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Customer Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputUsername">Username</label>
                  <input type="text" name="inputUsername" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPassword">Password</label>
                  <input type="password" name="inputPassword" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputConfPassword">Confirm Password</label>
                  <input type="password" name="inputConfPassword" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                  <label for="inputCostumerCode">Costumer Code</label>
                  <input type="text" name="inputCostumerCode" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputEntity">Entity</label>
                  <select class="form-control" name="inputEntity" id="inputEntity_add">
                    <option value="#" selected="true" disabled="disabled">--- Select Entity ---</option>
                    @foreach($entitys as $entity)
                    <option value="{{ $entity->id }}">{{ $entity->entity_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputCostumerName">Company Name</label>
                  <input type="text" name="inputCostumerName" id="inputCostumerName_add" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputAccountName">Account Name</label>
                  <input type="text" name="inputAccountName" id="inputAccountName_add" class="form-control" disabled>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAddressInvoice">Address Invoice</label>
                  <textarea class="form-control" id="inputAddressInvoice" rows="3" name="inputAddressInvoice"></textarea>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAddress">Address</label>
                  <textarea class="form-control" id="inputAddress" rows="3" name="inputAddress"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-sm-12">
                  <label for="inputCity">City</label>
                  <input type="text" name="inputCity" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputProvince">Province</label>
                  <input type="text" name="inputProvince" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputPostal">Postal Code</label>
                  <input type="text" name="inputPostal" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label for="inputTelp">Telp</label>
                  <input type="text" name="inputTelp" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputFax">Fax</label>
                  <input type="text" name="inputFax" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputNPWP">Tax Reg / NPWP</label>
                  <input type="text" name="inputNPWP" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPkp">PKP Number</label>
                  <input type="text" name="inputPkp" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-8 col-sm-12">
                  <label for="inputCustomerDesc">Customer Description</label>
                  <textarea class="form-control" id="inputCustomerDesc" rows="3" name="inputCustomerDesc"></textarea>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTOP">Payment Term (TOP)</label>
                  <input type="text" name="inputTOP" class="form-control">
                </div>
              </div>
            </div>
            <h4 class="bg-gray-dark color-palette"><center>Contact Person</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputPersonName">Name</label>
                  <input type="text" name="inputPersonName" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputPersonEmail">Email</label>
                  <input type="text" name="inputPersonEmail" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputPersonPhone">Phone</label>
                  <input type="text" name="inputPersonPhone" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputPersonFax">Fax</label>
                  <input type="text" name="inputPersonFax" class="form-control">
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
