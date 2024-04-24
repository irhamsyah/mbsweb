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
            font-size: 9pt;
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
    <h4 style="text-align: center">Laporan Kas Umum</h4>

    @php($n=0)
    @php($tob1=[])
    @php($modul1=[])
    @php($totdebet=0)
    @php($totkredit=0)
    <div style="text-align:right">Saldo Awal : {{number_format($saldoawalkas,2,".",",")}}</div>
    <table id="tbl1" class="table" width="100%">
        <thead>
            <tr>
                <th colspan="3">Tanggal</th>
                <th>Jurnal</th>
                <th>No.Bukti</th>
                <th>Uraian</th>
                <th>Terima</th>
                <th>Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trskas as $values)
            @php(array_push($tob1,$values->tob))
            @php(array_push($modul1,$values->modul))
            @if($n==0 && $values->tob=='T')
            <tr>
                <td colspan="3" style="font-weight: bold">Tunai Kas Teller</td>
                <td colspan="5"></td>
            </tr>
            @elseif($n>0 && $values->tob=='O' && ($values->tob<>$tob1[($n-1)]))
                <tr>
                    <td colspan="6">&nbsp;</td>
                    <td style="border: 1px solid">{{number_format($totdebet,2,".",",")}}</td>
                    <td style="border: 1px solid">{{number_format($totkredit,2,".",",")}}</td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                    <td style="font-weight: bold">Saldo AKhir</td>
                    <td style="border: 1px solid">{{(number_format($saldoawalkas+$totdebet-$totkredit,2,".",","))}}</td>
                </tr>
                <tr>
                    <td colspan="4">Overbook {{$values->modul}}</td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <th colspan="3">Tanggal</th>
                    <th>Jurnal</th>
                    <th>No.Bukti</th>
                    <th>Uraian</th>
                    <th>Terima</th>
                    <th>Keluar</th>
                </tr>
                @php($totdebet=0)
                @php($totkredit=0)
                @elseif($n>0 && $values->tob=='O' && ($values->tob==$tob1[($n-1)]) && ($values->modul<>$modul1[($n-1)]))
                    <tr>
                        <td colspan="6">&nbsp;</td>
                        <td style="border: 1px solid">{{number_format($totdebet,2,".",",")}}</td>
                        <td style="border: 1px solid">{{number_format($totkredit,2,".",",")}}</td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                        <td style="font-weight: bold">Saldo AKhir</td>
                        <td style="border: 1px solid">{{(number_format($totdebet-$totkredit,2,".",","))}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">Overbook {{$values->modul}}</td>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <th colspan="3">Tanggal</th>
                        <th>Jurnal</th>
                        <th>No.Bukti</th>
                        <th>Uraian</th>
                        <th>Terima</th>
                        <th>Keluar</th>
                    </tr>
                    @php($totdebet=0)
                    @php($totkredit=0)
                    @endif
                    <tr>
                        <td colspan="3">{{$values->tgl_trans}}</td>
                        <td>{{$values->kode_jurnal}}</td>
                        <td>{{$values->NO_BUKTI}}</td>
                        <td>{{$values->uraian}}</td>
                        @if($values->my_kode_trans=='200')
                        <td>{{$values->saldo_trans}}</td>
                        @php($totdebet = $totdebet + $values->saldo_trans)
                        @else
                        <td>0</td>
                        @endif
                        @if($values->my_kode_trans=='300')
                        <td>{{$values->saldo_trans}}</td>
                        @php($totkredit = $totkredit + $values->saldo_trans)

                        @else
                        <td>0</td>
                        @endif
                    </tr>
                    @php($n++)
                    @endforeach
                    <tr>
                        <td colspan="6">&nbsp;</td>
                        <td style="border: 1px solid">{{number_format($totdebet,2,".",",")}}</td>
                        <td style="border: 1px solid">{{number_format($totkredit,2,".",",")}}</td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                        <td style="font-weight: bold">Saldo AKhir</td>
                        <td style="border: 1px solid">{{(number_format($totdebet-$totkredit,2,".",","))}}
                        </td>
                    </tr>
        </tbody>
    </table>

    {{-- <div class="row" style="margin-left:500px;margin-top:10px">{{$kota[0]->Value.','.date('d F Y')}}</div> --}}
    <table>
        <tr>
            <td style="width: 300px;padding-left:25px">
                Mengetahui
            </td>
            <td style="width: 300px;padding-left:25px">
                Menyetujui
            </td>
            <td style="width: 300px;padding-left:25px">
                Membuat
            </td>
        </tr>
        <tr>
            <td style="width: 300px">
                &nbsp;
            </td>
            <td style="width: 300px">
                &nbsp;
            </td>
            <td style="width: 300px">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="width: 300px">
                &nbsp;
            </td>
            <td style="width: 300px">
                &nbsp;
            </td>
            <td style="width: 300px">
                &nbsp;
            </td>
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_KAS_L_NAMA')
            <td style="width: 300px">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_KAS_C_NAMA')
            <td style="width: 300px">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_KAS_R_NAMA')
            <td style="width: 300px">
                {{$ttd1->Value}}
            </td>
            @endif
            @endforeach
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_KAS_L_NIP')
            <td style="width: 300px">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_KAS_C_NIP')
            <td style="width: 300px">
                {{$ttd1->Value}}
            </td>
            @elseif($ttd1->KeyName=='TTD_KAS_R_NIP')
            <td style="width: 300px">
                {{$ttd1->Value}}
            </td>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>