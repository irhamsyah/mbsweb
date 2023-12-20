<table id="tbl1" class="table table-bordered" style="border-style: none">
    <thead>
    <tr>
        <th rowspan="2">AKTIVA </th>
        <th rowspan="1" colspan="3" style="text-align: center">Periode</th>
        <th rowspan="2">PASIVA</th>
        <th rowspan="1" colspan="3" style="text-align: center">Periode</th>
    </tr>
    <tr>
        {{-- <th></th> --}}
        <th colspan="1">{{date('d-M-Y',strtotime($tgl_trans1))}}</th>
        <th colspan="1">{{date('d-M-Y',strtotime($tgl_trans2))}}</th>
        <th colspan="1">{{date('d-M-Y',strtotime($tgl_trans3))}}</th>
        <th colspan="1">{{date('d-M-Y',strtotime($tgl_trans1))}}</th>
        <th colspan="1">{{date('d-M-Y',strtotime($tgl_trans2))}}</th>
        <th colspan="1">{{date('d-M-Y',strtotime($tgl_trans3))}}</th>
    </tr>
    </thead>
    <tbody>
      @foreach($rsneraca as $value)
        <tr>
            <td>{{ $value->aktiva}}</td>
            <td>{{ number_format((float)$value->aktiva_bln1,2,".",",")}}</td>
            <td>{{ number_format((float)$value->aktiva_bln2,2,".",",")}}</td>
            <td>{{ number_format((float)$value->aktiva_bln3,2,".",",")}}</td>
            <td>{{ $value->pasiva }}</td>
            <td>{{ number_format((float)$value->pasiva_bln1,2,".",",")}}</td>
            <td>{{ number_format((float)$value->pasiva_bln2,2,".",",")}}</td>
            <td>{{ number_format((float)$value->pasiva_bln3,2,".",",")}}</td>

        </tr>
      @endforeach
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Laba Tahun Berjalan</td>
          @if($laba1>0)
            <td>{{number_format((float)$laba1,2,".",",")}}</td>
          @elseif($laba1<0)
            <td>({{number_format((float)($laba1*-1),2,".",",")}})</td>
          @else
            <td>{{number_format((float)0,2,".",",")}}</td>
          @endif
          @if($laba2>0)
            <td>{{number_format((float)$laba2,2,".",",")}}</td>
          @elseif($laba2<0)
            <td>({{number_format((float)($laba2*-1),2,".",",")}})</td>
          @else
            <td>{{number_format((float)0,2,".",",")}}</td>
          @endif
          @if($laba3>0)
            <td>{{number_format((float)$laba3,2,".",",")}}</td>
          @elseif($laba3<0)
            <td>({{number_format((float)($laba3*-1),2,".",",")}})</td>
           @else
             <td>{{number_format((float)0,2,".",",")}}</td>
           @endif
        </tr>
        <tr>
            <td>Total Aktiva</td>
            <td>{{number_format((float)$totaktiva1,2,".",",")}}</td>
            <td>{{number_format((float)$totaktiva2,2,".",",")}}</td>
            <td>{{number_format((float)$totaktiva3,2,".",",")}}</td>

            <td>Total Pasiva</td>
            <td>{{number_format((float)$totaktiva1,2,".",",")}}</td>
            <td>{{number_format((float)$totaktiva2,2,".",",")}}</td>
            <td>{{number_format((float)$totaktiva3,2,".",",")}}</td>

        </tr>
    </tbody>
</table>
