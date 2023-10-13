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
            <h3 class="card-title">TRANS DETAIL BUFFER</h3>
            <div class="col-lg-3 col-sm-3" style="float:right;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-kodeperk" style="float: right;">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
              <tr>
                <th>Trans_id</th>
                <th>Uraian</th>
                <th>Kode Perk</th>
                <th>Nama Perkiraan</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Action</th>
              </tr>
              </thead>
              @if(is_null(Auth::user()))
                <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @else 
              <tbody>
              @php($index=0)
              @foreach($detail as $values)
                <tr>
                  @php($master_id = $values->master_id)    
                  <td>{{ $values->trans_id}}</td>
                  <td>{{ $values->URAIAN }}</td>
                  <td>{{ $values->kode_perk }}</td>
                  <td>{{ $values->perkiraan->nama_perk }}</td>
                  <td>{{ $values->debet }}</td>
                  <td>{{ $values->kredit }}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="" tabindex="-1" class="dropdown-item" data-toggle="modal" data-target="#modal-update-kodeperk"
                        data-trans_id="{{$values->trans_id}}"
                        data-master_id="{{$values->master_id}}"
                        data-uraian="{{$values->URAIAN}}"
                        data-kode_perk="{{$values->kode_perk}}"
                        data-nama_perk="{{ $values->perkiraan->nama_perk }}"
                        data-type="{{ $values->perkiraan->type }}"
                          >
                          Update
                        </a>
                        <form method="post" action="/bo_ak_tt_deltransdetailbuff" style="margin-bottom: 0;" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            <input type="hidden" name="trans_id" value="{{$values->trans_id}}">
                            <input type="hidden" name="master_id" value="{{$values->master_id}}">
                            <button type="submit" tabindex="-1" class="dropdown-item">
                                Delete
                              </button>
                                  <input type="hidden" name="_method" value="DELETE"/>
                              @csrf
                        </form>
                        </div>
                  </td>                
                </tr>
              @endforeach
              </tbody>
              @endif
            </table>
          </div>
          <form method="POST" action="/bo_ak_tt_simpanjurnal">
            @csrf
            <input type="hidden" name="master_id" value="{{$master_id}}">
          <div class="form-group">
            <a href="{{route('showformvalidasidatatransaksi')}}" class="btn btn-primary btn-mdm" tabindex="-1" role="button">Back</a>
            <button class="btn btn-primary btn-md" tabindex="-1" type="submit">Save</button>
          </div>
        </form>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
        {{-- MODAL EDIT/UPDATE DATA TRANS_DETAIL_BUFFER --}}
        <div class="modal fade" id="modal-update-kodeperk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-update-kodeperkLabel">Ubah Kode Perkiraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{route('simpanperubahankodeperk')}}">
                <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <input hidden type="text" name="trans_id">
                                <input hidden type="text" name="master_id">
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Uraian</label>
                                    <input type="text" name="uraian" class="form-control" id="iduraian">
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="nasabahid">Kode Perkiraan</label>
                                    <div class="input-group date" data-target-input="nearest">
                                    <input id="idkodeperk" type="text" name="kode_perk" readonly class="form-control" required>
        
                                    <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraan">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Nama Perkiraan</label>
                                    <input type="text" id="idnamaperk" name="nama_perk" class="form-control" id="salmin">
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Type</label>
                                    <input type="text" name="type" class="form-control" id="idtype">
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>

            </div>
            </div>
        </div>
        {{-- MODAL TAMBAH RECORD DI TRANS_DETAIL_BUFFER --}}
        <div class="modal fade" id="modal-add-kodeperk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-add-kodeperkLabel">Add Trans Detail Buff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{route('addcodetransdetailbuff')}}">
                <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <input hidden type="number" name="master_id2" value="{{$master_id2}}">
                                <input hidden type="text" name="type" id="idtypex">
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Uraian</label>
                                    <input type="text" name="uraian" class="form-control" id="iduraian">
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="nasabahid">Kode Perkiraan</label>
                                    <div class="input-group date" data-target-input="nearest">
                                    <input id="idkodeperk2" type="text" name="kode_perk" readonly class="form-control" required>
        
                                    <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraan">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Nama Perkiraan</label>
                                    <input type="text" id="idnamaperk2" name="nama_perk" class="form-control" id="salmin">
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Debet</label>
                                    <input type="number" name="debet" class="form-control" value=0>
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Kredit</label>
                                    <input type="number" name="kredit" class="form-control" value=0>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>

            </div>
            </div>
        </div>
        {{-- MODAL TAMPILKAN KODE PERKIRAAN --}}
        <div class="modal fade bs-modal-nas" id="ambildataperkiraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="ambildataperkiraanlabel">Data Perkiraan</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                </div>
                <div class="modal-body">
                <table id="idperkiraan" class="display" width="100%">
                    <thead>
                    <tr>
                        <th>Kode Perkiraan</th>
                        <th>Nama Perkiraan</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($perkiraan as $value)
                        <tr>
                        <td>{{ $value->kode_perk }}</td>
                        <td>{{ $value->nama_perk }}</td>
                        <td>{{ $value->type }}</td>
        
                        <td>
                        <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                            Action <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu">
                            <a id="klik" href="#" class="dropdown-item">
                            pilih
                        </a>
                        </div>
        
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        </div>
<!-- /.content -->
@endsection
