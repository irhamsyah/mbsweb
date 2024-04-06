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
            {{-- @if(isset($cari))
            @if(count($cari) > 0) --}}
            @if(isset($master_id))
            <form method="POST" action="/bo_ak_tt_updatehistorycatatjurnal">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-sm-6">
                      <input type="text" hidden name="saldo_awal" id="putsldawal">
                      <input type="text" hidden name="dk" id="putdk">
                      <label for="inputDate1">Tanggal</label>
                      <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                        <input type="text" name="inputtgljurnal" class="form-control datetimepicker-input" readonly
                          value="{{$tgl_trans}}" />
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="ref">#Ref</label>
                      @if(isset($no_bukti)==false)
                      <input type="text" class="form-control" name="no_bukti">
                      @else
                      <input type="text" class="form-control" name="no_bukti" value="{{$no_bukti}}">
                      @endif
                    </div>
                    <div class="col-lg-3 col-sm-6">
                      <label for="kodejurnal">Kode Jurnal</label>
                      <select class="form-control" name="kode_jurnal" id="">
                        @foreach($kodejurnal as $kode)
                        @if($kode->kode_jurnal==$kode_jurnal)
                        <option value="{{$kode->kode_jurnal}}" selected>{{$kode->nama_jurnal}}</option>
                        @else
                        <option value="{{$kode->kode_jurnal}}">{{$kode->nama_jurnal}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-sm-6">
                      <label for="nasabahid">Kode Perkiraan</label>
                      <div class="input-group date" data-target-input="nearest">
                        <input id="idKodePerkadd" type="text" name="kode_perk" readonly class="form-control" required>
                        <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraan">
                          <div class="input-group-text"><i class="fa fa-book"></i></div>
                        </div>

                      </div>
                      <input type="text" name="nama_perk" id="idNamaPerkadd" class="form-control" readonly
                        style="width: 400px;border : 0px;background-color:rgb(249, 249, 250)">
                    </div>
                    <div class="col-lg-2 col-sm-8">
                      <label for="inputnocif">Debet</label>
                      <input type="number" id="inputNamaNasabahadd" name="debet" class="form-control" value=0 required>
                    </div>
                    <input type="text" hidden name="master_id" value="{{$master_id}}">
                    <div class="col-lg-2 col-sm-8">
                      <label for="inputnocif">Kredit</label>
                      <input type="number" id="inputalamatadd" name="kredit" class="form-control" value=0 required>
                    </div>
                    <div class="col-lg-2 col-sm-8">
                      <label for="inputnocif">Keterangan</label>
                      @if(isset($keterangan))
                      <textarea name="keterangan" id="ket" cols="40" rows="5">{{$keterangan}}</textarea>
                      @else
                      <textarea name="keterangan" id="ket" cols="40" rows="5"></textarea>
                      @endif
                    </div>
                  </div>
                </div>
                <input type="text" hidden name="xmaster_id" value="{{$master_id}}">
                <div class="row form-group">
                  <div class="col-4" style="margin-left:450px">
                    <button type="submit" class="btn-lg btn-success"><i class="fa fa-check"
                        style="color:white">Create</i></button>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </form>
            <table id="jurnalTable" width='100%' class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No Perkiraan</th>
                  <th>Nama Perkiraan</th>
                  <th>Debet</th>
                  <th>Kredit</th>
                  <th>Uraian</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php($index=0)
                @foreach($transdetail as $values)
                <tr>
                  <td>{{ $values->kode_perk}}</td>
                  <td>{{ $values->perkiraan->nama_perk}}</td>
                  <td>{{ $values->debet}}</td>
                  <td>{{ $values->kredit}}</td>
                  <td>{{ $values->URAIAN}}</td>
                  <td>
                    <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                      Action
                    </a>
                    <div class="dropdown-menu">

                      <a href="{{route('historycatatjurnal',['id'=>$values->trans_id])}}" class="dropdown-item"
                        tabindex="-1" data-toggle="modal" data-target="#modal-update-kodeperk"
                        data-trans_id="{{$values->trans_id}}" data-master_id="{{$values->master_id}}"
                        data-uraian="{{$values->URAIAN}}" data-kode_perk="{{$values->kode_perk}}"
                        data-nama_perk="{{ $values->perkiraan->nama_perk }}" data-debet="{{$values->debet}}"
                        data-kredit="{{$values->kredit}}" data-type="{{ $values->perkiraan->type }}">
                        Update
                      </a>
                      <form method="POST" action="{{route('deletetrshistory')}}" class="form-control"
                        style="border-style:none">
                        @csrf
                        <input type="hidden" name="_method" value="delete" />
                        <input type="text" hidden name="trans_id" value="{{$values->trans_id}}">
                        <input type="text" hidden name="master_id" value="{{$values->master_id}}">

                        <input type="text" hidden name="kode_jurnal" value="{{$kode_jurnal}}">
                        <input type="text" hidden name="no_bukti" value="{{$no_bukti}}">
                        <input type="text" hidden name="tgl_trans" value="{{$tgl_trans}}">
                        <button onclick="return confirm('Yakin Akan Menghapus ?')" type="submit" tabindex="-1"
                          class="btn btn-sm btn-danger">
                          Delete
                          <i class="fa fa-trash" aria-hidden="true"></i>

                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @php($index++)
                @endforeach
              </tbody>
            </table>
            @else
            <table id="jurnalTable" width='100%' class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Trans_id</th>
                  <th>Tgl_trans</th>
                  <th>Kode_jurnal</th>
                  <th>No_bukti</th>
                  <th>Src</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
            <!-- Script -->
            <script type="text/javascript">
              $(document).ready(function(){
              
                            // DataTable
                            $('#jurnalTable').DataTable({
                              processing: true,
                              serverSide: true,
                              ajax: "{{route('Getjurnals')}}",
                              columns: [
                                  { data: 'trans_id' },
                                  { data: 'tgl_trans' },
                                  { data: 'kode_jurnal' },
                                  { data: 'no_bukti' },
                                  { data: 'src' },
                                  { title: "Action", 
                                  "render": function(data, type, row, meta) {
                        console.log( 'in render function' );
                        return '<a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">' +
                                'Action <span class="caret"></span>' +
                                '</a>' +
                                '<div class="dropdown-menu">' +
                                  '<form method="get" action="/bo_ak_tt_detailhistorycatatjurnal">' +
                                    '@csrf' +
                                    '<input type="hidden" name="trans_id" value="'+row['trans_id']+'" class="form-control">' +                                    
                                    '<input type="hidden" name="tgl_trans" value="'+row['tgl_trans']+'" class="form-control">' +                                    
                                    '<input type="hidden" name="kode_jurnal" value="'+row['kode_jurnal']+'" class="form-control">' +                                    
                                    '<input type="hidden" name="no_bukti" value="'+row['no_bukti']+'" class="form-control">' +                                    
                                    '<button type="submit" tabindex="-1" class="dropdown-item">' +
                                    ' Detail Kredit' +
                                    '</button>' +
                                  '</form>' +
                                '</div>';
                                }
                                  },
                              ]
                            });
              
                          });
            </script>

            @endif

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

{{-- MODAL TAMPIL TABEL PERKIRAAN --}}
<div class="modal fade" id="ambildataperkiraan" tabindex="-1" role="dialog" aria-labelledby="ambildataperkiraanTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ambildataperkiraan">Data Perkiraan</h5>
      </div>
      <div class="modal-body">
        <table id="idperkiraanxx" class="display" width="100%">
          <thead>
            <tr>
              <th>Kode_perk</th>
              <th>Nama_Perk</th>
              <th>kode_induk</th>
              <th>Level</th>
              <th>Type</th>
              <th>Saldo_akhir</th>
              <th style="display: none">Saldo_awal</th>
              <th style="display: none">DK</th>
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
              <td>{{ number_format($value->saldo_akhir,2,",",".") }}</td>
              <td style="display: none">{{ $value->saldo_awal }}</td>
              <td style="display: none">{{ $value->dk }}</td>
              <td>
                <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                  Action <span class="caret"></span>
                </a>
                <div class="dropdown-menu" data-dismiss="modal">
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
{{-- MODAL UBAH DATA JURNAL --}}
<div class="modal fade" id="modal-update-kodeperk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-update-kodeperkLabel">Update Kode Perkiraan</h5>
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
              <input type="text" name="saldo_awal" id="idSaldoawal" hidden>
              <input type="text" name="dk" id="idDk" hidden>
              <input type="text" name="inputtgljurnal" hidden value="{{$tgl_trans}}" />

              <div class="col-lg-6 col-sm-12">
                <label for="inputnpwp">Uraian</label>
                <input type="text" name="uraian" class="form-control" id="iduraian">
              </div>
              <div class="col-lg-6 col-sm-12">
                <label for="nasabahid">Kode Perkiraan</label>
                <div class="input-group date" data-target-input="nearest">
                  <input id="idKodePerkcatat" type="text" name="kode_perk" readonly class="form-control" required>

                  <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraanxy">
                    <div class="input-group-text"><i class="fa fa-book"></i></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <label for="inputnpwp">Nama Perkiraan</label>
                <input type="text" id="idNamaPerkcatat" name="nama_perk" class="form-control" id="salmin" readonly>
              </div>
              <div class="col-lg-6 col-sm-12">
                <label for="inputnpwp">Type</label>
                <input type="text" name="type" class="form-control" id="idtype" readonly>
              </div>
              <div class="col-lg-6 col-sm-12">
                <label for="inputnocif">Debet</label>
                <input type="number" id="inputNamaNasabahadd" name="debet" class="form-control" value=0 required>
              </div>
              <div class="col-lg-6 col-sm-12">
                <label for="inputnocif">Kredit</label>
                <input type="number" id="inputalamatadd" name="kredit" class="form-control" value=0 required>
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
{{-- MODAL TAMPIL TABEL PERKIRAAN PADA MODAL UPDATE ISIAN EDIT JURNAL HISTORY--}}
<div class="modal fade" id="ambildataperkiraanxy" tabindex="-1" role="dialog"
  aria-labelledby="ambildataperkiraanxyTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ambildataperkiraanxy">Data Perkiraan</h5>
      </div>
      <div class="modal-body">
        <table id="idperkiraanhistjur" class="display" width="100%">
          <thead>
            <tr>
              <th>Kode_perk</th>
              <th>Nama_Perk</th>
              <th>kode_induk</th>
              <th>Level</th>
              <th>Type</th>
              <th style="display: none">saldo_awal</th>
              <th style="display: none">dk</th>
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
              <td style="display: none">{{ $value->saldo_awal }}</td>
              <td style="display: none">{{ $value->dk }}</td>
              <td>
                <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                  Action <span class="caret"></span>
                </a>
                <div class="dropdown-menu" data-dismiss="modal">
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

<!-- /.content -->
@endsection