@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Agent</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-agent">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>Name Agent</th>
                <th>Location</th>
                <th>Telp</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($agents as $index => $agent)
                @if($agent->status==0)
                  @php ($status='Inactive')
                @else
                  @php ($status='Active')
                @endif

                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($agent->code_agent) }}</td>
                  <td>{{ strtoupper($agent->name_agent) }}</td>
                  <td>{{ $agent->name_city.' - '.$agent->province_city }}</td>
                  <td>{{ $agent->telp }}</td>
                  <td>{{ $status }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-agent"
                            data-id="{{ $agent->id }}"
                            data-codeagent="{{ $agent->code_agent }}"
                            data-nameagent="{{ $agent->name_agent }}"
                            data-addressinv="{{ $agent->address_invoice }}"
                            data-address="{{ $agent->address }}"
                            data-idcity="{{ $agent->id_city }}"
                            data-postal="{{ $agent->postal }}"
                            data-telp="{{ $agent->telp }}"
                            data-fax="{{ $agent->fax }}"
                            data-npwp="{{ $agent->npwp }}"
                            data-pkpno="{{ $agent->pkp_no }}"
                            data-descagent="{{ $agent->desc_agent }}"
                            data-payment="{{ $agent->payment_term }}"
                            data-nameperson="{{ $agent->name_person }}"
                            data-phoneperson="{{ $agent->phone_person }}"
                            data-emailperson="{{ $agent->email_person }}"
                            data-faxperson="{{ $agent->fax_person }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_agent" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdAgent" value="{{ $agent->id }}" class="form-control">
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
                <th>Name Agent</th>
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
  <div class="modal fade" id="modal-edit-agent">
    <div class="modal-dialog modal-xl">
      <form action="/adm_agent" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Agent</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Agent Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAgentCode">Agent Code</label>
                  <input type="text" name="inputAgentCode" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAgentrName">Agent Name</label>
                  <input type="text" name="inputAgentName" class="form-control">
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
                  <label for="inputAgentDesc">Agent Description</label>
                  <textarea class="form-control" id="inputAgentDesc" rows="3" name="inputAgentDesc"></textarea>
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
              <input type="hidden" name="inputIdAgent" class="form-control">
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
  <div class="modal fade" id="modal-add-agent">
    <div class="modal-dialog modal-xl">
      <form action="/adm_agent" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Agent</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Agent Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAgentCode">Agent Code</label>
                  <input type="text" name="inputAgentCode" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAgentrName">Agent Name</label>
                  <input type="text" name="inputAgentName" class="form-control">
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
                  <label for="inputAgentDesc">Agent Description</label>
                  <textarea class="form-control" id="inputAgentDesc" rows="3" name="inputAgentDesc"></textarea>
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
