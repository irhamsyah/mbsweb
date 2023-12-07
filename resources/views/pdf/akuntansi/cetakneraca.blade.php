<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
            /* #tbl1{
              font-size:60%;
            } */
            br{
              content: "";
              margin: 0.5em;
              display: block;
              font-size: 100%;
            }
            
        </style>
                  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <title>NERACA</title>
      </head>
      <body>
    <div class="container">
      <button onClick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
      </svg></button>
      <a href="{{route('showfrmneraca')}}" class="btn btn-md btn-normal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check" viewBox="0 0 16 16">
          <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z"/>
          <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514Z"/>
        </svg>
      </a>
      {{-- TEKNIK INI SAMA DENGAN MENGGUNAKAN Request $request di Controller --}}
      <a href="{{route('export_neraca_lajur',['tgl_trans'=>$tgl_trans])}}">
        <i class='fas fa-file-export'></i>
      </a>
        <h4>NERACA</h4>
        @foreach($lembaga as $values)
        <br>{{$values->Value}}<br>
        @endforeach
        <h5 style="font-size: 100%">periode {{date('d F Y',strtotime($tgl_trans))}}</h5>

        <table id="tbl1" class="table table-bordered" style="border-style: none">
          <thead>
        <tr>
            <th rowspan="2">AKTIVA </th>
            <th rowspan="2">Rupiah</th>
            <th rowspan="2">PASIVA</th>
            <th rowspan="2">Rupiah</th>
        </tr>
        </thead>
        <tbody>
          @foreach($rsneraca as $value)
            <tr>
                <td>{{ $value->aktiva}}</td>
                <td>{{ number_format((float)$value->jumlah_aktiva,2,".",",")}}</td>
                <td>{{ $value->pasiva }}</td>
                <td>{{ number_format((float)$value->jumlah_pasiva,2,".",",")}}</td>
            </tr>
          @endforeach
            <tr>

              <td></td>
              <td></td>
              <td>Laba Tahun Berjalan</td>
              @if($laba>0)
                <td>{{number_format((float)$laba,2,".",",")}}</td>
              @elseif($laba<0)
                <td>({{number_format((float)($laba*-1),2,".",",")}})</td>
              @endif
            </tr>
            <tr>
                <td>Total Aktiva</td>
                <td>{{number_format((float)$totaktiva,2,".",",")}}</td>
                <td>Total Pasiva</td>
                <td>{{number_format((float)$totpasiva,2,".",",")}}</td>
            </tr>
        </tbody>
    </table>
              {{-- TOTAL LABA ATHUN BERJALAN  --}}
    </div>

        <div class="row" style="margin-left: 120px" >{{date('d F Y')}}</div>
        <div class="row" style="border:0px;padding-bottom:30px;margin-left:100px">
            <div class="col">
                Mengetahui & Menyetujui
            </div>
            <div class="col">
                Dibuat
            </div>
        </div>
        @foreach($ttd as $ttd1)
        @if($ttd1->KeyName=='TTD_GL_L_NAMA')
        <div class="row" style="border:0px;padding-top:30px;margin-left:100px">
        <div class="col">
            {{$ttd1->Value}}
          </div>
        @elseif($ttd1->KeyName=='TTD_GL_R_NAMA')

          <div class="col">
            {{$ttd1->Value}}
          </div>
        </div>
        @endif
        @endforeach
        <div class="row" style="margin-left:100px">
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_GL_L_NIP')
            <div class="col">
                {{$ttd1->Value}}
            </div>
            @elseif($ttd1->KeyName=='TTD_GL_R_NIP')
            <div class="col">
                {{$ttd1->Value}}
            </div>
            @endif
            @endforeach
        </div>

    </div>
  </body>
</html>