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
                <th>No</th>
                <th>No.Rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php($totjmlbunga=0)
            @php($totjmlpajak=0)
            @php($totnominatif=0)
        @foreach($nominatif as $index => $values)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$values->NO_REKENING}}</td>
                <td>{{$values->nama_nasabah}}</td>
                <td>{{$values->alamat}}</td>
                <td>{{number_format($values->NOMINAL,2,'.',',')}}</td>
            </tr>
            @php($totnominatif=$totnominatif+$values->NOMINAL)

        @endforeach
        </tbody>
    </table>
    <div class="container">
        <div class="row">
          <div class="col-sm">
            Deposan : {{$index}} orang
          </div>
          <div class="col-sm">
            Jumlah  : {{number_format($totnominatif,2,'.',',')}}
          </div>
        </div>
    </div>

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