@extends('layouts.admin_main')

@section('content')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="container-fluid">
    <h5>Pencetakan Daftar Perkiraan</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            @csrf
            <form method="POST" action="/bo_ex_daftarperkiraan">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              @csrf
              <button type="submit" class="btn btn-primary" style="margin-left:60px;">
                <i class="fa fa-book">&nbsp;Export</i>
              </button>
              <a href="{{ route('pdfperkiraan')}}" class="btn btn-md btn-danger"><i class="fa fa-print">&nbsp;Cetak</i></a>
            </div>
            </form>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="perkiraandata" class="display" width="100%">
              <thead>
              <tr>
                <th>Kode_Perk</th>
                <th>Kode_Alt </th>
                <th>Nama_Perk</th>
                <th>Level </th>
                <th>Type </th>
              </tr>
              </thead>
              <tbody>
                @foreach($perkiraan as $values)
                <tr>
                  <td>{{ $values->kode_perk }}</td>
                  <td>{{ $values->kode_alt }}</td>
                  <td>{{ $values->nama_perk }}</td>
                  <td>{{ $values->level }}</td>
                  <td>{{ $values->type }}</td>
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
