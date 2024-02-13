<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Nominatif Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #tbl1,thead,th {
            font-size: 10pt;
            font-family: 'Times New Roman', Times, serif;
            padding: 2px;
            margin: 0px;
            border: 1px solid;
            text-align: right;
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
            text-align: center
        }
    </style>
</head>
<body> 
    {{-- <a href="{{route('searchnomdepgroup')}}">Home</a> --}}
    @foreach($lembaga as $values)
    <br>{{$values->Value}}<br>
    @endforeach
    <p>Daftar Posisi Deposito Pertanggal : {{date('d-m-Y',strtotime($tgl_input))}}</p>
    <table id="tbl1" class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>NO_REKENING</th>
                <th>NAMA</th>
                <th>ALAMAT</th>
                <th>TGL_MULAI</th>
                <th>JKW</th>
                <th>TGL_JT</th>
                <th>NOMINAL</th>
            </tr>
        </thead>
        <tbody>
            @php($totnominatif=0)
            @php($totnominatifgroup=0)

            @php($n=0)
            @php($jenisdep=[])
            @php($record = count($nominatif))
        @foreach($nominatif as $index => $values)
            @php(++$n)
            @if($index == 0)
                @php(array_push($jenisdep,$values->KODE_GROUP2))
                <tr>
                    <td></td>
                    <td><h5>{{$values->DESKRIPSI_GROUP2}}</h5></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @elseif($index > 0)
                @php(array_push($jenisdep,$values->KODE_GROUP2))
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
                        @php($n=0)
                        @php(++$n)
                        @php($totnominatifgroup=0)
                    </tr>
                    <tr>
                        <td></td>
                        <td><h5>{{$values->DESKRIPSI_GROUP2}}</h5></td>
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
                <td>{{$values->NO_REKENING}}</td>
                <td>{{$values->nama_nasabah}}</td>
                <td>{{$values->alamat}}</td>
                <td>{{$values->TGL_MULAI}}</td>
                <td>{{$values->JKW}}</td>
                <td>{{$values->TGL_JT}}</td>
                <td>{{number_format($values->NOMINAL,2,'.',',')}}</td>
            </tr>
            @php($totnominatifgroup=$totnominatifgroup+$values->NOMINAL)

            @php($totnominatif=$totnominatif+$values->NOMINAL)
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