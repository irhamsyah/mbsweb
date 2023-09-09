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

@php 
if($filter!=''){
    $pecahFilter = explode('|', $filter);
    $filteridnasabah=$pecahFilter[0];
    $filternamanasabah=$pecahFilter[1];
    $filternorekening=$pecahFilter[2];

}else{
    $filteridnasabah='';
    $filternamanasabah='';
    $filternorekening='';
}
@endphp
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_cs_rp_tabungan/cari" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="idnasabah1">Id Nasabah</label> 
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnasabah1" name="idnasabah1" value="{{ $filteridnasabah }}" placeholder="Masukkan ID Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">Nama Nasabah</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabah1" value="{{ $filternamanasabah }}" placeholder="Masukkan Nama Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="norekening1">No Rekening</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="norekening1" name="norekening1" value="{{ $filternorekening }}" placeholder="Masukkan Nomor Rekening">
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
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>No Rekening</th>
                <th>Nama Debitur</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Jenis Tabungan</th>
                <th>Saldo Saat Ini</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($tabungans as $index => $tabungan)
                  @if($tabungan->tgllahir==NULL)
                    @php ($tgllahir='')
                  @else
                    @php ($tgllahir=$tabungan->tgllahir->format('d/m/Y'))
                  @endif
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ strtoupper($tabungan->NO_REKENING) }}</td>
                  <td>{{ $tabungan->nama_nasabah }}</td>
                  <td>{{ strtoupper($tabungan->alamat.' '.$tabungan->kelurahan.' '.$tabungan->kecamatan) }}</td>
                  <td>{{ $tabungan->Deskripsi_Kota }}</td>
                  <td>{{ $tabungan->JENIS_TABUNGAN }}</td>
                  <td>{{ $tabungan->SALDO_AKHIR }}</td>
                  <td>
                    <a href="{{ route('cetakcovertab',['inputIdNasabahprint'=>$tabungan->nasabah_id,'inputNoRekprint'=>$tabungan->NO_REKENING])}}" target="_blank" class="btn btn-sm btn-danger"> <i class="fa fa-print" style="color:white"></i> Cover Butab</a>
                    <form action="/bo_cs_rp_tabungan/buktisetortab" method="post" style="margin-bottom: 0;">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print" style="color:white"></i> Bukti Setor</button>
                        <input type="hidden" name="inputIdNasabahprint" value="{{ $tabungan->nasabah_id }}" class="form-control">
                        <input type="hidden" name="inputNoRekprint" value="{{ $tabungan->NO_REKENING }}" class="form-control">
                        <input type="hidden" name="_method" value="POST"/>
                        @csrf
                    </form>
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
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection