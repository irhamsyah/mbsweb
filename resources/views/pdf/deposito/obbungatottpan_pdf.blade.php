<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Transaksi Bunga ke Titipan</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <style>
        #tbl1,thead,th,td {
            table-layout: auto;
            font-size: 9pt;
            font-family: 'Times New Roman', Times, serif;
            padding: 2px;
            margin-left: 0px;
            border: 1px solid;
            text-align: left;
            border-collapse: collapse;
        }
        br{
              content: "";
              margin: 0.5em;
              display: block;
              font-size: 24%;
        }
        p{
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
    <p>Transaksi Overbooking Bunga Deposito Ke Titpan</p>
    <p>Periode : {{date('d F Y',strtotime($tgltrs1))}} s/d {{date('d F Y',strtotime($tgltrs2))}}</p>

    <table id="tbl1" class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">No Rekening</th>
                <th rowspan="2">Nama Nasabah</th>
                <th rowspan="2">Tgl Trans</th>
                <th rowspan="2">Kuitansi</th>
                <th colspan="3">Overbook Bunga Deposito</th>
            </tr>
            <tr>
                <th>Bunga</th>
                <th>Pajak</th>
                <th>Titipan Netto</th>
            </tr>
        </thead>
        <tbody>
            @php($totsaldo=0)
        @foreach($transaksi as $index => $values)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$values->no_rekening}}</td>
                <td>{{$values->nama_nasabah}}</td>
                <td>{{$values->TGL_TRANS}}</td>
                <td>{{$values->kuitansi}}</td>
                <td>{{number_format($values->ob_bunga,2,".",",")}}</td>
                <td>{{number_format($values->ob_pajak,2,".",",")}}</td>
                @php($totsaldo=$totsaldo+$values->ob_bunga-$values->ob_pajak)
                <td>{{number_format($totsaldo,2,".",",")}}</td>
            </tr>
        @endforeach
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