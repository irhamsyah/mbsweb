<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        {{-- <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
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
            .col1{
                border:ridge; 
                float:left; 
                width:400px;
                background-color: #E8F6F7;
            }
            .col2{
                border-style:ridge; 
                float:left; 
                width:150px; 
                background-color: #f2dede;
            }
            .col3{
                border-style:ridge; 
                float: left;
                width: 400px;
                background-color: #E8F6F7;
            }
            .col4{
                border-style:ridge; 
                float: left;
                width: 150px;
                background-color: #f2dede;
            }
            /* ISI NERACA */
            .col5 {
                float:left; 
                width:400px;
            }
            .col6 {
                float:left; 
                width:150px; 
            }
            .col7{
                float: left;
                width: 400px;
            }
            .col8{
                float: left;
                width: 150px;
            }
            .col9{
                float: left;
                width: 400px;
                background-color: #E8F6F7;
            }
            .col10{
                float: left;
                width: 150px;
                background-color: #f2dede;
            }
            .col11{
                float: left;
                width: 400px;
                background-color: #E8F6F7;
            }
            .col12{
                float: left;
                width: 150px;
                background-color: #f2dede;
            }
        </style>
    
      </head>
      <body>
    <div class="container">
          <div class="col1">                          
              <div>AKTIVA</div>
          </div>
          <div class="col2">
              <div>Rupiah</div>
          </div>
          <div class="col3">                          
              <div>PASIVA</div>
          </div>
          <div class="col4">
              <div>Rupiah</div>
          </div>
          <br>
          <div class="col5">
              @php($index = 0)
              @foreach($nama_perk as $value)
                  @if($dk[$index] =="D")
                      @if($level[$index]>2)
                        <div style="margin-left: {{$level[$index]+2}}px">{{$value}}</div>
                      @elseif($level[$index]==1)
                        <div style="font-weight:bold">{{$value}}</div>
                      @else
                        <div style="margin-left: {{$level[$index]}}px">{{$value}}</div>
                      @endif
                  @endif
                  @php($index++)
              @endforeach    
          </div>
          <div class="col6">
              @php($index = 0)
              @foreach($saldo_akhir as $value)
                  @if($dk[$index] =="D" AND $value>=0)
                    <div style="text-align:right;margin-right:3px">{{number_format((float)$value,2,".",",")}}</div>
                  @elseif($dk[$index] =="D" AND $value<0)
                  <div style="text-align:right;margin-right:3px">({{number_format((float)($value*-1),2,".",",")}})</div>

                  @endif
              @php($index++)
              @endforeach    
          </div>
          <div class="col7">
              @php($index = 0)
              @foreach($nama_perk as $value)
                  @if($dk[$index] =="K")
                    @if($level[$index]>2)
                        <div style="margin-left: {{$level[$index]+2}}px">{{$value}}</div>
                    @elseif($level[$index]==1)
                        <div style="font-weight:bold">{{$value}}</div>
                    @else
                      <div style="margin-left: {{$level[$index]}}px">{{$value}}</div>
                    @endif
                  @endif
                  @php($index++)
              @endforeach
              LABA TAHUN BERJALAN    
          </div>
          <div class="col8">
              @php($index = 0)
              @foreach($saldo_akhir as $value)
                  @if($dk[$index] =="K" AND $value>=0)
                  <div style="text-align: right">{{number_format((float)$value,2,".",",")}}</div>
                  @elseif($dk[$index] =="K" AND $value<0)
                  <div style="text-align: right">({{number_format((float)($value*-1),2,".",",")}})</div>
                  @endif
              @php($index++)
              @endforeach
              {{-- TOTAL LABA ATHUN BERJALAN  --}}
              @if($laba>0)
                <div style="text-align: right">{{number_format((float)$laba,2,".",",")}}</div>
              @elseif($laba<0)
                <div style="text-align: right">({{number_format((float)($laba*-1),2,".",",")}})</div>

              @endif
          </div>
          <div class="col9">
            Total Aktiva
          </div>
          <div class="col10">
            <div style="text-align: right;margin-right:3px">{{number_format((float)$totaktiva,2,".",",")}}</div>
          </div>
          <div class="col9">
            Total Pasiva
          </div>
          <div class="col10">
            <div style="text-align: right">{{number_format((float)$totaktiva,2,".",",")}}</div>
          </div>
    </div>
  </body>
</html>