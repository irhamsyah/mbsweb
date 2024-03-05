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

<meta name="csrf-token" content="{{ csrf_token() }}" >

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card-header">
          <h3 class="card-title">Angsuran Kredit</h3>
        </div>         
        <div class="card card-warning card-outline">
              
          <!-- form start -->
          <form autocomplete="off" method="POST" action="/bo_tl_tk_realisasikredit/saveAngsuran" role="search">
            @csrf
            <div class="card-body"> 
                <div class="form-group" >
                      <div class="row">
                          <div class="col-lg-1 col-sm-6">
                                <label for="nasabahid">No Rekening</label>
                          </div>
                          <div class="col-lg-2 col-sm-6">
                            <!-- <label for="nasabahid">No Rekening</label> -->
                            <div class="input-group mb-2 autocomplete" >
                              <input id="no_rekening_kredit" type="text" name="no_rekening_kredit" class="form-control">
                              <div class="input-group-prepend">
                                <div class="input-group-text"><span class="input-group-addon">
                                  <i class="fa fa-search"></i>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>   
                          <div class="col-lg-4">
                            <br>
                          </div>                  
                          <div class="col-lg-3 col-sm-12"> 
                            <div class="bottomlinesolid">
                              <span class="judulOrange">Channeling Overbooking ke Tabungan </span>
                            </div>
                          </div> 
                          <div class="col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="gl_check" checked="true">
                              <label class="form-check-label" style="margin-right:30px;">GL</label>
                              <input class="form-check-input" type="radio" name="tabungan_check">
                              <label class="form-check-label" style="margin-right:30px;">Tabungan</label>
                            </div>
                          </div>
                      </div>  
                      <div class="row" hidden>  
                          <div class="col-lg-2 col-sm-6">
                            <label for="inputopendate">ID Nasabah</label>
                            <input readonly id="id_nasabah" type="text" name="id_nasabah" class="form-control">
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-1 col-sm-8"></div>
                          <div class="col-lg-3 col-sm-6">
                              <label for="inputnasabahid" hidden>Nama</label>
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                          </div>  
                          <div class="col-lg-1 col-sm-8"></div>
                          <div class="col-lg-2 col-sm-8">
                            <label for="inputnocif">Jml Kredit</label>
                            <input type="text" name="jml_pinjaman" value="0" class="form-control" id="jml_pinjaman">
                          </div>  
                          <div class="col-lg-2 col-sm-8">
                            <input class="form-check-input" style="margin-left:0px;" type="checkbox" name="channeling_check" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                            <label class="form-check-label" style="margin-left:20px;">Channeling</label> 
                          </div>                    
                      </div>
                      <br>
                      <div class="from-group ">
                        <div class="row">
                          <div class="form-check col-lg-2 col-sm-6">
                            <input class="form-check-input" style="margin-left:-13px;" type="checkbox" name="re_scheduling_check" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                            <label class="form-check-label" style="margin-left:30px;">Re-Scheduling</label>
                            <br>
                            <input class="form-check-input" style="margin-left:-13px;" type="checkbox" name="writeoff_check" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                            <label class="form-check-label" style="margin-left:30px;">Write Off</label>
                          </div>
                          <div class="col-lg-3 col-sm-6">
                              <label for="inputnasabahid" hidden>Nama</label>
                              <input type="text" id="nama_nasabah2" name="nama_nasabah2" readonly class="form-control" >
                          </div>  
                          <div class="col-lg-2 col-sm-8">
                            <input type="text" id="flag_jadwal" name="flag_jadwal" readonly class="form-control" >
                          </div>
                          <div class="col-lg-3 col-sm-12"> 
                            <label for="nasabahid">Kode Trans. Tabungan Setoran Pokok</label>
                            <select class="form-control" name="kode_transtab_setoran_pokok" id="kode_transtab_setoran_pokok">
                              @php($i=0)
                              @while ($i<count($kodetranstab) )
                              <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}" <?php if($kodetranstab[$i]->KODE_TRANS=='21'){echo 'selected';}?>>{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                                  @php($i++)
                              @endwhile
                            </select>
                          </div>                           
                        </div>                        
                      </div>
                      <div class="form-group row"> 
                        <div class="col-lg-2">
                          <br>
                        </div>
                        <div class="col-lg-3 col-sm-12"> 
                          <div class="bottomlinesolid">
                            <span class="judulOrange">Out Standing - Baki Debet</span>
                          </div>
                        </div> 
                      </div>
                      <div class="row">
                          <div class="col-lg-2 col-sm-6">
                            <label for="inputopendate" hidden>.</label>
                            <select class="form-control" name="kode_transaksi" id="kode_transaksi" readonly>
                              <option value="kredit">{{'Kredit'}}</option>
                            </select>
                          </div> 
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Pokok</label>
                              <input type="text" id="baki_debet_pokok" value="0" name="baki_debet_pokok" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-1 col-sm-6"></div>
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Bunga</label>
                              <input type="text" id="baki_debet_bunga" value="0" name="baki_debet_bunga" readonly class="form-control" >
                          </div>  
                          <div class="col-lg-5"> 
                            <div class="row">
                              <div class="col-lg-6 col-sm-6">
                                <label for="nasabahid">No. Rekening Tabungan</label>
                                <div class="input-group mb-2 autocomplete">
                                  <input id="rekening_transtab_setoran_pokok" type="text" name="rekening_transtab_setoran_pokok" class="form-control">
                                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                                </div>
                              </div>  
                              <div class="col-lg-6 col-sm-6">
                                <label for="inputDate1">.</label>
                                <div class="row">
                                  <div class="col-lg-12 input-group  " id="inputDate1" data-target-input="nearest">
                                      <input type="text" name="nama_transtab_setoran_pokok" id="nama_transtab_setoran_pokok" class="form-control datetimepicker-input" required>
                                  </div>
                                </div>
                              </div>  
                            </div>  
                          </div>                                           
                      </div>    
                      <div class="form-group row"> 
                        <div class="col-lg-2">
                          <br>
                        </div>
                        <div class="col-lg-3 col-sm-12"> 
                          <div class="bottomlinesolid">
                            <span class="judulOrange" name="label_total_tagihan">Total Tagihan s.d Tanggal :</span>
                          </div>
                        </div> 
                      </div>
                      <div class="row">
                          <div class="col-lg-2 col-sm-12">
                            <label for="inputDate1">Tgl Realisasi</label>
                            <div class="input-group" id="inputDate1" data-target-input="nearest">
                                <input type="text" name="tgl_realisasi" id="tgl_realisasi" value='{{ $tanggaltransaksi }}' class="form-control datetimepicker-input" required>
                            </div>
                            <label for="inputDate1">Tgl Akhir Bulan</label>
                            <div class="input-group" id="inputDate1" data-target-input="nearest">
                                <input type="text" name="tgl_akhir_bulan" id="tgl_akhir_bulan" value='{{ $tglakhirbulan }}' class="form-control datetimepicker-input" required>
                            </div>
                          </div> 
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >.</label>
                              <input type="text" id="pokok_total" value="0" name="pokok_total" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-1 col-sm-6"></div>
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >.</label>
                              <input type="text" id="bunga_total" value="0" name="bunga_total" readonly class="form-control" >
                          </div>                                                       
                      </div>    
                      <div class="form-group row"> 
                        <div class="col-lg-2">
                          <br>
                        </div>
                        <div class="col-lg-3 col-sm-12"> 
                          <div class="bottomlinesolid">
                            <span class="judulOrange">Tunggakan s.d Tanggal :</span>
                          </div>
                        </div> 
                      </div>
                      <div class="row">
                          <div class="col-lg-2 col-sm-6">
                            <label for="inputDate1">Periode Angs.</label>
                            <div class="input-group  " id="inputDate1" data-target-input="nearest">
                                <input type="text" name="periode_angs" id="periode_angs" class="form-control datetimepicker-input" required>
                            </div>
                            <label for="inputDate1">Jml. Angs.</label>
                            <div class="input-group  " id="inputDate1" data-target-input="nearest">
                                <input type="text" name="jml_angs" id="jml_angs" class="form-control datetimepicker-input" required>
                            </div>
                          </div> 
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Pokok</label>
                              <input type="text" id="pokok_tunggakan" value="0" name="pokok_tunggakan" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-1 col-sm-6"></div>
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Bunga</label>
                              <input type="text" id="bunga_tunggakan" value="0" name="bunga_tunggakan" readonly class="form-control" >
                          </div>   
                          <div class="col-lg-3 col-sm-12"> 
                            <label for="nasabahid">Kode Trans. Tabungan Setoran Bunga</label>
                            <select class="form-control" name="kode_transtab_setoran_bunga" id="kode_transtab_setoran_bunga">
                              @php($i=0)
                              @while ($i<count($kodetranstab) )
                              <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                                  @php($i++)
                              @endwhile
                            </select>
                          </div>                                                                              
                      </div>  
                      <div class="form-group row"> 
                        <div class="col-lg-2">
                          <br>
                        </div>
                        <div class="col-lg-3 col-sm-12"> 
                          <div class="bottomlinesolid">
                            <span class="judulOrange">Saldo Akhir</span>
                          </div>
                        </div> 
                      </div>
                      <div class="row">
                          <div class="col-lg-2 col-sm-6">
                            <label for="inputDate1">Bunga Hari Mengendap</label>
                            <div class="row">
                              <div class="col-lg-6 input-group  " id="inputDate1" data-target-input="nearest">
                                  <input type="text" name="bunga_hari_mengendap1" value="0" id="bunga_hari_mengendap1" class="form-control datetimepicker-input" required>
                              </div>
                              <div class="col-lg-6 input-group  " id="inputDate1" data-target-input="nearest">
                                  <input type="text" name="bunga_hari_mengendap2" value="0" id="bunga_hari_mengendap2" class="form-control datetimepicker-input" required>
                              </div>
                            </div>
                          </div> 
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Pokok</label>
                              <input type="text" id="pokok_saldo_akhir" value="0" name="pokok_saldo_akhir" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-1 col-sm-6"></div>
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Bunga</label>
                              <input type="text" id="bunga_saldo_akhir" value="0" name="bunga_saldo_akhir" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-5">
                            <div class="row">
                              <div class="col-lg-6 col-sm-6">
                                <label for="nasabahid">No. Rekening Tabungan</label>
                                <div class="input-group mb-2 autocomplete">
                                  <input id="rekening_transtab_setoran_bunga" type="text" name="rekening_transtab_setoran_bunga" class="form-control">
                                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                                </div>
                              </div> 
                              <div class="col-lg-6 col-sm-6">
                                <label for="inputDate1">.</label>
                                <div class="row">
                                  <div class="col-lg-12 input-group  " id="inputDate1" data-target-input="nearest">
                                      <input type="text" name="nama_transtab_setoran_bunga" id="nama_transtab_setoran_bunga" class="form-control datetimepicker-input" required>
                                  </div>
                                </div>
                              </div> 
                            </div> 
                          </div>                                                      
                      </div>
                    
                </div>   
                <div class="form-group row">
                  <div class="col-lg-7 col-sm-12"> 
                    <div class="bottomlinesolid">
                      <span class="judulOrange">Status Pembayaran </span>
                    </div>
                  </div> 
                  <div class="col-lg-5 col-sm-12"> 
                    <div class="bottomlinesolid">
                      <span class="judulOrange">Overbooking Bonus ke Tabungan </span>
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputDate1">Kolektibilitas</label>
                    <div class="row">
                      <div class="col-lg-6 input-group  " id="inputDate1" data-target-input="nearest">
                          <input type="text" name="kolektibilitas" id="kolektibilitas" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-2 col-sm-6"></div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate1">Sisa Bunga Akrual</label>
                    <div class="row">
                      <div class="col-lg-6 input-group  " id="inputDate1" data-target-input="nearest">
                          <input type="text" name="sisa_bunga_akrual" value="0" id="sisa_bunga_akrual" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-sm-12"> 
                    <label for="nasabahid">Kode Trans. Tabungan</label>
                    <select class="form-control" name="kode_transtab_overbooking_bonus" id="kode_transtab_overbooking_bonus">
                      @php($i=0)
                      @while ($i<count($kodetranstab) )
                      <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                          @php($i++)
                      @endwhile
                    </select>
                  </div>
                  <div class="col-lg-2 col-sm-6">
                    <label for="inputDate1">Bonus</label>
                    <div class="row">
                      <div class="col-lg-12 input-group  " id="inputDate1" data-target-input="nearest">
                          <input type="text" name="overbooking_bonus" value="0" id="overbooking_bonus" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate1">Bunga akrual</label>
                    <div class="row">
                      <div class="col-lg-6 input-group  " id="inputDate1" data-target-input="nearest">
                          <input type="text" name="bunga_akrual" value="0" id="bunga_akrual" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-4"></div>
                  <div class="col-lg-5">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                        <label for="nasabahid">No. Rekening Tabungan</label>
                        <div class="input-group mb-2 autocomplete">
                          <input id="rekening_transtab_overbooking_bonus" type="text" name="rekening_transtab_overbooking_bonus" class="form-control">
                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                        </div>
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                        <label for="inputDate1">.</label>
                        <div class="row">
                          <div class="col-lg-12 input-group  " id="inputDate1" data-target-input="nearest">
                              <input type="text" name="nama_transtab_overbooking_bonus" id="nama_transtab_overbooking_bonus" class="form-control datetimepicker-input" required>
                          </div>
                        </div>
                      </div> 
                    </div> 
                  </div>  
                </div>
                <div class="row">
                  <div class="col-lg-4 col-sm-6">
                    <label for="inputDate1">Base Denda</label>
                    <div class="row">
                      <div class="col-lg-8 input-group  " id="inputDate1" data-target-input="nearest">
                          <input type="text" name="base_denda" id="base_denda" class="form-control datetimepicker-input" required>
                      </div>
                      <div class="col-lg-3 input-group  " id="inputDate1" data-target-input="nearest">
                          <input type="text" name="base_denda_persen" value="0" id="base_denda_persen" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-sm-6"></div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate1">Denda Bonus</label>
                    <div class="row">
                      <div class="col-lg-6 input-group  " id="inputDate1" data-target-input="nearest">
                          <input type="text" name="denda_bonus" value="0" id="denda_bonus" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div>                 
                </div>
                <div class="form-group row">
                  <div class="col-lg-1 col-sm-6">
                      <label for="inputnasabahid" >.</label>
                      <input type="text" id="tob" name="tob" readonly class="form-control" value="O" >
                  </div>   
                  <div class="col-lg-3 col-sm-12"> 
                    <label for="nasabahid">Kode Trans.</label>
                    <select class="form-control" name="kode_transkredit" id="kode_transkredit">
                     @php($i=0)
                      @while ($i<count($kodetranskredit) )
                      <option value="{{$kodetranskredit[$i]->KODE_TRANS}}" <?php if($kodetranskredit[$i]->KODE_TRANS=='003'){echo 'selected';}?>>{{$kodetranskredit[$i]->KODE_TRANS}}-{{$kodetranskredit[$i]->DESKRIPSI_TRANS}}</option>
                          @php($i++)
                      @endwhile
                    </select>
                  </div>
                  <div class="col-lg-3 col-sm-12"> 
                    <label for="nasabahid">Kode Trans. Tabungan Wajib</label>
                    <select class="form-control" name="kode_transtab_wajib" id="kode_transtab_wajib">
                      @php($i=0)
                      @while ($i<count($kodetranstab) )
                      <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                          @php($i++)
                      @endwhile
                    </select>
                  </div> 
                </div>
                <div class="form-group row">
                  <div class="col-lg-1 col-sm-6">
                      <label for="inputnasabahid" >Cicilan ke</label>
                      <input type="text" id="cicilan_ke" value="0" name="cicilan_ke" onchange="setCicilan()" class="form-control" >
                  </div> 
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnasabahid" >Tgl Tagihan</label>
                      <input type="text" id="tgl_tagihan" name="tgl_tagihan" class="form-control" >
                  </div> 
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnasabahid" >Tgl Trans</label>
                      <input type="text" id="tgl_trans" name="tgl_trans" value='{{ $tanggaltransaksi }}' class="form-control" >
                  </div> 
                  <div class="col-lg-2 col-sm-12"> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="check_pelunasan" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
                        <label class="form-check-label" style="margin-right:30px;">Pelunasan</label>
                    </div>      
                  </div> 
                  <div class="col-lg-5 col-sm-12"> 
                    <div class="bottomlinesolid">
                      <span class="judulOrange">Overbooking dari Tabungan </span>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Pokok</label>
                          <input type="text" id="pokok_pembayaran" value="0" name="pokok_pembayaran" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Bunga</label>
                          <input type="text" id="bunga_pembayaran" value="0" name="bunga_pembayaran" class="form-control" >
                      </div> 
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnasabahid" >Denda</label>
                      <input type="text" id="denda_pembayaran" value="0" name="denda_pembayaran" class="form-control" >
                  </div> 
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnasabahid" >Tab. Wajib</label>
                      <input type="text" id="tab_wajib" name="tab_wajib" value="0" class="form-control" >
                  </div>
                  <div class="col-lg-3 col-sm-12"> 
                    <label for="nasabahid">Kode Trans. Tabungan</label>
                    <select class="form-control" name="kode_transtab_overbooking" id="kode_transtab_overbooking">
                      @php($i=0)
                      @while ($i<count($kodetranstab) )
                      <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}" <?php if($kodetranstab[$i]->KODE_TRANS=='08'){echo 'selected';}?>>{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                          @php($i++)
                      @endwhile
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Disc.</label>
                          <input type="text" id="disc_pokok" value="0" name="disc_pokok" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Disc.</label>
                          <input type="text" id="disc_bunga" value="0" name="disc_bunga" class="form-control" >
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Disc.</label>
                        <input type="text" id="disc_denda" value="0" name="disc_denda" class="form-control" >
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Adm.</label>
                        <input type="text" id="biaya_admin" value="0" name="biaya_admin" class="form-control" >
                    </div>
                    <div class="col-lg-5"> 
                      <div class="row">
                        <div class="col-lg-6 col-sm-6">
                          <label for="nasabahid">No. Rekening Tabungan</label>
                          <div class="input-group mb-2 autocomplete">
                            <input id="rekening_overbook" type="text" name="rekening_overbook" class="form-control">
                              <div class="input-group-text"><i class="fa fa-search"></i></div>
                          </div>
                        </div>  
                        <div class="col-lg-6 col-sm-6">
                          <label for="inputDate1">.</label>
                          <div class="row">
                            <div class="col-lg-12 input-group  " id="inputDate1" data-target-input="nearest">
                                <input type="text" name="nama_overbook" id="nama_overbook" class="form-control datetimepicker-input" required>
                            </div>
                          </div>
                        </div>  
                      </div>  
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Sisa Provisi</label>
                          <input type="text" id="sisa_provisi" value="0" name="sisa_provisi" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Administrasi Lain</label>
                        <input type="text" id="admin_lain" value="0" name="admin_lain" class="form-control" >
                    </div>
                    <div class="col-lg-2 col-sm-6">
                      <label for="inputDate1">.</label>
                      <div class="row">
                        <div class="col-lg-12 input-group  " id="inputDate1" data-target-input="nearest">
                            <input type="text" name="nama_overbook" id="nama_overbook" class="form-control datetimepicker-input" required>
                        </div>
                      </div>
                    </div> 
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Sisa ByAdmin</label>
                          <input type="text" id="sisa_byadmin" value="0" name="sisa_byadmin" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Jumlah Setoran</label>
                        <input type="text" id="jumlah_setoran" value="0" name="jumlah_setoran" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Sisa ByTrans</label>
                          <input type="text" id="sisa_bytrans" value="0" name="sisa_bytrans" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Jumlah Uang</label>
                        <input type="text" id="jumlah_uang" value="0" name="jumlah_uang" class="form-control" onchange="hitungKembalian()">
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Kwitansi</label>
                          <input type="text" id="kwitansi" name="kwitansi" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Kembali</label>
                        <input type="text" id="kembali" value="0" name="kembali" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-5">
                    <div class="row">
                      <div class="col-lg-12 col-sm-6">
                          <label for="inputnasabahid" >Keterangan</label>
                          <input type="text" id="keterangan" name="keterangan" class="form-control" >
                      </div>
                    </div>                    
                </div>                                   
            </div>
            <!-- /.card-body -->
            <div class="form-group row"> 
              <div class="col-lg-12 col-sm-12"> 
                <div class="bottomlinesolid">
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button name="btn_cetak" type="button" class="btn btn-primary" disabled>Cetak Kwitansi</button>
              <div class="justify-right">
                <button name="btn_save" type="button" class="btn btn-primary" onclick="save_angsuran();">Simpan</button>
                <button name="btn_reset" type="button" class="btn btn-primary" onclick="window.location.reload();">Reset</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
        <div class="card">
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>                
</div>
<!-- /.content -->
@endsection


