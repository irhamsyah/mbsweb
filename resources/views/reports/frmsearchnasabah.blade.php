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
    $filterjenisnasabah=$pecahFilter[2];

}else{
    $filteridnasabah='';
    $filternamanasabah='';
    $filterjenisnasabah='';
}
@endphp
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_cs_rp_nasabah/cari" role="search">
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
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabah1" value="{{$filternamanasabah}}" placeholder="Masukkan Nama Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="jenisnasabah1">Jenis Nasabah</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="jenisnasabah1" name="jenisnasabah1" value="{{$filterjenisnasabah}}" placeholder="Masukkan Jenis Nasabah">
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
          <div style="float:right;">
            <form action="/bo_cs_rp_nasabah/exportnasabah" method="post" style="margin-bottom: 0;" target="print_popup"  onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-table" style="color:white"></i> Export</button>
                <input type="hidden" name="exportidnasabah" value="{{ $filteridnasabah }}" class="form-control">
                <input type="hidden" name="exportnamanasabah" value="{{ $filternamanasabah }}" class="form-control">
                <input type="hidden" name="exportjenisnasabah" value="{{ $filterjenisnasabah }}" class="form-control">
                <input type="hidden" name="_method" value="POST"/>
                @csrf
                <a href="{{ route('cetaknasabah',['printidnasabah'=>$filteridnasabah,'printnamanasabah'=>$filternamanasabah,'printjenisnasabah'=>$filterjenisnasabah])}}" target="_blank" class="btn btn-sm btn-danger"> <i class="fa fa-print" style="color:white"></i> Nasabah</a>
            </form>
            
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>No Nasabah</th>
                <th>Nama Debitur</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>No Telp</th>
                <th>TTL</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($nasabahs as $index => $nasabah)
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
                  <td>{{ $nasabah->Deskripsi_Kota }}</td>
                  <td>{{ $nasabah->telpon }}</td>
                  <td>{{ $nasabah->tempatlahir.', '.$tgllahir }}</td>
                  <td>
                    <a href="{{ route('cetaknasabahamplop',['inputIdNasabahprint'=>$nasabah->nasabah_id])}}" target="_blank" class="btn btn-sm btn-danger"> <i class="fa fa-print" style="color:white"></i> Amplop</a>
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