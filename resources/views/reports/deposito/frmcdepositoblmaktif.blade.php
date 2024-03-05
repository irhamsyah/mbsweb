@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <h5>Deposito Belum Aktif Realisasi</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          @if(isset($belumaktif))
          <form method="POST" action="exportbelumaktif" role="search" style="margin-top:-40px;margin-left:180px">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                  {{-- <label for="inputDate1">Mulai Tanggal</label> --}}
                  <div class="input-group date" id="idtglnominatif1" data-target-input="nearest">
                    <input hidden type="text" name="tgl_trans1" class="form-control datetimepicker-input"
                      value="2024-02-01" data-target="#idtglnominatif1" />
                    <div class="input-group-append" data-target="#idtglnominatif1" data-toggle="datetimepicker">
                      <div hidden class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                  {{-- <label for="inputDate1">Sampai Tanggal</label> --}}
                  <div class="input-group date" id="idtglnominatif2" data-target-input="nearest">
                    <input hidden type="text" name="tgl_trans2" class="form-control datetimepicker-input" value=""
                      data-target="#idtglnominatif2" />
                    <div class="input-group-append" data-target="#idtglnominatif2" data-toggle="datetimepicker">
                      <div hidden class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-5 col-sm-12">
                  <button type="submit" class="btn btn-success">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil"
                      style="color:white"></i></button>
                  <a href="{{ route('cetakbelumaktif')}}" class="btn btn-md btn-danger"> Cetak PDF</a>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="card">
          <div class="card-body">
            <table id="example1" class="display" width="100">
              <thead>
                <tr>
                  <th>Nasabah_Id</th>
                  <th>Nama_Nasabah</th>
                  <th>Alamat</th>
                  <th>No_rekening</th>
                  <th>Tgl_registrasi</th>
                  <th>Jkw</th>
                  <th>Tgl_jt</th>
                  <th>Jml_deposito</th>
                  <th>Suku_bunga</th>
                  <th>Jenis_deposito</th>
                </tr>
              </thead>
              @if(is_null(Auth::user())==false)
              @if(Auth::user()->privilege=='admin')
              <tbody>
                @foreach($belumaktif as $values)
                <tr>
                  <td>{{ $values->NASABAH_ID}}</td>
                  <td>{{ $values->nama_nasabah}}</td>
                  <td>{{ $values->alamat}}</td>
                  <td>{{ $values->NO_REKENING}}</td>
                  <td>{{ $values->TGL_REGISTRASI}}</td>
                  <td>{{ $values->JKW}}</td>
                  <td>{{ $values->TGL_JT}}</td>
                  <td>{{ number_format($values->JML_DEPOSITO,2,",",".")}}</td>
                  <td>{{ $values->SUKU_BUNGA}}</td>
                  <td>{{ $values->JENIS_DEPOSITO}}</td>
                </tr>
                @endforeach
              </tbody>
              @endif
              @else
              <h3>Sesi Anda Telah Habis, Silahkan Login Ulang</h3>
              @endif
            </table>
          </div>
        </div>
        @endif
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

</div>
<!-- /.content -->
@endsection