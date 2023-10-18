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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-tabungan" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Yang Sudah Tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
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
              {{-- @foreach($tabungan->chunk(100) as $index => $values) --}}
            @php($index=0)
            @if(count($history)>0)
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
                      <form action="/bo_ak_tt_deletehistorycatatjurnal" method="post" style="margin-bottom: 0;">
                          <input type="hidden" name="inputIdTransaction" value="{{ $values->trans_id }}" class="form-control">
                          @csrf
                          Delete
                      </form>
                      <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-jurnal"
                      data-kode_perk={{ $values->perkiraan->kode_perk}}
                      data-nama_perk={{ $values->perkiraan->nama_perk}}
                      data-debet={{ $values->debet}}
                      data-kredit={{ $values->kredit}}
                      data-uraian={{ $values->URAIAN}}

                        >
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
        <div class="modal fade" id="modal-edit-jurnal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-jurnalLabel">Ubah Kode Perkiraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="POST" action="{{route('saveperubahankodeperkpencttjur')}}">
                <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <input hidden type="text" name="trans_id">
                                <input hidden type="text" name="master_id">
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="nasabahid">Kode Perkiraan</label>
                                    <div class="input-group date" data-target-input="nearest">
                                    <input id="idKodePerkcatat" type="text" name="kode_perk" readonly class="form-control" required>
  
                                    <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraanxy">
                                        <div class="input-group-text"><i class="fa fa-book"></i></div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12" >
                                    <label for="inputnpwp">Nama Perkiraan</label>
                                    <input type="text" id="idNamaPerkcatat" name="nama_perk" class="form-control" id="salmin" readonly>
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
                                <input type="number" id="inputalamatadd" name="uraian" class="form-control" value=0 required>
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
  </div>
<!-- /.content -->
@endsection
