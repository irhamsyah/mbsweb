@extends('layouts.admin_main')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

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
            <h3 class="card-title">Petty Cash Teller</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Trans_id</th>
                  <th>Modul</th>
                  <th>Modul_Id</th>
                  <th>Tgl_trans</th>
                  <th>Kode</th>
                  <th>Saldo</th>
                  <th>No Bukti</th>
                  <th>Uraian</th>
                  <th>TOB</th>
                  <th>Action</th>
                </tr>
              </thead>
              @if(is_null(Auth::user()))
              <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @else
              <tbody>
                @php($index=0)
                @foreach($trskas as $values)
                @php($index++)
                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ $values->trans_id }}</td>
                  <td>{{ $values->modul}}</td>
                  <td>{{ $values->modul_trans_id }}</td>
                  <td>{{ $values->tgl_trans }}</td>
                  <td>{{ $values->kode_jurnal }}</td>
                  <td>{{ $values->saldo_trans }}</td>
                  <td>{{ $values->NO_BUKTI }}</td>
                  <td>{{ $values->uraian }}</td>
                  <td>{{ $values->tob }}</td>
                  <td>
                    <form action="bo_tl_ku_hapustransaksikas" method="POST" style="margin-bottom: 0;">
                      @csrf
                      <input type="hidden" name="trans_id" value="{{ $values->trans_id }}" class="form-control">
                      <input type="hidden" name="modul_trans_id" value="{{ $values->modul_trans_id }}"
                        class="form-control">
                      <input type="hidden" name="modul" id="idmodul" value="{{ $values->modul }}" class="form-control">
                      <input type="hidden" name="_method" value="delete">
                      @if ($values->modul=='PC')
                      <button type="submit" id="Idbtndel" class="btn btn-sm btn-danger" style="float: right;">
                        <i class="fa fa-trash"></i>
                      </button>
                      @elseif($values->modul=='DEP')
                      <button type="button" id="Idbtndel" class="btn btn-sm btn-danger" style="float: right;"
                        onclick="alert('Hapus Data Lewat Modul DEPOSITO')">
                        <i class="fa fa-trash"></i>
                      </button>
                      @elseif($values->modul=='TAB')
                      <button type="button" id="Idbtndel" class="btn btn-sm btn-danger" style="float: right;"
                        onclick="alert('Hapus Data Lewat Modul TABUNGAN')">
                        <i class="fa fa-trash"></i>
                      </button>
                      @else
                      <button type="button" id="Idbtndel" class="btn btn-sm btn-danger" style="float: right;"
                        onclick="alert('Hapus Data Lewat Modul KREDIT')">
                        <i class="fa fa-trash"></i>
                      </button>
                      @endif
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
              @endif
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
  {{-- MODAL EDIT/UPDATE DATA tabungan --}}


</div>
<!-- /.content -->
@endsection