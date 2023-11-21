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
      <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_cs_de_nasabah/cari" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="idnasabah1">Id Nasabah</label> 
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnasabah1" name="idnasabah1" placeholder="Masukkan ID Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">Nama Nasabah</label>
                </div>     
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabah1" data-action="getProfileNasabah.php" placeholder="Masukkan Nama Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="noktp1">No KTP</label>
                </div>
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="noktp1" name="noktp1" placeholder="Masukkan No KTP">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-3"></div>
                <div class="col-3">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-nasabah" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Kredit yang sudah tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example3" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Nama Nasabah</th>
                <th>Produk</th>
                <th>No Rekening</th>
                <th>Saldo Awal</th>
                <th>Saldo Saat Ini</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
               
                @foreach($kredits as $index => $kredit)
                <tr>
                  <td>{{ $kredit->nama_nasabah }}</td>
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
