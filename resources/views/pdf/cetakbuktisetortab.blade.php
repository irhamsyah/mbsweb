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
    
        <title>Daftar Nasabah</title>
      </head>
      <body>
    <div class="container">
      <button onClick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
      </svg></button>
      <a href="/bo_cs_rp_tabungan/" class="btn btn-md btn-normal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check" viewBox="0 0 16 16">
          <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z"/>
          <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514Z"/>
        </svg>
      </a>
          
            <?php 
              $debetkredit=$_POST['debetkredit'];
              $tanggal=$_POST['tanggal'];
              $norekening=$_POST['norek'];
              $namanasabah=$_POST['namanasabah'];
              $kwitansi=$_POST['kwitansi'];
              $jumlah=$_POST['jumlah'];
              $tunaiovb=$_POST['tunaiovb'];
              $keterangan=$_POST['keterangan'];
              $kodetranstab=$_POST['kodetranstab'];
              $kota=$_POST['kota'];

              if($debetkredit=='debet'){?>
                <table id="tbl1" style="border:none;">
                  <thead>
                  </thead>
                  <tbody>
                      <tr style="height:50px;">
                          <td colspan="6"></td>
                      </tr>
                      <tr>
                          <td></td>
                          <td>{{ date('d F Y', strtotime($tanggal)) }}</td>
                          <td colspan="4"></td>
                      </tr>
                      <tr>
                          <td></td>
                          <td>{{ $norekening }}</td>
                          <td colspan="4"></td>
                      </tr>
                      <tr>
                          <td></td>
                          <td>{{ $namanasabah }}</td>
                          <td colspan="4"></td>
                      </tr>
                      <tr style="height:50px;">
                          <td colspan="6"></td>
                      </tr>
                      <tr>
                          <td colspan="2"></td>
                          <td>{{ $kwitansi }}</td>
                          <td style="min-width:450px;"></td>
                          <td>Rp.</td>
                          <td>{{ number_format($jumlah,2,',','.') }}</td>
                      </tr>
                      <tr>
                          <td>{{ $namanasabah }}</td>
                          <td colspan="3"></td>
                          <td>Rp.</td>
                          <td>{{ number_format($jumlah,2,',','.') }}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <td>{{ number_format($jumlah,2,',','.') }}</td>
                          <td colspan="4">{{ '##   '.ucwords(Terbilang::angka($jumlah)).' Rupiah   ##' }}</td>
                      </tr>
                  </tbody>
              </table>
              <?php }else if($debetkredit=='kredit'){ ?>
                <table id="tbl1" style="border:none;">
                  <thead>
                  </thead>
                  <tbody>
                      <tr style="height:50px;">
                          <td colspan="4">TANDA TERIMA TRANSAKSI TABUNGAN</td>
                          <td colspan="3"></td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;">Akunting</td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;">SPI</td>
                      </tr>
                      <tr>
                          <td colspan="4">PT. BPR Artha Senapati</td>
                          <td colspan="3"></td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;"></td>
                          <td style="border: 1px solid black; min-width:80px;text-align:center;"></td>
                      </tr>
                      <tr style="height:20px;">
                          <td colspan="9"></td>
                      </tr>
                      <tr>
                          <td colspan="7"></td>
                          <td colspan="2">{{ $kodetranstab }}</td>
                      </tr>
                      <tr>
                          <td colspan="2" style="text-align:right;">No Kuitansi</td>
                          <td>:</td>
                          <th colspan="2">{{ $kwitansi }}</th>
                          <td colspan="4"></td>
                      </tr>
                      <tr>
                          <td colspan="2" style="text-align:right;">Sudah di terima dari</td>
                          <td>:</td>
                          <th colspan="2">{{ strtoupper($namanasabah) }}</th>
                          <td colspan="4"></td>
                      </tr>
                      <tr>
                          <td colspan="2" style="text-align:right;">No. Rekening</td>
                          <td>:</td>
                          <th colspan="2">{{ strtoupper($norekening) }}</th>
                          <td colspan="4"></td>
                      </tr>
                      <tr>
                          <td colspan="2" style="text-align:right;">Keterangan</td>
                          <td>:</td>
                          <th colspan="2">{{ $keterangan }}</th>
                          <td colspan="4"></td>
                      </tr>
                      <tr>
                          <td colspan="2" style="text-align:right;">Nominal</td>
                          <td>:</td>
                          <th colspan="2">{{ number_format($jumlah,2,',','.') }}</th>
                          <td colspan="4"></td>
                      </tr>
                      <tr>
                          <td colspan="2" style="text-align:right;">Terbilang</td>
                          <td>:</td>
                          <th colspan="6">{{ '##   '.ucwords(Terbilang::angka($jumlah)).' Rupiah   ##' }}</th>
                      </tr>
                      <tr style="height:40px;">
                          <td colspan="9"></td>
                      </tr>
                      <tr>
                          <td colspan="6"></td>
                          <th colspan="3">{{ $kota.', '.date('d F Y', strtotime($tanggal)) }}</th>
                      </tr>
                      <tr style="height:20px;">
                          <td colspan="9"></td>
                      </tr>
                      <tr>
                          <td style="border: 1px solid black; text-align:left;">Dibuat</td>
                          <td style="border: 1px solid black; min-width:40px;text-align:center;"></td>
                          <td></td>
                          <td style="border: 1px solid black; text-align:left;">Diperiksa</td>
                          <td style="border: 1px solid black; min-width:40px;text-align:center;"></td>
                          <td></td>
                          <td></td>
                          <td style="border: 1px solid black; text-align:left;">Disetujui</td>
                          <td style="border: 1px solid black; min-width:40px;text-align:center;"></td>
                      </tr>
                  </tbody>
              </table>
              <?php 
              }
            ?>
    </div>
  </body>
</html>