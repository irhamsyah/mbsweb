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
          <h3 class="card-title">Angsuran Kredit</h3>
        </div>         
        <div class="card card-warning card-outline">
              
          <!-- form start -->
          <form autocomplete="off" method="POST" action="/bo_tl_tk_realisasikredit/setrealisasi" role="search">
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
                            <input type="text" name="jml_pinjaman" class="form-control" id="jml_pinjaman">
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
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                          </div>  
                          <div class="col-lg-2 col-sm-8">
                            <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                          </div>
                          <div class="col-lg-3 col-sm-12"> 
                            <label for="nasabahid">Kode Trans. Tabungan Setoran Pokok</label>
                            <select class="form-control" name="kode_transaksi_hold_dana" id="kode_transaksi_hold_dana">
                              @php($i=0)
                              @while ($i<count($kodetranstab) )
                              <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
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
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-1 col-sm-6"></div>
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Bunga</label>
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
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
                                  <div class="col-lg-12 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                      <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
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
                            <span class="judulOrange">Total Tagihan s.d Tanggal :</span>
                          </div>
                        </div> 
                      </div>
                      <div class="row">
                          <div class="col-lg-2 col-sm-12">
                            <label for="inputDate1">Tgl Realisasi</label>
                            <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                            </div>
                            <label for="inputDate1">Tgl Akhir Bulan</label>
                            <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                            </div>
                          </div> 
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >.</label>
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-1 col-sm-6"></div>
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >.</label>
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
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
                            <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                            </div>
                            <label for="inputDate1">Jml. Angs.</label>
                            <div class="input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                            </div>
                          </div> 
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Pokok</label>
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-1 col-sm-6"></div>
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Bunga</label>
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                          </div>   
                          <div class="col-lg-3 col-sm-12"> 
                            <label for="nasabahid">Kode Trans. Tabungan Setoran Bunga</label>
                            <select class="form-control" name="kode_transaksi_hold_dana" id="kode_transaksi_hold_dana">
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
                              <div class="col-lg-6 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                  <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                              </div>
                              <div class="col-lg-6 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                  <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                              </div>
                            </div>
                          </div> 
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Pokok</label>
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                          </div> 
                          <div class="col-lg-1 col-sm-6"></div>
                          <div class="col-lg-2 col-sm-6">
                              <label for="inputnasabahid" >Bunga</label>
                              <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
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
                                  <div class="col-lg-12 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                      <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
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
                      <div class="col-lg-6 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-2 col-sm-6"></div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate1">Sisa Bunga Akrual</label>
                    <div class="row">
                      <div class="col-lg-6 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-sm-12"> 
                    <label for="nasabahid">Kode Trans. Tabungan</label>
                    <select class="form-control" name="kode_transaksi_hold_dana" id="kode_transaksi_hold_dana">
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
                      <div class="col-lg-12 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate1">Bunga akrual</label>
                    <div class="row">
                      <div class="col-lg-6 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-4"></div>
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
                          <div class="col-lg-12 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                              <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
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
                      <div class="col-lg-8 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                      </div>
                      <div class="col-lg-3 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-sm-6"></div>
                  <div class="col-lg-3 col-sm-6">
                    <label for="inputDate1">Denda Bonus</label>
                    <div class="row">
                      <div class="col-lg-6 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                          <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                      </div>
                    </div>
                  </div>                 
                </div>
                <div class="form-group row">
                  <div class="col-lg-1 col-sm-6">
                      <label for="inputnasabahid" >.</label>
                      <input type="text" id="nama_nasabah" name="nama_nasabah" readonly class="form-control" >
                  </div>   
                  <div class="col-lg-3 col-sm-12"> 
                    <label for="nasabahid">Kode Trans.</label>
                    <select class="form-control" name="kode_transaksi_hold_dana" id="kode_transaksi_hold_dana">
                      @php($i=0)
                      @while ($i<count($kodetranstab) )
                      <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
                          @php($i++)
                      @endwhile
                    </select>
                  </div>
                  <div class="col-lg-3 col-sm-12"> 
                    <label for="nasabahid">Kode Trans. Tabungan Wajib</label>
                    <select class="form-control" name="kode_transaksi_hold_dana" id="kode_transaksi_hold_dana">
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
                      <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                  </div> 
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnasabahid" >Tgl Tagihan</label>
                      <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                  </div> 
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnasabahid" >Tgl Trans</label>
                      <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                  </div> 
                  <div class="col-lg-2 col-sm-12"> 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="channeling" <?php // if($kredit->STATUS_AKTIF=="1"){echo 'checked';}?>>
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
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Bunga</label>
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                      </div> 
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnasabahid" >Denda</label>
                      <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                  </div> 
                  <div class="col-lg-2 col-sm-6">
                      <label for="inputnasabahid" >Tab. Wajib</label>
                      <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                  </div>
                  <div class="col-lg-3 col-sm-12"> 
                    <label for="nasabahid">Kode Trans. Tabungan</label>
                    <select class="form-control" name="kode_transaksi_hold_dana" id="kode_transaksi_hold_dana">
                      @php($i=0)
                      @while ($i<count($kodetranstab) )
                      <option value="{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->TOB}}-{{$kodetranstab[$i]->TYPE_TRANS}}">{{$kodetranstab[$i]->KODE_TRANS}}-{{$kodetranstab[$i]->DESKRIPSI_TRANS}}</option>
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
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Disc.</label>
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Disc.</label>
                        <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Adm.</label>
                        <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
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
                            <div class="col-lg-12 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                                <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
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
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Administrasi Lain</label>
                        <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                    </div>
                    <div class="col-lg-2 col-sm-6">
                      <label for="inputDate1">.</label>
                      <div class="row">
                        <div class="col-lg-12 input-group dateYMD" id="inputDate1" data-target-input="nearest">
                            <input type="text" name="tgl_realisasi" id="tgl_realisasi" class="form-control datetimepicker-input" required>
                        </div>
                      </div>
                    </div> 
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Sisa ByAdmin</label>
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Jumlah Setoran</label>
                        <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Sisa ByTrans</label>
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Jumlah Uang</label>
                        <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                          <label for="inputnasabahid" >Kwitansi</label>
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                      </div> 
                      <div class="col-lg-6 col-sm-6">
                          
                      </div> 
                    </div>
                  </div>
                    <div class="col-lg-2 col-sm-6">
                        
                    </div> 
                    <div class="col-lg-2 col-sm-6">
                        <label for="inputnasabahid" >Kembali</label>
                        <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-5">
                    <div class="row">
                      <div class="col-lg-12 col-sm-6">
                          <label for="inputnasabahid" >Keterangan</label>
                          <input type="text" id="nama_nasabah" name="nama_nasabah" class="form-control" >
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
              <button type="button" class="btn btn-default" data-dismiss="modal">Cetak Kwitansi</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
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

function setKredit(index){
  document.getElementsByName("id_nasabah")[0].value=kredits[index].nasabah_id;
  document.getElementsByName("nama_nasabah")[0].value=kredits[index].nama_nasabah; 
  document.getElementsByName("jml_pinjaman")[0].value=kredits[index].JML_PINJAMAN;
  var parts = kredits[index].TGL_REALISASI.split('-');
  var mydate = parts[2] + '/' + parts[1] + '/' + parts[0];
  document.getElementsByName("tgl_realisasi")[0].value=mydate;
  document.getElementsByName("jangka_waktu")[0].value=kredits[index].BI_JANGKA_WAKTU; 
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