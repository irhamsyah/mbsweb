{{-- @php(dd(count($history[0]->perkiraan))) --}}
@extends('layouts.admin_main')
<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <h3 style="margin-left:20px" class="card-title">History Jurnal</h3>

      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form for Search Exsisting Saving Customer -->
          <form method="POST" action="/bo_ak_tt_carihistorycatatjurnal" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">NO_BUKTI</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnobukti" name="no_bukti" placeholder="Masukkan No Bukti">
                  <label for="namanasabah1">*(Wajib diisi)</label>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">KETERANGAN</label>
                </div>             
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idket" name="keterangan" placeholder="Masukkan keterangan">
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
          </form> <!-- /Batas Form Search ---->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
            </div>
            <h3 class="card-title">Data Yang Sudah Tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            {{-- MUNCULKAN DATA DETAIL JURNAL DARI HISTORY PENCATATAN JURNAL --}}
            @if(isset($cari))
            @if(count($cari) > 0)
            <table id="example112" class="table" width="100">
              <thead class="thead-dark">
              <tr>
                <th>No</th>
                <th>No_perkiraan</th>
                <th>Nama_perkiraan</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Uraian</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @php($index=0)
                @foreach($cari as $values)
                  @php($index++)
                <tr>
                  <td>{{$index}}</td>
                  <td>{{$values->kode_perk}}</td>
                  <td>{{$values->perkiraan->nama_perk}}</td>
                  <td>{{$values->debet}}</td>
                  <td>{{$values->kredit}}</td>
                  <td>{{$values->URAIAN}}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="{{route('historycatatjurnal',['id'=>$values->trans_id])}}" class="dropdown-item" data-toggle="modal" data-target="#modal-update-kodeperk"
                        data-trans_id="{{$values->trans_id}}"
                        data-master_id="{{$values->master_id}}"
                        data-uraian="{{$values->URAIAN}}"
                        data-kode_perk="{{$values->kode_perk}}"
                        data-nama_perk="{{ $values->perkiraan->nama_perk }}"
                        data-debet="{{$values->debet}}"
                        data-kredit="{{$values->kredit}}"
                        data-type="{{ $values->perkiraan->type }}"
                        >
                          Edit
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
                <div class="form-group">
                  <a href="{{route('showformhistoryjurnal')}}" class="btn btn-primary btn-mdm" tabindex="-1" role="button">Back</a>
                </div>
  
              @endif
              {{-- BATAS PENAMPILAN DATA DETAIL PENCTT JURNAL --}}
            @elseif(count($history)>0)
            <table id="example112" class="table" width="100">
              <thead class="thead-dark">
              <tr>
                <th>No</th>
                <th>Tgl_trans</th>
                <th>No_bukti</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @php($index=0)
                @foreach($history as $values)
                  @php($index++)
                <tr>
                  <td>{{$index}}</td>
                  <td>{{$values->tgl_trans}}</td>
                  <td>{{$values->no_bukti}}</td>
                  <td>{{$values->NOMINAL}}</td>
                  <td>{{$values->KETERANGAN}}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                      <form method="post" action="/bo_ak_tt_deletehistorycatatjurnal" style="margin-bottom: 0;" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                        <input type="hidden" name="trans_id" value="{{$values->trans_id}}">
                        <button type="submit" tabindex="-1" class="dropdown-item">
                            Delete
                          </button>
                              <input type="hidden" name="_method" value="DELETE"/>
                          @csrf
                        @csrf
                      </form>
                      <a href="{{route('historycatatjurnal',['id'=>$values->trans_id])}}" class="dropdown-item">
                          Edit
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
            @endif
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
        {{-- UBAH DATA JURNAL --}}
        <div class="modal fade" id="modal-update-kodeperk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-update-kodeperkLabel">Ubah Kode Perkiraan ewrwe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{route('updatehistorycttjurnal')}}">
                <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <input hidden type="text" name="trans_id">
                                <input hidden type="text" name="master_id">
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="nasabahid">Kode Perkiraan</label>
                                    <div class="input-group date" data-target-input="nearest">
                                    <input type="text" id="idKodePerkcatat" name="kode_perk" readonly class="form-control" readonly>
  
                                    <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraanxy">
                                        <div class="input-group-text"><i class="fa fa-book"></i></div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Nama Perkiraan</label>
                                    <input type="text" id="idNamaPerkcatat" name="nama_perk" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                  <label for="inputnocif">Debet</label>
                                  <input type="number" id="inputNamaNasabahadd" name="debet" class="form-control" value=0 required>
                              </div>
                              <div class="col-lg-6 col-sm-12">
                                  <label for="inputnocif">Kredit</label>
                                  <input type="number" id="inputalamatadd" name="kredit" class="form-control" value=0 required>
                              </div>
                              <div class="col-lg-6 col-sm-12">
                                <label for="inputnocif">Uraian</label>
                                <input type="text" id="inputalamatadd" name="uraian" class="form-control" readonly>
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
        <div class="modal fade" id="ambildataperkiraanxy" tabindex="-1" role="dialog" aria-labelledby="ambildataperkiraanxyTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ambildataperkiraanxy">Data Perkiraan</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> --}}
              </div>
              <div class="modal-body">
                <table id="idperkiraancatat" class="display" width="100%">
                  <thead>
                    <tr>
                        <th>Kode_perk</th>
                        <th>Nama_Perk</th>
                        <th>kode_induk</th>
                        <th>Level</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($perkiraan as $value)
                      <tr>
                      <td>{{ $value->kode_perk }}</td>
                      <td>{{ $value->nama_perk }}</td>
                      <td>{{ $value->kode_induk }}</td>
                      <td>{{ $value->level }}</td>
                      <td>{{ $value->type }}</td>
                      <td>
                        <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                          Action <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu">
                          <a id="kliky" href="#" class="dropdown-item">
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
