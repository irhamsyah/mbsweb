<style>
.labeljudulright {
    height: 50%;
    display: flex;
    justify-content: right;
    align-items: right;
    font-size: small;
    margin-top: 10px;
}
.labeljudulleft {
    height: 50%;
    display: flex;
    justify-content: left;
    align-items: left;
    font-size: small;
    margin-top: 10px;
}
</style>
<div class="tab-pane" id="form_lapbul">
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudulright">Penjamin</span>
    </div>
    <div class="col-lg-2 col-sm-12">          
      <input type="text" name="inputpenjamin" class="form-control">
    </div>
    <div class="col-lg-1">
      <span class="labeljudulright">No. ID Penj.</span>
    </div>
    <div class="col-lg-3 col-sm-12">          
      <input type="text" name="inputidpenjamin" class="form-control">
    </div>
    <div class="col-lg-1">
      <span class="labeljudulright">Tgl. Analisa</span>      
    </div>
    <div class="col-lg-3 col-sm-12">          
      <input type="text" name="inputtglanalisa" class="form-control">
    </div>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudulright">Pekerjaan Penjamin</span>
    </div>
    <div class="col-lg-6 col-sm-12">          
      <input type="text" name="inputpekerjaanpenjamin" class="form-control">
    </div>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudulright">Alamat Penjamin</span>
    </div>
    <div class="col-lg-6 col-sm-12">          
      <input type="text" name="inputalamatpenjamin" class="form-control">
    </div>
  </div>
  <div class="form-group row"> 
    <div class="col-lg-6 bottomlinesolid">
      <span class="judulOrange labeljudul">Laporan Bulanan</span>
    </div>
    <div class="col-lg-6  bottomlinesolid">
      <span class="judulOrange labeljudul">Sistem Informasi Layanan Debitur</span>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodesifatkredit">
        @foreach($kodesifatkredit as $kodesifatkredit)
          <option value="{{ $kodesifatkredit->KODE_SIFAT }}">{{ $kodesifatkredit->KODE_SIFAT.' - '.$kodesifatkredit->DESKRIPSI_SIFAT }}</option>
        @endforeach                                
      </select>   
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputsidkodesifatkredit">
        @foreach($sidkodesifatkredit as $sidkodesifatkredit)
          <option value="{{ $sidkodesifatkredit->KODE_DESC }}">{{ $sidkodesifatkredit->KODE_DESC.' - '.$sidkodesifatkredit->DESKRIPSI_DESC }}</option>
        @endforeach                                  
      </select>  
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis Penggunaan</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodejenispenggunaankredit">
        @foreach($kodejenispenggunaankredit as $kodejenispenggunaankredit)
          <option value="{{ $kodejenispenggunaankredit->KODE_JENIS_PENGGUNAAN }}">{{ $kodejenispenggunaankredit->KODE_JENIS_PENGGUNAAN.' - '.$kodejenispenggunaankredit->DESKRIPSI_JENIS_PENGGUNAAN }}</option>
        @endforeach                                  
      </select>  
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis Penggunaan</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputsidkodejenispenggunaan">
        @foreach($sidkodejenispenggunaan as $sidkodejenispenggunaan)
          <option value="{{ $sidkodejenispenggunaan->KODE_DESC }}">{{ $sidkodejenispenggunaan->KODE_DESC.' - '.$sidkodejenispenggunaan->DESKRIPSI_DESC }}</option>
        @endforeach 
      </select> 
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis Debitur</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodegoldebitur">
        @foreach($kodegoldebitur as $kodegoldebitur)
          <option value="{{ $kodegoldebitur->KODE_GOL_DEBITUR }}">{{ $kodegoldebitur->KODE_GOL_DEBITUR.' - '.$kodegoldebitur->DESKRIPSI_GOL_DEBITUR }}</option>
        @endforeach 
      </select> 
    </div>
    <div class="col-lg-2">      
    </div>
    <div class="col-lg-4">
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Sektor Ekonomi</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodesektorekonomikredit">
        @foreach($kodesektorekonomikredit as $kodesektorekonomikredit)
          <option value="{{ $kodesektorekonomikredit->KODE_SEKTOR_EKONOMI }}">{{ $kodesektorekonomikredit->KODE_SEKTOR_EKONOMI.' - '.$kodesektorekonomikredit->DESKRIPSI_SEKTOR_EKONOMI }}</option>
        @endforeach 
      </select> 
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Sektor Ekonomi</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputsidkodebidangusaha">
        @foreach($sidkodebidangusaha as $sidkodebidangusaha)
          <option value="{{ $sidkodebidangusaha->KODE_BIDANG_USAHA }}">{{ $sidkodebidangusaha->KODE_BIDANG_USAHA.' - '.$sidkodebidangusaha->DESKRIPSI_BIDANG_USAHA }}</option>
        @endforeach 
      </select>
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Golongan Penjamin</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodegolpenjaminkredit">
        @foreach($kodegolpenjaminkredit as $kodegolpenjaminkredit)
          <option value="{{ $kodegolpenjaminkredit->KODE_GOL_PENJAMIN }}">{{ $kodegolpenjaminkredit->KODE_GOL_PENJAMIN.' - '.$kodegolpenjaminkredit->DESKRIPSI_GOL_PENJAMIN }}</option>
        @endforeach 
      </select>
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Golongan Penjamin</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputsidkodegolonganpenjamin">
        @foreach($sidkodegolonganpenjamin as $sidkodegolonganpenjamin)
          <option value="{{ $sidkodegolonganpenjamin->KODE_GOL_PENJAMIN }}">{{ $sidkodegolonganpenjamin->KODE_GOL_PENJAMIN.' - '.$sidkodegolonganpenjamin->DESKRIPSI_GOL_PENJAMIN }}</option>
        @endforeach 
      </select>
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis Asuransi</span>
    </div>
    <div class="col-lg-4">
     <select class="form-control" name="inputkodeasuransikredit">
        @foreach($kodeasuransikredit as $kodeasuransikredit)
          <option value="{{ $kodeasuransikredit->KODE_ASURANSI }}">{{ $kodeasuransikredit->KODE_ASURANSI.' - '.$kodeasuransikredit->DESKRIPSI_ASURANSI }}</option>
        @endforeach 
      </select>
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis Asuransi</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputsidkodejenisasuransi">
        @foreach($sidkodejenisasuransi as $sidkodejenisasuransi)
          <option value="{{ $sidkodejenisasuransi->KODE_DESC }}">{{ $sidkodejenisasuransi->KODE_DESC.' - '.$sidkodejenisasuransi->DESKRIPSI_DESC }}</option>
        @endforeach 
      </select>
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Jml. Asuransi</span>
    </div>
    <div class="col-lg-1">
      <input type="text" name="inputjmlasuransi" value='0' class="form-control">
    </div>
    <div class="col-lg-1">
      <span class="labeljudulright">Dijaminkan</span>
    </div>
    <div class="col-lg-1">
      <input type="text" name="inputdijaminkan" value='0' class="form-control">
    </div>
    <div class="col-lg-1">
      <span class="labeljudulleft">%</span>
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Gol. Kredit</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputsidkodegolkredit">
        @foreach($sidkodegolkredit as $sidkodegolkredit)
          <option value="{{ $sidkodegolkredit->KODE_DESC }}">{{ $sidkodegolkredit->KODE_DESC.' - '.$sidkodegolkredit->DESKRIPSI_DESC }}</option>
        @endforeach 
      </select>
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Metoda</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodemetoda">
        @foreach($kodemetoda as $kodemetoda)
          <option value="{{ $kodemetoda->KODE_METODA }}">{{ $kodemetoda->KODE_METODA.' - '.$kodemetoda->DESKRIPSI_METODA }}</option>
        @endforeach 
      </select>
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis Fasilitas</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputsidkodejenisfasilitas">
        @foreach($sidkodejenisfasilitas as $sidkodejenisfasilitas)
          <option value="{{ $sidkodejenisfasilitas->KODE_DESC }}">{{ $sidkodejenisfasilitas->KODE_DESC.' - '.$sidkodejenisfasilitas->DESKRIPSI_DESC }}</option>
        @endforeach 
      </select>
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Sumber Pelunasan</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodesumberpelunasan">
        @foreach($kodesumberpelunasan as $kodesumberpelunasan)
          <option value="{{ $kodesumberpelunasan->KODE_SUMBER_PELUNASAN }}">{{ $kodesumberpelunasan->KODE_SUMBER_PELUNASAN.' - '.$kodesumberpelunasan->DESKRIPSI_SUMBER_PELUNASAN }}</option>
        @endforeach 
      </select>
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Tujuan Penggunaan</span>
    </div>
    <div class="col-lg-4">             
      <input type="text" name="inputtujuanpenggunaan" class="form-control">    
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Keterkaitan</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodeketerkaitanlapbul">
        @foreach($kodeketerkaitanlapbul as $kodeketerkaitanlapbul)
          <option value="{{ $kodeketerkaitanlapbul->SANDI }}">{{ $kodeketerkaitanlapbul->SANDI.' - '.$kodeketerkaitanlapbul->DESKRIPSI_SANDI }}</option>
        @endforeach 
      </select>
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Periode Pemby Pokok</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodeperiodepembayaranpokok">
        @foreach($kodeperiodepembayaranpokok as $kodeperiodepembayaranpokok)
          <option value="{{ $kodeperiodepembayaranpokok->kode_periode_pembayaran }}">{{ $kodeperiodepembayaranpokok->kode_periode_pembayaran.' - '.$kodeperiodepembayaranpokok->deskripsi_periode_pembayaran }}</option>
        @endforeach 
      </select>
    </div>                            
  </div> 
  <div class="form-group row">
    <div class="col-lg-2">
      <span class="labeljudulright">Kategori Usaha</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodejenisusaha">
        @foreach($kodejenisusaha as $kodejenisusaha)
          <option value="{{ $kodejenisusaha->KODE_JENIS_USAHA }}">{{ $kodejenisusaha->KODE_JENIS_USAHA.' - '.$kodejenisusaha->DESKRIPSI_JENIS_USAHA }}</option>
        @endforeach 
      </select>
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Periode Pemby Bunga</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkodeperiodepembayaranbunga">
        @foreach($kodeperiodepembayaranbunga as $kodeperiodepembayaranbunga)
          <option value="{{ $kodeperiodepembayaranbunga->kode_periode_pembayaran }}">{{ $kodeperiodepembayaranbunga->kode_periode_pembayaran.' - '.$kodeperiodepembayaranbunga->deskripsi_periode_pembayaran }}</option>
        @endforeach 
      </select>
    </div>                            
  </div> 
  <div class="form-group row"> 
    <div class="col-lg-6 bottomlinesolid">
      <span class="judulOrange labeljudul">Data Suami atau Istri</span>
    </div>
    <div class="col-lg-6  bottomlinesolid">
      <span class="judulOrange labeljudul">Kartu Pensiun</span>
    </div>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudulright">Data</span>
    </div>
    <div class="col-lg-2 col-sm-12">          
      <input type="text" name="inputdatasuamiistri" class="form-control">
    </div>
    <div class="col-lg-2 col-sm-12"></div>
    <div class="col-lg-2">
      <span class="labeljudulright">No Pensiun</span>
    </div>
    <div class="col-lg-4 col-sm-12">          
      <input type="text" name="inputnopensiun" class="form-control">
    </div>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudulright">Nama</span>
    </div>
    <div class="col-lg-4 col-sm-12">          
      <input type="text" name="inputnamasuamiistri" class="form-control">
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">No Kartu Pensiun</span>
    </div>
    <div class="col-lg-4 col-sm-12">          
      <input type="text" name="inputnokartupensiun" class="form-control">
    </div>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudulright">Alamat</span>
    </div>
    <div class="col-lg-4 col-sm-12">          
      <input type="text" name="inputalamatsuamiistri" class="form-control">
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">Jenis Pensiun</span>
    </div>
    <div class="col-lg-4 col-sm-12">          
      <input type="text" name="inputjenispensiun" class="form-control">
    </div>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudulright">Pekerjaan</span>
    </div>
    <div class="col-lg-4 col-sm-12">          
      <input type="text" name="inputpekerjaansuamiistri" class="form-control">
    </div>
    <div class="col-lg-2">
      <span class="labeljudulright">PK Pinjaman</span>
    </div>
    <div class="col-lg-4 col-sm-12">          
      <input type="text" name="inputpkpinjaman" class="form-control">
    </div>
  </div>
  <div class="form-group row"> 
    <div class="col-lg-6 bottomlinesolid">
      <span class="judulOrange labeljudul">Channeling</span>
    </div>
    <div class="col-lg-6  bottomlinesolid">
      <span class="judulOrange labeljudul">.</span>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-lg-2">
        <span class="labeljudulright">Kelompok / Group</span>
    </div>
    <div class="col-lg-4">
      <select class="form-control" name="inputkelompokgroup" >
        <option value="{{ '000' }}">{{ '000'.' - '.'UNCHANNELING' }}</option>
      </select>
    </div> 
  </div>
  <div class="form-group row">
    <div class="col-lg-2"></div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="inputchanneling" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
      <label class="form-check-label" style="margin-right:30px;">Channeling</label>
    </div>
  </div>
</div>

<script>

</script>