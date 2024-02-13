@extends('layouts.admin_main')

@section('content')
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <h5>Nominatif Group Rinci</h5>
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_dp_rp_nominatifgrouprinci" role="search" style="margin-bottom: -10px">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                    <label for="inputDate1">Nominatif per Tanggal</label>
                    <div class="input-group date" id="inputDate1" data-target-input="nearest">
                      @if(isset($tgl_input))
                      <input type="text" name="tgl_nominatif" class="form-control datetimepicker-input" value={{$tgl_input}} data-target="#inputDate1"/>
                      @else
                      <input type="text" name="tgl_nominatif" class="form-control datetimepicker-input" value={{$tgllogin}} data-target="#inputDate1"/>
                      @endif
                        <div class="input-group-append" data-target="#inputDate1" data-toggle="datetimepicker" onclick="nonAktif()">
                            <div class="input-group-text"><i class="fa fa-calendar" onclick="nonAktif()"></i></div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="mx-auto col-md-3 col-sm-12">
                  <label for="rekap">Rekap Berdasarkan</label>
                  <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="rekap" style="width:250px;font-size:15px" onclick="nonAktif()">
                  @if($rekap=='JENIS_DEPOSITO')
                    <option value="JENIS_DEPOSITO" selected>JENIS_DEPOSITO</option>
                    <option value="JKW">JKW</option>
                    <option value="SUKU_BUNGA">SUKU_BUNGA</option>
                    <option value="KELOMPOK_SALDO">KELOMPOK_SALDO</option>
                    <option value="KODE_GROUP1">KODE_GROUP1</option>
                    <option value="KODE_GROUP2">KODE_GROUP2</option>
                    <option value="KODE_GROUP3">KODE_GROUP3</option>
                  @elseif($rekap=='JKW')
                    <option value="JENIS_DEPOSITO">JENIS_DEPOSITO</option>
                    <option value="JKW" selected>JKW</option>
                    <option value="SUKU_BUNGA">SUKU_BUNGA</option>
                    <option value="KELOMPOK_SALDO">KELOMPOK_SALDO</option>
                    <option value="KODE_GROUP1">KODE_GROUP1</option>
                    <option value="KODE_GROUP2">KODE_GROUP2</option>
                    <option value="KODE_GROUP3">KODE_GROUP3</option>
                  @elseif($rekap=='SUKU_BUNGA')
                    <option value="JENIS_DEPOSITO">JENIS_DEPOSITO</option>
                    <option value="JKW">JKW</option>
                    <option value="SUKU_BUNGA" selected>SUKU_BUNGA</option>
                    <option value="KELOMPOK_SALDO">KELOMPOK_SALDO</option>
                    <option value="KODE_GROUP1">KODE_GROUP1</option>
                    <option value="KODE_GROUP2">KODE_GROUP2</option>
                    <option value="KODE_GROUP3">KODE_GROUP3</option>
                  @elseif($rekap=='KELOMPOK_SALDO')
                    <option value="JENIS_DEPOSITO">JENIS_DEPOSITO</option>
                    <option value="JKW">JKW</option>
                    <option value="SUKU_BUNGA">SUKU_BUNGA</option>
                    <option value="KELOMPOK_SALDO" selected>KELOMPOK_SALDO</option>
                    <option value="KODE_GROUP1">KODE_GROUP1</option>
                    <option value="KODE_GROUP2">KODE_GROUP2</option>
                    <option value="KODE_GROUP3">KODE_GROUP3</option>
                  @elseif($rekap=='KODE_GROUP1')
                    <option value="JENIS_DEPOSITO">JENIS_DEPOSITO</option>
                    <option value="JKW">JKW</option>
                    <option value="SUKU_BUNGA">SUKU_BUNGA</option>
                    <option value="KELOMPOK_SALDO">KELOMPOK_SALDO</option>
                    <option value="KODE_GROUP1" selected>KODE_GROUP1</option>
                    <option value="KODE_GROUP2">KODE_GROUP2</option>
                    <option value="KODE_GROUP3">KODE_GROUP3</option>
                  @elseif($rekap=='KODE_GROUP2')
                    <option value="JENIS_DEPOSITO">JENIS_DEPOSITO</option>
                    <option value="JKW">JKW</option>
                    <option value="SUKU_BUNGA">SUKU_BUNGA</option>
                    <option value="KELOMPOK_SALDO">KELOMPOK_SALDO</option>
                    <option value="KODE_GROUP1">KODE_GROUP1</option>
                    <option value="KODE_GROUP2" selected>KODE_GROUP2</option>
                    <option value="KODE_GROUP3">KODE_GROUP3</option>
                  @elseif($rekap=='KODE_GROUP3')
                    <option value="JENIS_DEPOSITO">JENIS_DEPOSITO</option>
                    <option value="JKW">JKW</option>
                    <option value="SUKU_BUNGA">SUKU_BUNGA</option>
                    <option value="KELOMPOK_SALDO">KELOMPOK_SALDO</option>
                    <option value="KODE_GROUP1">KODE_GROUP1</option>
                    <option value="KODE_GROUP2">KODE_GROUP2</option>
                    <option value="KODE_GROUP3" selected>KODE_GROUP3</option>
                  @else
                    <option value="JENIS_DEPOSITO">JENIS_DEPOSITO</option>
                    <option value="JKW">JKW</option>
                    <option value="SUKU_BUNGA">SUKU_BUNGA</option>
                    <option value="KELOMPOK_SALDO">KELOMPOK_SALDO</option>
                    <option value="KODE_GROUP1">KODE_GROUP1</option>
                    <option value="KODE_GROUP2">KODE_GROUP2</option>
                    <option value="KODE_GROUP3">KODE_GROUP3</option>
                  @endif

                  </select>
                </div>

              </div>
              <div class="row form-group">
                <div class="col-1"></div>
                <div class="col-md-3 col-sm-12" style="margin-left: 390px">
                  <button type="submit" class="btn btn-warning">Proses &nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>    
            </div>
            <!-- /.card-body -->
          </form>
        @if(isset($nominatif))
          @if(isset($tgl_input) && isset($rekap))
            @if($rekap=='JENIS_DEPOSITO')
          <form method="POST" action="nominatifdepgroupjeniseksport" role="search" style="margin-top: -5px;margin-left:35px">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$tgl_input}} class="form-control datetimepicker-input"/>
            {{-- <div class="col-3"></div> --}}
            <div class="col-md-3 col-sm-12" style="margin-left: 410px">
              <button id="but1" type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{route('cetaknomingroupdepjnsdep',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF</a>
            </div>
          </div>
          </form>
            @elseif($rekap=='JKW')
          <form method="POST" action="nominatifdepgroupjkweksport" role="search" style="margin-top: -5px;margin-left:35px">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$tgl_input}} class="form-control datetimepicker-input"/>
            <div class="col-md-3 col-sm-12" style="margin-left: 410px">
              <button id="but1" type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{route('cetaknomingroupdjkwdep',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF</a>
            </div>
          </div>
          </form>
            @elseif($rekap=='SUKU_BUNGA')
          <form method="POST" action="nominatifdepgroupskbngeksport" role="search" style="margin-top: -5px;margin-left:35px">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$tgl_input}} class="form-control datetimepicker-input"/>
            <div class="col-md-3 col-sm-12" style="margin-left: 410px">
              <button id="but1" type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{route('cetaknomingroupdepskbngdep',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF</a>
            </div>
          </div>
          </form>
          @elseif($rekap=='KODE_GROUP1')
          <form method="POST" action="nominatifdepgroupKDGRP1eksport" role="search" style="margin-top: -5px;margin-left:35px">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$tgl_input}} class="form-control datetimepicker-input"/>
            <div class="col-md-3 col-sm-12" style="margin-left: 410px">
              <button id="but1" type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{route('cetaknomingroupdepKDGRP1dep',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF</a>
            </div>
          </div>
          </form>
          @elseif($rekap=='KODE_GROUP2')
          <form method="POST" action="nominatifdepgroupKDGRP2eksport" role="search" style="margin-top: -5px;margin-left:35px">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$tgl_input}} class="form-control datetimepicker-input"/>
            <div class="col-md-3 col-sm-12" style="margin-left: 410px">
              <button id="but1" type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{route('cetaknomingroupdepKDGRP2dep',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF</a>
            </div>
          </div>
          </form>
          @elseif($rekap=='KODE_GROUP3')
          <form method="POST" action="nominatifdepgroupKDGRP3eksport" role="search" style="margin-top: -5px;margin-left:35px">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$tgl_input}} class="form-control datetimepicker-input"/>
            <div class="col-md-3 col-sm-12" style="margin-left: 410px">
              <button id="but1" type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{route('cetaknomingroupdepKDGRP3dep',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF</a>
            </div>
          </div>
          </form>
          @elseif($rekap=='KELOMPOK_SALDO')
          <form method="POST" action="nominatifdepgroupKELSALeksport" role="search" style="margin-top: -5px;margin-left:35px">
            @csrf
          <div class="row form-group">
            <input hidden name="tgl_nominatif" value={{$tgl_input}} class="form-control datetimepicker-input"/>
            <div class="col-md-3 col-sm-12" style="margin-left: 410px">
              <button id="but1" type="submit" class="btn btn-warning">Export&nbsp;&nbsp;&nbsp;<i class="fa fa-search" style="color:white"></i></button>
              <a href="{{route('cetaknomingroupdepKELSALdep',['tgl_input'=>$tgl_input])}}" class="btn btn-md btn-danger" id="but2"> Cetak PDF</a>
            </div>
          </div>
          </form>
            @endif
          @endif
      </div>
      {{-- DIBAWAH INI UNTUK TAMPILAN TABLE --}}
        <div class="card">
          <div class="card-body">
            @if($rekap =='JENIS_DEPOSITO')
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Deskripsi</th>
                  <th>No_rekening</th>
                  <th>Nama_nasabah</th>
                  <th>Alamat</th>
                  <th>Jumlah Deposito</th>
                  <th>Tgl Mulai</th>
                  <th>Jangka Waktu(Bln)</th>
                  <th>Tgl Registrasi</th>
                  <th>Tgl Jt Tempo</th>
                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$nominatifs->JENIS_DEPOSITO}}</td>
                      <td>{{$nominatifs->DESKRIPSI_JENIS_DEPOSITO}}</td>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{number_format( $nominatifs->NOMINAL,2,".",",")}}</td>
                      <td>{{$nominatifs->TGL_MULAI}}</td>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>
                      <td>{{$nominatifs->TGL_JT}}</td>
                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>
            @elseif($rekap =='JKW')
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Deskripsi</th>
                  <th>No_rekening</th>
                  <th>Nama_nasabah</th>
                  <th>Alamat</th>
                  <th>Jumlah Deposito</th>
                  <th>Tgl Mulai</th>
                  <th>Jangka Waktu(Bln)</th>
                  <th>Tgl Registrasi</th>
                  <th>Tgl Jt Tempo</th>
                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{'Jangka waktu '.$nominatifs->JKW.' Bulan'}}</td>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{number_format( $nominatifs->NOMINAL,2,".",",")}}</td>
                      <td>{{$nominatifs->TGL_MULAI}}</td>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>
                      <td>{{$nominatifs->TGL_JT}}</td>
                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>
            @elseif($rekap =='SUKU_BUNGA')
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Deskripsi</th>
                  <th>No_rekening</th>
                  <th>Nama_nasabah</th>
                  <th>Alamat</th>
                  <th>Jumlah Deposito</th>
                  <th>Tgl Mulai</th>
                  <th>Jangka Waktu(Bln)</th>
                  <th>Tgl Registrasi</th>
                  <th>Tgl Jt Tempo</th>
                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$nominatifs->SUKU_BUNGA}}</td>
                      <td>{{'Suku bunga '.$nominatifs->SUKU_BUNGA.'%'}}</td>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{number_format( $nominatifs->NOMINAL,2,".",",")}}</td>
                      <td>{{$nominatifs->TGL_MULAI}}</td>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>
                      <td>{{$nominatifs->TGL_JT}}</td>
                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>
            @elseif($rekap =='KELOMPOK_SALDO')
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Deskripsi</th>
                  <th>No_rekening</th>
                  <th>Nama_nasabah</th>
                  <th>Alamat</th>
                  <th>Jumlah Deposito</th>
                  <th>Tgl Mulai</th>
                  <th>Jangka Waktu(Bln)</th>
                  <th>Tgl Registrasi</th>
                  <th>Tgl Jt Tempo</th>
                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$nominatifs->SUKU_BUNGA}}</td>
                      <td>{{'Suku bunga '.$nominatifs->SUKU_BUNGA.'%'}}</td>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{number_format( $nominatifs->NOMINAL,2,".",",")}}</td>
                      <td>{{$nominatifs->TGL_MULAI}}</td>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>
                      <td>{{$nominatifs->TGL_JT}}</td>
                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>
            @elseif($rekap =='KODE_GROUP1')
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Deskripsi</th>
                  <th>No_rekening</th>
                  <th>Nama_nasabah</th>
                  <th>Alamat</th>
                  <th>Jumlah Deposito</th>
                  <th>Tgl Mulai</th>
                  <th>Jangka Waktu(Bln)</th>
                  <th>Tgl Registrasi</th>
                  <th>Tgl Jt Tempo</th>
                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$nominatifs->KODE_GROUP1}}</td>
                      <td>{{$nominatifs->DESKRIPSI_GROUP1}}</td>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{number_format( $nominatifs->NOMINAL,2,".",",")}}</td>
                      <td>{{$nominatifs->TGL_MULAI}}</td>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>
                      <td>{{$nominatifs->TGL_JT}}</td>
                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>
            @elseif($rekap =='KODE_GROUP2')
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Deskripsi</th>
                  <th>No_rekening</th>
                  <th>Nama_nasabah</th>
                  <th>Alamat</th>
                  <th>Jumlah Deposito</th>
                  <th>Tgl Mulai</th>
                  <th>Jangka Waktu(Bln)</th>
                  <th>Tgl Registrasi</th>
                  <th>Tgl Jt Tempo</th>
                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$nominatifs->KODE_GROUP2}}</td>
                      <td>{{$nominatifs->DESKRIPSI_GROUP2}}</td>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{number_format( $nominatifs->NOMINAL,2,".",",")}}</td>
                      <td>{{$nominatifs->TGL_MULAI}}</td>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>
                      <td>{{$nominatifs->TGL_JT}}</td>
                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>
            @elseif($rekap =='KODE_GROUP3')
            <table id="example1" class="display" width="100%">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Deskripsi</th>
                  <th>No_rekening</th>
                  <th>Nama_nasabah</th>
                  <th>Alamat</th>
                  <th>Jumlah Deposito</th>
                  <th>Tgl Mulai</th>
                  <th>Jangka Waktu(Bln)</th>
                  <th>Tgl Registrasi</th>
                  <th>Tgl Jt Tempo</th>
                </tr>
              </thead>
              <tbody>
                  @php($index=0)
                  @foreach(array_chunk($nominatif,1) as $values)
                  @php($index++)
                    @foreach($values as $kunci=>$nominatifs)
                    <tr>
                      <td>{{$nominatifs->KODE_GROUP3}}</td>
                      <td>{{$nominatifs->DESKRIPSI_GROUP3}}</td>
                      <td>{{$nominatifs->NO_REKENING}}</td>
                      <td>{{$nominatifs->nama_nasabah}}</td>
                      <td>{{$nominatifs->alamat}}</td>
                      <td>{{number_format( $nominatifs->NOMINAL,2,".",",")}}</td>
                      <td>{{$nominatifs->TGL_MULAI}}</td>
                      <td>{{$nominatifs->JKW}}</td>
                      <td>{{$nominatifs->TGL_REGISTRASI}}</td>
                      <td>{{$nominatifs->TGL_JT}}</td>
                    </tr>
                    @endforeach
                  @endforeach
              </tbody>
            </table>
            @endif
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