<script>
function autocomplete(inp, arr, nama, alamat, 
s) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length) + ' - ' + nama[i];
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value.trim();  
              kredits.forEach(findIndex);
              function findIndex(value, index, array) {
                if(value.NO_REKENING.trim()==inp.value.trim()){
                 setKredit(index);
                } 
              }  
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");      
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
          // inpnama.value=nama[currentFocus];
          // inpalamat.value=alamat[currentFocus];
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active"); 
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {  
    closeAllLists(e.target);
  });
}

var kredits = {!! json_encode($kredits) !!};

var rekening=[];
var  nasabahnama=[];
var nasabahalamat=[];
kredits.forEach(splitData);
function splitData(value, index, array) {
  rekening.push(value.NO_REKENING);
  nasabahnama.push(value.nama_nasabah);
  nasabahalamat.push(value.alamat);  
}
window.onload = function(e){ 

  autocomplete(document.getElementsByName("no_rekening_kredit")[0], rekening, nasabahnama, nasabahalamat, kredits);
  autocomplete2(document.getElementsByName("rekening_overbook")[0],document.getElementsByName("nama_overbook")[0], rekening2, nasabahnama2, nasabahalamat2, tabungans);

}

function selectElement(id, valueToSelect) { 
    let element = document.getElementsByName(id)[0];
    element.value = valueToSelect;
}

