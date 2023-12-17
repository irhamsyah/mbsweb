<table id="tbl1">
  <thead>
  <tr>
      <th>Kode Perk </th>
      <th>Nama Perkiraan </th>
      <th>Bangil</th>
      <th>Tanggulangin</th>
      <th>Malang</th>
      <th>Pasuruan</th>
      <th>Purwosari</th>
      <th>Konsolidasi</th>
  </tr>
  </thead>
  <tbody>
    @foreach($result as $value)
      @if($value->KODE_PERK=='1' OR $value->KODE_PERK=='2' OR $value->KODE_PERK=='3')

      @else
      <tr>
          <td>{{ $value->KODE_PERK}}</td>
          <td>{{ $value->NAMA_PERK}}</td>
          <td>{{ $value->K00}}</td>
          <td>{{ $value->K01}}</td>
          <td>{{ $value->K02}}</td>
          <td>{{ $value->K03}}</td>
          <td>{{ $value->K04}}</td>
          @php($total = $value->K00+$value->K01+$value->K02+$value->K03+$value->K04)
          <td>{{ $total}}</td>
      </tr>
      @endif
    @endforeach
  </tbody>
</table>
