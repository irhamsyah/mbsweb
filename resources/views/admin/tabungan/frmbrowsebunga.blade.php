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
            <h3 class="card-title">Bunga Tabungan dan Pajak</h3>
          </div>
          {{-- @php(dd($brwsebngpjk)) --}}
          <form method="post" action="{{route('exporttoexcelbungapajaktabungan',['caribunga'=>$brwsebngpjk])}}">
            @csrf
            <input type="hidden" name="tes" values="dfsdsfs">
            <div class="row form-group">
              <div class="col-4" style="margin-left:450px;margin-top:10px">
                <button type="submit" class="btn btb-lg btn-warning">Export</button>
              </div>
            </div>
  
          </form>

          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
              <tr>
                <th>No</th>
                <th>No Rekening</th>
                <th>Nama Nasabah</th>
                <th>Bunga</th>
                <th>Pajak</th>
                <th>Administrasi</th>
                <th>Saldo Efektif</th>
                <th>Saldo Pajak</th>
                <th>Saldo Nominatif</th>
                <th>Saldo Akhir</th>
                <th>Action</th>

              </tr>
              </thead>
              @if(is_null(Auth::user()))
                <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @else 
              @if(Auth::user()->privilege=='admin')
              <tbody>
              @php($index=0)
              @foreach($brwsebngpjk as $values)
              @php($index++)
                <tr>
                  <td>{{ $index}}</td>
                  <td>{{ $values->no_rekening }}</td>
                  <td>{{ $values->nasabah->nama_nasabah }}</td>
                  <td>{{ number_format($values->bunga_bln_ini,2)}}</td>
                  <td>{{ number_format($values->pajak_bln_ini,2)}}</td>
                  <td>{{ number_format($values->adm_bln_ini,2)}}</td>
                  <td>{{ number_format($values->saldo_efektif_bln_ini,2)}}</td>
                  <td>{{ number_format($values->saldo_hitung_pajak,2)}}</td>
                  <td>{{ number_format($values->saldo_nominatif,2)}}</td>
                  <td>{{ number_format($values->saldo_akhir,2)}}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-update-bungpajaktab"
                      data-no_rekening="{{ $values->no_rekening}}"
                      data-nama_nasabah="{{$values->nasabah->nama_nasabah}}"
                      data-bunga_bln_ini="{{$values->bunga_bln_ini}}"
                      data-pajak_bln_ini="{{$values->pajak_bln_ini}}"
                      data-adm_bln_ini="{{$values->adm_bln_ini}}"
                      >
                          Detail & Update
                      </a>
                    </div>
                  </td>                
                </tr>
              @endforeach
              </tbody>
                @else
                <tbody>
                  @php($index=0)
                  @foreach($brwsebngpjk as $values)
                  @php($index++)
                    <tr>
                      <td>{{ $index}}</td>
                      <td>{{ $values->no_rekening }}</td>
                      <td>{{ $values->nasabah->nama_nasabah }}</td>
                      <td>{{ $values->bunga_bln_ini}}</td>
                      <td>{{ $values->pajak_bln_ini}}</td>
                      <td>{{ $values->adm_bln_ini}}</td>
                      <td>{{ $values->saldo_efektif_bln_ini}}</td>
                      <td>{{ $values->saldo_hitung_pajak}}</td>
                      <td>{{ $values->saldo_nominatif}}</td>
                      <td>{{ $values->saldo_akhir}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  @endif
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
      <div class="modal fade" id="modal-update-bungpajaktab">
        <div class="modal-dialog modal-xl">
          <form action="/bo_adm_update_bngpjk" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Update Bunga dan pajak</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Baris ke 1 EDIT kodetrans ----->
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-sm-6">
                      <label for="norek">No Rekening</label>
                        <input readonly type="text" name="no_rekening" class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="inputopendate">Nama Nasabah</label>
                      <input readonly type="text" name="nama_nasabah" class="form-control" id="editidnasabah">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="inputnasabahid">Bunga Bulan Ini</label>
                      <input type="text" name="bunga_bln_ini" class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="nasabahid">Pajak Bukan ini</label>
                        <input type="text" name="pajak_bln_ini" class="form-control">
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="nasabahid">Admin Bukan ini</label>
                        <input type="text" name="adm_bln_ini" class="form-control">
                    </div>
                  </div>            
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
            <!-- /.modal-content -->
            @csrf
          </form>
        </div>
        <!-- /.modal-dialog -->
    </div>        

</div>
<!-- /.content -->
@endsection
