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
            <h4>KUITANSI TABUNGAN</h4>
          </div>
          <!-- form start -->
          <form method="POST" action="/bo_cs_rp_tabungan/printbuktisetortab" role="print">
            @csrf
            @foreach($nasabah as $nasabah1)
              @php $norek=$nasabah1->NO_REKENING; $namanasabah=$nasabah1->nama_nasabah; $alamatnasabah=$nasabah1->alamat; $saldosaatini=$nasabah1->SALDO_AKHIR; $kota='Pasuruan';  @endphp;
            @endforeach
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-1 col-sm-12">
                  <label for="tanggal">Tanggal</label> 
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-1 col-sm-12">
                  <label for="norek">No Rekening</label> 
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="text" class="form-control" id="norek" name="norek" value="{{ $norek }}" readonly>
                </div>
                <div class="col-lg-1 col-sm-12"></div>             
                <div class="col-lg-1 col-sm-12">
                  <label for="namanasabah">Nama Nasabah</label>
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah" name="namanasabah" value="{{ $namanasabah }}" placeholder="Masukkan Nama Nasabah" readonly>
                </div>
              </div>
              <div class="row form-group">   
                <div class="col-lg-1 col-sm-12">
                  <label for="alamat">Alamat</label>
                </div>          
                <div class="col-lg-8 col-sm-12">
                  <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $alamatnasabah }}" placeholder="Masukkan Jenis Nasabah" readonly>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-1 col-sm-12">
                  <label for="saldoakhir">Saldo Saat Ini</label> 
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="text" class="form-control" id="saldoakhir" name="saldoakhir" value="{{ number_format($saldosaatini,2,',','.') }}" readonly>
                </div>
                <div class="col-lg-1 col-sm-12"></div>  
                <div class="col-lg-1 col-sm-12">
                  <label for="saldominimum">Saldo Minimum</label>
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <input type="text" class="form-control" id="saldominimum" name="saldominimum" value="{{ number_format(10000,2,',','.') }}" readonly>
                </div>
              </div>
              <div class="row form-group">   
                <div class="col-lg-1 col-sm-12">
                  <label for="kwitansi">Kwitansi</label>
                </div>          
                <div class="col-lg-3 col-sm-12">
                  <input type="text" class="form-control" id="kwitansi" name="kwitansi" value="" placeholder="Masukkan No Kwitansi" required>
                </div>
                <div class="col-lg-1 col-sm-12"></div>  
                <div class="col-lg-1 col-sm-12">
                  <label for="kodetranstab">Kode Transaksi</label> 
                </div>             
                <div class="col-lg-3 col-sm-12">
                  <select class="form-control" name="kodetranstab" required>
                    <option value="#" selected="true" disabled="disabled">--- Kode Transaksi ---</option>
                    @foreach($kodetranstab as $kodetranstab1)
                    <option value="{{ $kodetranstab1->DESKRIPSI_TRANS }}">{{ $kodetranstab1->KODE_TRANS.' - '.$kodetranstab1->DESKRIPSI_TRANS }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-1 col-sm-12">
                  <label for="jumlah">Jumlah</label>
                </div>             
                <div class="col-lg-2 col-sm-12">
                  <input type="text" class="form-control" id="jumlah" name="jumlah" value="" placeholder="Masukkan Jumlah" required>
                </div>
                <div class="col-lg-1 col-sm-12">
                  <label for="debetkredit">Debet / Kredit</label>
                </div>             
                <div class="col-lg-2 col-sm-12">
                  <select class="form-control" name="debetkredit" required>
                    <option value="#" selected="true" disabled="disabled">--- Debet / Kredit ---</option>
                    <option value="debet">Debet</option>
                    <option value="kredit">Kredit</option>
                  </select>
                </div>
                <div class="col-lg-1 col-sm-12">
                  <label for="tunaiovb">Tunai / OVB</label>
                </div>             
                <div class="col-lg-2 col-sm-12">
                  <select class="form-control" name="tunaiovb" required>
                    <option value="#" selected="true" disabled="disabled">--- Kode Tunai / OVB ---</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Overbooking">Overbooking</option>
                  </select>
                </div>
              </div>
              <div class="row form-group">   
                <div class="col-lg-1 col-sm-12">
                  <label for="keterangan">Keterangan</label>
                </div>          
                <div class="col-lg-8 col-sm-12">
                  <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-1 col-sm-12">
                  <input type="hidden" class="form-control" id="kota" name="kota" value="{{ $kota }}" readonly>
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