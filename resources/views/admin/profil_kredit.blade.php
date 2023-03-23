@extends('layouts.admin_main')

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
            <h3 class="card-title">Detail Profil Nasabah yang sudah tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Produk</th>
                <th>No Rekening</th>
                <th>Saldo Awal</th>
                <th>Saldo Saat Ini</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($kredits as $index => $kredit)
                @if($jenisprofil=='kredit')
                    @php ($saldoawal='POKOK_SALDO_REALISASI')
                    @php ($saldoakhir='POKOK_SALDO_AKHIR')
                    @php ($deskripsi='DESKRIPSI_JENIS_KREDIT')
                @elseif($jenisprofil=='tabung')
                    @php ($saldoawal=0)
                    @php ($saldoakhir='SALDO_AKHIR')
                    @php ($deskripsi='DESKRIPSI_JENIS_TABUNGAN')
                @endif
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($kredit->$deskripsi) }}</td>
                  <td>{{ $kredit->NO_REKENING }}</td>
                  <td>{{ $kredit->$saldoawal }}</td>
                  <td>{{ $kredit->$saldoakhir }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                    <form method="post" action="/bo_cs_de_profil/kredit">
                      @csrf
                        <input type="hidden" name="idkredit" value="{{ trim($kredit->NO_REKENING) }}" class="form-control">
                        <input type="hidden" name="idnasabah" value="{{ trim($kredit->nasabah_id) }}" class="form-control">
                        <button type="submit" tabindex="-1" class="dropdown-item">
                            Lihat Detail
                        </button>
                      </form>
                    </div>
                  </td>
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
