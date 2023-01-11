@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Pelayaran</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-pelayaran">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>Name Pelayaran</th>
                <th>Location</th>
                <th>Telp</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($pelayarans as $index => $pelayaran)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($pelayaran->code_pelayaran) }}</td>
                  <td>{{ strtoupper($pelayaran->name_pelayaran).' alias: '.$pelayaran->alias }}</td>
                  <td>{{ $pelayaran->city.' - '.$pelayaran->province }}</td>
                  <td>{{ $pelayaran->telp }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-pelayaran"
                            data-id="{{ $pelayaran->id }}"
                            data-codepelayaran="{{ $pelayaran->code_pelayaran }}"
                            data-namepelayaran="{{ $pelayaran->name_pelayaran }}"
                            data-alias="{{ $pelayaran->alias }}"
                            data-address="{{ $pelayaran->address }}"
                            data-city="{{ $pelayaran->city }}"
                            data-province="{{ $pelayaran->province }}"
                            data-postal="{{ $pelayaran->postal }}"
                            data-telp="{{ $pelayaran->telp }}"
                            data-fax="{{ $pelayaran->fax }}"
                            data-npwp="{{ $pelayaran->npwp }}"
                            data-pkpno="{{ $pelayaran->pkp_no }}"
                            data-descpelayaran="{{ $pelayaran->desc_pelayaran }}"
                            data-payment="{{ $pelayaran->payment_term }}"
                            data-nameperson="{{ $pelayaran->name_person }}"
                            data-phoneperson="{{ $pelayaran->phone_person }}"
                            data-emailperson="{{ $pelayaran->email_person }}"
                            data-faxperson="{{ $pelayaran->fax_person }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_pelayaran" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdPelayaran" value="{{ $pelayaran->id }}" class="form-control">
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
                <th>Name Pelayaran</th>
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
  <div class="modal fade" id="modal-edit-pelayaran">
    <div class="modal-dialog modal-xl">
      <form action="/adm_pelayaran" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Pelayaran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Pelayaran Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPelayaranCode">Pelayaran Code</label>
                  <input type="text" name="inputPelayaranCode" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPelayaranName">Pelayaran Name</label>
                  <input type="text" name="inputPelayaranName" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputAlias">Alias / Surname</label>
                  <input type="text" name="inputAlias" class="form-control">
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
                  <label for="inputPelayaranDesc">Pelayaran Description</label>
                  <textarea class="form-control" id="inputPelayaranDesc" rows="3" name="inputPelayaranDesc"></textarea>
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
              <input type="hidden" name="inputIdPelayaran" class="form-control">
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
  <div class="modal fade" id="modal-add-pelayaran">
    <div class="modal-dialog modal-xl">
      <form action="/adm_pelayaran" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Pelayaran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="bg-gray-dark color-palette"><center>Pelayaran Detail</center></h4>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPelayaranCode">Pelayaran Code</label>
                  <input type="text" name="inputPelayaranCode" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPelayaranName">Pelayaran Name</label>
                  <input type="text" name="inputPelayaranName" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputAlias">Alias / Surname</label>
                  <input type="text" name="inputAlias" class="form-control">
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
                  <label for="inputPelayaranDesc">Pelayaran Description</label>
                  <textarea class="form-control" id="inputPelayaranDesc" rows="3" name="inputPelayaranDesc"></textarea>
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
