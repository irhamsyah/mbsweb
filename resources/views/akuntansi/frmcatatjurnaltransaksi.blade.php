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
        <div class="card-header">
          <h3 class="card-title">Pencatatan Jurnal Transaksi</h3>
        </div>
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_ak_tt_savetempjurnalmemorial" role="search">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate1">Tanggal</label>
                    <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                      <input type="text" name="inputtgljurnal" class="form-control datetimepicker-input" readonly
                        value="{{$tgllogin}}" />
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
                      @if(isset($kode_jurnal)==true)
                      @if($kode->kode_jurnal==$kode_jurnal)
                      <option selected value="{{$kode->kode_jurnal}}">{{$kode->nama_jurnal}}</option>
                      @else
                      <option value="{{$kode->kode_jurnal}}">{{$kode->nama_jurnal}}</option>
                      @endif
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
                    @if(isset($debet))
                    <input type="number" id="inputNamaNasabahadd" name="debet" class="form-control" value={{$debet}} required>
                    @else
                    <input type="number" id="inputNamaNasabahadd" name="debet" class="form-control" value=0 required>
                    @endif
                  </div>
                  <input type="text" hidden name="masterid" value="{{$masterid}}">
                  <div class="col-lg-2 col-sm-8">
                    <label for="inputnocif">Kredit</label>
                    @if(isset($kredit))
                    <input type="number" id="inputalamatadd" name="kredit" class="form-control" value={{$kredit}} required>
                    @else
                    <input type="number" id="inputalamatadd" name="kredit" class="form-control" value=0 required>
                    @endif
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
              <div class="row form-group">
                <div class="col-4" style="margin-left:450px">
                  <button type="submit" class="btn-lg btn-success"><i class="fa fa-check"
                      style="color:white">Create</i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
          <table>
            <thead>
              <tr>
                <th>Kode Perkiraan</th>
                <th>Nama Perkiraan</th>
                <th>Uraian</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if (count($hasil)==0)
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              @elseif(count($hasil)>0)
              @foreach($hasil as $values)
              <tr>
                <td>{{$values->kode_perk}}</td>
                <td>{{$values->perkiraan->nama_perk}}</td>
                <td>{{$values->URAIAN}}</td>
                <td>{{$values->debet}}</td>
                <td>{{$values->kredit}}</td>
                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu">
                    <a href="" tabindex="-1" class="dropdown-item" data-toggle="modal"
                      data-target="#modal-update-kodeperk" data-trans_id="{{$values->trans_id}}"
                      data-master_id="{{$values->master_id}}" data-uraian="{{$values->URAIAN}}"
                      data-kode_perk="{{$values->kode_perk}}" data-nama_perk="{{ $values->perkiraan->nama_perk }}"
                      data-type="{{ $values->perkiraan->type }}" data-debet="{{ $values->debet }}"
                      data-kredit="{{ $values->kredit }}">
                      Update
                    </a>
                    <form method="post" action="/bo_ak_tt_delcatatjurnaldetail" style="margin-bottom: 0;"
                      onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                      <input type="hidden" name="trans_id" value="{{$values->trans_id}}">
                      <input type="hidden" name="master_id" value="{{$values->master_id}}">
                      <button type="submit" tabindex="-1" class="dropdown-item">
                        Delete
                      </button>
                      <input type="hidden" name="_method" value="DELETE" />
                      @csrf
                      <?php 
                      if(isset($tgl_trans)){
                      ?>
                      @csrf
                      <input type="text" hidden name="tgl_transx" value="{{$tgl_trans}}">
                      <input type="text" hidden name="kode_jurnalx" value="{{$kode_jurnal}}">
                      <input type="text" hidden name="no_buktix" value="{{$no_bukti}}">
                      <input type="text" hidden name="keteranganx" value="{{$keterangan}}">
                      <input type="text" hidden name="totalx" value="{{$total}}">
                      <?php
                      }
                      ?>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.card -->
        <div class="card">
          <!-- /.card-body -->
          <form method="POST" action="/bo_ak_tt_simpancatatjurnal">
            <?php 
              if(isset($tgl_trans)){
            ?>
            @csrf
            <input type="text" hidden name="tgl_trans" value="{{$tgl_trans}}">
            <input type="text" hidden name="kode_jurnal" value="{{$kode_jurnal}}">
            <input type="text" hidden name="no_bukti" value="{{$no_bukti}}">
            <input type="text" hidden name="keterangan" value="{{$keterangan}}">
            <input type="text" hidden name="total" value="{{$total}}">
            <?php
              }
            ?>
            <input type="text" hidden name="master_idx" value="{{$masterid}}">
            <div class="row form-group">
              <div class="col-4" style="margin-left:450px">
                <a href="{{route('showformhistoryjurnal')}}" class="btn-lg btn-success"
                  rel="noopener noreferrer">History</a>
                <button type="submit" class="btn-lg btn-danger"><i class="fa fa-check" style="color:white">Simpan Jurnal</i>
                </button>
              </div>
            </div>
          </form>

        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  {{-- UBAH DATA JURNAL --}}
  <div class="modal fade" id="modal-update-kodeperk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-update-kodeperkLabel">Ubah Kode Perkiraan</h5>
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
                @if(isset($tgl_trans))
                @csrf
                <input type="text" hidden name="tgl_transupd" value="{{$tgl_trans}}">
                <input type="text" hidden name="kode_jurnalupd" value="{{$kode_jurnal}}">
                <input type="text" hidden name="no_buktiupd" value="{{$no_bukti}}">
                <input type="text" hidden name="keteranganupd" value="{{$keterangan}}">
                <input type="text" hidden name="totalupd" value="{{$total}}">
                @endif
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
  {{-- MODAL TAMPIL TABEL PERKIRAAN --}}
  <div class="modal fade" id="ambildataperkiraan" tabindex="-1" role="dialog" aria-labelledby="ambildataperkiraanTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ambildataperkiraan">Data Perkiraan</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
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
  {{-- MODAL TAMPIL TABEL PERKIRAAN --}}
  <div class="modal fade" id="ambildataperkiraanxy" tabindex="-1" role="dialog"
    aria-labelledby="ambildataperkiraanxyTitle" aria-hidden="true">
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

</div>
<!-- /.content -->
@endsection