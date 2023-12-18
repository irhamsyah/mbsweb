<div class="tab-pane active" id="form_master_kredit">
  <div class="form-group row">
    <div class="col-lg-4">
      <div class="row">                            
        <div class="col-lg-12 col-sm-12">
          <label for="inputjeniskredit">Jenis Kredit</label>
          <select class="form-control" name="inputjeniskredit">
            @foreach($kodejeniskredit as $kodejeniskredit)
              <option value="{{ $kodejeniskredit->KODE_JENIS_KREDIT }}">{{ $kodejeniskredit->KODE_JENIS_KREDIT.' - '.$kodejeniskredit->DESKRIPSI_JENIS_KREDIT }}</option>
            @endforeach                                
          </select>                               
        </div>                            
        <div class="col-lg-8 col-sm-12">
            <label for="inputtipe">Tipe</label>
            <input type="text" name="inputtipe" value="KREDIT" readonly class="form-control">
        </div>
        <div class="col-lg-4 col-sm-12">
            <label for="inputcabang">Cabang</label>
            <input type="text" name="inputcabang" value="001" readonly class="form-control">
        </div>
        <div class="col-lg-12 col-sm-12">
            <label for="inputnorekening">No Rekening</label>
            <input type="text" name="inputnorekening" class="form-control" required>
        </div>
        <div class="col-lg-12 col-sm-12">
            <label for="inputnopklama">No PK Lama</label>
            <input type="text" name="inputnopklama" class="form-control" required>
        </div>
        <div class="col-lg-6 col-sm-12">
            <label for="inputtglpklama">Tgl PK Lama</label>
            <input type="text" name="inputtglpklama" class="form-control">
        </div>
        <div class="col-lg-6 col-sm-8">
            <label for="inputreviewbunga">Review Bunga</label>
            <div class="input-group mb-2 autocomplete"> 
              <input type="text" name="inputreviewbunga" class="form-control">
              <div class="input-group-prepend">
                  <div class="input-group-text"><span class="input-group-addon">
                    Bln
                    </span>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12">
          <label for="inputstatus">Status</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="inputstatus" checked="true">
            <label class="form-check-label" style="margin-right:30px;">Baru</label>
            <input class="form-check-input" type="radio" name="inputstatus">
            <label class="form-check-label" style="margin-right:30px;">Aktif</label>
            <input class="form-check-input" type="radio" name="inputstatus" <?php //if($kredit->STATUS_AKTIF=="3"){echo 'checked';}?>>
            <label class="form-check-label">Lunas</label>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
            <label for="inputnasabahid">Nasabah ID</label>                                
        </div>
        <div class="col-lg-12 col-sm-12">        
            <div class="input-group mb-2 autocomplete">                                  
              <input type="text" class="form-control" name="inputnasabahid" required>
              <div class="input-group-prepend">
                <div class="input-group-text"><span class="input-group-addon">
                  <i class="fa fa-search"></i>
                  </span>
                </div>
              </div>
            </div>                              
        </div>
        <div class="col-lg-12 col-sm-12">
            <label for="inputnasabahnama">Nama Nasabah</label>
            <input type="text" name="inputnasabahnama" readonly class="form-control">
        </div>
        <div class="col-lg-12 col-sm-12">
            <label for="inputnasabahalamat">Alamat</label>
            <input type="text" name="inputnasabahalamat" readonly class="form-control">
        </div>
        <div class="col-lg-12 col-sm-12">
            <label for="inputnopkbaru">No PK Baru</label>
            <input type="text" name="inputnopkbaru" class="form-control">
        </div>
        <div class="col-lg-6 col-sm-12">
          <label for="inputreschedule">.</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="inputreschedule" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
            <label class="form-check-label" style="margin-right:30px;">Re-Schedule</label>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <label for="inputwo">.</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="inputwo" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
            <label class="form-check-label" style="margin-right:30px;">Write-off</label>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <label for="inputkodegorup1">Kode Group 1</label>
          <select class="form-control" name="inputkodegorup1">
            @foreach($kodegroup1kredit as $kodegroup1kredit)
              <option value="{{ $kodegroup1kredit->KODE_GROUP1 }}">{{ $kodegroup1kredit->KODE_GROUP1.' - '.$kodegroup1kredit->DESKRIPSI_GROUP1 }}</option>
            @endforeach                                  
          </select>
        </div>
        <div class="col-lg-12 col-sm-12">
          <label for="inputkodegorup2">Kode Group 2</label>
          <select class="form-control" name="inputkodegorup2">
            @foreach($kodegroup2kredit as $kodegroup2kredit)
              <option value="{{ $kodegroup2kredit->KODE_GROUP2 }}">{{ $kodegroup2kredit->KODE_GROUP2.' - '.$kodegroup2kredit->DESKRIPSI_GROUP2 }}</option>
            @endforeach 
          </select>
        </div>
        <div class="col-lg-12 col-sm-12">
          <label for="inputkodegorup3">Kode Group 3</label>
          <select class="form-control" name="inputkodegorup3">
            @foreach($kodegroup3kredit as $kodegroup3kredit)
              <option value="{{ $kodegroup3kredit->KODE_GROUP3 }}">{{ $kodegroup3kredit->KODE_GROUP3.' - '.$kodegroup3kredit->DESKRIPSI_GROUP3 }}</option>
            @endforeach 
          </select>
        </div>
        <div class="col-lg-12 col-sm-12">
          <label for="inputkodegorup4">Kode Group 4</label>
          <select class="form-control" name="inputkodegorup4" readonly>
            <option value="{{ 'KODE_GROUP4' }}">{{ 'KODE_GROUP4'.' - '.'DESKRIPSI_GROUP4' }}</option>
          </select>
        </div>
        <div class="col-lg-12 col-sm-12">
          <label for="inputsumberdana">Sumber Dana</label>
          <select class="form-control" name="inputsumberdana" required>
            @foreach($kodesumberdanakredit as $kodesumberdanakredit)
              <option value="{{ $kodesumberdanakredit->KODE_SUMBER_DANA }}">{{ $kodesumberdanakredit->KODE_SUMBER_DANA.' - '.$kodesumberdanakredit->DESKRIPSI_SUMBER_DANA }}</option>
            @endforeach 
          </select>
        </div>
        <div class="col-lg-12 col-sm-12">
          <label for="inputdana">Dana</label>
          <select class="form-control" name="inputdana" readonly>
            <option value="">SUMBER DANA</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="bottomlinesolid">
    <span class="judulOrange">Angsuran</span>
  </div>
  <div class="form-group row">
    <div class="col-lg-3">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <label for="inputtipepinjaman">Tipe Pinjaman</label>
          <select class="form-control" name="inputtipepinjaman">
            @foreach($kodetypekredit as $kodetypekredit)
              <option value="{{ $kodetypekredit->KODE_TYPE_KREDIT }}">{{ $kodetypekredit->KODE_TYPE_KREDIT.' - '.$kodetypekredit->DESKRIPSI_TYPE_KREDIT }}</option>
            @endforeach 
          </select>
        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputtanggal">Tanggal</label>
          <input type="text" name="inputtanggalpengajuan" class="form-control" required>
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputtanggalrealisasi">Tgl Realisasi</label>
          <input type="text" name="inputtanggalrealisasi" onchange="setMulaiAngsuran()" class="form-control" required>
        </div>
        <div class="col-lg-4 col-sm-12">
          <label for="inputjumlahpinjaman">Jumlah</label>
          <input type="text" name="inputjumlahpinjaman" class="form-control" required>
        </div>
        <div class="col-lg-4 col-sm-12">
          <label for="inputjumlahbungapinjaman">Margin</label>
          <input type="text" name="inputjumlahbungapinjaman" readonly class="form-control" required>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputjmlangsuran">Jml. Angsuran</label>
          <input type="text" name="inputjmlangsuran" class="form-control" required onchange="hitungjmlangsuran()">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputsatuanwaktuangsuran">.</label>
          <select class="form-control" name="inputsatuanwaktuangsuran" onchange="hitungjmlangsuran()">
          @foreach($kodesatuanwaktuangsuran as $kodesatuanwaktuangsuran)
              <option value="{{ $kodesatuanwaktuangsuran->KODE_SATUAN_WAKTU }}">{{ $kodesatuanwaktuangsuran->KODE_SATUAN_WAKTU.' - '.$kodesatuanwaktuangsuran->DESKRIPSI_SATUAN_WAKTU }}</option>
            @endforeach 
          </select>
        </div>
        <div class="col-lg-1 col-sm-12">
          <label for="inputjw">Jk Wktu</label>
          <input type="text" name="inputjw" readonly class="form-control">
        </div>
        <div class="col-lg-1 col-sm-12">
          <label for="inputjwbln">.</label>
          <input type="text" name="inputjwbln" value="bln" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputtanggaljttempo">Tanggal Jt Tempo</label>
          <input type="text" name="inputtanggaljttempo" readonly class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputbungaperthn">Bunga</label>
          <input type="text" name="inputbungaperthn" class="form-control" required onchange="hitungbunga()">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputbungaeffperthn">Bunga Eff.</label>
          <input type="text" name="inputbungaeffperthn" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputsukubunga">Suku Bunga</label>
          <input type="text" name="inputsukubunga" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputbyadmin">Admin</label>
          <input type="text" name="inputbyadmin" value=0 class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputbybonus">Bonus</label>
          <input type="text" name="inputbybonus" value=0 class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputfaktoanuitas">Faktor Anuitas</label>
          <input type="text" name="inputfaktoanuitas" value=0 class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputterminpokok">Termin Pokok</label>
          <input type="text" name="inputterminpokok" value=1 class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputterminbunga">Termin Bunga</label>
          <input type="text" name="inputterminbunga" value=1 class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputgppokok">Grace Period Pokok</label>
          <input type="text" name="inputgppokok" value=0 class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputgpbunga">Grace Period Bunga</label>
          <input type="text" name="inputgpbunga" value=0 class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputangsuranblnpersen">Angsuran per Bulan</label>
          <input type="text" name="inputangsuranblnpersen" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputangsuranbln">Angsuran</label>
          <input type="text" name="inputangsuranbln" readonly class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputbungaekiv">Bunga Ekiv.</label>
          <input type="text" name="inputbungaekiv" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputbungaekivbln">.</label>
          <input type="text" name="inputbungaekivbln" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputangsuranfee1">Angs. Fee I</label>
          <input type="text" name="inputangsuranfee1" class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputangsuranfee1rp">Rp.</label>
          <input type="text" name="inputangsuranfee1rp" class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputangsuranfee2">Angs. Fee II</label>
          <input type="text" name="inputangsuranfee2" class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputangsuranfee2rp">Rp.</label>
          <input type="text" name="inputangsuranfee2rp" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputdendaharian">Denda</label>
          <input type="text" name="inputdendaharian" value="0" class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputdendajtharian">Denda JT</label>
          <input type="text" name="inputdendajtharian" value="0" class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputgphari">Grace Period</label>
          <input type="text" name="inputgphari" value="0" class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputbyadminpersen">Adm</label>
          <input type="text" name="inputbyadminpersen" value="0" class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputtotaldenda">.</label>
          <input type="text" name="inputtotaldenda" value="0.00" readonly class="form-control">
        </div>
      </div>
    </div>
  </div>
  <div class="bottomlinesolid">
    <span class="judulOrange">Biaya & Potongan Pinjaman</span>
  </div>
  <div class="form-group row">
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <label for="inputprovisi">Provisi</label>
          <input type="text" name="inputprovisi" value="0" class="form-control">
        </div>
        <div class="col-lg-5 col-sm-12">
          <label for="inputprovisirp">.</label>
          <input type="text" name="inputprovisirp"  onchange="hitungprovisi()" value="0" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputamortisasiprovisi">.</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="inputamortisasiprovisi" <?php //if($kredit->AMORTISASI_PROVISI=="1"){echo 'checked';}?>>
            <label class="form-check-label" style="margin-right:30px;">Amortisasi</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <label for="inputadmfinal">Adm</label>
          <input type="text" name="inputadmfinal"  value="0" class="form-control">
        </div>
        <div class="col-lg-5 col-sm-12">
          <label for="inputadmfinalrp">.</label>
          <input type="text" name="inputadmfinalrp"  value="0" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputamortisasiadm">.</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="inputamortisasiadm" <?php //if($kredit->amortisasi_adm=="1"){echo 'checked';}?>>
            <label class="form-check-label" style="margin-right:30px;">Amortisasi</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <label for="inputbytrans">By. Trans</label>
          <input type="text" name="inputbytrans"  value="0" class="form-control">
        </div>
        <div class="col-lg-5 col-sm-12">
          <label for="inputbytransrp">.</label>
          <input type="text" name="inputbytransrp"  value="0" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputamortisasibytrans">.</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="inputamortisasibytrans" <?php //if($kredit->amortisasi_biaya_transaksi=="1"){echo 'checked';}?>>
            <label class="form-check-label" style="margin-right:30px;">Amortisasi</label>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="row">
        <div class="col-lg-3 col-sm-12">
          <label for="inputpremi">Premi</label>
          <input type="text" name="inputpremi"  value="0" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputnotariel">Notariel</label>
          <input type="text" name="inputnotariel"  value="0" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputmaterai">Materai</label>
          <input type="text" name="inputmaterai"  value="0" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputpkmaterai">Pokok Materai</label>
          <input type="text" name="inputpkmaterai"  value="0" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-12">
          <label for="inputlainlain">Lain-lain</label>
          <input type="text" name="inputlainlain"  value="0" class="form-control">
        </div>
        <div class="col-lg-1 col-sm-12">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputangsuranpremi">Angs. Premi</label>
          <input type="text" name="inputangsuranpremi"  value="0" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputangsuranpremirp">.</label>
          <input type="text" name="inputangsuranpremirp" value="0" class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputtotalpremi">Total Premi</label>
          <input type="text" name="inputtotalpremi" value="0" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputditanggungcheck">.</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="inputditanggungcheck" <?php //if($kredit->amortisasi_biaya_transaksi=="1"){echo 'checked';}?>>
            <label class="form-check-label" style="margin-right:30px;">Ditanggung</label>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
          <label for="inputditanggung">Ditanggung</label>
          <input type="text" name="inputditanggung"  value="0" class="form-control">
        </div>
      </div>
    </div>
  </div>
  <div class="bottomlinesolid">
    <span class="judulOrange">Saldo & Kolektibilitas</span>
  </div>
  <div class="form-group row">
    <div class="col-lg-9">
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputpokoksaw">Saldo Awal Pokok</label>
          <input type="text" name="inputpokoksaw" value="0" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputpokokdb">Debet Pokok</label>
          <input type="text" name="inputpokokdb" value="0}" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputpokokkr">Kredit Pokok</label>
          <input type="text" name="inputpokokkr" value="0" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputpokokdc">Discount Pokok</label>
          <input type="text" name="inputpokokdc" value="0" readonly class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputpokoksak">Saldo Akhir Pokok</label>
          <input type="text" name="inputpokoksak" value="0" readonly class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-sm-12">
          <label for="inputbungasaw">Saldo Awal Bunga</label>
          <input type="text" name="inputbungasaw" value="0" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputbungadb">Debet Bunga</label>
          <input type="text" name="inputbungadb" value="0" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputbungakr">Kredit Bunga</label>
          <input type="text" name="inputbungakr" value="0" readonly class="form-control">
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputbungadc">Discount Bunga</label>
          <input type="text" name="inputbungadc" value="0" readonly class="form-control">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputbungasak">Saldo Akhir Bunga</label>
          <input type="text" name="inputbungasak" value="0" readonly class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-sm-12">
        </div>
        <div class="col-lg-3 col-sm-12">
          <label for="inputsaldohapusbuku">Saldo Hapus Buku</label>
          <input type="text" name="inputsaldohapusbuku" value="0" readonly class="form-control">
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="row">
        <div class="col-lg-6 col-sm-12">
          <label for="inputkol">Kolektibilitas</label>
          <input type="text" name="inputkol" value="0" readonly class="form-control">
        </div>
        <div class="col-lg-6 col-sm-12">
          <label for="inputreschedule">Rescheduling</label>
          <input type="text" name="inputreschedule" value="0" readonly class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <label for="inputkonfig">Konfigurasi</label>
          <select class="form-control" name="inputkonfig" readonly>
            <option value="">OTOMATIS</option>
          </select>
        </div>
      </div>
    </div>
  </div>                                                                                        
</div> 