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
          <form method="POST" action="/bo_cs_de_profil/cari" role="search">
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
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabah1" placeholder="Masukkan Nama Nasabah">
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
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Nasabah yang sudah tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nasabah ID</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>TTL</th>
                <th>Jenis Kelamin</th>
                <th>Ibu Kandung</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($nasabahs as $index => $nasabah)
                  @if($nasabah->Black_List==0)
                    @php ($status='Aktif')
                  @elseif($nasabah->Black_List==1)
                    @php ($status='Blokir')
                  @else
                    @php ($status='Tidak Aktif')
                  @endif
                  @if($nasabah->tgllahir==NULL)
                    @php ($tgllahir='')
                  @else
                    @php ($tgllahir=$nasabah->tgllahir->format('d/m/Y'))
                  @endif
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($nasabah->nasabah_id) }}</td>
                  <td>{{ $nasabah->nama_nasabah }}</td>
                  <td>{{ strtoupper($nasabah->alamat.' '.$nasabah->kelurahan.' '.$nasabah->kecamatan) }}</td>
                  <td>{{ $nasabah->tempatlahir.', '.$tgllahir }}</td>
                  <td>{{ $nasabah->jenis_kelamin }}</td>
                  <td>{{ $nasabah->ibu_kandung }}</td>
                  <td>{{ $status }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <form method="post" action="/bo_cs_de_profil/detail">
                      @csrf
                        <input type="hidden" name="idnasabah" value="{{ trim($nasabah->nasabah_id) }}" class="form-control">
                        <input type="hidden" name="idnasabahhash" value="{{ md5(trim($nasabah->nasabah_id).'Bast90') }}" class="form-control">
                        <button type="submit" tabindex="-1" class="dropdown-item">
                            Detail Profil
                        </button>
                      </form>
                      <a class="dropdown-item" href="{{ route('cetakprofilnasabah',['printprofilnasabah'=>trim($nasabah->nasabah_id)])}}" target="_blank" style="float: right;"> Print Profil</a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Nasabah ID</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>TTL</th>
                <th>Jenis Kelamin</th>
                <th>Ibu Kandung</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </tfoot>
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
