@extends('layouts.admin_main')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>
<style>
  table {
    text-align: right;
    position: relative;

  }

  th {
    position: sticky;
    top: 0px;
    background-color: #fff;
    /* Prevents header from becoming transparent */
    /* Ensures the header stays on top of other content */
  }

  tfoot {
    position: sticky;
    bottom: 0px;

  }
</style>
@section('content')
@if($msgstatus!=''){
@if($msgstatus=='1'){
@php $statusmsg='success'; $titlemsg='Successfully'; $msgview='Proses Berhasil' @endphp;
}
@else{
@php $statusmsg='error'; $titlemsg='Error!'; $msgview='Proses Gagal!' @endphp;
}
@endif

<script>
  Swal.fire(
      '{{ $titlemsg }}',
      '{{ $msgview }}',
      '{{ $statusmsg }}'
    )
</script>
}
@endif

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Posisi Kas Teller & Transaksi</h3>
          </div>
          <form method="POST" action="bo_tl_lp_caritransaksikas">
            <div class="row form-group">
              @csrf
              <div class="mx-auto col-md-3 col-sm-12">
                <label for="inputDate1">Mulai Tanggal</label>
                <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                  <input type="text" name="tgl_trans1" class="form-control datetimepicker-input"
                    data-target="#idtglnominatif1" />
                  <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
                <label for="inputDate1">Sampai Tanggal</label>
                <div class="input-group date" id="idtglnominatif2" data-target-input="nearest">
                  <input type="text" name="tgl_trans2" class="form-control datetimepicker-input"
                    data-target="#idtglnominatif2" />
                  <div class="input-group-append" data-target="#idtglnominatif2" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="mx-auto col-md-3 col-sm-12">
                <input type="submit" class="btn-lg btn-danger form-control">
              </div>
            </div>
          </form>
          @if(isset($tgl_trans1))
          <div class="container">
            <div class="col-lg-3 col-sm-6" style="float: right">
              <label for="">Saldo Awal</label>
              <input readonly type="text" class="form-control" value=<?php if(is_null($saldoawalkas)){ echo
                number_format(0,2,",",".") ; }else { echo number_format($saldoawalkas,2,",","."); } ?>
              style="font-size:14pt;text-align:right">
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example" class="table" width="100" style="font-size:10pt">
              <thead class="thead-dark">
                <tr>
                  <th>No</th>
                  <th>Modul</th>
                  <th>Tanggal</th>
                  <th>Kuitansi</th>
                  <th>Keterangan</th>
                  <th>TOB</th>
                  <th>OB-Debet</th>
                  <th>OB-Kredit</th>
                  <th>Debet</th>
                  <th>Kredit</th>
                </tr>
              </thead>
              @if(is_null(Auth::user()))
              <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @else
              <tbody>
                @php($index=0)
                @php($obdebet=0)
                @php($obkredit=0)
                @php($tdebet=0)
                @php($tkredit=0)
                @foreach($trskas as $values)
                @php($index++)
                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ $values->modul}}</td>
                  <td>{{ $values->tgl_trans }}</td>
                  <td>{{ $values->NO_BUKTI }}</td>
                  <td>{{ $values->uraian }}</td>
                  <td>{{ $values->tob }}</td>
                  @if($values->tob=='O' && $values->my_kode_trans == '200')
                  <td>{{ number_format($values->saldo_trans,"2",".",",") }}</td>
                  @php($obdebet=$obdebet+$values->saldo_trans)
                  @else
                  <td>0</td>
                  @endif
                  @if($values->tob=='O' && $values->my_kode_trans == '300')
                  <td>{{ number_format($values->saldo_trans,"2",".",",") }}</td>
                  @php($obkredit=$obkredit+$values->saldo_trans)
                  @else
                  <td>0</td>
                  @endif
                  @if($values->tob=='T' && $values->my_kode_trans == '200')
                  <td>{{ number_format($values->saldo_trans,"2",".",",") }}</td>
                  @php($tdebet=$tdebet+$values->saldo_trans)
                  @else
                  <td>0</td>
                  @endif
                  @if($values->tob=='T' && $values->my_kode_trans == '300')
                  <td>{{ number_format($values->saldo_trans,"2",".",",") }}</td>
                  @php($tkredit=$tkredit+$values->saldo_trans)
                  @else
                  <td>0</td>
                  @endif
                </tr>
                @endforeach
              </tbody>
              <tfoot style="background-color: black">
                <tr>
                  <td colspan="6"></td>
                  <td style="color:white">Saldo Debet</td>
                  <td style="color:white">Saldo Kredit</td>
                  <td style="color:white">Saldo Debet</td>
                  <td style="color:white">Saldo Kredit</td>
                </tr>
                <tr>
                  <td colspan="6"></td>
                  <td style="color:rgb(18, 248, 18);">{{number_format($obdebet,2,".",".")}}</td>
                  <td style="color:rgb(252, 72, 72)">{{number_format($obkredit,2,".",".")}}</td>
                  <td style="color:rgb(11, 250, 11)">{{number_format($tdebet,2,".",".")}}</td>
                  <td style="color:rgb(253, 54, 54)">{{number_format($tkredit,2,".",".")}}</td>
                </tr>
                <tr>
                  <td colspan="8">
                  </td>
                  <td style="color:white;">Saldo Akhir : </td>
                  @if(is_null($saldoawalkas))
                  @php($saldoawalkas=0)
                  @endif
                  <td style="color:rgb(18, 248, 18);">{{number_format(($saldoawalkas+$tdebet-$tkredit),2,".",".")}}</td>

                  </td>
                </tr>

              </tfoot>
              @endif
            </table>
            <div class="container">
              <div class="form-group">
                <div class="row">
                  <a href="{{route('pdfkasrinci',['saldoawalkas'=>$saldoawalkas,'tgl_trans1'=>$tgl_trans1,'tgl_trans2'=>$tgl_trans2])}}"
                    class="btn-lg btn-success">
                    <i class="fa fa-print" aria-hidden="true">
                      Cetak
                    </i>
                  </a>
                  <a href="{{route('exportkasrinci',['saldoawalkas'=>$saldoawalkas,'tgl_trans1'=>$tgl_trans1,'tgl_trans2'=>$tgl_trans2])}}"
                    class="btn-lg btn-danger">
                    <i class="fa fa-print" aria-hidden="true">
                      Export Excel
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endif
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  {{-- MODAL EDIT/UPDATE DATA tabungan --}}


</div>
<!-- /.content -->
@endsection