<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      #tbl1{
        font-size:100%;
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
    
        <title>Spicemen Nasabah</title>
      </head>
      <body>
    <div class="container">
      <button onClick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
      </svg></button>
      @foreach($tabungan as $index => $key)
        @php 
            $norekening = $key->no_rekening;
            $idnasabah = $key->nasabah_id;
            $namanasabah = $key->nama_nasabah;
            $alamat = $key->alamat;
            $cif = $key->cif;
            $noktp = $key->no_id;
            $telp = $key->telpon;
            $tgllahir = $key->tgllahir;
            $ibukandung = $key->ibu_kandung;
        @endphp
      @endforeach
            <h4 class="text-center">Spicemen Nasabah</h4>
            <h4 class="text-center">PT. Bank Perkreditan Rakyat</h4>
            <h3 class="text-center">ARTHA SENAPATI</h3>
            <table id="tbl1" class="table table-bordered" style="margin-top:50px;">
            <tr>
                <td>NAMA NASABAH</td>
                <td> : </td>
                <th>{{ $namanasabah }}</th>
                <td>NO REKENING</td>
                <td> : </td>
                <th>{{ $norekening }}</th>
            </tr>
            <tr>
                <td>ALAMAT</td>
                <td> : </td>
                <th colspan="4">{{ $alamat }}</th>
            </tr>
            <tr>
                <td>CIF</td>
                <td> : </td>
                <th>{{ $cif }}</th>
                <td>NO KTP</td>
                <td> : </td>
                <th>{{ $noktp }}</th>
            </tr>
            <tr>
                <td>TELP</td>
                <td> : </td>
                <th>{{ $telp }}</th>
                <td>TGL LAHIR</td>
                <td> : </td>
                <th>{{ $tgllahir }}</th>
            </tr>
            <tr>
                <td>NAMA IBU KANDUNG</td>
                <td> : </td>
                <th colspan="4">{{ $namanasabah }}</th>
            </tr>
        </table>
        <div class="row align-items-start" style="border:0px;padding-bottom:30px; margin-top:30px;">
          <div class="col">
            Kepala Cabang
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