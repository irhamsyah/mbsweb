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
    
        <title>Dokumen Umum</title>
      </head>
      <body>
    <div class="container">
      <button onClick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
      </svg></button>
      <a href="/bo_cs_rp_umum/" class="btn btn-md btn-normal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check" viewBox="0 0 16 16">
          <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z"/>
          <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514Z"/>
        </svg>
      </a>
          
            <?php 
              $typedokumen=$_POST['typedokumen'];
              $tanggal=$_POST['tanggal'];
              $glbalance1=$_POST['glbalance1'];
              $glbalance1x=explode("|",$glbalance1);
              $kodeperk1=$glbalance1x[0];
              $namaperk1=$glbalance1x[1]; 

              $uraian=$_POST['uraian'];
              $jumlah=$_POST['jumlah'];
              $kota='Pasuruan';

              if($typedokumen!='umum'){
                $kodejurnal=$_POST['kodejurnal'];
                $atasnama=$_POST['atasnama'];
                if($typedokumen=="masuk"){
                    $judul="NOTA PENYETORAN";
                }else if($typedokumen=="keluar"){
                    $judul="KWITANSI";
                }
                ?>
                <table id="tbl1" style="border:none;">
                  <thead>
                  </thead>
                  <tbody>
                      <tr>
                          <td colspan="4">BANK PERKREDITAN RAKYAT</td>
                          <td colspan="2"></td>
                          <td><u>Validasi :</u></td>
                          <td colspan="2"></td>
                      </tr>
                      <tr>
                          <td colspan="4">PT. BPR Artha Senapati</td>
                          <td colspan="9"></td>
                      </tr>
                      <tr style="height:20px;">
                          <td colspan="9"></td>
                      </tr>
                      <tr>
                          <td colspan="9" style="text-align:center;font-weight:bold;">{{ $judul }}</td>
                      </tr>
                      <tr>
                          <td colspan="9">{{ 'Telah terima dari : '.$atasnama }}</td>
                      </tr>
                      <tr style="border:1px solid black;height:50px;">
                          <td colspan="3">No. Perk</td>
                          <td colspan="3">Nama Perkiraan</td>
                          <td colspan="3">Nominal (Rp)</td>
                      </tr>
                      <tr style="height:70px;">
                          <td colspan="3">{{ $kodeperk1 }}</td>
                          <td colspan="3">{{ $namaperk1 }}</td>
                          <td colspan="3">{{ number_format($jumlah,2,',','.') }}</td>
                      </tr>
                      <tr style="border:1px solid black;">
                          <td colspan="3"></td>
                          <td colspan="2" style="text-align:right;">Jumlah</td>
                          <td></td>
                          <td colspan="3">{{ number_format($jumlah,2,',','.') }}</td>
                      </tr>
                      <tr>
                          <td colspan="2">Terbilang</td>
                          <td colspan="4" style="word-wrap:break-word">{{ '##   '.ucwords(Terbilang::angka($jumlah)).' Rupiah   ##' }}</td>
                          <td></td>
                          <td colspan="2">{{ $kota.', '.date('d F Y', strtotime($tanggal)) }}</td>
                      </tr>
                      <tr>
                          <td colspan="2">Keterangan</td>
                          <td colspan="4">{{ ucwords($uraian) }}</td>
                          <td colspan="3"></td>
                      </tr>
                      <tr style="height:20px;">
                          <td colspan="9"></td>
                      </tr>
                      <tr>
                          <td colspan="7"></td>
                          <td colspan="2">Tanda Tangan</td>
                      </tr>
                  </tbody>
              </table>
              <?php }else{ 
                $keteranganumum=$_POST['keteranganumum'];
                $glbalance2=$_POST['glbalance2'];
                $glbalance2x=explode("|",$glbalance2);
                $kodeperk2=$glbalance2x[0];
                $namaperk2=$glbalance2x[1];
                ?>
                <table id="tbl1" style="border:none;">
                  <thead>
                  </thead>
                  <tbody>
                      <tr style="height:50px;">
                          <td colspan="4">BANK PERKREDITAN RAKYAT</td>
                          <td colspan="2"></td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;">Adm</td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;">Akunting</td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;">SPI</td>
                      </tr>
                      <tr>
                          <td colspan="4">PT. BPR Artha Senapati</td>
                          <td colspan="2"></td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;"></td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;"></td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;"></td>
                      </tr>
                      <tr style="height:50px;">
                          <td colspan="9"></td>
                      </tr>
                      <tr>
                          <th colspan="3" style="text-align:left;">DEBET</th>
                          <th colspan="3" style="text-align:center;">{{ $keteranganumum }}</th>
                          <th colspan="3" style="text-align:right;">KREDIT</th>
                      </tr>
                      <tr style="border-top: 1px solid black;">
                          <td colspan="3" style="border-right: 1px solid black; border-left: 1px solid black; text-align:left;">{{ $kodeperk1 }}</td>
                          <td colspan="3" style="border-right: 1px solid black; text-align:right;"></td>
                          <td colspan="3" style="border-right: 1px solid black; text-align:left;">{{ $kodeperk2 }}</td>
                      </tr>
                      <tr style="border-top: 1px solid black;">
                          <td colspan="3" style="border-right: 1px solid black; border-left: 1px solid black; text-align:left;">{{ $namaperk1 }}</td>
                          <td colspan="3" style="border-right: 1px solid black; text-align:right;"></td>
                          <td colspan="3" style="border-right: 1px solid black; text-align:left;">{{ $namaperk2 }}</td>
                      </tr>
                      <tr style="height:20px;">
                          <td colspan="3" style="border-right: 1px solid black; border-left: 1px solid black; text-align:left;"></td>
                          <td colspan="3" style="border-right: 1px solid black; text-align:right;"></td>
                          <td colspan="3" style="border-right: 1px solid black; text-align:left;"></td>
                      </tr>
                      <tr style="border-bottom: 1px solid black;">
                          <td colspan="3" style="border-right: 1px solid black; border-left: 1px solid black; text-align:left;"></td>
                          <th colspan="3" style="border-right: 1px solid black; text-align:right;">{{ number_format($jumlah,2,',','.') }}</th>
                          <td colspan="3" style="border-right: 1px solid black; text-align:left;"></td>
                      </tr>
                      <tr>
                          <td colspan="2">Terbilang</td>
                          <td colspan="4" style="word-wrap:break-word">{{ '##   '.ucwords(Terbilang::angka($jumlah)).' Rupiah   ##' }}</td>
                          <td></td>
                          <td colspan="2">{{ $kota.', '.date('d F Y', strtotime($tanggal)) }}</td>
                      </tr>
                      <tr>
                          <td colspan="2">Keterangan</td>
                          <td colspan="4">{{ ucwords($uraian) }}</td>
                          <td colspan="3"></td>
                      </tr>
                      <tr style="height:20px;">
                          <td colspan="9"></td>
                      </tr>
                      <tr>
                          <td colspan="7"></td>
                          <td colspan="2">Tanda Tangan</td>
                      </tr>
                  </tbody>
              </table>
              <?php 
              }
            ?>
    </div>
  </body>
</html>