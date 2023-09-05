<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      #tbl1{
        font-size:52%;
      }
      br{
        content: "";
        margin: 0.5em;
        display: block;
        font-size: 24%;
      }
      </style>
  

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <title>Daftar Nominatif Tabungan</title>
      </head>
      <body>
    <div class="container">
      <button onClick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
      </svg></button>
      <a href="{{route('bo_tb_rpt_tabunganblokir')}}" class="btn btn-md btn-normal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check" viewBox="0 0 16 16">
          <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z"/>
          <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514Z"/>
        </svg>
      </a>

            <h4 class="text-center">Daftar Nominatif Tabungan Blokir</h4>
            @foreach($lembaga as $lembaga)
            <br>{{$lembaga->Value}}<br>
            @endforeach

          <table id="tbl1" class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th rowspan="2">No </th>
                <th rowspan="2">No Rek</th>
                <th rowspan="2">Nama Nasabah</th>
                <th rowspan="2">Alamat</th>
                <th rowspan="2">Saldo bln lalu</th>
                <th colspan="2">Mutasi</th>
                <th rowspan="2">Saldo Sbl Bunga</th>
                <th rowspan="2">Admin</th>
                <th rowspan="2">Bunga</th>
                <th rowspan="2">PPh</th>
                <th rowspan="2">Saldo Nominatif</th>
                <th rowspan="2">Saldo Akhir</th>
                <th rowspan="2">Saldo Blokir</th>

            </tr>
            <tr>
              <th>Debet</th>
              <th>Kredit</th>
            </tr>
            </thead>
            <tbody>
              @php($no=0)
              @php($totsaldo_bln_lalu=0)
              @php($totmutasi_debet=0)
              @php($totmutasi_kredit=0)
              @php($totsaldo_sbl_bunga=0)
              @php($totadmin_bln_ini=0)
              @php($totbunga_bln_ini=0)
              @php($totpajak_bln_ini=0)
              @php($totsaldo_nominatif=0)
              @php($totsaldo_akhir=0)
              @php($totsaldo_blokir=0)

            @foreach($nominatif as $keys)
                  @php($no++)
              {{-- @foreach($key as $value=>$keys) --}}
                <tr>
                    <td>{{ $no}}</td>
                    <td>{{ $keys->NO_REKENING }}</td>
                    <td>{{ $keys->nama_nasabah }}</td>
                    <td>{{ $keys->alamat }}</td>
                    <td>{{ number_format($keys->saldo_bln_lalu,2)}}</td>
                    <td>{{ number_format($keys->mutasi_debet,2)}}</td>
                    <td>{{ number_format($keys->mutasi_kredit,2)}}</td>
                    <td>{{ number_format($keys->saldo_sbl_bunga,2)}}</td>
                    <td>{{ number_format($keys->admin_bln_ini,2)}}</td>
                    <td>{{ number_format($keys->bunga_bln_ini,2)}}</td>
                    <td>{{ number_format($keys->pajak_bln_ini,2)}}</td>
                    <td>{{ number_format($keys->saldo_nominatif,2)}}</td>
                    <td>{{ number_format($keys->saldo_akhir,2)}}</td>
                    <td>{{ number_format($keys->SALDO_BLOKIR,2)}}</td>

                    @php($totsaldo_bln_lalu=$totsaldo_bln_lalu+$keys->saldo_bln_lalu)
                    @php($totmutasi_debet=$totmutasi_debet+$keys->mutasi_debet)
                    @php($totmutasi_kredit=$totmutasi_kredit+$keys->mutasi_kredit)
                    @php($totsaldo_sbl_bunga=$totsaldo_sbl_bunga+$keys->saldo_sbl_bunga)
                    @php($totadmin_bln_ini=$totadmin_bln_ini+$keys->admin_bln_ini)
                    @php($totbunga_bln_ini=$totbunga_bln_ini+$keys->bunga_bln_ini)
                    @php($totpajak_bln_ini=$totpajak_bln_ini+$keys->pajak_bln_ini)
                    @php($totsaldo_nominatif=$totsaldo_nominatif+$keys->saldo_nominatif)
                    @php($totsaldo_akhir=$totsaldo_akhir+$keys->saldo_akhir)
                    @php($totsaldo_blokir=$totsaldo_blokir+$keys->SALDO_BLOKIR)
                </tr>
              {{-- @endforeach --}}
            @endforeach
            <tr>
              <td colspan="4"><h5>Total Keseluruhan</h5></td>
              <td>{{ number_format($totsaldo_bln_lalu,2)}}</td>
              <td>{{ number_format($totmutasi_debet,2)}}</td>
              <td>{{ number_format($totmutasi_kredit,2)}}</td>
              <td>{{ number_format($totsaldo_sbl_bunga,2)}}</td>
              <td>{{ number_format($totadmin_bln_ini,2)}}</td>
              <td>{{ number_format($totbunga_bln_ini,2)}}</td>
              <td>{{ number_format($totpajak_bln_ini,2)}}</td>
              <td>{{ number_format($totsaldo_nominatif,2)}}</td>
              <td>{{ number_format($totsaldo_akhir,2)}}</td>
              <td>{{ number_format($totsaldo_blokir,2)}}</td>
            </tr>
            </tbody>
        </table>
        <div class="row align-items-start" style="border:0px;padding-bottom:30px">
          <div class="col">
            Direktur Utama
          </div>
          <div class="col">
            Bagian Tabungan
          </div>
        </div>
        @foreach($ttd as $ttd1)
        @if($ttd1->KeyName=='TTD_TAB_L_NAMA')
        <div class="row align-items-end" style="border:0px;padding-top:30px">
          <div class="col" >
            {{$ttd1->Value}}
          </div>
        @elseif($ttd1->KeyName=='TTD_TAB_R_NAMA')

          <div class="col">
            {{$ttd1->Value}}
          </div>
        </div>
        @endif
        @endforeach
    </div>
  </body>
</html>