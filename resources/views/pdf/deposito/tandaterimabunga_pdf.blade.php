<!DOCTYPE html>
<html lang="en">
{{-- Fungsi Terbilang --}}
<?php
    use Nggit\PHPTerbilang\Terbilang;
    $terbilang = new Terbilang();
    
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Cetak Transaksi</title>
    <style>
        #tbl1,
        thead,
        th,
        td {
            table-layout: auto;
            font-size: 9pt;
            font-family: 'Times New Roman', Times, serif;
            /* padding: 2px; */
            margin-left: 0px;
            border: 1px solid;
            text-align: left;
            /* border-collapse: collapse; */
        }

        br {
            content: "";
            margin: 0.5em;
            display: block;
            font-size: 24%;
        }

        p {
            padding: 0px;
            margin-top: 0px;
            text-align: left
        }
    </style>
</head>

<body>
    @foreach($lembaga as $values)
    <br>{{$values->Value}}<br>
    @endforeach
    <table style="float: right;border-spacing:0px">
        <tr>
            <td>Adm.dep</td>
            <td>Akunting</td>
            <td>SPI&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>
    <p>Kuitansi Pembayaran Bunga Deposito </p>
    <table>
        <tr>
            <td style="border-style: none">No. Kuitansi </td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$request->kuitansi}}</td>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
            <td style="border-style: none">Tanggal</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">
                {{date('d',strtotime($request->tgl_trans))}}
            </td>
        </tr>
        <tr>
            <td style="border-style: none">Sudah di terima dari</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$lembaga[1]->Value}}</td>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
            <td style="border-style: none">Bulan</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{date('F',strtotime($request->tgl_trans))}}
            </td>
        </tr>
        <tr>
            <td style="border-style: none">No.Deposito</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$request->no_rekening}}</td>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
            <td style="border-style: none">Bunga</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{number_format($request->bunga_bln_ini,2,".",",")}}</td>
        </tr>
        <tr>
            <td style="border-style: none">Atas Nama</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$request->nama_nasabah}}</td>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
            <td style="border-style: none">Titipan</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{number_format($request->titipan_ambil,2,".",",")}}</td>
        </tr>
        <tr>
            <td style="border-style: none">Nominal</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{number_format($request->jml_deposito,2,".",",")}}</td>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
            <td style="border-style: none">Pajak</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{number_format($request->pajak_bln_ini,2,".",",")}}</td>
        </tr>
        @php($total = $request->bunga_bln_ini+$request->titipan_ambil-$request->pajak_bln_ini)

        <tr>
            <td style="border-style: none">Transaksi</td>
            <td style="border-style: none">:</td>
            @if($request->tob=='T')
            <td style="border-style: none">{{'Tunai'}}</td>
            @else
            <td style="border-style: none">{{'Overbbok ke : '.$request->no_rekening_tab}}</td>
            @endif
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>

            <td style="border-style: none">Jumlah</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{number_format($total,2,".",",")}}</td>
        </tr>
        <tr>
            <td style="border-style: none"></td>
        </tr>
        <tr>
            <td style="border-style: none"></td>
        </tr>
        @php( $terbilang->parse($total))

    </table>
    <table>
        <tr>
            <td style="border-style: none">Terbilang</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">:</td>
            <td>{{ '## '.ucwords($terbilang->getResult()).' Rupiah ##' }}</td>
        </tr>

    </table>

    <div class="row" style="margin-left:400px;margin-top:10px;font-size:9pt">
        {{$kota.','.date('d F Y')}}
    </div>
    <table style="margin-left:100px">
        <tr>
            <td style="width: 150px;padding-left:15px;border-style:none">
                Penerima
            </td>
            <td style="width: 150px;padding-left:10px;border-style:none">
                Teller
            </td>
            <td style="width: 150px;padding-left:25px;border-style:none">
                Mengetahui
            </td>
        </tr>
        <tr>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 150px;border-style:none">
                ___________________
            </td>
            <td style="width: 150px;border-style:none">
                ___________________
            </td>
            <td style="width: 150px;border-style:none">
                ___________________
            </td>
        </tr>

    </table>

</body>

</html>