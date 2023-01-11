@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Transaction Detail</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-11 col-sm-10">
              </div>
              <div class="col-lg-1 col-sm-2">
                <a href="/adm_transaction"><button type="button" class="btn btn-block btn-outline-primary">Back</button></a>
              </div>
            </div>
            @foreach($transactions as $index => $transaction)
            @if($transaction->loading_date==NULL)
              @php ($loading_date='')
            @else
              @php ($loading_date=$transaction->loading_date->format('d F Y'))
            @endif
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTransactionNo">Transaction No</label>
                  <input type="text" name="inputTransactionNo" value="{{ $transaction->trans_no }}" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputResi">Resi No</label>
                  <input type="text" name="inputResi" value="{{ $transaction->resi_no }}" readonly class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputDate">Departing Date</label>
                  <input type="text" name="inputDate" value="{{ $loading_date }}" readonly class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <label for="inputFrom">From</label>
                  <input type="text" name="inputFrom" value="{{ $transaction->location_from }}" readonly class="form-control">
                </div>
                <div class="col-lg-6 col-sm-12">
                  <label for="inputTo">To</label>
                  <input type="text" name="inputTo" value="{{ $transaction->location_to }}" readonly class="form-control">
                </div>
              </div>
            </div>
            @endforeach
            <h4 style="background:#000; color:#FFF;"><center>List Comodity</center></h4>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Comodity</th>
                <th>Weight</th>
                <th>Consignee</th>
              </tr>
              </thead>
              <tbody>
                @foreach($transactiondetails as $index => $transactiondetail)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ strtoupper($transactiondetail->comodity) }}</td>
                    <td>{{ strtoupper($transactiondetail->weight.' '.$transactiondetail->unit_weight) }}</td>
                    <td>{{ strtoupper($transactiondetail->consignee) }}</td>
                  </tr>
                @endforeach
              </tbody>
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
</div>
<!-- /.content -->
@endsection
