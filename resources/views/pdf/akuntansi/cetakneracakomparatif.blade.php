<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
            #tbl1{
              font-size:60%;
            }
            br{
              content: "";
              margin: 0.5em;
              display: block;
              font-size: 24%;
            }
        </style>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <title>Neraca Komparatif</title>
      </head>
      <body>
    <div class="container">
      <button onClick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
      </svg></button>
      <a href="{{route('showfrmneracakomparatif')}}" class="btn btn-md btn-normal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check" viewBox="0 0 16 16">
          <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z"/>
          <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514Z"/>
        </svg>
      </a>
      <a href="{{route('exportneracakomparatif',['tgl_trans1'=>$tgl_trans1,'tgl_trans2'=>$tgl_trans2])}}">export</a>
        <h4>NERACA KOMPARATIF</h4>
        @foreach($lembaga as $values)
        <br>{{$values->Value}}<br>
        @endforeach

            <h5 style="font-size: 70%">periode {{date('d F Y',strtotime($tgl_trans1))}} s/d {{date('d F Y',strtotime($tgl_trans2))}}</h5>
          <table id="tbl1" class="table table-responsive" style="border-style:none">
            <thead>
            <tr>
                <th rowspan="2">Kode Intern </th>
                <th rowspan="2">Nama Perkiraan</th>
                <th>Saldo Awal</th>
                <th rowspan="2">Debet</th>
                <th rowspan="2">Kredit</th>
                <th>Saldo Akhir</th>

            </tr>
            <tr>
                <th>{{$tgl_trans1}}</th>
                <th>{{$tgl_trans2}}</th>
            </tr>
            </thead>
            <tbody>
                @php($totsaldoawal=0)
                @php($totsaldoawalAP=0)
                @php($totsaldoakhirAP=0)
                @php($totsaldoawalAK=0)
                @php($totsaldoakhirAK=0)
                @php($totsaldoawalPA=0)
                @php($totsaldoakhirPA=0)
                @php($totdebet=0)
                @php($totkredit=0)
                @php($totsaldoakhir=0)

                @php($i=0)
                @php($max=count($rstrial))
            @foreach($rstrial as $values)
                @if($i<$max)
                    @if($i>0 AND (substr($rstrial[$i-1]->kode_perk,0,1)<>substr($rstrial[$i]->kode_perk,0,1)) AND substr($rstrial[$i-1]->kode_perk,0,1)==1)
                    {{-- @php(dd(substr($rstrial[$i]->kode_perk,0,1))) --}}
                    <tr>
                      <td>Total Aktiva</td>
                      <td></td>
                      <td>{{number_format($totsaldoawalAP,2,".",",")}}</td>
                      <td>{{number_format($totdebet,2,".",",")}}</td>
                      <td>{{number_format($totkredit,2,".",",")}}</td>
                      <td>{{number_format($totsaldoakhirAP,2,".",",")}}</td>
                      @php($totsaldoawalAK=$totsaldoawalAP)
                      @php($totsaldoakhirAK=$totsaldoakhirAP)
                      @php($totsaldoawalAP=0)
                      @php($totsaldoakhirAP=0)

                    </tr>
                    @elseif($i>0 AND (substr($rstrial[$i-1]->kode_perk,0,1)<>substr($rstrial[$i]->kode_perk,0,1)) AND substr($rstrial[$i-1]->kode_perk,0,1)==3)
                    @php($totsaldoawalPA=$totsaldoawalAP)
                    @php($totsaldoakhirPA=$totsaldoakhirAP)
                    <tr>
                      <td>Laba Tahun Berjalan</td>
                      <td></td>
                      <td>{{number_format($totsaldoawalAK-$totsaldoawalPA,2,".",",")}}</td>
                      <td>{{number_format($totdebetpend[0]->debet-$totdebetby[0]->debet,2,".",",")}}</td>
                      <td>{{number_format($totkreditpend[0]->kredit-$totkreditby[0]->kredit,2,".",",")}}</td>
                      <td>{{number_format($totsaldoakhirAK-$totsaldoakhirPA,2,".",",")}}</td>
                    </tr>

                    <tr>
                      <td>Total Pasiva</td>
                      <td></td>
                      <td>{{number_format($totsaldoawalAK,2,".",",")}}</td>
                      <td>{{number_format($totdebet,2,".",",")}}</td>
                      <td>{{number_format($totkredit,2,".",",")}}</td>
                      <td>{{number_format($totsaldoakhirAK,2,".",",")}}</td>
                    </tr>
                    @php($totsaldoawalAP=0)
                    @php($totsaldoakhirAP=0)

                    @endif
                    @if($values->type == 'D')
                      @php($totsaldoawal=$totsaldoawal+$values->saldo_awal)
                      @php($totsaldoawalAP=$totsaldoawalAP+$values->saldo_awal)
                      @php($totdebet=$totdebet+$values->saldo_debet)
                      @php($totkredit=$totkredit+$values->saldo_kredit)
                      @php($totsaldoakhir=$totsaldoakhir+$values->saldo_akhir)
                      @php($totsaldoakhirAP=$totsaldoakhirAP+$values->saldo_akhir)
                    @endif
                @endif
                @if(substr($values->kode_perk,0,1)==1 OR substr($values->kode_perk,0,1)==2 OR substr($values->kode_perk,0,1)==3)
                <tr>
                  <td>{{ $values->kode_alt}}</td>
                  <td>{{ $values->nama_perk}}</td>
                  <td>{{ number_format($values->saldo_awal,2,".",",")}}</td>
                  <td>{{ number_format($values->saldo_debet,2,".",",")}}</td>
                  <td>{{ number_format($values->saldo_kredit,2,".",",")}}</td>
                  <td>{{ number_format($values->saldo_akhir,2,".",",")}}</td>
                </tr>
                @endif
                @php($i++)
            @endforeach
            </tbody>
        </table>
          <div class="row" style="font-size: 60%">
            <div class="col">
              Total Pendapatan
            </div>
            <div class="col" style="margin-right: 800px">
              {{number_format($pendapatan,2,".",",")}}
            </div>
          </div>
          <div class="row" style="font-size: 60%">
            <div class="col">
              Total Biaya
            </div>
            <div class="col" style="margin-right: 800px">
              {{number_format($biaya,2,".",",")}}
            </div>
          </div>
          <div class="row" style="font-size: 60%">
            <div class="col">
              ------------------------------------------------------------------
            </div>
          </div>
          <div class="row" style="font-size: 60%">
              <div class="col">
                LABA (RUGI)
              </div>
              <div class="col" style="margin-right: 800px">
                @if($pendapatan-$biaya<0)
                  ({{number_format($biaya-$pendapatan,2,".",",")}})
                @else
                  {{number_format($pendapatan-$biaya,2,".",",")}}
                @endif
              </div>

          </div>
          <div class="row" style="font-size: 60%">
            <div class="col">
              PAJAK
            </div>
            <div class="col" style="margin-right: 800px">
              {{number_format($pajak,2,".",",")}}
            </div>

          </div>
          <div class="row" style="font-size: 60%">
            <div class="col">
              ------------------------------------------------------------------
            </div>
          </div>
          <div class="row" style="font-size: 60%">
              <div class="col">
                LABA SETELAH PAJAK
              </div>
              <div class="col" style="margin-right: 800px">
                @if($pendapatan-$biaya-$pajak<0)
                  ({{number_format(($pendapatan-$biaya-$pajak)*-1,2,".",",")}})
                @else
                  {{number_format($pendapatan-$biaya-$pajak,2,".",",")}}
                @endif
              </div>
          </div>
        <div class="row" style="margin-left:37%;font-size:60%">{{date('d F Y')}}</div>
        <div class="row align-items-start" style="border:0px;padding-bottom:30px">
            <div class="col" style="font-size: 60%">
                Mengetahui & Menyetujui
            </div>
            <div class="col" style="margin-right:24%;font-size: 60%">
                Dibuat
            </div>
        </div>
        @foreach($ttd as $ttd1)
        @if($ttd1->KeyName=='TTD_GL_L_NAMA')
        <div class="row" style="border:0px;padding-top:30px;margin-right:28%">
        <div class="col" style="font-size: 60%">
            {{$ttd1->Value}}
          </div>
        @elseif($ttd1->KeyName=='TTD_GL_R_NAMA')

        <div class="col" style="font-size: 60%">
            {{$ttd1->Value}}
          </div>
        </div>
        @endif
        @endforeach
        <div class="row" style="margin-right:28%">
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_GL_L_NIP')
            <div class="col" style="font-size: 60%">
                {{$ttd1->Value}}
            </div>
            @elseif($ttd1->KeyName=='TTD_GL_R_NIP')
            <div class="col" style="font-size: 60%">
                {{$ttd1->Value}}
            </div>
            @endif
            @endforeach
        </div>

    </div>
  </body>
</html>