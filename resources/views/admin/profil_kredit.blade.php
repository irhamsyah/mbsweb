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
            <h3 class="card-title">Detail Data {{ ucwords($jenisprofil) }} Nasabah</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
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
            @endforeach
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputdinedit">Saldo Awal</label>
                        <input type="text" name="inputdinedit" value="{{ $kredit->$saldoawal }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputopendateedit">Open Date</label>
                        <input type="text" name="inputopendateedit" value="{{ date('Y-m-d') }}" readonly class="form-control">
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahidedit">Saldo Akhir</label>
                        <input type="text" name="inputnasabahidedit" value="{{ $kredit->$saldoakhir }}" readonly class="inputnasabahidedit form-control">
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputcabedit">Jenis</label>
                        <input type="text" name="inputcabedit" readonly value="{{ $kredit->$deskripsi }}" class="inputcabedit form-control">
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnocifedit">No Rekening</label>
                        <input type="text" name="inputnocifedit" value="{{ $kredit->NO_REKENING }}" readonly class="inputnocifedit form-control">
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputblacklistedit">Nasabah ID</label>
                        <input type="text" name="inputblacklistedit" value="{{ $kredit->NASABAH_ID }}" class="form-control">
                    </div>
                </div>
            </div>
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
