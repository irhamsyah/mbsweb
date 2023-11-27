@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <h5 style="margin-left:10px ">Pencetakan Buku Besar</h5>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_ak_caribukubesar" role="search">
          @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">dari Tanggal</label>
                    <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                      <input type="text" name="tgl_trans1" class="form-control datetimepicker-input" data-target="#idtglnominatif1"/>
                        <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <label for="inputDate1">s/d Tanggal</label>
                    <div class="input-group date" id="idtglnominatif2" data-target-input="nearest">
                        <input type="text" name="tgl_trans2" class="form-control datetimepicker-input" data-target="#idtglnominatif2"/>
                          <div class="input-group-append" data-target="#idtglnominatif2" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                        <label for="nasabahid">Kode Perkiraan</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" id="idKodePerkcatat" name="kode_perk" readonly class="form-control" readonly>
                            <div class="input-group-append" data-toggle="modal" data-target="#ambildataperkiraanxy">
                                <div class="input-group-text"><i class="fa fa-book"></i></div>
                            </div>
                        </div>
                        <input type="text" id="idNamaPerkcatat" name="nama_perk" readonly class="form-control" readonly>

                </div>
                </div>
              <div class="row form-group">
                <div class="col-1"></div>
                <div class="mx-auto col-md-3 col-sm-12">
                  <button type="submit" class="btn btn-warning">Proses &nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>    
            </div>
            <!-- /.card-body -->
          </form>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  {{-- TAMPIL TABEL PERKIRAAN --}}
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
                  <th>Saldo_akhir</th>

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
                <td>{{ $value->saldo_akhir }}</td>
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
