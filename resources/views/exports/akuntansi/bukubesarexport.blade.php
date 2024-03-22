{{-- @php(dd($dk[0]->dk)) --}}

<table id="tbl1" class="table table-responsive" style="border-style:none">
    <thead>
    <tr>
        <th>Tanggal </th>
        <th>Keterangan</th>
        <th>Debet</th>
        <th>Kredit</th>
        <th>Saldo</th>

    </tr>
    <tr>
        <th>{{$kode_perk}}</th>
        <th></th>
        <th></th>
        <th>Saldo awal</th>
        <th>{{number_format($saldo_awal[0]->SALDO_AWAL,2,".",",")}}</th>
    </tr>
    </thead>
    <tbody>
        @php($index=0)
        @php($totsaldo=0)
        @php($totdebet=0)
        @php($totkredit=0)

    @foreach($result as $values)
        @php($index++)
        @if($index == 1)
            @if($dk[0]['dk']=='D')
                @php($totsaldo=$totsaldo+$saldo_awal[0]->SALDO_AWAL+($values->debet-$values->kredit))
            @else
                @php($totsaldo=$totsaldo+$saldo_awal[0]->SALDO_AWAL+($values->kredit-$values->debet))
            @endif
        @else
            @if($dk[0]['dk']=='D')
                @php($totsaldo=$totsaldo+($values->debet-$values->kredit))
            @else
                @php($totsaldo=$totsaldo+($values->kredit-$values->debet))
            @endif
        @endif
        <tr>
            <td>{{ $values->tgl_trans}}</td>
            <td>{{ $values->keterangan}}</td>
            <td>{{ number_format($values->debet,2,".",",")}}</td>
            <td>{{ number_format($values->kredit,2,".",",")}}</td>
            <td>{{ number_format($totsaldo,2,".",",")}}</td>
            @php($totdebet=$totdebet+$values->debet)
            @php($totkredit=$totkredit+$values->kredit)

        </tr>
    @endforeach
        <tr>
            <td>Total Jumlah {{$kode_perk}}</td>
            <td></td>
            <td>{{number_format($totdebet,2,".",",")}}</td>
            <td>{{number_format($totkredit,2,".",",")}}</td>
            <td>{{number_format($totsaldo,2,".",",")}}</td>
        </tr>
    </tbody>
</table>