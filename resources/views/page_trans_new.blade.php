@extends('layouts.page_main')

@section('content')
<section class="mbr-section form1 cid-s9mrYkgQsS" id="form1-27">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    TRANSACTION
                </h2>
            </div>
        </div>
        <div class="row">
          <div class="card p-3 col-lg-12">
              <div class="card-wrapper ">
                <h4 style="background:#000; color:#FFF;"><center>Customer Detail</center></h4>
                <div class="dragArea row">
                  <div class="col-md-2 form-group">
                      <label class="form-control-label mbr-fonts-style display-7">Code Customer</label>
                      <input type="text" value="{{ $customers->code_customer }}" class="form-control display-7" disabled="disabled">
                  </div>
                  <div class="col-md-5 form-group">
                      <label class="form-control-label mbr-fonts-style display-7">Name Customer</label>
                      <input type="text" value="{{ $customers->name_customer.', '.$customers->entity_name }}" class="form-control display-7" disabled="disabled">
                  </div>
                  <div class="col-md-5 form-group">
                      <label class="form-control-label mbr-fonts-style display-7">Location</label>
                      <input type="text" value="{{ $customers->city.', '.$customers->province }}" class="form-control display-7" disabled="disabled">
                  </div>
                  <div class="col-md-8 form-group">
                      <label class="form-control-label mbr-fonts-style display-7">Address</label>
                      <input type="text" value="{{ $customers->address }}" class="form-control display-7" disabled="disabled">
                  </div>
                  <div class="col-md-2 form-group">
                      <label class="form-control-label mbr-fonts-style display-7">Postal</label>
                      <input type="text" value="{{ $customers->postal }}" class="form-control display-7" disabled="disabled">
                  </div>
                  <div class="col-md-2 form-group">
                      <label class="form-control-label mbr-fonts-style display-7">Phone</label>
                      <input type="text" value="{{ $customers->telp }}" class="form-control display-7" disabled="disabled">
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
    <div class="container">
      <h4 style="background:#000; color:#FFF;"><center>Customer Transaction</center></h4>
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-12" data-form-type="formoid">
              <div class="row">
                  <!-- Custom tabs (Charts with tabs)-->
                  <div class="card" style="width:100%;">
                    <div class="card-header">
                      <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                          <li class="nav-item">
                            <a class="nav-link active btn btn-primary btn-form" style="padding:0.5rem" href="#pemesanan"  data-toggle="tab">Form Transaction</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link btn btn-primary btn-form" style="padding:0.5rem" href="#list-pemesanan" data-toggle="tab">History Transaction</a>
                          </li>
                        </ul>
                      </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="pemesanan" style="position: relative; min-height: 300px;">
                          <!---Formbuilder Form--->
                          <form action="/trans_new" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form">
                            <div class="dragArea row">
                              <div class="col-md-4  form-group" data-for="xxx">
                                <select class="form-control display-7" id="xxx" name="xxx" data-form-field="xxx" style="display:none;">
                                  <option value="#" selected="true" disabled="disabled">--- xxx ---</option>
                                </select>
                              </div>
                            </div>
                            <div class="dragArea row">
                              <div class="col-md-3  form-group">
                                  <?php
                                  //Get last Trans No
                                  $lasttransno=$transactionnos->trans_no;
                                  //check tahun sama
                                  $thn=substr($lasttransno, 2, 4);
                                  if($thn==date('Y')){
                                    $pecah=substr($lasttransno, 8, 4);
                                  }else{
                                    $pecah=0;
                                  }
                                  //generate No Transaction
                                  $transnonew = "TR".date('Ym').sprintf("%04s", $pecah+1);
                                  ?>
                                  <label class="form-control-label mbr-fonts-style display-7">Trans No</label>
                                  <input type="text" name="transno" required="required" readonly value="{{ $transnonew }}" class="form-control display-7" id="transno">
                              </div>
                                <div class="col-md-3  form-group">
                                    <?php
                                    $resi_no = date('ym').str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
                                    ?>
                                    <label class="form-control-label mbr-fonts-style display-7">Resi No</label>
                                    <input type="text" name="resino" required="required" readonly value="{{ $resi_no }}" class="form-control display-7" id="resino">
                                </div>
                                <div class="col-md-3  form-group">
                                    <label class="form-control-label mbr-fonts-style display-7">From</label>
                                    <input type="text" name="from" required="required" value="" class="form-control display-7" id="from">
                                </div>
                                <div class="col-md-3  form-group">
                                    <label class="form-control-label mbr-fonts-style display-7">To</label>
                                    <input type="text" name="to" required="required" value="" class="form-control display-7" id="to">
                                </div>
                                <!-- <div class="col-md-2  form-group">
                                    <label class="form-control-label mbr-fonts-style display-7">Departing Date</label>
                                    <input type="date" name="departingdate" class="form-control display-7" id="departingdate">
                                </div> -->
                            </div>
                            <h4 style="background:#000; color:#FFF;"><center>Detail Transaction</center></h4>
                            <button type="button" id="add_detail" class="btn btn-form" style="background:green; color: #FFF; padding:0.5rem;">Add</button>
                            <div id="detailTrans">
                              <div class="dragArea row">
                                  <div class="col-md-3  form-group">
                                    <label class="form-control-label mbr-fonts-style display-7">Consignee / Penerima</label>
                                    <input type="text" name="consignee[]" required="required" value="" class="form-control display-7" id="consignee">
                                  </div>
                                  <div class="col-md-3  form-group">
                                      <label class="form-control-label mbr-fonts-style display-7">Comodity / Barang</label>
                                      <input type="text" id="comodity" name="comodity[]" class="form-control display-7">
                                  </div>
                                  <div class="col-md-2  form-group">
                                      <label class="form-control-label mbr-fonts-style display-7">Weight</label>
                                      <input type="number" id="weight" name="weight[]" class="form-control display-7">
                                  </div>
                                  <div class="col-md-3  form-group">
                                      <label class="form-control-label mbr-fonts-style display-7">Unit Weight</label>
                                      <select class="form-control display-7" id="unitweight" name="unitweight[]" required="required">
                                        <option value="#" selected="true" disabled="disabled">--- Select Unit Weight ---</option>
                                        <option value="kg">Kilogram (Kg)</option>
                                        <option value="ton">Tonase (Ton)</option>
                                        <option value="kubik">Kubik</option>
                                      </select>
                                  </div>
                                  <div class="col-md-1  form-group">
                                      <label class="form-control-label mbr-fonts-style display-7">Action</label>
                                      <button type="button" id="del_detail" class="btn btn-form" style="background:red; color: #FFF; padding:0.5rem;">Del</button>
                                  </div>
                                </div>
                              </div>
                              <div class="dragArea row">
                                <input type="hidden" name="_method" value="PUT"/>
                                <input type="hidden" name="customerid" value="{{ $customers->id }}"/>
                              </div>
                              <div class="col-md-12 input-group-btn align-center"><button type="submit" class="btn btn-primary btn-form display-4">SUBMIT</button></div>
                              @csrf
                          </form><!---Formbuilder Form--->
                        </div>
                        <div class="chart tab-pane" id="list-pemesanan" style="position: relative; min-height: 300px;">
                          <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                <th>No</th>
                                <th>Trans No</th>
                                <th>Resi No</th>
                                <th>Loading Date</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Vessel</th>
                                <th>Status</th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($transactions as $index => $transaction)
                                @if($transaction->status==0)
                                  @php ($status='Process')
                                @else
                                  @php ($status='Success')
                                @endif

                                @if($transaction->loading_date==NULL)
                                  @php ($loading_date='')
                                @else
                                  @php ($loading_date=$transaction->loading_date->format('d/m/Y'))
                                @endif

                                <tr>
                                  <td>{{ $index+1 }}</td>
                                  <td>{{ strtoupper($transaction->trans_no) }}</td>
                                  <td>{{ $transaction->resi_no}}</td>
                                  <td>{{ $loading_date }}</td>
                                  <td>{{ $transaction->location_from }}</td>
                                  <td>{{ $transaction->location_to }}</td>
                                  <td>{{ $transaction->name_pelayaran.' - '.$transaction->alias }}</td>
                                  <td>{{ $status }}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                      </div>
                    </div><!-- /.card-body -->
                  </div>
                  <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<div id="detailtrans_hide" style="display:none;">
  <div class="dragArea row">
    <div class="col-md-3  form-group">
      <label class="form-control-label mbr-fonts-style display-7">Consignee / Penerima</label>
      <input type="text" name="consignee[]" required="required" value="" class="form-control display-7" id="consignee">
    </div>
    <div class="col-md-3  form-group">
        <label class="form-control-label mbr-fonts-style display-7">Comodity / Barang</label>
        <input type="text" id="comodity" name="comodity[]" class="form-control display-7">
    </div>
    <div class="col-md-2  form-group">
        <label class="form-control-label mbr-fonts-style display-7">Weight</label>
        <input type="number" id="weight" name="weight[]" class="form-control display-7">
    </div>
    <div class="col-md-3  form-group">
        <label class="form-control-label mbr-fonts-style display-7">Unit Weight</label>
        <select class="form-control display-7" id="unitweight" name="unitweight[]" required="required">
          <option value="#" selected="true" disabled="disabled">--- Select Unit Weight ---</option>
          <option value="kg">Kilogram (Kg)</option>
          <option value="ton">Tonase (Ton)</option>
          <option value="kubik">Kubik</option>
        </select>
    </div>
    <div class="col-md-1  form-group">
        <label class="form-control-label mbr-fonts-style display-7">Action</label>
        <button type="button" id="del_detail" class="btn btn-form" style="background:red; color: #FFF; padding:0.5rem;">Del</button>
    </div>
  </div>
</div>

@endsection
