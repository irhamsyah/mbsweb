@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Consignee</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-consignee">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>Name Consignee</th>
                <th>Location</th>
                <th>Telp</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($consignees as $index => $consignee)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($consignee->code_consignee) }}</td>
                  <td>{{ strtoupper($consignee->name_consignee) }}</td>
                  <td>{{ $consignee->name_city.' - '.$consignee->province_city }}</td>
                  <td>{{ $consignee->telp }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-consignee"
                            data-id="{{ $consignee->id }}"
                            data-codecons="{{ $consignee->code_consignee }}"
                            data-namecons="{{ $consignee->name_consignee }}"
                            data-addressinv="{{ $consignee->address_invoice }}"
                            data-address="{{ $consignee->address }}"
                            data-idcity="{{ $consignee->id_city }}"
                            data-postal="{{ $consignee->postal }}"
                            data-telp="{{ $consignee->telp }}"
                            data-fax="{{ $consignee->fax }}"
                            data-npwp="{{ $consignee->npwp }}"
                            data-pkpno="{{ $consignee->pkp_no }}"
                            data-desccons="{{ $consignee->desc_consignee }}"
                            data-payment="{{ $consignee->payment_term }}"
                            data-nameperson="{{ $consignee->name_person }}"
                            data-phoneperson="{{ $consignee->phone_person }}"
                            data-emailperson="{{ $consignee->email_person }}"
                            data-faxperson="{{ $consignee->fax_person }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_consignee" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdConsignee" value="{{ $consignee->id }}" class="form-control">
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
                <th>Name Consignee</th>
                <th>Location</th>
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
  <div class="modal fade" id="modal-edit-consignee">
    <div class="modal-dialog modal-xl">
      <form action="/adm_consignee" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Consignee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Consignee Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputConsigneeCode">Consignee Code</label>
                  <input type="text" name="inputConsigneeCode" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputConsigneeName">Consignee Name</label>
                  <input type="text" name="inputConsigneeName" class="form-control">
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
                <div class="col-lg-4 col-sm-12">
                  <label for="inputIdCity">Select City</label>
                  <select class="form-control" name="inputIdCity">
                    <option value="#" selected="true" disabled="disabled">--- Select City ---</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->loc_id }}">{{ $location->code_city }} - {{ $location->name_city }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPostal">Postal Code</label>
                  <input type="text" name="inputPostal" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
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
                  <label for="inputConsigneeDesc">Consignee Description</label>
                  <textarea class="form-control" id="inputConsigneeDesc" rows="3" name="inputConsigneeDesc"></textarea>
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
            <div class="form-group">
              <input type="hidden" name="inputIdConsignee" class="form-control">
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
  <div class="modal fade" id="modal-add-consignee">
    <div class="modal-dialog modal-xl">
      <form action="/adm_consignee" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Consignee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Consignee Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputConsigneeCode">Consignee Code</label>
                  <input type="text" name="inputConsigneeCode" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputConsigneeName">Consignee Name</label>
                  <input type="text" name="inputConsigneeName" class="form-control">
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
                <div class="col-lg-4 col-sm-12">
                  <label for="inputIdCity">Select City</label>
                  <select class="form-control" name="inputIdCity">
                    <option value="#" selected="true" disabled="disabled">--- Select City ---</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->loc_id }}">{{ $location->code_city }} - {{ $location->name_city }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPostal">Postal Code</label>
                  <input type="text" name="inputPostal" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
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
                  <label for="inputConsigneeDesc">Consignee Description</label>
                  <textarea class="form-control" id="inputConsigneeDesc" rows="3" name="inputConsigneeDesc"></textarea>
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
