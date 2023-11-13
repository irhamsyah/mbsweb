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
            <h3 class="card-title">TRANS MASTER BUFFER</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
              <tr>
                <th>No</th>
                <th>Trans_id</th>
                <th>Tgl trans</th>
                <th>kode jurnal</th>
                <th>No Bukti</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>Action</th>

              </tr>
              </thead>
              @if(is_null(Auth::user()))
                <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @else 
              <tbody>
              @php($index=0)
              @foreach($brwsetransmasterbuff as $values)
              @php($index++)
                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ $values->trans_id }}</td>
                  <td>{{ $values->tgl_trans }}</td>
                  <td>{{ $values->kode_jurnal }}</td>
                  <td>{{ $values->no_bukti }}</td>
                  <td>{{ $values->nominal }}</td>
                  <td>{{ $values->keterangan }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="{{route('caritrans',['trans_id'=>$values->trans_id])}}" tabindex="-1" class="dropdown-item"
                      >
                          Validasi
                      </a>
                    </div>
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
