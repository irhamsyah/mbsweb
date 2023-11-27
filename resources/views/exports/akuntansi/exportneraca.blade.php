<table id="tbl1" class="table table-bordered" style="border-style: none">
  <thead>
<tr>
    <th>AKTIVA </th>
    <th>Rupiah</th>
    <th>PASIVA</th>
    <th>Rupiah</th>
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
        <td>{{number_format((float)$totaktiva,2,".",",")}}</td>
    </tr>
</tbody>
</table>
