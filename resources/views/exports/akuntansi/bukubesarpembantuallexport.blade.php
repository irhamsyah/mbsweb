<table id="tbl1" class="table table-responsive" style="border-style:none">
    @php($index=0)
    @php($totsaldo=0)
    @php($totdebet=0)
    @php($totkredit=0)
    @php($perk=[])
    @php($namaperk=[])
    @foreach($result as $values)
        @php(array_push($perk,$values->kode_perk))
        @php(array_push($namaperk,$values->nama_perk))

    @if($index==0)
    <thead>
    <tr>
        <th>Tgl Trans </th>
        <th>Kode</th>
        <th>No.bukti</th>
        <th>Uraian</th>
        <th>Debet</th>
        <th>Kredit</th>
        <th>Saldo</th>
    </tr>
    <tr>
        <th>{{$values->kode_perk}}</th>
        <th>{{$values->nama_perk}}</th>
        <th></th>
        <th></th>
        <th></th>
        <th>Saldo awal</th>
        <th>{{number_format($values->SALDO_AWAL,2,".",",")}}</th>
    </tr>
    </thead>
    @endif
    <tbody>
        @if($index == 0)
            @if($values->dk=='D')
                @php($totsaldo=$totsaldo+$values->SALDO_AWAL+($values->debet-$values->kredit))
            @else
                @php($totsaldo=$totsaldo+$values->SALDO_AWAL+($values->kredit-$values->debet))
            @endif
        @elseif($index>0 &&($perk[($index-1)]==$perk[($index)]))
            @if($values->dk=='D')
                @php($totsaldo=$totsaldo+($values->debet-$values->kredit))
            @else
                @php($totsaldo=$totsaldo+($values->kredit-$values->debet))
            @endif
        @endif
        @if($index==0)
        <tr>
            <td>{{ $values->tgl_trans}}</td>
            <td>{{ $values->kode_jurnal}}</td>
            <td>{{ $values->no_bukti}}</td>
            <td>{{ $values->URAIAN}}</td>
            <td>{{ number_format($values->debet,2,".",",")}}</td>
            <td>{{ number_format($values->kredit,2,".",",")}}</td>
            <td>{{ number_format($totsaldo,2,".",",")}}</td>
            @php($totdebet=$totdebet+$values->debet)
            @php($totkredit=$totkredit+$values->kredit)
        </tr>
        @php($index++)

        @elseif($index>0 &&($perk[($index-1)]==$perk[($index)]))
        <tr>
            <td>{{ $values->tgl_trans}}</td>
            <td>{{ $values->kode_jurnal}}</td>
            <td>{{ $values->no_bukti}}</td>
            <td>{{ $values->URAIAN}}</td>
            <td>{{ number_format($values->debet,2,".",",")}}</td>
            <td>{{ number_format($values->kredit,2,".",",")}}</td>
            <td>{{ number_format($totsaldo,2,".",",")}}</td>
            @php($totdebet=$totdebet+$values->debet)
            @php($totkredit=$totkredit+$values->kredit)
        </tr>
        @php($index++)

        @elseif($index>0 &&($perk[($index-1)]<>$perk[($index)]))
        <tr>
            <td>Total Jumlah {{$namaperk[($index-1)]}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{number_format($totdebet,2,".",",")}}</td>
            <td>{{number_format($totkredit,2,".",",")}}</td>
            <td>{{number_format($totsaldo,2,".",",")}}</td>
        </tr>
            @php($index=0)
            @php($perk=[])
            @php($namaperk=[])
            @php($totsaldo=0)
            @php($totdebet=0)
            @php($totkredit=0)
            @php(array_push($perk,$values->kode_perk))
            @php(array_push($namaperk,$values->nama_perk))

                <thead>
                <tr>
                    <th>Tgl Trans </th>
                    <th>Kode</th>
                    <th>No.bukti</th>
                    <th>Uraian</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                            </tr>
                <tr>
                    <th>{{$values->kode_perk}}</th>
                    <th>{{$values->nama_perk}}</th>
                    <th></th>
                    <th></th>
                    <th></th>        
                    <th>Saldo awal</th>
                    <th>{{number_format($values->SALDO_AWAL,2,".",",")}}</th>
                </tr>
                </thead>
                    @if($index == 0)
                        @if($values->dk=='D')
                            @php($totsaldo=$totsaldo+$values->SALDO_AWAL+($values->debet-$values->kredit))
                        @else
                            @php($totsaldo=$totsaldo+$values->SALDO_AWAL+($values->kredit-$values->debet))
                        @endif
                    @elseif($index>0 &&($perk[($index-1)]==$perk[($index)]))
                        @if($values->dk=='D')
                            @php($totsaldo=$totsaldo+($values->debet-$values->kredit))
                        @else
                            @php($totsaldo=$totsaldo+($values->kredit-$values->debet))
                        @endif
                    @endif
                    {{-- @if($index==0) --}}
                    <tr>
                        <td>{{ $values->tgl_trans}}</td>
                        <td>{{ $values->kode_jurnal}}</td>
                        <td>{{ $values->no_bukti}}</td>
                        <td>{{ $values->URAIAN}}</td>
                        <td>{{ number_format($values->debet,2,".",",")}}</td>
                        <td>{{ number_format($values->kredit,2,".",",")}}</td>
                        <td>{{ number_format($totsaldo,2,".",",")}}</td>
                        @php($totdebet=$totdebet+$values->debet)
                        @php($totkredit=$totkredit+$values->kredit)
                    </tr>
                    @php($index++)
    
         @endif
        @endforeach

    </tbody>
</table>
