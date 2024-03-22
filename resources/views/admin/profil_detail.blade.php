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
            <h3 class="card-title">Detail Profil Nasabah yang sudah tercatat </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example3" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Produk</th>
                <th>No Rekening</th>
                <th>Saldo Awal</th>
                <th>Saldo Saat Ini</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($tabungans as $index => $tabungan)
                <tr>
                  <td>{{ strtoupper($tabungan->DESKRIPSI_JENIS_TABUNGAN) }}</td>
                  <td>{{ $tabungan->NO_REKENING }}</td>
                  <td>0</td>
                  <td>{{ $tabungan->SALDO_AKHIR }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                    <form method="post" action="/bo_cs_de_profil/kredit">
                      @csrf
                        <input type="hidden" name="jenisprofil" value="tabungan" class="form-control">
                        <input type="hidden" name="idkredit" value="{{ trim($tabungan->NO_REKENING) }}" class="form-control">
                        <input type="hidden" name="idnasabah" value="{{ trim($tabungan->NASABAH_ID) }}" class="form-control">
                        <button type="submit" tabindex="-1" class="dropdown-item">
                            Detail Tabungan
                        </button>
                      </form>
                      <a class="dropdown-item" href="{{ route('cetakspicemen',['printnorekening'=>$tabungan->NO_REKENING])}}" target="_blank"> Print Spicemen</a>
                    </div>
                  </td>
                </tr>
                @endforeach
                @foreach($kredits as $index => $kredit)
                <tr>
                  <td>{{ strtoupper($kredit->DESKRIPSI_JENIS_KREDIT) }}</td>
                  <td>{{ $kredit->NO_REKENING }}</td>
                  <td>{{ $kredit->POKOK_SALDO_REALISASI }}</td>
                  <td>{{ $kredit->POKOK_SALDO_AKHIR }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                    <form method="post" action="/bo_cs_de_profil/kredit">
                      @csrf
                        <input type="hidden" name="jenisprofil" value="kredit" class="form-control">
                        <input type="hidden" name="idkredit" value="{{ trim($kredit->NO_REKENING) }}" class="form-control">
                        <input type="hidden" name="idnasabah" value="{{ trim($kredit->NASABAH_ID) }}" class="form-control">
                        <button type="submit" tabindex="-1" class="dropdown-item">
                            Detail Kredit
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
