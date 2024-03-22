<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Nominatif Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #tbl1,
        thead,
        th {
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
    <h5>Schedule Pembayaran Bunga Deposito</h5>
    <p>Untuk Bulan: {{date('F',strtotime($tgltrs1))}}</p>
    <table id="tbl1" class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>NO.REKENING</th>
                <th>TGL.MULAI</th>
                <th>JKW</th>
                <th>TGL.JT TMP</th>
                <th>%</th>
                <th>NOMINAL</th>
                <th>JUMLAH BUNGA</th>
                <th>PAJAK</th>
                <th>BUNGA DIBAYAR </th>
                <th>TGL BYR BNG</th>
                <th>No.Rek.Tabungan</th>
            </tr>
        </thead>
        <tbody>
            @php($totnominatif=0)
            @php($totbunga=0)
            @php($totpajak=0)
            @php($totbngdbyr=0)
            @php($totnominatifgroup=0)
            @php($totbungagroup=0)
            @php($totpajakgroup=0)
            @php($totbngdbyrgroup=0)

            @php($n=0)
            @php($jenisdep=[])
            @php($record = count($transaksi))
            @foreach($transaksi as $index => $values)
            @php(++$n)
            @if($index == 0)
            @php(array_push($jenisdep,$values->TGL_VALUTA))
            <tr>
                <td></td>
                <td>{{"TANGGAL :".$values->TGL_VALUTA}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @elseif($index > 0)
            @php(array_push($jenisdep,$values->TGL_VALUTA))
            @if($jenisdep[$index] <> $jenisdep[($index-1)])
                <tr style="border: solid 1px">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td></td>
                    <td>{{number_format($totnominatifgroup,2,'.',',')}}</td>
                    <td>{{number_format($totbungagroup,2,'.',',')}}</td>
                    <td>{{number_format($totpajakgroup,2,'.',',')}}</td>
                    <td>{{number_format($totbngdbyrgroup,2,'.',',')}}</td>
                    <td></td>
                    <td></td>
                    @php($n=0)
                    @php(++$n)
                    @php($totnominatifgroup=0)
                    @php($totbungagroup=0)
                    @php($totpajakgroup=0)
                    @php($totbngdbyrgroup=0)
                </tr>
                <tr>
                    <td></td>
                    <td>{{"TANGGAL :".$values->TGL_VALUTA}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endif
                @endif
                <tr>
                    <td>{{$n}}</td>
                    <td>{{$values->nama_nasabah}}</td>
                    <td>{{$values->NO_REKENING}}</td>
                    <td>{{$values->TGL_MULAI}}</td>
                    <td>{{$values->JKW}}</td>
                    <td>{{$values->TGL_JT}}</td>
                    <td>{{$values->SUKU_BUNGA}}</td>
                    <td>{{number_format($values->nominal,2,'.',',')}}</td>
                    <td>{{number_format($values->BUNGA_BLN_INI,2,'.',',')}}</td>
                    <td>{{number_format($values->PAJAK_BLN_INI,2,'.',',')}}</td>
                    <td>{{number_format(($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI),2,'.',',')}}</td>
                    <td>{{date('Y-m-d',
                        strtotime(date('Y',strtotime($tgltrs1))."-".date('m',strtotime($tgltrs1))."-".$values->TGL_VALUTA))}}
                    </td>
                    <td>{{$values->NO_REK_TABUNGAN}}</td>
                </tr>
                @php($totnominatifgroup=$totnominatifgroup+$values->nominal)
                @php($totnominatif=$totnominatif+$values->nominal)
                @php($totbunga=$totbunga+$values->BUNGA_BLN_INI)
                @php($totbungagroup=$totbungagroup+$values->BUNGA_BLN_INI)
                @php($totpajak=$totpajak+$values->PAJAK_BLN_INI)
                @php($totpajakgroup=$totpajakgroup+$values->PAJAK_BLN_INI)
                @php($totbngdbyr=$totbngdbyr+($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI))
                @php($totbngdbyrgroup=$totbngdbyrgroup+($values->BUNGA_BLN_INI-$values->PAJAK_BLN_INI))
                @endforeach
                <tr style="border: solid 1px">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td></td>
                    <td>{{number_format($totnominatifgroup,2,'.',',')}}</td>
                    <td>{{number_format($totbungagroup,2,'.',',')}}</td>
                    <td>{{number_format($totpajakgroup,2,'.',',')}}</td>
                    <td>{{number_format($totbngdbyrgroup,2,'.',',')}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border: solid 1px">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td></td>
                    <td>{{number_format($totnominatif,2,'.',',')}}</td>
                    <td>{{number_format($totbunga,2,'.',',')}}</td>
                    <td>{{number_format($totpajak,2,'.',',')}}</td>
                    <td>{{number_format($totbngdbyr,2,'.',',')}}</td>
                    <td></td>
                    <td></td>
                </tr>

        </tbody>
    </table>
    <div></div>
    <div class="row" style="margin-left:500px;margin-top:10px">{{$kota[0]->Value.','.date('d F Y')}}</div>
    <table>
        <tr>
            <td style="width: 500px;padding-left:25px">
                Mengetahui
            </td>
            <td style="width: 500px;padding-left:25px">
                Dibuat
            </td>
        </tr>
        <tr>
            <td style="width: 500px">
                &nbsp;
            </td>
            <td style="width: 500px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 500px">
                &nbsp;
            </td>
            <td style="width: 500px">
                &nbsp;
            </td>
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NAMA')
            <td style="width: 500px">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NAMA')
            <td style="width: 500px">
                {{$ttd1->Value}}
            </td>
            @endif
            @endforeach
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NIP')
            <td style="width: 500px">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NIP')
            <td style="width: 500px">
                {{$ttd1->Value}}
            </td>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>