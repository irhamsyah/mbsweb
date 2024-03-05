<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Jatuh Tempo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #tbl1,
        thead,
        th,
        td {
            font-size: 10pt;
            font-family: 'Times New Roman', Times, serif;
            padding: 2px;
            margin: 0px;
            border: 1px solid;
            text-align: right;
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
            text-align: center
        }
    </style>
</head>

<body>
    {{-- <a href="{{route('searchnomdepgroup')}}">Home</a> --}}
    @foreach($lembaga as $values)
    <br>{{$values->Value}}<br>
    @endforeach
    <h5>Daftar Deposito Jatuh Tempo s/d {{date('d F Y',strtotime($tgltrs1))}}</h5>
    <table id="tbl1" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>No Rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>Tanggal Mulai</th>
                <th>Jumlah Deposito<br>{{date('d F Y',strtotime($tgltrs1))}}</th>
                <th>Bunga(%)</th>
                <th>Tanggal Jatuh Tempo</th>
                <th>JKW</th>
                <th>Pph</th>
            </tr>
        </thead>
        <tbody>
            @php($totnominatif=0)
            @php($n=1)
            @foreach($transaksi as $values)
            <tr>
                <td>{{$n}}</td>
                <td>{{$values->NO_REKENING}}</td>
                <td>{{$values->nama_nasabah}}</td>
                <td>{{$values->alamat}}</td>
                <td>{{$values->TGL_MULAI}}</td>
                <td>{{number_format($values->nominal,2,'.',',')}}</td>
                <td>{{$values->SUKU_BUNGA}}</td>
                <td>{{$values->TGL_JT}}</td>
                <td>{{$values->JKW}}</td>
                <td>{{$values->PERSEN_PPH}}</td>
            </tr>
            @php($totnominatif=$totnominatif+$values->nominal)
            @php($n++)
            @endforeach
            <tr style="border: solid 1px">
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{number_format($totnominatif,2,'.',',')}}</td>
            </tr>
        </tbody>
    </table>
    <div></div>

</body>

</html>