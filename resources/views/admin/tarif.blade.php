@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Tarif</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-tarif">New</button>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Name Pelayaran</th>
                <th>Date</th>
                <th>Location</th>
                <th>Price</th>
                <th>PIC Pelayaran</th>
                <th>Last Price1</th>
                <th>Last Price2</th>
                <th>Last Price3</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($tarifs as $index => $tarif)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($tarif->code_pelayaran).' - '.$tarif->name_pelayaran }}</td>
                  <td>{{ date('d F Y', strtotime($tarif->date)) }}</td>
                  <td>{{ $tarif->city.' - '.$tarif->province }}</td>
                  <td>{{ $tarif->price }}</td>
                  <td>{{ $tarif->pic_pelayaran }}</td>
                  <td>{{ $tarif->last_price1 }}</td>
                  <td>{{ $tarif->last_price2 }}</td>
                  <td>{{ $tarif->last_price3 }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-tarif"
                            data-id="{{ $tarif->id }}"
                            data-pelayaranid="{{ $tarif->pelayaran_id }}"
                            data-city="{{ $tarif->city }}"
                            data-province="{{ $tarif->province }}"
                            data-price="{{ $tarif->price }}"
                            data-date="{{ date('Y-m-d', strtotime($tarif->date)) }}"
                            data-picpelayaran="{{ $tarif->pic_pelayaran }}"
                            data-lastprice1="{{ $tarif->last_price1 }}"
                            data-lastprice2="{{ $tarif->last_price2 }}"
                            data-lastprice3="{{ $tarif->last_price3 }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_tarif" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdTarif" value="{{ $tarif->id }}" class="form-control">
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
                <th>Name Pelayaran</th>
                <th>Date</th>
                <th>Location</th>
                <th>Price</th>
                <th>PIC Pelayaran</th>
                <th>Last Price1</th>
                <th>Last Price2</th>
                <th>Last Price3</th>
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
  <div class="modal fade" id="modal-edit-tarif">
    <div class="modal-dialog modal-lg">
      <form action="/adm_tarif" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Tarif</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputIdPelayaran">Select Pelayaran</label>
                  <select class="form-control" name="inputIdPelayaran">
                    <option value="#" selected="true" disabled="disabled">--- Select Pelayaran ---</option>
                    @foreach($pelayarans as $pelayaran)
                    <option value="{{ $pelayaran->pel_id }}">{{ $pelayaran->code_pelayaran }} - {{ $pelayaran->name_pelayaran }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputCity">City</label>
                  <input type="text" name="inputCity" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputProvince">Province</label>
                  <input type="text" name="inputProvince" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPrice">Price</label>
                  <input type="text" name="inputPrice" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPIC">PIC Pelayaran</label>
                  <input type="text" name="inputPIC" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputDate2">Date</label>
                  <div class="input-group date" id="inputDate2" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="inputDate2" data-target="#inputDate2"/>
                      <div class="input-group-append" data-target="#inputDate2" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLastPrice1">Last Price 1</label>
                  <input type="text" disabled name="inputLastPrice1" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLastPrice2">Last Price 2</label>
                  <input type="text" disabled name="inputLastPrice2" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLastPrice3">Last Price 3</label>
                  <input type="text" disabled name="inputLastPrice3" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdTarif" class="form-control">
              <input type="hidden" name="inputPrice_old" class="form-control">
              <input type="hidden" name="inputLastPrice1_old" class="form-control">
              <input type="hidden" name="inputLastPrice2_old" class="form-control">
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
  <div class="modal fade" id="modal-add-tarif">
    <div class="modal-dialog modal-lg">
      <form action="/adm_tarif" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Tarif</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputIdPelayaran">Select Pelayaran</label>
                  <select class="form-control" name="inputIdPelayaran">
                    <option value="#" selected="true" disabled="disabled">--- Select Pelayaran ---</option>
                    @foreach($pelayarans as $pelayaran)
                    <option value="{{ $pelayaran->pel_id }}">{{ $pelayaran->code_pelayaran }} - {{ $pelayaran->name_pelayaran }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputCity">City</label>
                  <input type="text" name="inputCity" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputProvince">Province</label>
                  <input type="text" name="inputProvince" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPrice">Price</label>
                  <input type="text" name="inputPrice" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputPIC">PIC Pelayaran</label>
                  <input type="text" name="inputPIC" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputDate1">Date</label>
                  <div class="input-group date" id="inputDate1" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="inputDate1" data-target="#inputDate1"/>
                      <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLastPrice1">Last Price 1</label>
                  <input type="text" name="inputLastPrice1" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLastPrice2">Last Price 2</label>
                  <input type="text" name="inputLastPrice2" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputLastPrice3">Last Price 3</label>
                  <input type="text" name="inputLastPrice3" class="form-control">
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
