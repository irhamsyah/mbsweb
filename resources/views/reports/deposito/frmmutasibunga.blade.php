@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <h5>Pencetakan Mutasi Bunga Deposito</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="bo_dp_rp_transaksirinci" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Mulai Tanggal</label>
                    <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                      <input type="text" name="tgl_trans1" class="form-control datetimepicker-input" value="<?php if(isset($tgltrs1)){echo($tgltrs1);} ?>" data-target="#idtglnominatif1"/>
                        <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <label for="inputDate1">Sampai Tanggal</label>
                    <div class="input-group date" id="idtglnominatif2" data-target-input="nearest">
                        <input type="text" name="tgl_trans2" class="form-control datetimepicker-input" value="<?php if(isset($tgltrs2)){echo($tgltrs2);} ?>" data-target="#idtglnominatif2"/>
                          <div class="input-group-append" data-target="#idtglnominatif2" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                    </div>                  
                 </div>
                </div>
                <div class="row form-group">
                <div class="col-lg-3 col-sm-6" style="margin-left: 400px">
                  <label for="nasabahid">Nasabah / Anggota ID</label>
                  <div class="input-group date" data-target-input="nearest">
                    <input type="text" id="editidnasabah" name="nasabah_id" class="form-control">
                    <div class="input-group-append" data-toggle="modal" data-target="#ambildatanasabah">
                      <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  </div>
                </div>
              </div>    
            </div>
            <!-- /.card-body -->
          </form>
        </div>
  {{-- MODAL TAMPIL TABEL NASABAH --}}
  <div class="modal fade bs-modal-nas" id="ambildatanasabah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ambildatanasabah">Data Nasabah</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
          <table id="nasabahdata" class="display" width="100%">
            <thead>
              <tr>
                  <th>No_rekening</th>
                  <th>Nama_Nasabah</th>
                  <th>Alamat</th>
                  <th>Jml_deposito</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($nasabah as $value)
                <tr>
                <td>{{ $value->no_rekening }}</td>
                <td>{{ $value->nama_nasabah }}</td>
                <td>{{ $value->alamat }}</td>
                <td>{{ $value->jml_deposito }}</td>
                <td>
                  <a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">
                    Action <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu" data-dismiss="modal">
                    <a id="tes1" href="#" class="dropdown-item">
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
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  
</div>
<!-- /.content -->
@endsection
