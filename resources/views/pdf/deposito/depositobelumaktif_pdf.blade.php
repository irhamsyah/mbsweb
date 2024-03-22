<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Deposito Blokir</title>
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
            text-align: center
        }
    </style>
</head>

<body>
    <a href="{{route('belumaktif')}}">Home</a>
    @foreach($lembaga as $values)
    <br>{{$values->Value}}<br>
    <p></p>
    @endforeach
    <table id="tbl1" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>No.rekening</th>
                <th>Nama_Nasabah</th>
                <th>Alamat</th>
                <th>Tgl_registrasi</th>
                <th>JKW</th>
                <th>Tgl_Jt_tempo</th>
                <th>Suku_bunga</th>
                <th>Jml_deposito</th>
            </tr>
        </thead>
        <tbody>
            @php($totnominatif=0)

            @foreach($belumaktif as $index => $values)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$values->NO_REKENING}}</td>
                <td>{{$values->nama_nasabah}}</td>
                <td>{{$values->alamat}}</td>
                <td>{{$values->TGL_REGISTRASI}}</td>
                <td>{{$values->JKW}}</td>
                <td>{{$values->TGL_JT}}</td>
                <td>{{$values->SUKU_BUNGA}}</td>
                <td>{{number_format($values->JML_DEPOSITO,2,'.',',')}}</td>
            </tr>
            @php($totnominatif=$totnominatif+$values->JML_DEPOSITO)
            @endforeach
            <tr id="y" style="border: 1px solid">
                <td></td>
                <td>Deposan : </td>
                <td>{{$index.' Orang'}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{number_format($totnominatif,2,'.',",")}}</td>
            </tr>
        </tbody>
    </table>
    <div class="row" style="margin-left:600px;margin-top:10px">{{$kota[0]->Value.','.date('d F Y')}}</div>
    <table style="margin-left:100px ">
        <tr>
            <td style="width: 500px;padding-left:25px;border-style: none">
                Mengetahui
            </td>
            <td style="width: 500px;padding-left:25px;border-style: none">
                Dibuat
            </td>
        </tr>
        <tr>
            <td style="width: 500px;border-style: none">
                &nbsp;
            </td>
            <td style="width: 500px;border-style: none">
                &nbsp;
            </td>
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NAMA')
            <td style="width: 500px;border-style: none">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NAMA')
            <td style="width: 500px;border-style: none">
                {{$ttd1->Value}}
            </td>
            @endif
            @endforeach
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NIP')
            <td style="width: 500px;border-style: none">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NIP')
            <td style="width: 500px;border-style: none">
                {{$ttd1->Value}}
            </td>
            @endif
            @endforeach
        </tr>
    </table>

</body>

</html>