@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Bank Account</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-bankaccount">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Agent</th>
                <th>Bank Name</th>
                <th>Branch</th>
                <th>Bank Account</th>
                <th>A/N</th>
                <th>Bank Address</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($banks as $index => $bank)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($bank->code_agent.' - '.$bank->name_agent) }}</td>
                  <td>{{ strtoupper($bank->bank_name) }}</td>
                  <td>{{ $bank->branch }}</td>
                  <td>{{ $bank->bank_account }}</td>
                  <td>{{ $bank->account_name }}</td>
                  <td>{{ $bank->bank_address }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-bankaccount"
                            data-id="{{ $bank->id }}"
                            data-bankname="{{ $bank->bank_name }}"
                            data-bankaccount="{{ $bank->bank_account }}"
                            data-branch="{{ $bank->branch }}"
                            data-accountname="{{ $bank->account_name }}"
                            data-bankaddress="{{ $bank->bank_address }}"
                            data-agentid="{{ $bank->agent_id }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_bank_account" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdBankAccount" value="{{ $bank->id }}" class="form-control">
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
                <th>Agent</th>
                <th>Bank Name</th>
                <th>Branch</th>
                <th>Bank Account</th>
                <th>A/N</th>
                <th>Bank Address</th>
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
  <div class="modal fade" id="modal-edit-bankaccount">
    <div class="modal-dialog modal-lg">
      <form action="/adm_bank_account" method="post" enctype="multipart/form-data">
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
                <div class="col-lg-12 col-sm-12">
                  <label for="inputIdAgent">Select Agent</label>
                  <select class="form-control select" name="inputIdAgent">
                    @foreach($agents as $agent)
                    <option value="{{ $agent->id }}">{{ strtoupper($agent->code_agent.' - '.$agent->name_agent) }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <h4 class="bg-gray-dark color-palette"><center>Bank Account</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputBankName">Bank Name</label>
                  <input type="text" name="inputBankName" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputBranch">Branch</label>
                  <input type="text" name="inputBranch" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputBankAccount">Bank No Account</label>
                  <input type="text" name="inputBankAccount" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAccountName">A/N</label>
                  <input type="text" name="inputAccountName" class="form-control">
                </div>
                <div class="col-lg-12 col-sm-12">
                  <label for="inputBankAddress">Bank Address</label>
                  <textarea id="inputBankAddress" name="inputBankAddress"  class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdBankAccount" class="form-control">
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
  <div class="modal fade" id="modal-add-bankaccount">
    <div class="modal-dialog modal-lg">
      <form action="/adm_bank_account" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Bank Account</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Agent Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <label for="inputIdCity">Select Agent</label>
                  <select class="form-control select2" name="inputIdAgent">
                    <option value="#" selected="true" disabled="disabled">--- Select Agent ---</option>
                    @foreach($agents as $agent)
                    <option value="{{ $agent->id }}">{{ strtoupper($agent->code_agent.' - '.$agent->name_agent) }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <h4 class="bg-gray-dark color-palette"><center>Bank Account</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputBankName">Bank Name</label>
                  <input type="text" name="inputBankName" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputBranch">Branch</label>
                  <input type="text" name="inputBranch" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputBankAccount">Bank No Account</label>
                  <input type="text" name="inputBankAccount" class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputAccountName">A/N</label>
                  <input type="text" name="inputAccountName" class="form-control">
                </div>
                <div class="col-lg-12 col-sm-12">
                  <label for="inputBankAddress">Bank Address</label>
                  <textarea id="inputBankAddress" name="inputBankAddress"  class="form-control"></textarea>
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
