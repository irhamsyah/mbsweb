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
        {{-- MUNCULKAN ERROR SAAT VALIDATE LARAVEL --}}
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
          {{$error}}
        </div>
        @endforeach
        @endif
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Bunga Desposito dan Pajak</h3>
          </div>
          {{-- Proses export browse bunga pajak --}}
          <input type="hidden" name="tes" values="dfsdsfs">
          <div class="row form-group">
            <div class="col-4" style="margin-left:450px;margin-top:10px">
              <a class="btn btn-danger" href="/exportbngpjkdeposito" role="button">Export</a>
            </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
                <tr>
                  @if(Auth::user()->privilege=='admin')

                  <th>No Rekening</th>
                  <th>Nama Nasabah</th>
                  <th>Bunga</th>
                  <th>Pajak</th>
                  <th>Titipan</th>
                  <th>Suku Bunga</th>
                  <th>Saldo Nominatif</th>
                  <th>Tgl Valuta</th>
                  <th>Action</th>
                  @else
                  <th>No Rekening</th>
                  <th>Nama Nasabah</th>
                  <th>Bunga</th>
                  <th>Pajak</th>
                  <th>Titipan</th>
                  <th>Suku Bunga</th>
                  <th>Saldo Nominatif</th>
                  <th>Tgl Valuta</th>
                  @endif
                </tr>
              </thead>
              @if(is_null(Auth::user()))
              <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @else
              @if(Auth::user()->privilege=='admin')
              <tbody>
                @php($index=0)
                @php($n=0)
                @foreach($brwsebngpjk as $values)
                @php($index++)
                <tr>
                  <td>{{ $values->NO_REKENING }}</td>
                  <td>{{ $values->nama_nasabah}}</td>
                  <td>{{ number_format($values->BUNGA_BLN_INI,2)}}</td>
                  <td>{{ number_format($values->PAJAK_BLN_INI,2)}}</td>
                  <td>{{ number_format($values->TITIPAN_AKHIR,2)}}</td>
                  <td>{{ number_format($values->SUKU_BUNGA,2)}}</td>
                  <td>{{ number_format($values->SALDO_AKHIR,2)}}</td>
                  <td>{{ $values->TGL_VALUTA}}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="#" tabindex="-1" class="dropdown-item" data-toggle="modal"
                        data-target="#modal-update-bungpajakdep" data-no_rekening="{{ $values->NO_REKENING}}"
                        data-nama_nasabah="{{$values->nama_nasabah}}" data-bunga_bln_ini="{{$values->BUNGA_BLN_INI}}"
                        data-pajak_bln_ini="{{$values->PAJAK_BLN_INI}}">
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
                  <td>{{ $values->NO_REKENING }}</td>
                  <td>{{ $values->nama_nasabah }}</td>
                  <td>{{ number_format($values->BUNGA_BLN_INI,2)}}</td>
                  <td>{{ number_format($values->PAJAK_BLN_INI,2)}}</td>
                  <td>{{ number_format($values->TITIPAN_AKHIR,2)}}</td>
                  <td>{{ number_format($values->SUKU_BUNGA,2)}}</td>
                  <td>{{ number_format($values->SALDO_AKHIR,2)}}</td>
                  <td>{{ $values->TGL_VALUTA}}</td>

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
  <div class="modal fade" id="modal-update-bungpajakdep">
    <div class="modal-dialog modal-xl">
      <form action="/bo_dep_update_bngpjk" method="post" enctype="multipart/form-data">
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
                {{-- <div class="col-lg-3 col-sm-6">
                  <label for="nasabahid">Admin Bukan ini</label>
                  <input type="text" name="adm_bln_ini" class="form-control">
                </div> --}}
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