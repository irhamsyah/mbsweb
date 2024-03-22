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
    <a href="{{route('showpenutupandeposito')}}">home</a>
    @foreach($lembaga as $values)
    <br>{{$values->Value}}<br>
    @endforeach
    <table style="float: right;border-spacing:0px">
        <tr>
            <td colspan="3" style="border-style: none">
                <h6>Kuitansi Pengambilan Deposito</h6>
            </td>
        </tr>
        <tr>
            <td style="border-style: none">No. Bilyet&nbsp;</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$request->no_alternatif}}</td>
        </tr>
        <tr>
            <td style="border-style: none">No. Rek&nbsp;</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$request->no_rekening}}</td>
        </tr>
    </table>
    {{-- <p>Kuitansi Pembayaran Bunga Deposito </p> --}}
    @php( $terbilang->parse($request->totalditerima))

    <table>
        <tr>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
        </tr>
        <tr>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
        </tr>
        <tr>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
            <td style="border-style: none">&nbsp;</td>
        </tr>

        <tr>
            <td style="border-style: none">Sudah diterima dari</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$lembaga[0]->Value}}</td>
        </tr>
        <tr>
            <td style="border-style: none">Uang Sebesar</td>
            <td style="border-style: none">:</td>
            <td>{{ '# '.ucwords($terbilang->getResult()).' Rupiah #' }}</td>
        </tr>
        <tr>
            <td style="border-style: none">Jumlah Deposito</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{number_format($request->totalditerima,2,".",",")}}</td>
        </tr>
        <tr>
            <td style="border-style: none">Pinalti</td>
            <td style="border-style: none">:</td>
            <td style="border-style: none">{{$request->pinalti}}</td>
        </tr>

    </table>

    <div class="row" style="margin-left:400px;margin-top:10px;font-size:9pt">
        {{$kota.','.date('d F Y')}}
    </div>
    <table style="margin-left:100px">
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
            <td style="width: 150px;padding-left:15px;padding-bottom:0px;border-style:none">
                _____________________
                <h6>Rp. {{number_format($request->totalditerima,2,".",",")}}</h6>
                _____________________
            </td>
            <td style="width: 150px;padding-left:10px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;padding-left:25px;border-style:none">
                {{$request->nama_nasabah}}
            </td>
        </tr>

    </table>

</body>

</html>