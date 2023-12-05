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