function setTOB(){
  if(document.getElementsByName("kode_transaksi3")[0].value=="004"){
    document.getElementsByName("tipe_transaksi")[0].value = "O";
  }else{
    document.getElementsByName("tipe_transaksi")[0].value = "T";
  }
  // alert(document.getElementsByName("kode_transaksi3")[0].value);
}
function save_angsuran(){
  $.ajaxSetup({
      beforeSend: function(xhr,type){
        if(!type.crossDomain){
          xhr.setRequestHeader('X-CSRF_TOKEN',$('meta[name="csrf-token"]').attr('content'))
        }
      }
  });
  $.post("bo_tl_tk_setoranangsuran/saveAngsuran", function(data){
    alert(data['message']);
    if(data['status']==1){
      document.getElementsByName("btn_cetak")[0].disabled=false;
      document.getElementsByName("btn_save")[0].disabled=true;
    }
  });
}
function setCicilan(){
  // alert(kredit_index);
  data_cicilan = [];
  total_tagihan_pokok = 0;
  total_tagihan_bunga = 0;
  $.get("bo_tl_tk_setoranangsuran/getCicilan?norek="+document.getElementsByName("no_rekening_kredit")[0].value, function(data){
    data_cicilan = data;
  });
  $.get("bo_tl_tk_setoranangsuran/getAngsuran?norek="+document.getElementsByName("no_rekening_kredit")[0].value, function(data){
    for(i=0;i<data.length;i++){
      parts = data[i]["TGL_TRANS"].split('-');
      tgl_trans = parts[2] + "/" + parts[1]  + "/" +  parts[0];
      // alert(tgl_trans);
      if(document.getElementsByName("cicilan_ke")[0].value==data[i]["ANGSURAN_KE"]){
        document.getElementsByName("tgl_tagihan")[0].value = tgl_trans;
        document.getElementsByName("label_total_tagihan")[0].innerHTML = "Total Tagihan s.d Tanggal : " + tgl_trans;
        var date = new Date(data[i]["TGL_TRANS"]), y = date.getFullYear(), m = date.getMonth();
        var lastDay = new Date(y, m + 1, 0);
        let yyyy = lastDay.getFullYear();
        let mm = lastDay.getMonth() + 1; // Months start at 0!
        let dd = lastDay.getDate();

        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
        document.getElementsByName("tgl_akhir_bulan")[0].value = dd + '/' + mm + '/' + yyyy;
        // alert(dd + '/' + mm + '/' + yyyy);
      }
      if(i<document.getElementsByName("cicilan_ke")[0].value){
        if(data_cicilan[i]){
          total_tagihan_pokok = total_tagihan_pokok + Number(data[i]["POKOK_TRANS"]) - Number(data_cicilan[i]["POKOK_TRANS"]);
          total_tagihan_bunga = total_tagihan_bunga + Number(data[i]["BUNGA_TRANS"]) - Number(data_cicilan[i]["BUNGA_TRANS"]);        
      
        }else{
          total_tagihan_pokok = total_tagihan_pokok + Number(data[i]["POKOK_TRANS"]);
          total_tagihan_bunga = total_tagihan_bunga + Number(data[i]["BUNGA_TRANS"]);              
        }
      }
      
    }
    
    document.getElementsByName("pokok_total")[0].value = total_tagihan_pokok;
    document.getElementsByName("bunga_total")[0].value = total_tagihan_bunga;
    document.getElementsByName("pokok_pembayaran")[0].value = total_tagihan_pokok;
    document.getElementsByName("bunga_pembayaran")[0].value = total_tagihan_bunga;
    document.getElementsByName("jumlah_setoran")[0].value = total_tagihan_pokok + total_tagihan_bunga;
    document.getElementsByName("pokok_saldo_akhir")[0].value = Number(document.getElementsByName("baki_debet_pokok")[0].value) - total_tagihan_pokok;
    document.getElementsByName("bunga_saldo_akhir")[0].value = Number(document.getElementsByName("baki_debet_bunga")[0].value) - total_tagihan_bunga;
    
  });
}
function hitungKembalian(){
  document.getElementsByName("kembali")[0].value = document.getElementsByName("jumlah_setoran")[0].value - document.getElementsByName("jumlah_uang")[0].value;
}
var kredit_index = 0;
function setKredit(index){
  kredit_index = index;
  // alert(kredit_index);
  document.getElementsByName("id_nasabah")[0].value=kredits[index].nasabah_id;
  document.getElementsByName("nama_nasabah")[0].value=kredits[index].nama_nasabah; 
  document.getElementsByName("jml_pinjaman")[0].value=kredits[index].JML_PINJAMAN;
  document.getElementsByName("flag_jadwal")[0].value=kredits[index].FLAG_JADWAL;
  document.getElementsByName("baki_debet_pokok")[0].value=kredits[index].POKOK_SALDO_AKHIR;
  document.getElementsByName("baki_debet_bunga")[0].value=kredits[index].BUNGA_SALDO_AKHIR;
  var parts = kredits[index].TGL_REALISASI.split('-');
  var mydate = parts[2] + '/' + parts[1] + '/' + parts[0];
  document.getElementsByName("tgl_realisasi")[0].value=mydate;
  document.getElementsByName("periode_angs")[0].value=kredits[index].SATUAN_WAKTU_ANGSURAN;
  document.getElementsByName("jml_angs")[0].value=kredits[index].BI_JANGKA_WAKTU; 
  // document.getElementsByName("bunga_hari_mengendap1")[0].value="30";
  document.getElementsByName("kolektibilitas")[0].value=kredits[index].KOLEKTIBILITAS; 
  document.getElementsByName("pokok_saldo_akhir")[0].value=kredits[index].POKOK_SALDO_AKHIR;
  document.getElementsByName("bunga_saldo_akhir")[0].value=kredits[index].BUNGA_SALDO_AKHIR;
  



  document.getElementsByName("jumlah_angsuran")[0].value=kredits[index].JML_ANGSURAN;
  parts = kredits[index].TGL_JATUH_TEMPO.split('-');
  mydate = parts[2] + '/' + parts[1] + '/' + parts[0];
  document.getElementsByName("jatuh_tempo")[0].value=mydate;
  document.getElementsByName("jumlah_bunga")[0].value=kredits[index].JML_BUNGA_PINJAMAN; 
  document.getElementsByName("persen_bunga")[0].value=kredits[index].SUKU_BUNGA_PER_TAHUN;
  selectElement('inputjeniskredit', kredits[index].JENIS_PINJAMAN);
  selectElement('inputtipepinjaman', kredits[index].TYPE_PINJAMAN);    
  document.getElementsByName("angsuran_pokok")[0].value=kredits[index].angsuran_pokok;
  document.getElementsByName("angsuran_bunga")[0].value=kredits[index].angsuran_bunga;
  document.getElementsByName("provisi")[0].value=kredits[index].PROVISI;
  document.getElementsByName("administrasi")[0].value=kredits[index].ADM;
  document.getElementsByName("total_diterima")[0].value=kredits[index].JML_PINJAMAN-kredits[index].PROVISI;
  parts = document.getElementsByName("tgl_transaksi")[0].value.split('/');
  const x = new Date(parts[2]+'-'+parts[1]+'-'+parts[0]);
  const y = new Date(kredits[index].TGL_REALISASI);
  if(y>x){
    alert("Belum bisa realisasi kredit");
  }else{
    // alert("sudah bisa realisasi")
    document.getElementsByName("btn_realisasi")[0].disabled=false;
  }
}

function autocomplete2(inp,inpnama, arr, nama, alamat, tabungans) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length) + ' - ' + nama[i];
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value.trim();  
                tabungans.forEach(findIndex);
                function findIndex(value, index, array) {
                  if(value.NO_REKENING.trim()==inp.value.trim()){
                    inpnama.value=nama[index];
                    // inpalamat.value=alamat[index]; 
                  } 
                }  
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");      
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
            inpnama.value=nama[currentFocus];
            // inpalamat.value=alamat[currentFocus];
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active"); 
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {  
      closeAllLists(e.target);
    });
  }

  var tabungans = {!! json_encode($tabungans) !!};

  var rekening2=[];
  var  nasabahnama2=[];
  var nasabahalamat2=[];
  tabungans.forEach(splitData2);
  function splitData2(value, index, array) {
    rekening2.push(value.NO_REKENING);
    nasabahnama2.push(value.nama_nasabah);
    nasabahalamat2.push(value.alamat);  
  }
  

</script>

<style>
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>