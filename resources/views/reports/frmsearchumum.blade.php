@extends('layouts.admin_main')

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
        <div class="card card-warning card-outline">
          <div class="card-header">
            <h4>CETAK DOKUMEN UMUM & INVOICE</h4>
          </div>
          <!-- form start -->
          <form method="POST" action="/bo_cs_rp_umum/printdokumenumum" role="print">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-1 col-sm-12">
                  <label for="tanggal">Tanggal</label> 
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>
              </div>
              <div class="row form-group formkasdong">
                <div class="col-lg-1 col-sm-12">
                  <label for="kodejurnal">Kode Jurnal</label>
                </div>          
                <div class="col-lg-3 col-sm-12">
                  <select class="form-control" name="kodejurnal">
                    <option value="#" selected="true" disabled="disabled">--- KODE JURNAL ---</option>
                    @foreach($kodejurnals as $kodejurnal)
                    <option value="{{ $kodejurnal->kode_jurnal }}">{{ $kodejurnal->kode_jurnal.' - '.$kodejurnal->nama_jurnal }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-1 col-sm-12"></div>             
                <div class="col-lg-1 col-sm-12">
                  <label for="atasnama">Atas Nama</label>
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="text" class="form-control" id="atasnama" name="atasnama" value="" placeholder="Masukkan Nama">
                </div>
              </div>
              <div class="row form-group formumumdong" style="display:none">          
                <div class="col-lg-1 col-sm-12">
                  <label for="keteranganumum">Keterangan</label>
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="text" class="form-control" id="keteranganumum" name="keteranganumum" value="BUKTI JURNAL UMUM " placeholder="Masukkan Keterangan" required>
                </div>
              </div>
              <div class="row form-group">   
                <div class="col-lg-1 col-sm-12">
                  <label for="glbalance1">GL</label>
                </div>          
                <div class="col-lg-8 col-sm-12">
                  <select class="form-control" name="glbalance1">
                    <option value="#" selected="true" disabled="disabled">--- NO_PERK - NAMA_PERK - SALDO_AKHIR ---</option>
                    @foreach($perkiraans as $perkiraan)
                    <option value="{{ $perkiraan->kode_perk.'|'.$perkiraan->nama_perk }}">{{ $perkiraan->kode_perk.' - '.$perkiraan->nama_perk.' - '.$perkiraan->saldo_akhir }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group formumumdong" style="display:none">   
                <div class="col-lg-1 col-sm-12">
                  <label for="glbalance2">GL KREDIT</label>
                </div>          
                <div class="col-lg-8 col-sm-12">
                  <select class="form-control" name="glbalance2">
                    <option value="#" selected="true" disabled="disabled">--- NO_PERK - NAMA_PERK - SALDO_AKHIR ---</option>
                    @foreach($perkiraans as $perkiraan)
                    <option value="{{ $perkiraan->kode_perk.'|'.$perkiraan->nama_perk }}">{{ $perkiraan->kode_perk.' - '.$perkiraan->nama_perk.' - '.$perkiraan->saldo_akhir }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group">   
                <div class="col-lg-1 col-sm-12">
                  <label for="uraian">Uraian</label>
                </div>          
                <div class="col-lg-8 col-sm-12">
                  <textarea class="form-control" id="uraian" name="uraian"></textarea>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-1 col-sm-12">
                  <label for="jumlah">Jumlah</label>
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="text" class="form-control" id="jumlah" name="jumlah" value="" placeholder="Masukkan Jumlah" required>
                </div>
                <div class="col-lg-1 col-sm-12">
                </div>             
                <div class="col-lg-1 col-sm-12">
                  <label for="typedokumen">Tipe Dokumen</label>
                </div>            
                <div class="col-lg-3 col-sm-12">
                  <select class="form-control" id="typedokumencsumum" name="typedokumen" required>
                    <option value="#" selected="true" disabled="disabled">--- Tipe Dokumen ---</option>
                    <option value="masuk">Kas Masuk</option>
                    <option value="keluar">Kas Keluar</option>
                    <option value="umum">Jurnal Umum</option>
                  </select>
                </div>
              </div>
              <div class="row form-group formkasdong">
                <div class="col-lg-1 col-sm-12">
                  <label for="nasabah">Nasabah</label>
                </div>          
                <div class="col-lg-8 col-sm-12">
                  <select class="form-control select2" name="nasabah">
                    <option value="#" selected="true" disabled="disabled">--- NASABAH ---</option>
                    @foreach($nasabahs as $nasabah)
                    <option value="{{ $nasabah->nasabah_id }}">{{ $nasabah->nasabah_id.' - '.$nasabah->nama_nasabah.' - '.$nasabah->alamat }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-1 col-sm-12">
                  <button type="submit" class="btn btn-danger" style="float:right"><i class="fa fa-print" style="color:white"></i>Print</button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection