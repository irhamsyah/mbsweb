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

    <title>Cetak Transaksi Penutupan Deposito</title>
    <style>
        #tbl1,
        thead,
        th,
        td {
            table-layout: auto;
            font-size: 9pt;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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
    <h5>Bukti Penutupan Tabungan</h5>
    <table style="float: left;border-spacing:0px;margin-bottom:195px">
        <tr>
            <td style="border-style: none">No. Rekening&nbsp;</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$request->no_rekening}}</td>
        </tr>
        <tr>
            <td style="border-style: none">Nama Nasabah&nbsp;</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$request->nama_nasabah}}</td>
        </tr>
    </table>
    {{-- <p>Kuitansi Pembayaran Bunga Deposito </p> --}}
    @php( $terbilang->parse($request->jml_transaksi))
    <table style="margin-top: 20px">
        <tr>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
        </tr>
        <tr>
            <td style="border-style: none">Saldo Tabungan&nbsp;</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none;text-align:right">{{number_format($request->saldo,2,".",",")}}</td>
        </tr>
        <tr>
            <td style="border-style: none">Potongan By Admin&nbsp;</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none;text-align:right">{{number_format($request->byadmin,2,".",",")}}</td>
        </tr>
        <tr>
            <td style="border-style: none">Jumlah Pengambilan</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none;text-align:right">{{number_format($request->jml_transaksi,2,".",",")}}</td>
        </tr>
        <tr>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
        </tr>
        <tr>
            <td style="border-style: none">{{ '# '.ucwords($terbilang->getResult()).' Rupiah #' }}</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
        </tr>
        <tr>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
        </tr>
        <tr>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
            <td style="border-style: none"></td>
        </tr>

    </table>

    <div class="row" style="margin-left:490px;margin-top:10px;font-size:9pt">
        {{$kota.','.date('d F Y')}}
    </div>
    <table style="margin-left:20px">
        <tr>
            <td style="width: 150px;border-style:none">
                Nasabah yang bersangkutan
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none;text-align:right">
                Teller
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
            <td style="width: 150px;padding-left:15px;padding-bottom:0px;border-style:none">
                {{$request->nama_nasabah}}
            </td>
            <td style="width: 150px;padding-left:10px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;padding-left:25px;border-style:none">
                &nbsp;
            </td>
        </tr>

    </table>

</body>

</html>