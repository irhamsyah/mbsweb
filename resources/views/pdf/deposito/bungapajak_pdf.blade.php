<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Bunga dan Pajak</title>
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    --}}
    <style>
        #tbl1,
        thead,
        th,
        td {
            table-layout: auto;
            font-size: 9pt;
            font-family: 'Times New Roman', Times, serif;
            padding: 2px;
            margin-left: 0px;
            border: 1px solid;
            text-align: left;
            border-collapse: collapse;
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
    <h4 style="text-align: center">Laporan Titipan dan Anggaran Bunga Deposito</h4>
    <p style="text-align: center">{{date('d F Y',strtotime($tgltrs2))}}</p>

    <table id="tbl1" class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">No.Rek</th>
                <th rowspan="2">Nama Nasabah</th>
                <th rowspan="2">Jumlah Deposito</th>
                <th rowspan="2">Tgl Registrasi</th>
                <th rowspan="2">Saldo Titipan</th>
                <th colspan="2">Anggaran Bulan Ini</th>
            </tr>
            <tr>
                <th>Bunga</th>
                <th>Pajak</th>
            </tr>
        </thead>
        <tbody>
            @php($totjmldep=0)
            @php($tottitipan=0)
            @php($totbunga=0)
            @php($totpajak=0)
            @foreach($transaksi as $index => $values)
            <tr>
                <td>{{$values->no_rekening}}</td>
                <td>{{$values->nama_nasabah}}</td>
                <td>{{$values->jml_deposito}}</td>
                <td>{{$values->tgl_registrasi}}</td>
                <td>{{number_format($values->saldo_titipan,2,".",",")}}</td>
                <td>{{number_format($values->bunga,2,".",",")}}</td>
                <td>{{number_format($values->pajak,2,".",",")}}</td>
            </tr>
            @php($totjmldep=$totjmldep+$values->jml_deposito)
            @php($tottitipan=$tottitipan+$values->saldo_titipan)
            @php($totbunga=$totbunga+$values->bunga)
            @php($totpajak=$totpajak+$values->pajak)
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>{{number_format($totjmldep,2,".",",")}}</td>
                <td></td>
                <td>{{number_format($tottitipan,2,".",",")}}</td>
                <td>{{number_format($totbunga,2,".",",")}}</td>
                <td>{{number_format($totpajak,2,".",",")}}</td>
            </tr>
        </tbody>
    </table>
    <div class="row" style="margin-left:750px;margin-top:10px;font-size:9pt">{{$kota[0]->Value.','.date('d F Y')}}</div>
    <table style="margin-left:50px">
        <tr>
            <td style="width: 150px;padding-left:15px;border-style:none">
                Mengetahui
            </td>
            <td style="width: 150px;padding-left:10px;border-style:none">
                Menyetujui
            </td>
            <td style="width: 150px;padding-left:25px;border-style:none">
                Dibuat
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
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NAMA')
            <td style="width: 150px;border-style:none">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_DEP_C_NAMA')
            <td style="width: 150px;border-style:none">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NAMA')
            <td style="width: 150px;border-style:none">
                {{$ttd1->Value}}
            </td>
            @endif
            @endforeach
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NIP')
            <td style="width: 150px;border-style:none">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_DEP_C_NIP')
            <td style="width: 150px;border-style:none">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NIP')
            <td style="width: 150px;border-style:none">
                {{$ttd1->Value}}
            </td>
            @endif
            @endforeach
        </tr>
    </table>

</body>

</html>